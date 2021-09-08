<?php include "header.php";

require_once("front-end/controller/PersonelController.php");
$personelcont = new PersonelController();
$personeller = $personelcont->personel_getir();
$departmanlar = $personelcont->departman_getir();

?>


    <main id="main">

        <!-- ======= Testimonials Section ======= -->
        <section id="about" class="about hakkimizda_duzenle">
            <div class="container">
                <div class="section-title">
                    <h2>PERSONEL KADROMUZ</h2>
                </div>
            </div>
        </section>


        <!--     ======= Portfolio Section =======-->
        <div class="container icerikduzenle">
            <section class="portfolio section-bg ">
                <div class="row" data-aos="fade-up">
                    <div class="col-lg-12 d-flex justify-content-center">
                        <ul id="portfolio-flters">
                            <li data-filter="*" class="filter-active">TÜMÜ</li>
                            <?php foreach ($departmanlar as $departman) { ?>
                                <li data-filter=".<?= $departman["seo"] ?>"><?= $departman['departman'] ?> Kadromuz</li>
                            <?php } ?>

                        </ul>
                    </div>
                </div>

                <div class="row portfolio-container" data-aos="fade-up">
                    <section id="team" class="team">
                        <div class="container">
                            <?php foreach ($personeller as $personel) { ?>
                                <div class="col-sm-6 col-md-2 portfolio-item <?= $personel["seo"] ?>">
                                    <div class="member">
                                        <img src="<?= $personel['resim'] != "" ? $personel['resim'] : 'front-end/assets/img/personeller/resim_yok.PNG' ?>"
                                             class="testimonial-img img-fluid" alt="">
                                        <div class="member-info">
                                            <div class="member-info-content">
                                                <center>
                                                    <h6 style="color: white"><?=$personel['ad']." ".strtoupper($personel['soyad'])?></h6>
                                                    <span><?=$personel['departman']?></span>
                                                </center>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php } ?>

                        </div>
                    </section><!-- End Team Section -->
                </div>
            </section>
        </div>
        <!-- End Portfolio Section -->
    </main><!-- End #main -->


<?php include "footer.php" ?>