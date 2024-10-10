<?php

class Secretaire
{
    public function __construct(
        private $conn
    ) {
    }

    /**
     * getAllSecretaires
     *
     * @return array
     */
    public function getAllSecretaires(): array
    {
        $secretaires = $this->conn->prepare("SELECT * FROM users where role = :role order by created_at DESC");
        $secretaires->bindValue(':role', 'secretaire');
        $secretaires->execute();

        return $secretaires->fetchAll(PDO::FETCH_OBJ);
    }

    /**
     * destroySecretaire
     *
     * @param  int $id
     * @return int
     */
    public function destroySecretaire(int $id): int
    {
        $secretaire = $this->conn->prepare("DELETE FROM users WHERE id = :id and role = :role");
        $secretaire->bindValue("id", $id);
        $secretaire->bindValue(':role', 'secretaire');
        $secretaire->execute();

        return $secretaire->rowCount();
    }
}
