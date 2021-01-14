<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Reportprod extends CI_Controller {

	function __construct()
    {
        parent::__construct();
        check_not_login();
        $this->load->model('model_transaksi_in', 'sale');
    }

	public function sale()
	{
		$data['row'] = $this->sale->get_sale();
		$this->template->load('template', 'report/prod_report', $data);
	}

	public function sale_bahan($transin_id = null)
	{
		$detail = $this->sale->get_sale_detail($transin_id)->result();
		echo json_encode($detail);
	}
}