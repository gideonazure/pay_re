<?php

namespace App\Service;

use League\Fractal\Manager;
use League\Fractal\Resource\Collection;
use League\Fractal\Resource\Item;

class ResponseService
{
    protected Manager $fractal;

    public function __construct()
    {
        $this->fractal = new Manager();
    }

    public function getItemResponseData($entity, $transformer)
    {
        $resourse = new Item($entity, $transformer);

        return $this->fractal->createData($resourse);
    }

    public function getCollectionResponseData($entity, $transformer)
    {
        $resourse = new Collection($entity, $transformer);

        return $this->fractal->createData($resourse);
    }
}
