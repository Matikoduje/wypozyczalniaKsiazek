<?php

include_once 'IConnectInfo.php';

class UniversalConnect implements IConnectInfo
{
    private static $server=IConnectInfo::DB_HOST;
    private static $currentDB= IConnectInfo::DB_NAME;
    private static $user= IConnectInfo::DB_USER;
    private static $pass= IConnectInfo::DB_PASSWORD;
    private static $conn;

    public function doConnect()
    {
        self::$conn=mysqli_connect(self::$server, self::$user, self::$pass, self::$currentDB);
        if(self::$conn) {
            self::$conn->query('SET NAMES `utf8`');
            echo "Udane połączenie z bazą MySQL:<br/>";
        } else {
            echo('Oto twój błąd: ' . mysqli_connect_error());
        }
        return self::$conn;
    }
}
