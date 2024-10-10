<?php

class DatabaseConnection
{
    private PDO $conn;

    public function __construct(
        private string $host,
        private string $dbname,
        private string $username,
        private string $password
    ) {
        $this->connect();
    }

    private function connect()
    {
        try {
            $this->conn = new PDO("mysql:host=$this->host;port=3307;dbname=$this->dbname", $this->username, $this->password);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $this->conn->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
            $this->conn->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo "Connection failed: " . $e->getMessage();
        }
    }

    public function getConnection()
    {
        return $this->conn;
    }
}

// Use the $conn object for database operations
// For example: $conn->query('SELECT * FROM table_name');

// Close the connection (if needed)
// $conn = null;
