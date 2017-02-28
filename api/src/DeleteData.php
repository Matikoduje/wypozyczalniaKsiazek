<?php

class DeleteData implements IStrategy
{
    private $dataPack;
    private $conn;
    private $tableName;
    private $sql;

    public function algorithm(Array $dataPack)
    {
        $this->tableName = IStrategy::TABLE_NAME;
        $this->conn = new UniversalConnect();
        $this->conn = $this->conn->doConnect();

        $this->dataPack = $dataPack;
        $toDelete = $dataPack[0];
        $toDelete = intval($toDelete);

        $this->sql = "DELETE FROM " . $this->tableName . " WHERE id=" . $toDelete;
        $result = $this->conn->query($this->sql);

        if ($result) {
            echo true;
        } else {
            echo "Nie udało się skasować danych. Błąd: " . $this->conn->error;
        }
        $this->conn->close();
    }
}