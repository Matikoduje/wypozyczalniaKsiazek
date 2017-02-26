<?php

class DeleteData implements IStrategy
{

    public function algorithm()
    {
        // id komórki do skasowania
        $conn = UniversalConnect::doConnect();
    }
}