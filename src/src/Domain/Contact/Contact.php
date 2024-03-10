<?php

namespace App\Domain\Contact;

class Contact
{
    public function __construct(
        public readonly string $id,
        public readonly string $firstName,
        public readonly string $lastName,
        public readonly string $email
    ) {
    }
}
