<?php

class SearchData implements IStrategy
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
        $field = $this->dataPack[0];
        $fieldValue = $this->dataPack[1];

        $this->sql = "SELECT * FROM " . $this->tableName . " WHERE " . $field . "=" . $fieldValue;
        $result = $this->conn->query($this->sql);
        $json = [];

        if ($result) {
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    $json[] = $row;
                }
                echo json_encode($json);
            }
        }

        $this->conn->close();
    }
}