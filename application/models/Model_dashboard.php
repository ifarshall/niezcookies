<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Model_dashboard extends CI_Model {

    public function get()
    {
        $this->db->select('b_stock.stock as stock_bahan, p_stock.stock as stock_produk');
        $this->db->from(['b_stock', 'p_stock']);
        $query = $this->db->get();
        return $query;
    }
}