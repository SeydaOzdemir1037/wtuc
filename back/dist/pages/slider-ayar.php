<?php include "header.php";


if (!$yetkiler['anasayfa']['sayfa_goruntuleme']) {
    header("Location:yetkiYok.php");
} else {
    if (!$yetkiler['anasayfa']['icerik_goruntuleme']) {
        header("Location:yetkiYok.php");
    }
}


require_once("../../controller/ResimController.php");
$resimcont = new ResimController();


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    foreach ($_FILES["sliderResim"]["tmp_name"] as $key => $name) {
      $image_base64 = base64_encode(file_get_contents($name));
       $slider_ekle = $resimcont->slider_resim_ekle($image_base64);
    }
    header("Location:slider-ayar.php");
}
$slider_getir = $resimcont->slidergetir();


if ($_GET['sil']) {
    $resim_id = $_GET['sil'];
    $flag = $resimcont->resimSil($resim_id);
    if ($flag) {
        header("Location:slider-ayar.php");
    } else {
        ?>
        <script>
            iziToast.error({
                title: 'HATA',
                message: 'Silimedi',
                position: 'bottomLeft'
            });
        </script>
        <?php
    }
}
?>
<main class="app-content">
    <div class="app-title">
        <div>
            <h1>ANASAYFA SLİDER AYARI</h1>
        </div>
    </div>
    <div class="tile">

        <div class="tab-pane fade show" id="slider">
            <div style="float:right;">
                <?php if ($yetkiler['anasayfa']['ekleme']) { ?>
                <a data-toggle="modal" class="btn btn-primary btn-sm pull-right" id="ResimEkleHref">
                    Yeni Resimler Ekle
                </a>
                <div id="ResimEkleDiv" class="mt-2">
                    <form action="slider-ayar.php" method="POST" enctype="multipart/form-data">
                        <input type="file" name="sliderResim[]" multiple>
                        <button type="submit" class="btn btn-primary" name="sliderEkle">Ekle</button>
                    </form>
                </div>
                <?php } else{?>
                    <a class="btn btn-primary btn-sm pull-right" disabled="">
                        Yeni Resimler Ekle
                    </a>
                <?php }?>
            </div>
            <div class="table-responsive">
                <table class="table table-striped table-bordered" id="dataTable" width="100%"
                       cellspacing="0">
                    <thead>
                    <tr>
                        <th>
                            <center>Resim</center>
                        </th>
                        <th>
                            <center>Durum</center>
                        </th>
                        <th width="15%">
                            <center>İşlemler</center>
                        </th>
                    </tr>
                    </thead>
                    <tbody class="">
                    <?php foreach ($slider_getir as $slider) { ?>
                        <tr>
                            <td>
                                <center><img width="50px" height="50px"
                                             src="data:image/png;base64,<?= $slider['resim'] ?>"
                                             alt=""></center>
                            </td>
                            <td>
                                <center>
                                    <div class="toggle lg">
                                        <label>
                                            <?php if ($yetkiler['anasayfa']['duzenleme']) { ?>
                                                <input type="checkbox" class="slider_aktifPasif"
                                                       id="<?= $slider['id'] ?> "<?= (($slider['durum']) == 1 ? 'checked' : null) ?> >
                                                <span class="button-indecator"></span>
                                            <?php } else { ?>
                                                <input type="checkbox" disabled
                                                    <?= (($slider['durum']) == 1 ? 'checked' : null) ?> >
                                                <span class="button-indecator"></span>
                                            <?php } ?>
                                        </label>
                                    </div>
                                </center>
                            </td>
                            <td>
                                <center>
                                    <?php if ($yetkiler['anasayfa']['silme']) { ?>
                                    <button data-url="slider-ayar.php?sil=<?= $slider['id'] ?>"
                                            class="btn btn-dark  sil-sweet">
                                        Sil
                                    </button>
                                    <?php } else { ?>
                                        <button class="btn btn-dark " disabled>Sil</button>
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
</main>

<?php include "footer.php" ?>




