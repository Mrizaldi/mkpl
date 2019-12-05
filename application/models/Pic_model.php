<?php 
	class Pic_model extends CI_Model
	{
		
		public function getAllPic()
		{
			return $query = $this->db->get('pic')->result_array();
		}

		public function tambahDataPic()
		{
			$data = array(
			"id" 			        => '',
			"picName" 			    => $this->input->post('picName', true),
			"picPhone"              => $this->input->post('picPhone', true),
			"picMail" 		        => $this->input->post('picMail', true),
			"picPosition"    		=> $this->input->post('picPosition', true),
			"clientId"      		=> $this->input->post('clientId', true)
			);
			$this->db->insert('pic', $data);
		}

		public function hapusDataPic($id)
		{
			//$this->db->where('nis', $id);
			$this->db->delete('pic', ['id' => $id]);
			return 1;
		}

		public function hapusDataPicByClient($clientId)
		{
			$this->db->delete('pic', ['clientId' => $clientId]);
			return 1;
		}

		public function getPicByClient($clientId)
		{
			//$this->db->where('nis', $id);
			//return $this->db->get_where('client' , ['id' => $id])->row_array();
			return $query = $this->db->get_where('pic' , ['clientId' => $clientId])->result_array();
		}

		public function getPicById($id)
		{
			//$this->db->where('nis', $id);
			//return $this->db->get_where('client' , ['id' => $id])->row_array();
			return $this->db->get_where('pic' , ['id' => $id])->row_array();
		}


		public function updateDataPic()
		{
			$data = array(
			"picName" 			    => $this->input->post('picName', true),
			"picPhone"              => $this->input->post('picPhone', true),
			"picMail" 		        => $this->input->post('picMail', true),
			"picPosition"    		=> $this->input->post('picPosition', true),
			"clientId"      		=> $this->input->post('clientId', true)
			);
			$this->db->where('id', $this->input->post('id'));
			$this->db->update('pic', $data);
		}

		/*public function cariDataClient()
		{
			$keyword = $this->input->post('keyword',true);
			$this->db->like('nama', $keyword);
			$this->db->or_like('jenis_kelamin', $keyword);
			$this->db->or_like('telp', $keyword);
			$this->db->or_like('alamat', $keyword);
			return $this->db->get('siswa')->result_array();
		}*/
	}
?>