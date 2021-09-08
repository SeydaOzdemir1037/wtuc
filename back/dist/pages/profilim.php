<?php include "header.php";

?>
<?php if ($_GET['resim-guncelle'] == "tamam") { ?>
    <script>
        iziToast.success({
            title: 'Başarılı',
            message: 'Resim Güncelleme Gerçekleştirildi...',
            position: 'topCenter'
        });
    </script>
<?php } ?>
<?php if ($_GET['resim-guncelle'] == "hata") { ?>
    <script>
        iziToast.error({
            title: 'Hata',
            message: 'Lütfen Tekrar Deneyiniz...',
            position: 'topCenter'
        });
    </script>
<?php } ?>

<?php if ($_GET['izin-iptal'] == "tamam") { ?>
    <script>
        iziToast.success({
            title: 'Başarılı',
            message: 'İzin Talebi İptal Edildi...',
            position: 'topCenter'
        });
    </script>
<?php } ?>


<main class="app-content">
    <div class="app-title">
        <div>
            <h1>Profil Bilgilerim <p id="results"></p></h1>
            <div id="results"></div>
        </div>
    </div>
    <div class="row">
        <div class="tile container-fluid profilim-hesap profilim-kapat-menu">
            <div>
                <h4><?= $personel['ad'] ?> <?= $personel['soyad'] ?>
                    <a type="button" class="pull-right kapat " data-toggle="collapse" data-target="#kapat-icon">
                        <i class="fa fa-close btn-sm"></i>
                    </a>
                    <a type="button" class="ac-kapa pull-right" data-toggle="collapse" data-target="#kapat-icon">
                        <i class="fa fa-chevron-up btn-sm "></i>
                    </a>
                </h4>
                <hr>
            </div>

            <div id="kapat-icon" class="collapse show text-center ">
                <a href="" data-toggle="modal" data-target="#resim-degistir">
                    <?php if(strlen($personel['resim'])){?>
                        <img src="<?=$personel['resim'];?>" alt="">
                    <?php }else{?>
                        <img src="personel_resimleri/resim_yok.PNG" alt="">
                    <?php }?>
                </a>
                <h3 class="m-b-lg"><?= $personel['ad'] ?> <?= $personel['soyad'] ?></h3>
                <h5 class="profil-departman">DEPARTMAN:<?= $personel['departman'] ?></h5>
                <div>
                    <button type="button" class="btn btn-lg btn-primary m-1"
                            data-toggle="modal" data-target="#profil-resim-guncelle">Profil Resmini Değiştir
                    </button>
                    <button type="button" class="btn btn-lg btn-primary m-1"
                            data-toggle="modal" data-target="#edit">Parola
                        Değiştir
                    </button>
                    <?php include "profilim-parola-degistir.php" ?>
                    <?php include "profilim-resim-degistir.php" ?>
                </div>
            </div>

        </div>

        <div class="tile col-md-12">
            <ul class="nav nav-tabs">
                <li class="nav-item"><a class="nav-link active" data-toggle="tab" href="#hesabim">Hesabım</a></li>
                <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#izin-gecmisi">İzin Geçmişim</a></li>
                <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#egitimler">Eğitimlerim</a></li>
            </ul>
            <div class="tab-content">
                <div class="tab-pane fade active show" id="hesabim">
                    <div class="row">
                        <?php include "profilim-hesabim.php" ?>
                    </div>
                </div>
                <div class="tab-pane fade  profil-menuler" id="izin-gecmisi">
                    <div class="row">
                        <?php include "profilim-izin-gecmisi.php" ?>
                    </div>
                </div>
                <div class="tab-pane fade  profil-menuler" id="egitimler">
                    <div class="row">
                        <?php include "profilim-egitimler.php" ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>

<?php include "footer.php" ?>




