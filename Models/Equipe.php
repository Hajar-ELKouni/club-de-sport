<?php

class Equipe
{
    public function __construct(
        private $conn
    ) {
    }

    /**
     * getEquipeById
     *
     * @param  int $equipeId
     * @return Object|bool
     */
    public function getEquipeById(int $equipeId): Object|bool
    {
        $equipe = $this->conn->prepare("SELECT * from equipes where id=:id");
        $equipe->bindValue("id", $equipeId);
        $equipe->execute();

        return $equipe->fetchObject();
    }

    /**
     * getAllEquipesBySportIdAndGender
     *
     * @param  int $sportId
     * @param  string $gender
     * @return array
     */
    public function getAllEquipesBySportIdAndGender(int $sportId, string $gender): array
    {
        $equipes = $this->conn->prepare("SELECT * FROM equipes where sport_id = :sport_id and gender = :gender and approved= :approved order by created_at DESC");
        $equipes->bindValue("sport_id", $sportId);
        $equipes->bindValue("gender", $gender);
        $equipes->bindValue("approved", 'oui');
        $equipes->execute();

        return $equipes->fetchAll(PDO::FETCH_OBJ);
    }
    

    /**
     * updateEquipeNumber
     *
     * @param  mixed $id
     * @param  mixed $nbr
     * @return array
     */
    public function updateEquipeNumber(int $id, int $nbr): void
    {
        $equipe = $this->conn->prepare("UPDATE equipes SET nbr = :nbr WHERE id = :id");
        $equipe->bindValue("nbr", $nbr);
        $equipe->bindValue("id", $id);
        $equipe->execute();
    }

    /**
     * getAllEquipes
     *
     * @return array
     */
    public function getAllEquipes(): array
    {
        $equipes = $this->conn->prepare("SELECT * FROM equipes order by created_at DESC");
        $equipes->execute();

        return $equipes->fetchAll(PDO::FETCH_OBJ);
    }

    /**
     * getAllEquipes
     *
     * @return array
     */
    public function getEquipesByCoachApprove($coach_id): array
    {
        $equipes = $this->conn->prepare("SELECT * FROM equipes WHERE coach_id = :coach_id AND approved = 'Oui' order by created_at DESC");
        $equipes->bindValue("coach_id", $coach_id);
        $equipes->execute();

        return $equipes->fetchAll(PDO::FETCH_OBJ);
    }

    /**
     * getAllEquipes
     *
     * @return array
     */
    public function getEquipesByCoachPending($coach_id): array
    {
        $equipes = $this->conn->prepare("SELECT * FROM equipes WHERE coach_id = :coach_id AND approved = 'Non' order by created_at DESC");
        $equipes->bindValue("coach_id", $coach_id);
        $equipes->execute();

        return $equipes->fetchAll(PDO::FETCH_OBJ);
    }

    /**
     * updateStatusEquipe
     *
     * @param  mixed $approved
     * @param  mixed $id
     * @return array
     */
    public function updateStatusEquipe($approved, $id)
    {
        $equipe = $this->conn->prepare("UPDATE equipes SET approved = :approved WHERE id = :id");
        $equipe->bindValue("approved", $approved);
        $equipe->bindValue("id", $id);
        $equipe->execute();

        return $equipe->rowCount();
    }


    /**
     * destroyEquipe
     *
     * @param  int $id
     * @return int
     */
    public function destroyEquipe(int $id): int
    {
        $equipe = $this->conn->prepare("DELETE FROM equipes WHERE id = :id");
        $equipe->bindValue("id", $id);
        $equipe->execute();

        return $equipe->rowCount();
    }
}
