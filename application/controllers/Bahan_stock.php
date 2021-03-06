<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Bahan_stock extends CI_Controller {

	function __construct()
    {
        parent::__construct();
        check_not_login();
        $this->load->model(['model_bahan', 'model_j_bahan', 'model_satuan']);
    }

    function get_ajax() {
        $list = $this->model_bahan->get_datatables();
        $data = array();
        $no = @$_POST['start'];
        foreach ($list as $bahan) {
            $no++;
            $row = array();
            $row[] = $no.".";
            $row[] = $bahan->j_bahan_nama;
            $row[] = $bahan->nama;
            $row[] = indo_currency($bahan->total_harga);
            $row[] = indo_currency($bahan->harga);
            $row[] = $bahan->stock;
            $row[] = $bahan->satuan_nama;
            // add html for action
            $row[] = '<a href="'.site_url('bahan_stock/edit/'.$bahan->bahan_id).'" class="btn btn-warning btn-xs"><i class="fa fa-pencil"></i> Ubah</a>
                    <a href="'.site_url('bahan_stock/del/'.$bahan->bahan_id).'" id="btn-hapus" class="btn btn-danger btn-xs"><i class="fa fa-trash"></i> Hapus</a>';
            $data[] = $row;
        }
        $output = array(
                    "draw" => @$_POST['draw'],
                    "recordsTotal" => $this->model_bahan->count_all(),
                    "recordsFiltered" => $this->model_bahan->count_filtered(),
                    "data" => $data,
                );
        // output to json format
        echo json_encode($output);
    }

	public function index()
	{
		$data['row'] = $this->model_bahan->get();
		$this->template->load('template', 'bahan/stock_bahan/bahan_data', $data);
	}

	public function add()
	{
		$bahan = new stdClass();
        $bahan->bahan_id = null;
        $bahan->barcode = null;
        $bahan->nama = null;
        $bahan->j_bahan_id = null;
        
        $query_j_bahan = $this->model_j_bahan->get();

        $query_satuan = $this->model_satuan->get();
        $satuan[null] = '- Pilih -';
        foreach($query_satuan->result() as $sat){
            $satuan[$sat->satuan_id] = $sat->nama;
        }

		$data = array (
			'page' => 'tambah',
            'row' => $bahan,
            'j_bahan' => $query_j_bahan,
            'satuan' => $satuan, 'selectedsatuan' => null,
		);
		$this->template->load('template', 'bahan/stock_bahan/bahan_form', $data);
	}

	public function edit($id)
	{
		$query = $this->model_bahan->get($id);
		if($query->num_rows() > 0) {
			$bahan = $query->row();
			$query_j_bahan = $this->model_j_bahan->get();

            $query_satuan = $this->model_satuan->get();
            $satuan[null] = '- Pilih -';
            foreach($query_satuan->result() as $sat){
                $satuan[$sat->satuan_id] = $sat->nama;
            }

            $data = array (
                'page' => 'ubah',
                'row' => $bahan,
                'j_bahan' => $query_j_bahan,
                'satuan' => $satuan, 'selectedsatuan' => $bahan->satuan_id,
            );
            $this->template->load('template', 'bahan/stock_bahan/bahan_form', $data);
		} else {
			echo "<script>alert('Data tidak dbahanukan');"; //apabila search html yang tidak ada idnya, maka tidak muncul
			echo "window.location='".site_url('bahan')."';</script>";
		}
	}

	public function process()
	{
		$post = $this->input->post(null, TRUE);
		if(isset($_POST['tambah'])){
            if($this->model_bahan->check_bahan($post['nama'])->num_rows() > 0) {
                $this->session->set_flashdata('error', "Bahan $post[nama] sudah terdaftar");
                redirect('bahan_stock/add');
            } else {
                $this->model_bahan->add($post);
            }
		} else if(isset($_POST['ubah'])){
            if($this->model_bahan->check_bahan($post['nama'], $post['id'])->num_rows() > 0) {
                $this->session->set_flashdata('error', "Bahan $post[barcode] sudah terdaftar");
                redirect('bahan_stock/edit/'.$post['id']);
            } else {
                $this->model_bahan->edit($post);
            }
		}
		
		if($this->db->affected_rows()>0) {
            $this->session->set_flashdata('success', 'Data Berhasil disimpan');
        }
        redirect('bahan_stock');

	}

	public function del($id)
    {
        $this->model_bahan->del($id);

        if($this->db->affected_rows()>0) {
            $this->session->set_flashdata('success', 'Data Berhasil dihapus');
        }
        redirect('bahan_stock');
	}

}