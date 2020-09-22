<?php

namespace App\Controller;

use App\Service\AttachmentsInterface;
use App\Transformer\AttachmentsTransformer;
use League\Fractal\Manager;
use League\Fractal\Resource\Collection;
use League\Fractal\Resource\Item;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/attachments")
 */
final class AttachmentsController extends AbstractController
{
    private AttachmentsInterface $attachmentsInterface;
    private Manager $fractal;

    public function __construct(AttachmentsInterface $attachmentsInterface)
    {
        $this->attachmentsInterface = $attachmentsInterface;
        $this->fractal = new Manager();
    }

    /**
     * @Route("/{id}", methods={"GET"})
     */
    public function getById(int $id): JsonResponse
    {
        $attachments = $this->attachmentsInterface->getById($id);
        $resourse = new Item($attachments, new AttachmentsTransformer());

        return new JsonResponse($this->fractal->createData($resourse));
    }


    /**
     * @Route("/", methods={"GET"})
     */
    public function list(): JsonResponse
    {
        $attachments = $this->attachmentsInterface->getList();
        $resourse = new Collection($attachments, new AttachmentsTransformer());
        return new JsonResponse($this->fractal->createData($resourse));
    }
}
