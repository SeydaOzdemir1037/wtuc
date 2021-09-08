<?php include "header.php";
require_once("front-end/controller/IlanController.php");
require_once("front-end/controller/IlController.php");
require_once("front-end/controller/UniversiteController.php");

$ilcont = new IlController();
$ilgetir = $ilcont->il_getir();

$unicont = new UniversiteController();
$universiteler = $unicont->universite_getir();

if ($_GET['id']) {
    $id = $_GET['id'];
    $ilancont = new IlanController();
    $ilan = $ilancont->ilanBul($id);
}


$error = [];
$message="";
if (isset($_POST['basvuru_tamamla'])) {

    $ilanid = $_POST['ilanid'];
    if (empty(trim($_POST['tc_no']))) {
        array_push($error, "TC No Boş Bırakılamaz!");
    } else {
        $tc_no = $_POST['tc_no'];
    }
    if (empty(trim($_POST['ad_soyad']))) {
        array_push($error, "Ad Soyad Kısmı Boş Bırakılamaz!");
    } else {
        $ad_soyad = $_POST['ad_soyad'];
    }
    if (empty(trim($_POST['mail']))) {
        array_push($error, "E-Posta Boş Bırakılamaz!");
    } else {
        $mail = $_POST['mail'];
    }
    if (empty(trim($_POST['d_tarih']))) {
        array_push($error, "Doğum Tarihi Boş Bırakılamaz!");
    } else {
        $d_tarih = $_POST['d_tarih'];
    }
    if (empty(trim($_POST['d_yeri_id']))) {
        array_push($error, "Doğum Yeri Boş Bırakılamaz!");
    } else {
        $d_yeri_id = $_POST['d_yeri_id'];
    }
    if (empty(trim($_POST['cinsiyet']))) {
        array_push($error, "Cinsiyet Bırakılamaz!");
    } else {
        $cinsiyet = $_POST['cinsiyet'];
    }
    if (empty(trim($_POST['telefon']))) {
        array_push($error, "Telefon Numarası Boş Bırakılamaz!");
    } else {
        $telefon = $_POST['telefon'];
    }
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


    if (count($error) == 0) {
        $basvuru_ekle = $ilancont->basvuru_ekle($ilanid,$tc_no, $ad_soyad, $mail, $telefon, $d_tarih, $d_yeri_id, $cinsiyet, $lisans_uni_id, $lisans_bolum_id,
            $ylisans_uni_id, $ylisans_bolum_id, $doktora_uni_id, $doktora_bolum_id);
        if ($basvuru_ekle) {
            $message="Başvurunuz İletildi...";
        }
        else {
            $message="Başvurunuz sırasında bir sorun oluştu...";
        }
    }
}


?>

<main id="main">
    <section class="about hakkimizda_duzenle">
        <div class="container">
            <div class="section-title">
                <h2><?= $ilan['baslik'] ?></h2>
            </div>
            <?php if (count($error) > 0) { ?>
                <div class="alert alert-danger">
                    <?php foreach ($error as $er) { ?>
                        - <?php echo $er; ?><br>
                    <?php } ?>
                </div>
            <?php } ?>
            <?php if ($message!="") { ?>
                <div class="alert alert-success">
                   <?=$message?>
                </div>
            <?php } ?>
            <div class="row">
                <div class="col-lg-12 content icerikduzenle" data-aos="">
                    <h3><b></b></h3>
                    <?= $ilan['aciklama'] ?>
                    <p><b>Departman : </b><?= $ilan['departman'] ?> </p>
                    <p><b>Son Başvuru Tarihi : </b> <?= date("d/m/Y", strtotime($ilan['son_basvuru_tarih'])) ?></p>
                    <a href="#basvur">
                        <button style="width: 60%;float:right;" class="btn btn-primary form-control basvur-buton">HEMEN
                            BAŞVUR
                        </button>
                    </a>
                    <button style="width: 60%;float:right;" class="btn btn-primary form-control basvur-kapat-buton">
                        FORMU KAPAT
                    </button>
                </div>
            </div>
        </div>
    </section>

    <div id="basvur" class="container icerikduzenle basvuru-formu">
        <form action="ilan-<?= seo($id) ?>" method="POST">
            <div class="cerceve">
                <div class="icerikduzenle">
                    <hr>
                    <!--                    <h3>RESİM ALANI</h3>-->
                    <!--                    <hr>-->
                    <!--                    <div class="form-group ">-->
                    <!--                        <label>Resim Yükle</label>-->
                    <!--                        <input type="file" class="form-control col-md-4">-->
                    <!--                    </div>-->
                    <!--                    <hr>-->
                    <h3>KİŞİSEL BİLGİLER</h3>
                    <hr>
                    <div class="form-bol row">
                        <div class="col-sm-6 col-md-6 col-xs-12">
                            <div class="form-group">
                                <label>TC No</label>
                                <input type="text" class="form-control" name="tc_no">
                            </div>
                            <div class="form-group">
                                <label>Ad Soyad</label>
                                <input type="text" class="form-control" name="ad_soyad">
                            </div>
                            <div class="form-group">
                                <label>E-posta adresi</label>
                                <input type="email" class="form-control" name="mail">
                            </div>
                            <div class="form-group">
                                <label>Doğum Tarihi</label>
                                <input type="date" class="form-control" name="d_tarih">
                            </div>
                        </div>
                        <div class="col-sm-6 col-md-6 col-xs-12">
                            <div class="form-group">
                                <label>Doğum Yeri</label>
                                <select class="form-control" name="d_yeri_id">
                                    <?php if (empty($il)) { ?>
                                        <option value="">Seçiniz</option>
                                    <?php }
                                    foreach ($ilgetir as $iller) { ?>
                                        <option value="<?= $iller['id'] ?>"><?= $iller['il'] ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Cinsiyet</label>
                                <select class="form-control" name="cinsiyet">
                                    <option value="ERKEK" class="form-group">
                                        Erkek
                                    </option>
                                    <option value="KADIN" class="form-group">
                                        Kadın
                                    </option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Telefon Numarası</label>
                                <input type="text" class="form-control" name="telefon">
                            </div>
                        </div>
                    </div>

                    <hr>
                    <h3>ÖĞRENİM DURUMU</h3>
                    <hr>
                    <div class="form-bol row">
                        <div class="col-md-4 yan-cizgi"><br>
                            <h6>LİSANS</h6>
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

                        <div class="col-md-4 yan-cizgi"><br>
                            <h6>YÜKSEK LİSANS</h6>
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

                        <div class="col-md-4 yan-cizgi"><br>
                            <h6>DOKTORA</h6>
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
                </div>
                <input type="hidden" name="ilanid" value="<?= $ilan['ilanid'] ?>">
                <div style="text-align: right;margin-top: 20px;" class="form-group">
                    <button type="submit" class="btn btn-primary asd" name="basvuru_tamamla">BAŞVURUYU TAMAMLA</button>
                </div>
            </div>
        </form>
    </div>

</main>

<?php include "footer.php" ?>


<script>
    $(document).ready(function () {
        $(".basvuru-formu").hide();
        $(".basvur-kapat-buton").hide();
        $(".basvur-buton").click(function () {
            $(".basvur-buton").hide();
            $(".basvur-kapat-buton").fadeIn();
            $(".basvuru-formu").fadeIn(1000);
        });
        $(".basvur-kapat-buton").click(function () {
            $(".basvuru-formu").hide();
            $(".basvur-kapat-buton").hide();
            $(".basvur-buton").fadeIn();
        });
    });
</script>