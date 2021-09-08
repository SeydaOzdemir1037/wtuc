$(document).ready(function () {


    $("#ResimEkleDiv").hide();
    $("#ResimEkleHref").click(function () {
        $("#ResimEkleDiv").fadeIn();
    });


    $(".sil-sweet").click(function (e) {
        var $data_url = $(this).data("url");

        swal({
            title: 'Emin misiniz?',
            text: "Bu işlemi geri alamayacaksınız!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Evet, Sil!',
            cancelButtonText: 'Hayır'
        }).then(function (result) {
            if (result.value) {
                window.location.href = $data_url
            }
        })
    })

    $('.ilanDurum_aktifPasif').click(function (event) {
        var id = $(this).attr("id");  //id değerini alıyoruz

        var durum = ($(this).is(':checked')) ? '1' : '2';
        //checkbox a göre aktif mi pasif mi bilgisini alıyoruz.

        $.ajax({
            type: 'POST',
            url: 'post_islemleri.php',  //işlem yaptığımız sayfayı belirtiyoruz
            data: {id: id, ilan_durum: durum}, //datamızı yolluyoruz
            success: function (e) {
                iziToast.success({
                    title: 'Başarılı',
                    message: 'Durum Güncellendi',
                    position: 'bottomLeft'
                });
            },
            error: function () {
                alert('Hata');
            }
        });
    });

    $('.slider_aktifPasif').click(function (event) {
        var id = $(this).attr("id");  //id değerini alıyoruz

        var durum = ($(this).is(':checked')) ? '1' : '0';
        //checkbox a göre aktif mi pasif mi bilgisini alıyoruz.

        $.ajax({
            type: 'POST',
            url: 'post_islemleri.php',  //işlem yaptığımız sayfayı belirtiyoruz
            data: {id: id, slider_durum: durum}, //datamızı yolluyoruz
            success: function (eaa) {
                if (e === "1") {
                    iziToast.success({
                        title: 'Başarılı',
                        message: 'Durum Güncellendi',
                        position: 'bottomLeft'
                    });
                } else {
                    iziToast.error({
                        title: 'HATA',
                        message: 'Durum Güncellenmedi',
                        position: 'bottomLeft'
                    });
                }
            },
            error: function () {
                alert('Hata');
            }
        });
    });

    $('.projeResim_aktifPasif').click(function (event) {
        var id = $(this).attr("id");  //id değerini alıyoruz

        var durum = ($(this).is(':checked')) ? '1' : '2';
        //checkbox a göre aktif mi pasif mi bilgisini alıyoruz.

        $.ajax({
            type: 'POST',
            url: 'post_islemleri.php',  //işlem yaptığımız sayfayı belirtiyoruz
            data: {id: id, projeResim_durum: durum}, //datamızı yolluyoruz
            success: function (e) {
                if (e === "1") {
                    iziToast.success({
                        title: 'Başarılı',
                        message: 'Durum Güncellendi',
                        position: 'bottomLeft'
                    });
                } else {
                    iziToast.error({
                        title: 'HATA',
                        message: 'Durum Güncellenmedi',
                        position: 'bottomLeft'
                    });
                }
            },
            error: function () {
                alert('Hata');
            }
        });
    });

    $('.sosyal_medya_aktifPasif').click(function (event) {
        var id = $(this).attr("id");  //id değerini alıyoruz

        var durum = ($(this).is(':checked')) ? '1' : '2';
        //checkbox a göre aktif mi pasif mi bilgisini alıyoruz.

        $.ajax({
            type: 'POST',
            url: 'post_islemleri.php',  //işlem yaptığımız sayfayı belirtiyoruz
            data: {id: id, sosyal_medya_durum: durum}, //datamızı yolluyoruz
            success: function (e) {
                iziToast.success({
                    title: 'Başarılı',
                    message: 'Durum Güncellendi',
                    position: 'bottomLeft'
                });
            },
            error: function () {
                alert('Hata');
            }
        });
    });

    $('.proje_aktifPasif').click(function (event) {
        var id = $(this).attr("id");  //id değerini alıyoruz

        var durum = ($(this).is(':checked')) ? '1' : '2';
        //checkbox a göre aktif mi pasif mi bilgisini alıyoruz.

        $.ajax({
            type: 'GET',
            url: 'post_islemleri.php',  //işlem yaptığımız sayfayı belirtiyoruz
            data: {id: id, proje_durum: durum}, //datamızı yolluyoruz
            success: function (data) {
                if (data === "1") {
                    iziToast.success({
                        title: 'Başarılı',
                        message: 'Durum Güncellendi',
                        position: 'bottomLeft'
                    });
                } else {
                    iziToast.error({
                        title: 'HATA',
                        message: 'Durum Güncellenmedi',
                        position: 'bottomLeft'
                    });
                }
            }
        });

    });

    $('.proje_resim_aktifPasif').click(function (event) {
        var id = $(this).attr("id");  //id değerini alıyoruz

        var durum = ($(this).is(':checked')) ? '1' : '2';
        //checkbox a göre aktif mi pasif mi bilgisini alıyoruz.

        $.ajax({
            type: 'POST',
            url: 'post_islemleri.php',  //işlem yaptığımız sayfayı belirtiyoruz
            data: {id: id, proje_resim_durum: durum}, //datamızı yolluyoruz
            success: function (data) {
                iziToast.success({
                    title: 'Başarılı',
                    message: 'Durum Güncellendi',
                    position: 'bottomLeft'
                });
            }

        });
    });

    $('.proje_video_aktifPasif').click(function (event) {
        var id = $(this).attr("id");  //id değerini alıyoruz

        var durum = ($(this).is(':checked')) ? '1' : '2';
        //checkbox a göre aktif mi pasif mi bilgisini alıyoruz.

        $.ajax({
            type: 'POST',
            url: 'post_islemleri.php',  //işlem yaptığımız sayfayı belirtiyoruz
            data: {id: id, proje_video_durum: durum}, //datamızı yolluyoruz
            success: function (data) {
                iziToast.success({
                    title: 'Başarılı',
                    message: 'Durum Güncellendi',
                    position: 'bottomLeft'
                });
            }

        });
    });


    $(".ac-kapa").on("click", function () {
        var e = $(this).closest(".x_panel"), t = $(this).find("i"), n = e.find(".x_content");
        e.attr("style") ? n.slideToggle(200, function () {
            e.removeAttr("style")
        }) : (n.slideToggle(200), e.css("height", "auto")), t.toggleClass("fa-chevron-up fa-chevron-down")
    }),

        $(".kapat").click(function () {
            var e = $(this).closest(".profilim-kapat-menu");
            e.remove()
        })

    $(".arama-cubugu").on("keyup", function () {
        var value = $(this).val().toLowerCase();
        $(".myTable tr").filter(function () {
            $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
        });
    });


    $("#lisans_uni").on('change', (function (e) {
        $("#lisans_bolum").empty();
        e.preventDefault();
        var lisans_uni = $(this).val();
        $.ajax({
            type: "POST",
            url: "post_islemleri.php",
            data: {'lisans_uni': lisans_uni},
            success: function (data) {
                $('#lisans_bolum').append('<option value="">Bölüm Seçiniz...</option>');
                var opts = $.parseJSON(data);

                $.each(opts, function (i, d) {
                    $('#lisans_bolum').append('<option value="' + d.id + '">' + d.bolum + '</option>');
                });
            },
            error: function (XMLHttpRequest, textStatus, errorThrown) {
                alert("bölümler yüklenemedi");
            }
        });
    }));


    $("#ylisans_uni").on('change', (function (e) {
        $("#ylisans_bolum").empty();
        e.preventDefault();
        var ylisans_uni = $(this).val();
        $.ajax({
            type: "POST",
            url: "post_islemleri.php",
            data: {'ylisans_uni': ylisans_uni},
            success: function (data) {
                $('#ylisans_bolum').append('<option value="">Bölüm Seçiniz...</option>');
                var opts = $.parseJSON(data);

                $.each(opts, function (i, d) {
                    $('#ylisans_bolum').append('<option value="' + d.id + '">' + d.bolum + '</option>');
                });
            },
            error: function (XMLHttpRequest, textStatus, errorThrown) {
                alert("bölümler yüklenemedi");
            }
        });
    }));


    $("#doktora_uni").on('change', (function (e) {
        $("#doktora_bolum").empty();
        e.preventDefault();
        var doktora_uni = $(this).val();
        $.ajax({
            type: "POST",
            url: "post_islemleri.php",
            data: {'doktora_uni': doktora_uni},
            success: function (data) {
                $('#doktora_bolum').append('<option value="">Bölüm Seçiniz...</option>');
                var opts = $.parseJSON(data);

                $.each(opts, function (i, d) {
                    $('#doktora_bolum').append('<option value="' + d.id + '">' + d.bolum + '</option>');
                });
            },
            error: function (XMLHttpRequest, textStatus, errorThrown) {
                alert("bölümler yüklenemedi");
            }
        });
    }));


});

