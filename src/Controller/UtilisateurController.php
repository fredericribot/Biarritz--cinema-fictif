<?php

/**
 * Created by PhpStorm.
 * User: aurelwcs
 * Date: 08/04/19
 * Time: 18:40
 */

namespace App\Controller;

use App\Model\UtilisateurManager;
use App\Model\FilmManager;
use App\Model\TicketManager;
use App\Model\SeanceManager;

class UtilisateurController extends AbstractController
{

    /**
     * Display home page
     *
     * @return string
     * @throws \Twig\Error\LoaderError
     * @throws \Twig\Error\RuntimeError
     * @throws \Twig\Error\SyntaxError
     */

    public function connexion()
    {

        if (!empty($_POST)) {

            $utilisateurManager = new utilisateurManager();
            $user = $utilisateurManager->connect($_POST);

            if ($_POST['password'] == $user['password']) {
                $_SESSION['user'] = $_POST['email'];
                $_SESSION['is_admin'] = $user['is_admin'];
                $this->twig->addGlobal('post', $_POST);
            }
        }

        if (isset($_SESSION['is_admin']) && $_SESSION['is_admin'] == '1') {
            $filmManager = new FilmManager;
            $films = $filmManager->selectAll();
            return $this->twig->render('/Utilisateur/administration.html.twig', [
                'message' => [
                    'message' => 'adminConnected',
                    'type' => 'success'
                ],
                'films' => $films,
            ]);
        } elseif (isset($_SESSION['user']) && $_SESSION['user']) {
            return $this->twig->render('/Utilisateur/connexion.html.twig', [
                'message' => [
                    'message' => 'userConnected',
                    'type' => 'success'
                ],
            ]);
        } else {
            return $this->twig->render('/Utilisateur/connexion.html.twig');
        }
    }

    public function mytickets()
    {
        $email_utilisateur = $_SESSION['user'];
        $utilisateurManager = new utilisateurManager();

        $utilisateur = $utilisateurManager->getIdByEmail($email_utilisateur);


        $ticketManager = new TicketManager();
        $tickets = $ticketManager->selectAllByUserId($utilisateur['id']);


        $seanceManager = new SeanceManager;
        $seances = $seanceManager->selectAll();


        return $this->twig->render('/Utilisateur/mytickets.html.twig', [
            'utilisateur' => $utilisateur,
            'tickets' => $tickets,
            'seances' => $seances
        ]);
    }

    public function deconnexion()
    {
        $_SESSION = [];
        $_SESSION = array();

        session_destroy();
        header('location: /');
    }

    public function inscription()
    {

        if (!empty($_POST)) {
            $utilisateurManager = new utilisateurManager();
            $userId = $utilisateurManager->insert($_POST);
            header("Location:/Utilisateur/validation");
        }

        return $this->twig->render('Utilisateur/form_inscription.html.twig');
    }

    public function validation()
    {

        return $this->twig->render('Utilisateur/validation.html.twig');
    }


    public function administration()
    {
        $filmManager = new FilmManager;
        $films = $filmManager->selectAll();
        return $this->twig->render(
            'Utilisateur/administration.html.twig',
            [
                'films' => $films
            ]
        );
    }
}