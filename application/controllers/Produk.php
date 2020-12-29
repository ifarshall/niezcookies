<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Produk extends CI_Controller {

	function __construct()
    {
        parent::__construct();
        check_not_login();
        $this->load->model(['model_produk', 'model_j_produk', 'model_satuan']);
    }

	public function index()
	{
		$data['row'] = $this->model_produk->get();
		$this->template->load('template', 'produk/stock_produk/produk_data', $data);
	}

	public function add()
	{
		$produk = new stdClass();
        $produk->produk_id = null;
        $produk->barcode = null;
        $produk->nama = null;
        $produk->j_produk_id = null;
        $produk->harga   = null;
        
        $query_j_produk = $this->model_j_produk->get();

        $query_satuan = $this->model_satuan->get();
        $satuan[null] = '- Pilih -';
        foreach($query_satuan->result() as $sat){
            $satuan[$sat->satuan_id] = $sat->nama;
        }

		$data = array (
			'page' => 'tambah',
            'row' => $produk,
            'j_produk' => $query_j_produk,
            'satuan' => $satuan, 'selectedsatuan' => null,
		);
		$this->template->load('template', 'produk/stock_produk/produk_form', $data);
	}

	public function edit($id)
	{
		$query = $this->model_produk->get($id);
		if($query->num_rows() > 0) {
			$produk = $query->row();
			$query_j_produk = $this->model_j_produk->get();

            $query_satuan = $this->model_satuan->get();
            $satuan[null] = '- Pilih -';
            foreach($query_satuan->result() as $sat){
                $satuan[$sat->satuan_id] = $sat->nama;
            }

            $data = array (
                'page' => 'ubah',
                'row' => $produk,
                'j_produk' => $query_j_produk,
                'satuan' => $satuan, 'selectedsatuan' => $produk->satuan_id,
            );
            $this->template->load('template', 'produk/stock_produk/produk_form', $data);
		} else {
			echo "<script>alert('Data tidak ditemukan');"; //apabila search html yang tidak ada idnya, maka tidak muncul
			echo "window.location='".site_url('produk')."';</script>";
		}
	}

	public function process()
	{
		$post = $this->input->post(null, TRUE);
		if(isset($_POST['tambah'])){
			if($this->model_produk->check_barcode($post['barcode'])->num_rows() > 0) {
                $this->session->set_flashdata('error', "Barcode $post[barcode] sudah dipakai produk lain");
                redirect('produk/add');
            } else {
                    $this->model_produk->add($post);
                    }
                    // kalau mau upload image
                // $config['upload_path']    = './uploads/produk/';
                // $config['allowed_types']  = 'jpg|jpeg|png';
                // $config['max_size']       = 2048;
                // $config['file_name']      = 'produk-'.date('ymd').'-'.substr(md5(rand()),0,10);
                // $this->load->library('upload', $config);

                // if(@_FILES['image']['nama'] != null){
                    // if($this->upload->do_upload('image')) {
                        // $post['image'] = $this->upload->data('file_name');
                        //     } else {
                            //         $error = $this->upload->display_errors();
                            //         $this->session->set_flashdata('error', $error);
                            //         redirect('produk/add');
                            //     }
                            // } else {
                                //     $post['image'] = null;
                                //     $this->model_produk->add($post);
                                //     if($this->db->affected_rows()>0) {
                                    //         $this->session->set_flashdata('success', 'Data Berhasil disimpan');
                                    //     }
                                    //     redirect('produk');
                                    // }
                                    
                                } else if(isset($_POST['ubah'])){
                                    if($this->model_produk->check_barcode($post['barcode'], $post['id'])->num_rows() > 0) {
                                        $this->session->set_flashdata('error', "Barcode $post[barcode] sudah dipakai produk lain");
                                        redirect('produk/edit/'.$post['id']);
                                    } else {
                                        $this->model_produk->edit($post);
                                    }
                                }
                                if($this->db->affected_rows()>0) {
                                    $this->session->set_flashdata('success', 'Data Berhasil disimpan');
                                }
                                redirect('produk');

	}

	public function del($id)
    {
        $this->model_produk->del($id);

        if($this->db->affected_rows()>0) {
            $this->session->set_flashdata('success', 'Data Berhasil dihapus');
        }
        redirect('produk');
    }
    
    function barcode_qrcode($id) {
        $data['row'] = $this->model_produk->get($id)->row();
		$this->template->load('template', 'produk/stock_produk/barcode_qrcode', $data);
        
    }

    function barcode_print($id) {
        $data['row'] = $this->model_produk->get($id)->row();
        $html = $this->load->view('produk/stock_produk/barcode_print', $data, TRUE);
        $this->fungsi->PdfGenerator($html,'qrcode-'.$data['row']->barcode, 'A4', 'portrait');
    }

    function qrcode_print($id) {
        $data['row'] = $this->model_produk->get($id)->row();
        $html = $this->load->view('produk/stock_produk/qrcode_print', $data, TRUE);
        $this->fungsi->PdfGenerator($html,'qrcode-'.$data['row']->barcode, 'A4', 'portrait');
    }

}