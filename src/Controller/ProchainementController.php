<?php

/**
 * Created by PhpStorm.
 * User: aurelwcs
 * Date: 08/04/19
 * Time: 18:40
 */

namespace App\Controller;

use App\Model\FilmManager;

class ProchainementController extends AbstractController
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

        $filmsProchainement = $filmManager->selectAllProchainement();
        shuffle($filmsProchainement);
        
        return $this->twig->render('Prochainement/index.html.twig',
        [
            'filmsProchainement' => $filmsProchainement
        ]);
    }
}