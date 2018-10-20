<?php

Route::resource('/admin/users', 'Admin\UserController', ['names' => [
    'index' => 'adminUsersHome',
    'edit' => 'adminUsersEdit',
    'create' => 'adminUsersCreate',
    'store' => 'adminUsersStore',
    'update' => 'adminUsersUpdate',
]]);
