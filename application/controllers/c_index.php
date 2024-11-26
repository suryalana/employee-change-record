<?php
defined('BASEPATH') OR exit('No direct script access allowed');

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

//Load Composer's autoloader
require 'vendor/autoload.php';

class C_index extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->library('email');
		$this->load->model('m_index');
		$this->load->model('M_authentication');
	}

	public function Test()
	{
		die("its Work!");
	}

	public function index()
	{
		if(!$this->M_authentication->is_LoggedIn()){
            redirect('login');    
        }

		$data['input'] = $this->m_index->tampil();
		$data['status'] = $this->m_index->tampil_status();
		$data['departement'] = $this->m_index->tampil_departement();
		$data['division'] = $this->m_index->tampil_division();
		$data['choise'] = $this->m_index->tampil_choise();
		//$data['employee'] = $this->m_index->editEmployee($_COOKIE['gfg']); 

		$this->load->view('v_index', $data);
	}

	public function doAction($id = null, $role = null, $type = null)
	{
		if ($id == null && $role == null && $type == null) {
			$id = $this->input->post('id');
			$role = $this->input->post('role');
			$type = $this->input->post('type');
		}

		// $data_input = $this->m_index->tampil2('input' , ['id_erc' => $id])->result()[0];
		// die(var_dump($data->id_erc));

		switch ($role) {

			case 'user':
				if ($type == 'acc') {
					$data = array(
						'request_img' => 'acc'
					);
				}
			break;

			case 'hrd':
					if ($type == 'acc') {
						$data = array(
							'hrd_img' => 'acc'
						);
							
					}elseif ($type == 'reject') {
						$data = array(
							'hrd_img' => 'reject',
							'ceo_img' => 'reject'
						);
					}
				break;

			case 'ceo':
					if ($type == 'acc') {
						$data = array(
							'ceo_img' => 'acc',
							'hrd_img' => 'acc',
							'manager_img'=> 'acc',
						);
					}elseif ($type == 'reject') {
						$data = array(
							'hrd_img' => 'reject',
							'manager_img'=> 'reject',
							'ceo_img' => 'reject'
						);
					}
				break;

			case 'manager':
					if ($type == 'acc') {
						$data = array(
							'manager_img' => 'acc'
						);
					}elseif ($type == 'reject') {
						$data = array(
							'manager_img' => 'reject',
							'hrd_img' => 'reject',
							'ceo_img' => 'reject'
						);
					}
				break;
		}

		$this->m_index->updateInputData($data , $id);

		switch ($role) {
			case 'user':
					$tempRole = 'manager';
				break;

			case 'manager':
					$tempRole = 'hrd';
				break;

			case 'hrd':
					$tempRole = 'ceo';
				break;

			case 'ceo':
					$tempRole = 'complete';
				break;
			
			default:
				# code...
				break;
		}

		/* 
		1. SELECT ACCOUNT BERDASARKAN ROLE yang diinginkan
		2. Ambil data dari field "EMAIL" table "ACCOOUNT"
		3. Kita buat foreach(pengulangan pengiriman) email berdasarkan role yang diinginkan.

		foreach{...}

		*/

		// SELECT ACCOUNT BY ROLE
		// $dataAccount = $this->m_index->getDataByField('account','role', $tempRole);

		switch ($tempRole) {
			case 'manager':
					$dataErc = $this->m_index->getDataByField('input','id_erc', $id);
					// die(var_dump($dataErc[0]['manager_empid']));
					$empid = $dataErc[0]['manager_empid'];
					$ERCData = $dataErc[0];
				break;
			
			case 'ceo':
					$dataErc = $this->m_index->getDataByField('input','id_erc', $id);
					$empid = $dataErc[0]['ceo_empid'];
					$ERCData = $dataErc[0];
				break;

			case 'hrd':
					$dataErc = $this->m_index->getDataByField('input','id_erc', $id);
					$empid = $dataErc[0]['hrd_empid'];
					$ERCData = $dataErc[0];
				break;
			case 'complete':
					$dataErc = $this->m_index->getDataByField('input','id_erc', $id);
					$empid = $dataErc[0]['Employee_ID'];
					$ERCData = $dataErc[0];
				break;
			default:
				# code...
				break;
		}

		$dataEmployee = $this->m_index->getDataByField('employee','Employee_Number', $empid);
		$nameRequest = $ERCData['Name'];
		$reasonRequest = $ERCData['Reason_for_Change'];

		foreach ($dataEmployee as $dEmp) {
			$acclink = base_url().'approval/'.$id.'/'.$tempRole.'/acc/';
			$rejectlink = base_url().'approval/'.$id.'/'.$tempRole.'/reject/';
			$fullname = $dEmp["Name"];
		
			// Use double quotes for string interpolation
			if($tempRole == 'complete') {
				$textContent = "
				<html>
			<head>
				<title>Employee Change Record Approval</title>
			</head>
			<body>
				<p>Dear $fullname,</p>
				<br><br> Please be informed that the request for $nameRequest has been completed. <br><br> Thank you for your cooperation.
				<p>Best Regards,</p>
				<p>CLADTEK.</p>
			</body>
			</html>
			";
			} else {
				$textContent = "
			<html>
			<head>
				<title>Employee Change Record Approval</title>
			</head>
			<body>
				<p>Dear $fullname,</p>
				<p>You get new Request ECR from $nameRequest with reason : $reasonRequest.</p>
				<p>You can choose <b>Accept</b> or <b>Reject</b> the ECR Request by pressing one of the links below</p>
				<p>Link for Accept  : <a href='$acclink'>$acclink</a></p>
				<p>Link for Reject : <a href='$rejectlink'>$rejectlink</a></p>
				<p>Best Regards,</p>
				<p>CLADTEK.</p>
			</body>
			</html>
			";
			}
		
			$data = array(
				'title' => 'Employee Change Record Approval',
				'content' => $textContent,
				'email' => $dEmp['Email'],
			);
		
			if ($data) {
				$this->send_email_notification($data);
			}
			return $this->output
				->set_content_type('application/json')
				->set_status_header(200)
				->set_output(json_encode(array('status' => 'success', 'message' => 'Data saved successfully!')));
		}
	}

	public function Approve()
	{

		if(!$this->M_authentication->is_LoggedIn()){
            redirect('login');    
        }

		$data['input'] = $this->m_index->tampil();
		$data['status'] = $this->m_index->tampil_status();
		$data['departement'] = $this->m_index->tampil_departement();
		$data['division'] = $this->m_index->tampil_division();
		$data['choise'] = $this->m_index->tampil_choise();
		//$data['employee'] = $this->m_index->editEmployee($_COOKIE['gfg']); 

		$this->load->view('v_approve', $data);
	}

	public function Hrd(){
		if(!$this->M_authentication->is_LoggedIn()){
            redirect('login');    
        }
		$data['input'] = $this->m_index->tampil();
		// die(var_dump($data['input']));
		// $this->load->view('v_hrd', $data);
		$this->load->view('v_hrd_dt', $data);
	}

	public function Hrd2(){
		if(!$this->M_authentication->is_LoggedIn()){
            redirect('login');    
        }
		$data['input'] = $this->m_index->tampil();
		// die(var_dump($data['input']));
		$this->load->view('v_hrd', $data);
	}

	public function getHRDData(){
		if(!$this->M_authentication->is_LoggedIn()){
            redirect('login');    
        }
		$data = $this->m_index->getInputData();
		echo json_encode($data);
	}

	public function ubah($id_erc)
	{

		if(isset($_POST['btnUpdate'])) {
			// $option  		= $this->input->post('ops_employee');
			// $nama 			= $this->input->post('txt_name');
			// $emp_id			= $this->input->post('emp_id')[0];
			// $designantion 	= $this->input->post('txt_designantion');
			// $date 			= $this->input->post('txt_date');
			// $effective	 	= $this->input->post('txt_effective');
			// $reason		 	= $this->input->post('txt_reason');
			// $status		 	= $this->input->post('ops_status');
			$status1		= $this->input->post('ops_status1');
			// $departement 	= $this->input->post('ops_departement');
			$departement1 	= $this->input->post('ops_departement_to');
			// $division	 	= $this->input->post('ops_div');
			$division1	 	= $this->input->post('ops_div_to');
			// $immediate	 	= $this->input->post('txt_immediate');
			$immediate1	 	= $this->input->post('txt_immediate_to');
			// $des		 	= $this->input->post('txt_des');
			$des1		 	= $this->input->post('txt_des_to');
			// $salary		 	= $this->input->post('num_salary');
			$salary1		= $this->input->post('num_salary_to');
			// $amount		 	= $this->input->post('num_amount');
			$amount1		= $this->input->post('num_amount_to');
			// $overtime	 	= $this->input->post('num_overtime');
			$overtime1	 	= $this->input->post('num_overtime_to');
			// $other 		 	= $this->input->post('txt_other');
			$other1 		= $this->input->post('txt_other_to');
			// $remark 		= $this->input->post('txt_remark');
			// $acc 			= $this->input->post('cek_acc');
			// $acc1 			= $this->input->post('cek_acc1');
			// $acc2 			= $this->input->post('cek_acc2');
			// $acc3	 		= $this->input->post('cek_acc3');

			// $effective = date('Y-m-d', strtotime($effective));
			// $date = date('Y-m-d', strtotime($date));
			// die(var_dump($date));

			// die(var_dump($emp_id));



			//tambah field "_To"
			$data = array(
				// 'option' => $option,
				// 'Name' => $nama, 
				// 'Employee_ID' => $emp_id, 
				// 'Designantion' => $designantion, 
				// 'Date_of_Joining' => $date, 
				// 'Effective_Date_of_Change' => $effective, 
				// 'Reason_for_Change' => $reason,
				// 'Employment_Status' => $status,
				'Employment_Status_To' => $status1,
				// 'Department' => $departement,
				'Department_To' => $departement1 ?? null,
				// 'Division_Section_Station' => $division,
				'Division_Section_Station_To' => $division1,
				// 'Immediate_Superior' => $immediate,
				'Immediate_Superior_To' => $immediate1,
				// 'Des' => $des,
				'Des_To' => $des1,
				// 'Basic_Salary' => $salary,
				'Basic_Salary_To' => $salary1,
				// 'Allowances_Amount' => $amount,
				'Allowances_Amount_To' => $amount1,
				// 'Overtime_Rate' => $overtime,
				'Overtime_Rate_To' => $overtime1,
				// 'Others' => $other,
				'Others_To' => $other1,
				// 'request_img' => $acc,
				// 'manager_img' => $acc1,
				// 'hrd_img' => $acc2,
				// 'ceo_img' => $acc3,
				// 'Remark' => $remark
			);

			$this->m_index->update($data, $id_erc);
			redirect(base_url('hrd'));
		}else {
			$data['input'] = $this->m_index->tampilById($id_erc);
			// die(var_dump($this->db->last_query()));

			$data['status'] = $this->m_index->tampil_status();
			$data['departement'] = $this->m_index->tampil_departement();
			$data['division'] = $this->m_index->tampil_division();
			$data['choise'] = $this->m_index->tampil_choise();

			// $data['input'] = $this->m_index->edit($where);

			$this->load->view('v_editinput', $data);
		}
		
	}
	

	public function changeData(){
		$datas = $this->m_index->editEmployee($_COOKIE['gfg']); 
	}

	public function hapus($id)
	{
		$where = array(
			'Employee_ID' => $id
		);
		$this->m_index->hapus($where);
		redirect('c_index','refresh');
	}
	

	public function simpan()
	{

		// die(var_dump($this->input->post()));
		$option  		= $this->input->post('ops_employee');
		$nama 			= $this->input->post('txt_name');
		$emp_id			= $this->input->post('emp_id')[0];
		$designantion 	= $this->input->post('txt_designantion');
		$date 			= $this->input->post('txt_date');
		$effective	 	= $this->input->post('txt_effective');
		$reason		 	= $this->input->post('txt_reason');
		$status		 	= $this->input->post('ops_status');
		$status1		= $this->input->post('ops_status1');
		$departement 	= $this->input->post('ops_departement');
		$departement1 	= $this->input->post('ops_departement_to');
		$division	 	= $this->input->post('ops_div');
		$division1	 	= $this->input->post('ops_div_to');
		$immediate	 	= $this->input->post('txt_immediate');
		$immediate1	 	= $this->input->post('txt_immediate_to');
		$des		 	= $this->input->post('txt_des');
		$des1		 	= $this->input->post('txt_des_to');
		$salary		 	= $this->input->post('num_salary');
		$salary1		= $this->input->post('num_salary_to');
		$amount		 	= $this->input->post('num_amount');
		$amount1		= $this->input->post('num_amount_to');
		$overtime	 	= $this->input->post('num_overtime');
		$overtime1	 	= $this->input->post('num_overtime_to');
		$other 		 	= $this->input->post('txt_other');
		$other1 		= $this->input->post('txt_other_to');
		$remark 		= $this->input->post('txt_remark');
		$acc 			= $this->input->post('cek_acc');
		$manager_id 	= $this->input->post('managerid')[0];
		$ceo_id 		= $this->input->post('ceoid')[0];
		$hrd_id 		= $this->input->post('hrdid')[0];
		$acc1 			= $this->input->post('cek_acc1');
		$acc2 			= $this->input->post('cek_acc2');
		$acc3	 		= $this->input->post('cek_acc3');

		$effective = date('Y-m-d', strtotime($effective));
		$date = date('Y-m-d', strtotime($date));
		// die(var_dump($hrd_id));

		// die(var_dump($emp_id));

		if (empty($nama)) {
			echo "<script>alert('Name Empty!')</script>";
			redirect(base_url('c_index'),'refresh');
		}else  if (empty($designantion)) {
			echo "<script>alert('Designantion Empty!')</script>";
			redirect(base_url('c_index'),'refresh');
		}else if (empty($date)) {
			echo "<script>alert('Date Empty!')</script>";
			redirect(base_url('c_index'),'refresh');
		}else if (empty($effective)) {
			echo "<script>alert('Effective Empty!')</script>";
			redirect(base_url('c_index'),'refresh');
		}else if (empty($reason)) {
			echo "<script>alert('Reason Empty!')</script>";
			redirect(base_url('c_index'),'refresh');
		}else if (empty($status)) {
			echo "<script>alert('Employee Status Empty!')</script>";
			redirect(base_url('c_index'),'refresh');
		}else if (empty($departement)) {
			echo "<script>alert('Departement Empty!')</script>";
			redirect(base_url('c_index'),'refresh');
		}else if (empty($division)) {
			echo "<script>alert('Division Empty!')</script>";
			redirect(base_url('c_index'),'refresh');
		}else if (empty($immediate)) {
			echo "<script>alert('Immediate Empty!')</script>";
			redirect(base_url('c_index'),'refresh');
		}else if (empty($des)) {
			echo "<script>alert('Des Empty!')</script>";
			redirect(base_url('c_index'),'refresh');
		}else if (empty($salary)) {
			echo "<script>alert('Basic Salary Empty!')</script>";
			redirect(base_url('c_index'),'refresh');
		}else if (empty($amount)) {
			echo "<script>alert('Allowance Amount Empty!')</script>";
			redirect(base_url('c_index'),'refresh');
		}else if (empty($overtime)) {
			echo "<script>alert('Overtime Rate Empty!')</script>";
			redirect(base_url('c_index'),'refresh');
		}else if (empty($other)) {
			echo "<script>alert('Other Empty!')</script>";
			redirect(base_url('c_index'),'refresh');
		}


		//tambah field "_To"
		$data = array(
			'option' => $option,
			'Name' => $nama, 
			'Employee_ID' => $emp_id, 
			'Designantion' => $designantion, 
			'Date_of_Joining' => $date, 
			'Effective_Date_of_Change' => $effective, 
			'Reason_for_Change' => $reason,
			'Employment_Status' => $status,
			'Employment_Status_To' => $status1,
			'Department' => $departement,
			'Department_To' => $departement1,
			'Division_Section_Station' => $division,
			'Division_Section_Station_To' => $division1,
			'Immediate_Superior' => $immediate,
			'Immediate_Superior_To' => $immediate1,
			'Des' => $des,
			'Des_To' => $des1,
			'Basic_Salary' => $salary,
			'Basic_Salary_To' => $salary1,
			'Allowances_Amount' => $amount,
			'Allowances_Amount_To' => $amount1,
			'Overtime_Rate' => $overtime,
			'Overtime_Rate_To' => $overtime1,
			'Others' => $other,
			'Others_To' => $other1,
			'request_img' => $acc,
			'manager_empid' => $manager_id,
			'manager_img' => $acc1,
			'hrd_empid' => $hrd_id,
			'hrd_img' => $acc2,
			'ceo_empid' => $ceo_id,
			'ceo_img' => $acc3,
			'Remark' => $remark
		);

		// Upload Gambar 

		if ($this->m_index->simpan($data)) {
			$id_erc = $this->db->insert_id();
			// die(var_dump('Inserted id : '.$id_erc));
			$this->doAction($emp_id, 'user', 'acc', $id_erc);
		}		


		echo "<script>alert('Data saved successfully!')</script>";
		redirect(base_url('c_index'),'refresh');
		
	}

	public function uploadImage($name)
	{
			$config['upload_path']          = './assets/approve/';
			$config['allowed_types']        = 'jpg|png';
			$config['max_size']             = 1000;
			$config['remove_space'] 		= TRUE;
			// $config['max_width']            = 1024;
			// $config['max_height']           = 768;

			$this->load->library('upload', $config);

			if($this->upload->do_upload($name)){ // Lakukan upload dan Cek jika proses upload berhasil
				// Jika berhasil :
				$return = array('result' => 'success', 'file' => $this->upload->data(), 'error' => '');
				return $return;
			}else{
				// Jika gagal :
				$return = array('result' => 'failed', 'file' => '', 'error' => $this->upload->display_errors());
				return $return;
			}
	}

	function get_autocompleteEmployee(){
        if ($this->input->post('searchTerm')) {
            $result = $this->m_index->search_Employee($this->input->post('searchTerm'));

            echo json_encode($result);
			// echo var_dump($result);
			// echo $result;
        }
    }

	function get_autocompleteManager(){
        $result = $this->m_index->search_Manager($this->input->post('searchTerm') ?? null);

		echo json_encode($result);
    }

	function get_autocompleteCeo(){
        $result = $this->m_index->search_Ceo($this->input->post('searchTerm') ?? null);

		echo json_encode($result);
    }

	function get_autocompleteHrd(){
        $result = $this->m_index->search_Hrd($this->input->post('searchTerm') ?? null);

		echo json_encode($result);
    }

	function get_DivisionCategory(){
        $div_id = $this->input->post('id',TRUE);
        $data = $this->m_index->ambil_DivisionCategory($div_id)->result();
		// $data = $this->db->last_query();
        echo json_encode($data);
    }	

	public function send_email_notification($data = null) {
		// Email configuration
		$config = array(
			'protocol'  => 'smtp',
			'smtp_host' => 'ssl://smtp.gmail.com',
			'smtp_port' => 465, // or 465 for SSL
			'smtp_user' => 'suryaa25lana@gmail.com',
			'smtp_pass' => 'ggsw vkfs mvit nwge',
			'mailtype'  => 'html', // or 'text'
			'charset'   => 'utf-8',
			'newline'   => "\r\n",
		);
	
		// Initialize the email library with the config
		$this->email->initialize($config);
		
		// Set email parameters
		$this->email->from('suryaa25lana@gmail.com', 'Surya Lana');
		if ($data == null) {
			$this->email->to('beemons123@gmail.com');
			$this->email->subject('Email Notification');
			$this->email->message('This is a test email notification.');
		}else{
			$this->email->to($data['email']);
			$this->email->subject($data['title']);
			$this->email->message($data['content']);
		}
	
		// Send the email
		if ($this->email->send()) {
			return true;
		} else {
			show_error($this->email->print_debugger());
		}
	}

	function sendEmail(){
		$this->send_email_notification();
	}

	function exportPDF(){
		$data['emp'] = $this->m_index->tampilById('7');
		// die(var_dump($data));
		$this->load->library('pdf');
		$html = $this->load->view('v_exportPDF', $data, true);
		$this->pdf->createPDF($html, 'mypdf', false);
	}
}

/* End of file c_index.php */
/* Location: ./application/controllers/c_index.php */
