<?php

namespace App\Controller;

use App\Service\RemindersInterface;
use App\Transformer\RemindersTransformer;
use League\Fractal\Manager;
use League\Fractal\Resource\Collection;
use League\Fractal\Resource\Item;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/reminders")
 */
final class RemindersController extends AbstractController
{
    private RemindersInterface $remindersInterface;
    private Manager $fractal;

    public function __construct(RemindersInterface $remindersInterface)
    {
        $this->remindersInterface = $remindersInterface;
        $this->fractal = new Manager();
    }

    /**
     * @Route("/{id}", methods={"GET"})
     */
    public function getById(int $id): JsonResponse
    {
        $reminders = $this->remindersInterface->getById($id);
        $resourse = new Item($reminders, new RemindersTransformer());

        return new JsonResponse($this->fractal->createData($resourse));
    }


    /**
     * @Route("/", methods={"GET"})
     */
    public function list(): JsonResponse
    {
        $reminders = $this->remindersInterface->getList();
        $resourse = new Collection($reminders, new RemindersTransformer());
        return new JsonResponse($this->fractal->createData($resourse));
    }
}
