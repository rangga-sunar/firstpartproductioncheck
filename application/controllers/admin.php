<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Admin extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();

        $this->load->helper(array('form', 'url'));
        $this->load->library(array('session', 'form_validation', 'upload', 'PHPMailer'));
        $this->load->model('User_model');
    }

    public function viewUser()
    {
        $data['user'] = $this->User_model->getUser();
        $data['akses'] = $this->User_model->getAccess();
        $this->load->view('templates/header');
        $this->load->view('templates/navbar', $data);
        $this->load->view('user/viewuser', $data);
        $this->load->view('templates/footer');
    }

    public function approve($id)
    {
        $this->User_model->appUser($id);
        $this->session->set_flashdata('flash', 'Approved');
        redirect('admin/viewuser');
    }

    public function nonActive($id)
    {
        $this->User_model->noActive($id);
        $this->session->set_flashdata('flash', 'Non Active');
        redirect('admin/viewuser');
    }

    public function delete($id)
    {
        $this->User_model->delUser($id);
        $this->session->set_flashdata('flash', 'Deleted');
        redirect('admin/viewuser');
    }

    public function saveaccess()
    {
        $id = $this->input->post('id');
        $hasil = '';
        for ($i = 0; $i < count($this->input->post('program')); $i++) {
            $hasil .= $this->input->post('program')[$i] . ",";
        }

        $data = [
            'access' => rtrim($hasil, ","),
            'level' => $this->input->post('level')
        ];

        $where = array('id' => $id);
        $this->User_model->saveaccess($data, $where);
        redirect('admin/viewuser');
    }
}
