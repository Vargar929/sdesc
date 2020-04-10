<?php


namespace App\REST\Controllers;


use App\Models\TicketModel;
use App\Models\UserModel;
use App\REST\Models\RESTModel;
use Firebase\JWT\JWT;

class RESTfDroidApi extends \MainController
{
    public static function http_host_uri(){
        $url = ((!empty($_SERVER['HTTPS'])) ? 'https' : 'http') . '://' . $_SERVER['HTTP_HOST'];
        $url = explode('?', $url);
        $url = $url[0];
        return $url;
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
                        "user" => array(
                            "id" =>UserModel::getUserData($email)['user_id'],
                            "firstname" => UserModel::getUserData($email)['f_name'],
                            "lastname" => UserModel::getUserData($email)['l_name'],
                            "email" => UserModel::getUserData($email)['email'],
                            "role" => UserModel::getUserData($email)['role_name'],
                        )
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

    function tickets_RESTodroid_API(){
        header("Access-Control-Allow-Origin: " . self::http_host_uri());
        header("Content-Type: application/json; charset=UTF-8");
        header("Access-Control-Allow-Methods: POST");
        header("Access-Control-Max-Age: 3600");
        header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

        if(isset($_GET)){
            if (isset($_GET['status'])&&!empty($_GET['status'])&&!empty($_GET['id'])){
                $params = [
                    "id"=>$_GET['id'],
                    "status"=>$_GET['status'],
                ];
                $arr = TicketModel::getAllDataFrmTicketWhereByUserID($params);
                $json['error'] = false;
                $json['message'] = 'Tickets get successfull';
                $json['tickets'] = $arr;
                echo json_encode($json);
            }elseif(!isset($_GET['status'])&&!empty($_GET['id'])){
                $params = [
                    "id"=>$_GET['id'],
                ];
                $arr = TicketModel::getAllDataFrmTicketWhereByUserID($params);
                $json['error'] = false;
                $json['message'] = 'Tickets get successfull';
                $json['tickets'] = $arr;
                echo json_encode($json);
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



}