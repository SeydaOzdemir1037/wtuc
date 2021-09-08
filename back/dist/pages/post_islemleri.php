<?php
require_once("../../controller/DBController.php");
require_once("../../controller/OdemeController.php");
require_once("../../controller/IzinController.php");
require_once("../../controller/ProjeController.php");
require_once("../../controller/ResimController.php");
require_once("../../controller/UniversiteController.php");
require_once("../../controller/PersonelController.php");
require_once("../../controller/SosyalMedyaController.php");
require_once("../../controller/LoginController.php");
require_once("../../controller/IlanController.php");



$resimcont = new ResimController();
$projecont = new ProjeController();
$izincont = new IzinController();
$odemecont = new OdemeController();
$unicont = new UniversiteController();
$personelcont = new PersonelController();
$sosyalmedyacont = new SosyalMedyaController();
$logincont = new LoginController();
$ilancont = new IlanController();


if ($_POST['odemeonay']) {
    $id = $_POST['id'];
    $miktar = $_POST['miktar'];
    $durum = $_POST['durum'];
    $odeme_duzenle = $odemecont->odeme_guncelle($durum, $miktar, $id);
}
if ($_POST['personelOdemeEkleme']) {
    $id = $_POST['id'];
    $odeme_turu = $_POST['odeme_turu'];
    $miktar = $_POST['miktar'];
    $odeme_duzenle = $odemecont->personel_odeme_ekle($id, $odeme_turu, 4, $miktar);
}
if ($_POST['izinonay']) {
    $id = $_POST['id'];
    $durum = $_POST['durum'];
    $izin_duzenle = $izincont->izin_guncelle($durum, $id);
}
if ($_POST['projeyeGorevlendir']) {
    $proje_id = $_POST['proje_id'];
    $personel_id = $_POST['personel_id'];
    $personel_gorevlendir = $projecont->personel_gorevlendir($proje_id, $personel_id);

}
if ($_POST['ilan_durum']) {
    $id = $_POST['id'];
    $durum = $_POST['ilan_durum'];

    $ilan_duzenle = $ilancont->ilan_durum_guncelle($durum, $id);
}

if ($_POST['slider_durum']) {
    $id = $_POST['id'];
    $durum = $_POST['slider_durum'];

    $slider_duzenle = $resimcont->sliderDurumGuncelle($durum,$id);
    echo $slider_duzenle;
}

if ($_POST['sosyal_medya_durum']) {
    $id = $_POST['id'];
    $durum = $_POST['sosyal_medya_durum'];

    $sosyal_medya_duzenle = $sosyalmedyacont->sosyal_medya_durum_guncelle($durum, $id);
}


if ($_POST['lisans_uni']) {
    $bolumler = $unicont->uni_bolum_bul($_POST['lisans_uni']);
    echo json_encode($bolumler);
}

if ($_POST['ylisans_uni']) {
    $bolumler = $unicont->uni_bolum_bul($_POST['ylisans_uni']);
    echo json_encode($bolumler);
}

if ($_POST['doktora_uni']) {
    $bolumler = $unicont->uni_bolum_bul($_POST['doktora_uni']);
    echo json_encode($bolumler);
}


if ($_POST['profilParolaDegistir']) {
    $personel_sifre_guncelle = $personelcont->profilim_sifre_guncelle(md5($_POST['sifre_yeni']), $_POST['personel_id']);

}


if ($_POST['sosyalMedyaEkle']) {
    $ad = $_POST['ad'];
    $link = $_POST['link'];
    $icon = $_POST['icon'];
    $ekle = $sosyalmedyacont->sosyal_medya($ad, $link, $icon, 1);
}

if (isset($_POST['profilim_resim_degis'])) {
    $uzantilar = array('jpg', 'jpeg', 'png');


    if ($_FILES['resim']["size"] > 2097152) {
        header("Location:profilim.php?durum=dosya-buyuk");
    } else {
        $uzanti = strtolower(substr($_FILES['resim']["name"], strpos($_FILES['resim']["name"], '.') + 1));
        if (in_array($uzanti, $uzantilar) === false) {
            header("Location:profilim.php?durum=uzantı-hata");
        } else {
            $eski_resim = $_POST['eski_resim'];
            $personel_id = $_POST['personel_id'];
            $uploads_dir = 'personel_resimleri';
            @$tmp_name = $_FILES['resim']["tmp_name"];
            @$name = $_FILES['resim']["name"];
            $benzersizsayi = rand(20000, 32000);
            $refimgyol = $uploads_dir . "/" . $benzersizsayi . $name;

            @move_uploaded_file($tmp_name, "$uploads_dir/$benzersizsayi$name");
            $resim_guncelle = $personelcont->personel_resim_guncelle($refimgyol, $personel_id);
            if ($resim_guncelle) {
                unlink($eski_resim);
                header("Location:profilim.php?resim-guncelle=tamam");
            } else {
                header("Location:profilim.php?resim-guncelle=hata");
            }
        }
    }
}


if ($_POST['profilimizin']) {
    $id = $_POST['izin_id'];
    $aciklama = $_POST['aciklama'];
    $sebep_id = $_POST['sebep'];
    $baslama_tarih = $_POST['baslangic'];
    $bitis_tarih = $_POST['bitis'];
    $profilim_izin_guncelle = $izincont->profilim_izin_guncelle($sebep_id, $aciklama, $baslama_tarih, $bitis_tarih, $id);

}

if ($_POST['sifrebelirle']) {
    $sicil = $_POST['personelsicil'];
    $sifre = md5($_POST['sifre']);
    $personel = $personelcont->personel_id_getir($sicil);
    $personel_id = $personel['personelid'];

    $sifre_guncelle = $logincont->sifre_guncelle($sifre, $personel_id);
    if ($sifre_guncelle) {
        $dberror1 = "Giriş işleminiz başarılı. 5sn. içinde yönlendiriliyorsunuz..";
        echo '{"loginStatus":true, "context":"' . $dberror1 . '"}';
    }
}


if ($_GET['isten-cikar']) {

    $sicil = $_GET['isten-cikar'];
    $isten_cikar = $personelcont->personel_isten_cikar($sicil);
    if ($isten_cikar) {
        header("Location:personeller.php?durum=tamam");
    } else {
        header("Location:personeller.php?durum=hata");
    }
}


if ($_GET['proje_durum']) {
    $id = $_GET['id'];
    $durum = $_GET['proje_durum'];

    $proje_durum_guncelle = $projecont->proje_durum_guncelle($durum,$id);
    echo $proje_durum_guncelle;

}

if ($_POST['proje_resim_durum']) {
    $id = $_POST['id'];
    $durum = $_POST['proje_resim_durum'];

    $proje_resim_durum_guncelle = $projecont->proje_resim_durum_guncelle($durum,$id);
}

if ($_POST['proje_video_durum']) {
    $id = $_POST['id'];
    $durum = $_POST['proje_video_durum'];

    $proje_video_durum_guncelle = $projecont->proje_video_durum_guncelle($durum,$id);
}


?>
