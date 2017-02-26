<?php

class DisplayData implements IStrategy
{
    private $tableName;
    private $conn;


    public function algorithm(Array $dataPack)
    {
        $this->tableName = IStrategy::TABLE_NAME;
        $this->conn = new UniversalConnect();
        $this->conn = $this->conn->doConnect();

        $sql = 'SELECT * FROM ' . $this->tableName;
        $result = $this->conn->query($sql);
        $json = array();

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $json[] = $row;
            }
        }
        var_dump($json);
        echo json_encode($json);
        echo json_last_error_msg();
        $this->conn->close();
    }
}