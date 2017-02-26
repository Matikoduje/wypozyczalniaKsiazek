<?php

class DataEntry implements IStrategy
{

    public function algorithm()
    {
        // tutaj możemy wpisać query w bazę danych zapisujące dane
        $conn = UniversalConnect::doConnect();
    }
}