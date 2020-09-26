<?php

namespace App\Service;

use Symfony\Component\Validator\Validator\ValidatorInterface;

class ValidationService
{
    protected ValidatorInterface $validator;

    public function __construct(ValidatorInterface $validator)
    {
        $this->validator = $validator;
    }

    public function validateDto($dto): array
    {
        $vialations = $this->validator->validate($dto);
        $errors = [];

        if (count($vialations) > 0) {
            foreach ($vialations as $vialation) {
                $errors[] = $this->getValidatorErrorInfo($vialation);
            }
        }

        return $errors;
    }

    public function getValidatorErrorInfo($error): array
    {
        return [
            'property' => $error->getPropertyPath(),
            'message' => $error->getMessage(),
            'code' => $error->getCode(),
        ];
    }

    public function getExceptionErrorInfo($error): array
    {
        return [
            'message' => $error->getMessage(),
            'code' => $error->getCode(),
        ];
    }
}
