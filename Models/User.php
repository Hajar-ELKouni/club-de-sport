<?php

class User
{
    public function __construct(
        private $conn
    ) {
    }

    /**
     * getUserById
     *
     * @param  int $userId
     * @return Object
     */
    public function getUserById(int $userId): Object
    {
        $user = $this->conn->prepare("SELECT * from users where id=:id");
        $user->bindValue("id", $userId);
        $user->execute();

        return $user->fetchObject();
    }

    public function getUsers(): array
    {
        $user = $this->conn->prepare("SELECT * from users WHERE role != 'admin'");
        $user->execute();

        return $user->fetchAll(PDO::FETCH_OBJ);
    }

    public function destroyUser($id)
    {
        $user = $this->conn->prepare("DELETE from users where id=:id");
        $user->bindValue("id", $id);
        $user->execute();

        return $user->rowCount();
    }
}
