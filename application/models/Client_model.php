<?php 
	class Client_model extends CI_Model
	{
		
		public function getAllClient()
		{
			return $query = $this->db->get('client')->result_array();
		}

		public function tambahDataClient()
		{
			$data = array(
			"id" 			        => '',
			"clientName" 			=> $this->input->post('clientName', true),
			"clientPhone"           => $this->input->post('clientPhone', true),
			"clientAddress" 		=> $this->input->post('clientAddress', true),
			"clientCompany" 		=> $this->input->post('clientCompany', true)
			);
			$this->db->insert('client', $data);
		}

		public function hapusDataClient($id)
		{
			//$this->db->where('nis', $id);
			$this->db->delete('client', ['id' => $id]);
			return 1;
		}

		public function getClientById($id)
		{
			//$this->db->where('nis', $id);
			return $this->db->get_where('client' , ['id' => $id])->row_array();
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


		  public function hitungJumlahAsset()
				{   
				    $query = $this->db->get('client');
				    if($query->num_rows()>0)
				    {
				      return $query->num_rows();
				    }
				        else
				    {
				      return 0;
				    }
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