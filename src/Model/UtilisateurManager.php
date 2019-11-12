<?php


namespace App\Model;

class UtilisateurManager extends AbstractManager
{
    /**
     *
     */
    const TABLE = 'utilisateur';

    /**
     * Initialise cette class.
     */
    public function __construct()
    {
        parent::__construct(self::TABLE);
    }

    public function getIdByEmail($email)
    {
        $sql = "SELECT * FROM $this->table WHERE email = :email";
        $query = $this->pdo->prepare($sql);
        $query->bindValue(':email', $email, \PDO::PARAM_STR);
        $query->execute();
        return $query->fetch();
    }


    public function connect(array $dataConnexion)
    {
        $statement = $this->pdo->prepare("SELECT * FROM $this->table WHERE email= :email");
        $statement->bindValue(':email', $dataConnexion['email'], \PDO::PARAM_STR);
        $statement->execute();

        return $statement->fetch();
    }



    public function insert(array $utilisateur): int
    {
        // prepared request


        $statement = $this->pdo->prepare("INSERT INTO $this->table (`nom`,`prenom`,`email`,`password`,`date_de_naissance`,`numero`) VALUES (:nom, :prenom, :email, :password, :date_de_naissance, :numero)");
        $statement->bindValue(':nom', $utilisateur['nom'], \PDO::PARAM_STR);
        $statement->bindValue(':prenom', $utilisateur['prenom'], \PDO::PARAM_STR);
        $statement->bindValue(':email', $utilisateur['email'], \PDO::PARAM_STR);
        $statement->bindValue(':password', $utilisateur['password'], \PDO::PARAM_STR);
        $statement->bindValue(':date_de_naissance', $utilisateur['date_de_naissance'], \PDO::PARAM_STR);
        $statement->bindValue(':numero', $utilisateur['numero'], \PDO::PARAM_INT);

        // echo '<pre>' , $statement->debugDumpParams() , '</pre>';
        if ($statement->execute()) {
            return (int) $this->pdo->lastInsertId();
        }
    }
}