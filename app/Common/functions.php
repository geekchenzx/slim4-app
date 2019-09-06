<?php
/**
 * Created by PhpStorm.
 * User: chenzx
 * Date: 2019-08-27
 * Time: 17:46
 */
//if(!function_exists('views')) {
//    function views($view, $data) {
//        return
//
//    }
//}


/**
 *
 * 加密函数
 * @param $param [传入需要加密的参数]
 * @return string
 */
function encrypt_validate($param) {
    return md5('site'.uniqid(md5('site' . $param)).'site');
}
function random_str($len = 4) {
    //4.1 定义验证码的内容
    $content = "ABCDEFGHIJKLMNPQRSTUVWXYZabcdefghijklmnpqrstuvwxyz123456789";
    $captcha = "";
    for ($i = 1; $i <= $len; $i++) {
        // 设置字体内容
        $fontcontent = substr($content, mt_rand(0, strlen($content)), 1);
        $captcha     .= $fontcontent;
    }
    return $captcha;
}
/**
 * 数据返回格式
 * @param int $code
 * @param string $msg
 * @param array $data
 * @return array
 */
function res_data($code = 0, $msg = '', $data = []) {
    return [
        'err_no' => $code,
        'err_msg' => $msg,
        'data' => $data
    ];
}
/**
 * 获取客户端IP地址
 * @param integer $type 返回类型 0 返回IP地址 1 返回IPV4地址数字
 * @param boolean $adv 是否进行高级模式获取（有可能被伪装）
 * @return mixed
 */
function get_client_ip($type = 0,$adv=false) {
    $type       =  $type ? 1 : 0;
    static $ip  =   NULL;
    if ($ip !== NULL) return $ip[$type];
    if($adv){
        if (isset($_SERVER['HTTP_X_FORWARDED_FOR'])) {
            $arr    =   explode(',', $_SERVER['HTTP_X_FORWARDED_FOR']);
            $pos    =   array_search('unknown',$arr);
            if(false !== $pos) unset($arr[$pos]);
            $ip     =   trim($arr[0]);
        }elseif (isset($_SERVER['HTTP_CLIENT_IP'])) {
            $ip     =   $_SERVER['HTTP_CLIENT_IP'];
        }elseif (isset($_SERVER['REMOTE_ADDR'])) {
            $ip     =   $_SERVER['REMOTE_ADDR'];
        }
    }elseif (isset($_SERVER['REMOTE_ADDR'])) {
        $ip     =   $_SERVER['REMOTE_ADDR'];
    }
    // IP地址合法验证
    $long = sprintf("%u",ip2long($ip));
    $ip   = $long ? array($ip, $long) : array('0.0.0.0', 0);
    return $ip[$type];
}
//手机号验证
function checkMobileValidity($mobilephone) {
    $exp = "/^13[0-9]{1}[0-9]{8}$|15[012356789]{1}[0-9]{8}$|178[0-9]{1}[0-9]{7}$|18[012356789]{1}[0-9]{8}$|14[57]{1}[0-9]$/";
    if (preg_match($exp, $mobilephone)){
        return true;
    } else {
        return false;
    }
}
/**
 * CURL请求数据
 * @param string $url 请求地址
 * @param unknown $param 请求参数
 * @return Ambigous <multitype:, mixed>
 */
function getCurl($url='',$param=array()){
    $resultJson = array();
    if(!empty($param) && !empty($url)){
        $curlObj = curl_init();
        curl_setopt($curlObj, CURLOPT_POSTFIELDS, $param);
        curl_setopt($curlObj, CURLOPT_URL, $url);
        curl_setopt($curlObj, CURLOPT_RETURNTRANSFER, true);
        $resultJson = curl_exec($curlObj);
        curl_close($curlObj);
    }
    return $resultJson;
}
/**
 * 加密、解密字符串
 *
 * @global string $db_hash
 * @global array $pwServer
 * @param $string [待处理字符串]
 * @param $action [ENCODE|DECODE]
 * @return string
 */
function encrypt_str($string, $action = 'ENCODE') {
    $action != 'ENCODE' && $string = base64_decode($string);
    $code = '';
    $key = substr(md5($_SERVER['HTTP_USER_AGENT']), 8, 18);
    $keyLen = strlen($key);
    $strLen = strlen($string);
    for ($i = 0; $i < $strLen; $i++) {
        $k = $i % $keyLen;
        $code .= intval($string[$i]) ^ intval($key[$k]);
    }
    return ($action != 'DECODE' ? base64_encode($code) : $code);
}
/**
 * 加密
 * @param string $str    要加密的数据
 * @return bool|string   加密后的数据
 */
function encrypt($str) {
    $aes_key = 'bUYJ3nTV6VBasdJF';
    $data = openssl_encrypt($str, 'AES-128-ECB', $aes_key, OPENSSL_RAW_DATA);
    $data = base64_encode($data);
    return $data;
}
/**
 * 解密
 * @param string $str    要解密的数据
 * @return string        解密后的数据
 */
function decrypt($str) {
    $aes_key = 'bUYJ3nTV6VBasdJF';
    $decrypted = openssl_decrypt(base64_decode($str), 'AES-128-ECB', $aes_key, OPENSSL_RAW_DATA);
    return $decrypted;
}
