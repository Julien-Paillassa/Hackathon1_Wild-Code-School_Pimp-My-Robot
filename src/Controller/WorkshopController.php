<?php

namespace App\Controller;

class WorkshopController extends AbstractController
{
    public function index()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        }
        return $this->twig->render('Workshop/index.html.twig');
    }
}
