<?php
return [
    'title' => 'Korzystamy z plików cookie',
    'intro' => 'Ta witryna używa plików cookie w celu ulepszenia ogólnej wygody użytkowania.',
    'link' => 'Zajrzyj do naszej <a href=":url">Polityki plików cookie</a>, aby uzyskać więcej informacji.',

    'essentials' => 'Tylko niezbędne',
    'all' => 'Zaakceptuj wszystko',
    'customize' => 'Dostosuj',
    'manage' => 'Zarządzaj plikami cookie',
    'details' => [
        'more' => 'Więcej szczegółów',
        'less' => 'Mniej szczegółów',
    ],
    'save' => 'Zapisz ustawienia',

    'categories' => [
        'essentials' => [
            'title' => 'Niezbędne pliki cookie',
            'description' => 'Istnieją pliki cookie, które są niezbędne dla funkcjonowania niektórych stron internetowych. Z tego powodu nie wymagają one twojej zgody.',
        ],
        'analytics' => [
            'title' => 'Analityczne pliki cookie',
            'description' => 'Używamy ich do wewnętrznych badań nad tym, jak możemy poprawić usługi świadczone dla wszystkich naszych użytkowników. Pliki te oceniają, w jaki sposób korzystasz z naszej witryny.',
        ],
        'optional' => [
            'title' => 'Opcjonalne pliki cookie',
            'description' => 'Te pliki cookie aktywują funkcjonalności, które mogą poprawić wygodę korzystania z witryny, ale ich brak nie wpłynie na twoją zdolność do przeglądania naszej witryny.',
        ],
    ],

    'defaults' => [
        'consent' => 'Służy do przechowywania zgód użytkownika na pliki cookie.',
        'session' => 'Służy do identyfikacji sesji użytkownika w przeglądarce.',
        'csrf' => 'Służy do zabezpieczenia użytkownika oraz jednocześnie naszej witryny przed atakami fałszerstwa żądań między witrynami (CSRF).',
        '_ga' => 'Główny plik cookie używany przez Google Analytics, umożliwia usłudze rozróżnianie odwiedających.',
        '_ga_ID' => 'Używany przez Google Analytics do utrzymania infromacji o stanie sesji.',
        '_gid' => 'Używany przez Google Analytics do identyfikacji użytkownika.',
        '_gat' => 'Używany przez Google Analytics do ograniczania częstotliwości żądań.',
    ],
];
