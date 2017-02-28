<?php

class UpdateData implements IStrategy
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
        $id = $this->dataPack[3];
        $id = intval($id);

        $this->sql = sprintf("UPDATE " . $this->tableName . " SET title='%s', author='%s', description='%s' WHERE id='%d'", $title, $author, $description, $id);
        $result = $this->conn->query($this->sql);

        if ($result) {
            echo true;
        } else {
            echo "Nie można zaktualizować danych: " . $this->conn->error;
        }

        $this->conn->close();
    }
}