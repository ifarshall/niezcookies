<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Supplier extends CI_Controller {

	function __construct()
    {
        parent::__construct();
        check_not_login();
        $this->load->model('model_supplier');
    }

	public function index()
	{
		$data['row'] = $this->model_supplier->get();
		$this->template->load('template', 'supplier/supplier_data', $data);
	}

	public function add()
	{
		$supplier = new stdClass();
		$supplier->supplier_id = null;
		$supplier->nama_toko = null;
		$supplier->lokasi_toko = null;
		$supplier->telepon = null;
		$supplier->deskripsi = null;
		$data = array (
			'page' => 'tambah',
			'row' => $supplier
		);
		$this->template->load('template', 'supplier/supplier_form', $data);
	}

	public function edit($id)
	{
		$query = $this->model_supplier->get($id);
		if($query->num_rows() > 0) {
			$supplier = $query->row();
			$data = array(
				'page' => 'ubah',
				'row' => $supplier
			);
			$this->template->load('template', 'supplier/supplier_form', $data);
		} else {
			echo "<script>alert('Data tidak ditemukan');"; //apabila search html yang tidak ada idnya, maka tidak muncul
			echo "window.location='".site_url('supplier')."';</script>";
		}
	}

	public function process()
	{
		$post = $this->input->post(null, TRUE);
		if(isset($_POST['tambah'])){
			$this->model_supplier->add($post);
		} else if(isset($_POST['ubah'])){
			$this->model_supplier->edit($post);
		}
		
		if($this->db->affected_rows()>0) {
            echo "<script>alert('Data Berhasil Disimpan');</script>";
        }
        echo "<script>window.location='".site_url('supplier')."';</script>";

	}

	public function del($id)
    {
        $this->model_supplier->del($id);

        if($this->db->affected_rows()>0) {
            echo "<script>alert('Data Berhasil Dihapus');</script>";
        }
        echo "<script>window.location='".site_url('supplier')."';</script>";
	}
	
	
}
