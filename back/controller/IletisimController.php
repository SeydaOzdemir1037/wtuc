<?php


class IletisimController extends DBController
{
    function mailListele(){
        $sth = $this->conn->prepare("SELECT * FROM iletisim_mailler");
        $sth->execute();
        $result = $sth->fetchAll();
        return $result;
    }


    function seciliMailgetir($mailid){
        $sth = $this->conn->prepare("SELECT * FROM iletisim_mailler WHERE id=?");
        $sth->execute([$mailid]);
        $result = $sth->fetch();
        return $result;
    }
}
