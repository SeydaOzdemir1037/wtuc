<?php include "header.php";

if (!$yetkiler['projeler']['sayfa_goruntuleme']) {
    header("Location:yetkiYok.php");
}

require_once("../../controller/ProjeController.php");

$projecont = new ProjeController();
$projeler_getir = $projecont->projeleri_getir();

if ($_GET["sil"]) {
    $id = $_GET['sil'];
    $flag = $projecont->proje_sil($id);
    if ($flag) {
        header("Location:projeler.php?proje-sil=tamam");
    }
}
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
if ($_GET['proje-sil'] == "tamam") {
    ?>
    <script>
        iziToast.success({
            title: 'Başarılı',
            message: 'İşlem Gerçekleştirildi Gerçekleştirildi',
            position: 'topCenter'
        });
    </script>
<?php } ?>
<!---->
<!---->
<!---->
<?php
//if ($_GET['durum'] == "hata") {
//    ?>
<!--    <script>-->
<!--        iziToast.error({-->
<!--            title: 'HATA',-->
<!--            message: 'İşlem gerçekleştirilmedi!',-->
<!--            position: 'topCenter'-->
<!--        });-->
<!--    </script>-->
<?php //} ?>
<!---->


<main class="app-content">
    <div class="app-title">
        <div>
            <h1>Projeler</h1>
        </div>
    </div>

    <div class="tile">
        <?php if ($yetkiler['projeler']['ekleme']) { ?>
            <a class="" href="projeEkle.php">
                <button style="margin: 10px 0 ;" class="btn btn-primary btn-sm  ekle-butonlari"><i
                            class="fa fa-plus"></i>Proje Ekle
                </button>
            </a>
        <?php } else { ?>
            <button style="margin: 10px 0 ;" class="btn btn-primary btn-sm  ekle-butonlari" disabled><i
                        class="fa fa-plus"></i>Proje Ekle
            </button>
        <?php } ?>
        <li class="app-search pull-right">
            <input width="150px" style="border: 1px solid;" class="form-control arama-cubugu" type="search"
                   placeholder="Projelerde ara">
        </li>

        <div class="table-responsive">
            <table class="table table-striped table-bordered" width="100%"
                   cellspacing="0">
                <thead>
                <tr>
                    <th>
                        <center>Proje Adı</center>
                    </th>
                    <th>
                        <center>Proje Türü</center>
                    </th>

                    <th>
                        <center>Başlama Tarihi</center>
                    </th>
                    <th>
                        <center>Bitiş Tarihi</center>
                    </th>
                    <th>
                        <center>Süre</center>
                    </th>
                    <th>
                        <center></center>
                    </th>
                    <th>
                        <center>Durumu</center>
                    </th>
                    <th width="20%">
                        <center>İşlemler</center>
                    </th>
                </tr>
                </thead>
                <tbody class="myTable">
                <?php foreach ($projeler_getir as $getir) { ?>
                    <tr>
                        <td>
                            <center><?= $getir['proje_adi'] ?></center>
                        </td>
                        <td>
                            <center><?= strtoupper($getir["tur"]) ?></center>
                        </td>
                        <td>
                            <center><?= date("d/m/Y", strtotime($getir['baslangic_tarih'])) ?></center>
                        </td>
                        <td>
                            <center>
                                <?= date("d/m/Y", strtotime($getir['bitis_tarih'])) ?>
                            </center>
                        </td>
                        <td>
                            <center>
                                <?php $sure_hesapla = $menulercont->sure_hesaplama($getir['baslangic_tarih'], $getir['bitis_tarih']);
                                echo "<b>" . $sure_hesapla . " gün </b>"; ?>
                            </center>
                        </td>
                        <td>
                            <center>
                                <?php if ($getir['bitis_tarih'] < $bugunun_tarihi->format("Y-m-d")) { ?>
                                    PROJE BİTTİ
                                <?php } else { ?>
                                    PROJE DEVAM EDİYOR
                                <?php } ?>
                            </center>
                        </td>
                        <td>
                            <center>
                                <div class="toggle lg">
                                    <label>
                                        <?php if ($yetkiler['projeler']['duzenleme']) { ?>
                                            <input type="checkbox" class="proje_aktifPasif"
                                                   id="<?= $getir['projeid'] ?> "<?= (($getir['durum']) == "AKTİF" ? 'checked' : null) ?> >
                                            <span class="button-indecator"></span>
                                        <?php } else { ?>
                                            <input type="checkbox"<?= (($getir['durum']) == "AKTİF" ? 'checked' : null) ?>
                                                   disabled>
                                            <span class="button-indecator"></span>
                                        <?php } ?>
                                    </label>
                                </div>
                            </center>
                        </td>
                        <td>
                            <center>
                                <?php if ($yetkiler['projeler']['duzenleme']) { ?>
                                    <a class="btn btn-dark btn-sm" href="proje-<?= seo($getir['proje_adi']) ?>">
                                        Düzenle
                                    </a>
                                    <?php $url="rapor-proje?proje=".$getir['seo']?>
                                    <button class="btn btn-sm btn-primary btn-sm"
                                            onclick="window.open('<?php echo $url; ?>','popup2','width=500,height=600,top=0,left=20,scrollbars=yes');">
                                        Yazdır
                                    </button>
                                <?php } else { ?>
                                    <a class="btn btn-primary btn-sm" disabled>
                                        Düzenle
                                    </a>
                                    <a class="btn btn-info btn-sm" disabled>
                                        Yazdır
                                    </a>
                                <?php }
                                if ($yetkiler['projeler']['silme']) { ?>
                                    <button data-url="projeler.php?sil=<?= $getir['projeid'] ?>"
                                            class="btn btn-dark btn-sm sil-sweet">
                                        SİL
                                    </button>
                                <?php } else {
                                    ?>
                                    <button class="btn btn-dark btn-sm" disabled>
                                        SİL
                                    </button>
                                <?php } ?>
                            </center>
                        </td>
                    </tr>
                <?php } ?>


                </tbody>
            </table>
        </div>
    </div>

</main>


<?php include "footer.php" ?>




