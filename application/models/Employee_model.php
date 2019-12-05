<?php 
	class Employee_model extends CI_Model
	{
		
		public function getAllEmployee()
		{
			return $query = $this->db->get('user')->result_array();
		}

		public function tambahDataEmployee()
		{
				$email = $this->input->post('email',true);
				$data = [
					'name' => htmlspecialchars($this->input->post('nama',true)),
					'email' => htmlspecialchars($email),
					'phone' => htmlspecialchars($this->input->post('telepon',true)),
					'image' => 'default.jpg',
					'password' => password_hash($this->input->post('password'), PASSWORD_DEFAULT),
					'role_id' => htmlspecialchars($this->input->post('role',true)),
					'is_active' => 0,
					'date_created' => time()
				];
				//siapkan token
				$token = base64_encode(random_bytes(32));
				$user_token = [
					'email' => $email,
					'token' => $token,
					'date_created' => time()
				];
				$this->db->insert('user', $data);
				$this->db->insert('user_token', $user_token);
				_sendEmail($token, 'verify');
				$this->session->set_flashdata('message','<div class="alert alert-success mt-3" role="alert">Akun employee berhasil dibuat. Silakan minta employee cek email / spam untuk aktivasi akun.</div>');	
		}

		// private function _sendEmail($token, $type)
		// {
		// 	// $config = [
		// 	// 	'protocol'  => 'smtp',
		// 	// 	'smtp_host' => 'ssl://smtp.googlemail.com',
		// 	// 	'smtp_user' => 'aliyyailmi20@gmail.com',
		// 	// 	'smpt_pass' => 'ilmi2007',
		// 	// 	'smtp_port' => 465,
		// 	// 	'mailtype' => 'html',
		// 	// 	'charset'   => 'utf-8',
		// 	// 	'newline'   => "\r\n"
		// 	// ];

		// 	$this->load->library('email');
		// 	$config = array();
	 //        $config['protocol'] = 'smtp';
	 //        $config['smtp_host'] = 'ssl://smtp.googlemail.com';
	 //        $config['smtp_user'] = 'aliyyailmi20@gmail.com';
	 //        $config['smtp_pass'] = 'ilmi2007';
	 //        $config['smtp_port'] = 465;
	 //        $config['mailtype'] = 'html';
	 //        $config['charset'] = 'utf-8';

	 //        $this->email->set_newline("\r\n");
	 //        $this->email->initialize($config);
		// 	//$this->email->initialize($config);  //tambahkan baris ini
		// 	$this->email->from('aliyyailmi20@gmail.com', 'Project Management Primavisi Globalindo');
		// 	$this->email->to($this->input->post('email'));

		// 	if ($type == 'verify') {
		// 		$this->email->subject('Aktivasi Email');
		// 		$this->email->message('Klik link berikut untuk aktivasi akun anda : <a href="' . base_url() . 'auth/verify?email=' . $this->input->post('email') . '&token=' . urlencode($token) . '">Aktifkan</a>');
		// 	}
		// 	if ($this->email->send()){
		// 		return true;
		// 	}else{
		// 		echo $this->email->print_debugger();
		// 		die;
		// 	}
		// 	//$this->input->post('email',true)
		// }

		public function hapusDataEmployee($id)
		{
			//$this->db->where('nis', $id);
			$this->db->delete('user', ['id' => $id]);
			return 1;
		}
		
	    public function getEmployeById($id)
		{
			
			return $this->db->get_where('user' , ['id' => $id])->row_array();
		}

		public function getEmp($email)
		{
			
			return $this->db->get_where('user' , ['email' => $email])->row_array();
		}

		public function updatedata(){

				$data = [
			        
			        "name" => $this->input->post('nama',true),
			        "email" => $this->input->post('email',true),
			        "phone" => $this->input->post('telepon',true),
			        "role_id" => $this->input->post('role',true)
				];

			$this->db->where('id',$this->input->post('id'));
			$this->db->update('user',$data);
			}

		  public function hitungJumlahAsset()
				{   
				    $query = $this->db->get('user');
				    if($query->num_rows()>0)
				    {
				      return $query->num_rows();
				    }
				        else
				    {
				      return 0;
				    }
				}


             public function hitungJumlahTask()
				{   
				    $query = $this->db->get('task');
				    if($query->num_rows()>0)
				    {
				      return $query->num_rows();
				    }
				        else
				    {
				      return 0;
				    }
				}


		// public function updateDataEmployee()
		// {
		// 	$data = array(
		// 	"clientName" 			=> $this->input->post('clientName', true),
		// 	"clientPhone"           => $this->input->post('clientPhone', true),
		// 	"clientAddress" 		=> $this->input->post('clientAddress', true),
		// 	"clientCompany" 		=> $this->input->post('clientCompany', true)
		// 	);
		// 	$this->db->where('id', $this->input->post('id'));
		// 	$this->db->update('client', $data);
		// }

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