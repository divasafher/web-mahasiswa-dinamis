<?php
defined('BASEPATH') OR exit('No direct script access allowed');

function check_login()
{
    $CI =& get_instance();
    if ($CI->session->userdata('logged_in') !== TRUE) {
        redirect('login');
    }
}

function check_role($required_role)
{
    $CI =& get_instance();
    $roles = is_array($required_role) ? $required_role : array($required_role);
    if (!in_array($CI->session->userdata('role'), $roles, TRUE)) {
        show_error('Anda tidak memiliki akses ke halaman ini.', 403, 'Forbidden');
    }
}

function current_user()
{
    $CI =& get_instance();
    return array(
        'id' => $CI->session->userdata('user_id'),
        'name' => $CI->session->userdata('name'),
        'email' => $CI->session->userdata('email'),
        'role' => $CI->session->userdata('role'),
    );
}
