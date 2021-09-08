<?php include "header.php";

if (!$yetkiler['personeller']['sayfa_goruntuleme']) {
    header("Location:yetkiYok.php");
} else {
    if (!$yetkiler['personeller']['ekleme']) {
        header("Location:yetkiYok.php");
    }
}


require_once("../../controller/IlController.php");
require_once("../../controller/PersonelController.php");
require_once("../../controller/DepartmanController.php");
require_once("../../controller/UniversiteController.php");

$ilcont = new IlController();
$personelcont = new PersonelController();
$departmancont = new DepartmanController();
$unicont = new UniversiteController();


$ilgetir = $ilcont->il_getir();
$departmangetir = $departmancont->departman_getir();
$calisma_turler = $personelcont->calisma_turleri_listele();
$universiteler = $unicont->universite_getir();

$error = [];
if ($_POST) {
    $max_sicil = $personelcont->sicil_no_getir();
    $sicil_no = $max_sicil['sicil_no'] + 1;
    $resim = "";
    if (empty(trim($_POST['lisans_uni']))) {
        $lisans_uni_id = 0;
    } else {
        $lisans_uni_id = $_POST['lisans_uni'];
    }
    if (empty(trim($_POST['lisans_bolum']))) {
        $lisans_bolum_id = 0;
    } else {
        $lisans_bolum_id = $_POST['lisans_bolum'];
    }
    if (empty(trim($_POST['ylisans_uni']))) {
        $ylisans_uni_id = 0;
    } else {
        $ylisans_uni_id = $_POST['ylisans_uni'];
    }
    if (empty(trim($_POST['ylisans_bolum']))) {
        $ylisans_bolum_id = 0;
    } else {
        $ylisans_bolum_id = $_POST['ylisans_bolum'];
    }
    if (empty(trim($_POST['doktora_uni']))) {
        $doktora_uni_id = 0;
    } else {
        $doktora_uni_id = $_POST['doktora_uni'];
    }
    if (empty(trim($_POST['doktora_bolum']))) {
        $doktora_bolum_id = 0;
    } else {
        $doktora_bolum_id = $_POST['doktora_bolum'];
    }
    $durum_id = 7;
    if (empty(trim($_POST['tc_no']))) {
        array_push($error, "TC No Boş Bırakılamaz!");
    } else {
        $tc_no = $_POST['tc_no'];
    }
    if (empty(trim($_POST['ad']))) {
        array_push($error, "Adınız Boş Bırakılamaz!");
    } else {
        $ad = $_POST['ad'];
    }
    if (empty(trim($_POST['soyad']))) {
        array_push($error, "Soyadınız Boş Bırakılamaz!");
    } else {
        $soyad = $_POST['soyad'];
    }
    if (empty(trim($_POST['cinsiyet']))) {
        array_push($error, "Cinsiyet Bırakılamaz!");
    } else {
        $cinsiyet = $_POST['cinsiyet'];
    }
    if (empty(trim($_POST['departman']))) {
        array_push($error, "Departman Boş Bırakılamaz!");
    } else {
        $departman_id = $_POST['departman'];
        $departman_bul = $departmancont->departman_bul($departman_id);
    }
    if (empty(trim($_POST['calisma']))) {
        array_push($error, "Çalışma mevkii Boş Bırakılamaz!");
    } else {
        $calisma_tur_id = $_POST['calisma'];
        $calisma_tur_bul = $personelcont->calisma_tur_bul($calisma_tur_id);
    }
    if (empty(trim($_POST['mail']))) {
        array_push($error, "E-Posta Boş Bırakılamaz!");
    } else {
        $mail = $_POST['mail'];
    }
    if (empty(trim($_POST['adres']))) {
        array_push($error, "Adres Boş Bırakılamaz!");
    } else {
        $adres = $_POST['adres'];
    }
    if (empty(trim($_POST['telefon']))) {
        array_push($error, "Telefon Numarası Boş Bırakılamaz!");
    } else {
        $telefon = $_POST['telefon'];
    }
    if (empty(trim($_POST['il']))) {
        array_push($error, "Doğum Yeri Boş Bırakılamaz!");
    } else {
        $il = $_POST['il'];
        $secilen_il_getir = $ilcont->secilen_il_getir($il);
    }
    if (empty(trim($_POST['d_tarih']))) {
        array_push($error, "Doğum Tarihi Boş Bırakılamaz!");
    } else {
        $d_tarih = $_POST['d_tarih'];
    }
    if (empty(trim($_POST['baslama_tarihi']))) {
        array_push($error, "İşe Başlama Tarihi Boş Bırakılamaz!");
    } else {
        $baslama_tarihi = $_POST['baslama_tarihi'];
    }
    if (count($error) == 0) {
        $personel_ekle = $personelcont->personel_ekle($tc_no, $ad, $soyad, $sicil_no, $resim, $mail,
            $telefon, $d_tarih, $il, $cinsiyet, $adres, $lisans_uni_id, $lisans_bolum_id,
            $ylisans_uni_id, $ylisans_bolum_id, $doktora_uni_id, $doktora_bolum_id, $departman_id,
            $calisma_tur_id, $durum_id, $baslama_tarihi);

        if ($personel_ekle) {
            header("Location:personeller.php?eklenen-personel=$sicil_no");
        } else {
            array_push($error, "HATA. TEKRAR DENEYİNİZ");
        }
    }
}

