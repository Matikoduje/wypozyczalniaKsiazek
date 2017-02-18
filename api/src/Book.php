<?php

class Book
{
    private $id;
    private $title;
    private $author;
    private $description;

    public function __construct()
    {
        $this->id = -1;
        $this->title = '';
        $this->author = '';
        $this->description = '';
    }

    public function getId()
    {
        return $this->id;
    }

    public function getTitle()
    {
        return $this->title;
    }

    public function setTitle($title)
    {
        $this->title = $title;
    }

    public function getAuthor()
    {
        return $this->author;
    }

    public function setAuthor($author)
    {
        $this->author = $author;
    }

    public function getDescription()
    {
        return $this->description;
    }

    public function setDescription($description)
    {
        $this->description = $description;
    }

    public static function loadFromDB(mysqli $conn, $id=null)
    {
        if (null == $id) {
            $sql = "SELECT * FROM books";
        } else {
            $sql = "SELECT * FROM books WHERE id=" . $id;
        }

        $result = $conn->query($sql);
        if (!$result) {
            die('Querry error: ' . $conn->error);
        }
        return $result;
    }

    public function create(mysqli $conn)
    {
        if (-1 === $this->id) {
            $this->title = $conn->real_escape_string($this->title);
            $this->description = $conn->real_escape_string($this->description);
            $this->author = $conn->real_escape_string($this->author);
            $sql = sprintf("INSERT INTO books (`title`, `author`, `description`) VALUES ('%s', '%s', '%s')", $this->title, $this->author, $this->description);
            $result = $conn->query($sql);

            if ($result) {
                $this->id = $conn->insert_id;
            } else {
                die('Error: tweet not saved' . $conn->error);
            }
        }
    }

    public static function delete(mysqli $conn, $id)
    {
        $sql = "DELETE FROM books WHERE id=" . $id;
        $result = $conn->query($sql);
        if (!$result) {
            die('Querry error: ' . $conn->error);
        }
        return true;
    }

    public static function update(mysqli $conn, $id, $title=null, $author=null, $description=null)
    {
        $isUpdateOk = null;

        if (null != $title) {
            $title = $conn->real_escape_string($title);
            $sql = "UPDATE books SET title='" . $title . "' WHERE id=" . $id;
            $result = $conn->query($sql);
            if (!$result) {
                $isUpdateOk = false;
                die('Querry error: ' . $conn->error);
            } else {
                $isUpdateOk = true;
            }
        }

        if (null != $author) {
            $author = $conn->real_escape_string($author);
            $sql = "UPDATE books SET title='" . $author . "' WHERE id=" . $id;
            $result = $conn->query($sql);
            if (!$result) {
                $isUpdateOk = false;
                die('Querry error: ' . $conn->error);
            } else {
                $isUpdateOk = true;
            }
        }

        if (null != $description) {
            $description = $conn->real_escape_string($description);
            $sql = "UPDATE books SET title='" . $description . "' WHERE id=" . $id;
            $result = $conn->query($sql);
            if (!$result) {
                $isUpdateOk = false;
                die('Querry error: ' . $conn->error);
            } else {
                $isUpdateOk = true;
            }
        }

        if (true == $isUpdateOk) {
            return true;
        }
    }
}