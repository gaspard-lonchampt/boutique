<?php
require_once '../../../libraries/Database.php';

class Model
{
    protected $pdo;
    protected $table;

    /**
     * Model constructor.
     */
    public function __construct()
    {
        $this->pdo = \Database::getPdo();
    }

    /**
     * Return une liste de plusieurs produits/user...
     * @param string|string|null $order
     * @return array
     */
    public function findAll(?string $order = "") : array
    {
        $sql = "SELECT * FROM {$this->table}";

        if ($order) {
            $sql .= " ORDER BY " . $order;
        }

        $resultats = $this->pdo->query($sql);
        // On fouille le résultat pour en extraire les données réelles
        $articles = $resultats->fetchAll();

        return $articles;
    }

    /**
     * Retourne un produit / user ...
     * @param int $id
     * @return mixed
     */
    public function find(int $id)
    {
        $query = $this->pdo->prepare("SELECT * FROM {$this->table} WHERE id = :id");
        $query->execute(['id' => $id]);
        $item = $query->fetch();
        return $item;
    }


    /**
     * Supprime un produit / user
     * @param int $id
     */
    public function delete(int $id): void
    {
        $query = $this->pdo->prepare("DELETE FROM {$this->table} WHERE id = :id");
        $query->execute(['id' => $id]);
    }

    /**
     * Insert un produit /user ...
     * $database->insert( "table" , 'username,password,email' , " 'shaz3e' , 'securepassword', 'email@email.com' ");
     * @param $table
     * @param $column
     * @param $value
     * @return false|\PDOStatement
     */
}