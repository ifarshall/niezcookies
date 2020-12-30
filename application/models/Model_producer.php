<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Model_producer extends CI_Model {

    public function get($id = null)
    {
        $this->db->from('producer');
        if($id != null) {
            $this->db->where('producer_id', $id);

        }
        $query = $this->db->get();
        return $query;
    }

    public function add($post)
    {
        $params = [
            'nama' => $post['nama'],
            'lokasi' => $post['lokasi'],
            'telepon' => empty($post['telepon']) ? null : $post['telepon'],
            'deskripsi' => empty($post['deskripsi']) ? null : $post['deskripsi'],
        ];
        $this->db->insert('producer', $params);
    }

    public function edit($post)
    {
        $params = [
            'nama' => $post['nama'],
            'lokasi' => $post['lokasi'],
            'telepon' => empty($post['telepon']) ? null : $post['telepon'],
            'deskripsi' => empty($post['deskripsi']) ? null : $post['deskripsi'],
        ];
        $this->db->where('producer_id', $post['id']);
        $this->db->update('producer', $params);
    }

    public function del($id)
	{
        $this->db->where('producer_id', $id);
        $this->db->delete('producer');
    }

}