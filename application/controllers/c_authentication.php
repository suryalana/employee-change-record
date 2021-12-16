<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class C_authentication extends CI_Controller {

    public function __construct()
	{
		parent::__construct();		
		$this->load->model('M_authentication');
	}

    public function login(){

        // die('anda sudah di halaman login! silahkan login');

        if($this->M_authentication->is_LoggedIn()){
            redirect('ecr');    
        }

        $this->form_validation->set_rules('emp_id', 'Employee ID', 'required|callback_checkEmployeeID');
        $this->form_validation->set_rules('password', 'Password', 'required|callback_checkPassword');
        
        // die(var_dump(md5($this->input->post('password'))));
        $check_user = $this->M_authentication->get_user('emp_id', $this->input->post('emp_id'));

        // die($this->db->last_query());
        if($this->form_validation->run() === false){
            $data['title'] = 'PT CLADTEK BI-METAL MANUFACTURING';
	 			$this->load->view('templates/header', $data);
                 $this->load->view('v_login');
				$this->load->view('templates/footer');
           
        } 

        else {
            $user = $this->M_authentication->get_user('emp_id', $this->input->post('emp_id'));
            
            // set session
            $_SESSION['emp_id'] = $user['emp_id'];
            $_SESSION['full_name'] = $user['full_name'];
            $_SESSION['role'] = $user['role'];
            $_SESSION['logged_in'] = true;
            if($user['role']=='hrd' || $user['role']=='ceo' || $user['role']=='manager'){
                redirect('hrd');
            }
            else{
                redirect('ecr');
            }
            
        }
    }

    public function logout()
    {
        // unset($_SESSION['user_id'], $_SESSION['logged_in']);
        $this->session->sess_destroy();
        redirect('login');
    }

    public function checkEmployeeID($emp_id)
    {
        // Check email pada saat login
            if (!$this->M_authentication->get_user('emp_id', $emp_id)) { 
            $this->form_validation->set_message('checkEmployeeID', 'Employee Account not found!');
            return false;
            }

            return true;
    }

    public function checkPassword($password)
    {
        $user = $this->M_authentication->get_user('emp_id', $this->input->post('emp_id'));

        if (!$this->M_authentication->checkPassword($user['emp_id'], $password)) {
            $this->form_validation->set_message('checkPassword', 'Wrong Password');
            return false;
        }
        
        return true;
    }
   

    public function change()
    {
        $data['title'] = 'Change Password';
        $data['admin'] = $this->db->get_where('account', ['emp_id' =>
        $this->session->userdata('emp_id')])->row_array();

        $this->form_validation->set_rules('current_password', 'Current Password', 'required|trim');
        $this->form_validation->set_rules('new_password1', 'New Password', 'required|trim|min_length[3]|matches[new_password2]');
        $this->form_validation->set_rules('new_password2', 'Confirm New Password', 'required|trim|min_length[3]|matches[new_password1]');

        if ($this->form_validation->run() == false) {
            $this->load->view('v_changepass', $data);
        } else {
            $current_password = $this->input->post('current_password');
            $new_password = $this->input->post('new_password1');

            if (password_verify($current_password, $data['account']['password'])) {
                $this->session->set_flashdata('flash', '<div class="alert alert-danger" role="alert"> Wrong current password!</div>');
                redirect('c_authentication/change');
            } else {
                if ($current_password == $new_password) {
                    $this->session->set_flashdata('flash', '<div class="alert alert-danger" role="alert"> New password cannot be the same as current password! </div>');
                    redirect('c_authentication/change');
                } else {

                    $password_hash = md5($new_password);

                    $this->db->set('password', $password_hash);
                    $this->db->where('emp_id', $this->session->userdata('emp_id'));
                    $this->db->update('account');

                    $this->session->set_flashdata('flash', '<div class="alert alert-success" role="alert">Password changed!</div>');
                    redirect('c_authentication/change');
                }
            }
        }
    }
}