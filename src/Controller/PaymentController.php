<?php

namespace App\Controller;

use App\Service\PaymentInterface;
use App\Transformer\PaymentTransformer;
use League\Fractal\Manager;
use League\Fractal\Resource\Collection;
use League\Fractal\Resource\Item;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/payment")
 */
final class PaymentController extends AbstractController
{
    private PaymentInterface $paymentInterface;
    private Manager $fractal;

    public function __construct(PaymentInterface $paymentInterface)
    {
        $this->paymentInterface = $paymentInterface;
        $this->fractal = new Manager();
    }

    /**
     * @Route("/{id}", methods={"GET"})
     */
    public function getById(int $id): JsonResponse
    {
        $payment = $this->paymentInterface->getById($id);
        $resourse = new Item($payment, new PaymentTransformer());

        return new JsonResponse($this->fractal->createData($resourse));
    }

    /**
     * @Route("/", methods={"GET"})
     */
    public function list(): JsonResponse
    {
        $payment = $this->paymentInterface->getList();
        $resourse = new Collection($payment, new PaymentTransformer());

        return new JsonResponse($this->fractal->createData($resourse));
    }
}
