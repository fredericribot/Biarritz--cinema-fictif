<?php

namespace App\Model;

class TicketManager extends AbstractManager
{
    /**
     * 
     */
    const TABLE = 'ticket';

    public function __construct()
    {
        parent::__construct(self::TABLE);
    }

    public function selectAllWithDetails()
    {
        // prepared request
        $query = $this->pdo->prepare("SELECT `ticket`.*, `tarif`.label as tarif, `utilisateur`.nom as utilisateur_nom, `film`.label as film_label, `utilisateur`.prenom as utilisateur_prenom, `seance`.id_salle as salle, `seance`.id_film as film_id, `horaire`.label as horaire_label, `horaire`.horaire_debut as horaire FROM $this->table JOIN utilisateur ON `ticket`.id_utilisateur = `utilisateur`.id JOIN seance ON `ticket`.id_seance = `seance`.id JOIN tarif ON `ticket`.id_tarif = `tarif`.id JOIN film ON `seance`.id_film = `film`.id JOIN horaire ON `seance`.id_horaire = `horaire`.id");
        $query->execute();
        return $query->fetchAll();
    }



    public function selectAllByUserId($id)
    {
        $query = $this->pdo->prepare("SELECT `ticket`.*, `tarif`.label as tarif, `utilisateur`.nom as utilisateur_nom, `film`.label as film_label, `utilisateur`.prenom as utilisateur_prenom, `seance`.id_salle as salle, `seance`.id_film as film_id, `horaire`.label as horaire_label, `horaire`.horaire_debut as horaire FROM $this->table JOIN utilisateur ON `ticket`.id_utilisateur = `utilisateur`.id JOIN seance ON `ticket`.id_seance = `seance`.id JOIN tarif ON `ticket`.id_tarif = `tarif`.id JOIN film ON `seance`.id_film = `film`.id JOIN horaire ON `seance`.id_horaire = `horaire`.id
        WHERE `id_utilisateur`= :id ");
        $query->bindParam('id', $id, \PDO::PARAM_INT);
        $query->execute();
        return $query->fetchAll();
    }

    public function add($id_utilisateur,  $id_seance,  $id_tarif)
    {
        $sql = "INSERT INTO $this->table (`id_utilisateur`,`id_seance`,`id_tarif`) VALUES (:id_utilisateur, :id_seance, :id_tarif)";
        $query = $this->pdo->prepare($sql);
        $query->bindValue(':id_utilisateur', $id_utilisateur, \PDO::PARAM_STR);
        $query->bindValue(':id_seance', $id_seance, \PDO::PARAM_STR);
        $query->bindValue(':id_tarif', $id_tarif, \PDO::PARAM_STR);
        $query->execute();
    }

    // 
}