<?php
defined('BASEPATH') or exit('No direct script access allowed');

	class User extends CI_Controller
	{
		public function __construct()
		{
			parent::__construct();
			$this->load->model('Project_model');		
			$this->load->model('Board_model');
			$this->load->model('Task_model');
			$this->load->model('Client_model');
			$this->load->model('Employee_model');
			$this->load->library('form_validation');
			is_logged_in();
		}
		
		public function index()
		{
			$this->load->model('Employee_model');
			$data['title'] = 'Dashboard';
			$data['user'] = $this->db->get_where('user',['email' => $_SESSION['user']['email']])->row_array();
			if ($_SESSION['user']['role_id'] == 3) {				
				$data['project2'] = $this->Project_model->getProjectByPm($data['user']['id']);
				$total_task = 0;
				$inprogressprj = 0;
				$doneprj = 0;
				foreach ($data['project2'] as $p) {
					$data['taskproject'] = $this->Task_model->getTaskByProject($p['id']);
					$jumlahtaskproject = count($data['taskproject']);
					$total_task += $jumlahtaskproject;
					if ($p['projProgress'] == 100) {
						$doneprj++;
					}else{
						$inprogressprj++;
					}
				}
				$data['doneprj'] = $doneprj;
				$data['inprogressprj'] = $inprogressprj;
				$data['total_task'] = $total_task;
				$data['total_project'] = $this->db->get_where('project',['pm' => $_SESSION['user']['emp_id']])->num_rows();
				$data['client']= $this->db->get('client');
				$data['num_project'] = $this->db->get('project')->num_rows();				
				$this->load->view('templates/header', $data);
				$this->load->view('templates/sidebar', $data);
				$this->load->view('templates/topbar', $data);
				$this->load->view('user/pmDashboard', $data);
				$this->load->view('templates/footer');
			}else if ($_SESSION['user']['role_id'] == 2) {
				$this->load->model('Employee_model');
				$data['total_asset2'] = $this->Employee_model->hitungJumlahAsset();
				$data['total_task'] = $this->Employee_model->hitungJumlahTask();

				$data['client']= $this->db->get('client');
				$data['project'] = $this->Project_model->getAllProject();
				$data['total_asset'] = $this->Client_model->hitungJumlahAsset();

				$data['num_project'] = $this->db->get('project')->num_rows();

				$data['title'] = 'Dashboard';
				$data['user'] = $this->db->get_where('user',['email' => $_SESSION['user']['email']])->row_array();
				$data['role'] = $this->db->get_where('user_role',['id' => $_SESSION['user']['role_id']])->row_array();
				$this->load->view('templates/header', $data);
				$this->load->view('templates/sidebar', $data);
				$this->load->view('templates/topbar', $data);
				$this->load->view('admin/index', $data);
				$this->load->view('templates/footer');
			}else{
				$data['total_task'] = $this->db->get_where('task',['empId' => $_SESSION['user']['emp_id']])->num_rows();
				$data['project'] = $this->Project_model->getProjectByEmp($_SESSION['user']['emp_id']);
				$data['num_project'] = count($data['project']);
				$data['projectpm'] = $this->db->get_where('user', ['role_id' => 3])->result_array();
				$data['todoTask'] = $this->Task_model->getToDoTask();
				$data['doneTask'] = $this->Task_model->getDoneTask();
				$data['inprogressTask'] = $this->Task_model->getInprogressTask();
				// print_r($data['todoTask']);
				// die;
				$this->load->view('templates/header', $data);
				$this->load->view('templates/sidebar', $data);
				$this->load->view('templates/topbar', $data);
				$this->load->view('user/userDashboard', $data);
				$this->load->view('templates/footer');
			}
		}

		public function profile()
		{
			$data['user'] = $this->db->get_where('user',['email' => $_SESSION['user']['email']])->row_array();
			$data['title'] = 'My Profile';
			$data['role'] = $this->db->get_where('user_role',['id' => $_SESSION['user']['role_id']])->row_array();
			$data['emptask'] = $this->db->get_where('task',['empId' => $data['user']['id']])->result_array();
			if ($_SESSION['user']['role_id'] == 3) {
				$data['empproj'] = $this->db->get_where('project',['pm' => $data['user']['id']])->result_array();
				$data['client'] = $this->db->get('client')->result_array();
			}
			$data['board'] = $this->db->get('board')->result_array();
			$this->load->view('templates/header', $data);
			$this->load->view('templates/sidebar', $data);
			$this->load->view('templates/topbar', $data);
			$this->load->view('user/index', $data);
			$this->load->view('templates/footer');
		}

		public function edit()
		{
			$data['user'] = $this->db->get_where('user',['email' => $_SESSION['user']['email']])->row_array();
			$data['title'] = 'Edit Profile';

			$this->form_validation->set_rules('name','Nama','required|trim');
			$this->form_validation->set_rules('telepon','Telepon','required|trim');

			if ($this->form_validation->run() == FALSE) {
				$this->load->view('templates/header', $data);
				$this->load->view('templates/sidebar', $data);
				$this->load->view('templates/topbar', $data);
				$this->load->view('user/edit', $data);
				$this->load->view('templates/footer');
			}else{
				$name = $this->input->post('name');
				$phone = $this->input->post('telepon');
				$email = $this->input->post('email');
				//cek upload gambar
				$upload_image = $_FILES['image'];
				if ($upload_image) {
					$config['upload_path'] = './assets/img/profile/';
					$config['allowed_types'] = 'gif|jpg|png';
					$config['max_size']     = '2048';
					$this->load->library('upload', $config);
						if ($this->upload->do_upload('image')){
		                    $oldImage = $data['user']['image'];
		                    if ($oldImage != 'default.jpg') {
		                    	unlink(FCPATH . 'assets/img/profile/' . $oldImage);
		                    }
		                    $newImage = $this->upload->data('file_name');
		                    $this->db->set('image',$newImage);
		                }
		                else{
		                    echo $this->upload->display_errors();
		                }
				}
				//end cek gambar
				$this->db->set('name',$name);
				$this->db->set('phone',$phone);
				$this->db->where('email',$email);
				$this->db->update('user');
				$this->session->set_flashdata('message','<div class="alert alert-success" role="alert">Profile updated!</div>');
				redirect('user/profile');
			}
		}

		public function changepwd($value='')
		{
			$data['user'] = $this->db->get_where('user',['email' => $_SESSION['user']['email']])->row_array();
			$data['title'] = 'Change Password';

			$this->form_validation->set_rules('currentpassword','Current Password', 'required|trim');
			$this->form_validation->set_rules('newpwd1','New Password', 'required|trim|min_length[6]|matches[newpwd2]');
			$this->form_validation->set_rules('newpwd2','Repeat Password', 'required|trim|min_length[6]|matches[newpwd1]');

			if ($this->form_validation->run() == FALSE) {
				$this->load->view('templates/header', $data);
				$this->load->view('templates/sidebar', $data);
				$this->load->view('templates/topbar', $data);
				$this->load->view('user/changePwd', $data);
				$this->load->view('templates/footer');
			}else{
				$current_password = $this->input->post('currentpassword');
				$new_password = $this->input->post('newpwd1');
				if (!password_verify($current_password, $data['user']['password'])) {
					$this->session->set_flashdata('message','<div class="alert alert-danger" role="alert">Wrong Current Password!</div>');
					redirect('user/changepwd');
				}else{
					if ($current_password == $new_password) {
						$this->session->set_flashdata('message','<div class="alert alert-danger" role="alert">Password baru sama dengan password lama!</div>');
					redirect('user/changepwd');
					}else{
						$password_hash = password_hash($new_password, PASSWORD_DEFAULT);
						$this->db->set('password',$password_hash);
						$this->db->where('email',$_SESSION['user']['email']);
						$this->db->update('user');
						$this->session->set_flashdata('message','<div class="alert alert-success" role="alert">Password changed!</div>');
						redirect('user/profile');
					}
				}
			}
		}
	}
?>
