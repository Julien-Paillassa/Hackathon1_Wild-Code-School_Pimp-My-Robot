<?php

namespace App\Controller;

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
        $destinationFieldId = $_SESSION['round'] + 1;
        $equippedAccessories = $_SESSION['equippedAccessories'];
        $eqAccId = [];
        foreach ($equippedAccessories as $equippedAccessory) {
            $eqAccId[] = intval($equippedAccessory['id']);
        }
        $state = false;
        switch ($destinationFieldId) {
            case 2:
                if (in_array(1, $eqAccId) && count($eqAccId) === 1) {
                    $state = true;
                }
                break;
            case 3:
                if (in_array(1, $eqAccId) && in_array(2, $eqAccId)) {
                    $state = true;
                }
                break;
            case 4:
                if (in_array(3, $eqAccId) && count($eqAccId) === 1) {
                    $state = true;
                }
                break;
            case 5:
                if (in_array(4, $eqAccId) && count($eqAccId) === 1) {
                    $state = true;
                }
                break;
            case 6:
                if (in_array(5, $eqAccId) && in_array(6, $eqAccId)) {
                    $state = true;
                }
                break;
        }

        $situationReport = '/###===###/ ERROR 404 : TERRAIN IMPRATICABLE /###===###/';
        if ($state) {
            $situationReport = '/###===###/ MSG 200 : TERRAIN FRANCHI ! /###===###/';
            $_SESSION['round']++;
        }
        return $this->twig->render('Result/index.html.twig', [
            'state'   => $state,
            'message' => $situationReport,
        ]);
    }
}
