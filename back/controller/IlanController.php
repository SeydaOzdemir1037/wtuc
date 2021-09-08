<?php


class IlanController extends DBController
{

    function ilanEkle($baslik, $departman_id, $aciklama, $durum_id, $sira, $son_basvuru_tarih)
    {
        $sth = $this->conn->prepare("INSERT INTO ilanlar(`baslik`,`departman_id`,`aciklama`,
                    `durum_id`,`sira`,`son_basvuru_tarih`)VALUES (?,?,?,?,?,?)");
        $flag = $sth->execute([$baslik, $departman_id, $aciklama, $durum_id, $sira, $son_basvuru_tarih]);
        if ($flag) {
            return true;
        } else {
            return false;
        }
    }

    function Ilanlar()
    {
        $sth = $this->conn->prepare("SELECT *,ilanlar.id as ilanid FROM ilanlar 
    INNER JOIN departman ON departman.id = ilanlar.departman_id 
    INNER JOIN durum ON durum.id = ilanlar.durum_id ");
        $sth->execute();
        $result = $sth->fetchAll();
        return $result;
    }

//    function suresiDolanIlanlar()
//    {
//        $sth = $this->conn->prepare("SELECT *,ilanlar.id as ilanid FROM ilanlar
//    INNER JOIN departman ON departman.id = ilanlar.departman_id
//    INNER JOIN durum ON durum.id = ilanlar.durum_id WHERE son_basvuru_tarih < current_date ;");
//        $sth->execute();
//        $result = $sth->fetchAll();
//        return $result;
//    }

    function ilanSiraBul()
    {
        $sth = $this->conn->prepare("SELECT MAX(sira) as sira FROM ilanlar");
        $sth->execute();
        $result = $sth->fetch();
        return $result;
    }

    function ilan_durum_guncelle($durum, $id)
    {
        $sth = $this->conn->prepare("UPDATE ilanlar SET durum_id=? WHERE ilanlar.id=?");
        $flag = $sth->execute([$durum, $id]);
        if ($flag) {
            return true;
        } else {
            return false;
        }
    }

    function ilanBul($ilanid)
    {
        $sth = $this->conn->prepare("SELECT *,ilanlar.id as ilanid FROM ilanlar INNER JOIN departman ON departman.id = ilanlar.departman_id INNER JOIN durum ON durum.id = ilanlar.durum_id WHERE ilanlar.id =?");
        $sth->execute([$ilanid]);
        $result = $sth->fetch();
        return $result;
    }

    function ilan_guncelle($baslik, $departman_id, $son_basvuru_tarih, $aciklama, $ilanid)
    {
        $sth = $this->conn->prepare("UPDATE ilanlar SET baslik = ? , departman_id = ?, son_basvuru_tarih = ?, 
                   aciklama = ? WHERE ilanlar.id=?");
        $flag = $sth->execute([$baslik, $departman_id, $son_basvuru_tarih, $aciklama,$ilanid]);
        if ($flag) {
            return true;
        } else {
            return false;
        }
    }

    function ilan_sil($id){
        $sth = $this->conn->prepare("DELETE FROM ilanlar WHERE ilanlar.id =?");
        $flag = $sth->execute([$id]);
        if ($flag) {
            return true;
        } else {
            return false;
        }
    }
    function ilanBasvurulari($ilanid)
    {
        $sth = $this->conn->prepare("SELECT *, basvurular.id AS basvuruid FROM basvurular 
LEFT JOIN ilanlar ON ilanlar.id=basvurular.ilan_id
LEFT JOIN il ON il.id=basvurular.d_yeri_id
LEFT JOIN universite ON universite.id=basvurular.lisans_uni_id AND basvurular.lisans_uni_id
WHERE basvurular.ilan_id=?;");
        $sth->execute([$ilanid]);
        $result = $sth->fetchAll();
        return $result;
    }
}