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
        $sql = "SELECT
       u.id, u.email,
       pi.id, user_id, f_name, l_name, m_name, inn, mobile_phone, INET_NTOA(ip), tab_num, company_post, region, date_password
FROM
     personal_info pi, users u
WHERE
        pi.user_id = u.id and u.email = '".$login."'";
        $data =  DB::run($sql)->fetchAll(PDO::FETCH_ASSOC);
        foreach ($data as $u_data){
            $u_data;
        }
        $sql = "UPDATE personal_info SET ip=INET_ATON('".get_ip()."') where user_id = '".$u_data['id']."';";
        DB::run($sql);
        $_SESSION['account'] = $data[0];
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
        $params = ['login'=>$get['login'],];
        $sql="SELECT status from users where email = :login";
        return DB::run($sql,$params)->fetchAll(PDO::FETCH_ASSOC);
    }

    static function getUserData($data){
        $email = htmlspecialchars(strip_tags($data['email']));
        $sql = "SELECT
       u.id, u.email,
       ui.f_name, ui.l_name, ui.m_name, ui.phone
FROM
     user_info ui, users u
WHERE
      ui.user_id = u.id and u.email = ?";
        $arr = DB::run($sql,[$email])->fetchAll(PDO::FETCH_ASSOC);
        foreach ($arr as $arr) {
            return $arr;
        }
    }


}