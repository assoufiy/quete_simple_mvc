<?php
namespace Model;
// src/Model/ItemManager.php
//require __DIR__ . '/../../app/db.php';
use Model\Item;


class ItemManager extends AbstractManager
{
    const TABLE = 'item';

    public function __construct(\PDO $pdo)
    {
        parent::__construct(self::TABLE, $pdo);
    }

    public function insert(Item $item): int
    {
        // prepared request
        $statement = $this->pdo->prepare("INSERT INTO $this->table (`title`) VALUES (:title)");
        $statement->bindValue('title', $item->getTitle(), \PDO::PARAM_STR);


        if ($statement->execute()) {
            return $this->pdo->lastInsertId();
        }
    }

    /**
     * @param int $id
     */
    public function delete(int $id): void
    {
        // prepared request
        $statement = $this->pdo->prepare("DELETE FROM $this->table WHERE id=:id");
        $statement->bindValue('id', $id, \PDO::PARAM_INT);
        $statement->execute();
    }
    /**
     * @param Item $item
     * @return int
     */
    public function update(Item $item):int
    {

        // prepared request
        $statement = $this->pdo->prepare("UPDATE $this->table SET `title` = :title WHERE id=:id");
        $statement->bindValue('id', $item->getId(), \PDO::PARAM_INT);
        $statement->bindValue('title', $item->getTitle(), \PDO::PARAM_STR);

        return $statement->execute();
    }
}
// récupération de tous les items

    /**
     * @return array
//     */
 /*  public function selectAll(): array
   {

        $query = "SELECT * FROM item";
        $res = $pdo->query($query, Item::class);
        return $res->fetchAll();
    }

 //la méthode prend l'id en paramètre

    public function selectOneById(int $id): array
    {

        $query = "SELECT * FROM item WHERE id = :id";
        $statement = $pdo->prepare($query);
        $statement->bindValue(':id', $id, \PDO::PARAM_INT);
        $statement->execute();
        // contrairement à fetchAll(), fetch() ne renvoie qu'un seul résultat
       return $statement->fetch();
     }*/


