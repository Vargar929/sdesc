<?php


namespace App\REST\Controllers;
define("SMSC_LOGIN", "vargar929");			// логин клиента
define("SMSC_PASSWORD", "ebbhH7yCGKNfh4aF");	// пароль
define("SMSC_POST", 0);					// использовать метод POST
define("SMSC_HTTPS", 0);				// использовать HTTPS протокол
define("SMSC_CHARSET", "windows-1251");	// кодировка сообщения: utf-8, koi8-r или windows-1251 (по умолчанию)
define("SMSC_DEBUG", 0);				// флаг отладки
define("SMTP_FROM", "noreply@pch38.tk");     // e-mail адрес отправителя

use App\Models\TicketModel;
use App\Models\UserModel;
use App\REST\Models\RESTModel;
use Firebase\JWT\JWT;
use Garik\HttpRequest;
use Garik\HttpRequestException;

class RESTfDroidApi extends \MainController
{

    public static function http_host_uri(){
        $url = ((!empty($_SERVER['HTTPS'])) ? 'https' : 'http') . '://' . $_SERVER['HTTP_HOST'];
        $url = explode('?', $url);
        $url = $url[0];
        return $url;
    }
    public static function randomSMSKey(int $secret_key_max_lenght) {
        $alphabet = "0123456789";
        $pass = array();
        $alphaLength = strlen($alphabet) - 1;
        for ($i = 0; $i < $secret_key_max_lenght; $i++) {
            $n = rand(0, $alphaLength);
            $pass[] = $alphabet[$n];
        }
        return implode($pass);
    }

    /**
     *
     */
    public static function _smsc_send_cmd($cmd, $arg = "", $files = array())
    {
        $url = $_url = (SMSC_HTTPS ? "https" : "http")."://smsc.kz/sys/$cmd.php?login=".urlencode(SMSC_LOGIN)."&psw=".urlencode(SMSC_PASSWORD)."&fmt=1&charset=".SMSC_CHARSET."&".$arg;

        $i = 0;
        do {
            if ($i++)
                $url = str_replace('://smsc.kz/', '://www'.$i.'.smsc.kz/', $_url);

            $ret = self::_smsc_read_url($url, $files, 3 + $i);
        }
        while ($ret == "" && $i < 5);

        if ($ret == "") {
            if (SMSC_DEBUG)
                echo "Ошибка чтения адреса: $url\n";

            $ret = ","; // фиктивный ответ
        }

        $delim = ",";

        if ($cmd == "status") {
            parse_str($arg, $m);

            if (strpos($m["id"], ","))
                $delim = "\n";
        }

        return explode($delim, $ret);
    }
    public static function _smsc_read_url($url, $files, $tm = 5)
    {
        $ret = "";
        $post = SMSC_POST || strlen($url) > 2000 || $files;

        if (function_exists("curl_init"))
        {
            static $c = 0; // keepalive

            if (!$c) {
                $c = curl_init();
                curl_setopt_array($c, array(
                    CURLOPT_RETURNTRANSFER => true,
                    CURLOPT_CONNECTTIMEOUT => $tm,
                    CURLOPT_TIMEOUT => 60,
                    CURLOPT_SSL_VERIFYPEER => 0,
                    CURLOPT_HTTPHEADER => array("Expect:")
                ));
            }

            curl_setopt($c, CURLOPT_POST, $post);

            if ($post)
            {
                list($url, $post) = explode("?", $url, 2);

                if ($files) {
                    parse_str($post, $m);

                    foreach ($m as $k => $v)
                        $m[$k] = isset($v[0]) && $v[0] == "@" ? sprintf("\0%s", $v) : $v;

                    $post = $m;
                    foreach ($files as $i => $path)
                        if (file_exists($path))
                            $post["file".$i] = function_exists("curl_file_create") ? curl_file_create($path) : "@".$path;
                }

                curl_setopt($c, CURLOPT_POSTFIELDS, $post);
            }

            curl_setopt($c, CURLOPT_URL, $url);

            $ret = curl_exec($c);
        }
        elseif ($files) {
            if (SMSC_DEBUG)
                echo "Не установлен модуль curl для передачи файлов\n";
        }
        else {
            if (!SMSC_HTTPS && function_exists("fsockopen"))
            {
                $m = parse_url($url);

                if (!$fp = fsockopen($m["host"], 80, $errno, $errstr, $tm))
                    $fp = fsockopen("212.24.33.196", 80, $errno, $errstr, $tm);

                if ($fp) {
                    stream_set_timeout($fp, 60);

                    fwrite($fp, ($post ? "POST $m[path]" : "GET $m[path]?$m[query]")." HTTP/1.1\r\nHost: smsc.kz\r\nUser-Agent: PHP".($post ? "\r\nContent-Type: application/x-www-form-urlencoded\r\nContent-Length: ".strlen($m['query']) : "")."\r\nConnection: Close\r\n\r\n".($post ? $m['query'] : ""));

                    while (!feof($fp))
                        $ret .= fgets($fp, 1024);
                    list(, $ret) = explode("\r\n\r\n", $ret, 2);

                    fclose($fp);
                }
            }
            else
                $ret = file_get_contents($url);
        }

        return $ret;
    }
    public static function send_sms($phones, $message, $translit = 0, $time = 0, $id = 0, $format = 0, $sender = false, $query = "", $files = array())
    {
        static $formats = array(1 => "flash=1", "push=1", "hlr=1", "bin=1", "bin=2", "ping=1", "mms=1", "mail=1", "call=1", "viber=1", "soc=1");

        $m = self::_smsc_send_cmd("send", "cost=3&phones=".urlencode($phones)."&mes=".urlencode($message).
            "&translit=$translit&id=$id".($format > 0 ? "&".$formats[$format] : "").
            ($sender === false ? "" : "&sender=".urlencode($sender)).
            ($time ? "&time=".urlencode($time) : "").($query ? "&$query" : ""), $files);

        // (id, cnt, cost, balance) или (id, -error)

        if (SMSC_DEBUG) {
            if ($m[1] > 0)
                echo "Сообщение отправлено успешно. ID: $m[0], всего SMS: $m[1], стоимость: $m[2], баланс: $m[3].\n";
            else
                echo "Ошибка №", -$m[1], $m[0] ? ", ID: ".$m[0] : "", "\n";
        }

        return $m;
    }

