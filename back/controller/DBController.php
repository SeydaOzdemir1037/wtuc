<?php
session_start();

class DBController
{
    protected $conn;

    function __construct()
    {
//        if (!isset($_SESSION["sicil_no"])) {
//            header("location: http://" . $_SERVER['SERVER_NAME'] . "/back-end-admin/index.php");
//            exit;
//        }
        $dsn = 'mysql:dbname=wtuc;host=localhost;charset=utf8';
        $user = 'root';
        $password = 'root';
//        $dsn = 'mysql:dbname=epiz_27577810_msmuhendislik;host=sql211.epizy.com;charset=utf8';
//        $user = 'epiz_27577810';
//        $password = 'iazPEd6UDu7';

        try {
            $dbh = new PDO($dsn, $user, $password);
            $this->conn = $dbh;
        } catch (PDOException $e) {
            echo 'Bağlantı kurulamadı: ' . $e->getMessage();
        }
    }

}

?>
