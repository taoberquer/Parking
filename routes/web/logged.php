<?php

Route::resource('/', 'Logged\HomeController', ['names' => ['index' => 'home']]);

Route::resource(
    '/place',
    'Logged\PlaceController',
    [
        'names' => [
            'create' => 'newPlaceRequest',
            'store' => 'addPlace',
            'destroy' => 'giveUpPlace',
        ],
    ]
);

Route::resource(
    '/profile',
    'Logged\MyProfileController',
    [
        'names' => [
            'edit' => 'editProfile',
            'update' => 'updateProfile',
            'show' => 'myProfile',
        ],
    ]
);
