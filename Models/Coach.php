<?php
class Coach
{
    public function __construct(
        private $conn
    ) {
    }

    /**
     * getCoachById
     *
     * @param  int $id
     * @return object
     */
    public function getCoachById(int $id): object
    {
        $coach = $this->conn->prepare("SELECT * FROM users WHERE role='coach' AND id=:id");
        $coach->bindValue("id", $id);
        $coach->execute();

        return $coach->fetchObject();
    }

    public function getAllCoaches(): array
    {
        $coaches = $this->conn->prepare("SELECT * FROM users WHERE role='coach'");
        $coaches->execute();

        return $coaches->fetchAll(PDO::FETCH_OBJ);
    }
// new 
  /*  public function AllCoaches(): array
    {
        $coaches = $this->conn->prepare("SELECT * FROM users AS u , coach AS c where u.nom = c.nom AND u.prenom = c.prenom");
        $coaches->execute();
    
        return $coaches->fetchAll(PDO::FETCH_OBJ);
    }
    */
    /**
     * destroyCoach
     *
     * @param  int $id
     * @return int
     */
    public function destroyCoach(int $id): int
    {
        $equipe = $this->conn->prepare("DELETE FROM users WHERE id = :id");
        $equipe->bindValue("id", $id);
        $equipe->execute();

        return $equipe->rowCount();
    }
}
?>
