<?php

namespace App\Controller;

use App\Model\AccessoryManager;
use App\Model\FieldManager;
use App\Model\RobotManager;

class WorkshopController extends AbstractController
{
    public function index()
    {
        $accessoryManager = new AccessoryManager();
        $accessories = $accessoryManager->selectAllAccessories();

        $robotManager = new RobotManager();
        $robots = $robotManager->selectAllRobots();

        $fieldManager = new FieldManager();
        $fields = $fieldManager->selectAllFields();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            var_dump($_POST);
            die;
        }

        return $this->twig->render('Workshop/index.html.twig', [
            'accessories' => $accessories,
            'robots' => $robots,
            'fields' => $fields,
        ]);
    }
}
