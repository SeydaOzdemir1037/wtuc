<?php


class PersonelController extends DBController
{

    function personel_getir($sicil_no)
    {
        $sth = $this->conn->prepare("SELECT *, personel.id AS personelid FROM personel 
LEFT JOIN departman ON departman.id=personel.departman_id 
LEFT JOIN durum ON durum.id=personel.durum_id 
LEFT JOIN il ON il.id=personel.d_yeri_id
LEFT JOIN universite ON universite.id=personel.lisans_uni_id AND personel.lisans_uni_id
LEFT JOIN calisma_turleri ON calisma_turleri.id=personel.calisma_tur_id
WHERE personel.sicil_no=?;");
        $sth->execute([$sicil_no]);
        $result = $sth->fetch();
        return $result;
    }


    function personel_yetki_sinirla($asd)
    {
        $sth = $this->conn->prepare("SELECT personel.id,personel.sicil_no,personel.departman_id,departman.id,departman.departman,departman.yetki,departman.seo FROM wtuc.personel
INNER JOIN departman ON departman.id=personel.departman_id WHERE personel.sicil_no=?");
        $sth->execute([$asd]);
        $result = $sth->fetch();
        return $result;
    }





    function profilim_sifre_guncelle($sifre, $personel_id)
    {
        $sth = $this->conn->prepare("UPDATE login SET sifre=? WHERE personel_id=?");
        $flag = $sth->execute([$sifre, $personel_id]);
        if ($flag) {
            return true;
        } else {
            return false;
        }
    }

    function profilim_hesap_guncelle($mail, $telefon, $adres, $id)
    {
        $sth = $this->conn->prepare("UPDATE personel SET mail=? , telefon=? , adres=? WHERE sicil_no=?");
        $flag = $sth->execute([$mail, $telefon, $adres, $id]);
        if ($flag) {
            return true;
        } else {
            return false;
        }
    }

    function profilim_egitimler_guncelle($lisans_uni_id, $lisans_bolum_id, $ylisans_uni_id, $ylisans_bolum_id,
                                         $doktora_uni_id, $doktora_bolum_id,$sicil_no)
    {
        $sth = $this->conn->prepare("UPDATE personel SET lisans_uni_id=?,lisans_bolum_id=?,
ylisans_uni_id=?,ylisans_bolum_id=?,doktora_uni_id=?,doktora_bolum_id=? WHERE sicil_no=?");
        $flag = $sth->execute([$lisans_uni_id, $lisans_bolum_id, $ylisans_uni_id, $ylisans_bolum_id,
            $doktora_uni_id, $doktora_bolum_id,$sicil_no]);
        if ($flag) {
            return true;
        } else {
            return false;
        }
    }

    function personel_listele()
    {
        $sth = $this->conn->prepare("SELECT personel.id,personel.ad,personel.telefon,personel.soyad,personel.resim,personel.sicil_no,personel.durum_id,durum.id,durum.durum,durum.renk,departman.departman FROM personel
INNER JOIN durum ON durum.id=personel.durum_id
INNER JOIN departman ON departman.id=personel.departman_id");
        $sth->execute();
        $result = $sth->fetchAll();
        return $result;
    }

    function calisma_turleri_listele()
    {
        $sth = $this->conn->prepare("SELECT * FROM calisma_turleri");
        $sth->execute();
        $result = $sth->fetchAll();
        return $result;
    }
    function calisma_tur_bul($id)
    {
        $sth = $this->conn->prepare("SELECT * FROM calisma_turleri WHERE id=?");
        $sth->execute([$id]);
        $result = $sth->fetch();
        return $result;
    }

    function personel_genel_guncelle($tc_no, $ad, $soyad, $mail, $telefon, $d_tarih, $d_yeri_id, $adres, $lisans_uni_id,
                               $lisans_bolum_id, $ylisans_uni_id, $ylisans_bolum_id, $doktora_uni_id,
                               $doktora_bolum_id, $departman_id, $calisma_tur_id, $durum_id, $baslama_tarihi, $sicil_no)
    {
        $sth = $this->conn->prepare("UPDATE personel SET 
tc_no=?,ad=?,soyad=?,mail=?,telefon=?,d_tarih=?,d_yeri_id=?,adres=?,lisans_uni_id=?,lisans_bolum_id=?,
ylisans_uni_id=?,ylisans_bolum_id=?,doktora_uni_id=?,doktora_bolum_id=?,departman_id=?,calisma_tur_id=?,
durum_id=?,baslama_tarihi=? WHERE sicil_no=?");
        $flag = $sth->execute([$tc_no, $ad, $soyad, $mail, $telefon, $d_tarih, $d_yeri_id, $adres, $lisans_uni_id,
            $lisans_bolum_id, $ylisans_uni_id, $ylisans_bolum_id, $doktora_uni_id,
            $doktora_bolum_id, $departman_id, $calisma_tur_id, $durum_id, $baslama_tarihi, $sicil_no]);
        if ($flag) {
            return true;
        } else {
            return false;
        }
    }

    function personel_ekle($tc_no, $ad, $soyad, $sicil_no, $resim, $mail,
                           $telefon, $d_tarih, $il, $cinsiyet, $adres, $lisans_uni_id, $lisans_bolum_id,
                           $ylisans_uni_id, $ylisans_bolum_id, $doktora_uni_id, $doktora_bolum_id, $departman_id,
                           $calisma_tur_id, $durum_id, $baslama_tarihi){
        $sth = $this->conn->prepare("INSERT INTO personel
		(`tc_no`,`ad`,`soyad`,`sicil_no`,`resim`,`mail`,`telefon`,`d_tarih`,`d_yeri_id`,`cinsiyet`,`adres`,`lisans_uni_id`,`lisans_bolum_id`,`ylisans_uni_id`,`ylisans_bolum_id`,`doktora_uni_id`,`doktora_bolum_id`,`departman_id`,`calisma_tur_id`,`durum_id`,`baslama_tarihi`)
		VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)");
        $flag = $sth->execute([$tc_no, $ad, $soyad, $sicil_no, $resim, $mail,
            $telefon, $d_tarih, $il, $cinsiyet, $adres, $lisans_uni_id, $lisans_bolum_id,
            $ylisans_uni_id, $ylisans_bolum_id, $doktora_uni_id, $doktora_bolum_id, $departman_id,
            $calisma_tur_id, $durum_id, $baslama_tarihi]);
        if ($flag) {
            return true;
        } else {
            return false;
        }
    }

    function personel_gecici_sifre_ver($sifre,$personel_id){
        $sth = $this->conn->prepare("INSERT INTO login(`sifre`,`personel_id`)VALUES (?,?)");
        $flag = $sth->execute([$sifre,$personel_id]);
        if ($flag) {
            return true;
        } else {
            return false;
        }
    }



    function sicil_no_getir()
    {
        $sth = $this->conn->prepare("SELECT MAX(sicil_no) as sicil_no FROM personel");
        $sth->execute();
        $result = $sth->fetch();
        return $result;
    }


    function personel_id_getir($sicil_no)
    {
        $sth = $this->conn->prepare("SELECT personel.id AS personelid FROM personel WHERE sicil_no=?");
        $sth->execute([$sicil_no]);
        $result = $sth->fetch();
        return $result;
    }

    function personel_resim_guncelle($resim, $personel_id)
    {
        $sth = $this->conn->prepare("UPDATE personel SET resim=? WHERE id=?");
        $flag = $sth->execute([$resim, $personel_id]);
        if ($flag) {
            return true;
        } else {
            return false;
        }
    }

    function personel_departman_getir($sicil_no)
    {
        $sth = $this->conn->prepare("SELECT personel.departman_id,departman.id,departman.yetki FROM personel
INNER JOIN departman ON departman.id=personel.departman_id WHERE sicil_no=?");
        $sth->execute([$sicil_no]);
        $result = $sth->fetch();
        return $result;
    }


    function personel_isten_cikar($sicil_no)
    {
        $sth = $this->conn->prepare("DELETE FROM personel WHERE sicil_no =?");
        $flag = $sth->execute([$sicil_no]);
        if ($flag) {
            return true;
        } else {
            return false;
        }
    }


}