<?php include "header.php";

if(!$yetkiler['hakkimizda']['sayfa_goruntuleme']){
    header("Location:yetkiYok.php");
}


include "../../controller/hakkimizda-ayarlar.php";
if (isset($_POST['hakkimizdaKaydet'])) {

    $html = '<?php' . PHP_EOL . PHP_EOL;

    foreach ($_POST['hakkimizda'] as $key => $val) {
        $html .= '$hakkimizda["' . $key . '"]=' . "'" . $val . "'" . ';' . PHP_EOL;
    }
    file_put_contents("../../controller/hakkimizda-ayarlar.php", $html);
    include "../../controller/hakkimizda-ayarlar.php";
}
?>

<main class="app-content">
    <div class="app-title">
        <div>
            <h1>Hakkımızda Ayarı</h1>
        </div>
    </div>
    <div class="row tile">
        <form action="hakkimizda.php" method="post" enctype="multipart/form-data">
            <div class="container mt-2">
                <div class="row">
                    <div class="col-sm-4 col-md-3">
                        <div class="form-group">
                            <label class="col-form-label col-form-label-sm" for="inputSmall">Hakkımızda Başlık</label>
                            <input class="form-control form-control-sm" type="text" name="hakkimizda[baslik]"
                                   value="<?= $hakkimizda['baslik'] ?>">
                        </div>
                        <!--                        <div class="form-group">-->
                        <!--                            <label class="col-form-label col-form-label-sm" for="inputSmall">Hakkımızda Resim</label>-->
                        <!--                            <img width="40%" src="-->
                        <? //= $hakkimizda['hresim'] ?><!--" alt="">-->
                        <!--                        </div>-->
                        <!--                        <div class="form-group">-->
                        <!--                            <input class="form-control-file" type="file" name="hakkimizda[hresim]">-->
                        <!--                        </div>-->
                    </div>
                    <div class="form-group col-sm-8 col-md-9">
                        <label class="col-form-label col-form-label-sm" for="inputSmall">Hakkımızda Açıklama</label>
                        <textarea cols="30" rows="3" class="form-control ckeditor"
                                  name="hakkimizda[aciklama]"><?= $hakkimizda['aciklama'] ?></textarea>
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-sm-4 col-md-3">
                        <div class="form-group">
                            <label class="col-form-label col-form-label-sm" for="inputSmall">Vizyon Başlık</label>
                            <input class="form-control form-control-sm" type="text" name="hakkimizda[vizyon-baslik]"
                                   value="<?= $hakkimizda['vizyon-baslik'] ?>">
                        </div>
                        <!--                        <div class="form-group">-->
                        <!--                            <img width="40%" src="-->
                        <? //= $hakkimizda['vresim'] ?><!--" alt="">-->
                        <!--                        </div>-->
                        <!--                        <div class="form-group">-->
                        <!--                            <label class="col-form-label col-form-label-sm" for="inputSmall">Vizyon Resim</label>-->
                        <!--                            <input class="form-control-file" type="file" name="hakkimizda[vresim]">-->
                        <!--                        </div>-->
                    </div>
                    <div class="form-group col-sm-8 col-md-9">
                        <label class="col-form-label col-form-label-sm" for="inputSmall">Vizyon Açıklama</label>
                        <textarea id="" cols="30" rows="3" class="form-control ckeditor"
                                  name="hakkimizda[vizyon-aciklama]"><?= $hakkimizda['vizyon-aciklama'] ?></textarea>
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-sm-4 col-md-3">
                        <div class="form-group">
                            <label class="col-form-label col-form-label-sm" for="inputSmall">Misyon Başlık</label>
                            <input class="form-control form-control-sm" type="text" name="hakkimizda[misyon-baslik]"
                                   value="<?= $hakkimizda['misyon-baslik'] ?>">
                        </div>
                        <!--                        <div class="form-group">-->
                        <!--                            <label class="col-form-label col-form-label-sm" for="inputSmall">Misyon Resim</label>-->
                        <!--                            <input class="form-control-file" type="file" name="hakkimizda[mresim]">-->
                        <!--                        </div>-->
                        <!--                        <div class="form-group">-->
                        <!--                            <img width="40%" src="-->
                        <? //= $hakkimizda['mresim'] ?><!--" alt="">-->
                        <!--                        </div>-->
                    </div>
                    <div class="form-group col-sm-8 col-md-9">
                        <label class="col-form-label col-form-label-sm" for="inputSmall">Misyon Açıklama</label>
                        <textarea id="" cols="30" rows="3" class="form-control ckeditor"
                                  name="hakkimizda[misyon-aciklama]"><?= $hakkimizda['misyon-aciklama'] ?></textarea>
                    </div>
                </div>
                <div class="form-group col-md-12">
                    <?php if($yetkiler['hakkimizda']['duzenleme']){?>
                        <button type="submit" name="hakkimizdaKaydet"
                                class="btn btn-lg mw-lg btn-primary pull-right">KAYDET
                        </button>
                    <?php } else { ?>
                        <button type="submit"
                                class="btn btn-lg mw-lg btn-primary pull-right" disabled>KAYDET
                        </button>
                    <?php } ?>
                </div>
        </form>

    </div>
</main>

<?php include "footer.php" ?>

<!--<script>-->
<!--    if (window.history.replaceState) {-->
<!--        window.history.replaceState(null, null, window.location.href);-->
<!--    }-->
<!--</script>-->