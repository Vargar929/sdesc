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

//API USER REALISED IN SERVER SIDE AND APP SIDE
Radjax\Route::get("/restdroid/signin", ["post","get"], "App\REST\Controllers\RESTfDroidApi@signin_RESTodroid_API", ["protected"=>false, "autoloader" => true, "save_session" => false,"add_headers"=>true]);
Radjax\Route::get("/restdroid/signup", ["post","get"], "App\REST\Controllers\RESTfDroidApi@signup_RESTodroid_API", ["protected"=>false, "autoloader" => true, "save_session" => false,"add_headers"=>true]);
Radjax\Route::get("/restdroid/cfnewuser", ["post","get"], "App\REST\Controllers\RESTfDroidApi@confirm_new_user_RESTodroid_API", ["protected"=>false, "autoloader" => true, "save_session" => false,"add_headers"=>true]);
Radjax\Route::get("/restdroid/verifysms", ["post","get"], "App\REST\Controllers\RESTfDroidApi@verify_sms_RESTodroid_API", ["protected"=>false, "autoloader" => true, "save_session" => false,"add_headers"=>true]);
Radjax\Route::get("/restdroid/getuinfo", ["post","get"], "App\REST\Controllers\RESTfDroidApi@get_user_info_RESTodroid_API", ["protected"=>false, "autoloader" => true, "save_session" => false,"add_headers"=>true]);
Radjax\Route::get("/restdroid/setuinfo", ["post","get"], "App\REST\Controllers\RESTfDroidApi@set_user_info_RESTodroid_API", ["protected"=>false, "autoloader" => true, "save_session" => false,"add_headers"=>true]);
//API TICKETS REALISED IN SERVER SIDE AND APP SIDE
Radjax\Route::get("/restdroid/tickets", ["post","get"], "App\REST\Controllers\RESTfDroidApi@tickets_RESTodroid_API", ["protected"=>false, "autoloader" => true, "save_session" => false,"add_headers"=>true]);
Radjax\Route::get("/restdroid/newti", ["post","get"], "App\REST\Controllers\RESTfDroidApi@new_ticket_RESTodroid_API", ["protected"=>false, "autoloader" => true, "save_session" => false,"before" => "App\Middleware\Before\ControllerCheck@checkConfirmNewTicket","add_headers"=>true]);
//TODO: API TICKETS *NOT REALISED IN SERVER SIDE AND APP SIDE
Radjax\Route::get("/restdroid/execti", ["post","get"], "App\REST\Controllers\RESTfDroidApi@new_ticket_RESTodroid_API", ["protected"=>false, "autoloader" => true, "save_session" => false,"before" => "App\Middleware\Before\ControllerCheck@checkConfirmNewTicket","add_headers"=>true]);
Radjax\Route::get("/restdroid/retrti", ["post","get"], "App\REST\Controllers\RESTfDroidApi@new_ticket_RESTodroid_API", ["protected"=>false, "autoloader" => true, "save_session" => false,"before" => "App\Middleware\Before\ControllerCheck@checkConfirmNewTicket","add_headers"=>true]);
//TODO: API ADMIN *NOT REALISED IN SERVER SIDE AND APP SIDE
Radjax\Route::get("/restdroid/getadmuinfo", ["post","get"], "App\REST\Controllers\RESTfDroidApi@set_user_info_RESTodroid_API", ["protected"=>false, "autoloader" => true, "save_session" => false,"add_headers"=>true]);
Radjax\Route::get("/restdroid/setadmuinfo", ["post","get"], "App\REST\Controllers\RESTfDroidApi@set_user_info_RESTodroid_API", ["protected"=>false, "autoloader" => true, "save_session" => false,"add_headers"=>true]);
//TODO: API ADMIN *NOT REALISED IN APP SIDE
Radjax\Route::get("/restdroid/sendbums", ["post","get"], "App\REST\Controllers\RESTController@sendBumsPush", ["protected"=>false, "autoloader" => true, "save_session" => false,"add_headers"=>true]);

//TODO: API MESSAGES *NOT REALISED IN SERVER SIDE
Radjax\Route::get("/restdroid/storegcmtoken", ["post","get"], "App\REST\Controllers\RESTController@registerDevice", ["protected"=>false, "autoloader" => true, "save_session" => false,"add_headers"=>true]);
Radjax\Route::get("/restdroid/sendspm", ["post","get"], "App\REST\Controllers\RESTController@sendSinglePush", ["protected"=>false, "autoloader" => true, "save_session" => false,"add_headers"=>true]);
//TODO: API MESSAGES *NOT REALISED IN SERVER SIDE AND APP SIDE
Radjax\Route::get("/restdroid/messages", ["post","get"], "App\REST\Controllers\RESTfDroidApi@set_user_info_RESTodroid_API", ["protected"=>false, "autoloader" => true, "save_session" => false,"add_headers"=>true]);
Radjax\Route::get("/restdroid/send", ["post","get"], "App\REST\Controllers\RESTfDroidApi@set_user_info_RESTodroid_API", ["protected"=>false, "autoloader" => true, "save_session" => false,"add_headers"=>true]);
