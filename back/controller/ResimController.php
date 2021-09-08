<?php


class ResimController extends DBController
{


    function slider_resim_ekle($resim_id)
    {
        $sth = $this->conn->prepare("INSERT INTO slider_resim (`resim`,`durum`)  VALUES (?,1)");
        $flag = $sth->execute([$resim_id]);
        if ($flag) {
            return true;
        } else {
            return false;
        }
    }


    function slider_sira_cek()
    {
        $sth = $this->conn->prepare("SELECT MAX(CAST(sira as UNSIGNED)) AS sonSira FROM resim_tur WHERE tur_id=2");
        $sth->execute();
        $result = $sth->fetch();
        return $result;
    }

//    function proje_resim_sira_cek()
//    {
//        $sth = $this->conn->prepare("SELECT MAX(sira) AS sira FROM resim_tur WHERE tur_id=1");
//        $sth->execute();
//        $result = $sth->fetch();
//        return $result;
//    }

    function slidergetir()
    {
        $sth = $this->conn->prepare("SELECT * FROM slider_resim");
        $sth->execute();
        $result = $sth->fetchAll();
        return $result;
    }

    function resimSil($id)
    {
        $sth = $this->conn->prepare("DELETE FROM slider_resim WHERE id = ? ");
        $flag = $sth->execute([$id]);
        if ($flag) {
            return true;
        } else {
            return false;
        }
    }

    function sliderDurumGuncelle($durum, $id)
    {
        $sth = $this->conn->prepare("UPDATE slider_resim SET  durum = ? WHERE id=?");
        $flag = $sth->execute([$durum, $id]);
        if ($flag) {
            return true;
        } else {
            return false;
        }
    }

    function proje_video_getir($proje_id)
    {
        $sth = $this->conn->prepare("SELECT *,videolar.id as videolarid FROM videolar
INNER JOIN durum ON durum.id=videolar.durum_id
WHERE proje_id=?");
        $sth->execute([$proje_id]);
        $result = $sth->fetchAll();
        return $result;
    }

}