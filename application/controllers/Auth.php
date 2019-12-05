<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Auth extends CI_Controller
{	

	public function __construct()
	{
		parent::__construct();
		$this->load->model('Employee_model');		
	}

	public function index()
	{
		if (isset($_SESSION['user']['email'])) {
			if ($_SESSION['user']['role_id'] != 1) {
				redirect('user');
			}else{
				redirect('admin');
			}
		}
		$this->form_validation->set_rules('email','Email','required|trim|valid_email');
		$this->form_validation->set_rules('password','Password','required|trim');
		if ($this->form_validation->run() == FALSE) {
			$data['title'] = 'Login Page';
			$this->load->view('templates/auth_header',$data);
			$this->load->view('auth/login');
			$this->load->view('templates/auth_footer');
		}else{
			$this->_login();
		}
	}	

	private function _login()
	{
		if (isset($_SESSION['user']['email'])) {
			if ($_SESSION['user']['role_id'] != 1) {
				redirect('user');
			}else{
				redirect('admin');
			}
		}
		$email = $this->input->post('email');
		$password = $this->input->post('password');

		$user = $this->Employee_model->getEmp($email);
		//user exist?
		if ($user) {
			//user active?
			if ($user['is_active'] == 1) {
				//cek pwd
				if (password_verify($password, $user['password'])) {
					$data = [
						'email' => $user['email'],
						'role_id' => $user['role_id'],
						'emp_id' => $user['id']
					];
					// $this->session->set_userdata($data);
					// session_start();
					$_SESSION['user'] = $data;
					if ($user['role_id'] == 1) {
						redirect('admin');
					}else{
						redirect('user');
					}
				}else{
					//pwd false
					$this->session->set_flashdata('message','<div class="alert alert-danger" role="alert">Wrong password!</div>');
					redirect('auth');
				}
			}else{
				$this->session->set_flashdata('message','<div class="alert alert-danger" role="alert">Email is not activated!</div>');
				redirect('auth');	
			}
		}else{
			$this->session->set_flashdata('message','<div class="alert alert-danger" role="alert">Email is not registered!</div>');
			redirect('auth');
		}
	}

	public function verify()
	{
		$email = $this->input->get('email');
		$token = $this->input->get('token');

		$user = $this->db->get_where('user',['email' => $email])->row_array();

		if ($user) {
			$user_token = $this->db->get_where('user_token',['token' => $token])->row_array();
			if ($user_token) {
				$this->db->set('is_active', 1);
				$this->db->where('email', $email);
				$this->db->update('user');

				$this->db->delete('user_token',['email',$email]);
				$this->session->set_flashdata('message','<div class="alert alert-success" role="alert">'.$email.' Telah aktif. Silakan login!</div>');	
				redirect('auth');
			}else{
				$this->session->set_flashdata('message','<div class="alert alert-danger" role="alert">Aktivasi akun gagal !  Token tidak valid !</div>');	
				redirect('auth');	
			}
		}else{
			$this->session->set_flashdata('message','<div class="alert alert-danger" role="alert">Aktivasi akun gagal !  Email tidak terdaftar !</div>');	
			redirect('auth');
		}
	}

		// private function _sendEmail($token, $type)
		// {
		// 	// $config = [
		// 	// 	'protocol'  => 'smtp',
		// 	// 	'smtp_host' => 'ssl://smtp.googlemail.com',
		// 	// 	'smtp_user' => 'aliyyailmi20@gmail.com',
		// 	// 	'smpt_pass' => 'ilmi2007',
		// 	// 	'smtp_port' => 465,
		// 	// 	'mailtype' => 'html',
		// 	// 	'charset'   => 'utf-8',
		// 	// 	'newline'   => "\r\n"
		// 	// ];

		// 	$this->load->library('email');
		// 	$config = array();
	 //        $config['protocol'] = 'smtp';
	 //        $config['smtp_host'] = 'ssl://smtp.googlemail.com';
	 //        $config['smtp_user'] = 'aliyyailmi20@gmail.com';
	 //        $config['smtp_pass'] = 'ilmi2007';
	 //        $config['smtp_port'] = 465;
	 //        $config['mailtype'] = 'html';
	 //        $config['charset'] = 'utf-8';

	 //        $this->email->set_newline("\r\n");
	 //        $this->email->initialize($config);
		// 	//$this->email->initialize($config);  //tambahkan baris ini
		// 	$this->email->from('aliyyailmi20@gmail.com', 'Project Management Primavisi Globalindo');
		// 	$this->email->to($this->input->post('email'));

		// 	if ($type == 'forgot') {
		// 		$this->email->subject('Reset Password');
		// 		$this->email->message('Klik link berikut untuk reset password akun anda : <a href="' . base_url() . 'auth/resetpassword?email=' . $this->input->post('email') . '&token=' . urlencode($token) . '">Reset password</a>');
		// 	}
		// 	if ($this->email->send()){
		// 		return true;
		// 	}else{
		// 		echo $this->email->print_debugger();
		// 		die;
		// 	}
		// 	//$this->input->post('email',true)
		// }

	
	public function logout()
	{
		// $this->session->unset_userdata('email');
		// $this->session->unset_userdata('role_id');
		// remove all session variables
		session_unset(); 

		// destroy the session 
		session_destroy(); 
		$this->session->set_flashdata('message','<div class="alert alert-success" role="alert">You have been logout!</div>');
		redirect('auth');
	}

	public function blocked()
	{
		$data['title'] = 'Access Blocked ! ';
		if (isset($_SESSION['user'])) {
			$data['user'] = $this->db->get_where('user',['email' => $_SESSION['user']['email']])->row_array();
		}
		$this->load->view('templates/header', $data);
		$this->load->view('templates/sidebar', $data);
		$this->load->view('templates/topbar', $data);
		$this->load->view('auth/blocked', $data);
		$this->load->view('templates/footer');
	}

	public function forgotpassword($value='')
	{
		$this->form_validation->set_rules('email','Email','required|trim|valid_email');
		if ($this->form_validation->run() == FALSE) {
			$data['title'] = 'Forgot Password';
			$this->load->view('templates/auth_header',$data);
			$this->load->view('auth/forgotpassword');
			$this->load->view('templates/auth_footer');
		}else{
			$email = $this->input->post('email');
			$user = $this->db->get_where('user',['email' => $email , 'is_active' => 1])->row_array();

			if ($user) {
				$token = base64_encode(random_bytes(32));
				$user_token = [
					'email' => $email,
					'token' => $token,
					'date_created' => time()
				];
				$this->db->insert('user_token', $user_token);
				_sendEmail($token, 'forgot');
				$this->session->set_flashdata('message','<div class="alert alert-success mt-3" role="alert">Silakan cek email untuk reset password !</div>');	
				redirect('auth/forgotpassword');
			}else{
				$this->session->set_flashdata('message','<div class="alert alert-danger" role="alert">Email tidak terdaftar atau belum diaktifkan!</div>');
				redirect('auth/forgotpassword');
			}
		}
		
	}

	public function resetpassword()
	{
		$email = $this->input->get('email');
		$token = $this->input->get('token');

		$user = $this->db->get_where('user',['email' => $email])->row_array();

		if ($user) {
			$user_token = $this->db->get_where('user_token',['token' => $token])->row_array();
			if ($user_token) {
				// session_start();
				$_SESSION['user']['reset_email'] = $email;
				$this->resetPwd();
				// $this->db->set('is_active', 1);
				// $this->db->where('email', $email);
				// $this->db->update('user');

				// $this->db->delete('user_token',['email',$email]);
				// $this->session->set_flashdata('message','<div class="alert alert-success" role="alert">'.$email.' Telah aktif. Silakan login!</div>');	
				//redirect('auth');
			}else{
				$this->session->set_flashdata('message','<div class="alert alert-danger" role="alert">Reset password gagal !  Token tidak valid !</div>');	
				redirect('auth');	
			}
		}else{
			$this->session->set_flashdata('message','<div class="alert alert-danger" role="alert">Reset password gagal !  Email tidak terdaftar !</div>');	
			redirect('auth');
		}
	}

	public function resetPwd()
	{
		if (!isset($_SESSION['user']['reset_email'])) {
			redirect('auth');
		}
		$this->form_validation->set_rules('password1','New Password','required|trim|min_length[8]|matches[password2]');
		$this->form_validation->set_rules('password2','Repeat Password','required|trim|min_length[8]|matches[password1]');
		if ($this->form_validation->run() == FALSE) {
			$data['title'] = 'Forgot Password';
			$this->load->view('templates/auth_header',$data);
			$this->load->view('auth/resetpwd');
			$this->load->view('templates/auth_footer');
		}else{
			$password = password_hash($this->input->post('password1'), PASSWORD_DEFAULT);
			$email    = $_SESSION['user']['reset_email'];
			$this->db->set('password',$password);
			$this->db->where('email',$email);
			$this->db->update('user');
			$this->db->delete('user_token', ['email' => $_SESSION['user']['reset_email']]);
			session_unset('user');
			$this->session->set_flashdata('message','<div class="alert alert-success" role="alert">Reset password berhasil !  Silakan Login !</div>');	
			redirect('auth');
		}
	}
}
?>