function profilim_parola_degistir() {
    var veriler = $('#yeni_veri').serializeArray();
    var hata = "";
    var yeni_sifre_uzunluk = $('#sifre_yeni').val().length;
    var yeni_sifre = $('#sifre_yeni').val();
    var yeni_sifre_tekrar = $('#sifre_yeni_tekrar').val();
    if (yeni_sifre_uzunluk < 6) {
        hata = "Yeni Şifre En Az 6 Karaket Olmalı";
    } else {
        if (yeni_sifre !== yeni_sifre_tekrar) {
            hata = "Şifreler Uyuşmuyor";
        }
    }
    if (hata !== "") {
        iziToast.error({
            title: 'Hata',
            message: hata,
            position: 'topCenter'
        });
    } else {
        $.ajax({
            type: "POST",
            url: "post_islemleri.php",
            data: veriler,
            success: function (cevap) {
                iziToast.success({
                    title: 'Başarılı',
                    message: 'Parolanız güncellendi, Sayfaya Yönlendiriliyorsunuz...',
                    position: 'topCenter'
                });
                setTimeout(function () {
                    window.location.reload(1);
                }, 1000);
            },
        })
    }

};


function sosyalmedyaekle() {
    var medyaekle = $('#sosyal_medya').serialize();
    var ad = $('#ad').val();
    var link = $('#link').val();
    var icon = $('#icon').val();
    var durum = $('#durum').val();
    if (ad === "") {
        iziToast.error({
            title: 'Başarısız',
            message: 'Sosyal Medya adını giriniz! ',
            position: 'topCenter'
        });
    } else if (link === "") {
        iziToast.error({
            title: 'Başarısız',
            message: 'Sosyal Medya linkini giriniz! ',
            position: 'topCenter'
        });
    } else if (icon === "") {
        iziToast.error({
            title: 'Başarısız',
            message: 'Sosyal Medya ikonunu giriniz! ',
            position: 'topCenter'
        });
    } else {
        $.ajax({
            type: "POST",
            url: "post_islemleri.php",
            data: medyaekle,
            success: function (e) {
                iziToast.success({
                    title: 'Başarılı',
                    message: 'Ekleme Başarılı, Sayfaya Yönlendiriliyorsunuz...',
                    position: 'topCenter'
                });
                setTimeout(function () {
                    window.location.reload(1);
                }, 2000);
            }
        })
    }
};


