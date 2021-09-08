<?php include "header.php";


if (!$yetkiler['personeller']['sayfa_goruntuleme']) {
    header("Location:yetkiYok.php");
} else {
    if (!$yetkiler['personeller']['icerik_goruntuleme']) {
        header("Location:yetkiYok.php");
    }
}


if ($_GET['sicil'] && !isset($_GET['cek'])) {
    $sicil = $_GET['sicil'];
}

require_once("../../controller/DurumController.php");
require_once("../../controller/IlController.php");
require_once("../../controller/UniversiteController.php");
require_once("../../controller/IzinController.php");
require_once("../../controller/ProjeController.php");
require_once("../../controller/OdemeController.php");

$durumcont = new DurumController();
$ilcont = new IlController();
$unicont = new UniversiteController();
$izincont = new IzinController();
$projecont = new ProjeController();
$odemecont = new OdemeController();


if (isset($_POST['genel_kaydet'])) {

    $ad = $_POST['ad'];
    $soyad = $_POST['soyad'];
    $mail = $_POST['mail'];
    $telefon = $_POST['telefon'];
    $d_yeri_id = $_POST['il'];
    $d_tarih = $_POST['d_tarih'];
    $tc_no = $_POST['tc_no'];
    $baslama_tarihi = $_POST['baslama_tarihi'];
    $departman_id = $_POST['departman'];
    $durum_id = $_POST['durum'];
    $calisma_tur_id = $_POST['calisma'];
    $adres = $_POST['adres'];

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

    $personel_guncelle = $personelcont->personel_genel_guncelle($tc_no, $ad, $soyad, $mail, $telefon, $d_tarih, $d_yeri_id, $adres, $lisans_uni_id,
        $lisans_bolum_id, $ylisans_uni_id, $ylisans_bolum_id, $doktora_uni_id,
        $doktora_bolum_id, $departman_id, $calisma_tur_id, $durum_id, $baslama_tarihi, $sicil);
    if ($personel_guncelle) {
        header("Location:personel-" . seo($sicil) . "?guncelleme=tamam");
    } else {
        ?>
        <script>
            iziToast.error({
                title: 'Başarısız',
                message: 'Bir hata oluştu tekrar deneyiniz...',
                position: 'topCenter'
            });
        </script>
    <?php }
}


$personel = $personelcont->personel_getir($sicil);
$departman = $departmancont->departman_getir();

if (($_GET['sicil']) && ($_GET['cek'])) {
    $sicil = $_GET['sicil'];
    $personel_id = $personelcont->personel_id_getir($sicil);
    $proje_id = $_GET['cek'];
    $projedencek = $projecont->personel_projeden_cek($proje_id, $personel_id['personelid']);
    if ($projedencek) {
        header('Location:personel-' . seo($sicil));
    }
}


$durumgetir = $durumcont->personel_duzenle_durum_getir();

$ilgetir = $ilcont->Il_getir();

$universiteler = $unicont->universite_getir();
$lisans_uni = $unicont->uni_getir($personel['lisans_uni_id']);
$ylisans_uni = $unicont->uni_getir($personel['ylisans_uni_id']);
$doktora_uni = $unicont->uni_getir($personel['doktora_uni_id']);
$lisans_uni_bolum = $unicont->universite_bolum_getir($personel['lisans_bolum_id']);
$ylisans_uni_bolum = $unicont->universite_bolum_getir($personel['ylisans_bolum_id']);
$doktora_uni_bolum = $unicont->universite_bolum_getir($personel['doktora_bolum_id']);

$izinler = $izincont->izin_getir($personel['personelid']);

$projeler = $projecont->personel_proje_getir($sicil);

$odemeler = $odemecont->personel_odemeleri($personel['personelid']);


?>


<?php
if ($_GET['guncelleme'] == "tamam") {
    ?>
    <script>
        iziToast.success({
            title: 'Başarılı',
            message: 'Güncelleme Gerçekleştirildi',
            position: 'topCenter'
        });
    </script>
<?php } ?>

