<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Satuan extends CI_Controller {

	function __construct()
    {
        parent::__construct();
        check_not_login();
        $this->load->model('model_satuan');
    }

	public function index()
	{
		$data['row'] = $this->model_satuan->get();
		$this->template->load('template', 'referensi/satuan/satuan_data', $data);
	}

	public function add()
	{
		$satuan = new stdClass();
		$satuan->satuan_id = null;
		$satuan->nama = null;
		$data = array (
			'page' => 'tambah',
			'row' => $satuan
		);
		$this->template->load('template', 'referensi/satuan/satuan_form', $data);
	}

	public function edit($id)
	{
		$query = $this->model_satuan->get($id);
		if($query->num_rows() > 0) {
			$satuan = $query->row();
			$data = array(
				'page' => 'ubah',
				'row' => $satuan
			);
			$this->template->load('template', 'referensi/satuan/satuan_form', $data);
		} else {
			echo "<script>alert('Data tidak ditemukan');"; //apabila search html yang tidak ada idnya, maka tidak muncul
			echo "window.location='".site_url('satuan')."';</script>";
		}
	}

	public function process()
	{
		$post = $this->input->post(null, TRUE);
		if(isset($_POST['tambah'])){
			$this->model_satuan->add($post);
		} else if(isset($_POST['ubah'])){
			$this->model_satuan->edit($post);
		}
		
		if($this->db->affected_rows()>0) {
            $this->session->set_flashdata('success', 'Data Berhasil disimpan');
        }
        redirect('satuan');

	}

	public function del($id)
    {
        $this->model_satuan->del($id);

        if($this->db->affected_rows()>0) {
            $this->session->set_flashdata('success', 'Data Berhasil dihapus');
        }
        redirect('satuan');
	}

}