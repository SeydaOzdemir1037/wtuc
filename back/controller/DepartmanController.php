<?php


class DepartmanController extends DBController
{

    function departman_getir()
    {
        $sth = $this->conn->prepare("SELECT * FROM departman");
        $sth->execute();
        $result = $sth->fetchAll();
        return $result;
    }

    function departman_yetki_guncelle($yetki,$seo)
    {
        $sth = $this->conn->prepare("UPDATE departman SET yetki=? WHERE seo=?");
        $flag = $sth->execute([$yetki,$seo]);
        if ($flag) {
            return true;
        } else {
            return false;
        }
    }

    function departman_secilen_getir($seo)
    {
        $sth = $this->conn->prepare("SELECT * FROM departman WHERE seo=?");
        $sth->execute([$seo]);
        $result = $sth->fetch();
        return $result;
    }

    function departman_bul($id)
    {
        $sth = $this->conn->prepare("SELECT * FROM departman WHERE id=?");
        $sth->execute([$id]);
        $result = $sth->fetch();
        return $result;
    }

}