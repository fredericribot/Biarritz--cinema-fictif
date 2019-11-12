<?php

namespace App\Controller;

use App\Model\FilmManager;

/**
 * Class FilmController
 */

class FilmController extends AbstractController
{
    /**
     * Affiche la liste des films
     * 
     * @return string
     * @throws \Twig\Error\LoaderError
     * @throws \Twig\Error\RuntimeError
     * @throws \Twig\Error\SyntaxError
     */

    public function list()
    {
        $filmManager = new FilmManager();
        $films = $filmManager->selectAll();

        return $this->twig->render(
            'Film/list.html.twig',
            ['films' => $films]
        );
    }


    public function details(int $id)
    {
        $filmManager = new FilmManager();
        $film = $filmManager->selectOneById($id);
        return $this->twig->render(
            'Film/details.html.twig',
            [
                'film' => $film,
            ]
        );
    }

    public function add()
    {
        $filmManager = new FilmManager();
        $filmManager = new filmManager();
        $genres = $filmManager->selectAll();

        if (!empty($_POST)) {
            $filmManager = new FilmManager();
            $filmId = $filmManager->insert($_POST);
            header("Location:/film/details/" . $filmId);
        }
        return $this->twig->render(
            'Film/form.html.twig',
            [
                'genres' => $genres
            ]
        );
    }

    public function edit($id)
    {
        $filmManager = new FilmManager();
        $filmManager = new filmManager();

        $film = $filmManager->selectOneById($id);
        $genres = $filmManager->selectAll();

        return $this->twig->render(
            'Film/form.html.twig',
            [
                'film' => $film,
                
            ]
        );
    }

    public function delete($id)
    {
        $filmManager = new filmManager();
        $filmManager->deleteOneById($id);

        return $this->twig->render(
            'Film/form.html.twig'
            
        );
    }
}