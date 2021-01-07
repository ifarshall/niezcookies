<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Model_purchase extends CI_Model {

    public function get($id = null)
    {
        $this->db->from('b_purchase');
        if($id != null) {
            $this->db->where('purchase_id', $id);
        }
        $query = $this->db->get();
        return $query;
    }

    public function del($id)
    {
        $this->db->where('purchase_id', $id);
        $this->db->delete('b_purchase');
    }

    public function get_bahan_in()
    {
        $this->db->select('b_purchase.purchase_id, b_stock.nama as nama_bahan,
        jumlah, qty, b_purchase.harga as harga_beli, tanggal, detail,
        supplier.nama_toko as nama_supplier, b_stock.bahan_id');
        $this->db->from('b_purchase');
        $this->db->join('b_stock', 'b_purchase.bahan_id = b_stock.bahan_id');
        $this->db->join('supplier', 'b_purchase.supplier_id = supplier.supplier_id', 'left');
        $this->db->where('type', 'in');
        $this->db->order_by('purchase_id', 'desc');
        $query = $this->db->get();
        return $query;
    }

    public function add_purchase_in($post)
    {
        $params = [
            'bahan_id' => $post['bahan_id'],
            'type' => 'in',
            'detail' => $post['detail'],
            'supplier_id' => $post['supplier'] == '' ? null : $post['supplier'],
            'jumlah' => $post['jumlah'],
            'qty' => $post['qty'],
            'harga' => $post['harga'],
            'tanggal' => $post['tanggal'],
            'user_id' => $this->session->userdata('userid'),
        ];
        $this->db->insert('b_purchase', $params);
    }

    public function get_bahan_out()
    {
        $this->db->select('b_purchase.purchase_id, b_stock.nama as nama_bahan,
        jumlah, b_purchase.harga as harga_beli, tanggal, detail, b_stock.bahan_id');
        $this->db->from('b_purchase');
        $this->db->join('b_stock', 'b_purchase.bahan_id = b_stock.bahan_id');
        $this->db->where('type', 'out');
        $this->db->order_by('purchase_id', 'desc');
        $query = $this->db->get();
        return $query;
    }



    public function add_purchase_out($post)
    {   
        // $this->db->select('b_purchase.*, b_stock.harga as harga_satuan')
        // $this->db->join('b_stock', 'b_purchase.bahan_id = b_stock.bahan_id');
        // $harga = $this->db->where('bahan_id', $post['bahan_id']);
        $params = [
            'bahan_id' => $post['bahan_id'],
            'type' => 'out',
            'detail' => $post['detail'],
            'jumlah' => $post['jumlah'],
            'harga' => $post['jumlah']*$post['harga'],
            'tanggal' => $post['tanggal'],
            'user_id' => $this->session->userdata('userid'),
        ];
        $this->db->insert('b_purchase', $params);
    }


}