<?php

namespace App\Controller;

class FinalController extends AbstractController
{
    public function index()
    {
        return $this->twig->render('Success/final.html.twig');
    }
}
