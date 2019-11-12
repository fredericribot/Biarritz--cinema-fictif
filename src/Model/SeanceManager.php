<?php

namespace App\Model;

class SeanceManager extends AbstractManager
{
    /**
     * 
     */
    const TABLE = 'seance';

    public function __construct()
    {
        parent::__construct(self::TABLE);
    }

    public function selectAll(): array
    {
        // prepared request
        $statement = $this->pdo->prepare("SELECT `seance`.*, `horaire`.horaire_debut as horaire, `film`.label as film FROM $this->table JOIN horaire ON `seance`.id_horaire = `horaire`.id JOIN film ON `seance`.id_film = `film`.id");
        $statement->execute();
        return $statement->fetchAll();
    }

    public function selectSeanceById(int $id)
    {
        // prepared request
        $statement = $this->pdo->prepare("SELECT `seance`.*, `horaire`.horaire_debut as horaire, `film`.id as film_id , `film`.label as film_label FROM $this->table JOIN horaire ON `seance`.id_horaire = `horaire`.id JOIN film ON `seance`.id_film = `film`.id WHERE `seance`.id = :id");
        $statement->bindParam(':id', $id, \PDO::PARAM_INT);
        // echo '<pre>', var_dump($statement), '</pre>';
        // echo '<pre>', $statement->debugDumpParams(), '</pre>';
        $statement->execute();
        return $statement->fetch();
    }
}