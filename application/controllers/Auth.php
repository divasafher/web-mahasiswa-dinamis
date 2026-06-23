<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class Auth extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('User_model');
    }

    public function index()
    {
        $this->load->view('auth/login', array('title' => 'Login'));
    }
    public function login()
    {
        if ($this->session->userdata('logged_in') === TRUE) {
            redirect('dashboard');
        }

        if ($this->input->method() === 'post') {
            $this->form_validation->set_rules('email', 'Email', 'required|valid_email');
            $this->form_validation->set_rules('password', 'Password', 'required');

            if ($this->form_validation->run()) {
                $user = $this->User_model->getByEmail($this->input->post('email', TRUE));

                if ($user && password_verify($this->input->post('password'), $user->password)) {
                    $this->session->set_userdata(array(
                        'logged_in' => TRUE,
                        'user_id' => $user->id,
                        'name' => $user->name,
                        'email' => $user->email,
                        'role' => $user->role,
                    ));
                    redirect('dashboard');
                }

                $this->session->set_flashdata('error', 'Email atau password salah.');
            }
        }

        $this->load->view('auth/login', array('title' => 'Login'));
    }

    public function forgot_password()
{
    $this->load->view('auth/forgot_password');
}

public function process_forgot_password()
{
    $email = $this->input->post('email', TRUE);

    $user = $this->User_model->getByEmail($email);

    if ($user) {

        $new_password = '12345678';

        $this->db->where('id', $user->id);
        $this->db->update('users', array(
            'password' => password_hash($new_password, PASSWORD_DEFAULT)
        ));

        $this->session->set_flashdata(
            'success',
            'Password berhasil direset menjadi: 12345678'
        );

        redirect('login');

    } else {

        $this->session->set_flashdata(
            'error',
            'Email tidak ditemukan'
        );

        redirect('auth/forgot_password');
    }
}
    public function logout()
    {
        $this->session->sess_destroy();
        redirect('login');
    }
}
