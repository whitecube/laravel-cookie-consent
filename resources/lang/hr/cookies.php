<?php
return [
    'title' => 'Koristimo kolačiće',
    'intro' => 'Ovo web mjesto koristi kolačiće kako bi unaprijedili korisničko iskustvo.',
    'link' => 'Više informacija o našoj <a href=":url">Politici Kolačića</a>.',

    'essentials' => 'Samo nephodni',
    'all' => 'Prihvati sve',
    'customize' => 'Prilagodi',
    'manage' => 'Upravljanje kolačićima',
    'details' => [
        'more' => 'Više detalja',
        'less' => 'Manje detalja',
    ],
    'save' => 'Spremi postavke',

    'categories' => [
        'essentials' => [
            'title' => 'Neophodni kolačići',
            'description' => 'Postoje neki kolačići koje moramo uključiti kako bi određene web stranice funkcionirale. Iz tog razloga ne zahtijevaju Vaš pristanak.',
        ],
        'analytics' => [
            'title' => 'Analitički kolačići',
            'description' => 'Koristimo ih za interno istraživanje o tome kako možemo poboljšati uslugu koju pružamo svim našim korisnicima. Ovi kolačići procjenjuju Vašu interakciju s našim web mjestom.',
        ],
        'optional' => [
            'title' => 'Neobavezni kolačići',
            'description' => 'Ovi kolačići omogućuju značajke koje bi mogle poboljšati Vaše korisničko iskustvo, ali njihov nedostatak neće utjecati na Vašu mogućnost pregledavanja naše web stranice.',
        ],
    ],

    'defaults' => [
        'consent' => 'Koristi se za pohranjivanje korisničkih postavki pristanka na kolačiće.',
        'session' => 'Koristi se za identifikaciju korisnikove sesije pregledavanja.',
        'csrf' => 'Koristi se za zaštitu korisnika i naše web-stranice od napada krivotvorenja zahtjeva između web-mjesta.',
        '_ga' => 'Glavni kolačić koji koristi Google Analytics, omogućuje usluzi razlikovanje jednog posjetitelja od drugog.',
        '_ga_ID' => 'Koristi ga Google Analytics za održavanje stanja sesije.',
        '_gid' => 'Koristi Google Analytics za identifikaciju korisnika.',
        '_gat' => 'Koristi ga Google Analytics za smanjenje stope zahtjeva.',
    ],
];