?>


<main class="app-content">
    <div class="app-title">
        <div>
            <h1>PERSONEL EKLE</h1>
        </div>
    </div>
    <?php if (count($error) > 0) { ?>
        <div class="alert alert-danger">
            <?php foreach ($error as $er) { ?>
                - <?php echo $er; ?><br>
            <?php } ?>
        </div>
    <?php } ?>
    <div class="row tile">
        <span>* içerikli alanların doldurulması zorunludur.</span><br>
        <form id="personelEkle" action="" method="POST">
            <div style="float: left" class="row col-md-8 ">
                <div class="col-md-6 form-group">
                    <label class="col-form-label">Ad*</label>
                    <input type="text" class="form-control" name="ad" id="ad" value="<?= $ad ?>">
                </div>
                <div class="col-md-6 form-group ">
                    <label class="col-form-label">Soyad*</label>
                    <input type="text" class="form-control" name="soyad"
                           id="soyad" value="<?= $soyad ?>">
                </div>
                <div class="col-md-6 form-group ">
                    <label class="col-form-label">E-Posta*</label>
                    <input type="email" class="form-control" name="mail"
                           id="mail" value="<?= $mail ?>">
                </div>
                <div class="col-md-6 form-group ">
                    <label class="col-form-label">TC No*</label>
                    <input type="text" class="form-control" name="tc_no"
                           id="tc_no" value="<?= $tc_no ?>">
                </div>
                <div class="col-md-12">
                    <label class="col-form-label">Adres*</label>
                    <textarea name="adres" id="adres" cols="30" rows="5"
                              class="form-control"><?= $adres ?></textarea>
                </div>
            </div>
            <div class="row col-md-4">
                <div class="col-md-12 form-group ">
                    <label class="col-form-label">Telefon*</label>
                    <input type="text" class="form-control" name="telefon" id="telefon" value="<?= $telefon ?>">
                </div>
                <div class="col-md-12 form-group ">
                    <label class="col-form-label">Doğum Yeri*</label>
                    <select class="form-control" name="il" id="il">
                        <?php if (empty($il)) { ?>
                            <option value="">Seçiniz</option>
                        <?php } else { ?>
                            <option value="<?= $il ?>"><?= $secilen_il_getir['il'] ?></option>
                        <?php }
                        foreach ($ilgetir as $iller) {
                            if ($iller['il'] != $secilen_il_getir['il']) { ?>
                                <option value="<?= $iller['id'] ?>"><?= $iller['il'] ?></option>
                            <?php }
                        } ?>


                    </select>
                </div>
                <div class="col-md-12 form-group ">
                    <label class="col-form-label">Doğum Tarihi*</label>
                    <input type="date" class="form-control" name="d_tarih" value="<?= $d_tarih ?>">
                </div>
                <div class="col-md-12 form-group ">
                    <label class="col-form-label">İşe Başlama Tarihi*</label>
                    <input type="date" class="form-control"
                           name="baslama_tarihi" value="<?= $baslama_tarihi ?>">
                </div>
            </div>
            <div class="row col-md-12">
                <div class="col-md-4 form-group">
                    <label class="col-form-label">Departman*</label>
                    <select class="form-control" name="departman" id="departman">
                        <?php if (empty($departman_id)) { ?>
                            <option value="">Seçiniz</option>
                        <?php } else { ?>
                            <option value="<?= $departman_bul['id'] ?>"><?= $departman_bul['departman'] ?></option>
                        <?php }
                        foreach ($departmangetir as $departman) {
                            if ($departman['departman'] != $departman_bul['departman']) { ?>
                                <option value="<?= $departman['id'] ?>"><?= $departman['departman'] ?></option>
                            <?php }
                        } ?>
                    </select>
                </div>
                <div class="col-md-4 form-group">
                    <label class="col-form-label">Çalışma Mevkii*</label>
                    <select class="form-control" name="calisma" id="calisma">
                        <?php if (empty($calisma_tur_id)) { ?>
                            <option value="">Seçiniz</option>
                        <?php } else { ?>
                            <option value="<?= $calisma_tur_bul['id'] ?>"><?= $calisma_tur_bul['tur'] ?></option>
                        <?php }
                        foreach ($calisma_turler as $tur) {
                            if ($tur['tur'] != $calisma_tur_bul['tur']) { ?>
                                <option value="<?= $tur['id'] ?>"><?= $tur['tur'] ?></option>
                            <?php }
                        } ?>
                    </select>
                </div>
                <div class="col-md-4 form-group">
                    <label class="col-form-label">Cinsiyet*</label>
                    <select class="form-control" name="cinsiyet" id="cinsiyet">
                        <?php if (empty($cinsiyet)) { ?>
                            <option value="">Seçiniz</option>
                        <?php } else { ?>
                            <option value="<?= $cinsiyet ?>"><?= $cinsiyet ?></option>
                        <?php } ?>
                        <option value="ERKEK">ERKEK</option>
                        <option value="KADIN">KADIN</option>
                    </select>
                </div>
            </div>
            <div class="row col-md-12">
                <div class="col-md-4 "><br>
                    <h6 class="text-center">LİSANS</h6>
                    <div class="form-group">
                        <label>Üniversite</label>
                        <select class="form-control" id="lisans_uni" name="lisans_uni">
                            <option value="">Seçiniz</option>
                            <?php foreach ($universiteler as $uni) { ?>
                                <option value="<?= $uni['id'] ?>"><?= $uni['universite'] ?></option>
                            <?php } ?>

                        </select>
                    </div>
                    <div class="form-group">
                        <label>Bölüm</label>
                        <select class="form-control" id="lisans_bolum" name="lisans_bolum"></select>
                    </div>
                </div>
                <div class="col-md-4 "><br>
                    <h6 class="text-center">YÜKSEK LİSANS</h6>
                    <div class="form-group">
                        <label>Üniversite</label>
                        <select class="form-control" id="ylisans_uni" name="ylisans_uni">
                            <option value="">Seçiniz</option>
                            <?php foreach ($universiteler as $uni) { ?>
                                <option value="<?= $uni['id'] ?>"><?= $uni['universite'] ?></option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Bölüm</label>
                        <select class="form-control" id="ylisans_bolum" name="ylisans_bolum"></select>
                    </div>
                </div>
                <div class="col-md-4 "><br>
                    <h6 class="text-center">DOKTORA</h6>
                    <div class="form-group">
                        <label>Üniversite</label>
                        <select class="form-control" id="doktora_uni" name="doktora_uni">
                            <option value="">Seçiniz</option>
                            <?php foreach ($universiteler as $uni) { ?>
                                <option value="<?= $uni['id'] ?>"><?= $uni['universite'] ?></option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Bölüm</label>
                        <select class="form-control" id="doktora_bolum" name="doktora_bolum"></select>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <button type="submit" class="btn btn-lg mw-lg btn-primary pull-right">
                    Personel Ekle
                </button>
            </div>

        </form>
    </div>
</main>
<?php include "footer.php" ?>

<script>

    function personelEkle() {
        var veriler = $('#personelEkle').serialize();
        $.ajax({
            type: "POST",
            url: "personelEkle.php",
            data: veriler
        })
    };

</script>