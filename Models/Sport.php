<?php

class Sport
{
    public function __construct(
        private $conn
    ) {
    }
        
    /**
     * getSportById
     *
     * @param  int $sportId
     * @return Object|bool
     */
    public function getSportById(int $sportId): Object|bool
    {
        $sport = $this->conn->prepare("SELECT id, title FROM sports where id=:id");
        $sport->bindValue("id", $sportId);
        $sport->execute();

        return $sport->fetchObject();
    }
    
    /**
     * getAllSports
     *
     * @return array
     */
    public function getAllSports(): array
    {
        $sports = $this->conn->prepare("SELECT id, title, description, image FROM sports order by created_at DESC");
        $sports->execute();

        return $sports->fetchAll(PDO::FETCH_OBJ);
    }
}
