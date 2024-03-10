<?php

namespace App\Infrastructure\Contact;

use App\Domain\Contact\ContactRepository;
use App\Domain\Contact\Contact;
use App\Domain\Contact\ContactCollection;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\DBAL\Connection;

class SqliteContactRepository implements ContactRepository
{
    private Connection $db;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->db = $entityManager->getConnection();
    }

    public function find(string $id): Contact
    {
        $query = $this->db->executeQuery('SELECT * FROM contacts WHERE id = "' . $id . '"');
        $row = $query->fetchAssociative();

        return new Contact(
            $row['id'],
            $row['first_name'],
            $row['last_name'],
            $row['email']
        );
    }

    public function findAll(): ContactCollection
    {
        $query = $this->db->executeQuery('SELECT * FROM contacts');
        $rows = $query->fetchAllAssociative();

        $contactCollection = new ContactCollection();

        foreach ($rows as $row) {
            $contactCollection->add(new Contact(
                $row['id'],
                $row['first_name'],
                $row['last_name'],
                $row['email']
            ));
        }

        return $contactCollection;
    }

    public function create(Contact $contact): void
    {
        $this->db->executeStatement("
            INSERT INTO contacts (id, first_name, last_name, email, created_at, updated_at)
            VALUES (?, ?, ?, ?, 'NOW', CURRENT_TIMESTAMP);
        ", [
            $contact->id,
            $contact->firstName,
            $contact->lastName,
            $contact->email
        ]);
    }
    
    public function update(string $id, Contact $contact): void
    {
        $this->db->executeStatement("
            UPDATE contacts
            SET first_name = ?, last_name = ?, email = ?, updated_at = CURRENT_TIMESTAMP
            WHERE id = ?;
        ", [
            $contact->firstName,
            $contact->lastName,
            $contact->email,
            $id
        ]);
    }
}
