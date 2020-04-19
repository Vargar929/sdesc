<?php
/**
 * Created by PhpStorm.
 * User: Rykov_D
 * Date: 20.03.2020
 * Time: 17:21
 */

namespace App\REST\Models;

use DB;
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



    //storing token in database
     static function registerDevice($data){
        $params=[
            'uid'=>$data['uid'],
            'email'=>$data['email'],
            'token'=>$data['token'],
        ];
        if(!self::isEmailExist($data['email'])){
            $sql = "INSERT INTO devices (uid, email, token) VALUES (:uid,:email,:token) ";
            if(DB::run($sql,$params))
                return 0; //return 0 means success
            return 1; //return 1 means failure
        }else{
            return 2; //returning 2 means email already exist
        }
    }

    //the method will check if email already exist
    private static function isEmailexist($email){
        $sql = "SELECT id FROM devices WHERE email = ?";
        $stmt = DB::run($sql,[$email]);
        $num_rows = $stmt->rowCount();
        return $num_rows > 0;
    }

    //getting all tokens to send push to all devices
    static function getAllTokens(){
        $sql ="SELECT token FROM devices";
        $result = DB::run($sql);
        $tokens = array();
        while($token = $result->fetch(PDO::FETCH_ASSOC)){
            array_push($tokens, $token['token']);
        }
        return $tokens;
    }

    //getting a specified token to send push to selected device
    static function getTokenByEmail($email){
        $sql = "SELECT token FROM devices WHERE email = :email";
        $P_result = DB::run($sql,['email'=>$email]);
        $result = $P_result->fetch(PDO::FETCH_ASSOC);
        return array($result['token']);
    }

    //getting all the registered devices from database
    static function getAllDevices(){
        $sql = "SELECT * FROM devices";
        $result = DB::run($sql)->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

}