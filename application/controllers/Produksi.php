<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Produksi extends CI_Controller {

	function __construct()
    {
        parent::__construct();
        check_not_login();
        $this->load->model(['model_produk', 'model_producer', 'model_produksi', 'model_transaksi_in']);
    }

    public function produk_produksi() {
        $data['row'] = $this->model_produksi->get_produk_in()->result();
        $this->template->load('template', 'produk/produksi/produksi_data', $data);
    }

    public function produk_add() {
        $produk = $this->model_produk->get()->result();
        $producer = $this->model_producer->get()->result();
        $invoice = $this->model_transaksi_in->get_invoice()->result();
        $data = ['produk' => $produk, 'producer' => $producer, 'invoice' => $invoice];
        $this->template->load('template', 'produk/produksi/produksi_form', $data);
    }

    public function produk_del() {
        $produksi_id = $this->uri->segment(4);
        $produk_id = $this->uri->segment(5);
        $jumlah = $this->model_produksi->get($produksi_id)->row()->jumlah;
        $data = ['jumlah' => $jumlah, 'harga' => $harga, 'produk_id' => $produk_id];
        $this->model_produk->update_produksi_out($data);
        $this->model_produksi->del($produksi_id);

        if($this->db->affected_rows()>0) {
            $this->session->set_flashdata('success', 'Data Produk Masuk Berhasil dihapus');
        }
        redirect('produk/in');
    }

    public function process() {
        // $this->form_validation->set_rules('jumlah', 'jumlah', 'less_than_equal_to[]');

        // $this->form_validation->set_message('less_than_equal_to', 'Jumlah %s melebihi stock yang tersedia');
        // $this->form_validation->set_error_delimiters('<span class="help-block">','</span>');

        if(isset($_POST['in_add'])){
            $post = $this->input->post(null, TRUE);
            $this->model_produksi->add_produksi_in($post);
            $this->model_produk->update_produksi_in($post);

            if($this->db->affected_rows()>0) {
                $this->session->set_flashdata('success', 'Data Produk Masuk Berhasil ditambahkan');
            }
            redirect('produk/in');
        } else {
            if(isset($_POST['out_add'])){
                               
                $post = $this->input->post(null, TRUE);
                $row_item = $this->model_produk->get($this->input->post('produk_id'))->row();
                if($row_item->stock < $this->input->post('jumlah')){
                    $this->session->set_flashdata('error', 'Data stock produk tidak mencukupi');
                    redirect('produk/out/add');
                } else {
                    $this->model_produksi->add_produksi_out($post);
                    $this->model_produk->update_produksi_out($post);
                    if($this->db->affected_rows()>0) {
                        $this->session->set_flashdata('success', 'Data Produk Keluar Berhasil ditambahkan');
                    }
                    redirect('produk/out');
                }
            }
        }

    }

    public function produk_out_data() {
        $data['row'] = $this->model_produksi->get_produk_out()->result();
        $this->template->load('template', 'produk/produk_out/produk_out_data', $data);
    }

    public function produk_out_add() {
        $produk = $this->model_produk->get()->result();
        $producer = $this->model_producer->get()->result();
        $data = ['produk' => $produk, 'producer' => $producer];
        $this->template->load('template', 'produk/produk_out/produk_out_form', $data);
    }

    public function produk_out_del() {
        $produksi_id = $this->uri->segment(4);
        $produk_id = $this->uri->segment(5);
        $jumlah = $this->model_produksi->get($produksi_id)->row()->jumlah;
        $data = ['jumlah' => $jumlah, 'harga' => $harga, 'produk_id' => $produk_id];
        $this->model_produk->update_produksi_in($data);
        $this->model_produksi->del($produksi_id);

        if($this->db->affected_rows()>0) {
            $this->session->set_flashdata('success', 'Data Produk Keluar Berhasil dihapus');
        }
        redirect('produk/out');
    }
}