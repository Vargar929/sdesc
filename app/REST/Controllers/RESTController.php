<?php
/**
 * Created by PhpStorm.
 * User: Rykov_D
 * Date: 19.03.2020
 * Time: 11:43
 */

namespace App\REST\Controllers;


use App\Models\TicketModel;
use App\REST\Models\RESTModel;


class RESTController extends \MainController
{
    public static function http_host_uri(){
        $url = ((!empty($_SERVER['HTTPS'])) ? 'https' : 'http') . '://' . $_SERVER['HTTP_HOST'];
        $url = explode('?', $url);
        $url = $url[0];
        return $url;
    }



function getAllTickets(){
    $arr = TicketModel::getCountFromAllTicketByUerID($_GET);
    header('Content-Type: application/json');
    echo json_encode($arr,JSON_FORCE_OBJECT);
}

function putNewTickets(){
   echo TicketModel::WriteNewTickets(json_decode($_POST['jsonData'],JSON_FORCE_OBJECT));
}

function getAllData()
{
    $arr = TicketModel::getAllDataFrmTicketWhereByUserID($_GET);
    foreach ($arr as $p_arr ){
        echo json_encode($p_arr, JSON_FORCE_OBJECT | JSON_UNESCAPED_UNICODE);
    }
//    header('Content-Type: application/json');
}

/**
 *
 */

function login_API()
{
    header("Access-Control-Allow-Origin: " . self::http_host_uri());
    header("Content-Type: application/json; charset=UTF-8");
    header("Access-Control-Allow-Methods: POST");
    header("Access-Control-Max-Age: 3600");
    header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
    RESTModel::auth_User($_GET);
}
}
