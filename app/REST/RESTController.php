<?php
/**
 * Created by PhpStorm.
 * User: Rykov_D
 * Date: 19.03.2020
 * Time: 11:43
 */

namespace App\REST;


use App\Models\TestModel;

class RESTController extends \MainController
{
function getAllTickets(){
    $arr = TestModel::getAllTicketByUerID($_GET);
    header('Content-Type: application/json');
    echo json_encode($arr,JSON_UNESCAPED_UNICODE);
}
}