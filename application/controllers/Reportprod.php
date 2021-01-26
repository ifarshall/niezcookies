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
		$this->load->model('model_producer');
		$this->load->library('pagination');

		if(isset($_POST['reset'])) {
			$this->session->unset_userdata('search');
		}
		
		if(isset($_POST['filter'])) {
			$post = $this->input->post(null, TRUE);
			$this->session->set_userdata('search', $post);
		} else {
			$post = $this->session->userdata('search');
		}
		

		$config['base_url'] = site_url('reportprod/sale');
		$config['total_rows']= $this->sale->get_sale_pagination()->num_rows();
		$config['per_page'] = 10;
		$config['uri_segment'] = 3;
		$config['first_link'] = 'Pertama';
		$config['next_link'] = 'Selanjutnya';
		$config['prev_link'] = 'Sebelumnya';
		$config['num_tag_open'] = '<li>';
		$config['num_tag_close'] = '</li>';
		$config['cur_tag_open'] = '<li class="active"><a>';
		$config['cur_tag_close'] = '</a></li>';
		$config['next_tag_open'] = '<li>';
		$config['next_tag_close'] = '</li>';
		$config['prev_tag_open'] = '<li>';
		$config['prev_tag_close'] = '</li>';
		$config['first_tag_open'] = '<li>';
		$config['first_tag_close'] = '</li>';
		$config['last_tag_open'] = '<li>';
		$config['last_tag_close'] = '</li>';

		$this->pagination->initialize($config);
		
		$data['pagination'] = $this->pagination->create_links();
		$data['producer'] = $this->model_producer->get()->result();
		$data['row'] = $this->sale->get_sale_pagination($config['per_page'], $this->uri->segment(3));
		$data['post'] = $post;
		$this->template->load('template', 'report/prod_report', $data);
	}

	public function sale_bahan($transin_id = null)
	{
		$detail = $this->sale->get_sale_detail($transin_id)->result();
		echo json_encode($detail);
	}
}