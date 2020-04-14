<?php


namespace App\REST\Controllers;

use App\Models\TicketModel;
use App\Models\UserModel;
use App\REST\Models\RESTModel;
use Firebase\JWT\JWT;
use Garik\HttpRequest;
use Garik\HttpRequestException;

class RESTfDroidApi extends \MainController
{

    public static function http_host_uri(){
        $url = ((!empty($_SERVER['HTTPS'])) ? 'https' : 'http') . '://' . $_SERVER['HTTP_HOST'];
        $url = explode('?', $url);
        $url = $url[0];
        return $url;
    }
    public static function randomSMSKey(int $secret_key_max_lenght) {
        $alphabet = "0123456789";
        $pass = array();
        $alphaLength = strlen($alphabet) - 1;
        for ($i = 0; $i < $secret_key_max_lenght; $i++) {
            $n = rand(0, $alphaLength);
            $pass[] = $alphabet[$n];
        }
        return implode($pass);
    }

    function signin_RESTodroid_API(){
    header("Access-Control-Allow-Origin: " . self::http_host_uri());
    header("Content-Type: application/json; charset=UTF-8");
    header("Access-Control-Allow-Methods: POST");
    header("Access-Control-Max-Age: 3600");
    header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");


        if(isset($_POST)){
            $email = htmlspecialchars(strip_tags( $_POST['username']));
            $password = htmlspecialchars(strip_tags( $_POST['password']));
            if(RESTModel::isUserExisted($email)&&UserModel::checkData($email,$password)){
                $date = date("Y-m-d H:i:s");

                $userStatus = UserModel::checkData($email,$password);
                $key = "144541354333adswcxs2axas24xcas1x456as47d532c4w";
                $iss = RESTController::http_host_uri();
                $aud = RESTController::http_host_uri();
                $iat = strtotime($date);
                $nbf = strtotime(str_replace('-', '/', $date) . "+1 days");

                if ($userStatus) {
                    $token = array(
                        "iss" => $iss,
                        "aud" => $aud,
                        "iat" => $iat,
                        "nbf" => $nbf,
                        "uid" =>UserModel::getUserData($email)['user_id'],
                        "firstname" => UserModel::getUserData($email)['f_name'],
                        "lastname" => UserModel::getUserData($email)['l_name'],
                        "email" => UserModel::getUserData($email)['email'],
                        "mphone" => UserModel::getUserData($email)['mobile_phone'],
                        "role_id" => UserModel::getUserData($email)['role'],
                        "role_name" => UserModel::getUserData($email)['role_name']
                      
                    );

                    // код ответа
                    http_response_code(200);
                    $jwt = JWT::encode($token, $key);
                    $json['error'] = false;
                    $json['message'] = 'User Successfully logged';
                    $json['jwt'] = $jwt;
                    echo json_encode($json);
                } else {
                    // код ответа
                    http_response_code(401);
                    // сказать пользователю что войти не удалось
                    $json['error'] = false;
                    $json['message'] = 'Invalid username or password';
                    echo json_encode($json);
                }
            } else {
                $json['error'] = false;
                $json['message'] = 'Invalid username or password';
                echo json_encode($json);
            }
        }else {
            $json['error'] = true;
            $json['message'] = 'Wrong method request';
            echo json_encode($json);
        }


}
    function signup_RESTodroid_API(){
    header("Access-Control-Allow-Origin: " . self::http_host_uri());
    header("Content-Type: application/json; charset=UTF-8");
    header("Access-Control-Allow-Methods: POST");
    header("Access-Control-Max-Age: 3600");
    header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");


        if(isset($_POST)){
            $email = htmlspecialchars(strip_tags( $_POST['username']));
            $password = htmlspecialchars(strip_tags( $_POST['password']));
            if(!RESTModel::isUserExisted($email)){
                $uid = UserModel::createNewUser($email,$password);
                http_response_code(200);
                    $json['error'] = false;
                    $json['message'] = 'User Successfully created';
                    $json['uid'] = $uid;
                    echo json_encode($json);
                } else {
                $json['error'] = false;
                $json['message'] = 'This email existed';
                echo json_encode($json);
            }
        }else {
            $json['error'] = true;
            $json['message'] = 'Wrong method request';
            echo json_encode($json);
        }


}
    function set_user_info_RESTodroid_API(){
        header("Access-Control-Allow-Origin: " . self::http_host_uri());
        header("Content-Type: application/json; charset=UTF-8");
        header("Access-Control-Allow-Methods: POST");
        header("Access-Control-Max-Age: 3600");
        header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
        if(isset($_POST)){
            $uid = htmlspecialchars(strip_tags( $_POST['uid']));
            $fname = htmlspecialchars(strip_tags( $_POST['fname']));
            $lname = htmlspecialchars(strip_tags( $_POST['lname']));
            $mname = htmlspecialchars(strip_tags( $_POST['mname']));
            $uinn = htmlspecialchars(strip_tags( $_POST['uinn']));
            $ucp = htmlspecialchars(strip_tags( $_POST['ucp']));
            $uregion = htmlspecialchars(strip_tags( $_POST['uregion']));
            $utabnum = htmlspecialchars(strip_tags( $_POST['utabnum']));
            $uphone = htmlspecialchars(strip_tags( $_POST['uphone']));
            $params = [
                'uid'=>$uid,
                'fname'=>$fname,
                'lname'=>$lname,
                'mname'=>$mname,
                'uinn'=>$uinn,
                'uphone'=>$uphone,
                'utabnum'=>$utabnum,
                'ucp'=>$ucp,
                'uregion'=>$uregion
            ];
            $id=UserModel::createUserInfo($params);
            if($id>0){
                $json['error'] = false;
                $json['message'] = 'Success created new user.';
                echo json_encode($json);

            }else{
                $json['error'] = false;
                $json['message'] = 'Error created new ticket.';
                echo json_encode($json);

            }

        }else {
            $json['error'] = true;
            $json['message'] = 'Wrong method request';
            echo json_encode($json);
        }
    }
    function get_user_info_RESTodroid_API(){
        header("Access-Control-Allow-Origin: " . self::http_host_uri());
        header("Content-Type: application/json; charset=UTF-8");
        header("Access-Control-Allow-Methods: POST");
        header("Access-Control-Max-Age: 3600");
        header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
        if(isset($_POST)){
            $uid = htmlspecialchars(strip_tags( $_POST['uid']));
            $key = "144541354333adswcxs2axas24xcas1x456as47d532c4w";
            $params = [
                'uid'=>$uid,
                ];

            $info = UserModel::getUserInfo($params);
            http_response_code(200);
            $jwt = JWT::encode($info, $key);
            $json['error'] = false;
            $json['message'] = 'User Info getting succefull';
            $json['uinfo']=$jwt;
            echo json_encode($json);
        }else{
            $json['error'] = true;
            $json['message'] = 'Wrong method request';
            echo json_encode($json);
        }
    }
//2
    function tickets_RESTodroid_API(){
        header("Access-Control-Allow-Origin: " . self::http_host_uri());
        header("Content-Type: application/json; charset=UTF-8");
        header("Access-Control-Allow-Methods: POST");
        header("Access-Control-Max-Age: 3600");
        header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

        if(isset($_GET)){
            if (isset($_GET['status'])&&!empty($_GET['status'])&&!empty($_GET['id'])&&!empty($_GET['role'])){
                $params = [
                    "id"=>$_GET['id'],
                    "status"=>$_GET['status'],
                ];
                $arr = TicketModel::getAllDataFrmTicketWhereByUserID($params);
                $json['error'] = false;
                $json['message'] = 'Tickets get successfull';
                $json['tickets'] = $arr;
                echo json_encode($json);
            }elseif(!isset($_GET['status'])&&!empty($_GET['id'])&&!empty($_GET['role'])){
                if ($_GET['role'] =="1"){
                    $params = [
                        "id"=>$_GET['id'],
                    ];
                    $arr = TicketModel::getAllDataFrmTicketWhereByUserID($params);
                    $json['error'] = false;
                    $json['message'] = 'Tickets get successfull';
                    $json['tickets'] = $arr;
                    echo json_encode($json);
                }elseif($_GET['role']=="5"){
                    $params = [
                        "id"=>$_GET['id'],
                    ];
                    $arr = TicketModel::getAllDataFrmTicketWhereByOwnerID($params);
                    $json['error'] = false;
                    $json['message'] = 'Tickets get successfull';
                    $json['tickets'] = $arr;
                    echo json_encode($json);
                }

            }elseif (isset($_GET['status'])&&!isset($_GET['id'])){
                $params = [
                    "status"=>$_GET['status'],
                ];
                $arr = TicketModel::getAllDataFrmTicketWhereByUserID($params);
                $json['error'] = false;
                $json['message'] = 'Tickets get successfull';
                $json['tickets'] = $arr;
                echo json_encode($json);
            }elseif (!isset($_GET['status'])&&!isset($_GET['id'])){
                $params = [
                ];
                $arr = TicketModel::getAllDataFrmTicketWhereByUserID($params);
                $json['error'] = false;
                $json['message'] = 'Tickets get successfull';
                $json['tickets'] = $arr;
                echo json_encode($json);
            }

        }else {
            $json['error'] = true;
            $json['message'] = 'Wrong method request';
            echo json_encode($json);
        }

    }

