<?php


namespace App\Model;

class FilmManager extends AbstractManager
{
    /**
     * 
     */
    const TABLE = 'film';

    /**
     * Initialise cette class.
     */
    public function __construct()
    {
        parent::__construct(self::TABLE);
    }


    /**
     * Get all row from database.
     *
     * @return array
     */
    public function selectAllEnSalle(): array
    {
        return $this->pdo->query('SELECT * FROM ' . $this->table .' WHERE en_salle = 1;')->fetchAll();
    }

    /**
     * Get all row from database.
     *
     * @return array
     */
    public function selectAllProchainement(): array
    {
        return $this->pdo->query('SELECT * FROM ' . $this->table .' WHERE en_salle = 0;')->fetchAll();
    }

    public function insert(array $film): int
    {
        // prepared request


        $statement = $this->pdo->prepare("INSERT INTO $this->table (`label`,`distribution`,`image`,`bande_annonce`,`synopsys`,`note_presse`,`duree`,`date_sortie`,`coup_de_coeur`,`id_public`, `id_genre`,`en_salle`) VALUES (:label, :distribution, :image, :bande_annonce, :synopsys, :note_presse, :duree, :date_sortie, :coup_de_coeur, :id_public, :id_genre, :en_salle)");
        $statement->bindValue(':label', $film['label'], \PDO::PARAM_STR);
        $statement->bindValue(':distribution', $film['distribution'], \PDO::PARAM_STR);
        $statement->bindValue(':synopsys', $film['synopsys'], \PDO::PARAM_STR);
        $statement->bindValue(':image', $film['image'], \PDO::PARAM_STR);
        $statement->bindValue(':bande_annonce', $film['bande_annonce'], \PDO::PARAM_STR);
        $statement->bindValue(':note_presse', $film['note_presse'], \PDO::PARAM_INT);
        $statement->bindValue(':duree', $film['duree'], \PDO::PARAM_INT);
        $statement->bindValue(':date_sortie', $film['date_sortie'], \PDO::PARAM_STR);
        $statement->bindValue(':coup_de_coeur', $film['coup_de_coeur'], \PDO::PARAM_BOOL);
        $statement->bindValue(':id_public', $film['public'], \PDO::PARAM_INT);
        $statement->bindValue(':id_genre', $film['genre'], \PDO::PARAM_INT);
        $statement->bindValue(':en_salle', $film['en_salle'], \PDO::PARAM_BOOL);
        // echo '<pre>' , $statement->debugDumpParams() , '</pre>';
        if ($statement->execute()) {
            return (int) $this->pdo->lastInsertId();
        }
    }

    public function save(array $film): string
    {
        var_dump($film);
        $sql = 'INSERT INTO film VALUES (null, :label)';
        $preparedQuery = $this->pdo->prepare($sql);
        $preparedQuery->bindParam(':label', $film['label'], \PDO::PARAM_STR);
        $preparedQuery->debugDumpParams();
        echo '<br><br><br><br><br>';
        $preparedQuery->execute();
        return $this->pdo->lastInsertId();
    }

    public function deleteOneById($id){

        $sql = 'DELETE FROM film WHERE `id` = :id';
        $preparedQuery = $this->pdo->prepare($sql);
        $preparedQuery->bindParam(':id', $id, \PDO::PARAM_STR);
        $preparedQuery->execute();
        
    }
}
