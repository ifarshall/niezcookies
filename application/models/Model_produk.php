<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Model_produk extends CI_Model {

    public function get($id = null)
    {
        $this->db->select('p_stock.*, r_jenis_produk.nama as nama_j_produk, r_satuan.nama as nama_satuan');
        $this->db->from('p_stock');
        $this->db->join('r_jenis_produk', 'r_jenis_produk.j_produk_id = p_stock.j_produk_id');
        $this->db->join('r_satuan', 'r_satuan.satuan_id = p_stock.satuan_id');
        if($id != null) {
            $this->db->where('produk_id', $id);

        }
        $this->db->order_by('barcode', 'asc');
        $query = $this->db->get();
        return $query;
    }

    public function add($post)
    {
        $params = [
            'barcode' => $post['barcode'],
            'nama' => $post['nama'],
            'j_produk_id' => $post['j_produk'],
            'satuan_id' => $post['satuan'],
            'harga' => $post['price'],
            // 'image' => $post['image'],
        ];
        $this->db->insert('p_stock', $params);
    }

    public function edit($post)
    {
        $params = [
            'barcode' => $post['barcode'],
            'nama' => $post['nama'],
            'j_produk_id' => $post['j_produk'],
            'satuan_id' => $post['satuan'],
            'harga' => $post['price'],
            // 'image' => $post['image'],
            'modified' => date('Y-m-d H:i:s')
        ];
        $this->db->where('produk_id', $post['id']);
        $this->db->update('p_stock', $params);
    }

    public function check_barcode($code, $id = null){
        $this->db->from('p_stock');
        $this->db->where('barcode', $code);
        if($id != null) {
            $this->db->where('produk_id !=', $id);
        }
        $query = $this->db->get();
        return $query;
    }

    public function del($id)
	{
        $this->db->where('produk_id', $id);
        $this->db->delete('p_stock');
    }

    function update_produksi_in($data)
    {
        $jumlah = $data['jumlah'];
        $id = $data['produk_id'];
        $sql = "UPDATE p_stock SET stock = stock + '$jumlah' WHERE produk_id = '$id'";
        $this->db->query($sql);
    }

    function update_produksi_out($data)
    {
        $jumlah = $data['jumlah'];
        $id = $data['produk_id'];
        $sql = "UPDATE p_stock SET stock = stock - '$jumlah' WHERE produk_id = '$id'";
        $this->db->query($sql);
    }

}