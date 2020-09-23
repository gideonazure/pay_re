<?php

namespace App\Controller;

use App\Service\PaymentTypesInterface;
use App\Transformer\PaymentTypesTransformer;
use League\Fractal\Manager;
use League\Fractal\Resource\Collection;
use League\Fractal\Resource\Item;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/payment_types")
 */
final class PaymentTypesController extends AbstractController
{
    private PaymentTypesInterface $paymentTypesInterface;
    private Manager $fractal;

    public function __construct(PaymentTypesInterface $paymentTypesInterface)
    {
        $this->paymentTypesInterface = $paymentTypesInterface;
        $this->fractal = new Manager();
    }

    /**
     * @Route("/", methods={"GET"})
     */
    public function list(): JsonResponse
    {
        $paymentTypes = $this->paymentTypesInterface->getList();
        $resourse = new Collection($paymentTypes, new PaymentTypesTransformer());

        return new JsonResponse($this->fractal->createData($resourse));
    }


    /**
     * @Route("/{id}", methods={"GET"})
     */
    public function getById(int $id): JsonResponse
    {
        $paymentTypes = $this->paymentTypesInterface->getById($id);
        $resourse = new Item($paymentTypes, new PaymentTypesTransformer());

        return new JsonResponse($this->fractal->createData($resourse));
    }

}
