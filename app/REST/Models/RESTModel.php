<?php
/**
 * Created by PhpStorm.
 * User: Rykov_D
 * Date: 20.03.2020
 * Time: 17:21
 */

namespace App\REST\Models;

use App\Models\UserModel;
use App\REST\Controllers\RESTController;
use DB;
use Firebase\JWT\JWT;
use PDO;

class RESTModel extends \MainModel
{
    static function get_ip(){
        if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
            $ip = $_SERVER['HTTP_CLIENT_IP'];
        } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
            $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
        } else {
            $ip = $_SERVER['REMOTE_ADDR'];
        }
        return $ip;
    }
    static function isUserExisted($data) {
        $sql = "SELECT email FROM users WHERE email = '".$data."' ";
        $result = DB::run($sql);
        $num =  DB::run($sql)->rowCount();
        if($num > 0) {
            return true;
        }else {
            return false;
        }
    }
    static  function isUserValidToLogin($data) {
      $email = $data['email'];
        $sql = "SELECT email FROM users WHERE email = '".$email."'";

        $result = mysqli_query($this->DB_CONNECTION, $sql);

        if(mysqli_num_rows($result) > 0) {
            return true;
        }else {
            return false;
        }
    }
    static function putVerCode($data){
        $params = [
            'email'=>$data['email'],
            'uphone'=>$data['uphone'],
            'sms_key'=>$data['sms_key'],
            'key_time' => strtotime(str_replace('-', '/',  date("Y-m-d H:i:s")) . "+30 minutes"),
            'ip'=>"'".self::get_ip()."'",
        ];
        $sql = "INSERT INTO checked_sms(email,uphone, sms_key, key_time, user_ip) VALUES(:email,:uphone, :sms_key, :key_time, :ip)";
        DB::run($sql,$params);
    }

    public static function checkVerCode($data)
    {
        $sql = "SELECT sms_key FROM checked_sms where email = '".$data['email']."'and sms_key ='".$data['sms_key']."';";
       $code = DB::run($sql)->fetch(PDO::FETCH_ASSOC);
        if ($code['sms_key'] ==  $data['sms_key']){
            return true;
        }else{
            return false;
        }
    }

}