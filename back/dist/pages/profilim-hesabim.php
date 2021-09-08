<?php


$error = [];
$message = "";
if (isset($_POST['hesabim'])) {
    $id=$_SESSION['sicil_no'];
    if (empty(trim($_POST['mail']))) {
        array_push($error, "Mail adresi giriniz...");
    } else {
        $mail=$_POST['mail'];
    }
    if (empty(trim($_POST['telefon']))) {
        array_push($error, "Telefon numarası giriniz...");
    } else {
        $telefon=$_POST['telefon'];
    }
    if (empty(trim($_POST['adres']))) {
        array_push($error, "Adres giriniz...");
    } else {
        $adres=$_POST['adres'];
    }
    if (count($error) == 0) {
        $flag = $personelcont->profilim_hesap_guncelle($mail, $telefon,$adres,$id);
        if ($flag) {
            $message = "Bilgileriniz Başarıyla Güncellendi";
        } else {
            array_push($error, "Hata");
        }
    }
    $personel = $personelcont->personel_getir($_SESSION['sicil_no']);
}

?>
<?php if ($message != "") { ?>
    <script>
        iziToast.success({
            title: 'Başarılı',
            message: 'Bilgiler güncellendi',
            position: 'topCenter'
        });
    </script>
<?php } ?>


<?php if (count($error) > 0) { ?>
    <div class="alert alert-danger">
        <?php foreach ($error as $er) { ?>
            - <?php echo $er; ?><br>
        <?php } ?>
    </div>
<?php } ?>


<div class="col-md-12">
    <div class="widget-body">
        <form action="profilim.php" method="post">
            <div class="form-bol row">
                <div class="form-group col-md-4">
                    <label class="mt-2">Ad</label>
                    <input type="text" name="ad" value="<?=$personel['ad']?>" class="form-control" disabled>
                </div>
                <div class="form-group col-md-4">
                    <label class="mt-2">Soyad</label>
                    <input type="text" name="soyad" value="<?=$personel['soyad']?>" class="form-control" disabled>
                </div>
                <div class="form-group col-md-4">
                    <label class="mt-2">Mail</label>
                    <input type="email" name="mail" value="<?=$personel['mail']?>" class="form-control">
                </div>
                <div class="form-group col-md-4">
                    <label class="mt-2">Telefon Numarası</label>
                    <input type="text" name="telefon" value="<?=$personel['telefon']?>" pattern="\d{10}" title="Lütfen geçerli bir telefon numarası giriniz."
                           placeholder="(___)___ __ __"  class="form-control">
                </div>
                <div class="form-group col-md-4">
                    <label class="mt-2">Doğum Tarihi</label>
                    <input type="date" name="d_tarih" value="<?=$personel['d_tarih']?>" class="form-control" disabled>
                </div>
                <div class="form-group col-md-4">
                    <label class="mt-2">Doğum Yeri</label>
                    <input type="text" name="d_yeri" value="<?=$personel['il']?>" class="form-control" disabled>
                </div>
                <div class="form-group col-md-2">
                    <label class="mt-2">Cinsiyet</label>
                    <input type="text" name="cinsiyet" value="<?=$personel['cinsiyet']?>" class="form-control" disabled>
                </div>
                <div class="form-group col-md-3">
                    <label class="mt-2">TC No</label>
                    <input type="text" name="cinsiyet" value="<?=$personel['tc_no']?>" class="form-control" disabled>
                </div>
                <div class="form-group col-md-7">
                    <label class="mt-2">Adres</label>
                    <textarea name="adres" id="" cols="30" rows="2" class="form-control"><?=$personel['adres']?></textarea>
                </div>
            </div>
            <div class="form-group pull-right">
                <button type="submit" class="btn btn-lg mw-lg btn-primary" name="hesabim">KAYDET</button>
            </div>
        </form>
    </div><!-- .widget-body -->

</div><!-- END column -->


