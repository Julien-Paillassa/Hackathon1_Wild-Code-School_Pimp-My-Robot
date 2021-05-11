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

        var_dump($fields);
        var_dump($robots);
        var_dump($accessories);

        return $this->twig->render('Workshop/index.html.twig', [
            'accessories' => $accessories,
            'robots' => $robots,
            'fields' => $fields,
        ]);
    }
}
