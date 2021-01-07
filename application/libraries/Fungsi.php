<?php
Class Fungsi {

    protected $ci;

    function __construct() {
        $this->ci =& get_instance();
    }

    function user_login() {
        $this->ci->load->model('model_user');
        $user_id = $this->ci->session->userdata('userid');
        $user_data = $this->ci->model_user->get($user_id)->row();
        return $user_data; 
    }

    function PdfGenerator($html, $filename, $paper, $orientation) {
        $dompdf = new Dompdf\Dompdf();
        $dompdf->loadHtml($html);
        // (Optional) Setup the paper size and orientation
        $dompdf->setPaper($paper, $orientation);
        // Render the HTML as PDF
        $dompdf->render();
        // Output the generated PDF to Browser
        $dompdf->stream($filename, array('Attachment' => 0));
    }

    public function count_bahan(){
        $this->ci->load->model('model_bahan');
        return $this->ci->model_bahan->get()->num_rows();
    }

    public function count_produk(){
        $this->ci->load->model('model_produk');
        return $this->ci->model_produk->get()->num_rows();
    }
    
    public function count_supplier(){
        $this->ci->load->model('model_supplier');
        return $this->ci->model_supplier->get()->num_rows();
    }
    
    public function count_user(){
        $this->ci->load->model('model_user');
        return $this->ci->model_user->get()->num_rows();
    }

}