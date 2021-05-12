<?php

namespace App\Controller;

use App\Model\FieldManager;
use App\Model\AccessoryManager;

class ResultController extends AbstractController
{
    /*acc
     1 - chenilles
     2 - drill
     3 - helice
     4 - patins
     5 - rocket
     6 - roues
     */
    /* fields
     2 - montagnes -> 1 seul
     3 - tempête -> 1 & 2
     4 - crevasse -> 3 seul
     5 - glace -> 4 seul
     6 - robot -> 5 & 6
     */

    public function index()
    {
        $situationReport = '/###===###/ ERROR 404 : TERRAIN IMPASSABLE /###===###/';
        $destinationFieldId = $_SESSION['round'] + 1;
        $equippedAccessories = $_SESSION['equippedAccessories'];
        $eqAccId = [];
        $eqAccTop = [];
        $eqAccBottom = [];
        foreach ($equippedAccessories as $equippedAccessory) {
            $eqAccId[] = intval($equippedAccessory['id']);
            if ($equippedAccessory['emplacement'] === 'top') {
                $eqAccTop[] = intval($equippedAccessory['id']);
            } else {
                $eqAccBottom[] = intval($equippedAccessory['id']);
            }
        }
        $state = false;
        if (count($eqAccBottom) >= 2 || count($eqAccTop) >= 2) {
            if (count($eqAccBottom) >= 2) {
                $situationReport .= 'OVER EQUIPPED ROBOT ON THE BOTTOM - IMPOSSIBLE TO MOVE /###===###/';
            }
            if (count($eqAccTop) >= 2) {
                $situationReport .= 'OVER EQUIPPED ROBOT ON THE TOP - IMPOSSIBLE TO MOVE /###===###/';
            }
        } else {
            switch ($destinationFieldId) {
                case 2:
                    if (in_array(1, $eqAccId) && count($eqAccId) === 1) {
                        $state = true;
                    } else {
                        if (!empty($eqAccTop)) {
                            $situationReport .= 'OVER EQUIPPED ROBOT ON THE TOP - IMPOSSIBLE TO MOVE /###===###/';
                        }
                    }
                    break;
                case 3:
                    if (in_array(1, $eqAccId) && in_array(2, $eqAccId)) {
                        $state = true;
                    } elseif (!in_array(1,$eqAccBottom)) {
                        $situationReport .= 'IMPOSSIBLE TO MOVE CORRECTLY WITH THIS BOTTOM EQUIPMENT/###===###/';
                    }
                    if (!in_array(2,$eqAccTop)) {
                        $situationReport .= 'IMPOSSIBLE TO DIG/###===###/';
                    }
                    break;
                case 4:
                    if (in_array(3, $eqAccId) && count($eqAccId) === 1) {
                        $state = true;
                    } elseif (!empty($eqAccBottom)) {
                        $situationReport .= 'OVER EQUIPPED ROBOT ON THE BOTTOM - IMPOSSIBLE TO MOVE /###===###/';
                    }
                    break;
                case 5:
                    if (in_array(4, $eqAccId) && count($eqAccId) === 1) {
                        $state = true;
                    } elseif (!empty($eqAccTop)) {
                        $situationReport .= 'OVER EQUIPPED ROBOT ON THE TOP - IMPOSSIBLE TO MOVE /###===###/';
                    }
                    break;
                case 6:
                    if (in_array(5, $eqAccId) && in_array(6, $eqAccId)) {
                        $state = true;
                    } elseif (!in_array(6, $eqAccBottom)) {
                        $situationReport .= 'HAVE TO MOVE FAST !! /###===###/';
                    }
                    break;
            }
        }
        $fieldManager = new FieldManager();
        $fieldManager->selectFieldById($_SESSION['round']);
        $field = $fieldManager->selectFieldById($_SESSION['round'] + 1);

        if ($state) {
            $situationReport = '/###===###/ MSG 200 : LAND CROSSED ! /###===###/';
            $_SESSION['round']++;
        }
        return $this->twig->render('Result/index.html.twig', [
            'state'   => $state,
            'message' => $situationReport,
            'field' => $field,
            'equipement' => $equippedAccessories,
        ]);
    }
}
