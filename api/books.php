<?php

function __autoload($className)
{
    include_once 'src/' . $className . '.php';
}

if (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
    echo "ok";
} else {
    if ($_SERVER['REQUEST_METHOD'] === 'GET') {
        $showAll = new Client();
        $showAll->showAll();
    }
}