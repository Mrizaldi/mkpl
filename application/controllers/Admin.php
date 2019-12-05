<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Admin extends CI_Controller
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
		is_admin($_SESSION['user']['role_id']);
	}

	public function index()
	{
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
	}
}
?>
