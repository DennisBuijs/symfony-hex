<?php

namespace App\Controller\Api;

use App\Domain\Contact\ContactManagementService;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;

class ContactController extends AbstractController
{
    public function __construct(
        private ContactManagementService $contactManagementService
    ) {
    }

    #[Route("/api/contact")]
    public function get(): Response
    {
        $contacts = $this->contactManagementService->getContacts();

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
        $contact = $this->contactManagementService->getContact($id);

        return new JsonResponse($contact);
    }
}
