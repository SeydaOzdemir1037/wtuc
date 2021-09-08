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

    function secilen_il_getir($id)
    {
        $sth = $this->conn->prepare("SELECT * FROM il WHERE id =? ");
        $sth->execute([$id]);
        $result = $sth->fetch();
        return $result;
    }
}