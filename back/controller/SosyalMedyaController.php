<?php


class SosyalMedyaController extends DBController
{

    function sosyal_medya_getir()
    {
        $sth = $this->conn->prepare("SELECT sosyal_medya.id AS id,
isim ,link,icon,durum_id,
durum.id AS id_durum,
durum.durum AS durum,
durum.renk AS renk
FROM sosyal_medya 
INNER JOIN durum ON durum.id=sosyal_medya.durum_id");
        $sth->execute();
        $result = $sth->fetchAll();
        return $result;
    }

    function sosyal_medya_bul($id)
    {
        $sth = $this->conn->prepare("SELECT sosyal_medya.id AS id,
isim ,link,icon,durum_id,
durum.id AS id_durum,
durum.durum AS durum,
durum.renk AS renk
FROM sosyal_medya 
INNER JOIN durum ON durum.id=sosyal_medya.durum_id WHERE sosyal_medya.id=? ");
        $sth->execute([$id]);
        $result = $sth->fetch();
        return $result;
    }




    function sosyal_medya($ad,$link,$icon,$durum_id)
    {
        $sth = $this->conn->prepare("INSERT INTO sosyal_medya
		(`isim`,`link`,`icon`,`durum_id`)
		VALUES (?,?,?,?)");
        $flag = $sth->execute([$ad,$link,$icon,$durum_id]);
        if ($flag) {
            return true;
        } else {
            return false;
        }
    }


    function sosyal_medya_sil($id)
    {
        $sth = $this->conn->prepare("DELETE FROM sosyal_medya WHERE id =?");
        $flag = $sth->execute([$id]);
        if ($flag) {
            return true;
        } else {
            return false;
        }
    }

    function sosyal_medya_guncelle($ad,$link,$icon,$id)
    {
        $sth = $this->conn->prepare("UPDATE sosyal_medya SET isim=?,link=?,icon=? WHERE id=?");
        $flag = $sth->execute([$ad,$link,$icon,$id]);
        if ($flag) {
            return true;
        } else {
            return false;
        }
    }

    function sosyal_medya_durum_guncelle($durum_id,$id)
    {
        $sth = $this->conn->prepare("UPDATE sosyal_medya SET durum_id=? WHERE id=?");
        $flag = $sth->execute([$durum_id,$id]);
        if ($flag) {
            return true;
        } else {
            return false;
        }
    }

}