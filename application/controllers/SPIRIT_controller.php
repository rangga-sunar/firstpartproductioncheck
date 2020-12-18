<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class SPIRIT_controller extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();

        $this->load->helper(array('form', 'url'));
        $this->load->library(array('session', 'form_validation', 'upload', 'PHPMailer', 'pdf'));
        $this->load->model('SPIRIT_model');
    }

    public function index()
    {
        if ($this->session->userdata('nik') != '') {

            //$data['akses'] = $this->User_model->getAccess();

            $this->load->view('templates/header');
            $this->load->view('templates/navbar');
            $this->load->view('user/view_SPIRIT');
            $this->load->view('templates/footer');
        } else {
            redirect('auth');
        }
    }

    public function ajax_view()
    {
        $list = $this->SPIRIT_model->get_datatables();
        $data = array();
        $no = $_POST['start'];
        $program = substr($this->uri->segment(1), 0, 6);
        foreach ($list as $fppc) {
            $no++;
            $row = array();
            if ($fppc->file_name == '') {
                $button = '<a href="javascript:void(0)" class="btn btn-xs btn-success tooltips" data-placement="top" onclick="edit_file(' . "'" . $fppc->id . "'" . ')"><i class="fa fa-upload"></i></a>         
                           <a href="javascript:void(0)" class="btn btn-xs btn-teal tooltips" onclick="edit_data(' . "'" . $fppc->id . "'" . ')"> <i class="fa fa-edit"></i></a>
                           <a href="javascript:void(0)" class="btn btn-xs btn-bricky tooltips hapus" onclick="delete_data(' . "'" . $fppc->id . "'" . ')"><i class="fa fa-times fa fa-white"></i></a>';
            } else {
                $button = '<a href="javascript:void(0)" class="btn btn-xs btn-teal tooltips" onclick="edit_data(' . "'" . $fppc->id . "'" . ')"> <i class="fa fa-edit"></i></a> 
                           <a href="javascript:void(0)" class="btn btn-xs btn-bricky tooltips hapus" onclick="delete_data(' . "'" . $fppc->id . "'" . ')"><i class="fa fa-times fa fa-white"></i></a>';
            }


            $row[] = $button;
            // $row[] = '<a class="btn btn-sm btn-primary" href="javascript:void(0)" title="Edit" onclick="edit_person(' . "'" . $fppc->id . "'" . ')"><i class="glyphicon glyphicon-pencil"></i> Edit</a>
            // 	  <a class="btn btn-sm btn-danger" href="javascript:void(0)" title="Hapus" onclick="delete_person(' . "'" . $fppc->id . "'" . ')"><i class="glyphicon glyphicon-trash"></i> Delete</a>';
            $row[] = $no;
            if ($fppc->file_name == '') {

                $row[] = $fppc->partnumber;
            } else {
                $row[] = '<a href="' . base_url("uploads/" . $program . "/") . "$fppc->file_name" . '"target="_blank" title="click for detail">'  .  $fppc->partnumber . '</a>';
            }
            $row[] = $fppc->pef;
            $row[] = $fppc->program;
            $row[] = $fppc->type;
            $row[] = $fppc->createdby;
            $row[] = $fppc->datecreate;
            $row[] = $fppc->drawing_idx;
            $row[] = $fppc->revision;
            $row[] = $fppc->remark;
            //add html for action
            $data[] = $row;
        }

        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->SPIRIT_model->count_all(),
            "recordsFiltered" => $this->SPIRIT_model->count_filtered(),
            "data" => $data,
        );
        //output to json format
        echo json_encode($output);
    }

    public function ajax_edit($id)
    {
        $data = $this->SPIRIT_model->get_by_id($id);
        echo json_encode($data);
    }

    public function ajax_add()
    {
        $data = array(
            'id' => '',
            'partnumber' => $this->input->post('partnumber'),
            'pef' => $this->input->post('pef'),
            'program' => $this->input->post('program'),
            'type' => $this->input->post('type'),
            'createdby' => $this->input->post('createdby'),
            'datecreate' => $this->input->post('datecreated'),
            'drawing_idx' => $this->input->post('drawidx'),
            'revision' => $this->input->post('rev'),
            'remark' => $this->input->post('remark'),
        );
        if ($this->input->post('partnumber') === '') {
            echo json_encode(array("status" => FALSE));
        } else {
            $insert = $this->SPIRIT_model->save($data);
            echo json_encode(array("status" => TRUE));
        }
    }

    public function ajax_update()
    {
        $data = array(
            'id' => '',
            'partnumber' => $this->input->post('partnumber'),
            'pef' => $this->input->post('pef'),
            'program' => $this->input->post('program'),
            'type' => $this->input->post('type'),
            'createdby' => $this->input->post('createdby'),
            'datecreate' => $this->input->post('datecreated'),
            'drawing_idx' => $this->input->post('drawidx'),
            'revision' => $this->input->post('rev'),
            'remark' => $this->input->post('remark'),
        );
        $this->SPIRIT_model->update(array('id' => $this->input->post('id')), $data);
        echo json_encode(array("status" => TRUE));
    }

    public function ajax_delete($id)
    {
        $this->SPIRIT_model->delete_by_id($id);
        echo json_encode(array("status" => TRUE));
        $this->session->set_flashdata('flash', 'Deleted');
    }

    public function do_upload()
    {
        $config['upload_path'] = "./uploads/";
        $config['allowed_types'] = 'pdf|jpg|png';

        $id = $this->input->post('id');
        $file =  $this->input->post('filename');

        if ($this->upload->do_upload('filename')) {
            $uploaded = $this->upload->data();
            $data = [
                'file_name' => $uploaded[$file]
            ];

            $where = array('id' => $id);
            $result = $this->SPIRIT_model->upload_file($data, $where);

            echo json_encode(array("status" => TRUE));
        }
    }

    public function upload_file()
    {
        $id = $this->input->post('id');
        $program = $this->input->post('program');

        $config['upload_path'] = './uploads/' . $program . '/';
        $config['allowed_types'] = 'pdf|jpg';
        $config['max_size'] = '1000000';

        $this->upload->initialize($config);

        $id = $this->input->post('id');

        if ($this->upload->do_upload('filename')) {
            $uploaded = $this->upload->data();
            $data = [
                'file_name' => $uploaded['file_name']
            ];

            $where = array('id' => $id);
            $this->SPIRIT_model->upload_file($data, $where);

            redirect('SPIRIT_controller');
        } else {
            $error = array('error' => $this->upload->display_errors());
            $this->session->set_flashdata(
                'message',
                '<div class="alert alert-danger" role="alert">' . $this->upload->display_errors() . ' </div>'
            );
            redirect('SPIRIT_controller');
        }
    }
}
