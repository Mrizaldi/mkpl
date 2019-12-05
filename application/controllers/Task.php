<?php
defined('BASEPATH') or exit('No direct script access allowed');

	class Task extends CI_Controller
	{
		public function __construct()
		{
			parent::__construct();
			$this->load->model('Task_model');		
			$this->load->library('form_validation');
			is_logged_in();		
			// is_pm();
		}
		
		public function tambah()
		{
			is_pm_or_above($_SESSION['user']['role_id']);
			$this->form_validation->set_rules('nama', 'Nama', 'required');
			$this->form_validation->set_rules('startdate', 'Start Date', 'required');
			$this->form_validation->set_rules('enddate', 'End Date', 'required');
			$this->form_validation->set_rules('description', 'Description', 'required');
			$this->form_validation->set_rules('status', 'Status', 'required');
			$this->form_validation->set_rules('assignee', 'Assignee', 'required');
			$thisproj = $this->db->get_where('project',['id' => $data['projId']])->row_array();
			if ($this->form_validation->run() == FALSE) {
				$this->session->set_flashdata('message','<div class="alert alert-danger alert-dismissible fade show mt-3" role="alert">Task gagal ditambahkan ! <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');	
				redirect('project/view/'.$this->input->post('projId'));
			}else{
				if ($this->input->post('startdate') < date("Y-m-d") || $this->input->post('enddate') < date("Y-m-d")) {
					$this->session->set_flashdata('message','<div class="alert alert-danger alert-dismissible fade show mt-3" role="alert">Start / end date tidak boleh kurang dari hari ini ! <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');	
					redirect('project/view/'.$this->input->post('projId'));			
				}else if($this->input->post('startdate') > $this->input->post('enddate')){
					$this->session->set_flashdata('message','<div class="alert alert-danger alert-dismissible fade show mt-3" role="alert">Start date tidak boleh melebihi end date ! <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>
						<div class="alert alert-danger mt-3" role="alert">End date tidak boleh kurang dari start date ! <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');	
					redirect('project/view/'.$this->input->post('projId'));			
				}
				else if($this->input->post('startdate') < $this->input->post('startdateprj')){
					$this->session->set_flashdata('message','<div class="alert alert-danger alert-dismissible fade show mt-3" role="alert">Start date task tidak boleh kurang dari start date project ! <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');	
					redirect('project/view/'.$this->input->post('projId'));			
				}
				else if($this->input->post('enddate') > $this->input->post('enddateprj')){
					$this->session->set_flashdata('message','<div class="alert alert-danger alert-dismissible fade show mt-3" role="alert">End date task tidak boleh melebihi end date project ! <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');	
					redirect('project/view/'.$this->input->post('projId'));			
				}
				else{
				$this->Task_model->tambahDataTask();
				$this->session->set_flashdata('message','<div class="alert alert-success alert-dismissible fade show mt-3" role="alert">Task telah dibuat! Notifikasi e-mail telah dikirim ke employee.<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');	
				redirect('project/view/'.$this->input->post('projId'));
				}
			}
		}

		public function delete($taskId, $projId)
		{
			is_pm_or_above($_SESSION['user']['role_id']);
			if ($this->Task_model->hapusDataTask($taskId) > 0) {
				//header('Location:' . base_url() . '/project');
				$this->session->set_flashdata('message','<div class="alert alert-danger alert-dismissible fade show mt-3" role="alert">Data task telah dihapus ! <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');	
				redirect('project/view/'.$projId);
			}
		}

		public function update()
		{
			is_pm_or_above($_SESSION['user']['role_id']);
			$this->form_validation->set_rules('nama', 'Nama', 'required');
			$this->form_validation->set_rules('startdate', 'Start Date', 'required');
			$this->form_validation->set_rules('enddate', 'End Date', 'required');
			$this->form_validation->set_rules('description', 'Description', 'required');
			$this->form_validation->set_rules('status', 'Status', 'required');
			$this->form_validation->set_rules('assignee', 'Assignee', 'required');
			if ($this->form_validation->run() == FALSE) {
				$this->session->set_flashdata('message','<div class="alert alert-danger alert-dismissible fade show mt-3" role="alert">Task gagal diupdate ! <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');	
				redirect('project/view/'.$this->input->post('projId'));
			}else{
				if($this->input->post('startdate') > $this->input->post('enddate')){
					$this->session->set_flashdata('message','<div class="alert alert-danger alert-dismissible fade show mt-3" role="alert">Start date tidak boleh melebihi end date ! <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>
						<div class="alert alert-danger mt-3" role="alert">End date tidak boleh kurang dari start date ! <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');	
					redirect('project/view/'.$this->input->post('projId'));			
				}
				else if($this->input->post('startdate') < $this->input->post('startdateprj')){
					$this->session->set_flashdata('message','<div class="alert alert-danger alert-dismissible fade show mt-3" role="alert">Start date task tidak boleh kurang dari start date project ! <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');	
					redirect('project/view/'.$this->input->post('projId'));			
				}
				else if($this->input->post('enddate') > $this->input->post('enddateprj')){
					$this->session->set_flashdata('message','<div class="alert alert-danger alert-dismissible fade show mt-3" role="alert">End date task tidak boleh melebihi end date project ! <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');	
					redirect('project/view/'.$this->input->post('projId'));			
				}
				else{
				$this->Task_model->updateDataTask();
				$this->session->set_flashdata('message','<div class="alert alert-success alert-dismissible fade show mt-3" role="alert">Task berhasil diupdate ! <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');	
				redirect('project/view/'.$this->input->post('projId'));
				// $this->Task_model->tambahDataTask();
				// $this->session->set_flashdata('message','<div class="alert alert-success alert-dismissible fade show mt-3" role="alert">Task telah dibuat! Notifikasi e-mail telah dikirim ke employee.<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');	
				// redirect('project/view/'.$this->input->post('projId'));
				}
			}
		}
		
		public function getDetails()
		{
			echo json_encode($this->Task_model->getTaskById($_POST['id']));
			// echo $_POST['id'];
		}

		public function getAllTask()
		{
			echo json_encode($this->Task_model->getAllTask());
			// echo $_POST['id'];
		}

		public function getTaskByEmployee()
		{
			echo json_encode($this->Task_model->getTaskByEmp($_POST['id']));			
			// echo $_POST['id'];
		}
	}
?>
