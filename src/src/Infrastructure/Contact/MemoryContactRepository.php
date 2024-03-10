<?php

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
            "0000004JFGQ5ZY01Y9JAK0ZSA9" => new Contact("First", "Last"),
            "0000004JFGDXXSHJV5YKNZJFEY" => new Contact("Aart", "Appeltaart"),
        ];
    }
}
