<?php
/**
 * Created by PhpStorm.
 * User: Rykov_D
 * Date: 16.03.2020
 * Time: 15:21
 */

namespace App\Models;
use DB;
use MainModel;
use PDO;

class UserModel extends MainModel
{

    /**
     * @param $login
     * @param $password
     * @return bool
     */



    static function checkData($login, $password)
    {

        $hash = DB::run("SELECT password FROM users WHERE email=?", [$login])->fetchColumn();

        if (!$hash or !password_verify($password, $hash)) {
            return false;
        }
        return true;
    }

    /**
     * @param $login
     */
    static function login($login)
    {
        function get_ip(){
            if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
                $ip = $_SERVER['HTTP_CLIENT_IP'];
            } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
                $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
            } else {
                $ip = $_SERVER['REMOTE_ADDR'];
            }
            return $ip;
        }
        $sql = "SELECT
       u.id, u.email,u.role, u.status, pi.user_id, f_name, l_name, m_name, inn, mobile_phone, INET_NTOA(ip), tab_num, company_post, region, date_password, r.role_name
FROM
     personal_info pi, users u, roles r
WHERE
        pi.user_id = u.id and r.id = u.role and u.email = '".$login."'";
        $data =  DB::run($sql)->fetchAll(PDO::FETCH_ASSOC);
        foreach ($data as $u_data){
            $u_data;
        }
        $sql = "UPDATE personal_info SET ip=INET_ATON('".get_ip()."') where user_id = '".$u_data['id']."';";
        DB::run($sql);
        $_SESSION['account'] = $data[0];
        return $data[0];
    }

    /**
     * @param $get
     * @return array
     */
    static function getUserRole($get){
        $params = ['login'=>$get['login'],];
        $sql="SELECT role from users where email = :login";
        return DB::run($sql,$params)->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * @param $get
     * @return array
     */
    static function getUserSatus($get){
        $params = ['login'=>$get,];
        $sql="SELECT status from users where email = :login";
        return DB::run($sql,$params)->fetchColumn();
    }

    static function getUserData($data){

        $sql = "SELECT
       u.id, u.email,u.role, u.status, pi.user_id, f_name, l_name, m_name, inn, mobile_phone, INET_NTOA(ip), tab_num, company_post, region, date_password, r.role_name
FROM
     personal_info pi, users u, roles r
WHERE
        pi.user_id = u.id and r.id = u.role and u.email = ?";
        $arr = DB::run($sql,[$data])->fetchAll(PDO::FETCH_ASSOC);
        foreach ($arr as $arr) {
            return $arr;
        }
    }

    static function createNewUser($email,$password){
        $params = [
            'username'=>stristr($email, '@', true),
            'email' => $email,
            'password'=>password_hash($password,PASSWORD_BCRYPT ),
            'status'=>'1',
            'role'=>'1'
        ];
        $sql = "INSERT INTO users(username, email, password, status, role) VALUES(:username, :email,:password,:status,:role)";
       DB::run($sql,$params);
        return DB::lastInsertId();
    }
    static function createUserInfo($data)
    {
        function get_ip(){
            if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
                $ip = $_SERVER['HTTP_CLIENT_IP'];
            } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
                $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
            } else {
                $ip = $_SERVER['REMOTE_ADDR'];
            }
            return $ip;
        }
        $params1 = [
            'uid'=>$data['uid'],
            'fname'=>$data['fname'],
            'lname'=>$data['lname'],
            'mname'=>$data['mname'],
            'uinn'=>$data['uinn'],
            'uphone'=>$data['uphone'],
            'utabnum'=>$data['utabnum'],
            'ucp'=>$data['ucp'],
            'uregion'=>$data['uregion']
        ];
        $params2 = [
            'ip'=>get_ip(),
            'date_p'=>date("Y-m-d H:i:s")
        ];
        //pi.user_id, f_name, l_name, m_name, inn, mobile_phone, INET_NTOA(ip), tab_num, company_post, region, date_password,
        $params = array_merge($params1, $params2);
        $sql= "insert into personal_info(user_id, f_name, l_name, m_name, inn, mobile_phone, 
                           tab_num, company_post, region,ip, date_password) values(:uid,:fname,:lname,:mname,:uinn,:uphone,:utabnum,:ucp,:uregion,INET_ATON(:ip),:date_p) ";
        DB::run($sql,$params);
        return DB::lastInsertId();
    }

    static function getUserInfo($data){

        $sql = "SELECT
        u.email,u.username, pi.user_id, f_name, l_name, m_name, inn, mobile_phone, INET_NTOA(ip), tab_num, company_post, region, date_password
FROM
     personal_info pi, users u
WHERE
        pi.user_id = u.id and u.id = :uid";
        $arr = DB::run($sql,$data)->fetchAll(PDO::FETCH_ASSOC);
        foreach ($arr as $arr) {
//            1/
            return $arr;
        }
    }
}