<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class ContactController
{
    #[Route("/contact")]
    public function get(): Response
    {
        return new Response("<h1>Contact</h1>");
    }
}
