<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Transaksi_out extends CI_Controller {

    function __construct()
    {
        parent::__construct();
        check_not_login();
        $this->load->model('model_transaksi_out');
    }

	public function index()
	{
        $this->load->model(['model_customer', 'model_produk']);
        $customer = $this->model_customer->get()->result();
        $produk = $this->model_produk->get()->result();
        $cart = $this->model_transaksi_out->get_cart();
        $data = array(
            'customer' => $customer,
            'produk' => $produk,
            'cart' => $cart,
            'invoice' => $this->model_transaksi_out->invoice_no(),
        );
		$this->template->load('template', 'transaksi/transaksi_out/transaksi_out_form', $data);
    }

    public function process()
    {
        $data = $this->input->post(null, TRUE);

        if(isset($_POST['add_cart'])) {
            $produk_id = $this->input->post('produk_id');
            $check_cart = $this->model_transaksi_out->get_cart(['trans_out_cart.produk_id' => $produk_id])->num_rows();
            if($check_cart > 0) {
                $this->model_transaksi_out->update_cart_jumlah($data);
            } else {   
                $this->model_transaksi_out->add_cart($data);
            }

            if($this->db->affected_rows() > 0 ) {
				$params = array("success" => true);
			} else {
				$params = array("success" => false);
			}
			echo json_encode($params);
        }

        if(isset($_POST['edit_cart'])) {
            $this->model_transaksi_out->edit_cart($data);

            if($this->db->affected_rows() > 0 ) {
				$params = array("success" => true);
			} else {
				$params = array("success" => false);
			}
			echo json_encode($params);
        }

        if(isset($_POST['proses_bayar'])) {
            $transout_id = $this->model_transaksi_out->add_sale($data);
            $cart = $this->model_transaksi_out->get_cart()->result();
            $row = [];
            foreach($cart as $c => $value) {
                array_push($row, array(
                    'transout_id' => $transout_id,
                    'produk_id' => $value->produk_id,
                    'harga' => $value->harga,
                    'jumlah' => $value->jumlah,
                    'diskon_item' => $value->diskon_item,
                    'total' => $value->total,
                    )
                );
            }
            $this->model_transaksi_out->add_sale_detail($row);
            $this->model_transaksi_out->del_cart(['user_id' => $this->session->userdata('userid')]);

            if($this->db->affected_rows() > 0 ) {
                $params = array("success" => true, "transout_id" => $transout_id);
            } else {
                $params = array("success" => false);
            }
            echo json_encode($params);
        }

    }

    function cart_data()
    {
        $cart = $this->model_transaksi_out->get_cart();
        $data['cart'] = $cart;
        $this->load->view('transaksi/transaksi_out/outcart_data', $data);
    }

    public function cart_del()
    {   
        if(isset($_POST['batal_bayar'])) {
            $this->model_transaksi_out->del_cart(['user_id' => $this->session->userdata('userid')]);
        } else {
        $outcart_id = $this->input->post('outcart_id');
        $this->model_transaksi_out->del_cart(['outcart_id' => $outcart_id]);
        }
        if($this->db->affected_rows() > 0 ) {
            $params = array("success" => true);
        } else {
            $params = array("success" => false);
        }
        echo json_encode($params);
    }

    public function cetak($id)
    {
        $data = array(
            'sale' => $this->model_transaksi_out->get_sale($id)->row(),
            'sale_detail' => $this->model_transaksi_out->get_sale_detail($id)->result(),
        );
        $this->load->view('transaksi/transaksi_out/outreceipt_print', $data);
    }
    
	
}
