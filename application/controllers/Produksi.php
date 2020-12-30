<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Produksi extends CI_Controller {

	function __construct()
    {
        parent::__construct();
        check_not_login();
        $this->load->model(['model_produk', 'model_producer' ]);
    }

    public function produk_produksi() {
        $this->template->load('template', 'produk/produksi/produksi_data');
    }

    public function produk_add() {
        $produk = $this->model_produk->get()->result();
        $producer = $this->model_producer->get()->result();
        $data = ['produk' => $produk, 'producer' => $producer];
        $this->template->load('template', 'produk/produksi/produksi_form', $data);
    }

    public function process() {
        if(isset($_POST['in_add'])){
            echo "proses stock produksi add";
        }
    }
}