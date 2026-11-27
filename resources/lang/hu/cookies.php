<?php
return [
    'title' => 'Cookie-kat használunk',
    'intro' => 'Ez a weboldal cookie-kat használ az általános felhasználói élmény javítása érdekében.',
    'link' => 'További információért tekintse meg a <a href=":url">Cookie-szabályzatunkat</a>.',

    'essentials' => 'Csak a szükségesek',
    'all' => 'Mindent elfogadok',
    'customize' => 'Testreszabás',
    'manage' => 'Cookie-k kezelése',
    'details' => [
        'more' => 'További részletek',
        'less' => 'Kevesebb részlet',
    ],
    'save' => 'Beállítások mentése',
    'cookie' => 'Cookie',
    'purpose' => 'Cél',
    'duration' => 'Időtartam',
    'year' => 'Év|Évek',
    'day' => 'Nap|Napok',
    'hour' => 'Óra|Órák',
    'minute' => 'Perc|Percek',

    'categories' => [
        'essentials' => [
            'title' => 'Szükséges cookie-k',
            'description' => 'Vannak olyan cookie-k, amelyeket bizonyos weboldalak működéséhez be kell építenünk. Emiatt ezekhez nincs szükség az Ön hozzájárulására.',
        ],
        'analytics' => [
            'title' => 'Analitikai cookie-k',
            'description' => 'Ezeket belső kutatásra használjuk, hogy javíthassuk a szolgáltatást, amelyet minden felhasználónknak nyújtunk. Ezek a cookie-k azt értékelik, hogyan lép kapcsolatba a weboldalunkkal.',
        ],
        'optional' => [
            'title' => 'Opcionális cookie-k',
            'description' => 'Ezek a cookie-k olyan funkciókat tesznek lehetővé, amelyek javíthatják a felhasználói élményt, de hiányuk nem befolyásolja a weboldalunk böngészésének lehetőségét.',
        ],
    ],

    'defaults' => [
        'consent' => 'A felhasználó cookie-hozzájárulási beállításainak tárolására szolgál.',
        'session' => 'A felhasználó böngészési munkamenetének azonosítására szolgál.',
        'csrf' => 'A felhasználó és a weboldalunk védelmére szolgál a cross-site request forgery támadások ellen.',
        '_ga' => 'A Google Analytics fő cookie-ja, amely lehetővé teszi a szolgáltatás számára, hogy megkülönböztesse az egyes látogatókat.',
        '_ga_ID' => 'A Google Analytics használja a munkamenet állapotának megőrzésére.',
        '_gid' => 'A Google Analytics használja a felhasználó azonosítására.',
        '_gat' => 'A Google Analytics használja a kérési ráta korlátozására.',
    ],
];