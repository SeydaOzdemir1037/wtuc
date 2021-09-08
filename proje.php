<?php include "header.php";

if ($_GET['seo']) {
    $seo = $_GET['seo'];
    require_once("front-end/controller/ProjeController.php");
    $projecont = new ProjeController();
    $proje = $projecont->proje_bul($seo);
}


?>


    <main id="main">

        <section id="about" class="about hakkimizda_duzenle">
            <div class="container">
                <div class="section-title">
                    <h2>Proje Başlık</h2>
                </div>
            </div>
        </section>
        <div class="container  icerikduzenle">

            <section class="container about hakkimizda_duzenle ">
                <div class="row">
                    <div class="col-lg-12 content" data-aos="">
                        <?= $proje['aciklama'] ?>
                    </div>
                    <div style="text-align: right" class="col-lg-12 mt-4" data-aos="">

                        <p><b>Proje Başlangıç Tarihi:</b><?= date("d/m/Y", strtotime($proje['baslangic_tarih'])) ?></p>
                        <p><b>Proje Bitiş Tarihi:</b><?= date("d/m/Y", strtotime($proje['bitis_tarih'])) ?></p>

                    </div>
                </div>

                <div class="container mt-5 ">

                    <h3>PROJE İÇERİK GALERİSİ</h3>
                    <section id="portfolio" class="portfolio section-bg">
                        <div class="row portfolio-container">
                            <?php foreach (glob("documents/projeler/".$proje['projeid']."/*.*") as $resim) {?>
                                <div class="col-sm-3 col-md-3 col-xs-12 portfolio-item ">
                                    <div class="portfolio-wrap">
                                        <img width="100%"  src="<?=$resim?>" class="img-fluid" alt="">
                                        <div class="portfolio-info">
                                            <div class="portfolio-links">
                                                <a href="<?=$resim?>"
                                                   data-gall="portfolioGallery"
                                                   class="venobox" title="<?=$proje['proje_adi']?>"><i style="font-size: 50px" class="bx bx-show "></i></a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php }?>
                        </div>
                    </section>
                </div>

            </section>

        </div>

    </main><!-- End #main -->


<?php include "footer.php" ?>