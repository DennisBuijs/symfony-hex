<?php

namespace App\Controller\Api;

use ContactManagementService;
use MemoryContactRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;

class ContactController extends AbstractController
{
    #[Route("/api/contact")]
    public function get(): Response
    {
        $contactRepository = new MemoryContactRepository();
        $contactService = new ContactManagementService($contactRepository);

        $contacts = $contactService->getContacts();

        $contactsAsArray = [];
        foreach ($contacts as $contact) {
            $contactsAsArray[] = [
                "id" => $contact->id,
                "firstName" => $contact->firstName,
                "lastName" => $contact->lastName,
            ];
        }

        return new JsonResponse($contactsAsArray);
    }

    #[Route("/api/contact/{id}")]
    public function getOne(string $id): Response
    {
        $contactRepository = new MemoryContactRepository();
        $contactService = new ContactManagementService($contactRepository);

        $contact = $contactService->getContact($id);

        return new JsonResponse($contact);
    }
}
