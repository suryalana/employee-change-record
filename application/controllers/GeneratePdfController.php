<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class GeneratePdfController extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        
        $this->load->model('m_index');
    }

    function index()
    {
		$empid=$this->uri->segment(3);
		$this->load->library('pdf');
		//$track= $this->Main_model->view_detail('oc', array('TrackingNum' => $trackid ))->row_array();  
        $emp= $this->m_index->tampil2('input', array('Employee_ID' => $empid))->row();
        $data = array('input'=> $emp);  
		$html = $this->load->view('GeneratePdfView', $data,true);
        $this->pdf->createPDF($html, 'mypdf', false);
		//echo json_encode($emp);
    }
}
?>
