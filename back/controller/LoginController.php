<?php
session_start();

class LoginController
{
    private $conn;

    function __construct()
    {
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

    function giris($sicil_no, $sifre)
    {
        $kullanicisor = $this->conn->prepare("SELECT personel.id AS personel_id,
personel.sicil_no AS sicil_no,
login.sifre AS sifre,
login.id AS login_id,
login.personel_id AS login_personel_id
FROM login
INNER JOIN personel ON personel.id=login.personel_id
WHERE personel.sicil_no=:sicil_no AND login.sifre=:sifre");
        $kullanicisor->execute(array(
            'sicil_no' => $sicil_no,
            'sifre' => md5($sifre)
        ));
        $say = $kullanicisor->rowCount();

        if ($say == 1) {
            $_SESSION['sicil_no'] = $sicil_no;
            header("Location:../pages/index.php");
        } else {
            header("Location:../pages/login.php?durum=no");
            exit;
        }
    }


    function sifre_guncelle($sifre,$personel_id)
    {
        $sth = $this->conn->prepare("UPDATE login SET sifre=? WHERE personel_id=?");
        $flag = $sth->execute([$sifre,$personel_id]);
        if ($flag) {
            return true;
        } else {
            return false;
        }
    }

}

?>
