<?php

/**
 * Created by PhpStorm.
 * User: aurelwcs
 * Date: 08/04/19
 * Time: 18:40
 */

namespace App\Controller;

use App\Model\FilmManager;

class HomeController extends AbstractController
{

    /**
     * Display home page
     *
     * @return string
     * @throws \Twig\Error\LoaderError
     * @throws \Twig\Error\RuntimeError
     * @throws \Twig\Error\SyntaxError
     */
    public function index()
    {       
        $filmManager = new FilmManager();

        $filmsEnSalle = $filmManager->selectAllEnSalle();
        shuffle($filmsEnSalle);
        $filmsEnSalle = array_slice($filmsEnSalle,0,3);

        $filmsProchainement = $filmManager->selectAllProchainement();
        shuffle($filmsProchainement);
        $filmsProchainement = array_slice($filmsProchainement,0,3);



        return $this->twig->render('Home/index.html.twig',
        [
            'filmsEnSalle' => $filmsEnSalle,
            'filmsProchainement' => $filmsProchainement
        
        ]);
    }
}