<?php

return [
    'plugin' => [
        'name' => 'AirTable',
        'description' => 'AirTable-Integration für OctoberCMS',
    ],
    'errors' => [
        'credentials' => 'AirTable-Personal-Access-Token und Datenbank-ID sind erforderlich. Bitte setzen Sie die Umgebungsvariablen AIRTABLE_PERSONAL_TOKEN und AIRTABLE_DATABASE_ID.',
    ],
    'tables' => [
        'title' => 'Tabellen',
        'columns' => [
            'id' => 'ID',
            'name' => 'Name',
            'description' => 'Beschreibung',
            'primary_field' => 'Primäres Feld',
        ],
    ],
    'records' => [
        'title' => 'Datensätze',
        'userLocale' => 'de',
    ],
];
