<?php

require_once("../../controller/LoginController.php");

if ($_POST['sicil_no']) {
    $gecici_sifre=md5("123456789");
    $username = $_POST['sicil_no'];
    $password = $_POST['sifre'];
    if(md5($password)==$gecici_sifre){
        header("Location:sifre-belirle.php?sicil=$username");
    }
    else{
    $logincont = new LoginController();
    $logincont->giris($username, $password);
    }
}

?>



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
        <form class="login-form" action="login.php" method="post">
            <h3 class="login-head"><i class="fa fa-lg fa-fw fa-user"></i>Giriş Yap</h3>
            <div class="form-group">
                <label class="control-label">Sicil No</label>
                <input id="sign-in-email" type="text" name="sicil_no" class="form-control" >
            </div>
            <div class="form-group">
                <label class="control-label">Şifre</label>
                <input id="sign-in-password" type="password" name="sifre" class="form-control" >
            </div>
            <div class="form-group">
                <div class="utility">
                    <div class="animated-checkbox">
                        <label>
                            <input type="checkbox"><span class="label-text">Beni Hatırla</span>
                        </label>
                    </div>
                    <p class="semibold-text mb-2"><a href="#" data-toggle="flip">Şifreni mi unuttum ?</a></p>
                </div>
            </div>
            <div class="form-group btn-container">
                <button type="submit" class="btn btn-primary btn-block"><i class="fa fa-sign-in fa-lg fa-fw"></i>Giriş Yap</button>
            </div>
        </form>
        <form class="forget-form" action="index.html">
            <h3 class="login-head"><i class="fa fa-lg fa-fw fa-lock"></i>Şifreni mi unuttum ?</h3>
            <div class="form-group">
                <label class="control-label">E-mail</label>
                <input class="form-control" type="email">
            </div>
            <div class="form-group">
                <label class="control-label">Sicil-no</label>
                <input class="form-control" type="text">
            </div>
            <div class="form-group btn-container">
                <button class="btn btn-primary btn-block"><i class="fa fa-unlock fa-lg fa-fw"></i>Şifremi Gönder
                </button>
            </div>
            <div class="form-group mt-3">
                <p class="semibold-text mb-0"><a href="#" data-toggle="flip"><i class="fa fa-angle-left fa-fw"></i>Geri
                        dön!</a></p>
            </div>
        </form>
    </div>
</section>
<!-- Essential javascripts for application to work-->
<script src="js/jquery-3.3.1.min.js"></script>
<script src="js/popper.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/main.js"></script>
<!-- The javascript plugin to display page loading on top-->
<script src="js/plugins/pace.min.js"></script>

</body>
</html>


<?php
if ($_GET['durum'] == "no") {
    ?>
    <script>
        iziToast.error({
            title: 'Hata',
            message: 'Bilgileri doğru giriniz',
            position: 'topCenter'
        });
    </script>
<?php } ?>

<?php
if ($_GET['durum'] == "izinsizgiris") {
    ?>
    <script>
        iziToast.error({
            title: 'Hata',
            message: 'Lütfen önce giriş yapınız...',
            position: 'topCenter'
        });
    </script>
<?php } ?>
