<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Model_user extends CI_Model {

    public function login($post) {

        $this->db->select('*');
        $this->db->from('user');
        $this->db->where('username', $post['username']);
        $this->db->where('password', sha1($post['password']));
        $query = $this->db->get();
        return $query;
    }

    public function get($id = null)
    {
        $this->db->from('user');
        if($id != null) {
            $this->db->where('user_id', $id);

        }
        $query = $this->db->get();
        return $query;
    }

    public function tambahUser($post)
    {
        $params['username'] = $post['username'];
        $params['nama'] = $post['fullname'];
        $params['password'] = sha1($post['password']);
        $params['nomor_hp'] = $post['phonenumber'] !="" ? $post['phonenumber'] : null;
        $params['kewenangan'] = $post['level'];
        $this->db->insert('user', $params);
    }

    public function ubahUser($post)
    {
        $params['username'] = $post['username'];
        $params['nama'] = $post['fullname'];
        if(!empty($post['password'])){
             $params['password'] = sha1($post['password']);
        }
        $params['nomor_hp'] = $post['phonenumber'] !="" ? $post['phonenumber'] : null;
        $params['kewenangan'] = $post['level'];
        $this->db->where('user_id', $post['user_id']);
        $this->db->update('user', $params);
    }

    public function ubahUser2($post)
    {
        $params['username'] = $post['username'];
        // $params['nama'] = $post['fullname'];
        if(!empty($post['password'])){
             $params['password'] = sha1($post['password']);
        }
        $params['nomor_hp'] = $post['phonenumber'] !="" ? $post['phonenumber'] : null;
        // $params['kewenangan'] = $post['level'];
        $this->db->where('user_id', $post['user_id']);
        $this->db->update('user', $params);
    }

    public function hapusUser($id)
	{
        $this->db->where('user_id', $id);
        $this->db->delete('user');
    }

}