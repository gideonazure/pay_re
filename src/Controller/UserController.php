<?php

namespace App\Controller;

use App\DTO\CreateUser;
use App\Service\UserInterface;
use App\Transformer\UserTransformer;
use League\Fractal\Resource\Collection;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Validator\Validator\ValidatorInterface;

/**
 * @Route("/user")
 */
final class UserController extends BaseController
{
    private UserInterface $userInterface;
    protected ValidatorInterface $validator;

    public function __construct(
        UserInterface $userInterface,
        ValidatorInterface $validator
    ) {
        parent::__construct($validator);
        $this->userInterface = $userInterface;
    }

    /**
     * @Route(methods={"GET"})
     */
    public function list(): JsonResponse
    {
        $user = $this->userInterface->getList();
        $resourse = new Collection($user, new UserTransformer());

        return new JsonResponse($this->fractal->createData($resourse));
    }

    /**
     * @Route("/create", methods={"POST"})
     */
    public function create(Request $request): JsonResponse
    {
        $user = json_decode($request->getContent(), true);
        $dto = CreateUser::fromRequest($user);
        $errors = $this->validateDto($dto);

        if (count($errors) > 0) {
            return new JsonResponse($errors, JsonResponse::HTTP_BAD_REQUEST);
        }

        $user = $this->userInterface->create($dto);

        return $this->getJsonResponse($user, new UserTransformer(), JsonResponse::HTTP_OK);
    }

    /**
     * @Route("/{id}/delete", methods={"POST"})
     */
    public function delete(int $id): JsonResponse
    {
        $this->userInterface->delete($id);

        return $this->getEmptyJsonResponse(JsonResponse::HTTP_NO_CONTENT);
    }

    /**
     * @Route("/{id}", methods={"GET"})
     */
    public function getById(int $id): JsonResponse
    {
        $user = $this->userInterface->getById($id);

        return $this->getJsonResponse($user, new UserTransformer());
    }
}
