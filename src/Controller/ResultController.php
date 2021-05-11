<?php

namespace App\Controller;

class ResultController extends AbstractController
{
    public function index()
    {
        return $this->twig->render('Result/index.html.twig');
    }
}
