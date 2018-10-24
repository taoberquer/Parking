<?php

Route::resource(
    '/admin/users',
    'Admin\UserController',
    ['names' => [
    'index' => 'adminUsersHome',
    'create' => 'adminUsersCreate',
    'show' => 'adminUsersShow',
    'store' => 'adminUsersStore',
    'edit' => 'adminUsersEdit',
    'update' => 'adminUsersUpdate',
    'destroy' => 'adminUsersDelete',
    'allowUser' => 'adminUsersAllow',
    ]]
);

Route::patch('/admin/users/allow/{id}', [
    'as' => 'adminUsersAllow',
    'uses' => 'Admin\UserController@allowUser'
]);

Route::resource(
    '/admin/parkings',
    'Admin\ParkingController',
    ['names' => [
    'index' => 'adminParkingsHome',
    'create' => 'adminParkingsCreate',
    'store' => 'adminParkingsStore',
    'show' => 'adminParkingsShow',
    'edit' => 'adminParkingsEdit',
    'update' => 'adminParkingsUpdate',
    'destroy' => 'adminParkingsDelete',
    ]]
);
