<?php include "header.php";

if (!$yetkiler['anasayfa']['sayfa_goruntuleme']) {
    header("Location:yetkiYok.php");
} else {
    if (!$yetkiler['anasayfa']['icerik_goruntuleme']) {
        header("Location:yetkiYok.php");
    }
}

include "../../controller/anasayfa-ayarlar.php";
if (isset($_POST['anasayfaKaydet'])) {
    $html = '<?php' . PHP_EOL . PHP_EOL;
    $eski_resim = $_POST['eski_resim'];

        $uzantilar = array('jpg', 'jpeg', 'png');
        if ($_FILES['resim']["size"] > 2097152) {
            $html .= '$anasayfa["logo"]=' . "'" . $eski_resim . "'" . ';' . PHP_EOL;
            header("Location:anasayfa-ayar.php?durum=dosya-buyuk");
        } else {
            $uzanti = strtolower(substr($_FILES['resim']["name"], strpos($_FILES['resim']["name"], '.') + 1));
            if (in_array($uzanti, $uzantilar) === false) {
                $html .= '$anasayfa["logo"]=' . "'" . $eski_resim . "'" . ';' . PHP_EOL;
                header("Location:anasayfa-ayar.php");
            } else {
                $uploads_dir = '../../anasayfa_logo';
                @$tmp_name = $_FILES['resim']["tmp_name"];
                @$name = $_FILES['resim']["name"];
                $refimgyol = $uploads_dir . "/" . $name;
                @move_uploaded_file($tmp_name, "$refimgyol");
                $html .= '$anasayfa["logo"]=' . "'" . $refimgyol . "'" . ';' . PHP_EOL;
                unlink($eski_resim);
            }
        }
    foreach ($_POST['anasayfa'] as $key => $val) {
        $html .= '$anasayfa["' . $key . '"]=' . "'" . $val . "'" . ';' . PHP_EOL;
    }
    file_put_contents("../../controller/anasayfa-ayarlar.php", $html);
    include "../../controller/anasayfa-ayarlar.php";
}


?>
<main class="app-content">
    <div class="app-title">
        <div>
            <h1>ANASAYFA AYARI</h1>
        </div>
    </div>
    <div class="row tile">

        <form action="anasayfa-ayar.php" method="post" enctype="multipart/form-data">
            <div class="container mt-2">
                <div class="row">
                    <div class="col-sm-5 col-md-5">
                        <div class="form-group">
                            <label class="col-form-label col-form-label-lg" for="inputSmall">Site Logo</label><br>
                            <img width="40%" src="<?= $anasayfa['logo'] ?>" alt="">
                        </div>
                        <div class="form-group">
                            <input class="form-control-file" id="exampleInputFile" type="file" name="resim"
                                   aria-describedby="fileHelp">
                            <input type="hidden" name="eski_resim" value="<?= $anasayfa['logo'] ?>">
                        </div>
                        <div class="form-group ">
                            <label class="col-form-label col-form-label-lg" for="inputSmall">Site isim</label>
                            <input class="form-control form-control-sm" type="text" name="anasayfa[isim]"
                                   value="<?= $anasayfa['isim'] ?>">
                        </div>
                        <div class="form-group ">
                            <label class="col-form-label col-form-label-lg" for="inputSmall">Site Footer</label>
                            <input class="form-control form-control-sm" type="text" name="anasayfa[footer]"
                                   value="<?= $anasayfa['footer'] ?>">
                        </div>
                    </div>
                    <div class="col-sm-7 col-md-7">
                        <div class="form-group">
                            <label class="col-form-label col-form-label-lg" for="inputSmall">Açıklama
                                Başlık</label>
                            <input class="form-control form-control-sm" type="text" name="anasayfa[baslik]"
                                   value="<?= $anasayfa['baslik'] ?>">
                        </div>
                        <div class="form-group">
                            <label class="col-form-label col-form-label-lg col-md-12" for="inputSmall">Açıklama</label>
                            <textarea cols="30" rows="3" class="form-control ckeditor"
                                      name="anasayfa[aciklama]"><?= $anasayfa['aciklama'] ?></textarea>
                        </div>
                    </div>
                </div>
                <div class="form-group ">
                    <?php if ($yetkiler['anasayfa']['duzenleme']) { ?>
                        <button type="submit" name="anasayfaKaydet"
                                class="btn btn-lg mw-lg btn-primary pull-right">KAYDET
                        </button>
                    <?php } else { ?>
                        <button type="button"
                                class="btn btn-lg mw-lg btn-primary pull-right" disabled>KAYDET
                        </button>
                    <?php } ?>
                </div>
            </div>
        </form>

    </div>
</main>

<?php include "footer.php" ?>
