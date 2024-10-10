<?php

class Announce
{
    public function __construct(
        private $conn
    ) {
    }

    /**
     * getAllAnnounces
     *
     * @return array
     */
    public function getAllAnnounces(): array
    {
        $announces = $this->conn->prepare("SELECT * FROM announces order by created_at DESC");
        $announces->execute();

        return $announces->fetchAll(PDO::FETCH_OBJ);
    }

    /**
     * getAnnounceById
     *
     * @param  int $announceId
     * @return Object|bool
     */
    public function getAnnounceById(int $announceId): Object|bool
    {
        $announce = $this->conn->prepare("SELECT * FROM announces where id=:id");
        $announce->bindValue("id", $announceId);
        $announce->execute();

        return $announce->fetchObject();
    }

    /**
     * getAllVisibleAnnounces
     *
     * @return array
     */
    public function getAllVisibleAnnounces(): array
    {
        $announces = $this->conn->prepare("SELECT * FROM announces WHERE status = 1 order by created_at DESC");
        $announces->execute();

        return $announces->fetchAll(PDO::FETCH_OBJ);
    }

    /**
     * destroyAnnounce
     *
     * @param  int $id
     * @return int
     */
    public function destroyAnnounce(int $id): int
    {
        $announce = $this->conn->prepare("DELETE FROM announces WHERE id = :id");
        $announce->bindValue("id", $id);
        $announce->execute();

        return $announce->rowCount();
    }

    /**
     * updateStatusAnnounce
     *
     * @param  int $status
     * @param  int $id
     * @return bool
     */
    public function updateStatusAnnounce(int $status, int $id): bool
    {
        $demande = $this->conn->prepare("UPDATE announces SET status = :status WHERE id = :id");
        $demande->bindValue("status", $status);
        $demande->bindValue("id", $id);
        return $demande->execute();
    }
}