    /**
     *
     */

    function signin_RESTodroid_API(){
    header("Access-Control-Allow-Origin: " . self::http_host_uri());
    header("Content-Type: application/json; charset=UTF-8");
    header("Access-Control-Allow-Methods: POST");
    header("Access-Control-Max-Age: 3600");
    header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");


        if(isset($_POST)){
            $email = htmlspecialchars(strip_tags( $_POST['username']));
            $password = htmlspecialchars(strip_tags( $_POST['password']));
            if(RESTModel::isUserExisted($email)&&UserModel::checkData($email,$password)){
                $date = date("Y-m-d H:i:s");

                $userStatus = UserModel::checkData($email,$password);
                $key = "144541354333adswcxs2axas24xcas1x456as47d532c4w";
                $iss = RESTController::http_host_uri();
                $aud = RESTController::http_host_uri();
                $iat = strtotime($date);
                $nbf = strtotime(str_replace('-', '/', $date) . "+1 days");

                if ($userStatus) {
                    $token = array(
                        "iss" => $iss,
                        "aud" => $aud,
                        "iat" => $iat,
                        "nbf" => $nbf,
                        "uid" =>UserModel::getUserData($email)['user_id'],
                        "firstname" => UserModel::getUserData($email)['f_name'],
                        "lastname" => UserModel::getUserData($email)['l_name'],
                        "email" => UserModel::getUserData($email)['email'],
                        "mphone" => UserModel::getUserData($email)['mobile_phone'],
                        "role_id" => UserModel::getUserData($email)['role'],
                        "role_name" => UserModel::getUserData($email)['role_name']
                      
                    );

                    // код ответа
                    http_response_code(200);
                    $jwt = JWT::encode($token, $key);
                    $json['error'] = false;
                    $json['message'] = 'User Successfully logged';
                    $json['jwt'] = $jwt;
                    echo json_encode($json);
                } else {
                    // код ответа
                    http_response_code(401);
                    // сказать пользователю что войти не удалось
                    $json['error'] = false;
                    $json['message'] = 'Invalid username or password';
                    echo json_encode($json);
                }
            } else {
                $json['error'] = false;
                $json['message'] = 'Invalid username or password';
                echo json_encode($json);
            }
        }else {
            $json['error'] = true;
            $json['message'] = 'Wrong method request';
            echo json_encode($json);
        }


}

