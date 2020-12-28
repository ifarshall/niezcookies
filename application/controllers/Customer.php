<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Customer extends CI_Controller {

	function __construct()
    {
        parent::__construct();
        check_not_login();
        $this->load->model('model_customer');
    }

	public function index()
	{
		$data['row'] = $this->model_customer->get();
		$this->template->load('template', 'customer/customer_data', $data);
	}

	public function add()
	{
		$customer = new stdClass();
		$customer->customer_id = null;
		$customer->nama = null;
		$customer->gender = null;
		$customer->telepon = null;
		$customer->alamat = null;
		$data = array (
			'page' => 'tambah',
			'row' => $customer
		);
		$this->template->load('template', 'customer/customer_form', $data);
	}

	public function edit($id)
	{
		$query = $this->model_customer->get($id);
		if($query->num_rows() > 0) {
			$customer = $query->row();
			$data = array(
				'page' => 'ubah',
				'row' => $customer
			);
			$this->template->load('template', 'customer/customer_form', $data);
		} else {
			echo "<script>alert('Data tidak ditemukan');"; //apabila search html yang tidak ada idnya, maka tidak muncul
			echo "window.location='".site_url('customer')."';</script>";
		}
	}

	public function process()
	{
		$post = $this->input->post(null, TRUE);
		if(isset($_POST['tambah'])){
			$this->model_customer->add($post);
		} else if(isset($_POST['ubah'])){
			$this->model_customer->edit($post);
		}
		
		if($this->db->affected_rows()>0) {
            echo "<script>alert('Data Berhasil Disimpan');</script>";
        }
        echo "<script>window.location='".site_url('customer')."';</script>";

	}

	public function del($id)
    {
        $this->model_customer->del($id);

        if($this->db->affected_rows()>0) {
            echo "<script>alert('Data Berhasil Dihapus');</script>";
        }
        echo "<script>window.location='".site_url('customer')."';</script>";
	}
	
	
}
