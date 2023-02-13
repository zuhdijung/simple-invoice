<?php

defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . '/libraries/REST_Controller.php';
use Restserver\Libraries\REST_Controller;

class Api extends REST_Controller {

    function __construct($config = 'rest') {
        parent::__construct($config);
        $this->load->database();
        $this->load->model('minvoice');
    }

    //Menampilkan data kontak
    function index_get() {
        $id = $this->get('id');
        if ($id == '') {
            $results = $this->minvoice->fetchAllInvoiceHeader();
        } else {
            $results = $this->minvoice->fetchDetailInvoice($id);
        }
        $this->response($results, 200);
    }


    //Masukan function selanjutnya disini
}
?>