<?php

namespace App\Controller;

use App\Model\AccessoryManager;
use App\Model\FieldManager;
use App\Model\RobotManager;

class WorkshopController extends AbstractController
{
    public const MAX_ROUNDS = 6;
    public function index()
    {
        if ($_SESSION['round'] >= self::MAX_ROUNDS) {
            header('Location: /Final/index');
        }
        $accessoryManager = new AccessoryManager();
        $accessories = $accessoryManager->selectAllAccessories();

        $robotManager = new RobotManager();
        $robots = $robotManager->selectAllRobots();

        $fieldManager = new FieldManager();
        $startingField = $fieldManager->selectFieldById($_SESSION['round']);
        $nextField = $fieldManager->selectFieldById($_SESSION['round'] + 1);

        $equippedAccessories = [];
        $errors = [];

        if ($_SERVER['REQUEST_METHOD'] === 'POST' || $_SESSION['journeyIsPreviousPage']) {
            if (!isset($_POST['equipments'])) {
                $errors['errorEquipment'] = 'Veuillez équiper le robot avant de partir';
            } else {
                foreach ($_POST['equipments'] as $equipmentId) {
                    $equippedAccessories[] = $accessoryManager->getAccessoryById($equipmentId);
                }
            }
            $_SESSION['equippedAccessories'] = $equippedAccessories;
        }
        return $this->twig->render('Workshop/index.html.twig', [
            'session' => $_SESSION,
            'equippedAccessories' => $equippedAccessories,
            'accessories' => $accessories,
            'robots' => $robots,
            'startingField' => $startingField,
            'nextField' => $nextField,
            'errors' => $errors,
        ]);
    }
}
