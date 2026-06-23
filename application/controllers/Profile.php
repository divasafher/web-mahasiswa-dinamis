<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Profile extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        check_login();
        $this->load->model('User_model');
        $this->load->model('Student_profile_model');
        $this->load->library('upload');
    }

    public function mahasiswa()
    {
        check_role('mahasiswa');
        $user_id = $this->session->userdata('user_id');
        $user = $this->User_model->getById($user_id);
        $profile = $this->Student_profile_model->getByUserId($user_id);

        $this->setValidationRules();
        if ($this->input->method() === 'post' && $this->form_validation->run()) {
            $photo = NULL;

if (!empty($_FILES['photo']['name'])) {

    $config['upload_path']   = './uploads/profiles/';
    $config['allowed_types'] = 'jpg|jpeg|png';
    $config['max_size']      = 2048;
    $config['encrypt_name']  = TRUE;

    $this->upload->initialize($config);

    if ($this->upload->do_upload('photo')) {

        $uploadData = $this->upload->data();
        $photo = $uploadData['file_name'];

    } else {

        $this->session->set_flashdata(
            'error',
            $this->upload->display_errors()
        );

        redirect('profile/mahasiswa');
    }
}
            $this->User_model->update($user_id, array(
                'name' => $this->input->post('name', TRUE),
            ));

           $profileData = array(
    'nim' => $this->input->post('nim', TRUE),
    'program_studi' => $this->input->post('program_studi', TRUE),
    'angkatan' => $this->input->post('angkatan', TRUE),
    'jenis_kelamin' => $this->input->post('jenis_kelamin', TRUE),
    'tanggal_lahir' => $this->input->post('tanggal_lahir', TRUE) ?: NULL,
    'tempat_lahir' => $this->input->post('tempat_lahir', TRUE),
    'no_hp' => $this->input->post('no_hp', TRUE),
    'alamat' => $this->input->post('alamat', TRUE),
);

if ($photo) {
    $profileData['photo'] = $photo;
}

$this->Student_profile_model->saveForUser($user_id, $profileData);

            $this->session->set_userdata('name', $this->input->post('name', TRUE));
            $this->session->set_flashdata('success', 'Profil berhasil diperbarui.');
            redirect('profile/mahasiswa');
        }

        $this->load->view('profile/mahasiswa', array(
            'title' => 'Profil Mahasiswa',
            'user' => $user,
            'profile' => $profile,
        ));
    }

    private function setValidationRules()
    {
        $this->form_validation->set_rules('name', 'Nama', 'required|max_length[100]');
        $this->form_validation->set_rules('nim', 'NIM', 'required|max_length[30]');
        $this->form_validation->set_rules('program_studi', 'Program Studi', 'required|max_length[100]');
        $this->form_validation->set_rules('angkatan', 'Angkatan', 'required|integer|exact_length[4]');
        $this->form_validation->set_rules('jenis_kelamin', 'Jenis Kelamin', 'required|in_list[L,P]');
        $this->form_validation->set_rules('tanggal_lahir', 'Tanggal Lahir', 'max_length[10]');
        $this->form_validation->set_rules('tempat_lahir', 'Tempat Lahir', 'max_length[100]');
        $this->form_validation->set_rules('no_hp', 'No HP', 'max_length[30]');
        $this->form_validation->set_rules('alamat', 'Alamat', 'max_length[500]');
    }
}
