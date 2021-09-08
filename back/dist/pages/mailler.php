<?php include "header.php";
require_once("../../controller/IletisimController.php");
$mailcont = new IletisimController();
$mailler = $mailcont->mailListele();
?>
    <main class="app-content">
        <div class="app-title">
            <div>
                <h1><i class="fa fa-envelope-o"></i>&nbsp;Mailler</h1>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="tile">
                    <div class="mailbox-controls pull-right">
<!--                        <div class="animated-checkbox">-->
<!--                            <label>-->
<!--                                <input type="checkbox"><span class="label-text"></span>-->
<!--                            </label>-->
<!--                        </div>-->
                        <div class="btn-group">
                            <button class="btn btn-primary btn-sm" type="button"><i class="fa fa-trash-o"></i></button>
                            <button class="btn btn-primary btn-sm" type="button"><i class="fa fa-reply"></i></button>
                            <button class="btn btn-primary btn-sm" type="button"><i class="fa fa-share"></i></button>
                            <a href="mailler.php"><button class="btn btn-primary btn-sm" type="button"><i class="fa fa-refresh"></i></button></a>
                        </div>
                    </div>
                    <div class="table-responsive mailbox-messages">
                        <table class="table table-hover">
                            <tbody>
                            <?php $say = 0 ;
                            foreach ($mailler as $mail) { ?>
                                <tr>
                                    <td>
                                        <div class="animated-checkbox">
                                            <label>
                                                <input type="checkbox"><span class="label-text"></span>
                                            </label>
                                        </div>
                                    </td>
                                    <td><i class="fa fa-star-o"></i></td>
                                    <td><?= $mail['ad soyad'] ?></td>
                                    <td><?= $mail['mail'] ?></td>
                                    <td class="mail-subject"><a href="mail-<?= seo($mail['id']) ?>"><b><?= $mail['konu'] ?>&nbsp;&nbsp;</b><?= $mail['mesaj'] ?>
                                        </a>
                                    </td>
                                    <td><?=$mail['tarih']?></td>
                                    <?$say++;?>
                                </tr>
                            <?php } ?>
                            </tbody>
                        </table>
                    </div>
                    <div class="text-right"><span class="text-muted mr-2">Showing 1-<?=$say;?></span>
                        <div class="btn-group">
                            <button class="btn btn-primary btn-sm" type="button"><i class="fa fa-chevron-left"></i>
                            </button>
                            <button class="btn btn-primary btn-sm" type="button"><i class="fa fa-chevron-right"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
<?php include "footer.php";
?>