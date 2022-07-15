<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Auth extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->library('form_validation');
		$this->load->model('M_Auth');
	}

	/**Function halaman index atau login akun */
	public function index()
	{

		/**Mencegah user saat session masih ada tidak bisa pindah langsung ke auth maupun registrasi*/
		$role_id = $this->session->userdata('role_id');
		if ($this->session->userdata('no_pegawai')) {
			if ($role_id['role_id'] == 1) {
				redirect('admin');
			} elseif ($role_id['role_id'] == 2) {
				redirect('tnt');
			} elseif ($role_id['role_id'] == 3) {
				redirect('sales');
			}
		}

		/** Set aturan dalam penginputan */
		$this->form_validation->set_rules('no_pegawai', 'Nomor Pegawai', 'trim|required', [
			'required' => 'Nomor pegawai harap diisi dengan benar!'
		]);
		$this->form_validation->set_rules('password', 'Password', 'trim|required', [
			'required' => 'Password harap diisi dengan benar!'
		]);

		if ($this->form_validation->run() == false) {
			$data['title'] = 'Login';
			$this->load->view('Template/Auth_header', $data);
			$this->load->view('Auth/login');
			$this->load->view('Template/Auth_footer');
		} else {

			/** Validasi sukses */
			$this->_login();
		}
	}

	/** Dibuat private*/
	private function _login()
	{
		$no_pegawai	= $this->input->post('no_pegawai');
		$password	= $this->input->post('password');

		$user		= $this->db->get_where('tb_user', ['no_pegawai' => $no_pegawai])->row_array();

		/** Pengecekkan user bila tersedia di database */
		if ($user) {
			//Pengecekkan user tersedia bila passwordnya salah

			if (password_verify($password, $user['password'])) {
				$data = [
					'no_pegawai'	=> $user['no_pegawai'],
					'role_id'		=> $user['role_id']
				];
				$this->session->set_userdata($data);
				if ($user['role_id'] == 1) {
					redirect('Admin');
				} else if ($user['role_id'] == 2) {
					redirect('Tnt');
				} else if ($user['role_id'] == 3) {
					redirect('Sales');
				}
			} else {
				$this->session->set_flashdata('pesan', '<div class="alert-danger" role="alert">Password salah.</div>');
				redirect('auth');
			}

			/** Bila akun tidak tersedia */
		} else {
			$this->session->set_flashdata('pesan', '<div class="alert-danger" role="alert">Akun tidak tersedia. Silahkan cek dahulu nomor pegawainya atau registrasi bila tidak memiliki akun.</div>');
			redirect('auth');
		}
	}

	/**Function halaman registrasi */
	public function registration()
	{
		/**Mencegah user saat session masih ada tidak bisa pindah langsung ke auth maupun registrasi*/
		$role_id = $this->session->userdata('role_id');
		if ($this->session->userdata('no_pegawai')) {
			if ($role_id['role_id'] == 1) {
				redirect('admin');
			} elseif ($role_id['role_id'] == 2) {
				redirect('tnt');
			} elseif ($role_id['role_id'] == 3) {
				redirect('sales');
			}
		}

		/** Set aturan dalam penginputan */
		$this->form_validation->set_rules('role_id', 'Divisi Pekerjaan', 'required|trim');
		$this->form_validation->set_rules('no_pegawai', 'No Pegawai', 'required|trim|is_unique[tb_user.no_pegawai]', [
			'required' 	=> 'Nomor Pegawai harus diisi!',
			'is_unique'	=> 'Nomor pegawai ini sudah didaftarkan di database.'
		]);
		$this->form_validation->set_rules('name', 'Nama', 'required|trim', [
			'required' => 'Nama Lengkap harus diisi!'
		]);
		$this->form_validation->set_rules('no_telp', 'Nomor Telepon', 'required|trim', [
			'required' => 'Nomor telepon diisi dengan nomor aktif!'
		]);
		$this->form_validation->set_rules('password', 'Password', 'required|trim|min_length[4]', [
			'required' => 'Password harus diisi!',
			'min_length' => 'Password minimal 4 karakter!'
		]);


		if ($this->form_validation->run() == false) {
			$data['title'] = 'Registration';
			$this->load->view('Template/Auth_header', $data);
			$this->load->view('Auth/registration');
			$this->load->view('Template/Auth_footer');
		} else {
			$this->M_Auth->input_registration();
			$this->session->set_flashdata('pesan', '<div class="alert-success" role="alert">Akun anda sudah dibuat. Silahkan Login!</div>');
			redirect('auth');
		}
	}

	public function forgot_password()
	{
		if ($this->form_validation->run() == false) {
			$data['title'] = 'Forgot Password';
			$this->load->view('Template/Register_header', $data);
			$this->load->view('Auth/forgot_password');
			$this->load->view('Template/Register_footer');
		} else {
		}
	}

	/** Untuk Logout */
	public function logout()
	{
		$this->session->unset_userdata('no_pegawai');
		$this->session->unset_userdata('password');
		$this->session->set_flashdata('pesan', '<div class="alert-success" role="alert">Akun sudah logout.</div>');
		redirect('auth');
	}

	public function blocked()
	{
		$data['title'] = 'Kesalahan 403';
		$this->load->view('auth/blocked', $data);
	}
}
