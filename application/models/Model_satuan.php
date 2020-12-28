<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Model_satuan extends CI_Model {

    public function get($id = null)
    {
        $this->db->from('r_satuan');
        if($id != null) {
            $this->db->where('satuan_id', $id);

        }
        $query = $this->db->get();
        return $query;
    }

    public function add($post)
    {
        $params = [
            'nama' => $post['nama'],
        ];
        $this->db->insert('r_satuan', $params);
    }

    public function edit($post)
    {
        $params = [
            'nama' => $post['nama'],
            'modified' => date('Y-m-d H:i:s')
        ];
        $this->db->where('satuan_id', $post['id']);
        $this->db->update('r_satuan', $params);
    }

    public function del($id)
	{
        $this->db->where('satuan_id', $id);
        $this->db->delete('r_satuan');
    }

}