<?php
defined('BASEPATH') or exit('No direct script access allowed');

	class Project extends CI_Controller
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
			$data['title'] = 'Project';
			// $data['project'] = $this->Project_model->getAllProject();
			$data['client'] = $this->Client_model->getAllClient();
			$data['emp'] = $this->Employee_model->getAllEmployee();
			$data['user'] = $this->db->get_where('user',['email' => $_SESSION['user']['email']])->row_array();
			if (is_admin_or_support($_SESSION['user']['role_id'])) {
				$data['project'] = $this->Project_model->getAllProject();
				$this->load->view('templates/header', $data);
				$this->load->view('templates/sidebar', $data);
				$this->load->view('templates/topbar', $data);
				$this->load->view('project/index', $data);
				$this->load->view('templates/footer');
			}else if(is_pm($_SESSION['user']['role_id'])){
				$data['project'] = $this->Project_model->getProjectByPm($data['user']['id']);
				$this->load->view('templates/header', $data);
				$this->load->view('templates/sidebar', $data);
				$this->load->view('templates/topbar', $data);
				$this->load->view('project/index', $data);
				$this->load->view('templates/footer');
			}else{
				$data['project'] = $this->Project_model->getProjectByEmp($data['user']['id']);
				$this->load->view('templates/header', $data);
				$this->load->view('templates/sidebar', $data);
				$this->load->view('templates/topbar', $data);
				$this->load->view('project/index', $data);
				$this->load->view('templates/footer');
			}
		}

		public function tambah()
		{
			is_permitted($_SESSION['user']['role_id']);
			// if ($this->Mahasiswa_model->tambahDataMahasiswa($_POST) > 0) {
			// 	header('Location:' . base_url() . '/mahasiswa');
			// 	exit;
			// }
			$data['title'] = 'Buat Project';
			$data['client'] = $this->Client_model->getAllClient();
			$data['emp'] = $this->Employee_model->getAllEmployee();
			$data['user'] = $this->db->get_where('user',['email' => $_SESSION['user']['email']])->row_array();
			$this->form_validation->set_rules('nama', 'Nama', 'required');
			$this->form_validation->set_rules('startdate', 'Start Date', 'required');
			$this->form_validation->set_rules('enddate', 'End Date', 'required');
			$this->form_validation->set_rules('description', 'Description', 'required');
			$this->form_validation->set_rules('progress', 'Progress', 'required');
			$this->form_validation->set_rules('client', 'Client', 'required');
			$this->form_validation->set_rules('pm', 'Project Manager', 'required');
			if ($this->form_validation->run() == FALSE) {				
				$this->load->view('templates/header', $data);
				$this->load->view('templates/sidebar', $data);
				$this->load->view('templates/topbar', $data);
				$this->load->view('project/tambahForm',$data);
				$this->load->view('templates/footer');
			}else{
				if ($this->input->post('startdate') < date("Y-m-d") || $this->input->post('enddate') < date("Y-m-d")) {
					$this->session->set_flashdata('message','<div class="alert alert-danger alert-dismissible fade show mt-3" role="alert">Start / end date tidak boleh kurang dari hari ini ! <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');	
					redirect('project/tambah');
				}else if($this->input->post('startdate') > $this->input->post('enddate')){
					$this->session->set_flashdata('message','<div class="alert alert-danger alert-dismissible fade show mt-3" role="alert">Start date tidak boleh melebihi end date ! <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>
						<div class="alert alert-danger mt-3" role="alert">End date tidak boleh kurang dari start date ! <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');	
					redirect('project/tambah');
				}else{
					$this->Project_model->tambahDataProject();				
					$this->session->set_flashdata('message','<div class="alert alert-success alert-dismissible fade show mt-3" role="alert">Projek telah dibuat, notifikasi e-mail telah dikirim ke PM. <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');	
					redirect('project');
				}
			}
		}

		public function delete($id)
		{
			is_permitted($_SESSION['user']['role_id']);
			if ($this->Project_model->hapusDataProject($id) > 0) {
				$this->Board_model->hapusDataBoardByProject($id);
				$this->Task_model->hapusDataTaskByProject($id);
				$file = $this->db->get_where('doctambah' , ['idproject' => $id])->result_array();
				foreach ($file as $f) {
					$this->db->delete('doctambah', ['id' => $f['id']]);
			    	unlink(FCPATH . 'assets/docs/'.$f['filename']);
				}
				// header('Location:' . base_url() . '/project');
				$this->session->set_flashdata('message','<div class="alert alert-danger alert-dismissible fade show mt-3" role="alert">Semua data yang berhubungan dengan projek telah dihapus ! <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');	
				redirect('project');
			}
		}

		public function update($id)
		{
			$data['title'] = 'Update Project';
			$data['client'] = $this->Client_model->getAllClient();
			$data['emp'] = $this->Employee_model->getAllEmployee();
			$data['user'] = $this->db->get_where('user',['email' => $_SESSION['user']['email']])->row_array();
			$data['project'] = $this->Project_model->getProjectById($id);
			is_this_my_project($data['project']['pm']);
			$this->form_validation->set_rules('nama', 'Nama', 'required');
			$this->form_validation->set_rules('startdate', 'Start Date', 'required');
			$this->form_validation->set_rules('enddate', 'End Date', 'required');
			$this->form_validation->set_rules('description', 'Description', 'required');
			$this->form_validation->set_rules('progress', 'Progress', 'required');
			$this->form_validation->set_rules('client', 'Client', 'required');
			$this->form_validation->set_rules('pm', 'Project Manager', 'required');
			if ($this->form_validation->run() == FALSE) {
				# code...
				$this->load->view('templates/header', $data);
				$this->load->view('templates/sidebar', $data);
				$this->load->view('templates/topbar', $data);
				$this->load->view('project/updateForm', $data);
				$this->load->view('templates/footer');	
			}else{
				if($this->input->post('startdate') > $this->input->post('enddate')){
					$this->session->set_flashdata('message','<div class="alert alert-danger alert-dismissible fade show mt-3" role="alert">Start date tidak boleh melebihi end date ! <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>
						<div class="alert alert-danger mt-3" role="alert">End date tidak boleh kurang dari start date ! <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');	
					redirect('project/update/'. $id);
				}else{
				$this->Project_model->updateDataProject();
				$this->session->set_flashdata('message','<div class="alert alert-success alert-dismissible fade show mt-3" role="alert">Project telah diupdate ! <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');	
				redirect('project');
				}
			}
		}

		public function view($id)
		{
			$data['title'] = 'Detail Project';
			$data['user'] = $this->db->get_where('user',['email' => $_SESSION['user']['email']])->row_array();
			$data['project'] = $this->Project_model->getProjectById($id);
			$data['document'] = $this->Project_model->getDocumentId($id);
			$data['board'] = $this->Board_model->getBoardByProject($id);
			$data['task'] = $this->Task_model->getTaskByProject($id);
			$data['emp'] = $this->Employee_model->getAllEmployee();
			$data['role'] = $this->db->get('user_role')->result_array();
			$role_id = $this->session->userdata('role_id');
        	// $queryTask = "SELECT `user`.`id`,`menu`
         //              FROM `user_menu` JOIN `user_access_menu`
         //              ON `user_menu`.`id` = `user_access_menu`.`menu_id`
         //              WHERE `user_access_menu`.`role_id` = $role_id
         //              ORDER BY `user_access_menu`.`menu_id` ASC
         //             ";
        	// $data['task'] = $this->db->query($queryMenu)->result_array();
			$this->load->view('templates/header', $data);
			$this->load->view('templates/sidebar', $data);
			$this->load->view('templates/topbar', $data);
			$this->load->view('project/details', $data);
			$this->load->view('templates/footer');	
		}

		public function getAllProject()
		{
			echo json_encode($this->Project_model->getAllProject());
			// echo $_POST['id'];
		}

		public function getProjectPM()
		{
			echo json_encode($this->Project_model->getProjectByPm($_SESSION['user']['emp_id']));
			// echo $_POST['id'];
		}

		public function download($id){
	        if(!empty($id)){
			    $this->load->helper('download');
		    	$fileInfo = $this->db->get_where('doctambah' , ['id' => $id])->row_array();
		      	$file = 'assets/docs/'.$fileInfo['filename'];
		      	force_download($file,NULL);
	        }
		}

		public function delete2($id){
		    $fileInfo = $this->db->get_where('doctambah' , ['id' => $id])->row_array();
		    unlink(FCPATH . 'assets/docs/'.$fileInfo['filename']);
		    $this->Project_model->hapusDataDoc($id);
		    $this->session->set_flashdata('message','<div class="alert alert-danger alert-dismissible fade show mt-3" role="alert">Berkas telah dihapus !<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
    		redirect('project/view/'.$this->input->post('projId'));
	    }

		public function create2() {
	        $config['upload_path'] = './assets/docs/';
	        $config['allowed_types'] = 'pdf|docx|xlsx';
	        $config['max_size']     = '50000';
	        // load library upload
	        $this->load->library('upload', $config);
	        if (!$this->upload->do_upload('filename2')) {
	            $error = $this->upload->display_errors();
	            $this->session->set_flashdata('message','<div class="alert alert-danger alert-dismissible fade show mt-3" role="alert">Berkas gagal diupload ! '. $error .'<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
				redirect('project/view/'.$this->input->post('idproject'));
	            // print_r($error);
	        } else {
	            $result = $this->upload->data();
	            $data = array(
	             'idproject' => $this->input->post('idproject'),
	             'filename' => $result['file_name']
	            );
	            $this->load->model('Project_model');
	            $this->Project_model->insert($data);
	            $this->session->set_flashdata('message','<div class="alert alert-success alert-dismissible fade show mt-3" role="alert">Berkas berhasil diupload !<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
	            redirect('project/view/'.$this->input->post('idproject'));	              	        
	        }
    	}
	}
?>

