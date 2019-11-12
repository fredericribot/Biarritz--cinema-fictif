<?php

/**
 * Created by PhpStorm.
 * User: aurelwcs
 * Date: 08/04/19
 * Time: 18:40
 */

namespace App\Controller;

use App\Model\ContactManager;

class ContactController extends AbstractController
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
        $ContactManager = new ContactManager();
       

        return $this->twig->render('Contact/index.html.twig');
    }
    public function contactEnvoi()
    {
        $ContactManager = new ContactManager();
       

        return $this->twig->render('Contact/send.html.twig');
    }
}