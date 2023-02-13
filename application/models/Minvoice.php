<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Minvoice extends CI_Model {
	public function __construct(){
		parent::__construct();
	}
	public function fetchAllInvoiceHeader(){
        $results = $this->db->get('invoiceheader');
        if($results->num_rows()>0){
            return $results->result();
        }
        else return false;
    }
    public function latestInvoiceId(){
        $invoiceID = 0;
        $this->db->order_by('invoiceID','DESC');
        $results = $this->db->get('invoiceheader');
        if($results->num_rows()>0){
            $result = $results->row_array();
            $invoiceID = $result['invoiceID']+1;
            return $invoiceID;
        }
        else return 1; // if there's no data at database
    }
    public function getInvoice($id){
        $this->db->where('invoiceID',$id);
        $result = $this->db->get('invoiceheader');
        if($result->num_rows()>0){
            return $result->row_array();
        }
        else return false;
    }
    public function fetchDetailInvoice($id){
        $this->db->where('invoiceID',$id);  
        $results = $this->db->get('invoicedetail');
        if($results->num_rows()>0){
            return $results->result();
        }
        else return false;
    }
    public function saveInvoiceHeader(){
        $data = array(
            'issueDate' => $this->input->post('issueDate'),
            'dueDate' => $this->input->post('dueDate'),
            'subject' => $this->input->post('subject'),
            'sender' => $this->input->post('sender'),
            'senderAddress' => $this->input->post('senderAddress'),
            'receiver' => $this->input->post('receiver'),
            'receiverAddress' => $this->input->post('receiverAddress'),
        );
        $result = $this->db->insert('invoiceheader',$data);
        return $result;
    }
    public function editInvoiceHeader($id){
        $data = array(
            'issueDate' => $this->input->post('issueDate'),
            'dueDate' => $this->input->post('dueDate'),
            'subject' => $this->input->post('subject'),
            'sender' => $this->input->post('sender'),
            'senderAddress' => $this->input->post('senderAddress'),
            'receiver' => $this->input->post('receiver'),
            'receiverAddress' => $this->input->post('receiverAddress'),
            'statusinvoice' => $this->input->post('statusinvoice'),
        );
        $this->db->where('invoiceID',$id);
        $result = $this->db->update('invoiceheader',$data);
        return $result;
    }
    public function saveInvoiceDetail($id,$data){
        $total_rows = count($data['rowID']);
        for($i=0;$i<$total_rows;$i++){
            $itemtype = $this->input->post('itemtype'.$i);
            $description = $this->input->post('description'.$i);
            $qty = $this->input->post('qty'.$i);
            $unitprice = $this->input->post('unitprice'.$i);
            $data = array(
                'invoiceID' => $id,
                'itemtype' => $itemtype,
                'description' => $description,
                'qty' => $qty,
                'unitprice' => $unitprice
            );
            $this->db->insert('invoicedetail',$data);
        }
    }
    public function payInvoice($id){
        $data = array(
            'tax' => $this->input->post('tax'),
            'payment' => $this->input->post('payment'),
            'statusinvoice' => 1 // 1: PAID
        );
        $this->db->where('invoiceID',$id);
        $result = $this->db->update('invoiceheader',$data);
        return $result;
    }
}
