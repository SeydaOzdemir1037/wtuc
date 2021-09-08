<?php


class OdemeController extends DBController
{

    function personel_odemeleri($personel_id)
    {
        $sth = $this->conn->prepare("SELECT * ,odemeler.id AS odemeid , durum.id AS durum_id FROM odemeler
INNER JOIN personel ON personel.id=odemeler.personel_id
INNER JOIN odeme_tipi ON odeme_tipi.id=odemeler.odeme_tipi_id
INNER JOIN durum ON durum.id=odemeler.durum_id
WHERE personel_id=?;");
        $sth->execute([$personel_id]);
        $result = $sth->fetchAll();
        return $result;
    }

    function odeme_bul($odeme_id)
    {
        $sth = $this->conn->prepare("SELECT * ,odemeler.id AS odemeid , durum.id AS durum_id FROM odemeler
INNER JOIN personel ON personel.id=odemeler.personel_id
INNER JOIN odeme_tipi ON odeme_tipi.id=odemeler.odeme_tipi_id
INNER JOIN durum ON durum.id=odemeler.durum_id
WHERE odemeler.id=?");
        $sth->execute([$odeme_id]);
        $result = $sth->fetch();
        return $result;
    }


    function odeme_guncelle($durum,$miktar, $id)
    {
        $sth = $this->conn->prepare("UPDATE odemeler SET durum_id=? ,odenen_miktar=? , odeme_tarihi=CURDATE() WHERE id=?");
        $flag = $sth->execute([$durum,$miktar, $id]);
        if ($flag) {
            return true;
        } else {
            return false;
        }
    }

    function odeme_turleri_cek()
    {
        $sth = $this->conn->prepare("SELECT * FROM odeme_tipi");
        $sth->execute();
        $result = $sth->fetchAll();
        return $result;
    }

    function personel_odeme_ekle($personel_id,$odeme_tipi_id,$durum_id,$odenen_miktar)
    {
        $sth = $this->conn->prepare("INSERT INTO odemeler
		(`personel_id`,`odeme_tipi_id`,`durum_id`,`odenen_miktar`,`odeme_tarihi`)
		VALUES (?,?,?,?,CURDATE())");
        $flag = $sth->execute([$personel_id,$odeme_tipi_id,$durum_id,$odenen_miktar]);
        if ($flag) {
            return true;
        } else {
            return false;
        }
    }


    function odeme_talep_et($id,$odeme_tipi,$durum,$odenen_miktar,$talep_tarih)
    {
        $sth = $this->conn->prepare("INSERT INTO odemeler
		(`personel_id`,`odeme_tipi_id`,`durum_id`,`odenen_miktar`,`talep_tarihi`)
		VALUES (?,?,?,?,?)");
        $flag = $sth->execute([$id,$odeme_tipi,$durum,$odenen_miktar,$talep_tarih]);
        if ($flag) {
            return true;
        } else {
            return false;
        }
    }


    function odemeler_getir($durum)
    {
        $sth = $this->conn->prepare("SELECT * ,odemeler.id AS odemeid , durum.id AS durum_id FROM odemeler
INNER JOIN personel ON personel.id=odemeler.personel_id
INNER JOIN odeme_tipi ON odeme_tipi.id=odemeler.odeme_tipi_id
INNER JOIN durum ON durum.id=odemeler.durum_id
WHERE odemeler.durum_id=?");
        $sth->execute([$durum]);
        $result = $sth->fetchAll();
        return $result;
    }


    function odeme_guncelleme($durum, $id)
    {
        $sth = $this->conn->prepare("UPDATE odemeler SET durum_id=? , odeme_tarihi=CURDATE() WHERE id=?");
        $flag = $sth->execute([$durum, $id]);
        if ($flag) {
            return true;
        } else {
            return false;
        }
    }


}