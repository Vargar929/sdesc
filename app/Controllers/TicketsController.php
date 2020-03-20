<?php

namespace App\Controllers;
use App\Models\UserModel;

class TicketsController extends \MainController
{

    function index(){
        return render('tickets page',[ 'title'=>'Заявки']);
    }

    function ticketGetAll(){

    }
}

