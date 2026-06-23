<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User_model extends CI_Model
{
    protected $table = 'users';
    public $roles = array(
        'admin' => 'Admin',
        'dosen' => 'Dosen',
        'mahasiswa' => 'Mahasiswa',
    );

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    public function getAll()
    {
        return $this->db->where('is_active', 1)->order_by('name', 'ASC')->get($this->table)->result();
    }

    public function getById($id)
    {
        return $this->db->where('id', $id)->where('is_active', 1)->get($this->table)->row();
    }

    public function getByEmail($email)
    {
        return $this->db->where('email', $email)->where('is_active', 1)->get($this->table)->row();
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
        $this->db->where('id', $id)->update($this->table, array('is_active' => 0));
        return $this->db->affected_rows();
    }

    public function emailExists($email)
    {
        return $this->db->where('email', $email)->count_all_results($this->table) > 0;
    }

    public function emailExistsExcept($email, $id)
    {
        return $this->db->where('email', $email)->where('id !=', $id)->count_all_results($this->table) > 0;
    }
}