    function new_ticket_RESTodroid_API(){
        header("Access-Control-Allow-Origin: " . self::http_host_uri());
        header("Content-Type: application/json; charset=UTF-8");
        header("Access-Control-Allow-Methods: POST");
        header("Access-Control-Max-Age: 3600");
        header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
        if(isset($_POST)){
        $json['error'] = false;
        $json['message'] = 'Success created new ticket.';
        $json['result'] = TicketModel::WriteNewTickets($_POST);
        echo json_encode($json);
        }elseif(isset($_GET)){
            $json['error'] = false;
            $json['message'] = 'Success created new ticket.';
            $json['result'] = TicketModel::WriteNewTickets($_GET);
            echo json_encode($json);
        }else {
            $json['error'] = true;
            $json['message'] = 'Wrong method request';
            echo json_encode($json);
        }
    }

    function confirm_new_user_RESTodroid_API(){
        header("Access-Control-Allow-Origin: " . self::http_host_uri());
        header("Content-Type: application/json; charset=UTF-8");
        header("Access-Control-Allow-Methods: POST");
        header("Access-Control-Max-Age: 3600");
        header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

        if (isset($_POST)){
            var_dump($_POST);
            if(!empty($_POST['email'])&&!empty($_POST['uphone'])){
                $ver_code =  self::randomSMSKey(6);
                try {
                    $http = HttpRequest::get("https://smsc.kz/sys/send.php?login=vargar929&psw=v0Vqla20&phones=+".$_POST['uphone']."&mes=Верификация:".$ver_code." Данный код необходим для создания заявки!&translit=1");
                    $json = $http->ok() ? json_decode($http->body()) : null;
                    echo $json;
                } catch (HttpRequestException $e) {
                    exit($e->getMessage());
                }
                $params = [
                    'email' => $_POST['email'],
                    'uphone'=>$_POST['uphone'],
                    'sms_key'=> $ver_code
                ];
                 RESTModel::putVerCode($params);
            }
        }
    }

    function verify_sms_RESTodroid_API(){
    header("Access-Control-Allow-Origin: " . self::http_host_uri());
    header("Content-Type: application/json; charset=UTF-8");
    header("Access-Control-Allow-Methods: POST");
    header("Access-Control-Max-Age: 3600");
    header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
    if (isset($_POST)){
        if(!empty($_POST['username'])&&!empty($_POST['vcode'])){
            $params = [
                'email' => $_POST['username'],
                'sms_key'=> $_POST['vcode']
            ];
            $status = RESTModel::checkVerCode($params);
            if($status){
                $json['error'] = false;
                $json['message'] = 'Success verification.';
                $json['status'] = true;
                echo json_encode($json);

            }else{
                $json['error'] = false;
                $json['message'] = 'Error verification.';
                $json['status'] = false;
                echo json_encode($json);

            }
        }
    }

}


}