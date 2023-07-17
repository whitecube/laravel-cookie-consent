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
        'consent' => 'Se utiliza para almacenar las preferencias de consentimiento de cookies del usuario.',
        'session' => 'Se utiliza para identificar la sesión de navegación del usuario.',
        'csrf' => 'Se utiliza para asegurar tanto al usuario como a nuestro sitio web contra ataques de falsificación de solicitudes entre sitios.',
        '_ga' => 'Cookie principal utilizada por Google Analytics, permite distinguir a un visitante de otro.',
        '_ga_ID' => 'Utilizada por Google Analytics para persistir el estado de la sesión.',
        '_gid' => 'Utilizada por Google Analytics para identificar al usuario.',
        '_gat' => 'Utilizada por Google Analytics para limitar la tasa de solicitudes.',
    ]
];