<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

include "header.php";
require_once("../../controller/IletisimController.php");
$mailcont = new IletisimController();

if ($_GET['id']) {
    $mailid = $_GET['id'];
    $secilimail = $mailcont->seciliMailgetir($mailid);
}

$gittiMail = " ";
if (isset($_POST['yanit'])) {
    require '../../../PHPMailer/src/Exception.php';
    require '../../../PHPMailer/src/PHPMailer.php';
    require '../../../PHPMailer/src/SMTP.php';

    $yanit=$_POST['yanit'];
    $adsoyad=$_POST['adsoyad'];
    $email=$_POST['email'];
    $konu=$_POST['konu'];

    $mail = new PHPMailer();
    $mail->isSMTP();
    $mail->SMTPOptions = array(
        'ssl' => array(
            'verify_peer' => false,
            'verify_peer_name' => false,
            'allow_self_signed' => true
        )
    );
//    $mail->SMTPDebug = 2;
    $mail->SMTPAuth = true;
    $mail->SMTPSecure = "tls";
    $mail->Port = 587;
    $mail->Host = "smtp.gmail.com";
    $mail->Username = "sm.muhendislik0643@gmail.com";
    $mail->Password = "acaR1210";
    $mail->CharSet = "UTF-8";
    $mail->setFrom("sm.muhendislik0643@gmail.com");
    $mail->addAddress("$email");
    $body = "       " . "MAİL İÇERİĞİ" . "\n\n";
    $body .= "Gönderen Adi : " . $adsoyad . "\n";
    $body .= "E-posta Adresi : " . $email . "\n";
    $body .= "Konu: " . $konu . "\n";
    $body .= "Mesaj: " . $yanit .  "\n";
    $mail->Body = $body;

    if ($mail->send()) {
       // require_once "front-end/controller/IletisimController.php";
        //$iletisimcont = new IletisimController();
        //$mailgiden=$iletisimcont->mailKaydet($adsoyad,$email,$subject,$message,$tarih);
        $gittiMail = "<br><p class='bg-success'>Sayın $adsoyad, 
mesajınız gönderildi...</p>";
    } else {
        echo "Hata" . $mail->ErrorInfo;
    }

}

?>
<main class="app-content">
    <div class="app-title">
        <div>
            <h1><i class="fa fa-envelope-o"></i>&nbsp;<?= $secilimail['ad soyad'] ?> Kişisinden Gelen Mail</h1>
        </div>
    </div>
    <div class="col-md-12"><?=$gittiMail;?></div>
    <div class="row user">
        <div class="col-md-12">
            <div class="tab-content">
                <div class="tab-pane active">
                    <div class="timeline-post">
                        <div class="post-media"><a href="#"></a>
                            <div class="content">
                                <h5><a href="#"><?= $secilimail['ad soyad'] ?></a></h5>
                                <p class="text-muted"><small><?= $secilimail['tarih'] ?></small></p>
                            </div>
                        </div>
                        <div class="post-content">
                            <text><b>Konu :</b> <?= $secilimail['konu'] ?></text>
                            <br>
                            <text><b>Mesaj :</b> <?= $secilimail['mesaj'] ?></text>
                        </div>
                        <ul class="post-utility">
                            <li class="shares"><a href="#yanitla" role="button" data-toggle="collapse"
                                                  aria-expanded="false" aria-controls="collapseExample"><i
                                            class="fa fa-fw fa-lg fa-share"></i>Yanıtla</a></li>
                            <li class="comments"><i class="fa fa-fw fa-lg fa-comment-o"></i>Yanıtını Gör</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-12">
            <form action="secilimail.php" method="POST">
                <div class="collapse" id="yanitla">
                    <div class="card card-header">
                        <text>Kime: <?= $secilimail['mail'] ?></text>
                    </div>
                    <div class="card card-body">
                        <textarea name="yanit" id="yanit" cols="30" rows="10"
                                  class="form-control ckeditor"></textarea>
                        <input type="hidden" name="adsoyad" value="<?= $secilimail['ad soyad'] ?>">
                        <input type="hidden" name="email" value="<?= $secilimail['mail'] ?>">
                        <input type="hidden" name="konu" value="<?= $secilimail['konu'] ?>">
                        <div class="card-footer">
                            <button class="btn btn-md btn-primary pull-right" type="submit" >Gönder</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</main>
<?php include "footer.php"; ?>

