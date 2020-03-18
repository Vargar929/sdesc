<?php

declare(strict_types=1);


use YoHang88\LetterAvatar\LetterAvatar;

function view($to, $data = null)
{
    return hleb_v5ds34hop4nm1d_page_view($to, $data);
}

function render($name, $data = null)
{
    return hleb_v10s20hdp8nm7c_render($name, $data);
}

function data()
{
    return hleb_to0me1cd6vo7gd_data();
}

function csrf_field()
{
    echo hleb_ds5bol10m0bep2_csrf_field();
}

function csrf_token()
{
    return hleb_c3dccfa0da1a3e_csrf_token();
}

function storage($to, $data = null)
{
    return hleb_hol6h1d32sm0l1of_storage($to, $data);
}

function redirectToSite($url)
{
    hleb_ba5c9de48cba78c_redirectToSite($url);
}

function redirect(string $url, int $code = 303)
{
    hleb_ad7371873a6ad40_redirect($url, $code);
}

function getProtectUrl($url)
{
    return hleb_ba5c9de48cba78c_getProtectUrl($url);
}

function getFullUrl($url)
{
    return hleb_e0b1036cd5b501_getFullUrl($url);
}

function getMainUrl()
{
    return hleb_e2d3aeb0253b7_getMainUrl();
}

function getMainClearUrl()
{
    return hleb_daa581cdd6323_getMainClearUrl();
}

function getUrlByName($name, $args=[])
{
    return hleb_i245eaa1a3b6d_getByName($name, $args);
}

function getStandardUrl(string $name)
{
    return hleb_a1a3b6di245ea_getStandardUrl($name);
}

function print_r2($data, $desc = null)
{
    hleb_a581cdd66c107015_print_r2($data, $desc);
}

function includeTemplate(string $template, array $params = [])
{
    hleb_e0b1036c1070101_template($template, $params);
}

function includeCachedTemplate(string $template, array $params = [])
{
    hleb_e0b1036c1070102_template($template, $params);
}

function includeOwnCachedTemplate(string $template, array $params = [])
{
    hleb_ade9e72e1018c6_template($template, $params);
}

function getRequestResources()
{
    return hleb_ra3le00te0m01n_request_resources();
}

function getRequestHead()
{
    return hleb_t0ulb902e69thp_request_head();
}

function RenderUserAvatar($f_name, $l_name)
{
    $avatar = new LetterAvatar($f_name . ' ' . $l_name, 'square', 48);
    return $avatar;
}

 function randomSecretKey(int $secret_key_max_lenght) {
    $alphabet = "abcdefghijklmnopqrstuwxyzABCDEFGHIJKLMNOPQRSTUWXYZ0123456789";
    $pass = array(); 
    $alphaLength = strlen($alphabet) - 1; 
    for ($i = 0; $i < $secret_key_max_lenght; $i++) {
        $n = rand(0, $alphaLength);
        $pass[] = $alphabet[$n];
    }
    return implode($pass);
}

function seokeywords($contents,$symbol=5,$words=35){
    $contents = @preg_replace(array("'<[\/\!]*?[^<>]*?>'si","'([\r\n])[\s]+'si","'&[a-z0-9]{1,6};'si","'( +)'si"),
        array("","\\1 "," "," "),strip_tags($contents));
    $rearray = array("~","!","@","#","$","%","^","&","*","(",")","_","+",
        "`",'"',"№",";",":","?","-","=","|","\"","\\","/",
        "[","]","{","}","'",",",".","<",">","\r\n","\n","\t","«","»");

	$adjectivearray = array("ые","ое","ие","ий","ая","ый","ой","ми","ых","ее","ую","их","ым",
        "как","для","что","или","это","этих",
        "всех","вас","они","оно","еще","когда",
        "где","эта","лишь","уже","вам","нет",
        "если","надо","все","так","его","чем",
        "при","даже","мне","есть","только","очень",
        "сейчас","точно","обычно"
    );
	$contents = @str_replace($rearray," ",$contents);
	$keywordcache = @explode(" ",$contents);
	$rearray = array();

	foreach($keywordcache as $word){
        if(strlen($word)>=$symbol && !is_numeric($word)){
            $adjective = substr($word,-2);
            if(!in_array($adjective,$adjectivearray) && !in_array($word,$adjectivearray)){
                $rearray[$word] = (array_key_exists($word,$rearray)) ? ($rearray[$word] + 1) : 1;
            }
        }
    }

	@arsort($rearray);
	$keywordcache = @array_slice($rearray,0,$words);
	$keywords = "";

	foreach($keywordcache as $word=>$count){
        $keywords.= ",".$word;
    }

	return substr($keywords,1);
}

