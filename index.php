<?php include "header.php";

require_once("front-end/controller/AnasayfaController.php");
$slidercont = new AnasayfaController();
$slider = $slidercont->sliderResim();
?>

<!-- ======= Section Başlangıç ======= -->
<section id="hero" class="d-flex flex-column justify-content-center align-items-center">


</section><!-- Section Bitiş -->

<main style=" margin-top: -120px;" id="main">
    <div id="demo" style="width: 100%;" class="carousel slide" data-ride="carousel">

        <!-- Indicators -->
        <ul class="carousel-indicators">
            <li data-target="#demo" data-slide-to="0" class="active"></li>
            <?php for ($i = 1; $i < count($slider); $i++) { ?>
                <li data-target="#demo" data-slide-to="<?= $i ?>"></li>
            <?php } ?>

        </ul>

        <!-- The slideshow -->
        <div class="carousel-inner">
            <?php $say = 0;
            foreach ($slider as $resim) {
            $say++;
            if ($say == 1){?>
                <div style="height: 550px" class="carousel-item active">
                    <img height="550px" src="data:image/png;base64,<?=$resim['resim'] ?>">
                </div>
            <?php }else{
            ?>
            <div style="height: 550px" class="carousel-item">
                <img height="550px" src="data:image/png;base64,<?=$resim['resim'] ?>">
                    </div>
           <?php }
                } ?>

        </div>

        <!-- Left and right controls -->
        <a class=" carousel-control-prev yonler" href="#demo" data-slide="prev">
                <span class="carousel-control-prev-icon"></span>
                </a>
                <a class="carousel-control-next yonler" href="#demo" data-slide="next">
                    <span class="carousel-control-next-icon"></span>
                </a>
            </div>

            <section id="about" class="about ">
                <div class="container col-md-10 icerikduzenle">
                    <div class="row ortala">
                        <div class="col-md-6">
                            <img width="80%" src="front-end/assets/img/slider/foto9.jpg" alt="">
                        </div>
                        <div class="col-md-6  ">
                            <div style="margin-top: 50px;" class="section-title">
                                <h2>İÇERİK</h2>
                            </div>
                            <p>SM mühendislik ile projeler, yazılımlar, web tasarımı çalışmaları ihtiyaçlarına çözüm
                                bulabilirsiniz...

                            </p>
                            <a style="text-align: center" href="is-ilanlari.php">İş ilanlarını görmek için
                                tıklayınız...</a>
                        </div>
                    </div>
                </div>
            </section>
</main>

<?php include "footer.php" ?>

<script>
    $('section.awSlider .carousel').carousel({
        pause: "hover",
        interval: 2000
    });

    var startImage = $('section.awSlider .item.active > img').attr('src');
    $('section.awSlider').append('<img src="' + startImage + '">');

    $('section.awSlider .carousel').on('slid.bs.carousel', function () {
        var bscn = $(this).find('.item.active > img').attr('src');
        $('section.awSlider > img').attr('src', bscn);
    });

</script>

