<?php

namespace App\Domain\Contact;

interface ContactRepository
{
    public function find(string $id): Contact;
    public function findAll(): ContactCollection;
    public function update(string $id, Contact $contact): void;
}
