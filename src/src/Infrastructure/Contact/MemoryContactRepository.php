<?php

namespace App\Infrastructure\Contact;

use App\Domain\Contact\ContactRepository;
use App\Domain\Contact\Contact;
use App\Domain\Contact\ContactCollection;

class MemoryContactRepository implements ContactRepository
{
    public function find(string $id): Contact
    {
        return $this->contacts()[$id];
    }

    public function findAll(): ContactCollection
    {
        $contactCollection = new ContactCollection();

        foreach ($this->contacts() as $key => $contact) {
            $contactCollection->add($contact);
        }

        return $contactCollection;
    }

    private function contacts(): array
    {
        return [
            "0000004JFGQ5ZY01Y9JAK0ZSA9" => new Contact(
                "0000004JFGQ5ZY01Y9JAK0ZSA9",
                "First",
                "Last",
                "first.last@example.com"
            ),
            "0000004JFGDXXSHJV5YKNZJFEY" => new Contact(
                "0000004JFGDXXSHJV5YKNZJFEY",
                "Aart",
                "Appeltaart",
                "aart.appeltaart@example.com"
            ),
        ];
    }
}
