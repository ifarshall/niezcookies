<?php defined('BASEPATH') OR exit('No direct script access allowed');

class M_query extends CI_Model {

    public function get_sum_produk()
    {
        $sql = "SELECT sum(harga*stock) AS total_price FROM p_stock";
        $result = $this->db->query($sql);
        return $result->row()->total_price;
    }

    public function get_sum_bahan()
    {
        $sql = "SELECT sum(total_harga) as total_harga FROM b_stock";
        $result = $this->db->query($sql);
        return $result->row()->total_harga;
    }

    public function get_stock_toples()
    {
        $sql = "SELECT SUM(stock) as stock FROM `b_stock` WHERE j_bahan_id='6'";
        $result = $this->db->query($sql);
        return $result->row()->stock;
    }
    
    public function get_jual_bulanan()
    {
        $sql = "SELECT sum(final_price) AS final_price FROM trans_out WHERE tanggal LIKE '2021-01%'"; //ganti setiap bulan
        $result = $this->db->query($sql);
        return $result->row()->final_price;
    }

    public function get_beli_bulanan()
    {
        $sql = "SELECT sum(qty*harga) AS total_belanja FROM `b_purchase` WHERE type='in' and tanggal LIKE '2021-01%'"; //ganti setiap bulan
        $result = $this->db->query($sql);
        return $result->row()->total_belanja;
    }

    public function get_produk_terlaris()
    {
    $sql = "SELECT p_stock.nama, SUM(jumlah) AS produkterlaris FROM `t_out_detail` LEFT JOIN p_stock ON t_out_detail.produk_id = p_stock.produk_id GROUP BY t_out_detail.produk_id ORDER BY sum(jumlah) DESC";
    $result = $this->db->query($sql);
    if ($result->num_rows() > 0) {
        return $result->row()->nama;
    } else {
        return false;
    }
    // return $result->row()->nama;
    }

    public function get_belum_rekam()
    {
        $sql = "SELECT count(transin_id) AS belumrekam FROM trans_in WHERE transin_id NOT IN (SELECT transin_id FROM p_production)"; //liat yang udah keluar dari bahan belum rekam di produk
        $result = $this->db->query($sql);
        return $result->row()->belumrekam;
    }

    public function get_pesanan()
    {
        $sql = "SELECT count(id) AS pesanan FROM events"; //liat yang udah keluar dari bahan belum rekam di produk
        $result = $this->db->query($sql);
        return $result->row()->pesanan;
    }
    
}