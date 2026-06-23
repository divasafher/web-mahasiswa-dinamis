<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require FCPATH.'vendor/chriskacerguis/codeigniter-restserver/src/rest.php';

$config['rest_default_format'] = 'json';
$config['rest_status_field_name'] = 'status';
$config['rest_message_field_name'] = 'message';
$config['rest_enable_cors'] = TRUE;
$config['allowed_cors_headers'] = array('Origin', 'X-Requested-With', 'Content-Type', 'Accept', 'Authorization');
$config['allowed_cors_methods'] = array('GET', 'POST', 'PUT', 'DELETE', 'OPTIONS');
$config['allow_any_cors_domain'] = TRUE;
$config['rest_auth'] = FALSE;
$config['rest_enable_logging'] = FALSE;
$config['jwt_secret_key'] = 'your-minimum-32-character-secret!!';
$config['jwt_expire_seconds'] = 86400;
