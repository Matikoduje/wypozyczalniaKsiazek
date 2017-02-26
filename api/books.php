<?php

function __autoload($className)
{
    include_once 'src/' . $className . '.php';
}

if (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
    if ($_SERVER['REQUEST_METHOD'] === 'GET' && !isset($_GET['id'])) {
        $showAll = new User();
        $showAll->showAll();
    }
    if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['id'])) {
        echo "Jest zajebiście !!";
    }
} else {
    echo "Proszę połączyć się z stroną za pośrednictwem żądań AJAX";
}