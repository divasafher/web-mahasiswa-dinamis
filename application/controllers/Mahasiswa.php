<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mahasiswa extends CI_Controller
{
    public function index()
    {
        $data['mahasiswa'] = $this->db
            ->get('student_profiles')
            ->result();

        $this->load->view('mahasiswa/index', $data);
    }

    public function tambah()
    {
        if($_POST)
        {
            $data = [
                'user_id' => $this->input->post('user_id'),
                'nim' => $this->input->post('nim'),
                'program_studi' => $this->input->post('program_studi'),
                'angkatan' => $this->input->post('angkatan'),
                'jenis_kelamin' => $this->input->post('jenis_kelamin'),
                'created_at' => date('Y-m-d H:i:s')
            ];

            $this->db->insert('student_profiles', $data);

            redirect('mahasiswa');
        }

        $data['users'] = $this->db
            ->where('role','mahasiswa')
            ->get('users')
            ->result();

        $this->load->view('mahasiswa/tambah', $data);
    }
}