<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Purchase extends CI_Controller {

	function __construct()
    {
        parent::__construct();
        check_not_login();
        $this->load->model(['model_bahan', 'model_supplier', 'model_purchase' ]);
    }

    public function bahan_purchase() 
    {
        $data['row'] = $this->model_purchase->get_bahan_in()->result();
        $this->template->load('template', 'bahan/purchase/purchase_data', $data);
    }

    public function bahan_add() 
    {
        $bahan = $this->model_bahan->get()->result();
        $supplier = $this->model_supplier->get()->result();
        $data = ['bahan' => $bahan, 'supplier' => $supplier];
        $this->template->load('template', 'bahan/purchase/purchase_form', $data);
    }

    public function bahan_del() {
        $purchase_id = $this->uri->segment(4);
        $bahan_id = $this->uri->segment(5);
        $jumlah = $this->model_purchase->get($purchase_id)->row()->jumlah;
        $qty = $this->model_purchase->get($purchase_id)->row()->qty;
        $harga = $this->model_purchase->get($purchase_id)->row()->harga;
        $data = ['jumlah' => $jumlah, 'qty' => $qty, 'harga' => $harga, 'bahan_id' => $bahan_id];
        $this->model_bahan->update_purchase_out($data);
        $this->model_bahan->update_harga_out($data);
        $this->model_bahan->update_harga($data);
        $this->model_purchase->del($purchase_id);

        if($this->db->affected_rows()>0) {
            $this->session->set_flashdata('success', 'Data bahan Masuk Berhasil dihapus');
        }
        redirect('bahan/in');
    }

    public function process() {
        if(isset($_POST['in_add'])){
            $post = $this->input->post(null, TRUE);
            $this->model_purchase->add_purchase_in($post);
            $this->model_bahan->update_purchase_in($post);
            $this->model_bahan->update_harga_in($post);
            $this->model_bahan->update_harga($post);

            if($this->db->affected_rows()>0) {
                $this->session->set_flashdata('success', 'Data bahan Masuk Berhasil ditambahkan');
            }
            redirect('bahan/in');
        } else {
            if(isset($_POST['out_add'])){
                $row_item = $this->model_bahan->get($this->input->post('bahan_id'))->row();
                if($row_item->stock < $this->input->post('jumlah')){
                    $this->session->set_flashdata('error', 'Data stock bahan tidak mencukupi');
                    redirect('bahan/out/add');
                } else {
                $post = $this->input->post(null, TRUE);
                $this->model_purchase->add_purchase_out($post);
                $this->model_bahan->update_purchase_outdel($post);
                $this->model_bahan->update_harga_outdel($post);
                $this->model_bahan->update_harga($post);
    
                if($this->db->affected_rows()>0) {
                    $this->session->set_flashdata('success', 'Data bahan Keluar Berhasil ditambahkan');
                }
                redirect('bahan/out');
                }
            }
        }
    }

    public function bahan_out_data() 
    {
        $data['row'] = $this->model_purchase->get_bahan_out()->result();
        $this->template->load('template', 'bahan/bahan_out/bahan_out_data', $data);
    }

    public function bahan_out_add() 
    {
        $bahan = $this->model_bahan->get()->result();
        $data = ['bahan' => $bahan];
        $this->template->load('template', 'bahan/bahan_out/bahan_out_form', $data);
    }

    public function bahan_out_del() {
        $purchase_id = $this->uri->segment(4);
        $bahan_id = $this->uri->segment(5);
        $jumlah = $this->model_purchase->get($purchase_id)->row()->jumlah;
        $harga = $this->model_purchase->get($purchase_id)->row()->harga;
        $data = ['jumlah' => $jumlah, 'harga' => $harga, 'bahan_id' => $bahan_id];
        $this->model_bahan->update_purchase_indel($data);
        $this->model_bahan->update_harga_indel($data);
        $this->model_bahan->update_harga($data);
        $this->model_purchase->del($purchase_id);

        if($this->db->affected_rows()>0) {
            $this->session->set_flashdata('success', 'Data bahan Keluar Berhasil dihapus');
        }
        redirect('bahan/out');
    }
}