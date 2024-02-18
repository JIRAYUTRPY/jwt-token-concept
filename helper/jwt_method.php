<?php 
require("../lib/JWT.php");
use \Firebase\JWT\JWT;
function encode_jwt($user){ 
    $key = "my_JWT_key";
    $payload = array(
        "user" => $user,
        "date_time" => date("Y-m-d H:i:s")
    );
    $jwt = JWT::encode($payload, $key);
    $jwt=encrypt_decrypt($jwt,"encrypt");
    return $jwt;
}
function decode_jwt($jwt)
{
    $key = "my_JWT_key";
    try{
        $jwt= encrypt_decrypt($jwt,"decrypt");
        $payload = JWT::decode($jwt, $key, array('HS256'));

    }catch(Exception $e)
    { 
        return false;
    }
    return  (array)$payload;

}

function encrypt_decrypt($str,$action)
{
    $key = 'test';
    $iv_key = 'iv_test';
    $method="AES-256-CBC";
    $iv=substr(md5($iv_key),0,16);
    $output="";

    if($action=="encrypt")
    {
        $output=openssl_encrypt($str, $method,$key,0,$iv);
    }
    else if($action=="decrypt")
    {
        $output=openssl_decrypt($str, $method,$key,0,$iv);
    }

    return $output;
}

?>