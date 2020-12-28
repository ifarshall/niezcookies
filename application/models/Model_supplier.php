<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Model_supplier extends CI_Model {

    public function get($id = null)
    {
        $this->db->from('supplier');
        if($id != null) {
            $this->db->where('supplier_id', $id);

        }
        $query = $this->db->get();
        return $query;
    }

    public function add($post)
    {
        $params = [
            'nama_toko' => $post['nama_toko'],
            'lokasi_toko' => $post['lokasi_toko'],
            'telepon' => empty($post['telepon']) ? null : $post['telepon'],
            'deskripsi' => empty($post['deskripsi']) ? null : $post['deskripsi'],
        ];
        $this->db->insert('supplier', $params);
    }

    public function edit($post)
    {
        $params = [
            'nama_toko' => $post['nama_toko'],
            'lokasi_toko' => $post['lokasi_toko'],
            'telepon' => empty($post['telepon']) ? null : $post['telepon'],
            'deskripsi' => empty($post['deskripsi']) ? null : $post['deskripsi'],
        ];
        $this->db->where('supplier_id', $post['id']);
        $this->db->update('supplier', $params);
    }

    public function del($id)
	{
        $this->db->where('supplier_id', $id);
        $this->db->delete('supplier');
    }

}