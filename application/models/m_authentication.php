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

}