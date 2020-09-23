<?php

namespace App\Controller;

use League\Fractal\Manager;
use League\Fractal\Resource\Item;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Validator\Validator\ValidatorInterface;

abstract class BaseController extends AbstractController
{
    protected Manager $fractal;
    protected ValidatorInterface $validator;

    public function __construct(
        ValidatorInterface $validator
    ) {
        $this->fractal = new Manager();
        $this->validator = $validator;
    }

    protected function getJsonResponse($entity, $transformer, $status): JsonResponse
    {
        $resource = new Item($entity, $transformer);

        return new JsonResponse($this->fractal->createData($resource), $status);
    }

    protected function getEmptyJsonResponse($status): JsonResponse
    {
        return new JsonResponse(null, $status);
    }

    protected function validateDto($dto): array
    {
        $vialations = $this->validator->validate($dto);
        $errors = [];

        if (count($vialations) > 0) {
            foreach ($vialations as $vialation) {
                $errors[] = [
                    'property' => $vialation->getPropertyPath(),
                    'message' => $vialation->getMessage(),
                    'code' => $vialation->getCode(),
                ];
            }
        }

        return $errors;
    }
}
