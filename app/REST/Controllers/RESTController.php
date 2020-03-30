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
   echo TicketModel::WriteNewTickets(json_encode($_POST['jsonData'],JSON_FORCE_OBJECT));
}

    function getAllData()
{
    header('Content-Type: application/json');
    if(!empty($_GET)){
        if(isset($_GET['system_role'])&&($_GET['system_role']=1)&&isset($_GET['user_id'])&&isset($_GET['status'])){
            $arr = TicketModel::getAllDataFrmTicketWhereByUserID($_GET);
                echo json_encode($arr);
        }else if(isset($_GET['system_role'])&&($_GET['system_role']=2)&&isset($_GET['user_id'])&&isset($_GET['status'])) {
            $arr = TicketModel::getAllDataFrmTicketWhereByOwnerID($_GET);
            foreach ($arr as $p_arr) {
                echo json_encode($p_arr, JSON_FORCE_OBJECT | JSON_UNESCAPED_UNICODE);
            }
        }

    }


}
}
