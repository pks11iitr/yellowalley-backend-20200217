<?php
error_reporting(0);
/*
 * use this file to allow or disallow user types for login
 * on the basis of their roles
*/
return [

    /*
     * Allow users for website login
     * {role  => redirection path}
     */
    'admins'=>[
        'admin'=>'admin.dashboard',
        'customer'=>$_SERVER['HTTP_REFERER']??env('APP_URL'),
    ],

    /*
     * Allow users for api login
     */
    'apiusers'=>[
        'student'
    ]

];
