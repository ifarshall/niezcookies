<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Model_transaksi_in extends CI_Model {

    public function get_invoice($id = null)
    {
        $this->db->select('trans_in.*');
        $this->db->from('trans_in');
        if($id != null) {
            $this->db->where('transin_id', $id);

        }
        $this->db->order_by('invoice', 'asc');
        $query = $this->db->get();
        return $query;
    }

    public function invoice_no()
    {   
        $sql = "SELECT MAX(MID(invoice,11,4)) AS invoice_no
                FROM trans_in
                WHERE MID(invoice,5,6) = DATE_FORMAT(CURDATE(),'%d%m%y')";
        $query = $this->db->query($sql);
        if($query->num_rows()>0) {
            $row = $query->row();
            $n = ((int)$row->invoice_no)+1;
            $no = sprintf("%'.04d", $n);
        } else {
            $no = "0001";
        }
        $invoice = "PROD".date('dmy').$no;
        return $invoice;
    }
    public function get_cart($params = null)
    {
        $this->db->select('*, b_stock.nama as nama_bahan, trans_in_cart.harga as harga_cart');
        $this->db->from('trans_in_cart');
        $this->db->join('b_stock', 'trans_in_cart.bahan_id = b_stock.bahan_id');
        if ($params != null) {
            $this->db->where($params);
        }
        $this->db->where('user_id', $this->session->userdata('userid'));
        $query = $this->db->get();
        return $query;
    }

    public function add_cart($post)
    {
        $query = $this->db->query("SELECT MAX(incart_id) AS cart_no FROM trans_in_cart");
        if($query->num_rows() > 0) {
            $row = $query->row();
            $car_no = ((int)$row->cart_no) + 1;
        } else {
            $car_no = "1";
        }

        $params = array(
            'incart_id' => $car_no,
            'bahan_id' => $post['bahan_id'],
            'harga' => $post['harga'],
            'jumlah' => $post['jumlah'],
            'total' => ($post['harga'] * $post['jumlah']),
            'user_id' => $this->session->userdata('userid'),
        );
        $this->db->insert('trans_in_cart', $params);

    }

    public function update_cart_jumlah($post) {
        $sql = "UPDATE trans_in_cart SET harga = '$post[harga]',
                jumlah = jumlah + '$post[jumlah]',
                total = '$post[harga]'*jumlah
                WHERE bahan_id = '$post[bahan_id]'";
        $this->db->query($sql);
    }   

    public function del_cart($params = null)
    {
        if($params != null) {
            $this->db->where($params);
        }
        $this->db->delete('trans_in_cart');
    }

    public function add_sale($data)
    {
        $params = array(
            'invoice' => $this->invoice_no(),
            'producer_id' => $data['producer_id'],
            'total_price' => $data['subtotal'],
            'catatan' => $data['catatan'],
            'tanggal' => $data['tanggal'],
            'user_id' => $this->session->userdata('userid')
        );
        $this->db->insert('trans_in', $params);
        return $this->db->insert_id();
    }
    function add_sale_detail($params) {
        $this->db->insert_batch('trans_in_detail', $params);
    }

    public function get_sale($id = null)
    {
        $this->db->select('*, producer.nama as nama_producer, user.nama as nama_user, 
                            trans_in.created as sale_created');
        $this->db->from('trans_in');
        $this->db->join('producer', 'trans_in.producer_id = producer.producer_id', 'left');
        $this->db->join('user', 'trans_in.user_id = user.user_id');
        if($id != null){
                $this->db->where('transin_id', $id);
        }
        $this->db->order_by('tanggal', 'desc');
        $query = $this->db->get();
        return $query;
    }

    public function get_sale_detail($transin_id = null)
    {
        $this->db->from('trans_in_detail');
        $this->db->join('b_stock', 'trans_in_detail.bahan_id = b_stock.bahan_id');
        if($transin_id != null) {
            $this->db->where('trans_in_detail.transin_id', $transin_id);
        }
        $query = $this->db->get();
        return $query;
    }

    public function del_sale($id)
    {
        $this->db->where('transin_id', $id);
        $this->db->delete('trans_in');
    }

}