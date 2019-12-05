<?php
defined('BASEPATH') or exit('No direct script access allowed');

	class Board extends CI_Controller
	{
		public function __construct()
		{
			parent::__construct();
			$this->load->model('Board_model');		
			$this->load->model('Task_model');		
			$this->load->library('form_validation');
			is_logged_in();		
			// is_pm();
		}
		
		public function tambah()
		{
			$this->form_validation->set_rules('nama', 'Nama', 'required');
			if ($this->form_validation->run() == FALSE) {
				$this->session->set_flashdata('message','<div class="alert alert-danger alert-dismissible fade show mt-3" role="alert">Nama board harus diisi ! <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
				redirect('project/view/'.$this->input->post('projId'));
			}else{
				$this->Board_model->tambahDataBoard();
				$this->session->set_flashdata('message','<div class="alert alert-success alert-dismissible fade show mt-3" role="alert">Board baru telah dibuat ! <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
				redirect('project/view/'.$this->input->post('projId'));
			}
		}

		function getBoardByProject($projId)
		{
			$this->Board_model->getBoardByProject($projId);
		}

		public function delete($id)
		{
			if ($this->Board_model->hapusDataBoard($this->input->post('boardId')) > 0) {
				$this->Task_model->hapusDataTaskByBoard($this->input->post('boardId'));
				$this->session->set_flashdata('message','<div class="alert alert-danger alert-dismissible fade show mt-3" role="alert">Board telah dihapus ! <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');	
				redirect('project/view/'.$this->input->post('projId'));			
			}
		}

		// public function update($id)
		// {
		// 	$data['title'] = 'Update Project';
		// 	$data['user'] = $this->db->get_where('user',['email' => $_SESSION['user']['email']])->row_array();
		// 	$data['project'] = $this->Project_model->getProjectById($id);
		// 	$this->form_validation->set_rules('nama', 'Nama', 'required');
		// 	$this->form_validation->set_rules('startdate', 'Start Date', 'required');
		// 	$this->form_validation->set_rules('enddate', 'End Date', 'required');
		// 	$this->form_validation->set_rules('description', 'Description', 'required');
		// 	$this->form_validation->set_rules('progress', 'Progress', 'required');
		// 	$this->form_validation->set_rules('client', 'Client', 'required');
		// 	$this->form_validation->set_rules('pm', 'Project Manager', 'required');

		// 	if ($this->form_validation->run() == FALSE) {
		// 		# code...
		// 		$this->load->view('templates/header', $data);
		// 		$this->load->view('templates/sidebar', $data);
		// 		$this->load->view('templates/topbar', $data);
		// 		$this->load->view('project/updateForm', $data);
		// 		$this->load->view('templates/footer');	
		// 	}else{
		// 		$this->Project_model->updateDataProject();
		// 		$this->session->set_flashdata('flash','Diubah');
		// 		redirect('project');
		// 	}
		// }

		// public function view($id)
		// {
		// 	$data['title'] = 'Detail Project';
		// 	$data['user'] = $this->db->get_where('user',['email' => $_SESSION['user']['email']])->row_array();
		// 	$data['project'] = $this->Project_model->getProjectById($id);
		// 	$this->load->view('templates/header', $data);
		// 	$this->load->view('templates/sidebar', $data);
		// 	$this->load->view('templates/topbar', $data);
		// 	$this->load->view('project/details', $data);
		// 	$this->load->view('templates/footer');	
		// }
	}
?>
