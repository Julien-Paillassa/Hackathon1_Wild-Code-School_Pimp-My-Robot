<?php

namespace App\Model;

class FieldManager extends AbstractManager
{
    public function selectAllFields(string $orderBy = '', string $direction = 'ASC'): array
    {
        $query = 'SELECT * FROM field';
        if ($orderBy) {
            $query .= ' ORDER BY ' . $orderBy . ' ' . $direction;
        }
        return $this->pdo->query($query)->fetchAll();
    }

    public function selectFieldById(int $id)
    {
        $query = "SELECT type, image, description
                    FROM field
                    WHERE id=:id";
        $statement = $this->pdo->prepare($query);
        $statement->bindValue('id', $id, \PDO::PARAM_INT);
        $statement->execute();

        return $statement->fetch();
    }
}
