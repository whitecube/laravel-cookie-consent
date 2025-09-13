<?php
return [
    'title' => 'Utilitzem galetes',
    'intro' => 'Aquest lloc web utilitza galetes per millorar l\'experiència general de l\'usuari.',
    'link' => 'Consulta la nostra <a href=":url">Política de galetes</a> per a més informació.',

    'essentials' => 'Només les essencials',
    'all' => 'Acceptar totes',
    'customize' => 'Personalitzar',
    'manage' => 'Gestionar galetes',
    'details' => [
        'more' => 'Més detalls',
        'less' => 'Menys detalls',
    ],
    'save' => 'Desar configuració',
    'cookie' => 'Galeta',
    'purpose' => 'Propòsit',
    'duration' => 'Durada',
    'year' => 'Any|Anys',
    'day' => 'Dia|Dies',
    'hour' => 'Hora|Hores',
    'minute' => 'Minut|Minuts',

    'categories' => [
        'essentials' => [
            'title' => 'Galetes essencials',
            'description' => 'Hi ha algunes galetes que hem d\'incloure perquè certes pàgines web funcionin. Per aquest motiu, no requereixen el teu consentiment.',
        ],
        'analytics' => [
            'title' => 'Galetes d\'anàlisi',
            'description' => 'Les utilitzem per fer estudis interns sobre com podem millorar el servei que oferim a tots els nostres usuaris. Aquestes galetes avaluen com interactues amb el nostre lloc web.',
        ],
        'optional' => [
            'title' => 'Galetes opcionals',
            'description' => 'Aquestes galetes habiliten funcions que podrien millorar la teva experiència d\'usuari, però la seva absència no afectarà la teva capacitat de navegar pel nostre lloc web.',
        ],
    ],

    'defaults' => [
        'consent' => 'Utilitzada per emmagatzemar les preferències de consentiment de galetes de l\'usuari.',
        'session' => 'Utilitzada per identificar la sessió de navegació de l\'usuari.',
        'csrf' => 'Utilitzada per protegir tant l\'usuari com el nostre lloc web contra atacs de falsificació de sol·licituds entre llocs (CSRF).',
        '_ga' => 'Galeta principal utilitzada per Google Analytics, permet a un servei distingir un visitant d\'un altre.',
        '_ga_ID' => 'Utilitzada per Google Analytics per mantenir l\'estat de la sessió.',
        '_gid' => 'Utilitzada per Google Analytics per identificar l\'usuari.',
        '_gat' => 'Utilitzada per Google Analytics per limitar la taxa de sol·licituds.',
    ],
];