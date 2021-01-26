<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class J_bahan extends CI_Controller {

	function __construct()
    {
        parent::__construct();
        check_not_login();
        $this->load->model('model_j_bahan');
    }

	public function index()
	{
		$data['row'] = $this->model_j_bahan->get();
		$this->template->load('template', 'referensi/jenis_bahan/j_bahan_data', $data);
	}

	public function add()
	{
		$j_bahan = new stdClass();
		$j_bahan->j_bahan_id = null;
		$j_bahan->nama = null;
		$data = array (
			'page' => 'tambah',
			'row' => $j_bahan
		);
		$this->template->load('template', 'referensi/jenis_bahan/j_bahan_form', $data);
	}

	public function edit($id)
	{
		$query = $this->model_j_bahan->get($id);
		if($query->num_rows() > 0) {
			$j_bahan = $query->row();
			$data = array(
				'page' => 'ubah',
				'row' => $j_bahan
			);
			$this->template->load('template', 'referensi/jenis_bahan/j_bahan_form', $data);
		} else {
			echo "<script>alert('Data tidak ditemukan');"; //apabila search html yang tidak ada idnya, maka tidak muncul
			echo "window.location='".site_url('j_bahan')."';</script>";
		}
	}

	public function process()
	{
		$post = $this->input->post(null, TRUE);
		if(isset($_POST['tambah'])){
			$this->model_j_bahan->add($post);
		} else if(isset($_POST['ubah'])){
			$this->model_j_bahan->edit($post);
		}
		
		if($this->db->affected_rows()>0) {
            $this->session->set_flashdata('success', 'Data Berhasil disimpan');
        }
        redirect('j_bahan');

	}

	// public function del($id)
    // {
    //     $this->model_j_bahan->del($id);

    //     if($this->db->affected_rows()>0) {
    //         $this->session->set_flashdata('success', 'Data Berhasil dihapus');
    //     }
    //     redirect('j_bahan');
	// }

	public function del($id)
    {
        $this->model_j_bahan->del($id);
		$error = $this->db->error();
		if($error['code'] != 0 ) {
			$this->session->set_flashdata('error', 'Data gagal dihapus karena sudah digunakan');
		}
        else {
            $this->session->set_flashdata('success', 'Data Berhasil dihapus');
        }
        echo "<script>window.location='".site_url('j_bahan')."';</script>";
	}
	

}