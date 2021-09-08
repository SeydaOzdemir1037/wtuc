<?php


class AnasayfaController extends DBController
{
    function sliderResim(){
        $sth = $this->conn->prepare("SELECT * FROM slider_resim WHERE durum=1");
        $sth->execute();
        $result = $sth->fetchAll();
        return $result;
    }





}