<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {

	public function login()
	{
		check_already_login();
		$this->load->view('login');
	}

	public function process()
	{
		$post = $this->input->post(null, TRUE);
		if(isset($post['login'])) {
			$this->load->model('model_user');
			$query = $this->model_user->login($post);
			?>
			<link rel="stylesheet" href="<?=base_url()?>assets/plugins/sweetalert2/sweetalert2.min.css">
			<link rel="stylesheet" href="<?=base_url()?>assets/plugins/sweetalert2/animate.min.css">
			<script src="<?=base_url()?>assets/plugins/sweetalert2/sweetalert2.min.js"></script>
			<style>
			body {
				font-family: "Helvetica Neue", Helvetica, Arial, sans-serif;
				font-size: 1.124em;
				font-weight: normal;
			}
			</style>
			<body></body>
			<?php
			if($query->num_rows() > 0) {
				$row = $query->row();
				$params = array(
					'userid' => $row->user_id,
					'level' => $row->kewenangan
				);
				$this->session->set_userdata($params);
				?>
				<script>
				Swal.fire({
					icon: 'success',
					title: 'Berhasil',
					text: 'Selamat, Login Berhasil',
					showClass: {
						popup: 'animate__animated animate__fadeInDown'
					},
					hideClass: {
						popup: 'animate__animated animate__fadeOutUp'
					}
				}).then((result) => {
					window.location='<?=site_url('dashboard')?>';
				})
				</script>
				<?php
			} else {
				?>
				<script>
				Swal.fire({
					icon: 'error',
					title: 'Gagal',
					text: 'Login Gagal, Username / Password salah',
					showClass: {
						popup: 'animate__animated animate__fadeInDown'
					},
					hideClass: {
						popup: 'animate__animated animate__fadeOutUp'
					}
				}).then((result) => {
					window.location='<?=site_url('auth/login')?>';
				})
				</script>
				<?php
			}
		}
	}

	public function logout()
	{
		$params = array('userid', 'level');
		$this->session->unset_userdata($params);
		redirect('auth/login');
	}
}
