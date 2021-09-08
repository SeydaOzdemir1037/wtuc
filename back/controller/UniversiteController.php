<?php


class UniversiteController extends DBController
{

    function universite_getir()
    {
        $sth = $this->conn->prepare("SELECT * FROM universite");
        $sth->execute();
        $result = $sth->fetchAll();
        return $result;
    }


    function universite_bolum_getir($id)
    {
        $sth = $this->conn->prepare("SELECT * FROM uni_bolum WHERE id=?");
        $sth->execute([$id]);
        $result = $sth->fetch();
        return $result;
    }


    function uni_getir($id)
    {
        $sth = $this->conn->prepare("SELECT * FROM universite WHERE id=?");
        $sth->execute([$id]);
        $result = $sth->fetch();
        return $result;
    }

    function uni_bolum_bul($uni_id)
    {
        $sth = $this->conn->prepare("SELECT * FROM uni_bolum WHERE universite_id=?");
        $sth->execute([$uni_id]);
        $result = $sth->fetchAll();
        return $result;
    }


}