<?php

namespace App\Controller;

class JourneyController extends AbstractController
{
    public function index()
    {
        return $this->twig->render('Journey/index.html.twig');
    }
}
