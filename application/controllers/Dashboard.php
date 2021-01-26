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
		$data['belumrekam'] = $this->m_query->get_belum_rekam();
		$data['pesanan'] = $this->m_query->get_pesanan();

		$query = $this->db->query("SELECT t_out_detail.produk_id, p_stock.nama, (SELECT SUM(t_out_detail.jumlah)) AS sold
			FROM t_out_detail
				INNER JOIN trans_out ON t_out_detail.transout_id = trans_out.transout_id
				INNER JOIN p_stock ON t_out_detail.produk_id = p_stock.produk_id
				
			GROUP BY t_out_detail.produk_id
			ORDER BY sold DESC
			LIMIT 10");

		$data['row'] = $query->result();

		$this->template->load('template', 'dashboard', $data);
	}
	
}
