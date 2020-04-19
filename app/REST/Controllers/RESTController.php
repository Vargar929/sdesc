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
use App\REST\Helpers\Push;
use App\REST\Helpers\Firebase;

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

    function storeFCMtoken(){
        header("Access-Control-Allow-Origin: " . self::http_host_uri());
        header("Content-Type: application/json; charset=UTF-8");
        header("Access-Control-Allow-Methods: POST");
        header("Access-Control-Max-Age: 3600");
        header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

        if(isset($_POST)){
            if(!empty($_POST['uid'])&&!empty($_POST['email'])&&!empty($_POST['token'])){
                $st = TicketModel::saveFCMToken($_POST);
                if($st){
                    $json['error'] = false;
                    $json['message'] = 'Tocken Saved Success';
                    echo json_encode($json);
                }else{
                    $json['error'] = false;
                    $json['message'] = 'Tocken Error Saved';
                    echo json_encode($json);
                }
            }
        }else{
            $json['error'] = true;
            $json['message'] = 'Wrong method request';
            echo json_encode($json);
        }
    }

    function registerDevice(){
        header("Access-Control-Allow-Origin: " . self::http_host_uri());
        header("Content-Type: application/json; charset=UTF-8");
        header("Access-Control-Allow-Methods: POST");
        header("Access-Control-Max-Age: 3600");
        header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

        if($_SERVER['REQUEST_METHOD']=='POST'){

            $token = $_POST['token'];
            $email = $_POST['email'];
            $uid = $_POST['uid'];
            $data=[
                'uid'=>$uid,
                'email'=>$email,
                'token'=>$token,
            ];
            $result = RESTModel::registerDevice($data);

            if($result == 0){
                $response['error'] = false;
                $response['message'] = 'Device registered successfully';
            }elseif($result == 2){
                $response['error'] = true;
                $response['message'] = 'Device already registered';
            }else{
                $response['error'] = true;
                $response['message']='Device not registered';
            }
        }else{
            $response['error']=true;
            $response['message']='Invalid Request...';
        }

        echo json_encode($response);
    }

    function getAllDevices(){
        $devices = RESTModel::getAllDevices();

        $response = array();

        $response['error'] = false;
        $response['devices'] = array();

        foreach($devices as $value ){
            $temp = array();
            $temp['id']=$value['id'];
            $temp['email']=$value['email'];
            $temp['token']=$value['token'];
            array_push($response['devices'],$temp);
        }

        echo json_encode($response);
    }

    function sendSinglePush(){
        $response = array();

        if($_SERVER['REQUEST_METHOD']=='POST'){
            //hecking the required params
            if(isset($_POST['title']) and isset($_POST['message']) and isset($_POST['email'])){

                //creating a new push
                $push = null;
                //first check if the push has an image with it
                if(isset($_POST['image'])){
                    $push = new Push(
                        $_POST['title'], $_POST['message'], $_POST['image']
                    );
                }else{
                    //if the push don't have an image give null in place of image
                    $push = new Push(
                        $_POST['title'], $_POST['message'], null
                    );
                }

                //getting the push from push object
                $mPushNotification = $push->getPush();

                //getting the token from database object
                $devicetoken = RESTModel::getTokenByEmail($_POST['email']);

                //creating firebase class object
                $firebase = new Firebase();

                //sending push notification and displaying result
                echo $firebase->send($devicetoken, $mPushNotification);
            }else{
                $response['error']=true;
                $response['message']='Parameters missing';
            }
        }else{
            $response['error']=true;
            $response['message']='Invalid request';
        }

        echo json_encode($response);
    }
    function sendBumsPush(){
        $response = array();

        if($_SERVER['REQUEST_METHOD']=='POST'){
            //hecking the required params
            if(isset($_POST['title']) and isset($_POST['message'])) {
                //creating a new push
                $push = null;
                //first check if the push has an image with it
                if(isset($_POST['image'])){
                    $push = new Push(
                        $_POST['title'],
                        $_POST['message'],
                        $_POST['image']
                    );
                }else{
                    //if the push don't have an image give null in place of image
                    $push = new Push(
                        $_POST['title'],
                        $_POST['message'],
                        null
                    );
                }

                //getting the push from push object
                $mPushNotification = $push->getPush();

                //getting the token from database object
                $devicetoken = RESTModel::getAllTokens();

                //creating firebase class object
                $firebase = new Firebase();

                //sending push notification and displaying result
                echo $firebase->send($devicetoken, $mPushNotification);
            }else{
                $response['error']=true;
                $response['message']='Parameters missing';
            }
        }else{
            $response['error']=true;
            $response['message']='Invalid request';
        }

        echo json_encode($response);
    }

}
