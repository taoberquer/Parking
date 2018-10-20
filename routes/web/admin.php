<?php

Route::resource('/admin/users', 'Admin\UserController', ['names' => [
    'index' => 'adminUsersHome',
    'edit' => 'adminUsersEdit',
]]);
