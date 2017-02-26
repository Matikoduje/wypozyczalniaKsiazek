<?php

class SearchData implements IStrategy
{

    public function algorithm(Array $dataPack)
    {
        $this->tableName = IStrategy::TABLE_NAME;
        $this->conn = new UniversalConnect();
        $this->conn = $this->conn->doConnect();



        $this->conn->close();
    }
}