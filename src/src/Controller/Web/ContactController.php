<?php

namespace App\Controller\Web;

use ContactManagementService;
use MemoryContactRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ContactController extends AbstractController
{
    #[Route("/contact", name: "contact_list")]
    public function get(): Response
    {
        $contactRepository = new MemoryContactRepository();
        $contactService = new ContactManagementService($contactRepository);

        $contacts = $contactService->getContacts();

        return $this->render("contact/list.html.twig", [
            "contacts" => $contacts,
        ]);
    }

    #[Route("/contact/{id}", name: "contact_detail")]
    public function getOne(string $id): Response
    {
        $contactRepository = new MemoryContactRepository();
        $contactService = new ContactManagementService($contactRepository);

        $contact = $contactService->getContact($id);

        return $this->render("contact/detail.html.twig", [
            "contact" => $contact,
        ]);
    }
}
