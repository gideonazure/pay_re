<?php

namespace App\Transformer;

use App\Entity\Company;
use League\Fractal\TransformerAbstract;

final class CompanyTransformer extends TransformerAbstract
{
    public function transform(Company $company): array
    {
        return [
            'name' => $company->getName(),
            'type' => $company->getType(),
            'cperson' => $company->getCperson(),
            'email' => $company->getEmail(),
            'phone' => $company->getPhone(),
            'address' => $company->getAddress(),
            'code' => $company->getCode(),
        ];
    }
}
