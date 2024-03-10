<?php

class Contact
{
    public function __construct(
        public readonly string $firstName,
        public readonly string $lastName
    ) {
    }
}
