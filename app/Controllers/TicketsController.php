<?php

namespace App\Controllers;

class TicketsController extends \MainController
{

    function index(){
        return render('tickets page',[ 'title'=>'Заявки']);
    }

    function ticketGetAll(){

    }
}

