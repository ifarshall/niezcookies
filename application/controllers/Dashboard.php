<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

	function __construct()
    {
        parent::__construct();
        check_not_login();
        $this->load->model('m_query');
    }

	public function index()
	{
		$data['sumproduk'] = $this->m_query->get_sum_produk();
		$data['sumbahan'] = $this->m_query->get_sum_bahan();
		$data['stocktoples'] = $this->m_query->get_stock_toples();
		$data['jualbulanan'] = $this->m_query->get_jual_bulanan();
		$data['belibulanan'] = $this->m_query->get_beli_bulanan();
		$data['produkterlaris'] = $this->m_query->get_produk_terlaris();
		$this->template->load('template', 'dashboard', $data);
	}
	
}