<?php
if ($projedencek) {
    ?>
    <script>
        iziToast.success({
            title: 'Başarılı',
            message: 'İşlem Başarılı',
            position: 'bottomLeft'
        });
    </script>
<?php } ?>



<?php if ($_GET['durum'] == "ok") { ?>
    <script>
        iziToast.success({
            title: 'Başarılı',
            message: 'Silindi!',
            position: 'topCenter'
        });
    </script>
<?php } ?>


<main class="app-content">
    <div class="app-title">
        <div>
            <h1><?= $personel['ad'] . " " . $personel['soyad'] ?></h1>
        </div>
        <!--        <button class="btn btn-primary personel-guncelle">Değişiklikleri Kaydet</button>-->
    </div>
    <div class="container-fluid tile">
        <ul class="nav nav-pills">
            <li class="nav-item">
                <a class="nav-link active" data-toggle="pill" href="#genel">Genel</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-toggle="pill" href="#izinler">İzinler</a>
            </li>
            <!--            <li class="nav-item">-->
            <!--                <a class="nav-link" data-toggle="pill" href="#yetkilendirme">Yetkilendirme</a>-->
            <!--            </li>-->
            <li class="nav-item">
                <a class="nav-link" data-toggle="pill" href="#projeler">Bulunduğu projeler</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-toggle="pill" href="#ödemeler">Ödemeler</a>
            </li>
        </ul>
    </div>
    <div class="container-fluid tab-content">
        <div class="tab-pane container-fluid active" id="genel">
            <div style="float: left;margin-right: 15px;" class="col-md-4 tile">
                <div class="text-center">
                    <?php if (strlen($personel['resim'])) { ?>
                        <img width="50%" height="50%" src="<?= $personel['resim'] ?>">
                    <?php } else { ?>
                        <img width="50%" height="50%" src="personel_resimleri/resim_yok.PNG">
                    <?php } ?>

                </div>
                <div class="text-center isim">
                    <p><?= strtoupper($personel['ad'] . " " . $personel['soyad']) ?></p>
                    <p><?= $personel['departman'] ?></p>
                    <span><?= $personel['durum'] ?></span>
                </div>
                <hr>
                <div>
                    <label>İşe Başlama Tarihi</label>
                    <label class="baslik-karsiligi"><?= $personel['baslama_tarihi'] ?></label>
                </div>
                <div>
                    <label>Telefon No</label>
                    <label class="baslik-karsiligi"><?= $personel['telefon'] ?></label>
                </div>
                <div>
                    <label>Mail</label>
                    <label class="baslik-karsiligi"><?= $personel['mail'] ?></label>
                </div>

                <div class="pull-right mt-4">
                    <?php if ($yetkiler['personeller']['silme']) { ?>
                        <button data-url="post_islemleri.php?isten-cikar=<?= $personel['sicil_no'] ?>"
                                class="btn btn-danger sil-sweet">
                            İşten Çıkar
                        </button>
                    <?php } else { ?>
                        <button class="btn btn-danger" disabled>İşten Çıkar</button>
                    <?php } ?>
                </div>
                <div class="mt-4">
                    <?php if ($yetkiler['personeller']['sifre_sifirla']) { ?>
                        <button class="btn btn-dark">Şifre Sıfırla</button>
                    <?php } else { ?>
                        <button class="btn btn-dark" disabled>Şifre Sıfırla</button>
                    <?php } ?>
                </div>
            </div>
            <form action="personel-<?= seo($personel['sicil_no']) ?>" method="POST">
                <div class="row tile">
                    <div class="col-md-6 form-group">
                        <label class="col-form-label">Ad</label>
                        <input type="text" class="form-control" value="<?= $personel['ad'] ?>" name="ad" id="ad"
                               onkeyup="personel_genel_kontrol()">
                    </div>
                    <div class="col-md-6 form-group">
                        <label class="col-form-label">Soyad</label>
                        <input type="text" class="form-control" value="<?= $personel['soyad'] ?>" name="soyad"
                               id="soyad" onkeyup="personel_genel_kontrol()">
                    </div>
                    <div class="col-md-6 form-group">
                        <label class="col-form-label">E-Posta</label>
                        <input type="email" class="form-control" value="<?= $personel['mail'] ?>" name="mail"
                               id="mail" onkeyup="personel_genel_kontrol()">
                    </div>
                    <div class="col-md-6 form-group">
                        <label class="col-form-label">Telefon</label>
                        <input type="text" class="form-control" value="<?= $personel['telefon'] ?>" name="telefon"
                               id="telefon" pattern="\d{10}" title="Lütfen geçerli bir telefon numarası giriniz."
                               placeholder="(___)___ __ __" onkeyup="personel_genel_kontrol()">
                    </div>
                    <div class="col-md-6 form-group">
                        <label class="col-form-label">Doğum Yeri</label>
                        <select class="form-control" name="il">
                            <option value="<?= $personel['d_yeri_id'] ?>"><?= $personel['il'] ?></option>
                            <?php foreach ($ilgetir as $il) { ?>
                                <option value="<?= $il['id'] ?>"><?= $il['il'] ?></option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="col-md-6 form-group">
                        <label class="col-form-label">Doğum Tarihi</label>
                        <input type="date" class="form-control" value="<?= $personel['d_tarih'] ?>" name="d_tarih">
                    </div>
                    <div class="col-md-6 form-group">
                        <label class="col-form-label">TC No</label>
                        <input type="text" pattern="\d{11}" class="form-control" value="<?= $personel['tc_no'] ?>"
                               name="tc_no"
                               id="tc_no" title="Lütfen geçerli bir TC No Giriniz"
                               onkeyup="personel_genel_kontrol()">
                    </div>
                    <div class="col-md-6 form-group">
                        <label class="col-form-label">İşe Başlama Tarihi</label>
                        <input type="date" class="form-control" value="<?= $personel['baslama_tarihi'] ?>"
                               name="baslama_tarihi">
                    </div>
                    <div class="col-md-4 form-group">
                        <label class="col-form-label">Departman</label>
                        <select class="form-control" name="departman">
                            <option value="<?= $personel['departman_id'] ?>"><?= $personel['departman'] ?></option>
                            <?php foreach ($departman as $dgetir) { ?>
                                <option value="<?= $dgetir['id'] ?>"><?= $dgetir['departman'] ?></option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="col-md-4 form-group">
                        <label class="col-form-label">Durum</label>
                        <select class="form-control" name="durum">
                            <option value="<?= $personel['durum_id'] ?>"><?= $personel['durum'] ?></option>
                            <?php foreach ($durumgetir as $durum) { ?>
                                <option value="<?= $durum['id'] ?>"><?= $durum['durum'] ?></option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="col-md-4 form-group">
                        <label class="col-form-label">Çalışma Mevkii</label>
                        <select class="form-control" name="calisma">
                            <option value="<?= $personel['calisma_tur_id'] ?>"><?= $personel['tur'] ?></option>
                            <?php foreach ($calisma_turleri as $calisma) { ?>
                                <option value="<?= $calisma['id'] ?>"><?= $calisma['tur'] ?></option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="col-md-12">
                        <label class="col-form-label">Adres</label>
                        <textarea name="adres" id="adres" onkeyup="personel_genel_kontrol()" cols="30" rows="2"
                                  class="form-control"><?= $personel['adres'] ?></textarea>
                    </div>
                    <div class="col-md-4 "><br>
                        <h6 class="text-center">LİSANS</h6>
                        <div class="form-group">
                            <label>Üniversite</label>
                            <select class="form-control" id="lisans_uni" name="lisans_uni">
                                <option value="<?= $lisans_uni['id'] ?>"><?= $lisans_uni['universite'] ?></option>
                                <?php foreach ($universiteler as $uni) { ?>
                                    <option value="<?= $uni['id'] ?>"><?= $uni['universite'] ?></option>
                                <?php } ?>

                            </select>
                        </div>
                        <div class="form-group">
                            <label>Bölüm</label>
                            <select class="form-control" id="lisans_bolum" name="lisans_bolum">
                                <option value="<?= $lisans_uni_bolum['id'] ?>">
                                    <?= $lisans_uni_bolum['bolum'] ?></option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-4 yan-cizgi"><br>
                        <h6 class="text-center">YÜKSEK LİSANS</h6>
                        <div class="form-group">
                            <label>Üniversite</label>
                            <select class="form-control" id="ylisans_uni" name="ylisans_uni">
                                <option value="<?= $ylisans_uni['id'] ?>"><?= $ylisans_uni['universite'] ?></option>
                                <?php foreach ($universiteler as $uni) { ?>
                                    <option value="<?= $uni['id'] ?>"><?= $uni['universite'] ?></option>
                                <?php } ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Bölüm</label>
                            <select class="form-control" id="ylisans_bolum" name="ylisans_bolum">
                                <option value="<?= $ylisans_uni_bolum['id'] ?>">
                                    <?= $ylisans_uni_bolum['bolum'] ?></option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-4 yan-cizgi"><br>
                        <h6 class="text-center">DOKTORA</h6>
                        <div class="form-group">
                            <label>Üniversite</label>
                            <select class="form-control" id="doktora_uni" name="doktora_uni">
                                <option value="<?= $doktora_uni['id'] ?>"><?= $doktora_uni['universite'] ?></option>
                                <?php foreach ($universiteler as $uni) { ?>
                                    <option value="<?= $uni['id'] ?>"><?= $uni['universite'] ?></option>
                                <?php } ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Bölüm</label>
                            <select class="form-control" id="doktora_bolum" name="doktora_bolum">
                                <option value="<?= $doktora_uni_bolum['id'] ?>"><?= $doktora_uni_bolum['bolum'] ?></option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-12 form-group">
                        <?php if ($yetkiler['personeller']['genel']) { ?>
                            <button type="submit" class="btn btn-lg mw-lg btn-primary pull-right" id="genel_kaydet"
                                    name="genel_kaydet">KAYDET
                            </button>
                        <?php } else { ?>
                            <button type="submit" class="btn btn-lg mw-lg btn-primary pull-right" disabled>KAYDET
                            </button>
                        <?php } ?>
                    </div>
                </div>
            </form>
        </div>
        <div class="tab-pane container-fluid  fade" id="izinler">
            <div class="row tile">
                <div class="col-md-12">
                    <li class="app-search pull-right">
                        <input width="150px" style="border: 1px solid;" class="form-control arama-cubugu " type="search"
                               placeholder="İzinlerde ara">
                    </li>
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                            <tr>
                                <th>
                                    <center>Talep Tarihi</center>
                                </th>
                                <th>
                                    <center>Başlangıç</center>
                                </th>
                                <th>
                                    <center>Bitiş</center>
                                </th>
                                <th>
                                    <center>Süre</center>
                                </th>
                                <th>
                                    <center>Sebep</center>
                                </th>
                                <th>
                                    <center>Açıklama</center>
                                </th>
                                <th>
                                    <center>Durumu</center>
                                </th>
                                <th>
                                    <center>İşlemler</center>
                                </th>
                            </tr>
                            </thead>
                            <tbody class="myTable">
                            <?php foreach ($izinler as $izin) { ?>
                                <tr>
                                    <td>
                                        <center><?= date("d/m/Y", strtotime($izin['talep_tarih'])) ?></center>
                                    </td>
                                    <td>
                                        <center><?= date("d/m/Y", strtotime($izin['baslama_tarih'])) ?></center>
                                    </td>
                                    <td>
                                        <center><?= date("d/m/Y", strtotime($izin['bitis_tarih'])) ?></center>
                                    </td>
                                    <td>
                                        <center><?php
                                            $izin_hesapla = $menulercont->sure_hesaplama($izin['baslama_tarih'], $izin['bitis_tarih']);
                                            echo "<b>" . $izin_hesapla . " gün </b>";
                                            ?></center>
                                    </td>
                                    <td>
                                        <center> <?= $izin['sebep'] ?></center>
                                    </td>
                                    <td>
                                        <center>
                                            <button class="btn btn-outline btn-dark btn-sm" data-toggle="modal"
                                                    data-target="#aciklama<?= $izin['id'] ?>">
                                                Açıklamayı Gör
                                            </button>
                                            <div class="modal fade" id="aciklama<?= $izin['id'] ?>">
                                                <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                                                    <div class="modal-content">

                                                        <div class="modal-header">
                                                            <h4 class="modal-title text-center">Açıklama</h4>
                                                            <button type="button" class="close" data-dismiss="modal">
                                                                <span class="fa fa-times" aria-hidden="true"></span>
                                                            </button>
                                                        </div>

                                                        <div class="modal-body">
                                                            <div class="form-group">
                                                                <?= $izin['aciklama'] ?>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                        </center>
                                    </td>
                                    <td style="font-weight: bold;">
                                        <center>
                                            <?= $izin['durum'] ?>
                                        </center>
                                    </td>
                                    <td>
                                        <center>
                                            <?php if ($yetkiler['personeller']['izinler']) { ?>
                                                <?php if ($izin['durum_id'] == 10 || $izin['durum_id'] == 4 || $izin['durum_id'] == 5) { ?>
                                                    <button class="btn btn-danger" disabled>İşlem Yap</button>
                                                <?php } else { ?>
                                                    <button class="btn btn-primary" data-toggle="modal"
                                                            data-target="#personel_izin_duzenle<?= $izin['izinlerid'] ?>">
                                                        İşlem Yap
                                                    </button>
                                                <?php } ?>
                                            <?php } else { ?>
                                                <button class="btn btn-danger" disabled>İşlem Yap</button>
                                            <?php } ?>
                                        </center>
                                        <?php include "personel_izin_duzenle.php"; ?>
                                    </td>
                                </tr>
                            <?php } ?>

                            </tbody>
                        </table>
                    </div>
                </div><!-- .widget-body -->
            </div>
        </div>
        <!--        <div class="tab-pane container-fluid  fade" id="yetkilendirme">Yetkilendirme</div>-->
        <div class="tab-pane container-fluid  fade" id="projeler">
            <div class="row tile">
                <div class="col-md-12">
                    <?php if ($yetkiler['personeller']['projeler']) { ?>
                        <button style="margin: 10px" type="button" class="btn btn-sm btn-primary pull-right"
                                data-toggle="modal" data-target="#projeye-gorevlendir"><i class="fa fa-plus"></i>
                            Projeye Görevlendir
                        </button>
                    <?php } else { ?>
                        <button style="margin: 10px" type="button" class="btn btn-sm btn-primary pull-right" disabled>
                            <i class="fa fa-plus"></i>Projeye Görevlendir
                        </button>
                    <?php } ?>
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                            <tr>
                                <th>
                                    <center>Proje Adı</center>
                                </th>
                                <th>
                                    <center>Başlangıç</center>
                                </th>
                                <th>
                                    <center>Bitiş</center>
                                </th>
                                <th>
                                    <center>Süre</center>
                                </th>
                                <th>
                                    <center>Durumu</center>
                                </th>
                                <th>
                                    <center>İşlemler</center>
                                </th>
                            </tr>
                            </thead>
                            <tbody class="">

                            <?php foreach ($projeler as $proje) { ?>
                                <tr>
                                    <td>
                                        <center><?= $proje['proje_adi'] ?></center>
                                    </td>
                                    <td>
                                        <center><?= $proje['baslangic_tarih'] ?></center>
                                    </td>
                                    <td>
                                        <center><?= $proje['bitis_tarih'] ?></center>
                                    </td>
                                    <td>
                                        <center><?php
                                            $proje_sure_hesapla = $menulercont->sure_hesaplama($proje['baslangic_tarih'], $proje['bitis_tarih']);
                                            echo "<b>" . $proje_sure_hesapla . " gün </b>";
                                            ?></center>
                                    </td>
                                    <td>
                                        <center><?= $proje['durum'] ?></center>
                                    </td>
                                    <td>
                                        <center>
                                            <?php if ($yetkiler['personeller']['projeler']) { ?>
                                                <?php if ($proje['durum_sonuc_id'] == 8) { ?>
                                                    <button data-url="personelcek-<?= seo($proje['sicil_no']) ?>&<?= seo($proje['projeid']) ?>"
                                                            class="btn btn-dark btn-sm sil-sweet">Projeden Çek
                                                    </button>
                                                <?php } else { ?>
                                                    <button data-url="personelcek-<?= seo($proje['sicil_no']) ?>&<?= seo($proje['projeid']) ?>"
                                                            class="btn btn-dark btn-sm" disabled>Proje Bitii
                                                    </button>
                                                <?php } ?>
                                            <?php } else { ?>
                                                <button disabled class="btn btn-dark btn-sm">İşlem Yap</button>
                                            <?php } ?>
                                        </center>
                                    </td>
                                </tr>
                            <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <?php include "projeye-gorevlendir.php" ?>
        </div>
        <div class="tab-pane container-fluid  fade" id="ödemeler">
            <div class="row tile">
                <div class="col-md-12">
                    <?php if ($yetkiler['personeller']['odemeler']) { ?>
                        <button style="margin: 10px" type="button" class="btn btn-sm btn-primary pull-right"
                                data-toggle="modal" data-target="#personel-odeme-ekle"><i
                                    class="fa fa-plus"></i>Ödeme Ekle
                        </button>
                    <?php } else { ?>
                        <button style="margin: 10px 0 ;" class=" btn btn-primary btn-sm pull-right" disabled><i
                                    class="fa fa-plus"></i>Ödeme Ekle
                        </button>

                    <?php } ?>
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                            <tr>
                                <th>
                                    <center>Talep Tarihi</center>
                                </th>
                                <th>
                                    <center>Ödeme/Reddedilme Tarihi</center>
                                </th>
                                <th>
                                    <center>İşlem</center>
                                </th>
                                <th>
                                    <center>Tutar</center>
                                </th>
                                <th>
                                    <center>Durumu</center>
                                </th>
                                <th>
                                    <center>Ödendi</center>
                                </th>
                            </tr>
                            </thead>
                            <tbody class="">
                            <?php foreach ($odemeler as $odeme) { ?>
                                <tr>
                                    <td>
                                        <center><?= ($odeme['talep_tarihi']) ? date("d/m/Y", strtotime($odeme['talep_tarihi'])) : null ?></center>
                                    </td>
                                    <td>
                                        <center><?= ($odeme['odeme_tarihi']) ? date("d/m/Y ", strtotime($odeme['odeme_tarihi'])) : null ?></center>
                                    </td>

                                    <td>
                                        <center><?= $odeme['tip'] ?></center>
                                    </td>
                                    <td>
                                        <center><?= $odeme['odenen_miktar'] ?></center>
                                    </td>
                                    <td style="font-weight: bold;">
                                        <center><?= $odeme['durum'] ?></center>
                                    </td>

                                    <td>
                                        <center>
                                            <?php if ($yetkiler['personeller']['odemeler']) { ?>
                                                <?php if ($odeme['durum_id'] == 4) { ?>
                                                    <i class="fa fa-check" style="color:green"></i>
                                                <?php } else if ($odeme['durum_id'] == 5) { ?>
                                                    <i class="fa fa-close" style="color:green"></i>
                                                <?php } else { ?>
                                                    <a data-toggle="modal" href="#odeme_islem<?= $odeme['odemeid'] ?>">
                                                        <button class="btn btn-primary btn-sm">İşlem Yap</button>
                                                    </a>
                                                <?php } ?>
                                            <?php } else { ?>
                                                <?php if ($odeme['durum_id'] == 4) { ?>
                                                    <i class="fa fa-check" style="color:green"></i>
                                                <?php } else if ($odeme['durum_id'] == 5) { ?>
                                                    <i class="fa fa-close" style="color:green"></i>
                                                <?php } else { ?>
                                                    <button class="btn btn-primary btn-sm" disabled>İşlem Yap</button>
                                                <?php } ?>
                                            <?php } ?>

                                            <?php include "personel-odeme-onay.php" ?>
                                        </center>
                                    </td>
                                </tr>
                            <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div><!-- .widget-body -->
            </div>
            <?php include "personel-odeme-ekle.php" ?>
        </div>
    </div>
</main>


<?php include "footer.php" ?>
