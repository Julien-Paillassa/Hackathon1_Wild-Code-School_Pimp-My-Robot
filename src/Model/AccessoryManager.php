<?php

namespace App\Model;

class AccessoryManager extends AbstractManager
{
    public function selectAllAccessories(string $orderBy = '', string $direction = 'ASC'): array
    {
        $query = 'SELECT * FROM accessories';
        if ($orderBy) {
            $query .= ' ORDER BY ' . $orderBy . ' ' . $direction;
        }
        return $this->pdo->query($query)->fetchAll();
    }

    public function getAccessoryById(int $id)
    {
        $query = "SELECT *
                    FROM accessories
                    WHERE id=:id";
        $statement = $this->pdo->prepare($query);
        $statement->bindValue('id', $id, \PDO::PARAM_INT);
        $statement->execute();

        return $statement->fetch();
    }
}

