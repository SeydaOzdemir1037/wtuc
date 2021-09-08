<?php


class menu_yonetimi
{

    function sure_hesaplama($baslangic, $bitis)
    {
        $basla = date_create($baslangic);
        $bit = date_create($bitis);
        $sonuc = date_diff($basla, $bit);
        return $sonuc->format("%a");
    }


    function menuler()
    {
        $menuler = [
            'izin-talep' => [
                'link' => 'izin-talep',
                'title' => 'İzin Talebi',
                'icon' => 'plus-circle',
//                'submenu' => [
//                    'izin' => [
//                        'link' => 'izin-talep',
//                        'title' => 'İzin Talebi',
//                        'icon' => 'plus'
////                        'yetkiler' => [
////                            'sayfa_goruntuleme' => 'Sayfayı Görüntüleme',
////                            'icerik_goruntuleme' => 'İçerik Görüntüle',
////                            'ekleme' => 'Ekleme',
////                            'duzenleme' => 'Düzenleme',
////                            'silme' => 'silme'
////                        ]
//                    ],
//                    'odeme' => [
//                        'link' => 'odeme-talep',
//                        'title' => 'Ödeme Talebi',
//                        'icon' => 'money'
////                        'yetkiler' => [
////                            'sayfa_goruntuleme' => 'Sayfayı Görüntüleme',
////                            'icerik_goruntuleme' => 'İçerik Görüntüle',
////                            'ekleme' => 'Ekleme',
////                            'duzenleme' => 'Düzenleme',
////                            'silme' => 'silme'
////                        ]
//                    ]
//                ],
                'yetkiler' => [
                    'sayfa_goruntuleme' => 'Sayfayı Görüntüleme',
                    'icerik_goruntuleme' => 'İçerik Görüntüle',
                    'ekleme' => 'Ekleme',
                    'duzenleme' => 'Düzenleme',
                    'silme' => 'silme'
                ]
            ],
            'index' => [
                'link' => 'index',
                'title' => 'AnaSayfa',
                'icon' => 'home',
                'yetkiler' => [
                    'sayfa_goruntuleme' => 'Sayfayı Görüntüleme',
                    'icerik_goruntuleme' => 'İçerik Görüntüle',
                    'ekleme' => 'Ekleme',
                    'duzenleme' => 'Düzenleme',
                    'silme' => 'silme'
                ]
            ],
            'yetkiler' => [
                'link' => 'yetkiler',
                'title' => 'Yetkiler',
                'icon' => 'hand-paper-o',
                'yetkiler' => [
                    'sayfa_goruntuleme' => 'Sayfayı Görüntüleme',
                    'icerik_goruntuleme' => 'İçerik Görüntüle',
                    'ekleme' => 'Ekleme',
                    'duzenleme' => 'Düzenleme',
                    'silme' => 'silme'
                ]
            ],
            'mailler' => [
                'link' => 'mailler',
                'title' => 'Mailler',
                'icon' => 'envelope',
                'yetkiler' => [
                    'sayfa_goruntuleme' => 'Sayfayı Görüntüleme',
                    'icerik_goruntuleme' => 'İçerik Görüntüle',
                    'ekleme' => 'Ekleme',
                    'duzenleme' => 'Düzenleme',
                    'silme' => 'silme'
                ]
            ],
            'personeller' => [
                'link' => 'personeller',
                'title' => 'Personeller',
                'icon' => 'users',
                'yetkiler' => [
                    'sayfa_goruntuleme' => 'Sayfayı Görüntüleme',
                    'icerik_goruntuleme' => 'İçerik Görüntüle',
                    'ekleme' => 'Ekleme',
                    'silme' => 'Silme',
                    'genel' => 'Genel Bilgi Düzenleme',
                    'sifre_sifirla' => 'Şifre Sıfırlama',
                    'izinler' => 'İzin İşlemleri',
                    'projeler' => 'Proje İşlemleri',
                    'odemeler' => 'Odeme İşlemleri'
                ]
            ],
            'izinler' => [
                'link' => 'izinler',
                'title' => 'İzinler',
                'icon' => 'plane',
                'yetkiler' => [
                    'sayfa_goruntuleme' => 'Sayfayı Görüntüleme',
                    'ekleme' => 'Ekleme',
                    'duzenleme' => 'Düzenleme',
                    'silme' => 'silme'
                ]
            ],
            'takvim' => [
                'link' => 'takvim',
                'title' => 'Takvim',
                'icon' => 'calendar',
                'yetkiler' => [
                    'sayfa_goruntuleme' => 'Sayfayı Görüntüleme',
                    'icerik_goruntuleme' => 'İçerik Görüntüle',
                    'ekleme' => 'Ekleme',
                    'duzenleme' => 'Düzenleme',
                    'silme' => 'silme'
                ]
            ],
            'projeler' => [
                'link' => 'projeler',
                'title' => 'Projeler',
                'icon' => 'map-o',
                'yetkiler' => [
                    'sayfa_goruntuleme' => 'Sayfayı Görüntüleme',
                    'icerik_goruntuleme' => 'İçerik Görüntüle',
                    'ekleme' => 'Ekleme',
                    'duzenleme' => 'Düzenleme',
                    'silme' => 'Silme'
                ]
            ],
            'is-ilanlar' => [
                'link' => 'ilan-ver',
                'title' => 'İş ilanları',
                'icon' => 'hand-lizard-o',
                'yetkiler' => [
                    'sayfa_goruntuleme' => 'Sayfayı Görüntüleme',
                    'icerik_goruntuleme' => 'İçerik Görüntüle',
                    'ekleme' => 'Ekleme',
                    'duzenleme' => 'Düzenleme',
                    'silme' => 'silme'
                ]
            ],
            'kullanici-paneli' => [
                'link' => 'kullanici-paneli',
                'title' => 'Kullanıcı Paneli',
                'icon' => 'puzzle-piece',
                'submenu' => [
                    'site-ozellikler' => [
                        'link' => 'siteozellikleri',
                        'title' => 'Site Özellikleri',
                        'icon' => 'cogs',
                        'yetkiler' => [
                            'sayfa_goruntuleme' => 'Sayfayı Görüntüleme',
                            'icerik_goruntuleme' => 'İçerik Görüntüle',
                            'ekleme' => 'Ekleme',
                            'duzenleme' => 'Düzenleme',
                            'silme' => 'silme'
                        ]
                    ],
                    'anasayfa' => [
                        'link' => 'anasayfa',
                        'title' => 'Anasayfa',
                        'icon' => 'home',
                        'yetkiler' => [
                            'sayfa_goruntuleme' => 'Sayfayı Görüntüleme',
                            'icerik_goruntuleme' => 'İçerik Görüntüle',
                            'duzenleme' => 'Bilgi Düzenleme',
                            'ekleme' => 'Ekleme',
                            'silme' => 'Silme'
                        ]
                    ],
                    'hakkimizda' => [
                        'link' => 'hakkimizda',
                        'title' => 'Hakkımızda',
                        'icon' => 'info',
                        'yetkiler' => [
                            'sayfa_goruntuleme' => 'Sayfayı Görüntüleme',
                            'duzenleme' => 'Bilgi Düzenleme',
                        ]
                    ],
                    'iletisim' => [
                        'link' => 'iletisim',
                        'title' => 'İletişim',
                        'icon' => 'phone',
                        'yetkiler' => [
                            'sayfa_goruntuleme' => 'Sayfayı Görüntüleme',
                            'icerik_goruntuleme' => 'İçerik Görüntüle',
                            'ekleme' => 'Ekleme',
                            'duzenleme' => 'Düzenleme',
                            'silme' => 'silme'
                        ]
                    ]
                ]
            ],

        ];
        return $menuler;
    }

    function ayarlar()
    {
        $ayarlar = [
            'profil' => [
                'link' => 'profilim',
                'title' => 'Profilim',
                'icon' => 'user',
            ],
            'logout' => [
                'link' => 'logout',
                'title' => 'Çıkış Yap',
                'icon' => 'sign-out'
            ]
        ];
        return $ayarlar;
    }
}