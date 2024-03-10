<?php

class ContactCollection implements IteratorAggregate
{
    private array $contacts = [];

    public function add(Contact $contact): void
    {
        $this->contacts[] = $contact;
    }

    public function getIterator(): ArrayIterator
    {
        return new ArrayIterator($this->contacts);
    }
}
