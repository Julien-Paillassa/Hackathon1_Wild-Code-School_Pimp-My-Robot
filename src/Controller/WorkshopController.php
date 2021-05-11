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

        $equippedAccessories = [];
        $errors = [];

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (!isset($_POST['equipment'])) {
                $errors['errorEquipment'] = 'Veuillez choisir au moins un équipement';
            } else {
                foreach ($_POST['equipment'] as $equipmentId) {
                    $accessoryManager= new AccessoryManager();
                    $equippedAccessories = $accessoryManager->getAccessoryById($equipmentId);
                }
            }
            var_dump($equippedAccessories);die();
            if (empty($errors)) {
                return $this->twig->render('Workshop/index.html.twig', [
                    'equipments' => $equipments,
                    'accessories' => $accessories,
                    'robots' => $robots,
                    'fields' => $fields,
                ]);
            }
        }
        return $this->twig->render('Workshop/index.html.twig', [
            'accessories' => $accessories,
            'robots' => $robots,
            'fields' => $fields,
            'errors' => $errors,
        ]);
    }


    public function result()
    {

    }
}
