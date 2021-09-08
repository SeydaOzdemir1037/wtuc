<?php include "header.php";

include "back/controller/hakkimizda-ayarlar.php";

?>
<main id="main">
    <!--HAKKIMIZDA-->
    <section id="about" class="about hakkimizda_duzenle">
        <div class="container">
            <div class="section-title">
                <h2><?=strtoupper($hakkimizda["baslik"])?></h2>
            </div>
            <div class="row">

                <div class="col-lg-12 content icerikduzenle" data-aos="">
                    <!--                    <div class="col-lg-4" data-aos="">-->
                    <!--                        <img style="float: left;margin-right: 25px;" src="front-end/assets/img/slider/foto2.jpg" class="img-fluid "-->
                    <!--                             alt="">-->
                    <!--                    </div>-->

                    <h3></h3>
                    <p>
                        <?=$hakkimizda["aciklama"]?>
                    </p>
                </div>
            </div>

        </div>
    </section>
    <!--VİZYON-->
    <section id="about" class="about hakkimizda_duzenle">
        <div class="container">
            <div class="section-title">
                <h2><?=strtoupper($hakkimizda["vizyon-baslik"])?></h2>
            </div>
            <div class="row">

                <div class="col-lg-12 content icerikduzenle" data-aos="">
                    <!--                    <div class="col-lg-4" data-aos="">-->
                    <!--                        <img style="float: left;margin-right: 25px;" src="front-end/assets/img/slider/foto7.jpg" class="img-fluid "-->
                    <!--                             alt="">-->
                    <!--                    </div>-->

                    <h3></h3>
                    <p>
                        <?=$hakkimizda["vizyon-aciklama"]?>
                    </p>

                </div>
            </div>

        </div>
    </section>
    <!--MİSYON-->
    <section id="about" class="about hakkimizda_duzenle">
        <div class="container">
            <div class="section-title">
                <h2><?=strtoupper($hakkimizda["misyon-baslik"])?></h2>
            </div>
            <div class="row">

                <div class="col-lg-12 content icerikduzenle" data-aos="">
                    <!--                    <div class="col-lg-4" data-aos="">-->
                    <!--                        <img style="float: left;margin-right: 25px;" src="front-end/assets/img/slider/foto4.jpg" class="img-fluid "-->
                    <!--                             alt="">-->
                    <!--                    </div>-->

                    <h3></h3>
                    <p>
                            <?=$hakkimizda["misyon-aciklama"]?>
                    </p>

                </div>
            </div>

        </div>
    </section>


</main><!-- End #main -->


<?php include "footer.php" ?>

