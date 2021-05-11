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
}
