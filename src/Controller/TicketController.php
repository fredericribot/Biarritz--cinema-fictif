<?php

namespace App\Controller;

use App\Model\SeanceManager;
use App\Model\TarifManager;
use App\Model\FilmManager;
use App\Model\TicketManager;
use App\Model\UtilisateurManager;

class TicketController extends AbstractController
{
    public function add($id_seance)
    {
        $utilisateurManager = new UtilisateurManager;

        $seanceManager = new SeanceManager();
        $seance = $seanceManager->selectSeanceById($id_seance);

        $filmManager = new FilmManager();
        $film = $filmManager->selectOneById($seance['id_film']);

        $tarifManager = new TarifManager();
        $tarifs = $tarifManager->selectAll();

        $ticketManager = new TicketManager();

        if (isset($_POST['id_tarif'])) {
            $email_utilisateur = $_SESSION['user'];
            $id_utilisateur = $utilisateurManager->getIdByEmail($email_utilisateur);
            // var_dump($id_utilisateur);
            $id_tarif = $_POST['id_tarif'];
            // var_dump($id_tarif);
            // echo '<pre>', var_dump($_SESSION), '</pre>';
            $ticketManager->add(intval($id_utilisateur['id']), $id_seance, $id_tarif);
        }

        // echo '<pre>', var_dump($_POST), '</pre>';

        return $this->twig->render('/Ticket/add.html.twig', [

            'seance' => $seance,
            'film' => $film,
            'tarifs' => $tarifs

        ]);
    }

    public function list()
    {
        $ticketManager = new TicketManager();
        $utilisateurManager = new UtilisateurManager();
        $filmManager = new FilmManager();

        $tickets = $ticketManager->selectAll();
        $utilisateurs = $utilisateurManager->selectAll();

        $tickets = $ticketManager->selectAllWithDetails();


        // echo '<pre>', var_dump($tickets), '</pre>';



        return $this->twig->render('/Ticket/list.html.twig', [
            'tickets' => $tickets
        ]);
    }
}