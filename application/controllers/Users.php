<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Users extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        check_login();
        check_role('admin');
        $this->load->model('User_model');
        $this->load->model('Student_profile_model');
    }

    public function index()
    {
        $this->load->view('users/index', array(
            'title' => 'Manajemen User',
            'users' => $this->User_model->getAll(),
        ));
    }

    public function create()
    {
        $this->setValidationRules();
        $this->form_validation->set_rules('password', 'Password', 'required|min_length[6]');

        if ($this->input->method() === 'post' && $this->form_validation->run()) {
            $role = $this->input->post('role', TRUE);
            $user_id = $this->User_model->create(array(
                'name' => $this->input->post('name', TRUE),
                'email' => $this->input->post('email', TRUE),
                'password' => password_hash($this->input->post('password'), PASSWORD_DEFAULT),
                'role' => $role,
                'is_active' => $this->input->post('is_active') ? 1 : 0,
            ));

            if ($role === 'mahasiswa') {
                $this->Student_profile_model->createForUser($user_id);
            }

            $this->session->set_flashdata('success', 'User berhasil dibuat.');
            redirect('users');
        }

        $this->load->view('users/create', array('title' => 'Tambah User', 'roles' => $this->User_model->roles));
    }

    public function edit($id)
    {
        $user = $this->User_model->getById($id);
        if (!$user) {
            show_404();
        }

        $this->setValidationRules($id);
        if ($this->input->post('password')) {
            $this->form_validation->set_rules('password', 'Password', 'min_length[6]');
        }

        if ($this->input->method() === 'post' && $this->form_validation->run()) {
            $role = $this->input->post('role', TRUE);
            $data = array(
                'name' => $this->input->post('name', TRUE),
                'email' => $this->input->post('email', TRUE),
                'role' => $role,
                'is_active' => $this->input->post('is_active') ? 1 : 0,
            );

            if ($this->input->post('password')) {
                $data['password'] = password_hash($this->input->post('password'), PASSWORD_DEFAULT);
            }

            $this->User_model->update($id, $data);
            if ($role === 'mahasiswa' && !$this->Student_profile_model->getByUserId($id)) {
                $this->Student_profile_model->createForUser($id);
            }

            $this->session->set_flashdata('success', 'User berhasil diperbarui.');
            redirect('users');
        }

        $this->load->view('users/edit', array('title' => 'Edit User', 'user' => $user, 'roles' => $this->User_model->roles));
    }

    public function delete($id)
    {
        if ($this->input->method() !== 'post') {
            show_404();
        }

        if ((int) $id === (int) $this->session->userdata('user_id')) {
            $this->session->set_flashdata('error', 'Anda tidak bisa menonaktifkan akun sendiri.');
            redirect('users');
        }

        $this->User_model->delete($id);
        $this->session->set_flashdata('success', 'User berhasil dinonaktifkan.');
        redirect('users');
    }

    private function setValidationRules($id = NULL)
    {
        $email_rule = 'required|valid_email';
        $email_rule .= $id ? '|callback_unique_email_except['.$id.']' : '|is_unique[users.email]';

        $this->form_validation->set_rules('name', 'Nama', 'required|max_length[100]');
        $this->form_validation->set_rules('email', 'Email', $email_rule);
        $this->form_validation->set_rules('role', 'Role', 'required|in_list[admin,dosen,mahasiswa]');
    }

    public function unique_email_except($email, $id)
    {
        if ($this->User_model->emailExistsExcept($email, $id)) {
            $this->form_validation->set_message('unique_email_except', 'Email sudah digunakan.');
            return FALSE;
        }

        return TRUE;
    }
}
