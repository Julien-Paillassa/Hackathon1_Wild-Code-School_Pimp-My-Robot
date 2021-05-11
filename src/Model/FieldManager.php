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
}
