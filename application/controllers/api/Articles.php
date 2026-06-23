<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH.'libraries/REST_Controller.php';

use chriskacerguis\RestServer\RestController;

class Articles extends RestController {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Article_model');
        $this->load->helper('jwt');
        $this->config->load('rest');
    }

	public function index_get($id = null)
    {
        if ($id) {
            $article = $this->Article_model->getById($id);
            if (!$article) {
                return $this->response(['status' => FALSE, 'message' => 'Article not found'], RestController::HTTP_NOT_FOUND);
            }
            return $this->response(['status' => TRUE, 'message' => 'Article retrieved successfully', 'data' => $article], RestController::HTTP_OK);
        } else {
            $articles = $this->Article_model->getAll();
            return $this->response(['status' => TRUE, 'message' => 'Articles retrieved successfully', 'data' => $articles], RestController::HTTP_OK);
        }
    }

    public function index_post()
    { 
        $payload = $this->_authenticate();

        if (!$payload) {
            return $this->response(['status' => FALSE, 'message' => 'Invalid or expired token'], RestController::HTTP_UNAUTHORIZED);
        }

        $slug = url_title($this->post('title'), 'dash', TRUE);
        $existing_article = $this->Article_model->getBySlug($slug);
        if ($existing_article) {
            return $this->response(['status' => FALSE, 'message' => 'An article with the same title already exists'], RestController::HTTP_CONFLICT);
        }

        $data = [
            'title' => $this->post('title'),
            'content' => $this->post('content'),
            'user_id' => $payload->id,
            'slug' => $slug,
            'status' => $this->post('status') ? $this->post('status') : 'draft'
        ];

        $article_id = $this->Article_model->create($data);

        if ($article_id) {
            return $this->response(['status' => TRUE, 'message' => 'Article created successfully', 'data' => ['id' => $article_id]], RestController::HTTP_CREATED);
        } else {
            return $this->response(['status' => FALSE, 'message' => 'Failed to create article'], RestController::HTTP_INTERNAL_SERVER_ERROR);
        }
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

    public function url_title($str, $separator = 'dash', $lowercase = FALSE)
    {
        $q_separator = preg_quote($separator, '#');
        $trans = array(
            '&.+?;' => '',
            '[^\w\d\-_]' => '',
            '\s+' => $separator,
            '('.$q_separator.')+' => $separator
        );
        foreach ($trans as $key => $val) {
            $str = preg_replace('#'.$key.'#i', $val, $str);
        }
        if ($lowercase === TRUE) {
            $str = strtolower($str);
        }
        return trim($str, $separator);
    }
}
