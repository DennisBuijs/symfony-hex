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
                "firstName" => $contact->firstName,
                "lastName" => $contact->lastName,
            ];
        }

        return new JsonResponse($contactsAsArray);
    }
}
