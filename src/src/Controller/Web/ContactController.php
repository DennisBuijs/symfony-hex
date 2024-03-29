<?php

namespace App\Controller\Web;

use App\Domain\Contact\Contact;
use App\Domain\Contact\ContactManagementService;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;

class ContactController extends AbstractController
{
    public function __construct(
        private ContactManagementService $contactManagementService
    ) {
    }

    #[Route("/contact", name: "contact_list")]
    public function get(): Response
    {
        $contacts = $this->contactManagementService->getContacts();

        return $this->render("contact/list.html.twig", [
            "contacts" => $contacts,
        ]);
    }

    #[Route("/contact/new", name: "contact_create", methods: ["GET"])]
    public function getCreate(): Response
    {
        return $this->render("contact/create.html.twig");
    }

    #[Route("/contact/new", name: "contact_create_submit", methods: ["POST"])]
    public function postCreate(Request $request): Response
    {
        $requestBody = $request->request;
        $contactBody = new Contact(null, $requestBody->get('firstName'), $requestBody->get('lastName'), $requestBody->get('email'));

        $contact = $this->contactManagementService->createContact($contactBody);

        return $this->redirect('/contact/' . $contact->id);
    }

    #[Route("/contact/{id}", name: "contact_detail")]
    public function getOne(string $id): Response
    {
        $contact = $this->contactManagementService->getContact($id);

        return $this->render("contact/detail.html.twig", [
            "contact" => $contact,
        ]);
    }

    #[Route("/contact/{id}/edit", name: "contact_edit", methods: ['GET'])]
    public function getEdit(string $id): Response
    {
        $contact = $this->contactManagementService->getContact($id);

        return $this->render("contact/edit.html.twig", [
            "contact" => $contact,
        ]);
    }

    #[Route("/contact/{id}/edit", name: "contact_edit_submit", methods: ["POST"])]
    public function postEdit(string $id, Request $request): Response
    {
        $requestBody = $request->request;
        $contactBody = new Contact($id, $requestBody->get('firstName'), $requestBody->get('lastName'), $requestBody->get('email'));

        $this->contactManagementService->updateContact($id, $contactBody);

        return $this->redirect('/contact/' . $id);
    }

    #[Route("/contact/{id}/delete", name: "contact_delete", methods: ["GET"])]
    public function delete(string $id, Request $request): Response
    {
        $this->contactManagementService->deleteContact($id);

        return $this->redirect('/contact/');
    }
}
