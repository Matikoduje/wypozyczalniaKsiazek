<?php

class DataEntry implements IStrategy
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
        $title = $this->dataPack[0];
        $author = $this->dataPack[1];
        $description = $this->dataPack[2];

        $this->sql = sprintf("INSERT INTO " . $this->tableName . " (`title`, `author`, `description`) VALUES ('%s','%s','%s')", $title, $author, $description);
        $result = $this->conn->query($this->sql);

        if ($result) {
            echo true;
        } else {
            echo "Błąd wstawiania danych: " . $this->conn->error;
        }

        $this->conn->close();
    }
}