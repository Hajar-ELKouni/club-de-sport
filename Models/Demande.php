<?php

class Demande
{
    public function __construct(
        private $conn
    ) {
    }

    /**
     * getDemandeById
     *
     * @param  int $id
     * @return object
     */
    public function getDemandeById(int $id): object
    {
        $demande = $this->conn->prepare("SELECT * FROM demandes where id=:id");
        $demande->bindValue("id", $id);
        $demande->execute();

        return $demande->fetchObject();
    }


    /**
     * getDemandeByUserId
     *
     * @param  int $userId
     * @return object
     */
    public function getDemandeByUserId(int $userId)
    {
        $demande = $this->conn->prepare("SELECT * FROM demandes where user_id=:user_id");
        $demande->bindValue("user_id", $userId);
        $demande->execute();

        return $demande->fetchAll(PDO::FETCH_OBJ);
    }

    /**
     * hasDemandeByUserId
     *
     * @param  int $userId
     * @return bool
     */
    public function hasDemandeByUserId(int $userId): bool
    {
        $demande = $this->conn->prepare("SELECT * FROM demandes where user_id=:user_id");
        $demande->bindValue("user_id", $userId);
        $demande->execute();
        if ($demande->rowCount() < 1) {
            return false;
        }

        return true;
    }

    /**
     * getAllDemandes
     *
     * @return array
     */
    public function getAllDemandes(): array
    {
        $demandes = $this->conn->prepare("SELECT * FROM demandes where 1 order by created_at DESC");
        $demandes->execute();

        return $demandes->fetchAll(PDO::FETCH_OBJ);
    }

    /**
     * destroyDemande
     *
     * @param  int $id
     * @return int
     */
    public function destroyDemande(int $id): int
    {
        $demande = $this->conn->prepare("DELETE FROM demandes WHERE id = :id");
        $demande->bindValue("id", $id);
        $demande->execute();

        return $demande->rowCount();
    }

    /**
     * updateStatusDemande
     *
     * @param  string $status
     * @param  int $id
     * @return bool
     */
    public function updateStatusDemande(string $status, int $id): bool
    {
        $demande = $this->conn->prepare("UPDATE demandes SET status = :status WHERE id = :id");
        $demande->bindValue("status", $status);
        $demande->bindValue("id", $id);
        return $demande->execute();
    }
}
