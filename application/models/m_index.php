<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_index extends CI_Model
{

	public function getDataByField($table, $key, $value)
	{
		$query = $this->db->get_where($table, array($key => $value));
		if (!empty($query->result_array())) {
			return $query->result_array();
			// die($query->row_array());
		}

		return false;
	}

	public function simpan($data)
	{
		if ($this->db->insert('input', $data)) {
			return TRUE;
		}

		return FALSE;
	}

	public function update($data, $id_erc)
	{
		$this->db->set($data);
		$this->db->where('id_erc', $id_erc);
		$this->db->update('input');
	}


	public function tampil()
	{
		return $this->db->get('input')->result();
		//return $this->db->get_where($table, $data);
	}

	public function tampil2($table, $data)
	{
		//return $this->db->get('input')->result();
		return $this->db->get_where($table, $data);
	}

	public function tampilById($id_erc)
	{
		$this->db->select('*');
		$this->db->from('input');
		$this->db->join('departement', 'input.Department_To = departement.id_departement', 'left');
		$this->db->join('division', 'departement.id_departement = division.department_id', 'left');
		$this->db->where('id_erc', $id_erc);
		$data = $this->db->get()->result();
		return $data;
	}

	public function tampil_status()
	{
		return $this->db->get('employee_status')->result();
	}

	public function tampil_departement()
	{
		return $this->db->get('departement')->result();
	}

	public function tampil_division()
	{
		return $this->db->get('division')->result();
	}

	public function tampil_choise()
	{
		return $this->db->get('choise')->result();
	}

	public function edit($where)
	{
		return $this->db->get_where('input', $where)->result();
	}

	public function editEmployee($where)
	{
		return $this->db->get_where('employee', $where)->result();
	}

	public function update_data($data, $where)
	{
		$this->db->where('Employee_ID', $where);
		$this->db->update('input', $data);
	}

	public function updateInputData($data, $id)
	{
		$this->db->where('id_erc', $id);
		$this->db->update('input', $data);
	}

	public function hapus($where)
	{
		$this->db->delete('input', $where);
	}

	function search_Employee($id_employee)
	{
		// $this->db->select('*');
		$this->db->like('employee_number', $id_employee, 'both');
		$this->db->order_by('employee_number', 'ASC');
		$this->db->limit(3);
		$raw_result = $this->db->get('employee')->result_array();
		// return $this->db->get('tbl_rack')->result();

		$data = array();
		foreach ($raw_result as $item) {
			$date = new DateTime($item['Join_Date']);
			$doj = $date->format('m/d/Y');
			$data[] = array(
				"id"    =>  $item['Employee_Number'],
				"text"  =>  $item['Employee_Number'],
				"fullname"  =>  $item['Name'],
				"designation"  =>  $item['Designation'],
				"doj"  => $doj,
			);
		}

		// $data = var_dump($raw_result);
		return $data;
	}

	function search_Manager($id_employee)
	{
		// Select all columns from the account table and the employee table
		$this->db->select('account.*, employee.*'); // You can specify the columns you need
		$this->db->from('account'); // Specify the main table

		// Join with the employee table
		$this->db->join('employee', 'account.emp_id = employee.Employee_Number', 'inner'); // Use inner join

		// Add the condition to filter by role
		$this->db->where('account.role', 'manager'); // Ensure to prefix with table name if necessary
		if (!is_null($id_employee)) {
			$this->db->where('account.emp_id', $id_employee); // Filter by employee ID
		}

		// Limit the results to 3
		$this->db->limit(10);

		// Execute the query and get the result
		$raw_result = $this->db->get()->result_array();

		// die(var_dump($this->db->last_query()));

		$data = array();
		foreach ($raw_result as $item) {
			$date = new DateTime($item['Join_Date']);
			$doj = $date->format('m/d/Y');
			$data[] = array(
				"id"          => sprintf('%04d', $item['emp_id']),
				"text"        => sprintf('%04d', $item['emp_id']) . ' - ' . $item['full_name'],
				"fullname"    => $item['full_name'],
				"designation" => $item['Designation'],
				"doj"         => $doj,
			);
		}
		return $data;
	}


	function search_Ceo($id_employee)
	{
		// Select all columns from the account table and the employee table
		$this->db->select('account.*, employee.*'); // You can specify the columns you need
		$this->db->from('account'); // Specify the main table

		// Join with the employee table
		$this->db->join('employee', 'account.emp_id = employee.Employee_Number', 'inner'); // Use inner join

		// Add the condition to filter by role
		$this->db->where('account.role', 'ceo'); // Ensure to prefix with table name if necessary
		if (!is_null($id_employee)) {
			$this->db->where('account.emp_id', $id_employee); // Filter by employee ID
		}

		// Limit the results to 3
		$this->db->limit(10);

		// Execute the query and get the result
		$raw_result = $this->db->get()->result_array();

		// die(var_dump($this->db->last_query()));

		$data = array();
		foreach ($raw_result as $item) {
			$date = new DateTime($item['Join_Date']);
			$doj = $date->format('m/d/Y');
			$data[] = array(
				"id"          => sprintf('%04d', $item['emp_id']),
				"text"        => sprintf('%04d', $item['emp_id']) . ' - ' . $item['full_name'],
				"fullname"    => $item['full_name'],
				"designation" => $item['Designation'],
				"doj"         => $doj,
			);
		}
		return $data;
	}


	function search_Hrd($id_employee)
	{
		// Select all columns from the account table and the employee table
		$this->db->select('account.*, employee.*'); // You can specify the columns you need
		$this->db->from('account'); // Specify the main table

		// Join with the employee table
		$this->db->join('employee', 'account.emp_id = employee.Employee_Number', 'inner'); // Use inner join

		// Add the condition to filter by role
		$this->db->where('account.role', 'hrd'); // Ensure to prefix with table name if necessary
		if (!is_null($id_employee)) {
			$this->db->where('account.emp_id', $id_employee); // Filter by employee ID
		}

		// Limit the results to 3
		$this->db->limit(10);

		// Execute the query and get the result
		$raw_result = $this->db->get()->result_array();

		// die(var_dump($this->db->last_query()));

		$data = array();
		foreach ($raw_result as $item) {
			$date = new DateTime($item['Join_Date']);
			$doj = $date->format('m/d/Y');
			$data[] = array(
				"id"          => sprintf('%04d', $item['emp_id']),
				"text"        => sprintf('%04d', $item['emp_id']) . ' - ' . $item['full_name'],
				"fullname"    => $item['full_name'],
				"designation" => $item['Designation'],
				"doj"         => $doj,
			);
		}
		return $data;
	}

	function searchErc($id_employee)
	{
		// $this->db->select('*');
		$this->db->from('input');
		$this->db->join('employee', 'Employee_ID = Employee_Number');
		$this->db->join('division', 'Division_Section_Station = id_division ');
		// $this->db->where('Employee_ID', $id_employee );
		$this->db->order_by('Employee_ID', 'ASC');
		$this->db->limit(3);
		$raw_result = $this->db->get()->result_array();
		// return $this->db->get('tbl_rack')->result();
		// die($this->db->last_query());
		$data = array();
		foreach ($raw_result as $item) {
			$data[] = array(
				"Employee_ID"    				=>  $item['Employee_ID'],
				"Reason_for_Change"    			=>  $item['Reason_for_Change'],
				"Designation"    				=>  $item['Designantion'],
				"Employment_Status"  			=>  $item['Employment_Status'],
				"Employment_Status_To"  		=>  $item['Employment_Status_To'],
				"Department"  					=>  $item['Department'],
				"Department_To"  				=>  $item['Department_To'],
				"Division_Section_Station"  	=>  $item['Division_Section_Station'],
				"Division_Section_Station_To"  	=>  $item['Division_Section_Station_To'],
				"Section"  						=>  $item['Section'],
				// "Section_To"  =>  $item['Section_To'],
				"Immediate_Superior"  			=>  $item['Immediate_Superior'],
				"Immediate_Superior_To"  		=>  $item['Immediate_Superior_To'],
				"Basic_Salary"  				=>  $item['Basic_Salary'],
				"Basic_Salary_To"  				=>  $item['Basic_Salary_To'],
				"Allowances_Amount"  			=>  $item['Allowances_Amount'],
				"Allowances_Amount_To"  		=>  $item['Allowances_Amount_To'],
				"Overtime_Rate"  				=>  $item['Overtime_Rate'],
				"Overtime_Rate_To"  			=>  $item['Overtime_Rate_To'],
				"Others"  						=>  $item['Others'],
				"Others_To"  					=>  $item['Others_To'],
			);
		}

		// $data = var_dump($raw_result);
		return $data;
	}

	function ambil_DivisionCategory($div_id)
	{
		$query = $this->db->get_where('division', array('department_id' => $div_id));
		return $query;
	}
}

/* End of file m_index.php */
/* Location: ./application/models/m_index.php */
