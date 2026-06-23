<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH.'libraries/REST_Controller.php';

use chriskacerguis\RestServer\RestController;

class Auth extends RestController {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('User_model');
        $this->load->helper('jwt');
        $this->config->load('rest');
    }

	public function login_post()
    {
        $email = $this->post('email');
        $password = $this->post('password');

        if (!$email || !$password) {
            return $this->response(['status' => FALSE, 'message' => 'Email and password are required'], RestController::HTTP_BAD_REQUEST);
        }

        $user = $this->User_model->getByEmail($email);

        if (!$user || !password_verify($password, $user->password)) {
            return $this->response(['status' => FALSE, 'message' => 'Invalid email or password'], RestController::HTTP_UNAUTHORIZED);
        }

        $token = generate_jwt(['id' => $user->id, 'email' => $user->email], $this->config->item('jwt_secret_key'), $this->config->item('jwt_expire_seconds'));

        return $this->response(
            [
                'status' => TRUE, 
                'message' => 'Login successful', 
                'data' => [
                    'token' => $token,
                    'user' => [
                        'id' => $user->id,
                        'email' => $user->email
                    ]
                ]
            ], RestController::HTTP_OK);
    }

    public function users_get()
    {
        $payload = $this->_authenticate();

        if (!$payload) {
            return $this->response(['status' => FALSE, 'message' => 'Invalid or expired token'], RestController::HTTP_UNAUTHORIZED);
        }

        $user = $this->User_model->getById($payload->id);

        if (!$user) {
            return $this->response(['status' => FALSE, 'message' => 'User not found'], RestController::HTTP_NOT_FOUND);
        }

        return $this->response(
            [
                'status' => TRUE, 
                'message' => 'User data retrieved successfully', 
                'data' => [
                    'id' => $user->id,
                    'email' => $user->email
                ]
            ], RestController::HTTP_OK);
    }

    private function _authenticate()
    {
        $token = get_bearer_token();
        if (!$token) {
            $this->response(array('status' => FALSE, 'message' => 'Token tidak ditemukan', 'data' => NULL, 'meta' => NULL), 401);
            exit;
        }

        $payload = verify_jwt($token);
        if (!$payload) {
            $this->response(array('status' => FALSE, 'message' => 'Token tidak valid atau expired', 'data' => NULL, 'meta' => NULL), 401);
            exit;
        }

        return $payload;
    }
}
