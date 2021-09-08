<?php include "header.php";

if (!$yetkiler['index']['sayfa_goruntuleme']) {
    header("Location:yetkiYok.php");
}


?>


<main class="app-content">
    <div class="app-title">
        <div>
            <h1>TAMAMLANACAKLAR</h1>
        </div>
    </div>
    <div class="row">
        <div id="anasayfa_div" class="container-fluid">
            <div class="tile yan-sirala">
                TARİH KONTROLLERİ
            </div>
            <div class="tile yan-sirala">
                YETKİ KONTROLLERİ
            </div>
            <div class="tile yan-sirala">
                ARAMA ÇUBUĞU KONTROLLERİ
            </div>
            <div class="tile yan-sirala">
                PERSONELLER BULUNDUĞU PROJELER LİSTELENMİYOR
            </div>
            <div class="tile yan-sirala">
                İLETİŞİM MAİL ATINCA BEYAZ EKRANDA KALIYOR
            </div>
            <div class="tile yan-sirala">
                PERSONEL RESMİ KAYDETME
            </div>
            <div class="tile yan-sirala">
                TABLE İÇİNDEKİLERİN SIRALARI
            </div>
            <div class="tile yan-sirala">
                SLİDER DURUM GÜNCELLEME
            </div>
            <div class="tile yan-sirala">
                İŞ İLANI BAŞVURMA
            </div>
            <div class="tile yan-sirala">
                CKEDİTOR VERİTABANINA VE MAİLLERE DÜZENLEYİP GÖNDERMİYOR
            </div>
            <div class="tile yan-sirala">
                İLETİŞİM İNCE DETAYLAR
            </div>
            <div class="tile yan-sirala">
                SEÇİLİ MAİLİ DÜZENLEMEYE GÖNDEERME
            </div>
            <div class="tile yan-sirala">
                SEÇİLİ MAİLİ SİLME
            </div>
            <div class="tile yan-sirala">
                İŞ İLANINA BAŞVURMADA TC,TEL VARCHAR ALABİLİYOR. DÜZELT!!
            </div>
            <div class="tile yan-sirala">

            </div>
            <div class="tile yan-sirala">

            </div>
            <div class="tile yan-sirala">

            </div>
            <div class="tile yan-sirala">

            </div>
            <div class="tile yan-sirala">
                <ol>
                    <li>
                        Post yanlış yere
                    </li>
                    <li>
                        sorguda yanlış satır yanlış yerde
                    </li>
                    <li>
                        ilan listeleme fazla sorgu var
                    </li>
                    <li>
                        ilan listeleme fazla table var
                    </li>
                </ol>
            </div>
        </div>
    </div>
</main>
<?php include "footer.php" ?>
