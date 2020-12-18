<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class User_model extends CI_Model
{

    function __construct()
    {
        parent::__construct();
    }

    public function getUser()
    {
        $this->db->select('*');
        $this->db->from('tab_user');

        $query = $this->db->get();
        $results = array();

        if ($query->num_rows() > 0) {
            $results = $query->result();
        }
        return $results;
    }

    public function appUser($id)
    {
        $this->db->set('is_active', '1', FALSE);
        $this->db->where('id', $id);
        $this->db->update('tab_user');
    }

    public function noActive($id)
    {
        $this->db->set('is_active', '0', FALSE);
        $this->db->where('id', $id);
        $this->db->update('tab_user');
    }

    public function delUser($id)
    {
        $this->db->where('id', $id);
        $this->db->delete('tab_user', ['id' => $id]);
    }

    public function getAccess()
    {
        $this->db->select('*');
        $this->db->where('id', $this->session->userdata('id'));
        $this->db->from('tab_user');

        $query = $this->db->get();
        $results = array();

        if ($query->num_rows() > 0) {
            $results = $query->result();
        }
        return $results;
    }

    public function saveaccess($data, $where)
    {
        $this->db->where($where);
        $this->db->update('tab_user', $data);
        return TRUE;
    }
}
