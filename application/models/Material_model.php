<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Material_model extends CI_Model
{
    protected $table = 'materials';

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    public function getAll()
    {
        return $this->db->select('materials.*, users.name AS lecturer_name')
            ->from($this->table)
            ->join('users', 'users.id = materials.uploaded_by', 'left')
            ->order_by('materials.created_at', 'DESC')
            ->get()
            ->result();
    }

    public function getById($id)
    {
        return $this->db->select('materials.*, users.name AS lecturer_name')
            ->from($this->table)
            ->join('users', 'users.id = materials.uploaded_by', 'left')
            ->where('materials.id', $id)
            ->get()
            ->row();
    }

    public function create($data)
    {
        $this->db->insert($this->table, $data);
        return $this->db->insert_id();
    }

    public function update($id, $data)
    {
        $this->db->where('id', $id)->update($this->table, $data);
        return $this->db->affected_rows();
    }

    public function delete($id)
    {
        $this->db->where('id', $id)->delete($this->table);
        return $this->db->affected_rows();
    }

    public function countAll()
    {
        return $this->db->count_all_results($this->table);
    }
}
