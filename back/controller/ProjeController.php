<?php


class ProjeController extends DBController
{
    function projeleri_getir()
    {
        $sth = $this->conn->prepare("SELECT *,projeler.id AS projeid FROM projeler
INNER JOIN durum ON durum.id=projeler.durum_id
INNER JOIN calisma_turleri ON calisma_turleri.id=projeler.tur_id;");
        $sth->execute();
        $result = $sth->fetchAll();
        return $result;
    }

    function proje_bul($seo)
    {
        $sth = $this->conn->prepare("SELECT *,projeler.id AS projeid,calisma_turleri.id AS calisma_tur_id FROM wtuc.projeler
INNER JOIN durum ON durum.id=projeler.durum_id
INNER JOIN calisma_turleri ON calisma_turleri.id=projeler.tur_id WHERE seo=?");
        $sth->execute([$seo]);
        $result = $sth->fetch();
        return $result;
    }


    function projedeki_gorevlileri_bul($proje_id)
    {
        $sth = $this->conn->prepare("SELECT *,proje_gorevliler.id AS projeid FROM proje_gorevliler
INNER JOIN personel ON personel.id=proje_gorevliler.personel_id
WHERE proje_id=?");
        $sth->execute([$proje_id]);
        $result = $sth->fetchAll();
        return $result;
    }


    function personel_proje_getir($sicil_no)
    {
        $sth = $this->conn->prepare("SELECT * , projeler.id AS projeid FROM proje_gorevliler 
INNER JOIN projeler ON projeler.id=proje_gorevliler.proje_id
INNER JOIN personel ON personel.id=proje_gorevliler.personel_id
INNER JOIN durum ON durum.id=projeler.durum_sonuc_id
WHERE sicil_no=? ");
        $sth->execute([$sicil_no]);
        $result = $sth->fetchAll();
        return $result;
    }

    function personel_projeden_cek($proje_id, $personel_id)
    {
        $sth = $this->conn->prepare("DELETE FROM proje_gorevliler WHERE proje_id=? AND personel_id=?");
        $flag = $sth->execute([$proje_id, $personel_id]);
        if ($flag) {
            return true;
        } else {
            return false;
        }
    }

    function devam_eden_projeleri_getir()
    {
        $sth = $this->conn->prepare("SELECT * FROM projeler WHERE bitis_tarih > current_date();");
        $sth->execute();
        $result = $sth->fetchAll();
        return $result;
    }

    function proje_kontrol($proje_id, $personel_id)
    {
        $sth = $this->conn->prepare("SELECT * FROM proje_gorevliler WHERE proje_id=? AND personel_id=?");
        $sth->execute([$proje_id, $personel_id]);
        $result = $sth->fetchAll();
        return $result;
    }

    function personel_gorevlendir($proje_id, $personel_id)
    {
        $sth = $this->conn->prepare("INSERT INTO proje_gorevliler
		(`proje_id`,`personel_id`)
		VALUES (?,?)");
        $flag = $sth->execute([$proje_id, $personel_id]);
        if ($flag) {
            return true;
        } else {
            return false;
        }
    }


    function proje_durum_guncelle($durum_id, $id)
    {
        $sth = $this->conn->prepare("UPDATE projeler SET durum_id=? WHERE id=?");
        $flag = $sth->execute([$durum_id, $id]);
        if ($flag) {
            return true;
        } else {
            return false;
        }
    }

    function proje_resim_durum_guncelle($durum_id, $id)
    {
        $sth = $this->conn->prepare("UPDATE resimler SET proje_id_durum=? WHERE id=?");
        $flag = $sth->execute([$durum_id, $id]);
        if ($flag) {
            return true;
        } else {
            return false;
        }
    }
    function proje_video_durum_guncelle($durum_id, $id)
    {
        $sth = $this->conn->prepare("UPDATE videolar SET durum_id=? WHERE id=?");
        $flag = $sth->execute([$durum_id, $id]);
        if ($flag) {
            return true;
        } else {
            return false;
        }
    }

    function proje_guncelle($proje_adi, $aciklama, $tur_id, $baslangic_tarih, $bitis_tarih, $seo, $id)
    {
        $sth = $this->conn->prepare("UPDATE projeler SET proje_adi=?,aciklama=?,tur_id=?,baslangic_tarih=?,bitis_tarih=?,seo=? WHERE id=?");
        $flag = $sth->execute([$proje_adi, $aciklama, $tur_id, $baslangic_tarih, $bitis_tarih, $seo, $id]);
        if ($flag) {
            return true;
        } else {
            return false;
        }
    }


    function proje_sil($id)
    {
        $sth = $this->conn->prepare("DELETE FROM projeler WHERE id =?");
        $flag = $sth->execute([$id]);
        if ($flag) {
            if (file_exists('../../../documents/projeler/' . $id)) {
                foreach (glob("../../../documents/projeler/" . $id . "/*.*") as $file) {
                    unlink($file);
                }
                rmdir('../../../documents/projeler/' . $id);
            }
            return true;
        } else {
            return false;
        }
    }

    function proje_ekle($ad,$seo,$tur_id,$baslangic,$bitis,$aciklama,$durum_id)
    {
        $sth = $this->conn->prepare("INSERT INTO projeler
		(`proje_adi`,`seo`,`tur_id`,`baslangic_tarih`,`bitis_tarih`,`aciklama`,`durum_id`)
		VALUES (?,?,?,?,?,?,?)");
        $flag = $sth->execute([$ad,$seo,$tur_id,$baslangic,$bitis,$aciklama,$durum_id]);
        if ($flag) {
            $id = $this->conn->lastInsertId();
        } else {
            $id = false;
        }
        return $id;
    }


    function proje_resim_sil($url)
    {
        if (unlink("../../../" . $url)) {
            return true;
        } else {
            return false;
        }
    }

}