<?php

namespace App\Controller;

use App\DTO\PaymentTypesDTO;
use App\Service\PaymentTypesInterface;
use App\Service\ResponseService;
use App\Service\ValidationService;
use App\Transformer\PaymentTypesTransformer;
use League\Fractal\Manager;
use League\Fractal\Resource\Collection;
use League\Fractal\Resource\Item;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/paymentTypes_types")
 */
final class PaymentTypesController extends AbstractController
{
    private PaymentTypesInterface $paymentTypesInterface;
    private ValidationService $validationService;
    private ResponseService $responseService;

    public function __construct(
        PaymentTypesInterface $paymentTypesInterface,
        ValidationService $validationService,
        ResponseService $responseService
    ) {
        $this->paymentTypesInterface = $paymentTypesInterface;
        $this->validationService = $validationService;
        $this->responseService = $responseService;
    }

    /**
     * @Route(methods={"GET"})
     */
    public function list(): JsonResponse
    {
        $paymentTypes = $this->paymentTypesInterface->getList();
        $responseData = $this->responseService->getCollectionResponseData($paymentTypes, new CompanyTransformer());

        return new JsonResponse($responseData, JsonResponse::HTTP_OK);
    }

    /**
     * @Route("/create", methods={"POST"})
     * @param Request $request
     * @return JsonResponse
     */
    public function create(Request $request): JsonResponse
    {
        $paymentTypes = json_decode($request->getContent(), true);
        $dto = PaymentTypesDTO::fromRequest($paymentTypes);
        $errors = $this->validationService->validateDto($dto);

        if (count($errors) > 0) {
            return new JsonResponse($errors, JsonResponse::HTTP_BAD_REQUEST);
        }

        $paymentTypes = $this->paymentTypesInterface->create($dto);
        $responseData = $this->responseService->getItemResponseData($paymentTypes, new CompanyTransformer());

        return new JsonResponse($responseData, JsonResponse::HTTP_OK);
    }

    /**
     * @Route("/{id}/delete", methods={"POST"})
     * @param int $id
     * @return JsonResponse
     */
    public function delete(int $id): JsonResponse
    {
        $this->paymentTypesInterface->delete($id);

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
        $paymentTypes = json_decode($request->getContent(), true);
        $dto = PaymentTypesDTO::fromRequest($paymentTypes);
        $errors = $this->validationService->validateDto($dto);

        if (count($errors) > 0) {
            return new JsonResponse($errors, JsonResponse::HTTP_BAD_REQUEST);
        }

        try {
            $paymentTypes = $this->paymentTypesInterface->update($id, $dto);
            $responseData = $this->responseService->getItemResponseData($paymentTypes, new CompanyTransformer());

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
        $paymentTypes = $this->paymentTypesInterface->getById($id);
        $responseData = $this->responseService->getItemResponseData($paymentTypes, new CompanyTransformer());

        return new JsonResponse($responseData, JsonResponse::HTTP_OK);
    }
}
