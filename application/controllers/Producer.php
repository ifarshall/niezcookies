<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Producer extends CI_Controller {

	function __construct()
    {
        parent::__construct();
        check_not_login();
        $this->load->model('model_producer');
    }

	public function index()
	{
		$data['row'] = $this->model_producer->get();
		$this->template->load('template', 'producer/producer_data', $data);
	}

	public function add()
	{
		$producer = new stdClass();
		$producer->producer_id = null;
		$producer->nama = null;
		$producer->lokasi = null;
		$producer->telepon = null;
		$producer->deskripsi = null;
		$data = array (
			'page' => 'tambah',
			'row' => $producer
		);
		$this->template->load('template', 'producer/producer_form', $data);
	}

	public function edit($id)
	{
		$query = $this->model_producer->get($id);
		if($query->num_rows() > 0) {
			$producer = $query->row();
			$data = array(
				'page' => 'ubah',
				'row' => $producer
			);
			$this->template->load('template', 'producer/producer_form', $data);
		} else {
			echo "<script>alert('Data tidak ditemukan');"; //apabila search html yang tidak ada idnya, maka tidak muncul
			echo "window.location='".site_url('producer')."';</script>";
		}
	}

	public function process()
	{
		$post = $this->input->post(null, TRUE);
		if(isset($_POST['tambah'])){
			$this->model_producer->add($post);
		} else if(isset($_POST['ubah'])){
			$this->model_producer->edit($post);
		}
		
		if($this->db->affected_rows()>0) {
            echo "<script>alert('Data Berhasil Disimpan');</script>";
        }
        echo "<script>window.location='".site_url('producer')."';</script>";

	}

	public function del($id)
    {
        $this->model_producer->del($id);

        if($this->db->affected_rows()>0) {
            echo "<script>alert('Data Berhasil Dihapus');</script>";
        }
        echo "<script>window.location='".site_url('producer')."';</script>";
	}
	
	
}
