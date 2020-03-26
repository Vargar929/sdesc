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

class TicketModel extends MainModel
{
    /**
     * @param $data
     * @return string
     */
    static  function WriteNewTickets($data){
        if (!empty($data)){
            $params = [
                'email'=>$data['email'],
                'phone'=>$data['UserPhone'],
                'title'=>$data['ticketTitle'],
                'priority'=>$data['ticketPriority'],
                'desc'=>$data['TicketDesc'],
                'user_id'=>$_SESSION['account']['id'],
                'status'=>'1',
                'ti_date'=>date('Y-m-d'),
                ];
            $sql = "INSERT INTO tickets(ti_email, ti_phone, title, priority, text, user_id,  status, ti_date ) VALUES(:email, :phone, :title, :priority, :desc, :user_id, :status, :ti_date)";
            DB::run($sql,$params);
            return DB::lastInsertId();
        }
        return "0";
    }

    /**
     * @param $get
     * @return int
     */
    static function getCountFromAllTicketByUerID($get){
        if (!empty($get['status'])) {
            $id = $get['id'];
            $status = $get['status'];
//            $sql = "select ti_id from tickets where user_id = '" . $id . "' AND status = '" . $status . "';";
            $sql = "select COUNT(ti_id) from tickets where user_id = '" . $id . "' AND status = '" . $status . "';";
//            $rez = DB::run($sql)->rowCount();
            $rez = DB::run($sql)->fetch(PDO::FETCH_ASSOC);
            return $rez;
        }else{
            $id = $get['id'];
            $sql = "select COUNT(ti_id) from tickets where user_id = '" . $id . "';";
            $rez = DB::run($sql)->fetch(PDO::FETCH_ASSOC);
            return $rez;
        }
    }
    static function getAllDataFrmTicketWhereByUserID($get){
        if (!empty($get['id'])) {
            $id = $get['id'];
            $sql = "select * from tickets where user_id = '" . $id . "';";
            $rez = DB::run($sql)->fetchAll(PDO::FETCH_ASSOC);
            return $rez;
        }else{
            return false;
        }
    }

}