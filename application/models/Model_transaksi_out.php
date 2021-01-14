<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Model_transaksi_out extends CI_Model {

    public function invoice_no()
    {   
        $sql = "SELECT MAX(MID(invoice,9,4)) AS invoice_no
                FROM trans_out
                WHERE MID(invoice,3,6) = DATE_FORMAT(CURDATE(),'%d%m%y')";
        $query = $this->db->query($sql);
        if($query->num_rows()>0) {
            $row = $query->row();
            $n = ((int)$row->invoice_no)+1;
            $no = sprintf("%'.04d", $n);
        } else {
            $no = "0001";
        }
        $invoice = "NC".date('dmy').$no;
        return $invoice;
    }

    public function get_cart($params = null)
    {
        $this->db->select('*, p_stock.nama as nama_produk, trans_out_cart.harga as harga_cart');
        $this->db->from('trans_out_cart');
        $this->db->join('p_stock', 'trans_out_cart.produk_id = p_stock.produk_id');
        if ($params != null) {
            $this->db->where($params);
        }
        $this->db->where('user_id', $this->session->userdata('userid'));
        $query = $this->db->get();
        return $query;
    }

    public function add_cart($post)
    {
        $query = $this->db->query("SELECT MAX(outcart_id) AS cart_no FROM trans_out_cart");
        if($query->num_rows() > 0) {
            $row = $query->row();
            $car_no = ((int)$row->cart_no) + 1;
        } else {
            $car_no = "1";
        }

        $params = array(
            'outcart_id' => $car_no,
            'produk_id' => $post['produk_id'],
            'harga' => $post['harga'],
            'jumlah' => $post['jumlah'],
            'total' => ($post['harga'] * $post['jumlah']),
            'user_id' => $this->session->userdata('userid')
        );
        $this->db->insert('trans_out_cart', $params);
    }

    public function update_cart_jumlah($post) {
        $sql = "UPDATE trans_out_cart SET harga = '$post[harga]',
                jumlah = jumlah + '$post[jumlah]',
                total = '$post[harga]'*jumlah
                WHERE produk_id = '$post[produk_id]'";
        $this->db->query($sql);
    }
    
    public function del_cart($params = null)
    {
        if($params != null) {
            $this->db->where($params);
        }
        $this->db->delete('trans_out_cart');
    }

    public function edit_cart($post)
    {
        $params = array(
            'harga' => $post['harga'],
            'jumlah' => $post['jumlah'],
            'diskon_item' => $post['diskon'],
            'total' => $post['total'],
        );
        $this->db->where('outcart_id', $post['outcart_id']);
        $this->db->update('trans_out_cart', $params);
    }

    public function add_sale($post)
    {
        $params = array(
            'invoice' => $this->invoice_no(),
            'customer_id' => $post['customer_id'] == "" ? null : $post['customer_id'],
            'total_price' => $post['subtotal'],
            'diskon' => $post['discount'],
            'final_price' => $post['grandtotal'],
            'cash' => $post['cash'],
            'remain' => $post['change'],
            'catatan' => $post['catatan'],
            'tanggal' => $post['tanggal'],
            'user_id' => $this->session->userdata('userid'),
        );
        $this->db->insert('trans_out', $params);
        return $this->db->insert_id();
    }

    function add_sale_detail($params) {
        $this->db->insert_batch('t_out_detail', $params);
    }

    public function get_sale($id = null)
    {
        $this->db->select('*, customer.nama as nama_customer, user.nama as nama_user, 
                            trans_out.created as sale_created, customer.alamat as alamat_customer');
        $this->db->from('trans_out');
        $this->db->join('customer', 'trans_out.customer_id = customer.customer_id', 'left');
        $this->db->join('user', 'trans_out.user_id = user.user_id');
        if($id != null){
                $this->db->where('transout_id', $id);
        }
        $this->db->order_by('tanggal', 'desc');
        $query = $this->db->get();
        return $query;
    }

    public function get_sale_detail($transout_id = null)
    {
        $this->db->from('t_out_detail');
        $this->db->join('p_stock', 't_out_detail.produk_id = p_stock.produk_id');
        if($transout_id != null) {
            $this->db->where('t_out_detail.transout_id', $transout_id);
        }
        $query = $this->db->get();
        return $query;
    }
}