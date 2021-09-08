<?php


class IzinController extends DBController
{

    function izin_getir($id)
    {
        $sth = $this->conn->prepare("SELECT * , izinler.id AS izinlerid, durum.id AS durum_id FROM izinler 
INNER JOIN izin_sebepleri ON izin_sebepleri.id=izinler.sebep_id
INNER JOIN durum ON durum.id = izinler.durum_id 
WHERE personel_id = ?");
        $sth->execute([$id]);
        $result = $sth->fetchAll();
        return $result;
    }

    function izin_bul($id)
    {
        $sth = $this->conn->prepare("SELECT * ,izinler.id AS izinlerid,izin_sebepleri.id AS sebep_id
FROM izinler 
INNER JOIN izin_sebepleri ON izin_sebepleri.id=izinler.sebep_id
INNER JOIN durum ON durum.id = izinler.durum_id 
WHERE izinler.id = ?");
        $sth->execute([$id]);
        $result = $sth->fetch();
        return $result;
    }

    function izin_guncelle($durum, $id)
    {
        $sth = $this->conn->prepare("UPDATE izinler SET durum_id=? WHERE id=?");
        $flag = $sth->execute([$durum, $id]);
        if ($flag) {
            return true;
        } else {
            return false;
        }
    }

    function izin_sebepler_getir()
    {
        $sth = $this->conn->prepare("SELECT * FROM izin_sebepleri");
        $sth->execute();
        $result = $sth->fetchAll();
        return $result;
    }

    function profilim_izin_guncelle($sebep_id, $aciklama,$baslama_tarih,$bitis_tarih,$id)
    {
        $sth = $this->conn->prepare("UPDATE izinler SET sebep_id=?,aciklama=?,baslama_tarih=?,bitis_tarih=? WHERE id=?");
        $flag = $sth->execute([$sebep_id, $aciklama,$baslama_tarih,$bitis_tarih,$id]);
        if ($flag) {
            return true;
        } else {
            return false;
        }
    }


    function profilim_izin_iptal($id)
    {
        $sth = $this->conn->prepare("DELETE FROM izinler WHERE id =?");
        $flag = $sth->execute([$id]);
        if ($flag) {
            return true;
        } else {
            return false;
        }
    }


    function izin_talep_et($id,$durum,$sebep,$aciklama,$talep_tarih,$baslama_tarih,$bitis_tarih)
    {
        $sth = $this->conn->prepare("INSERT INTO izinler
		(`personel_id`,`durum_id`,`sebep_id`,`aciklama`,`talep_tarih`,`baslama_tarih`,`bitis_tarih`)
		VALUES (?,?,?,?,?,?,?)");
        $flag = $sth->execute([$id,$durum,$sebep,$aciklama,$talep_tarih,$baslama_tarih,$bitis_tarih]);
        if ($flag) {
            return true;
        } else {
            return false;
        }
    }

    function izinler_getir($durum)
    {
        $sth = $this->conn->prepare("SELECT * , izinler.id AS izinlerid, durum.id AS durum_id FROM izinler 
INNER JOIN izin_sebepleri ON izin_sebepleri.id=izinler.sebep_id
INNER JOIN durum ON durum.id = izinler.durum_id 
INNER JOIN personel ON personel.id = izinler.personel_id 
WHERE izinler.durum_id=?");
        $sth->execute([$durum]);
        $result = $sth->fetchAll();
        return $result;
    }






}