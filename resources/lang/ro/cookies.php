<?php
return [
    'title' => 'Folosim cookie-uri',
    'intro' => 'Acest site web folosește cookie-uri pentru a îmbunătăți experiența generală a utilizatorului.',
    'link' => 'Consultați <a href=":url">Politica noastră privind cookie-urile</a> pentru mai multe informații.',

    'essentials' => 'Doar esențiale',
    'all' => 'Acceptă toate',
    'customize' => 'Personalizează',
    'manage' => 'Gestionează cookie-urile',
    'details' => [
        'more' => 'Mai multe detalii',
        'less' => 'Mai puține detalii',
    ],
    'save' => 'Salvează setările',
    'cookie' => 'Cookie',
    'purpose' => 'Scop',
    'duration' => 'Durată',
    'year' => 'An|Ani',
    'day' => 'Zi|Zile',
    'hour' => 'Oră|Ore',
    'minute' => 'Minut|Minute',

    'categories' => [
        'essentials' => [
            'title' => 'Cookie-uri esențiale',
            'description' => 'Există unele cookie-uri pe care trebuie să le includem pentru ca anumite pagini web să funcționeze. Din acest motiv, acestea nu necesită consimțământul dumneavoastră.',
        ],
        'analytics' => [
            'title' => 'Cookie-uri de analiză',
            'description' => 'Le folosim pentru cercetări interne despre cum putem îmbunătăți serviciul pe care îl oferim tuturor utilizatorilor noștri. Aceste cookie-uri analizează modul în care interacționați cu site-ul nostru.',
        ],
        'optional' => [
            'title' => 'Cookie-uri opționale',
            'description' => 'Aceste cookie-uri activează funcționalități care ar putea îmbunătăți experiența utilizatorului, dar absența lor nu va afecta posibilitatea de a naviga pe site-ul nostru.',
        ],
    ],

    'defaults' => [
        'consent' => 'Folosit pentru a stoca preferințele utilizatorului privind consimțământul pentru cookie-uri.',
        'session' => 'Folosit pentru a identifica sesiunea de navigare a utilizatorului.',
        'csrf' => 'Folosit pentru a proteja atât utilizatorul, cât și site-ul nostru împotriva atacurilor de tip cross-site request forgery.',
        '_ga' => 'Cookie-ul principal folosit de Google Analytics, permite serviciului să distingă un vizitator de altul.',
        '_ga_ID' => 'Folosit de Google Analytics pentru a păstra starea sesiunii.',
        '_gid' => 'Folosit de Google Analytics pentru a identifica utilizatorul.',
        '_gat' => 'Folosit de Google Analytics pentru a limita frecvența solicitărilor.',
    ],
];