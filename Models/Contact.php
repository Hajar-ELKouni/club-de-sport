<?php

class Contact
{
    public function __construct(
        private $conn
    ) {
    }

    /**
     * getAllContacts
     *
     * @return array
     */
    public function getAllContacts(): array
    {
        $contacts = $this->conn->prepare("SELECT * FROM contacts order by created_at DESC");
        $contacts->execute();

        return $contacts->fetchAll(PDO::FETCH_OBJ);
    }

    /**
     * destroyContact
     *
     * @param  int $id
     * @return int
     */
    public function destroyContact(int $id): int
    {
        $contact = $this->conn->prepare("DELETE FROM contacts WHERE id = :id");
        $contact->bindValue("id", $id);
        $contact->execute();

        return $contact->rowCount();
    }
}
