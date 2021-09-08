<?php


class IlanController extends DBController
{
    function guncelIlanlar()
    {
        $sth = $this->conn->prepare("SELECT *,ilanlar.id as ilanid FROM ilanlar INNER JOIN departman ON departman.id = ilanlar.departman_id INNER JOIN durum ON durum.id = ilanlar.durum_id WHERE son_basvuru_tarih > current_date AND durum_id=1");
        $sth->execute();
        $result = $sth->fetchAll();
        return $result;
    }

    function ilanBul($ilanid)
    {
        $sth = $this->conn->prepare("SELECT *,ilanlar.id as ilanid FROM ilanlar 
    INNER JOIN departman ON departman.id = ilanlar.departman_id 
    INNER JOIN durum ON durum.id = ilanlar.durum_id WHERE ilanlar.id =?");
        $sth->execute([$ilanid]);
        $result = $sth->fetch();
        return $result;
    }

    function basvuru_ekle
        ($ilanid,$tc_no, $ad_soyad, $mail, $telefon, $d_tarih, $d_yeri_id, $cinsiyet, $lisans_uni_id, $lisans_bolum_id,
         $ylisans_uni_id, $ylisans_bolum_id, $doktora_uni_id, $doktora_bolum_id){
            $sth = $this->conn->prepare("
INSERT INTO basvurular
    (`ilan_id`,`tc_no`,`ad_soyad`,`mail`,`telefon`,`d_tarih`,`d_yeri_id`,`cinsiyet`,`lisans_uni_id`,`lisans_bolum_id`,
     `ylisans_uni_id`,`ylisans_bolum_id`,`doktora_uni_id`,`doktora_bolum_id`) 
     VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?)");

            $flag = $sth->execute([$ilanid,$tc_no, $ad_soyad, $mail, $telefon, $d_tarih, $d_yeri_id, $cinsiyet, $lisans_uni_id, $lisans_bolum_id,
                $ylisans_uni_id, $ylisans_bolum_id, $doktora_uni_id, $doktora_bolum_id]);
            if ($flag) {
                return true;
            } else {
                return false;
            }
        }
}
