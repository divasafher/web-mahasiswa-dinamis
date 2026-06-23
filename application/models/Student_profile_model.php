<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Student_profile_model extends CI_Model
{
    private $table = 'student_profiles';

    public function getByUserId($user_id)
    {
        return $this->db
            ->where('user_id', $user_id)
            ->get($this->table)
            ->row();
    }

    public function saveForUser($user_id, $data)
    {
        $profile = $this->getByUserId($user_id);

        if ($profile)
        {
            $this->db->where('user_id', $user_id);
            return $this->db->update($this->table, $data);
        }

        $data['user_id'] = $user_id;

        return $this->db->insert($this->table, $data);
    }
}