<?php

namespace App\Controller;

use App\Model\SeanceManager;
use App\Model\HoraireManager;
use App\Model\FilmManager;



class SeanceController extends AbstractController
{


    public function list()
    {
        $seanceManager = new SeanceManager();
        $filmManager = new FilmManager();
        $horaireManager = new HoraireManager();


        $now = $horaireManager->getActual();

        $seances = $seanceManager->selectAll();
        // echo '<pre>', var_dump($now), '</pre>';


        $films = $filmManager->selectAll();

        return $this->twig->render(
            'Seance/list.html.twig',
            [
                'now' => $now,
                'seances' => $seances,
                'films' => $films,
            ]
        );
    }

    public function show($id)
    {
        $seanceManager = new SeanceManager();
        $seance = $seanceManager->selectSeanceById($id);

        $filmManager = new FilmManager();
        $film = $filmManager->selectOneById($seance['id_film']);


        // echo '<pre>', var_dump($seance), '</pre>';




        return $this->twig->render(
            'Seance/show.html.twig',
            [
                'film' => $film,
                'seance' => $seance,
            ]
        );
    }
}