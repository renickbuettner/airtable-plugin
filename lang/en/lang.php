<?php

return [
    'plugin' => [
        'name' => 'AirTable',
        'description' => 'AirTable integration for OctoberCMS',
    ],
    'errors' => [
        'credentials' => 'AirTable personal access token and database id are required. Please set the environment variables AIRTABLE_PERSONAL_TOKEN and AIRTABLE_DATABASE_ID.',
    ],
    'tables' => [
        'title' => 'Tables',
        'columns' => [
            'id' => 'ID',
            'name' => 'Name',
            'description' => 'Description',
            'primary_field' => 'Primary Field',
        ],
    ],
    'records' => [
        'title' => 'Records',
        'userLocale' => 'en-gb',
    ],
    'components' => [
        'tables' => [
            'title' => 'AirTable Tables',
            'description' => 'List of all tables in the AirTable database',
            'databaseId' => [
                'title' => 'Database ID',
                'description' => 'The AirTable database ID if different than in the environment variable AIRTABLE_DATABASE_ID.',
            ],
            'cacheTLL' => [
                'title' => 'Cache TLL',
                'description' => 'The duration in seconds to store the data in cache. Default is 3600 seconds.',
            ],
        ],
        'records' => [
            'title' => 'AirTable-Records',
            'description' => 'List of all records of a table in the AirTable database.',
            'tableId' => [
                'title' => 'Table ID',
                'description' => 'The name or ID of a table in the AirTable database.',
            ],
            'limit' => [
                'title' => 'Limit',
                'description' => 'Die Anzahl der Datensätze, die abgerufen werden sollen. Standard ist -1 (alle Datensätze).',
            ],
            'view' => [
                'title' => 'View',
                'description' => 'The ID of a view in the AirTable database.',
            ],
            'sort' => [
                'title' => 'Sort',
                'description' => 'Optional sorting of entries e.g. fieldName:asc or fieldName:desc',
            ],
        ],
    ],
];
