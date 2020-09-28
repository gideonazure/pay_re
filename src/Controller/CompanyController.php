<?php

namespace App\Controller;

use App\DTO\CompanyDTO;
use App\Service\CompanyInterface;
use App\Service\ResponseService;
use App\Service\ValidationService;
use App\Transformer\CompanyTransformer;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/company")
 */
final class CompanyController extends AbstractController
{
    private CompanyInterface $companyInterface;
    private ValidationService $validationService;
    private ResponseService $responseService;

    public function __construct(
        CompanyInterface $companyInterface,
        ValidationService $validationService,
        ResponseService $responseService
    ) {
        $this->companyInterface = $companyInterface;
        $this->validationService = $validationService;
        $this->responseService = $responseService;
    }

    /**
     * @Route(methods={"GET"})
     */
    public function list(): JsonResponse
    {
        $company = $this->companyInterface->getList();
        $responseData = $this->responseService->getCollectionResponseData($company, new CompanyTransformer());

        return new JsonResponse($responseData, JsonResponse::HTTP_OK);
    }

    /**
     * @Route("/create", methods={"POST"})
     * @param Request $request
     * @return JsonResponse
     */
    public function create(Request $request): JsonResponse
    {
        $company = json_decode($request->getContent(), true);
        $dto = CompanyDTO::fromRequest($company);
        $errors = $this->validationService->validateDto($dto);

        if (count($errors) > 0) {
            return new JsonResponse($errors, JsonResponse::HTTP_BAD_REQUEST);
        }

        $company = $this->companyInterface->create($dto);
        $responseData = $this->responseService->getItemResponseData($company, new CompanyTransformer());

        return new JsonResponse($responseData, JsonResponse::HTTP_OK);
    }

    /**
     * @Route("/{id}/delete", methods={"POST"})
     * @param int $id
     * @return JsonResponse
     */
    public function delete(int $id): JsonResponse
    {
        $this->companyInterface->delete($id);

        return new JsonResponse(null, JsonResponse::HTTP_NO_CONTENT);
    }

    /**
     * @Route("/{id}/update", methods={"POST"})
     * @param int $id
     * @param Request $request
     * @return JsonResponse
     */
    public function update(int $id, Request $request): JsonResponse
    {
        $company = json_decode($request->getContent(), true);
        $dto = CompanyDTO::fromRequest($company);
        $errors = $this->validationService->validateDto($dto);

        if (count($errors) > 0) {
            return new JsonResponse($errors, JsonResponse::HTTP_BAD_REQUEST);
        }

        try {
            $company = $this->companyInterface->update($id, $dto);
            $responseData = $this->responseService->getItemResponseData($company, new CompanyTransformer());

            return new JsonResponse($responseData, JsonResponse::HTTP_OK);
        } catch (\Exception $e) {
            $errors = $this->validationService->getExceptionErrorInfo($e);

            return new JsonResponse($errors, JsonResponse::HTTP_BAD_REQUEST);
        }
    }

    /**
     * @Route("/{id}", methods={"GET"})
     * @param int $id
     * @return JsonResponse
     */
    public function getById(int $id): JsonResponse
    {
        $company = $this->companyInterface->getById($id);
        $responseData = $this->responseService->getItemResponseData($company, new CompanyTransformer());

        return new JsonResponse($responseData, JsonResponse::HTTP_OK);
    }
}
