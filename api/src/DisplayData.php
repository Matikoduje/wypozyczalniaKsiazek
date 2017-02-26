<?php

class DisplayData implements IStrategy
{
    private $tableName;
    private $conn;
    private $dataPack;

    public function algorithm(Array $dataPack)
    {
        $this->tableName = IStrategy::TABLE_NAME;
        $this->conn = new UniversalConnect();
        $this->conn = $this->conn->doConnect();

        $sql = 'SELECT * FROM ' . $this->tableName;
        $result = $this->conn->query($sql);
        $json = array();

        foreach ($result as $item) {
            $json[]=array("id"=>$item['id'],"title"=>$item['title']);
        }
        $this->conn->close();
        echo json_encode($json);
        //echo json_last_error_msg();
    }
}