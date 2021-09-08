<?php


class DurumController extends DBController
{

    function personel_duzenle_durum_getir()
    {
        $sth = $this->conn->prepare("SELECT * FROM durum WHERE id=6 OR id=7 ");
        $sth->execute();
        $result = $sth->fetchAll();
        return $result;
    }

}