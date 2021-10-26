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
            redirect('approve');    
        }

        $this->form_validation->set_rules('emp_id', 'Employee ID', 'required|callback_checkEmployeeID');
        $this->form_validation->set_rules('password', 'Password', 'required|callback_checkPassword');
        
        // die(var_dump(md5($this->input->post('password'))));
        $check_user = $this->M_authentication->get_user('emp_id', $this->input->post('emp_id'));

        // die($this->db->last_query());
        if($this->form_validation->run() === false){
            $this->load->view('v_login');
        } 

        else {
            $user = $this->M_authentication->get_user('emp_id', $this->input->post('emp_id'));
            
            // set session
            $_SESSION['emp_id'] = $user['emp_id'];
            $_SESSION['full_name'] = $user['full_name'];
            $_SESSION['role'] = $user['role'];
            $_SESSION['logged_in'] = true;
            if($user['role']=='hrd'){
                redirect('hrd');
            }
            else{
                redirect('approve');
            }
            
        }
    }

    public function logout()
    {
        // unset($_SESSION['user_id'], $_SESSION['logged_in']);
        $this->session->sess_destroy();
        redirect('ecr');
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

}