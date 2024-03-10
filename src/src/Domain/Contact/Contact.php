<?php

namespace App\Domain\Contact;

use Ulid\Ulid;

class Contact
{
    public function __construct(
        public ?string $id,
        public readonly string $firstName,
        public readonly string $lastName,
        public readonly string $email
    ) {
        if (is_null($id)) {
            $this->id = Ulid::generate();
        }
    }
}
