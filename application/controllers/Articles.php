<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Articles extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        check_login();
        $this->load->model('Article_model');
    }

   public function index()
{
    $articles = $this->Article_model->getAll();

    $this->load->view('articles/index', array(
        'title' => 'Artikel',
        'articles' => $articles,
        'total' => $this->Article_model->countAll(),
        'published' => $this->Article_model->countByStatus('published'),
        'draft' => $this->Article_model->countByStatus('draft'),
        'today' => $this->Article_model->countToday()
    ));
}

    public function create()
    {
        $this->setValidationRules();

        if ($this->input->method() === 'post' && $this->form_validation->run()) {
            $this->Article_model->create(array(
                'user_id' => $this->session->userdata('user_id'),
                'title' => $this->input->post('title', TRUE),
                'content' => $this->input->post('content', FALSE),
                'status' => $this->input->post('status', TRUE),
            ));

            $this->session->set_flashdata('success', 'Artikel berhasil dibuat.');
            redirect('articles');
        }

        $this->load->view('articles/create', array('title' => 'Tambah Artikel'));
    }

    public function edit($id)
    {
        $article = $this->Article_model->getById($id);
        if (!$article) {
            show_404();
        }

        $this->setValidationRules();

        if ($this->input->method() === 'post' && $this->form_validation->run()) {
            $this->Article_model->update($id, array(
                'title' => $this->input->post('title', TRUE),
                'content' => $this->input->post('content', FALSE),
                'status' => $this->input->post('status', TRUE),
            ));

            $this->session->set_flashdata('success', 'Artikel berhasil diperbarui.');
            redirect('articles');
        }

        $this->load->view('articles/edit', array('title' => 'Edit Artikel', 'article' => $article));
    }

    public function delete($id)
    {
        if ($this->input->method() !== 'post') {
            show_404();
        }

        $this->Article_model->delete($id);
        $this->session->set_flashdata('success', 'Artikel berhasil dihapus.');
        redirect('articles');
    }

    private function setValidationRules()
    {
        $this->form_validation->set_rules('title', 'Judul', 'required|min_length[5]|max_length[200]');
        $this->form_validation->set_rules('content', 'Konten', 'required');
        $this->form_validation->set_rules('status', 'Status', 'required|in_list[draft,published]');
    }
}