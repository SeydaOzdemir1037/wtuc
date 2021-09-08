$(document).ready(function () {


    $("#lisans_uni").on('change', (function (e) {
        $("#lisans_bolum").empty();
        e.preventDefault();
        var lisans_uni = $(this).val();
        $.ajax({
            type: "POST",
            url: "post.php",
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
            url: "post.php",
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
            url: "post.php",
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