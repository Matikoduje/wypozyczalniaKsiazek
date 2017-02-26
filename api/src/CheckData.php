<?php

class CheckData
{
    private $conn;
    private $dataPack;
    private $id;
    private $title;
    private $description;
    private $author;

    public function enterData()
    {
        $this->conn = new UniversalConnect();
        $this->conn = $this->conn->doConnect();
        $this->conn->close();
    }

    public function conductSearch()
    {
        $this->conn = new UniversalConnect();
        $this->conn = $this->conn->doConnect();
        $this->id = $this->conn->real_escape_string($_GET['id']);
        $this->dataPack = array($this->id);
        $this->conn->close();
    }

    public function setEntry()
    {
        return $this->dataPack;
    }
}