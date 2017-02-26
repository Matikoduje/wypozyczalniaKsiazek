<?php

function __autoload($className)
{
    include_once 'src/' . $className . '.php';
}

if (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
    if ($_SERVER['REQUEST_METHOD'] === 'GET' && !isset($_GET['field'],$_GET['fieldValue'])) {
        $showAll = new User();
        $showAll->showAll();
    }
    if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['field'],$_GET['fieldValue'])) {
        $search = new User();
        $search->findData();
    }
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['author'],$_POST['description'],$_POST['title'])) {
        $addEntry = new User();
        $addEntry->insertData();
    }
} else {
    echo "Proszę połączyć się z stroną za pośrednictwem żądań AJAX";
}