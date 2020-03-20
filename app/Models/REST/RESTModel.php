<?php
/**
 * Created by PhpStorm.
 * User: Rykov_D
 * Date: 20.03.2020
 * Time: 17:21
 */

namespace App\Models\REST;

use App\Models\UserModel;
use App\REST\RESTController;
use DB;
use Firebase\JWT\JWT;
use PDO;

class RESTModel extends \MainModel
{
    static function emailExists($data){
        $sql = "SELECT
                  u.id, u.email,
                  ui.f_name, ui.l_name
        FROM
                  user_info ui, users u
        WHERE
                  ui.user_id = u.id and u.email = ?
        LIMIT 0,1";
        $email = htmlspecialchars(strip_tags($data['email']));
        $num =  DB::run($sql,[$email])->rowCount();
        if($num>0) {
            return true;
        }
        return false;
    }

    static function passwordExists($data){
        $email = htmlspecialchars(strip_tags($data['email']));
        $password = htmlspecialchars(strip_tags($data['password']));
        $hash = DB::run("SELECT password FROM users WHERE email=?", [$email])->fetchColumn();
        if (!$hash or !password_verify($password, $hash)) {
            return false;
        }
        return true;
    }

static  function auth_User($data){
    if ( self::emailExists($data) && self::passwordExists($data) ) {
         $key = "144541354333adswcxs2axas24xcas1x456as47d532c4w";
         $iss = RESTController::http_host_uri();
         $aud = RESTController::http_host_uri();
         $iat = 1356999524;
         $nbf = 1357000000;

        $token = array(
            "iss" => $iss,
            "aud" => $aud,
            "iat" => $iat,
            "nbf" => $nbf,
            "data" => array(
                "id" =>UserModel::getUserData($data)['id'],
                "firstname" => UserModel::getUserData($data)['f_name'],
                "lastname" => UserModel::getUserData($data)['l_name'],
                "email" => UserModel::getUserData($data)['email'],
                "phone" => UserModel::getUserData($data)['phone']

            )
        );

        // код ответа
        http_response_code(200);
        // создание jwt
        $jwt = JWT::encode($token, $key);
        echo json_encode(
            array(
                "message" => "Успешный вход в систему.",
                "jwt" => $jwt
            )
        );

    }

// Если электронная почта не существует или пароль не совпадает,
// сообщим пользователю, что он не может войти в систему
    else {

        // код ответа
        http_response_code(401);

        // сказать пользователю что войти не удалось
        echo json_encode(array("message" => "Ошибка входа."));
    }
}
}