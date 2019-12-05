<?php
defined('BASEPATH') or exit('No direct script access allowed');

	class Pic extends CI_Controller
	{

		public function __construct()
		{
			parent::__construct();
			$this->load->model('Client_model');
			$this->load->model('Pic_model');			
			$this->load->library('form_validation');		
			is_logged_in();			
		}		


		public function tambah()
		{
            is_permitted($_SESSION['user']['role_id']);
			$this->form_validation->set_rules('picName', 'picName', 'required');
			$this->form_validation->set_rules('picPhone', 'picPhone', 'required');
			$this->form_validation->set_rules('picMail', 'picMail', 'required');
			$this->form_validation->set_rules('picPosition', 'picPosition', 'required');
			if ($this->form_validation->run() == FALSE) {
				$this->session->set_flashdata('flash','Gagal ditambahkan');
				redirect('client/details/'.$this->input->post('clientId'));
			}else{
				$this->Pic_model->tambahDataPic();
				$this->session->set_flashdata('flash','Ditambahkan');
				redirect('client/details/'.$this->input->post('clientId'));
			}
		}

		public function hapus($cid , $picid)
		{
			is_permitted($_SESSION['user']['role_id']);
			if ($this->Pic_model->hapusDataPic($picid) > 0) {
				$this->session->set_flashdata('flash','Dihapus');
				redirect('client/details/'.$cid);
			}
		}

		public function update()
		{
			is_permitted($_SESSION['user']['role_id']);
			$data['title'] = 'Update Data PIC';
			$data['pic'] = $this->Pic_model->getPicById($id);

			$this->form_validation->set_rules('picName', 'picName', 'required');
			$this->form_validation->set_rules('picPhone', 'picPhone', 'required');
			$this->form_validation->set_rules('picMail', 'picMail', 'required');
			$this->form_validation->set_rules('picPosition', 'picPosition', 'required');

			if ($this->form_validation->run() == FALSE) {
				# code...
		        redirect('client/details/'.$this->input->post('clientId'));
			}else{
				$this->Pic_model->updateDataPic();
				$this->session->set_flashdata('flash','Diubah');
				redirect('client/details/'.$this->input->post('clientId'));
			}
		}		

		public function getDetails()
		{
			echo json_encode($this->Pic_model->getPicById($_POST['id']));
			// echo $_POST['id'];
		}
	}
?>
