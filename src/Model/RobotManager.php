<?php


namespace App\Model;

class RobotManager extends AbstractManager
{
    public function selectAllRobots(string $orderBy = '', string $direction = 'ASC'): array
    {
        $query = 'SELECT * FROM robot';
        if ($orderBy) {
            $query .= ' ORDER BY ' . $orderBy . ' ' . $direction;
        }
        return $this->pdo->query($query)->fetchAll();
    }
}