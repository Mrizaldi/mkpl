<?php 
	class Task_model extends CI_Model
	{
		
		public function getAllTask()
		{
			return $query = $this->db->get('task')->result_array();
		}

		public function getToDoTask()
		{
			$todotask = [];
			$project = $this->db->get('project')->result_array();
			foreach ($project as $p) {
				$boardproj = $this->db->get_where('board',['projectId' => $p['id']])->result_array();
				$boardlength = count($boardproj);
				if ($boardlength > 0) {
					$firstboard = $boardproj[0];
					$tasktodo = $this->db->get_where('task',['status' => $firstboard['id'] , 'empId' => $_SESSION['user']['emp_id']])->result_array();					
					if (count($tasktodo) > 0) {
						foreach ($tasktodo as $tt) {
							array_push($todotask, $tt);
						}
					}
					// $lastboard = $boardproj[$boardlength-1];
				}
			}
			return $todotask;
		}

		public function getInprogressTask()
		{
			$inprogresstask = [];
			$project = $this->db->get('project')->result_array();
			foreach ($project as $p) {
				$boardproj = $this->db->get_where('board',['projectId' => $p['id']])->result_array();
				$boardlength = count($boardproj);
				if ($boardlength > 2) {
					$middleboard = [];
					for ($i=1; $i < $boardlength-1; $i++) { 
						array_push($middleboard, $boardproj[$i]);
					}
					for ($i=0; $i < count($middleboard); $i++) { 
						$taskinprogress = $this->db->get_where('task',['status' => $middleboard[$i]['id'] , 'empId' => $_SESSION['user']['emp_id']])->result_array();					
						if (count($taskinprogress) > 0) {
							foreach ($taskinprogress as $ti) {
								array_push($inprogresstask, $ti);
							}
						}
					}
					// $lastboard = $boardproj[$boardlength-1];
				}
			}
			return $inprogresstask;
		}

		public function getDoneTask()
		{
			$donetask = [];
			$project = $this->db->get('project')->result_array();
			foreach ($project as $p) {
				$boardproj = $this->db->get_where('board',['projectId' => $p['id']])->result_array();
				$boardlength = count($boardproj);
				if ($boardlength > 0) {
					$lastboard = $boardproj[$boardlength-1];
					$taskdone = $this->db->get_where('task',['status' => $lastboard['id'] , 'empId' => $_SESSION['user']['emp_id']])->result_array();					
					if (count($taskdone) > 0) {
						foreach ($taskdone as $td) {
							array_push($donetask, $td);
						}
					}
					// $lastboard = $boardproj[$boardlength-1];
				}
			}
			return $donetask;
		}

		public function tambahDataTask()
		{
			$data = array(
			"name" 			=> $this->input->post('nama', true),
			"startDate" 	=> $this->input->post('startdate', true),
			"endDate" 		=> $this->input->post('enddate', true),
			"deskripsi"		=> $this->input->post('description', true),
			"status" 		=> $this->input->post('status', true),
			"projId" 		=> $this->input->post('projId', true),
			"empId" 		=> $this->input->post('assignee', true)
			);
			$thisproj = $this->db->get_where('project',['id' => $data['projId']])->row_array();
			$this->db->insert('task', $data);
			$data = array(
			"id" 			=> '',
			"name" 			=> $this->input->post('nama', true),
			"startDate" 	=> $this->input->post('startdate', true),
			"endDate" 		=> $this->input->post('enddate', true),
			"deskripsi"		=> $this->input->post('description', true),
			"status" 		=> $this->input->post('status', true),
			"projName" 		=> $thisproj['projName'],
			"empId" 		=> $this->input->post('assignee', true),
			"pmdata" 		=> $this->db->get_where('user',['id' => $thisproj['pm']])->row_array(),
			"empdata" 		=> $this->db->get_where('user',['id' => $data['empId']])->row_array()
			);
			_sendEmail($data, 'assigneeTask');
		}

		public function hapusDataTask($id)
		{
			//$this->db->where('nis', $id);
			$this->db->delete('task', ['id' => $id]);
			return 1;
		}

		public function hapusDataTaskByBoard($boardid)
		{
			//$this->db->where('nis', $id);
			$this->db->delete('task', ['status' => $boardid]);
			return 1;
		}

		public function hapusDataTaskByProject($projid)
		{
			//$this->db->where('nis', $id);
			$this->db->delete('task', ['projId' => $projid]);
			return 1;
		}

		public function getTaskByProject($projId)
		{
			//$this->db->where('nis', $id);
			return $this->db->get_where('task' , ['projId' => $projId])->result_array();
		}

		public function getTaskById($id)
		{
			//$this->db->where('nis', $id);
			return $this->db->get_where('task' , ['id' => $id])->row_array();
		}

		public function getTaskByEmp($id)
		{
			return $this->db->get_where('task' , ['empId' => $id])->result_array();
		}

		public function updateDataTask()
		{
			$data = array(
			"name" 			=> $this->input->post('nama', true),
			"startDate" 	=> $this->input->post('startdate', true),
			"endDate" 		=> $this->input->post('enddate', true),
			"deskripsi"		=> $this->input->post('description', true),
			"status" 		=> $this->input->post('status', true),
			"projId" 		=> $this->input->post('projId', true),
			"empId" 		=> $this->input->post('assignee', true)
			);
			$thisproj = $this->db->get_where('project',['id' => $data['projId']])->row_array();
			$this->db->where('id', $this->input->post('taskId'));
			$this->db->update('task', $data);
			$data = array(
			"id" 				=> '',
			"name" 			=> $this->input->post('nama', true),
			"startDate" 	=> $this->input->post('startdate', true),
			"endDate" 		=> $this->input->post('enddate', true),
			"deskripsi"		=> $this->input->post('description', true),
			"status" 		=> $this->input->post('status', true),
			"projName" 		=> $thisproj['projName'],
			"empId" 		=> $this->input->post('assignee', true),
			"pmdata" 		=> $this->db->get_where('user',['id' => $thisproj['pm']])->row_array(),
			"empdata" 		=> $this->db->get_where('user',['id' => $data['empId']])->row_array()
			);
			// _sendEmail($data, 'assigneeTask');
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