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
    'components' => [
        'tables' => [
            'title' => 'AirTable-Tabellen',
            'description' => 'Liste aller Tabellen in der AirTable-Datenbank.',
            'databaseId' => [
                'title' => 'Database ID',
                'description' => 'Die AirTable-Datenbank ID wenn unterschiedlich als in der Umgebungsvariable AIRTABLE_DATABASE_ID.',
            ],
            'cacheTLL' => [
                'title' => 'Cache TLL',
                'description' => 'Die Dauer in Sekunden, wie lange die Daten im Cache gespeichert werden sollen. Standard ist 3600 Sekunden.',
            ],
        ],
        'records' => [
            'title' => 'AirTable-Records',
            'description' => 'Liste aller Datensätze einer Tabelle in der AirTable-Datenbank.',
            'tableId' => [
                'title' => 'Tabellen ID',
                'description' => 'Der Name oder die ID einer Tabelle in der AirTable-Datenbank.',
            ],
            'limit' => [
                'title' => 'Limit',
                'description' => 'Die Anzahl der Datensätze, die abgerufen werden sollen. Standard ist -1 (alle Datensätze).',
            ],
            'view' => [
                'title' => 'View',
                'description' => 'Die ID einer Ansicht in der AirTable-Datenbank.',
            ],
            'sort' => [
                'title' => 'Sortierung',
                'description' => 'Optionale Sortierung der Einträge z.B. feldName:asc oder feldName:desc',
            ],
        ],
    ],
];
