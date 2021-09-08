<?php


class ProjeController extends DBController
{

    function projeleri_getir()
    {
        $sth = $this->conn->prepare("SELECT *,projeler.id AS projeid FROM 
projeler
INNER JOIN durum ON durum.id=projeler.durum_id
INNER JOIN calisma_turleri ON calisma_turleri.id=projeler.tur_id
WHERE projeler.durum_id=1");
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

}
