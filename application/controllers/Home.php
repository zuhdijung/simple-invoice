<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {
	public function __construct(){
		parent::__construct();
		$this->load->model('minvoice');		
	}
	public function index(){
		// fetch all invoice header
		$data['results'] = $this->minvoice->fetchAllInvoiceHeader();
		$this->load->view('vhome',$data);
	}
	public function addInvoice(){
		// get new invoice id in case user want to add new invoice
		$data['invoiceID'] = $this->minvoice->latestinvoiceID();

		$this->form_validation->set_rules('invoiceID','Invoice ID','required');
		$this->form_validation->set_rules('issueDate','Issue Date','required');
		$this->form_validation->set_rules('dueDate','Due Date','required');
		$this->form_validation->set_rules('subject','Subject','required');
		$this->form_validation->set_rules('sender','Sender Name','required');
		$this->form_validation->set_rules('receiver','Receiver','required');
		$this->form_validation->set_error_delimiters('<div class="alert alert-danger alert-dismissible fade show">', '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>');
		if(!$this->form_validation->run()){
			$this->load->view('vaddinvoice',$data);
		}
		else{
			$this->minvoice->saveInvoiceHeader();
			redirect('home/detailInvoice/'.$data['invoiceID']);
		}
	}
	public function editInvoice(){
		// get invoice id 
		$id = $this->uri->segment(3);
		$data['result'] = $this->minvoice->getInvoice($id);
		if($data['result'] == false) 
			redirect();

		$this->form_validation->set_rules('issueDate','Issue Date','required');
		$this->form_validation->set_rules('dueDate','Due Date','required');
		$this->form_validation->set_rules('subject','Subject','required');
		$this->form_validation->set_rules('sender','Sender Name','required');
		$this->form_validation->set_rules('receiver','Receiver','required');
		$this->form_validation->set_error_delimiters('<div class="alert alert-danger alert-dismissible fade show">', '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>');
		if(!$this->form_validation->run()){
			$this->load->view('veditinvoice',$data);
		}
		else{
			$this->minvoice->editInvoiceHeader($id);
			redirect('');
		}
	}
	public function printInvoice(){
		// get invoice id 
		$id = $this->uri->segment(3);
		$data['result'] = $this->minvoice->getInvoice($id);
		if($data['result'] == false) 
			redirect();

		$this->form_validation->set_rules('submit','Item Type','required');
		if(!$this->form_validation->run()){
			$data['results'] = $this->minvoice->fetchDetailInvoice($id);
			$this->load->view('vprintinvoice',$data);
		}
		else{
			
		}
	}	
	public function payInvoice(){
		// get invoice id 
		$id = $this->uri->segment(3);
		$data['result'] = $this->minvoice->getInvoice($id);
		if($data['result'] == false) 
			redirect();

		$this->form_validation->set_rules('tax','Tax','required');
		$this->form_validation->set_rules('payment','Payment Amount','required');
		if(!$this->form_validation->run()){
			$data['results'] = $this->minvoice->fetchDetailInvoice($id);
			$this->load->view('vpayinvoice',$data);
		}
		else{
			$this->minvoice->payInvoice($id);
			redirect('');
		}
	}	
	public function detailInvoice(){
		// get invoice id 
		$id = $this->uri->segment(3);
		$data['result'] = $this->minvoice->getInvoice($id);
		if($data['result'] == false) 
			redirect();

		$this->form_validation->set_rules('itemtype0','Item Type','required');
		if(!$this->form_validation->run()){
			$data['results'] = $this->minvoice->fetchDetailInvoice($id);
			$this->load->view('vdetailinvoice',$data);
		}
		else{
			$this->minvoice->saveInvoiceDetail($id,$_POST);
			redirect('home/detailInvoice/'.$data['invoiceID']);
		}
	}	
	public function deleteInvoice(){
		$id = $this->uri->segment(3);
		$this->db->where('invoiceID',$id);
		$this->db->delete('invoiceheader');

		$this->db->where('invoiceID',$id);
		$this->db->delete('invoicedetail');
		redirect();
	}
	// public function showInvoiceHeader(){
	// 	// fetch all invoice header
	// 	$data = $this->minvoice->fetchAllInvoiceHeader();
    //     echo json_encode($data);
	// }
	// function saveInvoiceHeader(){
    //     $data=$this->minvoice->saveInvoiceHeader();
    //     echo json_encode($data);
    // }
}
