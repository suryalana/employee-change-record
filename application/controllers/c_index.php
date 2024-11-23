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

	public function doAction($id = null, $role = null, $type = null, $id_erc = null)
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
							'hrd_img' => 'acc',
							'ceo_img' => 'acc'
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
					redirect('login');
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
					$dataErc = $this->m_index->getDataByField('input','id_erc', $id_erc);
					// die(var_dump($dataErc[0]['manager_empid']));
					$empid = $dataErc[0]['manager_empid'];
				break;
			
			case 'ceo':
					$dataErc = $this->m_index->getDataByField('input','id_erc', $id_erc);
					$empid = $dataErc[0]['ceo_empid'];
				break;

			case 'hrd':
					$dataErc = $this->m_index->getDataByField('input','id_erc', $id_erc);
					$empid = $dataErc[0]['hrd_empid'];
				break;
			case 'complete':
					$dataErc = $this->m_index->getDataByField('input','id_erc', $id_erc);
					$empid = $dataErc[0]['hrd_empid'];
				break;
			default:
				# code...
				break;
		}


		// die(var_dump('Employee id Destination: '.$empid));
		$dataAccount = $this->m_index->getDataByField('account','emp_id', $empid);
		// die(var_dump($this->db->last_query()));
		// die(var_dump($dataAccount));

		foreach ($dataAccount as $dAcc) {
			$acclink = base_url().'approval/'.$id.'/'.$tempRole.'/acc/'.$id_erc;
			$rejectlink = base_url().'approval/'.$id.'/'.$tempRole.'/reject/'.$id_erc;
			$fullname = $dAcc["full_name"];

			$textContent = <<<HEREDOC
			Dear $fullname $division , Penerima berikut adalah link untuk menyetujui Employee change record karyawan. untuk menyetujui klik link pada di bawah ini.

			Link for Accept  : $acclink

			Link for Reject : $rejectlink

			Best Regards, 
			CLADTEK.

			HEREDOC;
			$data = array(
				'title' => 'Employee change Record approval',
				'content' => $textContent,
				'email' => $dAcc['email'],
				'nama' => $dAcc['full_name'], 
			);

			// if ($this->sendEmail($data)) {
		echo "<script>alert('Data saved successfully!')</script>";
		redirect(base_url('c_index'),'refresh');
				// redirect('login'); aaaa
			// }else {
			// 	die('Failed To send email');
			// }
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
		$this->load->view('v_hrd', $data);
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

		// die('lol');
		$upload = $this->uploadImage('imgApprove1');
		// die(var_dump([$upload]));
		if ($_FILES['imgApprove1']['size'] == 0) {
			// if nothing upload file

			if ($this->m_index->simpan($data)) {
				$id_erc = $this->db->insert_id();
				// die(var_dump('Inserted id : '.$id_erc));
				$this->doAction($emp_id, 'user', 'acc', $id_erc);
			}		


			echo "<script>alert('Data saved successfully!')</script>";
			redirect(base_url('c_index'),'refresh');
			// redirect(base_url('logout'),'refresh');
		} else {
			if($upload['result'] == "success"){ // Jika proses upload sukses

				$data['request_img'] = $upload['file']['file_name'];

				$this->m_index->simpan($data);
				echo "<script>alert('Data saved successfully!')</script>";
				redirect(base_url('c_index'),'refresh');
				// redirect(base_url('logout'),'refresh');

			}else{ // Jika proses upload gagal

				die(var_dump($upload));
				echo "<script>alert('Failed to Upload Approval Picture! ') </script>";
				redirect(base_url('c_index'),'refresh');
			}
		} 
		
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

	public function sendEmail($data)
	{

		/* 
			1. Judul
			2. Nama Penerima
			3. Content
			4. Link
		*/
		//Create an instance; passing `true` enables exceptions
		$mail = new PHPMailer(true);

		$judul = $data['title'];
		$content = $data['content'];
		$email = $data['email'];
		$penerima = $data['nama'];

		// $no_invoice = $_POST['no_invoice'];
		// $nama = $_POST['nama_pengirim'];
		// $email = $_POST['email'];

		
		// $no_invoice = '111';
		// $nama_tujuan= 'LIPP';
		// $email = 'alipsayyidah102@gmail.com';
	
	
		//Server settings
		// $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
		$mail->isSMTP();                                            //Send using SMTP
		$mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
		$mail->SMTPAuth   = true;                                   //Enable SMTP authentication
		$mail->Username   = 'alipsayyidah102@gmail.com';                     //SMTP username
		$mail->Password   = 'Sriyani25';                               //SMTP password
		//$mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
		$mail->Port       = 587;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`
	
		//Recipients
		$mail->setFrom('alipsayyidah102@gmail.com', 'surya');
		$mail->addAddress($email);     //Add a recipient
																 //Name is optional
		// $mail->addReplyTo('fernando.siboro@cladtek.com', 'surya');
		// $mail->addReplyTo('alipsayyidah102@gmail.com', 'surya');
		// $mail->addCC('cc@example.com');
		// $mail->addBCC('bcc@example.com');
	
		//Attachments
		// $mail->addAttachment('/var/tmp/file.tar.gz');         //Add attachments
		// $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    //Optional name
	
		//Content
		$mail->isHTML(true);                                  //Set email format to HTML
		$mail->Subject = $judul;
		$mail->Body    = $content;
		
		if($mail->send())
		{
			return TRUE;
		}
		else{
			return FALSE;
		}
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
