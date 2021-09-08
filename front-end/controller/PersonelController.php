<?php


class PersonelController extends DBController
{

    function personel_getir()
    {
        $sth = $this->conn->prepare("SELECT *,personel.id AS personelid FROM personel
INNER JOIN departman ON departman.id=personel.departman_id");
        $sth->execute([]);
        $result = $sth->fetchAll();
        return $result;
    }

    function departman_getir()
    {
        $sth = $this->conn->prepare("SELECT * FROM departman");
        $sth->execute([]);
        $result = $sth->fetchAll();
        return $result;
    }

}
