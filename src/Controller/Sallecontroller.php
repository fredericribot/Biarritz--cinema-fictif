<?php

namespace App\Controller;

use App\Model\SalleManager;

class SalleController extends AbstractController
{

    public function list()
    {
        $salleManager = new SalleManager();
        $salles = $salleManager->selectAll();

        return $this->twig->render(
            'Salle/list.html.twig',
            ['salles' => $salles]
        );
    }
}