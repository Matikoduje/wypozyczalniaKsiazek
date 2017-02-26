<?php

class UpdateData implements IStrategy
{

    public function algorithm()
    {
        // aktualizujemy daną komórkę
        $conn = UniversalConnect::doConnect();
    }
}