    function tickets_RESTodroid_API(){
        header("Access-Control-Allow-Origin: " . self::http_host_uri());
        header("Content-Type: application/json; charset=UTF-8");
        header("Access-Control-Allow-Methods: POST");
        header("Access-Control-Max-Age: 3600");
        header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

        if(isset($_GET)){
            if (isset($_GET['status'])&&!empty($_GET['status'])&&!empty($_GET['id'])&&!empty($_GET['role'])){
                $params = [
                    "id"=>$_GET['id'],
                    "status"=>$_GET['status'],
                ];
                $arr = TicketModel::getAllDataFrmTicketWhereByUserID($params);
                $json['error'] = false;
                $json['message'] = 'Tickets get successfull';
                $json['tickets'] = $arr;
                echo json_encode($json);
            }elseif(!isset($_GET['status'])&&!empty($_GET['id'])&&!empty($_GET['role'])){
                if ($_GET['role'] =="1"){
                    $params = [
                        "id"=>$_GET['id'],
                    ];
                    $arr = TicketModel::getAllDataFrmTicketWhereByUserID($params);
                    $json['error'] = false;
                    $json['message'] = 'Tickets get successfull';
                    $json['tickets'] = $arr;
                    echo json_encode($json);
                }elseif($_GET['role']=="5"){
                    $params = [
                        "id"=>$_GET['id'],
                    ];
                    $arr = TicketModel::getAllDataFrmTicketWhereByOwnerID($params);
                    $json['error'] = false;
                    $json['message'] = 'Tickets get successfull';
                    $json['tickets'] = $arr;
                    echo json_encode($json);
                }

            }elseif (isset($_GET['status'])&&!isset($_GET['id'])){
                $params = [
                    "status"=>$_GET['status'],
                ];
                $arr = TicketModel::getAllDataFrmTicketWhereByUserID($params);
                $json['error'] = false;
                $json['message'] = 'Tickets get successfull';
                $json['tickets'] = $arr;
                echo json_encode($json);
            }elseif (!isset($_GET['status'])&&!isset($_GET['id'])){
                $params = [
                ];
                $arr = TicketModel::getAllDataFrmTicketWhereByUserID($params);
                $json['error'] = false;
                $json['message'] = 'Tickets get successfull';
                $json['tickets'] = $arr;
                echo json_encode($json);
            }

        }else {
            $json['error'] = true;
            $json['message'] = 'Wrong method request';
            echo json_encode($json);
        }

    }

    function new_ticket_RESTodroid_API(){
        header("Access-Control-Allow-Origin: " . self::http_host_uri());
        header("Content-Type: application/json; charset=UTF-8");
        header("Access-Control-Allow-Methods: POST");
        header("Access-Control-Max-Age: 3600");
        header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
        if(isset($_POST)){
        $json['error'] = false;
        $json['message'] = 'Success created new ticket.';
        $json['result'] = TicketModel::WriteNewTickets($_POST);
        echo json_encode($json);
        }elseif(isset($_GET)){
            $json['error'] = false;
            $json['message'] = 'Success created new ticket.';
            $json['result'] = TicketModel::WriteNewTickets($_GET);
            echo json_encode($json);
        }else {
            $json['error'] = true;
            $json['message'] = 'Wrong method request';
            echo json_encode($json);
        }
    }

    function confirm_new_ticket_RESTodroid_API(){
//        if (isset($_GET)){
//            var_dump($_GET);
//            if(!empty($_GET['uid'])&&!empty($_GET['uphone'])){
//                $ver_code =  self::randomSMSKey(6);
//                try {
//                    $http = HttpRequest::get("https://smsc.kz/sys/send.php?login=vargar929&psw=v0Vqla20&phones=+".$_GET['uphone']."&mes=Верификация:".$ver_code." Данный код необходим для создания заявки!&translit=1");
//                    $json = $http->ok() ? json_decode($http->body()) : null;
//                    echo $json;
//                } catch (HttpRequestException $e) {
//                    exit($e->getMessage());
//                }
//                $params = [
//                    'uid' => $_GET['uid'],
//                    'sms_key'=> $ver_code
//                ];
//                RESTModel::putVerCode($params);
//            }
//
//        }else
            if (isset($_POST)){
            var_dump($_POST);
            if(!empty($_POST['uid'])&&!empty($_POST['uphone'])){
                $ver_code =  self::randomSMSKey(6);
                try {
                    $http = HttpRequest::get("https://smsc.kz/sys/send.php?login=vargar929&psw=v0Vqla20&phones=+".$_POST['uphone']."&mes=Верификация:".$ver_code." Данный код необходим для создания заявки!&translit=1");
                    $json = $http->ok() ? json_decode($http->body()) : null;
                    echo $json;
                } catch (HttpRequestException $e) {
                    exit($e->getMessage());
                }
                $params = [
                    'uid' => $_POST['uid'],
                    'sms_key'=> $ver_code
                ];
                RESTModel::putVerCode($params);
            }
        }
    }


}