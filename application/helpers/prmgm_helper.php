<?php 
	// session_start();
	function is_logged_in()
	{
		$ci = get_instance();
		if (!$_SESSION['user']['email']) {
			redirect('auth');
		}
	}
	function is_admin($role_id)
	{
		if($role_id != 1){
			redirect('auth/blocked');		
		}
	}
	function is_permitted($role_id)
	{
		if($role_id > 2){
			redirect('auth/blocked');		
		}else{
			return true;
		}
	}
	function is_pm_above($role_id)
	{
		if($role_id < 4){
			return true;
		}else{
			redirect('auth/blocked');	
			return false;
		}
	}
	function is_pm_or_above($role_id)
	{
		if($role_id < 4){
			return true;
		}else{
			// redirect('auth/blocked');	
			return false;
		}
	}
	function is_pm($role_id)
	{
		if($role_id == 3){
			return true;
		}else{
			return false;
		}
	}
	function is_admin_or_support($role_id)
	{
		if($role_id < 3){
			return true;
		}else{
			// redirect('auth/blocked');	
			return false;
		}
	}
	function is_this_task_mine($task_assignee)
	{
		$ci = get_instance();
		if ($_SESSION['user']['emp_id'] == $task_assignee || $_SESSION['user']['role_id'] < 4) {
			return true;
		}else{
			return false;
		}
	}
	function is_this_project_mine($prj_pm)
	{
		$ci = get_instance();
		if ($_SESSION['user']['emp_id'] == $prj_pm || $_SESSION['user']['role_id'] < 3) {
			return true;
		}else{
			return false;
		}
	}
	function is_this_my_project($prj_pm)
	{
		$ci = get_instance();
		if ($_SESSION['user']['emp_id'] == $prj_pm || $_SESSION['user']['role_id'] < 3) {
			return true;
		}else{			
			redirect('auth/blocked');
			return false;
		}
	}
		function _sendEmail($token, $type)
		{
			$ci = get_instance();
			// $config = [
			// 	'protocol'  => 'smtp',
			// 	'smtp_host' => 'ssl://smtp.googlemail.com',
			// 	'smtp_user' => 'aliyyailmi20@gmail.com',
			// 	'smpt_pass' => 'ilmi2007',
			// 	'smtp_port' => 465,
			// 	'mailtype' => 'html',
			// 	'charset'   => 'utf-8',
			// 	'newline'   => "\r\n"
			// ];

			$ci->load->library('email');
			$config = array();
	        $config['protocol'] = 'smtp';
	        $config['smtp_host'] = 'ssl://smtp.googlemail.com';
	        $config['smtp_user'] = 'aliyyailmi20@gmail.com';
	        $config['smtp_pass'] = 'ilmi2007';
	        $config['smtp_port'] = 465;
	        $config['mailtype'] = 'html';
	        $config['charset'] = 'utf-8';

	        $ci->email->set_newline("\r\n");
	        $ci->email->initialize($config);
			//$ci->email->initialize($config);  //tambahkan baris ini
			$ci->email->from('aliyyailmi20@gmail.com', 'Project Management Primavisi Globalindo');
			$ci->email->to($ci->input->post('email'));

			if ($type == 'forgot') {
				$ci->email->subject('Reset Password');
				$ci->email->message('Klik link berikut untuk reset password akun anda : <a href="' . base_url() . 'auth/resetpassword?email=' . $ci->input->post('email') . '&token=' . urlencode($token) . '">Reset password</a>');
			}else if ($type == 'verify') {
				$ci->email->subject('Aktivasi Email');
				$ci->email->message('Klik link berikut untuk aktivasi akun anda : <a href="' . base_url() . 'auth/verify?email=' . $ci->input->post('email') . '&token=' . urlencode($token) . '">Aktifkan</a>');
			}else if ($type == 'assigneePM') {
				$ci->email->to($token['pmdata']['email']);
				$ci->email->subject('New Project');
				$ci->email->message('Anda telah dipilih untuk menjadi Projek Manager dalam projek : <br>
									 Nama Projek : '.$token['projName'].'<br>
									 Start Date  : '.$token['projStartDate'].'<br>
									 End Date    : '.$token['projEndDate'].'<br>
									 Untuk informasi lebih lengkap silakan klik link berikut untuk login ke sistem : <a href="' . base_url() . '">Login</a>
									');
			}else if ($type == 'updateproject') {
				$ci->email->to($token['pmdata']['email']);
				$ci->email->subject('Update Project');
				$ci->email->message('Projek telah diupdate : <br>
									 Nama Projek : '.$token['projName'].'<br>
									 Start Date  : '.$token['projStartDate'].'<br>
									 End Date    : '.$token['projEndDate'].'<br>
									 Progress    : '.$token['projProgress'].'<br>
									 Untuk informasi lebih lengkap silakan klik link berikut untuk login ke sistem : <a href="' . base_url() . '">Login</a>
									');
			}else if($type == 'assigneeTask'){
				$ci->email->to($token['empdata']['email']);
				$ci->email->subject('New Task');
				$ci->email->message('Anda telah dilibatkan dalam suatu projek dan ditugaskan untuk menangani task berikut : <br>
									 Nama Project   : '.$token['projName'].'<br>
									 PM             : '.$token['pmdata']['name'].'<br>
									 Nama Task      : '.$token['name'].'<br>
									 Start Date     : '.$token['startDate'].'<br>
									 End Date       : '.$token['endDate'].'<br>
									 Untuk informasi lebih lengkap silakan klik link berikut untuk login ke sistem : <a href="' . base_url() . '">Login</a>
									');
			}
			if ($ci->email->send()){
				return true;
			}else{
				echo $ci->email->print_debugger();
				die;
			}
			//$ci->input->post('email',true)
		}

?>