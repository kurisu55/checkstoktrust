<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Admin extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        access_route();
        $this->load->model('M_User');
    }

    public function index()
    {
        /** Pengambilan data berdasarkan Nomor pegawai */
        $data['user'] = $this->db->get_where('tb_user', ['no_pegawai' =>
        $this->session->userdata('no_pegawai')])->row_array();
        /** End */

        $data['title'] = 'Dashboard';
        $this->load->view('Template/User_header', $data);
        $this->load->view('Template/User_sidebar', $data);
        $this->load->view('Template/User_topbar', $data);
        $this->load->view('admin/index', $data);
        $this->load->view('Template/User_footer');
    }

    public function profile()
    {
        /** Pengambilan data berdasarkan Nomor pegawai */
        $data['user'] = $this->db->get_where('tb_user', ['no_pegawai' =>
        $this->session->userdata('no_pegawai')])->row_array();
        /** End */

        $data['title'] = 'Profile';
        $this->load->view('Template/User_header', $data);
        $this->load->view('Template/User_sidebar', $data);
        $this->load->view('Template/User_topbar', $data);
        $this->load->view('admin/profile', $data);
        $this->load->view('Template/User_footer');
    }

    public function data_profile()
    {
        $this->load->helper('form');
        /** Pengambilan data berdasarkan Nomor pegawai */
        $data['user'] = $this->db->get_where('tb_user', ['no_pegawai' =>
        $this->session->userdata('no_pegawai')])->row_array();
        /** End */

        $data['daftar_user'] = $this->M_User->get_daftarUser();
        if ($this->input->post('keyword')) {
            $data['daftar_user'] = $this->M_User->cari_userProfile();
        }

        $data['title'] = 'User Profile';
        $this->load->view('Template/User_header', $data);
        $this->load->view('Template/User_sidebar', $data);
        $this->load->view('Template/User_topbar', $data);
        $this->load->view('admin/user_dataProfile', $data);
        $this->load->view('Template/User_footer');
    }

    public function edit_data($no_pegawai)
    {
        /** Pengambilan data berdasarkan Nomor pegawai */
        $data['user'] = $this->db->get_where('tb_user', ['no_pegawai' =>
        $this->session->userdata('no_pegawai')])->row_array();
        /** End */

        /** Data variabel request */
        $data['daftar_user'] = $this->M_User->getUserByNRP($no_pegawai);
        $data['jabatan'] = ['Sales', 'TNT'];
        $data['region'] = ['Kalimalang', 'Bogor', 'Bandung', 'Bintaro', 'Surabaya', 'Medan'];
        $data['title'] = 'Ubah Data User';
        /**~~~~~*/

        $this->load->view('Template/User_header', $data);
        $this->load->view('Template/User_sidebar', $data);
        $this->load->view('Template/User_topbar', $data);
        $this->load->view('admin/edit_data', $data);
        $this->load->view('Template/User_footer');
    }

    public function hasil_update($no_pegawai)
    {
        $no_pegawai = $this->uri->segment('3');
        $this->M_User->update_user($no_pegawai);
        $this->session->set_flashdata('pesan', '<div class="alert alert-success alert-dismissible fade show" role="alert">
        <strong>Berhasil!</strong> Data user sudah diubah.
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
        </button>
        </div>');
        redirect('admin/data_profile');
    }

    public function delete_user($no_pegawai)
    {
        $this->M_User->delete_dataUser($no_pegawai);
        $this->session->set_flashdata('pesan', '<div class="alert alert-success alert-dismissible fade show" role="alert">
        <strong>Berhasil!</strong> User sudah dihapus.
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
        </div>');
        redirect('admin/data_profile');
    }
}
