<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Purchase extends CI_Controller {

	function __construct()
    {
        parent::__construct();
        check_not_login();
        $this->load->model(['model_bahan', 'model_supplier' ]);
    }

    public function bahan_purchase() {
        $this->template->load('template', 'bahan/purchase/purchase_data');
    }

    public function bahan_add() {
        $bahan = $this->model_bahan->get()->result();
        $supplier = $this->model_supplier->get()->result();
        $data = ['bahan' => $bahan, 'supplier' => $supplier];
        $this->template->load('template', 'bahan/purchase/purchase_form', $data);
    }

    public function process() {
        if(isset($_POST['in_add'])){
            echo "proses stock in add";
        }
    }
}