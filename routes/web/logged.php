<?php

Route::resource(
    '/',
    'Logged\HomeController',
    [
        'names' => [
            'index' => 'Home',
        ],
    ]
);
