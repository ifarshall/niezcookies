<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Report extends CI_Controller {

	function __construct()
    {
        parent::__construct();
        check_not_login();
        $this->load->model('model_transaksi_out', 'sale');
    }

	public function sale()
	{
		$this->load->library('pagination');
		$data['row'] = $this->sale->get_sale();
		$this->template->load('template', 'report/sale_report', $data);
	}

	public function sale_product($transout_id = null)
	{
		$detail = $this->sale->get_sale_detail($transout_id)->result();
		echo json_encode($detail);
	}
}