<?php

/**
 * Created by PhpStorm.
 * User: aurelwcs
 * Date: 08/04/19
 * Time: 18:40
 */

namespace App\Controller;

use App\Model\FilmManager;

class EnSalleController extends AbstractController
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

        return $this->twig->render(
            'EnSalle/index.html.twig',
            [
                'filmsEnSalle' => $filmsEnSalle,
            ]
        );
    }
}