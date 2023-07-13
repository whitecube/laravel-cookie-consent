<?php
return [
    'title' => 'Nosotros utilizamos cookies',
    'intro' => 'Este sitio utiliza cookies para mejorar su experiencia de usuario.',
    'link' => 'Consulte nuestra <a href=":url">política de cookies</a> para obtener más información.',

    'essentials' => 'Cookies esenciales',
    'all' => 'Aceptar todo',
    'customize' => 'Personalizar',
    'manage' => 'Administrar cookies',
    'details' => [
        'more' => 'Más información',
        'less' => 'Menos información',
    ],
    'save' => 'Registro',

    'categories' => [
        'essentials' => [
            'title' => 'Cookies de funcionamiento',
            'description' => 'Necesitamos usar ciertas cookies para que ciertas páginas web funcionen. Por eso no requieren tu consentimiento.',
        ],
        'analytics' => [
            'title' => 'Cookies analíticas',
            'description' => 'Solo utilizamos estas cookies únicamente con fines de investigación interna sobre como podemos mejorar el servicio que brindamos a todos nuestros usuarios. Estas cookies se utilizan para evaluar como interactúa con nuestro sitio web – como un usuario anónimo (los datos recopilados no lo identifican personalmente).',
        ],
        'optional' => [
            'title' => 'Cookies opcionales',
            'description' => 'Estas cookies habilitan funciones que pueden mejorar su experiencia de usuario, pero su ausencia no afecta su capacidad para navegar por nuestro sitio web',
        ],
    ],

    'defaults' => [
        'consent' => 'Used to store the user\'s cookie consent preferences.',
        'session' => 'Used to identify the user\'s browsing session.',
        'csrf' => 'Used to secure both the user and our website against cross-site request forgery attacks.',
        '_ga' => 'Main cookie used by Google Analytics, enables a service to distinguish one visitor from another.',
        '_ga_ID' => 'Used by Google Analytics to persist session state.',
        '_gid' => 'Used by Google Analytics to identify the user.',
        '_gat' => 'Used by Google Analytics to throttle the request rate.',
    ],
];