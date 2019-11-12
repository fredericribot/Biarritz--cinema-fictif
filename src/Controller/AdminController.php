<?php

/**
 * Created by PhpStorm.
 * User: aurelwcs
 * Date: 08/04/19
 * Time: 18:40
 */

namespace App\Controller;

use App\Model\AdminManager;

class AdminController extends AbstractController
{

    /**
     * Display home page
     *
     * @return string
     * @throws \Twig\Error\LoaderError
     * @throws \Twig\Error\RuntimeError
     * @throws \Twig\Error\SyntaxError
     */

    public function adminAddFilm()
    {
        $AdminManager = new AdminManager();
       

        return $this->twig->render('Admin/film.html.twig');
    }

    public function adminAddSession()
    {
        $AdminManager = new AdminManager();
    

        return $this->twig->render('Admin/seance.html.twig');
    }

    public function adminMessage()
    {
        $AdminManager = new AdminManager();


        return $this->twig->render('Admin/message.html.twig');
    }
    public function adminMenu()
    {
        $AdminManager = new AdminManager();


        return $this->twig->render('Admin/menu.html.twig');
    }
}