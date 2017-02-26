<?php
interface IStrategy
{
    const TABLE_NAME = 'books';
    public function algorithm(Array $dataPack);
}
