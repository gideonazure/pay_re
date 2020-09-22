<?php

namespace App\Service;

use App\Entity\Attachments;
use App\Repository\AttachmentsRepository;

final class AttachmentsService implements AttachmentsInterface
{
    private AttachmentsRepository $attachmentsRepository;

    public function __construct(AttachmentsRepository $attachmentsRepository)
    {
        $this->attachmentsRepository = $attachmentsRepository;
    }

    public function getById(int $id): Attachments
    {
        return $this->attachmentsRepository->getById($id);
    }


    public function getList(): array
    {
        return $this->attachmentsRepository->getList();
    }
}
