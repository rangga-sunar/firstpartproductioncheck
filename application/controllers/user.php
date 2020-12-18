<?php
defined('BASEPATH') or exit('No direct script access allowed');

require 'vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class User extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();

        $this->load->helper(array('form', 'url'));
        $this->load->library(array('session', 'form_validation', 'upload', 'PHPMailer', 'pdf'));
        $this->load->model('User_model');
    }

    public function index()
    {
        if ($this->session->userdata('nik') != '') {

            $data['akses'] = $this->User_model->getAccess();

            $this->load->view('templates/header');
            $this->load->view('templates/navbar', $data);
            $this->load->view('user/index');
            $this->load->view('templates/footer');
        } else {
            redirect('auth');
        }
    }

    //=========================== START FPPC ===========================================


    function product_data()
    {
        $project = $this->uri->segment(3);

        $data = $this->User_model->fppc($project);
        echo json_encode($data);
    }

    function data_list($project)
    {
        $data['akses'] = $this->User_model->getAccess();

        $this->load->view('templates/header');
        $this->load->view('templates/navbar', $data);
        $this->load->view('user/view_ajax');
        $this->load->view('templates/footer');
    }

    public function view()
    {
        $project = $this->uri->segment(3);

        if ($this->session->userdata('nik') != '') {
            $data['data'] = $this->User_model->fppc($project);
            $data['akses'] = $this->User_model->getAccess();
            $this->load->view('templates/header');
            $this->load->view('templates/navbar', $data);
            $this->load->view('user/view', $data);
            $this->load->view('templates/footer');
        } else {
            $this->session->set_flashdata(
                'message',
                '<div class="alert alert-danger" role="alert"> Your session expired !</div>'
            );
            redirect('auth');
        }
    }

    public function form()
    {
        $data['akses'] = $this->User_model->getAccess();
        $this->load->view('templates/header');
        $this->load->view('templates/navbar', $data);
        $this->load->view('user/form', $data);
        $this->load->view('templates/footer');
    }

    public function Remove()
    {
        $id = $_POST["id"];
        $this->User_model->delete($id);
        $this->session->set_flashdata('flash', 'Deleted');
        //redirect('user/viewDraw');
    }

    public function edit($id)
    {
        $data['row'] = $this->User_model->getDrawByid($id);
        $data['list'] = $this->db->get('tab_reference')->result_array();
        $data['change'] = $this->db->get('tab_changenum')->result_array();
        $data['akses'] = $this->User_model->getAccess();
        $this->load->view('templates/header');
        $this->load->view('templates/navbar', $data);
        $this->load->view('user/form_edit_drawing', $data);
        $this->load->view('templates/footer');
    }

    public function save()
    {
        $program = $this->input->post('program');
        //check validation form
        $this->form_validation->set_rules('partnumber', 'Partnumber', 'required|trim');
        $this->form_validation->set_rules('pef', 'Pef', 'required|trim');
        $this->form_validation->set_rules('datecreated', 'Date Created', 'trim|required');

        // $this->form_validation->set_rules('eff', 'Effectivity', 'trim|required');
        // $this->form_validation->set_rules('eff_to', 'Effectivity', 'trim|required');
        // $this->form_validation->set_rules('received', 'Received', 'trim|required');
        // $this->form_validation->set_rules('release', 'Release', 'trim|required');
        // $this->form_validation->set_rules('change', 'Change Number', 'trim|required');
        // $this->form_validation->set_rules('sheet', 'Sheet', 'trim|required');

        //upload file 
        // $config['upload_path'] = './uploads/';
        // $config['allowed_types'] = 'xlsx|docx|doc|pdf';
        // $config['max_size'] = '1000000';

        // $this->upload->initialize($config);

        if ($this->form_validation->run() == false) {
            $this->form();
        } else {

            //if ($this->upload->do_upload('filename')) {
            //$uploaded = $this->upload->data();
            $data = [
                'id' => '',
                'partnumber' => htmlspecialchars($this->input->post('partnumber', true)),
                'pef' => htmlspecialchars($this->input->post('pef', true)),
                'program' => htmlspecialchars($this->input->post('program', true)),
                'type' => htmlspecialchars($this->input->post('type', true)),
                'createdby' => htmlspecialchars($this->input->post('createdby', true)),
                'datecreate' => htmlspecialchars($this->input->post('datecreated', true)),
                'drawing_idx' => htmlspecialchars($this->input->post('drawidx', true)),
                'revision' => htmlspecialchars($this->input->post('rev', true)),
                'remark' => htmlspecialchars($this->input->post('remark', true)),

                //'file_name' => $uploaded['file_name']
            ];

            $this->User_model->save($data);

            $this->session->set_flashdata('flash', 'Has been added');

            redirect('user/view/' . $program);
            // } else {
            //     $error = array('error' => $this->upload->display_errors());
            //     $this->session->set_flashdata(
            //         'message',
            //         '<div class="alert alert-danger" role="alert">' . $this->upload->display_errors() . ' </div>'
            //     );
            //     redirect('user/formtech');
            // }
        }
    }

    public function upload()
    {
        $id = $this->input->post('id');
        $program = $this->input->post('program');

        $config['upload_path'] = './uploads/' . $program . '/';
        $config['allowed_types'] = 'pdf';
        $config['max_size'] = '1000000';

        $this->upload->initialize($config);

        $id = $this->input->post('id');

        if ($this->upload->do_upload('filename')) {
            $uploaded = $this->upload->data();
            $data = [
                'file_name' => $uploaded['file_name']
            ];

            $where = array('id' => $id);
            $this->User_model->updatedrawing($data, $where);

            redirect('user/view/' . $program);
        } else {
            $error = array('error' => $this->upload->display_errors());
            $this->session->set_flashdata(
                'message',
                '<div class="alert alert-danger" role="alert">' . $this->upload->display_errors() . ' </div>'
            );
            redirect('user/view/' . $program);
        }
    }

    public function update($id)
    {

        $data['row'] = $this->User_model->getTechByid($id);

        $this->form_validation->set_rules('title', 'Title', 'trim|required');
        $this->form_validation->set_rules('issue', 'Issue', 'trim|required');

        //upload file 
        $config['upload_path'] = './uploads/';
        $config['allowed_types'] = 'xlsx|docx|doc|pdf';
        $config['max_size'] = '15000';

        $this->upload->initialize($config);
        $unique = $this->input->post('id');

        if ($this->form_validation->run() == false) {
            $data['akses'] = $this->User_model->getAccess();
            $this->load->view('templates/header');
            $this->load->view('templates/navbar', $data);
            $this->load->view('user/form_edit_ts', $data);
            $this->load->view('templates/footer');
        } else {
            if ($_FILES['filename']['name']) {
                if ($this->upload->do_upload('filename')) {
                    $uploaded = $this->upload->data();
                    $data = [
                        'program' => 'MKII',
                        'ts_num' => htmlspecialchars($this->input->post('ts_no', true)),
                        'title' => htmlspecialchars($this->input->post('title', true)),
                        'effectivity' => htmlspecialchars($this->input->post('effectivity', true)),
                        'issue' => htmlspecialchars($this->input->post('issue', true)),
                        'createdby' => $this->session->userdata('nik'),
                        'datecreated' => $this->input->post('datecreated'),
                        'file_name' => $uploaded['file_name']
                    ];

                    $where = array('id' => $unique);
                    $this->User_model->updateTS($data, $where);

                    $this->session->set_flashdata('flash', 'Has been added');

                    redirect('user/viewtech');
                } else {
                    $error = array('error' => $this->upload->display_errors());
                    $this->session->set_flashdata(
                        'message',
                        '<div class="alert alert-danger" role="alert">' . $this->upload->display_errors() . ' </div>'
                    );
                    redirect('user/viewtech');
                }
            } else {
                $data = [
                    'program' => 'MKII',
                    'title' => htmlspecialchars($this->input->post('title', true)),
                    'issue' => htmlspecialchars($this->input->post('issue', true)),
                    'effectivity' => htmlspecialchars($this->input->post('effectivity', true)),
                    'createdby' => $this->session->userdata('nik'),
                ];

                $where = array('id' => $id);
                $this->User_model->updateTS($data, $where);

                $this->session->set_flashdata('flash', 'Has been added');
                redirect('user/viewtech');
            }
        }
    }

    //=====================================END DRAWING================================


    public function sendEmail($partnumber)
    {
        $this->db->select('name, email');
        $this->db->from('tab_user');
        $this->db->where('uo', 'QP');
        $rawdata = $this->db->get()->result_array();

        foreach ($rawdata as $row) {
            $mail = new PHPMailer;
            $mail->IsSMTP();
            $mail->SMTPSecure = 'ssl';
            $mail->Host = "mail.indonesian-aerospace.com";
            $mail->SMTPDebug = 1;
            $mail->Port = 465;
            $mail->SMTPAuth = true;
            $mail->Username = "rangga@indonesian-aerospace.com";
            $mail->Password = "daemon";
            $mail->SetFrom("TS@MKII.com", "TS SYSTEM");
            $mail->Subject = "[TECHNICAL SHEET] Notification [NO REPLY]";
            $mail->AddAddress($row['email'], $row['email']);
            $mail->MsgHTML("Yth.<br>
                            Bapak / Ibu " . $row['name'] . "<br><br>
                              
                            Technical sheet untuk partnumber : <strong>$partnumber</strong> sudah ditambahkan ke portal 10.1.45.15/technicalsheet

                            <br><br>
                            
                            Salam <br>" . $this->session->userdata('name'));
            if ($mail->Send()) {
                echo "berhasil sending email";
            } else {
                echo "Failed to sending message";
            }
        }
    }

    public function sendEmailApprove($nik, $partnumber)
    {
        $niks = array($nik, '120019');
        $this->db->select('name, email');
        $this->db->from('tab_user');
        //$this->db->where('nik', $nik);
        $this->db->where_in('nik', $niks);
        //$this->db->where('UO', 'MP');
        $rawdata = $this->db->get()->result_array();

        foreach ($rawdata as $row) {
            $mail = new PHPMailer;
            $mail->IsSMTP();
            $mail->SMTPSecure = 'ssl';
            $mail->Host = "mail.indonesian-aerospace.com";
            $mail->SMTPDebug = 1;
            $mail->Port = 465;
            $mail->SMTPAuth = true;
            $mail->Username = "rangga@indonesian-aerospace.com";
            $mail->Password = "daemon";
            $mail->SetFrom("TS@MKII.com", "TS SYSTEM");
            $mail->Subject = "[TECHNICAL SHEET] Notification [NO REPLY]";
            $mail->AddAddress($row['email'], $row['email']);
            if ($this->session->userdata('uo') == 'QP') {
                $mail->MsgHTML("Yth.<br>
                            Bapak / Ibu " . $row['name'] . "<br><br>
                            
                            Technical sheet dengan partnumber : <strong>$partnumber</strong> sudah diapprove dan diupload ke portal 10.1.45.15/technicalsheet

                            <br><br>
                            
                            Salam <br>" . $this->session->userdata('name'));
            }

            if ($mail->Send()) {
                echo "berhasil sending email";
            } else {
                echo "Failed to sending message";
            }
        }
    }

    public function sendEmailByPDN($nik, $partnumber)
    {
        $niks = array($nik, '120019');
        $this->db->select('name, email');
        $this->db->from('tab_user');
        //$this->db->where('nik', $nik);
        $this->db->where_in('nik', $niks);
        //$this->db->where('UO', 'MP');
        $rawdata = $this->db->get()->result_array();

        foreach ($rawdata as $row) {
            $mail = new PHPMailer;
            $mail->IsSMTP();
            $mail->SMTPSecure = 'ssl';
            $mail->Host = "mail.indonesian-aerospace.com";
            $mail->SMTPDebug = 1;
            $mail->Port = 465;
            $mail->SMTPAuth = true;
            $mail->Username = "rangga@indonesian-aerospace.com";
            $mail->Password = "daemon";
            $mail->SetFrom("TS@MKII.com", "TS SYSTEM");
            $mail->Subject = "[TECHNICAL SHEET] Notification [NO REPLY]";
            $mail->AddAddress($row['email'], $row['email']);
            if ($this->session->userdata('uo') == 'QP') {
                $mail->MsgHTML("Yth.<br>
                            Bapak / Ibu " . $row['name'] . "<br><br>
                            
                            Mohon revisi Technical sheet <strong>$partnumber</strong> Sesuai PDN yang sudah diupload ke portal 10.1.45.15/technicalsheet

                            <br><br>
                            
                            Salam <br>" . $this->session->userdata('name'));
            } else {
                $mail->MsgHTML("Yth.<br>
                            Bapak / Ibu " . $row['name'] . "<br><br>
                            
                            PDN untuk partnumber <strong>$partnumber</strong> sudah direvisi dan diupload ke portal 10.1.45.15/technicalsheet

                            <br><br>
                            
                            Salam <br>" . $this->session->userdata('name'));
            }
            if ($mail->Send()) {
                echo "berhasil sending email";
            } else {
                echo "Failed to sending message";
            }
        }
    }

    public function viewPDF($id)
    {
        $data['pdf'] = $this->User_model->getTechByid($id);
        $data['title'] = 'TECHNICAL SHEET VIEWER';

        $this->load->view('user/view_pdf.php', $data);
    }

    public function reprint()
    {
        $id = $this->input->post('id');

        $config['upload_path'] = './nota/';
        $config['allowed_types'] = 'docx|doc|pdf';
        $config['max_size'] = '15000';

        $this->upload->initialize($config);

        $id = $this->input->post('id');

        if ($this->upload->do_upload('filename')) {
            $uploaded = $this->upload->data();
            $data = [
                'nota' => $uploaded['file_name'],
                'print' => '0'
            ];

            $where = array('id' => $id);
            $this->User_model->updateTS($data, $where);

            redirect('user/viewtech');
        } else {
            $error = array('error' => $this->upload->display_errors());
            $this->session->set_flashdata(
                'message',
                '<div class="alert alert-danger" role="alert">' . $this->upload->display_errors() . ' </div>'
            );
            redirect('user/viewtech');
        }
    }

    public function excel()
    {
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();
        $sheet->setCellValue('A1', 'No');
        $sheet->setCellValue('B1', 'PartNumber');
        $sheet->setCellValue('C1', 'Title');
        $sheet->setCellValue('D1', 'Effectivity');
        $sheet->setCellValue('E1', 'Issue');
        $sheet->setCellValue('F1', 'Created By');
        $sheet->setCellValue('G1', 'Date Created');
        $sheet->setCellValue('H1', 'Approve MP');
        $sheet->setCellValue('I1', 'Date Approve MP');
        $sheet->setCellValue('J1', 'Approve QP');
        $sheet->setCellValue('K1', 'Date Approve QP');
        $sheet->setCellValue('L1', 'Remark');

        $techsheet = $this->User_model->getTechSheet();
        $no = 1;
        $x = 2;
        foreach ($techsheet as $row) {
            if ($row->approvebymp <> "" or $row->approvebyqp <> "") {
                $status = 'Approve';
            }
            $sheet->setCellValue('A' . $x, $no++);
            $sheet->setCellValue('B' . $x, $row->ts_num);
            $sheet->setCellValue('C' . $x, $row->title);
            $sheet->setCellValue('D' . $x, $row->effectivity);
            $sheet->setCellValue('E' . $x, $row->issue);
            $sheet->setCellValue('F' . $x, $row->createdby);
            $sheet->setCellValue('G' . $x, $row->datecreated);
            $sheet->setCellValue('H' . $x, $row->approvebymp);
            $sheet->setCellValue('I' . $x, $row->dateapprovemp);
            $sheet->setCellValue('J' . $x, $row->approvebyqp);
            $sheet->setCellValue('K' . $x, $row->dateapproveqp);
            $sheet->setCellValue('L' . $x, $row->remark);
            $x++;
        }
        $writer = new Xlsx($spreadsheet);
        $filename = 'Status Technicalsheet';

        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename="' . $filename . '.xlsx"');
        header('Cache-Control: max-age=0');

        $writer->save('php://output');
    }

    public function waterMark($id)
    {
        $query = $this->db->get_where('tab_techsheet', array('id' => $id))->row_array();

        echo  $query['file_name'];
        $pdfFile = "./uploads/" . $query['file_name'];
        $watermarkText = 'VERIFY THAT THIS IS THE CORRECT REVISION BEFORE USE COPY & PRINTED FOR INFORMATION ONLY';
        $pdf = new WatermarkPDF($pdfFile, $watermarkText);
        $pdf->SetFont('Arial', '', 3);
        $pdf->AddPage();

        if ($pdf->numPages > 1) {
            for ($i = 2; $i <= $pdf->numPages; $i++) {
                //$pdf->endPage();
                $pdf->_tplIdx = $pdf->importPage($i);
                $pdf->AddPage();
            }
        }
        $filename = $query['file_name'];
        $without_extension = pathinfo($filename, PATHINFO_FILENAME) . "_release.pdf";

        //$pdf->Output(); //If you Leave blank then it should take default "I" i.e. Browser
        //$pdf->Output("sampleUpdated.pdf", 'D'); //Download the file. open dialogue window in browser to save, not open with PDF browser viewer
        $pdf->Output("c:/xampp/htdocs/technicalsheet/tech_rel/" . $filename, 'F'); //save to a local file with the name given by filename (may include a path)
        // $pdf->Output("sampleUpdated.pdf", 'I'); //I for "inline" to send the PDF to the browser
        // $pdf->Output("", 'S'); //return the document as a string. filename is ignored.

    }

    public function check_akses()
    {
        $this->db->select('access');
        $this->db->from('tab_user');
        $this->db->where_in('id', 12);
        //$this->db->where('UO', 'MP');
        $rawdata = $this->db->get()->result_array();

        foreach ($rawdata as $row) {
            $hasil =  $row['access'];
            $result = explode(",", $hasil);
            $x = count($result);

            for ($i = 0; $i < $x; $i++) {
                echo $result[$i] . "<br>";
            }
        }
    }

    public function test()
    {
        $buffer = array("CN235", "N219", "KFX");
        $hasil = '';
        for ($i = 0; $i < count($buffer); $i++) {
            $hasil .= $buffer[$i] . ",";
        }
        echo $hasil;
    }
}
