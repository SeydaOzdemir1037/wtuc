<?php include "header.php";

require_once("front-end/controller/ProjeController.php");
$projecont = new ProjeController();
$projeler = $projecont->projeleri_getir();
$bugunun_tarihi = new DateTime();
?>


    <main id="main">

        <section id="about" class="about hakkimizda_duzenle">
            <div class="container">
                <div class="section-title">
                    <h2>PROJELERİMİZ</h2>
                </div>
            </div>
        </section>
        <!-- ======= Portfolio Section ======= -->
        <div class="container icerikduzenle">
            <section class="portfolio section-bg ">
                <div class="row" data-aos="fade-up">
                    <div class="col-lg-12 d-flex justify-content-center">
                        <ul id="portfolio-flters">
                            <li data-filter="*" class="filter-active">TÜMÜ</li>
                            <li data-filter=".devam">Devam Eden Projeler</li>
                            <li data-filter=".bitti">Biten Projeler</li>
                        </ul>
                    </div>
                </div>

                <div class="row portfolio-container" data-aos="fade-up">
                    <?php foreach ($projeler as $proje) {
                        $durum = $proje['bitis_tarih'] < $bugunun_tarihi->format("Y-m-d") ? "devam" : "bitti";
                        ?>
                        <div class="col-sm-6 col-md-2 portfolio-item <?=$durum?>">
                            <div style="background: white;color:black;" class="portfolio-wrap">
                                <img src="front-end/assets/img/slider/foto1.jpg" class="img-fluid" alt="">
                                <p><?=$proje['proje_adi']?></p>
                                <div class="portfolio-info">
                                    <h4><?=$proje['tur']?></h4>
                                    <div class="portfolio-links">
                                        <a href="proje-<?= seo($proje['seo']) ?>" title="More Details" class="btn btn-danger"><small>Projeyi
                                                İncele</small></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php } ?>


                </div>
            </section>
        </div>
        <!-- End Portfolio Section -->

    </main><!-- End #main -->


<?php include "footer.php" ?>