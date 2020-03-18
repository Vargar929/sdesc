<?php
/**
 * Created by PhpStorm.
 * User: Rykov_D
 * Date: 17.03.2020
 * Time: 11:36
 */

namespace App\Controllers;
use App\Models\UserModel;

class SystemController extends \MainController
{
    function settings(){
        return render('settings page',['title'=>'Настройки']);
    }

}