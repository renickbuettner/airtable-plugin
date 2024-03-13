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
];
