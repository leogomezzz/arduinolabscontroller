<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::auth();

Route::group
(
    ['middleware' => []]
    ,
    function ()
    {
        Route::controller('home', 'HomeController');
        Route::controller('labs', 'LabsController');
        Route::controller('computers', 'ComputersController');
        Route::controller('reles', 'RelesController');
        Route::controller('configurations', 'ConfigurationsController');
        Route::controller('/', 'HomeController');
    }
);