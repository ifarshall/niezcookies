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
		$data['row'] = $this->sale->get_sale();
		$this->template->load('template', 'report/sale_report', $data);
	}
}