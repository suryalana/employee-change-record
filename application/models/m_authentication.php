<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_authentication extends CI_Model {

    public function is_LoggedIn()
    {
        // menguji session
        if(!isset($_SESSION['logged_in'])){
            return false;
        }	
        return true;
    }

    public function get_user($key, $value){       
        $query = $this->db->get_where('account', array($key=>$value));
        if(!empty($query->row_array())){
            return $query->row_array();
            // die($query->row_array());
        }

        return false;
    }

    public function checkPassword($emp_id, $password)
    {
        $hash = $this->get_user('emp_id', $emp_id)['password'];
            if (md5($password) === $hash) {
                return true;
            }

        return false;
    }


    
    public function changePassword()
    {
        $data['title'] = 'Change Password';
        $data['admin'] = $this->db->get_where('admin', ['username' =>
        $this->session->userdata('username')])->row_array();

        $this->form_validation->set_rules('current_password', 'Current Password', 'required|trim');
        $this->form_validation->set_rules('new_password1', 'New Password', 'required|trim|min_length[3]|matches[new_password2]');
        $this->form_validation->set_rules('new_password2', 'Confirm New Password', 'required|trim|min_length[3]|matches[new_password1]');

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header_login');
            $this->load->view('templates/header', $data);
            $this->load->view('templates/dashboard', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('home/changepassword', $data);
            $this->load->view('templates/footer');
            $this->load->view('templates/footer_login');
        } else {
            $current_password = $this->input->post('current_password');
            $new_password = $this->input->post('new_password1');

            if (password_verify($current_password, $data['admin']['password'])) {
                $this->session->set_flashdata('flash', '<div class="alert alert-danger" role="alert"> Wrong current password!<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
                redirect('login/changePassword');
            } else {
                if ($current_password == $new_password) {
                    $this->session->set_flashdata('flash', '<div class="alert alert-danger" role="alert"> New password cannot be the same as current password!<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button> </div>');
                    redirect('login/changePassword');
                } else {

                    $password_hash = md5($new_password);

                    $this->db->set('password', $password_hash);
                    $this->db->where('username', $this->session->userdata('username'));
                    $this->db->update('admin');

                    $this->session->set_flashdata('flash', '<div class="alert alert-success" role="alert">Password changed!<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
                    redirect('login/changePassword');
                }
            }
        }
    }

    public function change()
    {
        $data['title'] = 'Change Password';
        $data['admin'] = $this->db->get_where('admin', ['username' =>
        $this->session->userdata('username')])->row_array();

        $this->form_validation->set_rules('current_password', 'Current Password', 'required|trim');
        $this->form_validation->set_rules('new_password1', 'New Password', 'required|trim|min_length[3]|matches[new_password2]');
        $this->form_validation->set_rules('new_password2', 'Confirm New Password', 'required|trim|min_length[3]|matches[new_password1]');

        if ($this->form_validation->run() == false) {
            $this->load->view('home/change', $data);
        } else {
            $current_password = $this->input->post('current_password');
            $new_password = $this->input->post('new_password1');

            if (password_verify($current_password, $data['admin']['password'])) {
                $this->session->set_flashdata('flash', '<div class="alert alert-danger" role="alert"> Wrong current password!</div>');
                redirect('login/change');
            } else {
                if ($current_password == $new_password) {
                    $this->session->set_flashdata('flash', '<div class="alert alert-danger" role="alert"> New password cannot be the same as current password! </div>');
                    redirect('login/change');
                } else {

                    $password_hash = md5($new_password);

                    $this->db->set('password', $password_hash);
                    $this->db->where('username', $this->session->userdata('username'));
                    $this->db->update('admin');

                    $this->session->set_flashdata('flash', '<div class="alert alert-success" role="alert">Password changed!</div>');
                    redirect('login/change');
                }
            }
        }
    }

}