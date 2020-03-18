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
       ui.user_id, ui.f_name, ui.l_name, ui.m_name, ui.phone, INET_NTOA(ui.ip), ui.date_password
FROM
     user_info ui, users u
WHERE
      ui.user_id = u.id and u.email = '".$login."'";
        $data =  DB::run($sql)->fetchAll(PDO::FETCH_ASSOC);
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


}