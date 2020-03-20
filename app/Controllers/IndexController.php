<?php

namespace App\Controllers;
use App\Models\UserModel;

class IndexController extends \MainController
{

    function index(){
        return render('index page',[ 'title'=>'Главная']);
    }

    function license(){
        return render('license page',[ 'title'=>'Лицензия']);
    }
    function login(){
        if (!empty($_GET)) {
            if (!UserModel::checkData($_GET['login'], $_GET['password'])) {
//                redirect('/401');
                var_dump(!UserModel::checkData($_GET['login'], $_GET['password']));
            }else{
                $role_arr = UserModel::getUserSatus($_GET);
                foreach ($role_arr as $row){
                    $role = $row['status'];
                }
                if ($role == '1'){
                    UserModel::login($_GET['login']);
                    redirect('/');
                }else{
                    redirect('/403');
                }
            }
        }
        return render('login page',['title'=>'Вход']);
    }
//	function login(){
//            return render('login page',[ 'title'=>'Вход']);
////        return view("index");
//
//    }

    /**
     *
     */
    function logout() {
        unset($_SESSION['account']);
        session_destroy();
        return redirect('/login');
    }

    /**
     *
     */
    function profile(){
        return render('profile page',['title'=>'Профиль']);

    }
}

