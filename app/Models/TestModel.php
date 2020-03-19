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

class TestModel extends MainModel
{
    static function getAllTicketByUerID($get){
        if (!empty($get['status'])) {
            $id = $get['id'];
            $status = $get['status'];
            $sql = "select ti_id from tickets where user_id = '" . $id . "' AND status = '" . $status . "';";
            $rez = DB::run($sql)->rowCount();
            return $rez;
        }else{
            $id = $get['id'];
            $sql = "select ti_id from tickets where user_id = '" . $id . "';";
            $rez = DB::run($sql)->rowCount();
            return $rez;
        }
    }

}