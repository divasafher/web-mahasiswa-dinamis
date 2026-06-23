<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Article_model extends CI_Model
{
    protected $table = 'articles';

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    public function getAll($filters = array())
    {
        $this->db->select('articles.*, users.name AS author_name, users.email AS author_email')
            ->from($this->table)
            ->join('users', 'users.id = articles.user_id', 'left');

        if (!empty($filters['status'])) {
            $this->db->where('articles.status', $filters['status']);
        }
        if (!empty($filters['user_id'])) {
            $this->db->where('articles.user_id', $filters['user_id']);
        }
        if (isset($filters['limit'])) {
            $this->db->limit((int) $filters['limit'], isset($filters['offset']) ? (int) $filters['offset'] : 0);
        }

        return $this->db->order_by('articles.created_at', 'DESC')->get()->result();
    }

    public function countAll($filters = array())
    {
        if (!empty($filters['status'])) {
            $this->db->where('status', $filters['status']);
        }
        if (!empty($filters['user_id'])) {
            $this->db->where('user_id', $filters['user_id']);
        }
        return $this->db->count_all_results($this->table);
    }

    public function countByStatus($status)
    {
        return $this->db->where('status', $status)->count_all_results($this->table);
    }

    public function getRecent($limit = 5)
    {
        return $this->getAll(array('limit' => $limit, 'offset' => 0));
    }

    public function getById($id)
    {
        return $this->db->select('articles.*, users.name AS author_name, users.email AS author_email')
            ->from($this->table)
            ->join('users', 'users.id = articles.user_id', 'left')
            ->where('articles.id', $id)
            ->get()
            ->row();
    }

    public function getBySlug($slug)
    {
        return $this->db->where('slug', $slug)->get($this->table)->row();
    }

    public function create($data)
    {
        $data['slug'] = $this->generateSlug($data['title']);
        $this->db->insert($this->table, $data);
        return $this->db->insert_id();
    }

    public function update($id, $data)
    {
        if (!empty($data['title'])) {
            $current = $this->db->select('title')->where('id', $id)->get($this->table)->row();
            if ($current && $current->title !== $data['title']) {
                $data['slug'] = $this->generateSlug($data['title'], $id);
            }
        }

        $this->db->where('id', $id)->update($this->table, $data);
        return $this->db->affected_rows();
    }

    public function delete($id)
    {
        $this->db->where('id', $id)->delete($this->table);
        return $this->db->affected_rows();
    }

    private function generateSlug($title, $ignore_id = NULL)
    {
        $this->load->helper('url');
        $base_slug = url_title($title, 'dash', TRUE);
        $slug = $base_slug;
        $counter = 1;

        while ($this->slugExists($slug, $ignore_id)) {
            $slug = $base_slug.'-'.$counter;
            $counter++;
        }

        return $slug;
    }

    private function slugExists($slug, $ignore_id = NULL)
    {
        $this->db->where('slug', $slug);
        if ($ignore_id) {
            $this->db->where('id !=', $ignore_id);
        }
        return $this->db->count_all_results($this->table) > 0;
    }

    public function countToday()
{
    return $this->db
        ->where('DATE(created_at)', date('Y-m-d'))
        ->count_all_results($this->table);
}
}