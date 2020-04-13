<?php
/**
 * Created by PhpStorm.
 * User: Rykov_D
 * Date: 20.01.2020
 * Time: 13:39
 */
namespace App\Middleware\Before;

class ControllerCheck extends \MainMiddleware
{
    function REST_redirect(string $url, int $code = 302)
    {
        if (!headers_sent()) {

            header('Location: ' . HLEB_MAIN_DOMAIN.$url, true, $code);
        }
        exit();
    }
    function checkAdmin()
    {

    }

    function checkAuth()
    {
        if ( !(isset($_SESSION['account']['id'])) ){
            redirect('/login');
        }
    }
    function checkRESTAuth()
    {
        if ( !(isset($_SESSION['account']['id'])) ){
            self::REST_redirect('/login');
        }
    }

    function checkAccess()
    {
//			if ( !(isset($_SESSION['account']['id'])) ){
//				redirect('/login');
//			}
        $route = trim(self::getRoute(), "\t\n\r\0\x0B");

//			var_dump($route);
//			var_dump($_SESSION);
    }

    function getRoute(){
        return getMainUrl();
    }

    function checkConfirmNewTicket(){

    }
}