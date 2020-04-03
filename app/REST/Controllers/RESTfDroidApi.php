<?php


namespace App\REST\Controllers;


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
                $userStatus = UserModel::checkData($email,$password);
                $key = "144541354333adswcxs2axas24xcas1x456as47d532c4w";
                $iss = RESTController::http_host_uri();
                $aud = RESTController::http_host_uri();
                $iat = 1356999524;
                $nbf = 1357000000;
                if ($userStatus) {
                    $token = array(
                        "iss" => $iss,
                        "aud" => $aud,
                        "iat" => $iat,
                        "nbf" => $nbf,
                        "data" => array(
                            "id" =>UserModel::getUserData($email)['user_id'],
                            "firstname" => UserModel::getUserData($email)['f_name'],
                            "lastname" => UserModel::getUserData($email)['l_name'],
                            "email" => UserModel::getUserData($email)['email'],
                            "iin" => UserModel::getUserData($email)['inn'],
                            "mobile_phone" => UserModel::getUserData($email)['mobile_phone'],
                            "ip" => UserModel::getUserData($email)['INET_NTOA(ip)'],
                            "tab_num" => UserModel::getUserData($email)['tab_num'],
                            "company_post" => UserModel::getUserData($email)['company_post'],
                            "region" => UserModel::getUserData($email)['region'],
                            "date_password" => UserModel::getUserData($email)['date_password'],
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



}