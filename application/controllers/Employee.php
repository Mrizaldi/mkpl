<?php
defined('BASEPATH') or exit('No direct script access allowed');

	class Employee extends CI_Controller
	{		
		public function __construct()
		{
			parent::__construct();
			$this->load->model('Employee_model');		
			$this->load->library('form_validation');		
			is_logged_in();			
		}

		public function index()
		{
			$data['title'] = 'Employee';
			$data['user'] = $this->db->get_where('user',['email' => $_SESSION['user']['email']])->row_array();
			$data['emp'] = $this->Employee_model->getAllEmployee();			
			$data['role'] = $this->db->get('user_role')->result_array();
			$this->load->view('templates/header', $data);
			$this->load->view('templates/sidebar', $data);
			$this->load->view('templates/topbar', $data);
			$this->load->view('employee/index', $data);
			$this->load->view('templates/footer');
		}

		public function details($id)
		{
			$data['title'] = 'Detail Data Employee';
			$data['user'] = $this->db->get_where('user',['email' => $_SESSION['user']['email']])->row_array();
			$data['emp'] = $this->db->get_where('user',['id' => $id])->row_array();
			$data['emptask'] = $this->db->get_where('task',['empId' => $id])->result_array();
			if ($data['emp']['role_id'] == 3) {
				$data['empproj'] = $this->db->get_where('project',['pm' => $id])->result_array();
				$data['client'] = $this->db->get('client')->result_array();
			}
			$data['board'] = $this->db->get('board')->result_array();
			$data['role'] = $this->db->get('user_role')->result_array();
			$this->load->view('templates/header', $data);
			$this->load->view('templates/sidebar', $data);
			$this->load->view('templates/topbar', $data);
			$this->load->view('employee/details', $data);
			$this->load->view('templates/footer');
		}

		public function tambah()
		{		
			is_permitted($_SESSION['user']['role_id']);
			$this->form_validation->set_rules('nama','Nama','required|trim');
			$this->form_validation->set_rules('telepon','Telepon','trim');
			$this->form_validation->set_rules('role','Role','required');
			$this->form_validation->set_rules('email','Email','required|trim|valid_email|is_unique[user.email]',[
				'is_unique' => 'This email has already registered'
			]);			
			if ($this->form_validation->run() == FALSE) {
				$data['title'] = 'Tambah Employee';
				$data['user'] = $this->db->get_where('user',['email' => $_SESSION['user']['email']])->row_array();
				$data['role'] = $this->db->get('user_role')->result_array();
				$this->load->view('templates/header', $data);
				$this->load->view('templates/sidebar', $data);
				$this->load->view('templates/topbar', $data);
				$this->load->view('employee/tambah', $data);
				$this->load->view('templates/footer');
			}else{
				$this->Employee_model->tambahDataEmployee();
				redirect('employee');
			}
		}

        public function update($id)
		{		
			is_permitted($_SESSION['user']['role_id']);
            $data['role'] = $this->db->get('user_role')->result_array();
		    $data['user'] = $this->Employee_model->getEmployeById($id);
			$this->form_validation->set_rules('nama','Nama','required|trim');
			$this->form_validation->set_rules('telepon','Telepon','trim');
			$this->form_validation->set_rules('email','Email','required');					
			if ($this->form_validation->run() == FALSE) {
				$data['title'] = 'Update Employee';
				$this->load->view('templates/header', $data);
				$this->load->view('templates/sidebar', $data);
				$this->load->view('templates/topbar', $data);
				$this->load->view('employee/update', $data);
				$this->load->view('templates/footer');
			}else{
				$this->Employee_model->updatedata();
				redirect('employee');
			}
		}  

		public function hapus($id)
		{
			is_permitted($this->session->userdata('role_id'));
			if ($this->Employee_model->hapusDataEmployee($id) > 0) {
				header('Location:' . base_url() . '/client');
				$this->session->set_flashdata('flash','Dihapus');
				redirect('employee');
			}
		}
	}
?>
