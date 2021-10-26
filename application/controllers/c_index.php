<?php
defined('BASEPATH') OR exit('No direct script access allowed');

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
		$data['input'] = $this->m_index->tampil();
		$data['status'] = $this->m_index->tampil_status();
		$data['departement'] = $this->m_index->tampil_departement();
		$data['division'] = $this->m_index->tampil_division();
		$data['choise'] = $this->m_index->tampil_choise();
		//$data['employee'] = $this->m_index->editEmployee($_COOKIE['gfg']); 

		$this->load->view('v_index', $data);
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
	public function changeData(){
		$datas = $this->m_index->editEmployee($_COOKIE['gfg']); 
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
		$acc1 			= $this->input->post('cek_acc1');
		$acc2 			= $this->input->post('cek_acc2');
		$acc3	 		= $this->input->post('cek_acc3');

		$effective = date('Y-m-d', strtotime($effective));
		$date = date('Y-m-d', strtotime($date));
		// die(var_dump($date));

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
			'manager_img' => $acc1,
			'hrd_img' => $acc2,
			'ceo_img' => $acc3,
			'Remark' => $remark
		);

		// Upload Gambar 

		$upload = $this->uploadImage('imgApprove1');
		// die(var_dump([$upload]));
		if ($_FILES['imgApprove1']['size'] == 0) {
			// if nothing upload file
			$this->m_index->simpan($data);
			redirect(base_url('index.php/c_index'),'refresh');
		} else {
			if($upload['result'] == "success"){ // Jika proses upload sukses

				$data['request_img'] = $upload['file']['file_name'];

				$this->m_index->simpan($data);
				redirect(base_url('index.php/c_index'),'refresh');

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

	function get_DivisionCategory(){
        $div_id = $this->input->post('id',TRUE);
        $data = $this->m_index->ambil_DivisionCategory($div_id)->result();
		// $data = $this->db->last_query();
        echo json_encode($data);
    }

	
}

/* End of file c_index.php */
/* Location: ./application/controllers/c_index.php */
