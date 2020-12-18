<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Auth extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();

		$this->load->helper(array('form', 'url'));
		$this->load->model('Auth_model');
		$this->load->library(array('session', 'form_validation', 'upload', 'PHPMailer'));
	}

	public function index()
	{
		if (!$this->session->userdata('email')) {

			$this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');
			$this->form_validation->set_rules('password', 'Password', 'required|trim');

			if ($this->form_validation->run() == false) {
				$this->load->view('auth/login');
			} else {
				$this->_login();
			}
		} else {
			redirect('user/index');
		}
	}

	public function registration()
	{
		//check validation form
		$this->form_validation->set_rules('fullname', 'Fullname', 'trim|required');
		$this->form_validation->set_rules('nik', 'Nik', 'trim|required');
		$this->form_validation->set_rules('uo', 'Unit Organisasi', 'trim|required');
		$this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email|is_unique[tab_user.email]');
		$this->form_validation->set_rules('password', 'Password', 'required|trim|min_length[6]|matches[retype_password]', [
			'matches' => 'Password not match',
			'min_length' => 'Password too short'
		]);
		$this->form_validation->set_rules('retype_password', 'Password', 'required|trim|matches[password]');

		if ($this->form_validation->run() == false) {
			$this->load->view("auth/registration");
		} else {

			$data = [
				'id' => '',
				'name' => htmlspecialchars($this->input->post('fullname', true)),
				'nik' => htmlspecialchars($this->input->post('nik', true)),
				'uo' => htmlspecialchars($this->input->post('uo', true)),
				'email' => htmlspecialchars($this->input->post('email', true)),
				'password' => password_hash($this->input->post('password'), PASSWORD_DEFAULT),
				'password_decrypted' => $this->input->post('password'),
				'role_id' => 0,
				'is_active' => 0,
				'date_created' => time()
			];

			$this->db->insert('tab_user', $data);
			$this->session->set_flashdata(
				'message',
				'<div class="alert alert-success" role="alert"> Congratulation, your account has been created </div>'
			);
			redirect('auth/index');
		}
	}

	private function _login()
	{
		$email = $this->input->post('email');
		$password = $this->input->post('password');

		$user = $this->db->get_where('tab_user', ['email' => $email])->row_array();

		if ($user) {
			if ($user['is_active'] == 1) {
				if (password_verify($password, $user['password'])) {
					$data = [
						'email' => $user['email'],
						'role_id' => $user['role_id'],
						'name' => $user['name'],
						'nik' => $user['nik'],
						'uo' => $user['uo']
					];
					$this->session->set_userdata($data);
					redirect('auth/index');
				} else {
					$this->session->set_flashdata(
						'message',
						'<div class="alert alert-danger" role="alert"> Wrong password </div>'
					);
					redirect('auth/index');
				}
			} else {
				$this->session->set_flashdata(
					'message',
					'<div class="alert alert-danger" role="alert"> This email is not active </div>'
				);
				redirect('auth/index');
			}
		} else {
			$this->session->set_flashdata(
				'message',
				'<div class="alert alert-danger" role="alert"> Email is not registered !</div>'
			);
			redirect('auth/index');
		}
	}

	public function logout()
	{
		$this->session->sess_destroy();
		$this->session->unset_userdata('email');
		$this->session->unset_userdata('name');
		$this->session->unset_userdata('role_id');
		redirect('auth/index');
	}

	public function forgot()
	{
		$this->load->view('auth/forgot');
	}

	public function email_forgot()
	{
		$email = $this->input->post('email');

		$exist = $this->db->get_where('tab_user', ['email' => $email])->num_rows();
		$query = $this->db->get_where('tab_user', ['email' => $email])->row();

		if ($exist != 0) {
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
			$mail->Subject = "[TECHNICAL SHEET] Reset Password [NO REPLY]";
			$mail->AddAddress($email, $email);
			$mail->MsgHTML("<h1>Reset password</h1>
                              
                            click link or copy paste to url your browser and go for reset your password<br><br>
                            http://10.1.45.15/fppc/auth/resetpassword/" . $query->id . "
							
                            <br><br>
                            
                            Salam <br>
                            Admin
                            ");

			if ($mail->Send()) {
				$this->session->set_flashdata(
					'message',
					'<div class="alert alert-success" role="alert"> Email has been sent</div>'
				);
				redirect('auth/forgot');
			} else {
				$this->session->set_flashdata(
					'message',
					'<div class="alert alert-danger" role="alert">Failed to send email</div>'
				);
				redirect('auth/forgot');
			}
		} else {
			$this->session->set_flashdata(
				'message',
				'<div class="alert alert-danger" role="alert">Email is not registered</div>'
			);
			redirect('auth/forgot');
		}
	}

	public function resetpassword()
	{
		$data['id'] = $this->uri->segment(3);
		$this->load->view('auth/forgot_form', $data);
	}

	public function updatepassword()
	{
		$id = $this->input->post('id');
		$this->form_validation->set_rules('password', 'Password', 'required|trim|min_length[6]|matches[retype_password]', [
			'matches' => 'Password not match',
			'min_length' => 'Password too short'
		]);
		$this->form_validation->set_rules('retype_password', 'Password', 'required|trim|matches[password]');

		$exist = $this->db->get_where('tab_user', ['password_decrypted' => $this->input->post('passold')])->num_rows();

		if ($this->form_validation->run() == false) {
			$this->load->view("auth/forgot_form");
		} else {
			$this->db->set('password', password_hash($this->input->post('password'), PASSWORD_DEFAULT));
			$this->db->set('password_decrypted', $this->input->post('password'));
			$this->db->where('id', $id);
			$this->db->update('tab_user');

			$this->session->set_flashdata(
				'message',
				'<div class="alert alert-success" role="alert"> Your password successfully reset, login with your new password !</div>'
			);
			redirect('auth/index');
		}
	}
}
