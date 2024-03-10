<?php

namespace App\Controller\Web;

use App\Domain\Contact\ContactManagementService;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

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

    #[Route("/contact/{id}", name: "contact_detail")]
    public function getOne(string $id): Response
    {
        $contact = $this->contactManagementService->getContact($id);

        return $this->render("contact/detail.html.twig", [
            "contact" => $contact,
        ]);
    }
}
