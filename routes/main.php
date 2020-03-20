<?php
//dashboard render maps
Route::renderMap('index page', ['/template/header', '/template/dashboard/sidebar_v2','index','/template/footer']);
Route::renderMap('login page', ['/template/header', 'login']);
////dashboard routes
Route::before('DebugController')->getGroup();
//	Route::get('/login', render('login page'))->name('login');
    Route::getType(['post','get']);
        Route::get('/login')->controller('IndexController@login');
        Route::get('/auth')->controller('IndexController@login');
        Route::get('/logout')->controller('IndexController@logout');
    Route::endType();

Route::before('ControllerCheck@checkAuth')->getGroup();
Route::renderMap('profile page', ['/template/header', '/template/dashboard/sidebar_v2','profile','/template/footer']);
Route::renderMap('settings page', ['/template/header', '/template/dashboard/sidebar_v2','settings','/template/footer']);
Route::renderMap('license page', ['/template/header', '/template/dashboard/sidebar_v2','license','/template/footer']);
Route::renderMap('tickets page', ['/template/header', '/template/dashboard/sidebar_v2','/tickets/ticket','/template/footer']);
//Route::renderMap('index page', ['/template/header', '/template/dashboard/sidebar_v2','index','/template/footer']);


Route::before('ControllerCheck@checkAccess')->getGroup();
				////Global
				        Route::get('/')->controller('IndexController');
				        Route::get('/profile')->controller('IndexController@profile');
				        Route::get('/settings')->controller('SystemController@settings');
				        Route::get('/license')->controller('IndexController@license');
				        Route::get('/ticket')->controller('TicketsController@index');
			        Route::endGroup();
		    Route::endGroup();
		//Route::before('ControllerCheck@checkAdmin')->getGroup();


        //Route::endGroup();
Route::endGroup();

Route::get('/403/', view('errors/403'))->name('403');
Route::get('/401/', view('errors/401'))->name('401');

