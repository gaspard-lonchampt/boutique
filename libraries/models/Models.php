<?php

namespace Models;


/**
 * Models est la classe qui regroupe le CRUD et d'autres fonctions génériques utiles
 */
class Models
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
     * 
     * @param $order string
     * 
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
        $All_infos = $resultats->fetchall();

        return $All_infos;
    }

    /**
     * Retourne un produit / user ...
     * 
     * @param $id int
     * 
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
     * 
     * @param $id int
     * 
     * @return void
     */
    public function delete(int $id): void
    {
        $query = $this->pdo->prepare("DELETE FROM {$this->table} WHERE id = :id");
        $query->execute(['id' => $id]);
    }

    /**
     * Insert un produit /user ...
     * $database->insert( "table" , 'username,password,email' , " 'shaz3e' , 'securepassword', 'email@email.com' ");
     * 
     * @param $table $column $value
     * 
     * @return false|\PDOStatement
     */
    public function insert($table, $column, $value)
    {
        $sql = "INSERT INTO {$table} ({$column}) VALUES ({$value})";
        $query = $this->pdo->prepare($sql);
        $query->execute(compact('table', 'column', 'value'));
        return $query;
    }

    /**
     *  Modifie un produit / user ...
     *
     * @param $table $column $value $id
     * 
     * @return false|\PDOStatement
     */
    public function update($table, $column, $value, $id)
    {
        $sql = "UPDATE {$table} SET `{$column}` = {$value} WHERE customer_id=:id";
        $query = $this->pdo->prepare($sql);
        $query->execute(['id' => $id]);
        return $query;
    }

    public function getColumnName($table)
    {
        $sql = "SELECT * 
        FROM information_schema.columns 
        WHERE table_name = '$table'";

        $query = $this->pdo->query($sql);
        $column_name = $query->fetchall();
        return $column_name;
    }
}