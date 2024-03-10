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

    public function createContact(Contact $contact): Contact
    {
        $this->contactRepository->create($contact);

        return $this->contactRepository->find($contact->id);
    }

    public function updateContact(string $id, Contact $contact): Contact
    {
        $this->contactRepository->update($id, $contact);

        return $this->contactRepository->find($id);
    }
}
