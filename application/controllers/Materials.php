<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Materials extends CI_Controller
{
    private $upload_path = './uploads/materials/';

    public function __construct()
    {
        parent::__construct();
        check_login();
        $this->load->model('Material_model');
    }

    public function index()
    {
        $this->load->view('materials/index', array(
            'title' => 'Materi',
            'materials' => $this->Material_model->getAll(),
        ));
    }

    public function create()
    {
        check_role(array('admin', 'dosen'));
        $this->setValidationRules(TRUE);

        if ($this->input->method() === 'post' && $this->form_validation->run()) {
            $upload = $this->uploadMaterial();
            if ($upload) {
                $this->Material_model->create(array(
                    'uploaded_by' => $this->session->userdata('user_id'),
                    'title' => $this->input->post('title', TRUE),
                    'description' => $this->input->post('description', TRUE),
                    'file_name' => $upload['file_name'],
                    'original_name' => $upload['orig_name'],
                    'file_size' => $upload['file_size'],
                ));

                $this->session->set_flashdata('success', 'Materi berhasil diupload.');
                redirect('materials');
            }
        }

        $this->load->view('materials/create', array('title' => 'Upload Materi'));
    }

    public function edit($id)
    {
        check_role(array('admin', 'dosen'));
        $material = $this->Material_model->getById($id);
        if (!$material) {
            show_404();
        }

        $this->setValidationRules(FALSE);
        if ($this->input->method() === 'post' && $this->form_validation->run()) {
            $data = array(
                'title' => $this->input->post('title', TRUE),
                'description' => $this->input->post('description', TRUE),
            );

            if (!empty($_FILES['material_file']['name'])) {
                $upload = $this->uploadMaterial();
                if (!$upload) {
                    $this->load->view('materials/edit', array('title' => 'Edit Materi', 'material' => $material));
                    return;
                }

                $this->deleteFile($material->file_name);
                $data['file_name'] = $upload['file_name'];
                $data['original_name'] = $upload['orig_name'];
                $data['file_size'] = $upload['file_size'];
            }

            $this->Material_model->update($id, $data);
            $this->session->set_flashdata('success', 'Materi berhasil diperbarui.');
            redirect('materials');
        }

        $this->load->view('materials/edit', array('title' => 'Edit Materi', 'material' => $material));
    }

    public function delete($id)
    {
        check_role(array('admin', 'dosen'));
        if ($this->input->method() !== 'post') {
            show_404();
        }

        $material = $this->Material_model->getById($id);
        if (!$material) {
            show_404();
        }

        $this->deleteFile($material->file_name);
        $this->Material_model->delete($id);
        $this->session->set_flashdata('success', 'Materi berhasil dihapus.');
        redirect('materials');
    }

    public function download($id)
    {
        $material = $this->Material_model->getById($id);
        if (!$material) {
            show_404();
        }

        $file = FCPATH.'uploads/materials/'.$material->file_name;
        if (!is_file($file)) {
            show_404();
        }

        $this->load->helper('download');
        force_download($material->original_name, file_get_contents($file));
    }

   private function setValidationRules($require_file)
{
    $this->form_validation->set_rules('title', 'Judul Materi', 'required|max_length[200]');
    $this->form_validation->set_rules('description', 'Deskripsi', 'max_length[1000]');

    if ($require_file && empty($_FILES['material_file']['name'])) {
        $this->form_validation->set_rules('material_file', 'File Materi', 'required');
    }
}
private function uploadMaterial()
{
    if (!is_dir($this->upload_path)) {
        mkdir($this->upload_path, 0755, TRUE);
    }

    $this->load->library('upload', array(
        'upload_path'   => $this->upload_path,
        'allowed_types' => 'pdf|jpg|jpeg|png|xls|xlsx',
        'max_size'      => 10240,
        'encrypt_name'  => TRUE,
    ));

    if (!$this->upload->do_upload('material_file')) {
        $this->session->set_flashdata(
            'error',
            strip_tags($this->upload->display_errors())
        );
        return FALSE;
    }

    return $this->upload->data();
}

    private function deleteFile($file_name)
    {
        $file = FCPATH.'uploads/materials/'.$file_name;
        if ($file_name && is_file($file)) {
            unlink($file);
        }
    }
}
