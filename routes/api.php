<?php
/**
 * Created by PhpStorm.
 * User: Rykov_D
 * Date: 21.01.2020
 * Time: 11:49
 */
//TEST ROUTES
Radjax\Route::get('/customers/{number}/orders?/', ["get","post"], "App\Controllers\CustomersController@orders", ["protected" => true, "where"=>["number" => "[0-9]+"], "save_session" => false]);

//JSON ROUTES
Radjax\Route::get("/api/v1/get_all_ticket", ["get"], "App\REST\Controllers\RESTController@getAllTickets", ["protected"=>false, "autoloader" => true, "save_session" => false,"before" => "App\Middleware\Before\ControllerCheck@checkRESTAuth","add_headers"=>true]);
Radjax\Route::get("/api/v1/get_all_ticket_data", ["get"], "App\REST\Controllers\RESTController@getAllData", ["protected"=>false, "autoloader" => true, "save_session" => false,"add_headers"=>true]);
Radjax\Route::get("/api/v1/put_new_ticket", ["post"], "App\REST\Controllers\RESTController@putNewTickets", ["protected"=>false, "autoloader" => true, "save_session" => false,"before" => "App\Middleware\Before\ControllerCheck@checkRESTAuth","add_headers"=>true]);
Radjax\Route::get("/search", ["get"], "App\Controllers\RESTController@jsonPoisk", ["protected"=>false, "autoloader" => true, "save_session" => false,"add_headers"=>true]);
Radjax\Route::get("/api/v1/login", ["get"], "App\REST\Controllers\RESTController@login_API", ["protected"=>false, "autoloader" => true, "save_session" => false,"add_headers"=>true]);

//API ROUTES
Radjax\Route::get("/restdroid/signin", ["post","get"], "App\REST\Controllers\RESTfDroidApi@signin_RESTodroid_API", ["protected"=>false, "autoloader" => true, "save_session" => false,"add_headers"=>true]);
Radjax\Route::get("/restdroid/tickets", ["get"], "App\REST\Controllers\RESTfDroidApi@tickets_RESTodroid_API", ["protected"=>false, "autoloader" => true, "save_session" => false,"add_headers"=>true]);
