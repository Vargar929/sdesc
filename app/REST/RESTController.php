<?php
/**
 * Created by PhpStorm.
 * User: Rykov_D
 * Date: 19.03.2020
 * Time: 11:43
 */

namespace App\REST;


use App\Models\TestModel;
use App\Models\TicketModel;

class RESTController extends \MainController
{

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
}