<?php

class CheckData
{
    private $conn;
    private $dataPack;
    private $field;
    private $fieldValue;
    private $title;
    private $description;
    private $author;
    private $id;

    public function enterData()
    {
        $this->conn = new UniversalConnect();
        $this->conn = $this->conn->doConnect();
        $this->title = $this->conn->real_escape_string($_POST['title']);
        $this->description = $this->conn->real_escape_string($_POST['description']);
        $this->author = $this->conn->real_escape_string($_POST['author']);
        $this->dataPack = array($this->title, $this->author, $this->description);
        $this->conn->close();
    }

    public function conductSearch()
    {
        $this->conn = new UniversalConnect();
        $this->conn = $this->conn->doConnect();
        $this->field = $this->conn->real_escape_string($_GET['field']);
        $this->fieldValue = $this->conn->real_escape_string($_GET['fieldValue']);
        $this->dataPack = array($this->field, $this->fieldValue);
        $this->conn->close();
    }

    public function removeRecord()
    {
        $this->conn = new UniversalConnect();
        $this->conn = $this->conn->doConnect();
        parse_str(file_get_contents("php://input"),$delVars); // uzyskujemy dane przesłane metodą DELETE
        $this->id = $this->conn->real_escape_string($delVars['delete']);
        $this->dataPack = array($this->id);
        $this->conn->close();
    }

    public function makeChange()
    {
        $this->conn = new UniversalConnect();
        $this->conn = $this->conn->doConnect();
        parse_str(file_get_contents("php://input"),$putVars);
        $this->title = $this->conn->real_escape_string($putVars['title']);
        $this->description = $this->conn->real_escape_string($putVars['description']);
        $this->author = $this->conn->real_escape_string($putVars['author']);
        $this->id = $this->conn->real_escape_string($putVars['id']);
        $this->dataPack = array($this->title, $this->author, $this->description, $this->id);
        $this->conn->close();
    }

    public function setEntry()
    {
        return $this->dataPack;
    }
}