<?php

namespace App\Controller;

use App\Model\AccessoryManager;
use App\Model\FieldManager;
use App\Model\RobotManager;

class JourneyController extends AbstractController
{
    public function index()
    {
        $robotManager = new RobotManager();
        $robots = $robotManager->selectAllRobots();
        $equippedAccessories = [];
        $_SESSION['journeyIsPreviousPage'] = true;
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (!isset($_POST['equipments'])) {
                header('Location: /Workshop/index');
                die;
            }
            $_SESSION['journeyIsPreviousPage'] = false;
            $fieldManager = new FieldManager();
            $startingField = $fieldManager->selectFieldById($_POST['startingField']);
            $nextField = $fieldManager->selectFieldById($_POST['nextField']);
            foreach ($_POST['equipments'] as $equipmentId) {
                $accessoryManager = new AccessoryManager();
                $equippedAccessories[] = $accessoryManager->getAccessoryById($equipmentId);
            }
        }
        return $this->twig->render('Journey/index.html.twig', [
            'session' => $_SESSION,
            'equippedAccessories' => $equippedAccessories,
            'robots' => $robots,
            'startingField' => $startingField,
            'nextField' => $nextField,
        ]);
    }
}
