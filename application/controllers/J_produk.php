<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class J_produk extends CI_Controller {

	function __construct()
    {
        parent::__construct();
        check_not_login();
        $this->load->model('model_j_produk');
    }

	public function index()
	{
		$data['row'] = $this->model_j_produk->get();
		$this->template->load('template', 'referensi/jenis_produk/j_produk_data', $data);
	}

	public function add()
	{
		$j_produk = new stdClass();
		$j_produk->j_produk_id = null;
		$j_produk->nama = null;
		$data = array (
			'page' => 'tambah',
			'row' => $j_produk
		);
		$this->template->load('template', 'referensi/jenis_produk/j_produk_form', $data);
	}

	public function edit($id)
	{
		$query = $this->model_j_produk->get($id);
		if($query->num_rows() > 0) {
			$j_produk = $query->row();
			$data = array(
				'page' => 'ubah',
				'row' => $j_produk
			);
			$this->template->load('template', 'referensi/jenis_produk/j_produk_form', $data);
		} else {
			echo "<script>alert('Data tidak ditemukan');"; //apabila search html yang tidak ada idnya, maka tidak muncul
			echo "window.location='".site_url('j_produk')."';</script>";
		}
	}

	public function process()
	{
		$post = $this->input->post(null, TRUE);
		if(isset($_POST['tambah'])){
			$this->model_j_produk->add($post);
		} else if(isset($_POST['ubah'])){
			$this->model_j_produk->edit($post);
		}
		
		if($this->db->affected_rows()>0) {
            $this->session->set_flashdata('success', 'Data Berhasil disimpan');
        }
        redirect('j_produk');

	}

	// public function del($id)
    // {
    //     $this->model_j_produk->del($id);

    //     if($this->db->affected_rows()>0) {
    //         $this->session->set_flashdata('success', 'Data Berhasil dihapus');
    //     }
    //     redirect('j_produk');
	// }

	public function del($id)
    {
        $this->model_j_produk->del($id);
		$error = $this->db->error();
		if($error['code'] != 0 ) {
			$this->session->set_flashdata('error', 'Data gagal dihapus karena sudah digunakan');
		}
        else {
            $this->session->set_flashdata('success', 'Data Berhasil dihapus');
        }
        echo "<script>window.location='".site_url('j_produk')."';</script>";
	}
	
	
}
