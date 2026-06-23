<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class Dashboard extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        check_login();

        $this->load->model('User_model');
        $this->load->model('Article_model');
        $this->load->model('Material_model');
    }

    public function index()
    {
        if ($this->session->userdata('logged_in') !== TRUE) {
            redirect('login');
        }

        $data = array(
            'title' => 'Dashboard',
            'total_articles' => $this->Article_model->countAll(),
            'total_published' => $this->Article_model->countByStatus('published'),
            'total_draft' => $this->Article_model->countByStatus('draft'),
            'total_materials' => $this->Material_model->countAll(),
            'total_users' => count($this->User_model->getAll()),
            'recent_articles' => $this->Article_model->getRecent(5),
        );
        $this->load->view('dashboard/index', $data);
    }

    
}
