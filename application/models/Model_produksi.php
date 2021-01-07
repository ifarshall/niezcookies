<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Model_produksi extends CI_Model {

    public function get($id = null)
    {
        $this->db->from('p_production');
        if($id != null) {
            $this->db->where('produksi_id', $id);
        }
        $query = $this->db->get();
        return $query;
    }

    public function del($id)
    {
        $this->db->where('produksi_id', $id);
        $this->db->delete('p_production');
    }

    public function get_invoice()
    {
        $this->db->select('p_production.*, trans_in.*');
        $this->db->from('p_production');
        $this->db->join('trans_in', 'p_production.transin_id = trans_in.transin_id', 'left');
        $query = $this->db->get();
        return $query;
    }

    public function get_produk_in()
    {
        $this->db->select('p_production.produksi_id, p_stock.barcode, p_stock.nama as nama_produk,
        jumlah, tanggal, detail, transin_id,
        producer.nama as nama_producer, p_stock.produk_id');
        $this->db->from('p_production');
        // if('trans_id' != null) {
            // }
        // $this->db->join('trans_in', 'p_production.transin_id = trans_in.transin_id'); //kenapa ini error terus yak
        $this->db->join('p_stock', 'p_production.produk_id = p_stock.produk_id');
        $this->db->join('producer', 'p_production.producer_id = producer.producer_id', 'left');
        $this->db->where('type', 'in');
        $this->db->order_by('produksi_id', 'desc');
        $query = $this->db->get();
        return $query;
        
    }

    public function add_produksi_in($post)
    {
        $params = [
            'produk_id' => $post['produk_id'],
            'type' => 'in',
            'detail' => $post['detail'],
            'producer_id' => $post['producer'] == '' ? null : $post['producer'],
            'jumlah' => $post['jumlah'],
            'tanggal' => $post['tanggal'],
            'user_id' => $this->session->userdata('userid'),
            'transin_id' => $post['transin_id'],
        ];
        $this->db->insert('p_production', $params);
    }

    public function get_produk_out()
    {
        $this->db->select('p_production.produksi_id, p_stock.barcode, p_stock.nama as nama_produk,
        jumlah, tanggal, detail,
        producer.nama as nama_producer, p_stock.produk_id');
        $this->db->from('p_production');
        $this->db->join('p_stock', 'p_production.produk_id = p_stock.produk_id');
        $this->db->join('producer', 'p_production.producer_id = producer.producer_id', 'left');
        $this->db->where('type', 'out');
        $this->db->order_by('produksi_id', 'desc');
        $query = $this->db->get();
        return $query;
    }

    public function add_produksi_out($post)
    {
        $params = [
            'produk_id' => $post['produk_id'],
            'type' => 'out',
            'detail' => $post['detail'],
            'producer_id' => $post['producer'] == '' ? null : $post['producer'],
            'jumlah' => $post['jumlah'],
            'tanggal' => $post['tanggal'],
            'user_id' => $this->session->userdata('userid'),
        ];
        $this->db->insert('p_production', $params);
    }

    public function check_stock($stock, $id = null){
        $this->db->from('p_stock');
        $this->db->where('stock', $stock);
        if($id != null) {
        $this->db->where('produk_id', $id);
        }
        $query = $this->db->get();
        return $query;
    }

}