<?php


class IlController extends DBController
{

    function il_getir()
    {
        $sth = $this->conn->prepare("SELECT * FROM il");
        $sth->execute();
        $result = $sth->fetchAll();
        return $result;
    }

}