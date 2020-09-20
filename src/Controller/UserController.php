<?php

namespace App\Controller;

use App\Service\UserInterface;
use App\Transformer\UserTransformer;
use League\Fractal\Manager;
use League\Fractal\Resource\Collection;
use League\Fractal\Resource\Item;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/user")
 */
final class UserController extends AbstractController
{
    private UserInterface $userInterface;
    private Manager $fractal;

    public function __construct(UserInterface $userInterface)
    {
        $this->userInterface = $userInterface;
        $this->fractal = new Manager();
    }

    /**
     * @Route("/{id}", methods={"GET"})
     */
    public function getById(int $id): JsonResponse
    {
        $user = $this->userInterface->getById($id);
        $resourse = new Item($user, new UserTransformer());

        return new JsonResponse($this->fractal->createData($resourse));
    }
//
//    /**
//     * @Route("/{login}", methods={"GET"})
//     */
//    public function getByUsername(string $login): JsonResponse
//    {
//        $user = $this->userInterface->getByLogin($login);
//
//        return new JsonResponse([
//            'some' => 1,
//            'another' => 2,
//        ]);
//    }

    /**
     * @Route("/", methods={"GET"})
     */
    public function list(): JsonResponse
    {
        $user = $this->userInterface->getList();
        $resourse = new Collection($user, new UserTransformer());
        return new JsonResponse($this->fractal->createData($resourse));
    }
}
