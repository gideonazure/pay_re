<?php

namespace App\Controller;

use App\Service\CompanyInterface;
use App\Transformer\CompanyTransformer;
use League\Fractal\Manager;
use League\Fractal\Resource\Collection;
use League\Fractal\Resource\Item;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/company")
 */
final class CompanyController extends AbstractController
{
    private CompanyInterface $companyInterface;
    private Manager $fractal;

    public function __construct(CompanyInterface $companyInterface)
    {
        $this->companyInterface = $companyInterface;
        $this->fractal = new Manager();
    }

    /**
     * @Route("/{id}", methods={"GET"})
     */
    public function getById(int $id): JsonResponse
    {
        $company = $this->companyInterface->getById($id);
        $resourse = new Item($company, new CompanyTransformer());

        return new JsonResponse($this->fractal->createData($resourse));
    }

    /**
     * @Route("/", methods={"GET"})
     */
    public function list(): JsonResponse
    {
        $company = $this->companyInterface->getList();
        $resourse = new Collection($company, new CompanyTransformer());

        return new JsonResponse($this->fractal->createData($resourse));
    }
}
