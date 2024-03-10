<?php

interface ContactRepository
{
    public function find(string $id): Contact;
    public function findAll(): ContactCollection;
}
