<?php

Route::resource(
    '/admin/users',
    'Admin\UserController',
    ['names' => [
    'index' => 'adminUsersHome',
    'create' => 'adminUsersCreate',
    'store' => 'adminUsersStore',
    'edit' => 'adminUsersEdit',
    'update' => 'adminUsersUpdate',
    'destroy' => 'adminUsersDelete',
    ]]
);

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
