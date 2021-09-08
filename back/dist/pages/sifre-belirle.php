<?php



if($_GET['sicil']){
    $sicil=$_GET['sicil'];


}

?>

<?php
if ($hata!= "") {
    ?>
    <script>
        iziToast.error({
            title: 'HATA',
            message: <?=$hata?>,
            position: 'topCenter'
        });
    </script>
<?php } ?>



<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Main CSS-->
    <link rel="stylesheet" type="text/css" href="css/main.css">
    <!-- Font-icon css-->
    <link rel="stylesheet" type="text/css"
          href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <title>MŞ-Yönetim Paneli</title>
    <link rel="stylesheet" href="css/iziToast.min.css">
    <script src="js/iziToast.min.js"></script>
</head>
<body>
<section class="material-half-bg">
    <div class="cover"></div>
</section>
<section class="login-content">
    <div class="logo">
        <h1>Yönetim Paneli</h1>
    </div>
    <div class="login-box">
        <form class="login-form" id='parola_belirle' action="javascript:void(0);">
            <h3 class="login-head"><i class="fa fa-lg fa-fw fa-user"></i>Şifre Belirle</h3>
            <label class="control-label">Yönetim Paneline giriş yapabilmek için lütfen yeni şifre belirleyiniz...</label>
            <div class="form-group">
                <label class="control-label">Yeni Şifre</label>
                <input  type="password" name="sifre" id="sifre_belirle" class="form-control" >
            </div>
            <div class="form-group">
                <label class="control-label">Yeni Şifre(Tekrar)</label>
                <input type="password" name="sifre_tekrar"  id="sifre_belirle_tekrar" class="form-control" >
            </div>
            <input type="hidden" name="sifrebelirle" value="sifre">
            <input type="hidden" name="personelsicil" value="<?=$sicil?>">
            <div class="form-group btn-container">
                <button type="submit" class="btn btn-primary btn-block" onclick="yeni_parola_belirle();"><i class="fa fa-sign-in fa-lg fa-fw"></i>Şifre Güncelle</button>
            </div>
        </form>

    </div>
</section>
<script>
    function yeni_parola_belirle() {
        var veriler = $('#parola_belirle').serialize();
        var hata = "";
        var yeni_sifre_uzunluk = $('#sifre_belirle').val().length;
        var yeni_sifre = $('#sifre_belirle').val();
        var yeni_sifre_tekrar = $('#sifre_belirle_tekrar').val();
        if (yeni_sifre_uzunluk < 6) {
            hata = "Yeni Şifre En Az 6 Karaket Olmalı";
        } else {
            if (yeni_sifre !== yeni_sifre_tekrar) {
                hata = "Şifreler Uyuşmuyor";
            }
        }
        if (hata !== "") {
            iziToast.error({
                title: 'Hata',
                message: hata,
                position: 'topCenter'
            });
        } else {
            $.ajax({
                type: "POST",
                url: "post_islemleri.php",
                data: veriler,
                success: function (cevap) {
                    iziToast.success({
                        title: 'Başarılı',
                        message: 'Parolanız güncellendi, Sayfaya Yönlendiriliyorsunuz...',
                        position: 'topCenter'
                    });
                    setTimeout(function () {
                        window.location = "login.php?sifre=degisti";
                    }, 1000);
                },
            })
        }

    };

</script>

<script src="js/jquery-3.3.1.min.js"></script>
<script src="js/popper.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/main.js"></script>
<!-- The javascript plugin to display page loading on top-->
<script src="js/plugins/pace.min.js"></script>

</body>
</html>