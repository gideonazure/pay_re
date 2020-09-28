<?php

namespace App\Controller;

use App\DTO\PaymentDTO;
use App\Service\PaymentInterface;
use App\Service\ValidationService as ValidationService;
use App\Service\ResponseService as ResponseService;
use App\Transformer\PaymentTransformer;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/payment")
 */
final class PaymentController extends AbstractController
{
    private PaymentInterface $paymentInterface;
    private ValidationService $validationService;
    private ResponseService $responseService;

    public function __construct(
        PaymentInterface $paymentInterface,
        ValidationService $validationService,
        ResponseService $responseService
    ) {
        $this->paymentInterface = $paymentInterface;
        $this->validationService = $validationService;
        $this->responseService = $responseService;
    }


    /**
     * @Route("/", methods={"GET"})
     */
    public function list(): JsonResponse
    {
        $payment = $this->paymentInterface->getList();
        $responseData = $this->responseService->getCollectionResponseData($payment, new PaymentTransformer());

        return new JsonResponse($responseData, JsonResponse::HTTP_OK);
    }

    /**
     * @Route("/create", methods={"POST"})
     * @param Request $request
     * @return JsonResponse
     */
    public function create(Request $request): JsonResponse
    {
        $payment = json_decode($request->getContent(), true);
        $dto = PaymentDTO::fromRequest($payment);
        $errors = $this->validationService->validateDto($dto);

        if (count($errors) > 0) {
            return new JsonResponse($errors, JsonResponse::HTTP_BAD_REQUEST);
        }

        $payment = $this->paymentInterface->create($dto);
        $responseData = $this->responseService->getItemResponseData($payment, new PaymentTransformer());

        return new JsonResponse($responseData, JsonResponse::HTTP_OK);
    }

    /**
     * @Route("/{id}", methods={"GET"})
     * @param int $id
     * @return JsonResponse
     */
    public function getById(int $id): JsonResponse
    {
        $payment = $this->paymentInterface->getById($id);
        $responseData = $this->responseService->getItemResponseData($payment, new PaymentTransformer());

        return new JsonResponse($responseData, JsonResponse::HTTP_OK);

    }

}
