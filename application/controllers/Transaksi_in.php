<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Transaksi_in extends CI_Controller {

    function __construct()
    {
        parent::__construct();
        check_not_login();
        $this->load->model('model_transaksi_in');
    }

	public function index()
	{
        $this->load->model(['model_producer', 'model_bahan']);
        $producer = $this->model_producer->get()->result();
        $bahan = $this->model_bahan->get()->result();
        $cart = $this->model_transaksi_in->get_cart();
        $data = array(
            'producer' => $producer,
            'bahan' => $bahan,
            'cart' => $cart,
            'invoice' => $this->model_transaksi_in->invoice_no(),
        );
		$this->template->load('template', 'transaksi/transaksi_in/transaksi_in_form', $data);

	}
    
    public function process()
    {
        $data = $this->input->post(null, TRUE);

        if(isset($_POST['add_cart'])) {
            $bahan_id = $this->input->post('bahan_id');
            $check_cart = $this->model_transaksi_in->get_cart(['trans_in_cart.bahan_id' => $bahan_id])->num_rows();
            if($check_cart > 0) {
                $this->model_transaksi_in->update_cart_jumlah($data);
            } else {   
                $this->model_transaksi_in->add_cart($data);
            }

            if($this->db->affected_rows() > 0 ) {
                $params = array("success" => true);
            } else {
                $params = array("success" => false);
            }
            echo json_encode($params);
        }

        if(isset($_POST['proses_bayar'])) {
			$transin_id = $this->model_transaksi_in->add_sale($data);
			$cart = $this->model_transaksi_in->get_cart()->result();
			$row = [];
			foreach($cart as $c => $value) {
				array_push($row, array(
					'transin_id' => $transin_id,
					'bahan_id' => $value->bahan_id,
					'harga' => $value->harga,
					'jumlah' => $value->jumlah,
					'total' => $value->total,
					)
				);
			}
			$this->model_transaksi_in->add_sale_detail($row);
			$this->model_transaksi_in->del_cart(['user_id' => $this->session->userdata('userid')]);

			if($this->db->affected_rows() > 0) {
				$params = array("success" => true, "transin_id" => $transin_id);
			} else {
				$params = array("success" => false);
			}
			echo json_encode($params);
		}

    }

    function cart_data()
    {
        $cart = $this->model_transaksi_in->get_cart();
        $data['cart'] = $cart;
        $this->load->view('transaksi/transaksi_in/incart_data', $data);
    }

    public function cart_del()
    {   
        if(isset($_POST['batal_bayar'])) {
            $this->model_transaksi_in->del_cart(['user_id' => $this->session->userdata('userid')]);
        } else {
            $incart_id = $this->input->post('incart_id');
            $this->model_transaksi_in->del_cart(['incart_id' => $incart_id]);
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
            'sale' => $this->model_transaksi_in->get_sale($id)->row(),
            'sale_detail' => $this->model_transaksi_in->get_sale_detail($id)->result(),
        );
        $this->load->view('transaksi/transaksi_in/inreceipt_print', $data);
    }

    public function del($id)
    {
        $this->model_transaksi_in->del_sale($id);
        if($this->db->affected_rows() > 0) {
            $this->session->set_flashdata('success', 'Data Berhasil dihapus');
            redirect ('report/prod');
        } else {
            $this->session->set_flashdata('success', 'Data Gagal dihapus');
            redirect ('report/prod');
            
        }
    }
}