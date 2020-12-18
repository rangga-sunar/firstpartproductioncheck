<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Auth_model extends CI_Model
{

    function __construct()
    {
        parent::__construct();
    }

    public function updatepass($data, $where)
    {
        $this->db->where($where);
        $this->db->update('tab_user', $data);
        return TRUE;
    }
}
