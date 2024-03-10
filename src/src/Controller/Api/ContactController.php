<?php

namespace App\Controller\Api;

use App\Domain\Contact\ContactManagementService;
use App\Domain\Contact\Contact;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

class ContactController extends AbstractController
{
    public function __construct(
        private ContactManagementService $contactManagementService
    ) {
    }

    #[Route("/api/contact", methods: ["GET"])]
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

    #[Route("/api/contact/{id}", methods: ["GET"])]
    public function getOne(string $id): Response
    {
        $contact = $this->contactManagementService->getContact($id);

        return new JsonResponse($contact);
    }

    #[Route("/api/contact", methods: ["POST"])]
    public function post(Request $request): Response
    {
        $requestBody = json_decode($request->getContent());
        $contactBody = new Contact(null, $requestBody->firstName, $requestBody->lastName, $requestBody->email);

        $contact = $this->contactManagementService->createContact($contactBody);

        return new JsonResponse($contact);
    }

    #[Route("/api/contact/{id}", methods: ["PUT"])]
    public function put(string $id, Request $request): Response
    {
        $requestBody = json_decode($request->getContent());
        $contactBody = new Contact($id, $requestBody->firstName, $requestBody->lastName, $requestBody->email);

        $contact = $this->contactManagementService->updateContact($id, $contactBody);

        return new JsonResponse($contact);
    }
}
