<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Bahan extends CI_Controller {

	function __construct()
    {
        parent::__construct();
        check_not_login();
        $this->load->model(['model_bahan', 'model_j_bahan', 'model_satuan']);
    }

	public function index()
	{
		$data['row'] = $this->model_bahan->get();
		$this->template->load('template', 'bahan/stock_bahan/bahan_data', $data);
	}

	public function add()
	{
		$bahan = new stdClass();
        $bahan->bahan_id = null;
        $bahan->barcode = null;
        $bahan->nama = null;
        $bahan->j_bahan_id = null;
        
        $query_j_bahan = $this->model_j_bahan->get();

        $query_satuan = $this->model_satuan->get();
        $satuan[null] = '- Pilih -';
        foreach($query_satuan->result() as $sat){
            $satuan[$sat->satuan_id] = $sat->nama;
        }

		$data = array (
			'page' => 'tambah',
            'row' => $bahan,
            'j_bahan' => $query_j_bahan,
            'satuan' => $satuan, 'selectedsatuan' => null,
		);
		$this->template->load('template', 'bahan/stock_bahan/bahan_form', $data);
	}

	public function edit($id)
	{
		$query = $this->model_bahan->get($id);
		if($query->num_rows() > 0) {
			$bahan = $query->row();
			$query_j_bahan = $this->model_j_bahan->get();

            $query_satuan = $this->model_satuan->get();
            $satuan[null] = '- Pilih -';
            foreach($query_satuan->result() as $sat){
                $satuan[$sat->satuan_id] = $sat->nama;
            }

            $data = array (
                'page' => 'ubah',
                'row' => $bahan,
                'j_bahan' => $query_j_bahan,
                'satuan' => $satuan, 'selectedsatuan' => $bahan->satuan_id,
            );
            $this->template->load('template', 'bahan/stock_bahan/bahan_form', $data);
		} else {
			echo "<script>alert('Data tidak ditemukan');"; //apabila search html yang tidak ada idnya, maka tidak muncul
			echo "window.location='".site_url('bahan')."';</script>";
		}
	}

	public function process()
	{
		$post = $this->input->post(null, TRUE);
		if(isset($_POST['tambah'])){
            if($this->model_bahan->check_barcode($post['barcode'])->num_rows() > 0) {
                $this->session->set_flashdata('error', "Barcode $post[barcode] sudah dipakai bahan lain");
                redirect('bahan/add');
            } else {
                $this->model_bahan->add($post);
            }
		} else if(isset($_POST['ubah'])){
            if($this->model_bahan->check_barcode($post['barcode'], $post['id'])->num_rows() > 0) {
                $this->session->set_flashdata('error', "Barcode $post[barcode] sudah dipakai bahan lain");
                redirect('bahan/edit/'.$post['id']);
            } else {
                $this->model_bahan->edit($post);
            }
		}
		
		if($this->db->affected_rows()>0) {
            $this->session->set_flashdata('success', 'Data Berhasil disimpan');
        }
        redirect('bahan');

	}

	public function del($id)
    {
        $this->model_bahan->del($id);

        if($this->db->affected_rows()>0) {
            $this->session->set_flashdata('success', 'Data Berhasil dihapus');
        }
        redirect('bahan');
	}

}