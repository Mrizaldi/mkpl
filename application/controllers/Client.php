<?php
defined('BASEPATH') or exit('No direct script access allowed');

	class Client extends CI_Controller
	{

		public function __construct()
		{
			parent::__construct();
			$this->load->model('Client_model');		
			$this->load->model('Pic_model');		
			$this->load->library('form_validation');		
			is_logged_in();			
		}		

		public function index()
		{
			$data['title'] = 'Client';
			$data['pic'] = $this->db->get('pic')->result_array();			
			$data['client'] = $this->db->get('client')->result_array();
			$data['user'] = $this->db->get_where('user',['email' => $_SESSION['user']['email']])->row_array();
			$this->load->view('templates/header', $data);
			$this->load->view('templates/sidebar', $data);
			$this->load->view('templates/topbar', $data);
			$this->load->view('client/index', $data);
			$this->load->view('templates/footer');
		}

		public function tambah()
		{
			is_permitted($_SESSION['user']['role_id']);
			// if ($this->Mahasiswa_model->tambahDataMahasiswa($_POST) > 0) {
			// 	header('Location:' . base_url() . '/mahasiswa');
			// 	exit;
			// }
			$data['title'] = 'Form Tambah Data Client';
			$this->form_validation->set_rules('clientName', 'Name', 'required');
			$this->form_validation->set_rules('clientPhone', 'Phone', 'required');
			$this->form_validation->set_rules('clientAddress', 'Address', 'required');
			$this->form_validation->set_rules('clientCompany', 'Company', 'required');
			if ($this->form_validation->run() == FALSE) {
				# code...
			    $data['user'] = $this->db->get_where('user',['email' => $_SESSION['user']['email']])->row_array();
			    $this->load->view('templates/header', $data);
			    $this->load->view('templates/sidebar', $data);
			    $this->load->view('templates/topbar', $data);
				$this->load->view('client/tambahForm');
				$this->load->view('templates/footer');
			}else{
				$this->Client_model->tambahDataClient();
				$this->session->set_flashdata('message','<div class="alert alert-success mt-3" role="alert">Client baru telah ditambahkan! Silakan tambahkan PIC pada detail client.</div>');	
				redirect('client');
			}
		}

		public function hapus($id)
		{
			is_permitted($_SESSION['user']['role_id']);
			if ($this->Client_model->hapusDataClient($id) > 0) {
				$this->Pic_model->hapusDataPicByClient($id);
				header('Location:' . base_url() . '/client');
				$this->session->set_flashdata('message','<div class="alert alert-danger mt-3" role="alert">Client telah dihapus ! </div>');	
				redirect('client');
			}
		}

		public function update($id)
		{
			is_permitted($_SESSION['user']['role_id']);
			$data['title'] = 'Update Data Client';
			$data['client'] = $this->Client_model->getClientById($id);

			$this->form_validation->set_rules('clientName', 'clientName', 'required');
			$this->form_validation->set_rules('clientPhone', 'clientPhone', 'required');
			$this->form_validation->set_rules('clientAddress', 'clientAddress', 'required');
			$this->form_validation->set_rules('clientCompany', 'clientCompany', 'required');

			if ($this->form_validation->run() == FALSE) {
				# code...
			    $data['user'] = $this->db->get_where('user',['email' => $_SESSION['user']['email']])->row_array();
			    $this->load->view('templates/header', $data);
			    $this->load->view('templates/sidebar', $data);
			    $this->load->view('templates/topbar', $data);
				$this->load->view('client/updateForm', $data);
				$this->load->view('templates/footer');			
			}else{
				$this->Client_model->updateDataClient();
				$this->session->set_flashdata('message','<div class="alert alert-success mt-3" role="alert">Data client telah diupdate ! </div>');	
				redirect('client');
			}
		}

		public function details($id)
		{
			$data['title'] = 'Detail Data Client';
			$data['client'] = $this->Client_model->getClientById($id);
			$data['pic'] = $this->Pic_model->getPicByClient($id);
			$data['user'] = $this->db->get_where('user',['email' => $_SESSION['user']['email']])->row_array();
			$this->load->view('templates/header', $data);
			$this->load->view('templates/sidebar', $data);
			$this->load->view('templates/topbar', $data);
			$this->load->view('client/detail', $data);
			$this->load->view('templates/footer');
		}

		// public function getUpdate()
		// {
		// 	// echo json_encode($this->model('Mahasiswa_model')->getMhsById($_POST['id']));
		// 	echo $_POST['id'];
		// }
	}
?>
