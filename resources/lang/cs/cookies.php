<?php
return [
    'title' => 'Používáme cookies',
    'intro' => 'Tyto webové stránky používají soubory cookie za účelem zlepšení celkového uživatelského komfortu.',
    'link' => 'Další informace naleznete v <a href=":url">Zásadách používání</a>.',

    'essentials' => 'Nezbytné',
    'all' => 'Přijmout vše',
    'customize' => 'Přizpůsobit',
    'manage' => 'Spravovat',
    'details' => [
        'more' => 'Více informací',
        'less' => 'Méně informací',
    ],
    'save' => 'Uložit',
    'cookie' => 'Cookie',
    'purpose' => 'Účel',
    'duration' => 'Trvání',
    'year' => 'Rok|Roky',
    'day' => 'Den|Dny',
    'hour' => 'Hodina|Hodiny',
    'minute' => 'Minuta|Minuty',

    'categories' => [
        'essentials' => [
            'title' => 'Nezbytné',
            'description' => 'Některé soubory cookie musíme zahrnout, aby určité webové stránky fungovaly. Z tohoto důvodu nevyžadují váš souhlas.',
        ],
        'analytics' => [
            'title' => 'Statistické',
            'description' => 'Používáme je k internímu výzkumu, jak můžeme zlepšit služby, které poskytujeme všem našim uživatelům. Tyto soubory cookie vyhodnocují, jak s našimi webovými stránkami pracujete.',
        ],
        'optional' => [
            'title' => 'Volitelné',
            'description' => 'Tyto soubory cookie umožňují funkce, které mohou zlepšit váš uživatelský zážitek, ale jejich absence neovlivní vaši schopnost prohlížet naše webové stránky.',
        ],
    ],

    'defaults' => [
        'consent' => 'Slouží k uložení souhlasu uživatele s cookies.',
        'session' => 'Slouží k identifikaci relace uživatele.',
        'csrf' => 'Slouží k zabezpečení uživatele i našich webových stránek proti útokům typu CSRF (Cross-Site Request Forgery).',
        '_ga' => 'Hlavní soubor cookie používaný službou Google Analytics, který umožňuje službě rozlišit jednoho návštěvníka od druhého.',
        '_ga_ID' => 'Používá se v nástroji Google Analytics k uchování stavu relace.',
        '_gid' => 'Používá se službou Google Analytics k identifikaci uživatele.',
        '_gat' => 'Používá se v nástroji Google Analytics k omezení počtu požadavků.',
    ],
];
