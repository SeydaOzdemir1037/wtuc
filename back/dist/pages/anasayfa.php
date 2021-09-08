<?php include "header.php";

if(!$yetkiler['anasayfa']['sayfa_goruntuleme']){
    header("Location:yetkiYok.php");
}


?>

    <main class="app-content">
        <div class="app-title">
            <div class="text-center">
                <h1>Kullanıcı Paneli Anasayfa Ayarları</h1>
            </div>
        </div>
        <div class="row">
            <div class="col-md-4 col-sm-6">
                <div class="tile">
                    <div class="tile-title-w-btn text-center">
                        <h3 class="title">Anasayfa Ayarları</h3>
                    </div>
                    <p class="text-center">
                        <?php if ($yetkiler['anasayfa']['icerik_goruntuleme']) { ?>
                            <a class="btn btn-primary icon-btn" href="anasayfa-ayar.php">
                                Ayarlara Git
                            </a>
                        <?php } else { ?>
                            <a class="btn btn-primary icon-btn" disabled>
                                Yetkiniz YOK
                            </a>
                        <?php } ?>
                    </p>
                </div>
            </div>
            <div class="col-md-4 col-sm-6">
                <div class="tile">
                    <div class="tile-title-w-btn text-center">
                        <h3 class="title">Slider Ayarları</h3>
                    </div>
                    <p class="text-center">
                        <?php if ($yetkiler['anasayfa']['icerik_goruntuleme']) { ?>
                            <a class="btn btn-primary icon-btn" href="slider-ayar.php">
                                Ayarlara Git
                            </a>
                        <?php } else { ?>
                            <a class="btn btn-primary icon-btn" disabled>
                                Yetkiniz YOK
                            </a>
                        <?php } ?>
                    </p>
                </div>
            </div>
            <div class="col-md-4 col-sm-6">
                <div class="tile">
                    <div class="tile-title-w-btn text-center">
                        <h3 class="title">Sosyal Medya Ayarları</h3>
                    </div>
                    <p class="text-center">
                        <?php if ($yetkiler['anasayfa']['icerik_goruntuleme']) { ?>
                            <a class="btn btn-primary icon-btn" href="sosyal-medya-ayar.php">
                                Ayarlara Git
                            </a>
                        <?php } else { ?>
                            <a class="btn btn-primary icon-btn" disabled>
                                Yetkiniz YOK
                            </a>
                        <?php } ?>
                    </p>
                </div>
            </div>
        </div>
    </main>

<?php include "footer.php" ?>