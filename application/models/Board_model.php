<?php 
	class Board_model extends CI_Model
	{
		
		public function getAllClient()
		{
			return $query = $this->db->get('client')->result_array();
		}

		public function tambahDataBoard()
		{
			$data = array(
			"name" 				=> $this->input->post('nama', true),
			"projectId" 		=> $this->input->post('projId', true)
			);
			$this->db->insert('board', $data);
		}

		public function hapusDataBoard($id)
		{
			//$this->db->where('nis', $id);
			$this->db->delete('board', ['id' => $id]);
			return 1;
		}

		public function hapusDataBoardByProject($projid)
		{
			$this->db->delete('board', ['projectId' => $projid]);
			return 1;
		}

		public function getBoardByProject($projId)
		{
			//$this->db->where('nis', $id);
			//return $this->db->get_where('client' , ['id' => $id])->row_array();
			return $query = $this->db->get_where('board' , ['projectId' => $projId])->result_array();
		}

		public function updateDataClient()
		{
			$data = array(
			"clientName" 			=> $this->input->post('clientName', true),
			"clientPhone"           => $this->input->post('clientPhone', true),
			"clientAddress" 		=> $this->input->post('clientAddress', true),
			"clientCompany" 		=> $this->input->post('clientCompany', true)
			);
			$this->db->where('id', $this->input->post('id'));
			$this->db->update('client', $data);
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