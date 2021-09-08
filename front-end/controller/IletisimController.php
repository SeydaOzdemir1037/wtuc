<?php


class IletisimController extends DBController
{
function mailKaydet($adsoyad,$email,$subject,$message){
        $sth = $this->conn->prepare("INSERT INTO iletisim_mailler(`ad_soyad`,`mail`,`konu`,`mesaj`)VALUES (?,?,?,?)");
        $flag = $sth->execute([$adsoyad,$email,$subject,$message]);
        if ($flag) {
            return true;
        } else {
            return false;
        }
    }

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
