<?php

namespace App\Controller\Web;

use ContactManagementService;
use MemoryContactRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ContactController extends AbstractController
{
    #[Route("/contact")]
    public function get(): Response
    {
        $contactRepository = new MemoryContactRepository();
        $contactService = new ContactManagementService($contactRepository);

        $contacts = $contactService->getContacts();

        return $this->render("contact/list.html.twig", [
            "contacts" => $contacts,
        ]);
    }
}