function switcher($text,$arrow=0){
    $str[0] = array('й' => 'q', 'ц' => 'w', 'у' => 'e', 'к' => 'r', 'е' => 't', 'н' => 'y', 'г' => 'u', 'ш' => 'i', 'щ' => 'o', 'з' => 'p', 'х' => '[', 'ъ' => ']', 'ф' => 'a', 'ы' => 's', 'в' => 'd', 'а' => 'f', 'п' => 'g', 'р' => 'h', 'о' => 'j', 'л' => 'k', 'д' => 'l', 'ж' => ';', 'э' => '\'', 'я' => 'z', 'ч' => 'x', 'с' => 'c', 'м' => 'v', 'и' => 'b', 'т' => 'n', 'ь' => 'm', 'б' => ',', 'ю' => '.','Й' => 'Q', 'Ц' => 'W', 'У' => 'E', 'К' => 'R', 'Е' => 'T', 'Н' => 'Y', 'Г' => 'U', 'Ш' => 'I', 'Щ' => 'O', 'З' => 'P', 'Х' => '[', 'Ъ' => ']', 'Ф' => 'A', 'Ы' => 'S', 'В' => 'D', 'А' => 'F', 'П' => 'G', 'Р' => 'H', 'О' => 'J', 'Л' => 'K', 'Д' => 'L', 'Ж' => ';', 'Э' => '\'', '?' => 'Z', 'ч' => 'X', 'С' => 'C', 'М' => 'V', 'И' => 'B', 'Т' => 'N', 'Ь' => 'M', 'Б' => ',', 'Ю' => '.',);
    $str[1] = array (  'q' => 'й', 'w' => 'ц', 'e' => 'у', 'r' => 'к', 't' => 'е', 'y' => 'н', 'u' => 'г', 'i' => 'ш', 'o' => 'щ', 'p' => 'з', '[' => 'х', ']' => 'ъ', 'a' => 'ф', 's' => 'ы', 'd' => 'в', 'f' => 'а', 'g' => 'п', 'h' => 'р', 'j' => 'о', 'k' => 'л', 'l' => 'д', ';' => 'ж', '\'' => 'э', 'z' => 'я', 'x' => 'ч', 'c' => 'с', 'v' => 'м', 'b' => 'и', 'n' => 'т', 'm' => 'ь', ',' => 'б', '.' => 'ю','Q' => 'Й', 'W' => 'Ц', 'E' => 'У', 'R' => 'К', 'T' => 'Е', 'Y' => 'Н', 'U' => 'Г', 'I' => 'Ш', 'O' => 'Щ', 'P' => 'З', '[' => 'Х', ']' => 'Ъ', 'A' => 'Ф', 'S' => 'Ы', 'D' => 'В', 'F' => 'А', 'G' => 'П', 'H' => 'Р', 'J' => 'О', 'K' => 'Л', 'L' => 'Д', ';' => 'Ж', '\'' => 'Э', 'Z' => '?', 'X' => 'ч', 'C' => 'С', 'V' => 'М', 'B' => 'И', 'N' => 'Т', 'M' => 'Ь', ',' => 'Б', '.' => 'Ю', );
    return strtr($text,isset( $str[$arrow] )? $str[$arrow] :array_merge($str[0],$str[1]));
}