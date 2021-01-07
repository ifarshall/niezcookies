<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class J_bahan extends CI_Controller {

	function __construct()
    {
        parent::__construct();
        check_not_login();
        $this->load->model('model_j_bahan');
    }

	public function index()
	{
		$data['row'] = $this->model_j_bahan->get();
		$this->template->load('template', 'referensi/jenis_bahan/j_bahan_data', $data);
	}
}