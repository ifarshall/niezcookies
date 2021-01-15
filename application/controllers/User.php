<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller {

    function __construct()
    {
        parent::__construct();
        check_not_login();
        check_admin();
        $this->load->model('model_user');
        $this->load->library('form_validation');
    }

	public function index()
	{
        $data['row'] = $this->model_user->get();
		$this->template->load('template', 'user/user_data', $data);
    }
    
    //fungsi tambah user
    public function tambahUser()
    {

        $this->form_validation->set_rules('username', 'Username', 'required|min_length[5]|max_length[20]|is_unique[user.username]');
        $this->form_validation->set_rules('password', 'Password', 'required|min_length[5]');
        $this->form_validation->set_rules('passconf', 'Konfirmasi Password', 'required|matches[password]',
            array('matches' => '%s tidak sesuai dengan password')
        );
        $this->form_validation->set_rules('fullname', 'Nama', 'required|max_length[20]');
        $this->form_validation->set_rules('level', 'Kewenangan', 'required');

        $this->form_validation->set_message('required', '%s belum diisi. Silahkan diisi');
        $this->form_validation->set_message('min_length', '%s minimal diisi 5 karakter');
        $this->form_validation->set_message('is_unique', '%s tersebut telah digunakan');

        $this->form_validation->set_error_delimiters('<span class="help-block">','</span>');

        if ($this->form_validation->run() == FALSE) {
            $this->template->load('template', 'user/user_form_add');
        } else {
            $post= $this->input->post(null, TRUE);
            $this->model_user->tambahUser($post);
            if($this->db->affected_rows()>0) {
                $this->session->set_flashdata('success', 'Data Berhasil disimpan');
            }
            echo "<script>window.location='".site_url('user')."';</script>";
        }
    }

    //untuk mengubah user
    public function ubahUser($id)
    {
        $this->form_validation->set_rules('username', 'Username', 'required|min_length[5]|callback_cekUser');
        if ($this->input->post('password')){
            $this->form_validation->set_rules('password', 'Password', 'min_length[5]');
            $this->form_validation->set_rules('passconf', 'Konfirmasi Password', 'matches[password]',
                array('matches' => '%s tidak sesuai dengan password')
            );
        }
        if ($this->input->post('passconf')){
            $this->form_validation->set_rules('passconf', 'Konfirmasi Password', 'matches[password]',
                array('matches' => '%s tidak sesuai dengan password')
            );
        }
        $this->form_validation->set_rules('fullname', 'Nama', 'required|max_length[20]');
        $this->form_validation->set_rules('level', 'Kewenangan', 'required');

        $this->form_validation->set_message('required', '%s belum diisi. Silahkan diisi');
        $this->form_validation->set_message('min_length', '%s minimal diisi 5 karakter');
        $this->form_validation->set_message('is_unique', '%s tersebut telah digunakan');

        $this->form_validation->set_error_delimiters('<span class="help-block">','</span>');

        if ($this->form_validation->run() == FALSE) {
            $query = $this->model_user->get($id);
            if($query->num_rows() > 0) {
                $data['row'] = $query->row();
                $this->template->load('template', 'user/user_form_edit', $data);
            } else {
                echo "<script>alert('Data tidak ditemukan');"; //apabila search html user yang tidak ada user idnya, maka tidak muncul
                echo "window.location='".site_url('user')."';</script>";
            }
        } else {
            $post= $this->input->post(null, TRUE);
            $this->model_user->ubahUser($post);
            if($this->db->affected_rows()>0) {
                $this->session->set_flashdata('success', 'Data Berhasil disimpan');
            }
            echo "<script>window.location='".site_url('user')."';</script>";
        }
    }

        //untuk mengubah user sendiri
        public function profile($id)
        {
            $this->form_validation->set_rules('username', 'Username', 'required|min_length[5]|callback_cekUser');
            if ($this->input->post('password')){
                $this->form_validation->set_rules('password', 'Password', 'min_length[5]');
                $this->form_validation->set_rules('passconf', 'Konfirmasi Password', 'matches[password]',
                    array('matches' => '%s tidak sesuai dengan password')
                );
            }
            if ($this->input->post('passconf')){
                $this->form_validation->set_rules('passconf', 'Konfirmasi Password', 'matches[password]',
                    array('matches' => '%s tidak sesuai dengan password')
                );
            }
            // $this->form_validation->set_rules('fullname', 'Nama', 'required|max_length[20]');
            // $this->form_validation->set_rules('level', 'Kewenangan', 'required');
    
            $this->form_validation->set_message('required', '%s belum diisi. Silahkan diisi');
            $this->form_validation->set_message('min_length', '%s minimal diisi 5 karakter');
            $this->form_validation->set_message('is_unique', '%s tersebut telah digunakan');
    
            $this->form_validation->set_error_delimiters('<span class="help-block">','</span>');
    
            if ($this->form_validation->run() == FALSE) {
                $query = $this->model_user->get($id);
                if($query->num_rows() > 0) {
                    $data['row'] = $query->row();
                    $this->template->load('template', 'user/user_edit_self', $data);
                } else {
                    echo "<script>alert('Data tidak ditemukan');"; //apabila search html user yang tidak ada user idnya, maka tidak muncul
                    echo "window.location='".site_url('user')."';</script>";
                }
            } else {
                $post= $this->input->post(null, TRUE);
                $this->model_user->ubahUser2($post);
                if($this->db->affected_rows()>0) {
                    $this->session->set_flashdata('success', 'Data Berhasil disimpan');
                }
                echo "<script>window.location='".site_url('dashboard')."';</script>";
            }
        }
    //fungsi untuk Callback usernya, sehingga yang akan error apabila user sudah ada saja
    function cekUser(){
        $post = $this->input->post(null, TRUE);
        // var_dump($post);die;
        $query = $this->db->query("SELECT * FROM user WHERE username = '$post[username]' AND user_id != '$post[user_id]'"); //artinya memilih seluruh username selain username id yang lagi dipilih
        // var_dump($query);die;
        if($query->num_rows() > 0) {
            $this->form_validation->set_message('cekUser', '%s ini sudah dipakai. Silahkan gunakan username lain'); //tadi kan yang diselect selain username yg dipilih, jadi klo pakai username yg sudah ada, selain username yg skrg dipakai, akan error
            return FALSE;
        } else {
            return TRUE;
            // // $this->session->set_flashdata('success', 'Data Berhasil disimpan');
            // redirect('user');
        }

    }

    //untuk menghapus user
    public function hapusUser($id)
    {
        $this->model_user->hapusUser($id);

        if($this->db->affected_rows()>0) {
            $this->session->set_flashdata('success', 'Data Berhasil dihapus');
        }
        redirect('user');
    }
}
