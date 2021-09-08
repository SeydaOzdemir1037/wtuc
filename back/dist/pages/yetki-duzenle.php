<?php include "header.php";

if (!$yetkiler['yetkiler']['sayfa_goruntuleme']) {
    header("Location:yetkiYok.php");
}else{
    if(!$yetkiler['yetkiler']['icerik_goruntuleme']){
        header("Location:yetkiYok.php");
    }
}




require_once("../../controller/DepartmanController.php");
$departmancont = new DepartmanController();
if (isset($_GET['sef'])) {
    $seo = $_GET['sef'];
    $departman_yetki = $departmancont->departman_secilen_getir($seo);
    $yetki_donustur = json_decode($departman_yetki['yetki'], true);
}

$error = [];
$hata = "";
if (isset($_POST['yetkiDuzenle'])) {
    $yetki = json_encode($_POST['yetkiler']);
    $seo_post = $_POST['seo'];

    $flag = $departmancont->departman_yetki_guncelle($yetki, $seo_post);
    if ($flag) {
        header("Location:yetkiler.php?yetki-duzenleme=ok");
    } else {
        array_push($error, "Hata");
    }

}

//$yetki_donustur = json_decode($departman_yetki['yetki'], true);

?>
    <main class="app-content">
        <div class="app-title">
            <div class="text-center">
                <h1><?php echo strtoupper($departman_yetki['departman']) ?> YETKİLENDİRME</h1>
            </div>
        </div>

        <div style="margin: auto;" class="tile col-md-7">
            <div class=" bs-component ">
                <form action="yetki-duzenle.php" method="post">
                    <div class="row">
                        <div class="col-md-3">
                            <ul class="nav nav-tabs ">
                                <?php foreach ($menuler as $url => $menu) {
                                    if (isset($menu['submenu'])) { ?>
                                        <li class="nav-item dropdown">
                                            <a style="font-weight: bold;color: black" class="nav-link dropdown-toggle"
                                               data-toggle="dropdown" href="#"
                                               role="button" aria-haspopup="true"
                                               aria-expanded="false"><?= $menu['title'] ?></a>
                                            <div class="dropdown-menu ">
                                                <?php foreach ($menu['submenu'] as $urlsub => $submenu) { ?>
                                                    <a class="dropdown-item" data-toggle="tab"
                                                       href="#<?= $submenu['link'] ?>"><?= $submenu['title'] ?></a>
                                                <?php } ?>
                                            </div>
                                        </li>
                                    <?php } else { ?>
                                        <li class="nav-item"><a style="font-weight: bold;color: black" class="nav-link"
                                                                data-toggle="tab"
                                                                href="#<?= $menu['link'] ?>"><?= $menu['title'] ?></a>
                                        </li>
                                    <?php }
                                } ?>
                            </ul>
                        </div>

                        <div style="margin: 0 auto" class="col-md-4 tab-content" id="myTabContent">
                            <?php foreach ($menuler as $url => $menu) {
                                if (isset($menu['submenu'])) {
                                    foreach ($menu['submenu'] as $urlsub => $submenu) { ?>
                                        <div class="tab-pane fade show" id="<?php echo $submenu['link'] ?>">
                                            <h4 class="m-b-md">"<?= $submenu['title'] ?>" yetkileri</h4>

                                            <?php foreach ($submenu['yetkiler'] as $key => $val) { ?>
                                                <div>
                                                    <input <?= (isset($yetki_donustur[$urlsub][$key]) ? 'checked' : null) ?>
                                                            type="checkbox"
                                                            name="yetkiler[<?= $urlsub ?>][<?= $key ?>]">
                                                    <?php echo $val; ?>
                                                </div>
                                            <?php } ?>

                                        </div>

                                    <?php }
                                } else { ?>
                                    <div class="tab-pane fade show" id="<?php echo $menu['link'] ?>">
                                        <h4 class="m-b-md">"<?= $menu['title'] ?>" yetkileri</h4>
                                        <p>
                                            <?php foreach ($menu['yetkiler'] as $key => $val) { ?>
                                        <div>
                                            <input <?= (isset($yetki_donustur[$url][$key]) ? 'checked' : null) ?>
                                                    type="checkbox"
                                                    name="yetkiler[<?= $url ?>][<?= $key ?>]">
                                            <?php echo $val; ?>
                                        </div>
                                        <?php } ?>
                                        </p>
                                    </div>
                                <?php }
                            } ?>
                        </div>
                    </div>
                    <input type="hidden" name="seo" value="<?= $seo ?>">

                    <?php if($yetkiler['yetkiler']['duzenleme']){?>
                    <button type="submit" name="yetkiDuzenle"
                            class="btn btn-danger  form-control mt-3">KAYDET
                    </button>
                    <?php }else{?>
                        <button type="submit"
                                class="btn btn-danger  form-control mt-3" disabled>KAYDET
                        </button>
                    <?php }?>
                </form>
            </div>
        </div>
    </main>

<?php include "footer.php" ?>