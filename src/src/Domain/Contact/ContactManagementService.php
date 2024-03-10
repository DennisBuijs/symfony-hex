<?php

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
}
