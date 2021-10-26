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
        $this->load->library('pdf');
        $data['input'] = $this->m_index->tampil();
        $html = $this->load->view('GeneratePdfView', $data, [], true);
        $this->pdf->createPDF($html, 'mypdf', false);
    }
}
?>