function projeye_gorevlendir() {
    var veriler = $('#proje_gorevlendirme').serialize();
    var bos_mu = $('#proje_id').val();
    if (bos_mu === "") {
        iziToast.error({
            title: 'Hata',
            message: 'Lütfen Proje Seçiniz',
            position: 'topCenter'
        });
    } else {
        $.ajax({
            type: "POST",
            url: "post_islemleri.php",
            data: veriler,
            success: function (e) {
                iziToast.success({
                    title: 'Başarılı',
                    message: 'Ekleme Başarılı, Sayfaya Yönlendiriliyorsunuz...',
                    position: 'topCenter'
                });
                setTimeout(function () {
                    window.location.reload(1);
                }, 2000);
            }
        })
    }

};

function personelOdemeEkle() {
    var veriler = $('#personel_odeme_ekle').serialize();
    var hata = "";
    var miktar = $('#ekle_miktar').val();
    var tur = $('#ekle_tur').val();
    if (miktar === "" || miktar < 0) {
        hata = "Lütfen geçerli miktar giriniz...";
    } else {
        if (tur === "") {
            hata = "Lütfen ödeme türü seçiniz...";
        }
    }

    if (hata !== "") {
        iziToast.error({
            title: 'HATA',
            message: hata,
            position: 'topCenter'
        });
    } else {
        $.ajax({
            type: "POST",
            url: "post_islemleri.php",
            data: veriler,
            success: function (e) {
                iziToast.success({
                    title: 'Başarılı',
                    message: 'Ekleme Başarılı, Sayfaya Yönlendiriliyorsunuz...',
                    position: 'topCenter'
                });
                setTimeout(function () {
                    window.location.reload(1);
                }, 2000);
            }
        })
    }

};


function personel_genel_kontrol() {
    if (document.getElementById("ad").value.length == 0) {
        document.getElementById("genel_kaydet").disabled = true;
    } else if (document.getElementById("soyad").value.length == 0) {
        document.getElementById("genel_kaydet").disabled = true;
    } else if (document.getElementById("mail").value.length == 0) {
        document.getElementById("genel_kaydet").disabled = true;
    } else if (document.getElementById("telefon").value.length == 0) {
        document.getElementById("genel_kaydet").disabled = true;
    } else if (document.getElementById("tc_no").value.length == 0) {
        document.getElementById("genel_kaydet").disabled = true;
    } else if (document.getElementById("adres").value.length == 0) {
        document.getElementById("genel_kaydet").disabled = true;
    } else {
        document.getElementById("genel_kaydet").disabled = false;
    }
}


$("#bugun_tarih").on('change', (function (e) {
    var x = document.getElementById("bugun_tarih").value;
    document.getElementById("yeni_tarih").value = "";
    document.getElementById("yeni_tarih").min = x;

}))



