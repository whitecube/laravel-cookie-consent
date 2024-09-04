<?php

return [
    'title' => 'Vi bruker informasjonskapsler',
    'intro' => 'Dette nettstedet bruker informasjonskapsler for å forbedre brukeropplevelsen.',
    'link' => 'Se vår <a href=":url">informasjonskapselpolicy</a> for mer informasjon.',

    'essentials' => 'Kun nødvendige',
    'all' => 'Godta alle',
    'customize' => 'Tilpass',
    'manage' => 'Administrer informasjonskapsler',
    'details' => [
        'more' => 'Flere detaljer',
        'less' => 'Færre detaljer',
    ],
    'save' => 'Lagre innstillinger',
    'cookie' => 'Informasjonskapsel',
    'purpose' => 'Formål',
    'duration' => 'Varighet',
    'year' => 'År|År',
    'day' => 'Dag|Dager',
    'hour' => 'Time|Timer',
    'minute' => 'Minutt|Minutter',

    'categories' => [
        'essentials' => [
            'title' => 'Nødvendige informasjonskapsler',
            'description' => 'Det finnes noen informasjonskapsler som vi må inkludere for at enkelte nettsider skal fungere. Av den grunn krever de ikke ditt samtykke.',
        ],
        'analytics' => [
            'title' => 'Analysekapsler',
            'description' => 'Vi bruker disse til intern forskning på hvordan vi kan forbedre tjenesten for alle våre brukere. Disse informasjonskapslene vurderer hvordan du bruker nettstedet vårt.',
        ],
        'optional' => [
            'title' => 'Valgfrie informasjonskapsler',
            'description' => 'Disse informasjonskapslene muliggjør funksjoner som kan forbedre brukeropplevelsen din, men fraværet av dem vil ikke hindre deg i å navigere på nettstedet vårt.',
        ],
    ],

    'defaults' => [
        'consent' => 'Brukes til å lagre brukerens samtykkeinnstillinger for informasjonskapsler.',
        'session' => 'Brukes til å identifisere brukerens surfesesjon.',
        'csrf' => 'Brukes til å sikre både brukeren og nettstedet vårt mot angrep med forfalskning av forespørsler på tvers av nettsteder.',
        '_ga' => 'Hovedkapsel brukt av Google Analytics, muliggjør at en tjeneste kan skille én besøkende fra en annen.',
        '_ga_ID' => 'Brukes av Google Analytics for å opprettholde sesjonstilstand.',
        '_gid' => 'Brukes av Google Analytics for å identifisere brukeren.',
        '_gat' => 'Brukes av Google Analytics for å begrense forespørselsraten.',
    ],
];
