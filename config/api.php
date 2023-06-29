<?php

return [
    'notepad_contacts' => [
        'defaults' => [
            'per_page_index' => env('PER_PAGE_DEFAULT'),
            ],
        'storage' => env('PUBLIC_STORAGE', 'notepad_contacts')
        ],
];
