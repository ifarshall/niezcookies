<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Model_customer extends CI_Model {

    public function get($id = null)
    {
        $this->db->from('customer');
        if($id != null) {
            $this->db->where('customer_id', $id);

        }
        $query = $this->db->get();
        return $query;
    }

    public function add($post)
    {
        $params = [
            'nama' => $post['nama'],
            'gender' => $post['gender'],
            'telepon' => $post['telepon'],
            'alamat' => empty($post['alamat']) ? null : $post['alamat']
        ];
        $this->db->insert('customer', $params);
    }

    public function edit($post)
    {
        $params = [
            'nama' => $post['nama'],
            'gender' => $post['gender'],
            'telepon' => $post['telepon'],
            'alamat' => empty($post['alamat']) ? null : $post['alamat'],
            'modified' => date('Y-m-d H:i:s')
        ];
        $this->db->where('customer_id', $post['id']);
        $this->db->update('customer', $params);
    }

    public function del($id)
	{
        $this->db->where('customer_id', $id);
        $this->db->delete('customer');
    }

}