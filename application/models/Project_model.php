<?php 
	class Project_model extends CI_Model
	{
		
		public function getAllProject()
		{
			return $query = $this->db->get('project')->result_array();
		}

		public function tambahDataProject()
		{
			$data = array(
			"id" 				=> '',
			"projName" 			=> $this->input->post('nama', true),
			"projStartDate" 	=> $this->input->post('startdate', true),
			"projEndDate" 		=> $this->input->post('enddate', true),
			"projDescription" 	=> $this->input->post('description', true),
			"projProgress" 		=> $this->input->post('progress', true),
			"clientId" 			=> $this->input->post('client', true),
			"pm" 				=> $this->input->post('pm', true)
			);
			$this->db->insert('project', $data);
			$data = array(
			"id" 				=> '',
			"projName" 			=> $this->input->post('nama', true),
			"projStartDate" 	=> $this->input->post('startdate', true),
			"projEndDate" 		=> $this->input->post('enddate', true),
			"projDescription" 	=> $this->input->post('description', true),
			"projProgress" 		=> $this->input->post('progress', true),
			"clientId" 			=> $this->input->post('client', true),
			"pm" 				=> $this->input->post('pm', true),
			"pmdata" 			=> $this->db->get_where('user',['id' => $data['pm']])->row_array(),
			);
			_sendEmail($data, 'assigneePM');
		}

		public function hapusDataProject($id)
		{
			//$this->db->where('nis', $id);
			$this->db->delete('project', ['id' => $id]);
			return 1;
		}

		public function getProjectById($id)
		{
			//$this->db->where('nis', $id);
			return $this->db->get_where('project' , ['id' => $id])->row_array();
		}

		public function getProjectByPm($pm_id)
		{
			return $this->db->get_where('project' , ['pm' => $pm_id])->result_array();
		}

		public function getProjectByEmp($emp_id)		
		{
			$project = [];
			$task = $this->db->get_where('task' , ['empId' => $emp_id])->result_array();			
			$projectemp = $this->db->get('project')->result_array();			
			$countTaskProj = 0;
			for($i = 0; $i < count($projectemp); $i++) {
				for($j = 0; $j < count($task); $j++) {
				 	if ($task[$j]['projId'] == $projectemp[$i]['id'] && $task[$j]['empId'] == $emp_id) {
				 		$countTaskProj++;
				 	}					
				}				
				if ($countTaskProj > 0) {
					// echo "tidak terlibat di projek ". $project[$i]['id'] . " . " . $project[$i]['projName'] . " count " . $countTaskProj . "<br><br>";
					// echo "terlibat di projek ". $projectemp[$i]['id'] . " . " . $projectemp[$i]['projName'] . " dapat ". $countTaskProj ." task" . "<br><br>";
					array_push($project, $projectemp[$i]);
				}
				$countTaskProj = 0;
			}
			return $project;
		}

		public function updateDataProject()
		{
			$data = array(
			"projName" 			=> $this->input->post('nama', true),
			"projStartDate" 	=> $this->input->post('startdate', true),
			"projEndDate" 		=> $this->input->post('enddate', true),
			"projDescription" 	=> $this->input->post('description', true),
			"projProgress" 		=> $this->input->post('progress', true),
			"clientId" 			=> $this->input->post('client', true),
			"pm" 				=> $this->input->post('pm', true)
			);
			$this->db->where('id', $this->input->post('id'));
			$this->db->update('project', $data);
			$data = array(
			"id" 				=> '',
			"projName" 			=> $this->input->post('nama', true),
			"projStartDate" 	=> $this->input->post('startdate', true),
			"projEndDate" 		=> $this->input->post('enddate', true),
			"projDescription" 	=> $this->input->post('description', true),
			"projProgress" 		=> $this->input->post('progress', true),
			"clientId" 			=> $this->input->post('client', true),
			"pm" 				=> $this->input->post('pm', true),
			"pmdata" 			=> $this->db->get_where('user',['id' => $data['pm']])->row_array(),
			);
			 // _sendEmail($data, 'updateproject');
		}

		public function cariDataProject()
		{
			$keyword = $this->input->post('keyword',true);
			$this->db->like('nama', $keyword);
			$this->db->or_like('jenis_kelamin', $keyword);
			$this->db->or_like('telp', $keyword);
			$this->db->or_like('alamat', $keyword);
			return $this->db->get('siswa')->result_array();
		}


		public function hapusDataDoc($id)
		{
			//$this->db->where('nis', $id);
			$this->db->delete('doctambah', ['id' => $id]);
		
		}
          public function getDocumentId($id)
		{
			//$this->db->where('nis', $id);
			return $this->db->get_where('doctambah' , ['idproject' => $id])->result_array();
		}
        public function insert($data){



           return $this->db->insert('doctambah',$data);

}
	}
?>