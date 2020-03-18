<?php
/**
 * Created by PhpStorm.
 * User: Rykov_D
 * Date: 21.01.2020
 * Time: 13:50
 */
namespace App\Middleware\Before;
use Hleb\Main\MyDebug;
class DebugController extends \MainMiddleware
{
    function index()
    {
        MyDebug::add("SERVER", $_SERVER ?? []);
        MyDebug::add("SESSION", $_SESSION ?? []);
        MyDebug::add("REQUEST", $_REQUEST ?? []);
// Пример последовательного добавления
        if (isset($_COOKIE)) {
            foreach ($_COOKIE as $key => $value){
                MyDebug::insert_to_array("COOKIE", "<b>$key</b>: " . $value);
            }
        }
    }
}