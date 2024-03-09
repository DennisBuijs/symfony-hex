<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ContactController extends AbstractController
{
    #[Route("/contact")]
    public function get(): Response
    {
        return $this->render("contact/list.html.twig", [
            "contacts" => [["first_name" => "Piet", "last_name" => "Friet"]],
        ]);
    }
}
