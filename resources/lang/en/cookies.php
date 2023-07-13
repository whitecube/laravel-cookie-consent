<?php
return [
    'title' => 'We use cookies',
    'intro' => 'This website uses cookies in order to enhance the overall user experience.',
    'link' => 'Take a look at our <a href=":url">Cookies Policy</a> for more information.',

    'essentials' => 'Only essentials',
    'all' => 'Accept all',
    'customize' => 'Customize',
    'manage' => 'Manage cookies',
    'details' => [
        'more' => 'More details',
        'less' => 'Less details',
    ],
    'save' => 'Save settings',

    'categories' => [
        'essentials' => [
            'title' => 'Essential cookies',
            'description' => 'There are some cookies that we have to include in order for certain web pages to function. For this reason, they do not require your consent.',
        ],
        'analytics' => [
            'title' => 'Analytics cookies',
            'description' => 'We use these for internal research on how we can improve the service we provide for all our users. These cookies assess how you interact with our website.',
        ],
        'optional' => [
            'title' => 'Optional cookies',
            'description' => 'These cookies enable features that could improve your user experience, but their absence will not impact your ability to browse our website.',
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
    ],
];