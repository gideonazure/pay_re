<?php

namespace App\Controller;

use App\DTO\CreateUser;
use App\DTO\UpdateUser;
use App\Service\UserInterface;
use App\Service\ValidationService as ValidationService;
use App\Service\ResponseService as ResponseService;
use App\Transformer\UserTransformer;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;


/**
 * @Route("/user")
 */
final class UserController extends AbstractController
{
    private UserInterface $userInterface;
    private ValidationService $validationService;
    private ResponseService $responseService;

    public function __construct(
        UserInterface $userInterface,
        ValidationService $validationService,
        ResponseService $responseService
    ) {
        $this->userInterface = $userInterface;
        $this->validationService = $validationService;
        $this->responseService = $responseService;
    }

    /**
     * @Route(methods={"GET"})
     */
    public function list(): JsonResponse
    {
        $user = $this->userInterface->getList();
        $responseData = $this->responseService->getCollectionResponseData($user, new UserTransformer());

        return new JsonResponse($responseData, JsonResponse::HTTP_OK);
    }

    /**
     * @Route("/create", methods={"POST"})
     */
    public function create(Request $request): JsonResponse
    {
        $user = json_decode($request->getContent(), true);
        $dto = CreateUser::fromRequest($user);
        $errors = $this->validationService->validateDto($dto);

        if (count($errors) > 0) {
            return new JsonResponse($errors, JsonResponse::HTTP_BAD_REQUEST);
        }

        $user = $this->userInterface->create($dto);
        $responseData = $this->responseService->getItemResponseData($user, new UserTransformer());

        return new JsonResponse($responseData, JsonResponse::HTTP_OK);
    }

    /**
     * @Route("/{id}/delete", methods={"POST"})
     */
    public function delete(int $id): JsonResponse
    {
        $this->userInterface->delete($id);

        return new JsonResponse(null, JsonResponse::HTTP_NO_CONTENT);
    }

    /**
     * @Route("/{id}/update", methods={"POST"})
     */
    public function update(int $id, Request $request): JsonResponse
    {
        $user = json_decode($request->getContent(), true);
        $dto = UpdateUser::fromRequest($user);
        $errors = $this->validationService->validateDto($dto);

        if (count($errors) > 0) {
            return new JsonResponse($errors, JsonResponse::HTTP_BAD_REQUEST);
        }

        try {
            $user = $this->userInterface->update($id, $dto);
            $responseData = $this->responseService->getItemResponseData($user, new UserTransformer());

            return new JsonResponse($responseData, JsonResponse::HTTP_OK);
        } catch (\Exception $e) {
            $errors = $this->validationService->getExceptionErrorInfo($e);

            return new JsonResponse($errors, JsonResponse::HTTP_BAD_REQUEST);
        }
    }

    /**
     * @Route("/{id}", methods={"GET"})
     */
    public function getById(int $id): JsonResponse
    {
        $user = $this->userInterface->getById($id);
        $responseData = $this->responseService->getItemResponseData($user, new UserTransformer());

        return new JsonResponse($responseData, JsonResponse::HTTP_OK);
    }

}
