<?php
defined('BASEPATH') OR exit('No direct script access allowed');

use Firebase\JWT\JWT;
use Firebase\JWT\Key;

function generate_jwt($payload)
{
    $CI =& get_instance();
    $CI->config->load('rest');

    $now = time();
    $expires = (int) $CI->config->item('jwt_expire_seconds');
    $claims = array_merge($payload, array('iat' => $now, 'exp' => $now + $expires));

    return JWT::encode($claims, $CI->config->item('jwt_secret_key'), 'HS256');
}

function verify_jwt($token)
{
    $CI =& get_instance();
    $CI->config->load('rest');

    try {
        return JWT::decode($token, new Key($CI->config->item('jwt_secret_key'), 'HS256'));
    } catch (Exception $e) {
        return FALSE;
    }
}

function get_bearer_token()
{
    $headers = function_exists('apache_request_headers') ? apache_request_headers() : array();
    $authorization = NULL;

    foreach ($headers as $key => $value) {
        if (strtolower($key) === 'authorization') {
            $authorization = $value;
            break;
        }
    }

    if (!$authorization && isset($_SERVER['HTTP_AUTHORIZATION'])) {
        $authorization = $_SERVER['HTTP_AUTHORIZATION'];
    }

    if (!$authorization && isset($_SERVER['REDIRECT_HTTP_AUTHORIZATION'])) {
        $authorization = $_SERVER['REDIRECT_HTTP_AUTHORIZATION'];
    }

    if ($authorization && preg_match('/Bearer\s(\S+)/', $authorization, $matches)) {
        return $matches[1];
    }

    return NULL;
}
