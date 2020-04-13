<?php

namespace App\Optional;

use Hleb\Scheme\Home\Main\Connector;

class MainConnector implements Connector
{
    function __construct(){}
    /**
     *  Сопоставление для автозагрузки классов: namespace => realpath
     */
    public function add()
    {

        return [

            "App\Controllers\*" => "app/Controllers/",
            "App\REST\Controllers\*" => "app/REST/Controllers/",
            "App\REST\Models\*" => "app/REST/Models/",
            "Models\*" => "app/Models/",
            "App\Middleware\Before\*" => "app/Middleware/Before/",
            "App\Middleware\After\*" => "app/Middleware/After/",
            "App\Commands\*"=>"app/Commands/",
            // ...или, если добавляется конкретный класс,
            "DB" => "database/DB.php",
            "Phphleb\Debugpan\DPanel" => "vendor/phphleb/debugpan/DPanel.php",
            "XdORM\XD" => "vendor/phphleb/xdorm/XD.php",
            "Radjax\Route" => "vendor/phphleb/radjax/Route.php",
            'Phphleb\Adminpan\MainAdminPanel'=>'vendor/phphleb/adminpan/MainAdminPanel.php',
            'YoHang88\LetterAvatar\LetterAvatar'=>'vendor/yohang88/letter-avatar/LetterAvatar.php',//Generate user avatar using name initials letter.
            'Firebase\JWT\JWT'=>'vendor/firebase/php-jwt/src/JWT.php', //JSON Web Token — это открытый стандарт для создания токенов доступа,
            'id009\QRGenerator'=>'vendor/phpqrcode/Generator.php', //PHP QR Code   library for generating QR Code
            'Garik\HttpRequest'=>'vendor/httprequest/HttpRequest.php',
            'GuzzleHttp\ClientInterface'=>''
            //"XdORM\XD" => "vendor/phphleb/xdorm/XD.php",
            //'Phphleb\Adminpan\MainAdminPanel'=>'vendor/phphleb/adminpan/MainAdminPanel.php',
            // ... //


        ];

    }

}