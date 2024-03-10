<?php

namespace App\Domain\Contact;

class ContactManagementService
{
    public function __construct(
        private readonly ContactRepository $contactRepository
    ) {
    }

    public function getContacts(): ContactCollection
    {
        return $this->contactRepository->findAll();
    }

    public function getContact(string $id): Contact
    {
        return $this->contactRepository->find($id);
    }
}
