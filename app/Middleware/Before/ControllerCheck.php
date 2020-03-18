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

    function checkAdmin()
    {

    }

    function checkAuth()
    {
        if ( !(isset($_SESSION['account']['id'])) ){
            redirect('/login');
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
}