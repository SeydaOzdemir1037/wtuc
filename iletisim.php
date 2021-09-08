<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

include "header.php";
$gittiMesaji = " ";
if (isset($_POST['submit'])) {
    require 'PHPMailer/src/Exception.php';
    require 'PHPMailer/src/PHPMailer.php';
    require 'PHPMailer/src/SMTP.php';


    $adsoyad = $_POST['adsoyad'];
    $email = $_POST['email'];
    $subject = $_POST['subject'];
    $message = $_POST['message'];


    $mail = new PHPMailer();
    $mail->isSMTP();
    $mail->SMTPOptions = array(
        'ssl' => array(
            'verify_peer' => false,
            'verify_peer_name' => false,
            'allow_self_signed' => true
        )
    );


    //$mail->SMTPDebug = 2;
    //$mail -> SMTPKeepAlive = true;
    $mail->SMTPAuth = true;
    $mail->SMTPSecure = "tls";
    $mail->Port = 587;
    $mail->Host = "smtp.gmail.com";
    $mail->Username = "sm.muhendislik0643@gmail.com";
    $mail->Password = "acaR1210";
    $mail->CharSet = "UTF-8";
    $mail->setFrom("$email");
    $mail->addAddress("sm.muhendislik0643@gmail.com");
    $body = "       " . "MAİL İÇERİĞİ" . "\n\n";
    $body .= "Gönderen Adi : " . $adsoyad . "\n";
    $body .= "E-posta Adresi : " . $email . "\n";
    $body .= "Konu: " . $subject . "\n";
    $body .= "Mesaj: " . $message .  "\n";
    $mail->Body = $body;

    $adsoyad = $_POST['adsoyad'];
    $email = $_POST['email'];
    $subject = $_POST['subject'];
    $message = $_POST['message'];

    if ($mail->send()) {
        require_once ("front-end/controller/IletisimController.php");
        $iletisimcont = new IletisimController();
        $mailgiden=$iletisimcont->mailKaydet($adsoyad,$email,$subject,$message);
        $gittiMesaji = "<br><p class='bg-success'>Sayın $adsoyad, mesajınız gönderildi...</p>";
    } else {
        echo "Hata" . $mail->ErrorInfo;
    }
} ?>


<main id="main">
    <!-- ======= Contact Section ======= -->
    <section id="contact" class="contact hakkimizda_duzenle">
        <div class="container">
            <div class="section-title">
                <h2>İletişim</h2>
                <p style="margin-bottom: 15px;">Bize her zaman ve her yerden ulaşabileceğiniz formu doldurup iletişime
                    geçebilirsiniz ya da şirketimizi ziyaret edebilirsiniz...</p>
            </div>
            <div class="row" data-aos="fade-up">

                <div class="col-lg-7 mt-5 mt-lg-0 d-flex align-items-stretch">
                    <form action="iletisim.php" method="POST" >
                        <div class="form-row">
                            <div class="col-md-12"> <?= $gittiMesaji; ?></div>
                            <div class="form-group col-sm-6 col-sm-6 col-md-6 col-xs-12 col-xs-12">
                                <label for="name">Adınız ve Soyadınız</label>
                                <input class="form-control" type="text" name="adsoyad" id="adsoyad" data-rule="minlen:4"
                                       data-msg="Lütfen en az 4 karakter giriniz"/>
                                <div class="validate"></div>
                            </div>
                            <div class="form-group col-sm-6 col-md-6 col-xs-12">
                                <label for="name">Mail Adresiniz</label>
                                <input type="email" class="form-control" name="email" id="email" data-rule="email"
                                       data-msg="Lütfen geçerli bir mail giriniz"/>
                                <div class="validate"></div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="name">Konu</label>
                            <input type="text" class="form-control" name="subject" id="subject" data-rule="minlen:4"
                                   data-msg="Lütfen en az 8 karakter ile konuyu giriniz"/>
                            <div class="validate"></div>
                        </div>
                        <div class="form-group">
                            <label for="name">Mesajınız</label>
                            <textarea class="form-control" id="message" name="message" rows="10" data-rule="required"
                                      data-msg="Lütfen mesajnızı yazınız."></textarea>
                            <div class="validate"></div>
                        </div>
                        <div class="text-center form-group">
                            <button class="btn btn-danger" type="submit" name="submit">Mesajını Gönder</button>
                        </div>
                    </form>
                </div>
                <div class="col-lg-5 d-flex align-items-stretch">
                    <div class="info">
                        <div class="address">
                            <i class="icofont-google-map"></i>
                            <h4>Konum:</h4>
                            <p> Andız, DPÜ Evliya Çelebi Yerleşkesi, Kütahya Tavşanlı Yolu 10. km, 43100 Kütahya
                                Merkez/Kütahya</p>
                        </div>

                        <div class="email">
                            <i class="icofont-envelope"></i>
                            <h4>Mail:</h4>
                            <p>sm.muhendislik@gmail.com</p>
                        </div>

                        <div class="phone">
                            <i class="icofont-phone"></i>
                            <h4>Telefon:</h4>
                            <p>(0274) 443 43 43</p>
                        </div>

                        <iframe src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d12318.015922654864!2d29.898643!3d39.4805331!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0xa51a8d9c8451df0e!2sK%C3%BCtahya%20Dumlup%C4%B1nar%20%C3%9Cniversitesi%20M%C3%BChendislik%20Fak%C3%BCltesi!5e0!3m2!1str!2str!4v1603291212798!5m2!1str!2str"
                                frameborder="0" style="border:0; width: 100%; height: 290px;" allowfullscreen></iframe>
                    </div>

                </div>
            </div>

        </div>
    </section><!-- End Contact Section -->
</main><!-- End #main -->


<?php include "footer.php" ?>


