<?php include "header.php";
require_once ("front-end/controller/IlanController.php");
$ilancont = new IlanController();
$guncelilan = $ilancont->guncelIlanlar(); ?>

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <main id="main">
        <section id="about" class="about hakkimizda_duzenle">
            <div class="container">
                <div class="section-title">
                    <h2>İŞ İLANLARI</h2>
                </div>
            </div>
        </section>
        <div class="icerikduzenle">
            <section class="portfolio section-bg ">
                <div class="col-md-1"></div>
                <div class="col-md-10 ilanlar">
                    <?php foreach ($guncelilan as $ilan) { ?>
                    <div class="card">
                        <div class="card-header">
                        <span>
                            <i class="bx bx-time"></i><?=$ilan['tarih']?>
                        </span>
                            <div class="baslik"><?=$ilan['baslik']?></div>
                            <p>Departman : <?=$ilan['departman']?> </p>
                            <a href="ilan-<?=seo($ilan['ilanid'])?>">
                                <button style="float:right" class="btn btn-danger">Detayları gör ve başvur</button>
                            </a>
                        </div>
                    </div>
                    <?php } ?>
                </div>
                <div class="col-md-1"></div>
            </section>
        </div>
    </main><!-- End #main -->
<?php include "footer.php" ?>