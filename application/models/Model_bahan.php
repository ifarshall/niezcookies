<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Model_bahan extends CI_Model {

    public function get($id = null)
    {
        $this->db->select('b_stock.*, r_jenis_bahan.nama as nama_j_bahan, r_satuan.nama as nama_satuan');
        $this->db->from('b_stock');
        $this->db->join('r_jenis_bahan', 'r_jenis_bahan.j_bahan_id = b_stock.j_bahan_id');
        $this->db->join('r_satuan', 'r_satuan.satuan_id = b_stock.satuan_id');
        if($id != null) {
            $this->db->where('bahan_id', $id);

        }
        $query = $this->db->get();
        return $query;
    }

    public function add($post)
    {
        $params = [
            'barcode' => $post['barcode'],
            'nama' => $post['nama'],
            'j_bahan_id' => $post['j_bahan'],
            'satuan_id' => $post['satuan'],
        ];
        $this->db->insert('b_stock', $params);
    }

    public function edit($post)
    {
        $params = [
            'barcode' => $post['barcode'],
            'nama' => $post['nama'],
            'j_bahan_id' => $post['j_bahan'],
            'satuan_id' => $post['satuan'],
            'modified' => date('Y-m-d H:i:s')
        ];
        $this->db->where('bahan_id', $post['id']);
        $this->db->update('b_stock', $params);
    }

    public function check_bahan($code, $id = null){
        $this->db->from('b_stock');
        $this->db->where('nama', $code);
        if($id != null) {
            $this->db->where('bahan_id !=', $id);
        }
        $query = $this->db->get();
        return $query;
    }

    public function del($id)
	{
        $this->db->where('bahan_id', $id);
        $this->db->delete('b_stock');
    }

}