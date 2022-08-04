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

        // Set rules pada input list PO
        $this->form_validation->set_rules('tgl_po', 'Tanggal Purchase harus diisi', 'required');
        $this->form_validation->set_rules('brand', 'Brand harus diisi', 'required');
        $this->form_validation->set_rules('tipe_mobil', 'Tipe mobil harus diisi', 'required');
        $this->form_validation->set_rules('plat_mobil', 'Plat mobil harus diisi', 'required');
        $this->form_validation->set_rules('tahun', 'Tahun harus diisi', 'required');
        $this->form_validation->set_rules('warna', 'Warna harus diisi', 'required');
        $this->form_validation->set_rules('appraiser', 'Appraiser harus diisi', 'required');

        $data['list_PO'] = $this->M_User->get_listPO();
        $data['title'] = 'Buat Purchase Order';
        if ($this->form_validation->run() == false) {
            $this->load->view('Template/User_header', $data);
            $this->load->view('Template/User_sidebar', $data);
            $this->load->view('Template/User_topbar', $data);
            $this->load->view('Admin/index', $data);
            $this->load->view('Template/User_footer');
        } else {
            $data = $this->M_User->inpuData_PO();
            $this->session->set_flashdata('pesan', '<div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>Berhasil!</strong> Purchase Order telah dibuat.
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
            </div>');
            redirect('Admin/');
        }
    }

    public function profile()
    {
        /** Pengambilan data berdasarkan Nomor pegawai */
        $data['user'] = $this->db->get_where('tb_user', ['no_pegawai' =>
        $this->session->userdata('no_pegawai')])->row_array();
        /** End */

        $data['title'] = 'Admin Profile';
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
        $data['jabatan'] = ['TNT', 'Sales'];
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

    public function mobil_masuk()
    {
        /** Pengambilan data berdasarkan Nomor pegawai */
        $data['user'] = $this->db->get_where('tb_user', ['no_pegawai' =>
        $this->session->userdata('no_pegawai')])->row_array();
        /** End */


        $tgl_awal = $this->input->post('tgl_awal');
        $tgl_akhir = $this->input->post('tgl_akhir');

        $this->session->set_userdata('tgl_awal', $tgl_awal);
        $this->session->set_userdata('tgl_akhir', $tgl_akhir);


        if (empty($tgl_awal) || empty($tgl_akhir)) {
            $data['list_mobilMasuk'] = $this->M_User->list_mobilMasuk();
            $data['title'] = 'Mobil Masuk';
        } else {
            $data['title'] = 'Mobil Masuk';
            $data['list_mobilMasuk'] = $this->M_User->filter_mobilMasuk($tgl_awal, $tgl_akhir);
        }

        $this->load->view('Template/User_header', $data);
        $this->load->view('Template/User_sidebar', $data);
        $this->load->view('Template/User_topbar', $data);
        $this->load->view('admin/report/mobil_masuk', $data);
        $this->load->view('Template/User_footer');
    }
    public function mobil_keluar()
    {
        /** Pengambilan data berdasarkan Nomor pegawai */
        $data['user'] = $this->db->get_where('tb_user', ['no_pegawai' =>
        $this->session->userdata('no_pegawai')])->row_array();
        /** End */

        $tgl_awal = $this->input->post('tgl_awal');
        $tgl_akhir = $this->input->post('tgl_akhir');

        $this->session->set_userdata('tgl_awal', $tgl_awal);
        $this->session->set_userdata('tgl_akhir', $tgl_akhir);


        if (empty($tgl_awal) || empty($tgl_akhir)) {
            $data['list_mobilKeluar'] = $this->M_User->list_mobilKeluar();
            $data['title'] = 'Mobil Keluar';
        } else {
            $data['title'] = 'Mobil Keluar';
            $data['list_mobilKeluar'] = $this->M_User->filter_mobilKeluar($tgl_awal, $tgl_akhir);
        }

        $this->load->view('Template/User_header', $data);
        $this->load->view('Template/User_sidebar', $data);
        $this->load->view('Template/User_topbar', $data);
        $this->load->view('admin/report/mobil_keluar', $data);
        $this->load->view('Template/User_footer');
    }

    public function refresh()
    {
        /** Pengambilan data berdasarkan Nomor pegawai */
        $data['user'] = $this->db->get_where('tb_user', ['no_pegawai' =>
        $this->session->userdata('no_pegawai')])->row_array();
        /** End */

        $data['list_mobilMasuk'] = $this->M_User->list_mobilMasuk();
        $data['title'] = 'Mobil Masuk';
        $this->load->view('Template/User_header', $data);
        $this->load->view('Template/User_sidebar', $data);
        $this->load->view('Template/User_topbar', $data);
        $this->load->view('admin/report/mobil_masuk', $data);
        $this->load->view('Template/User_footer');
    }

    public function refresh2()
    {
        /** Pengambilan data berdasarkan Nomor pegawai */
        $data['user'] = $this->db->get_where('tb_user', ['no_pegawai' =>
        $this->session->userdata('no_pegawai')])->row_array();
        /** End */

        $data['list_mobilKeluar'] = $this->M_User->list_mobilKeluar();
        $data['title'] = 'Mobil Keluar';
        $this->load->view('Template/User_header', $data);
        $this->load->view('Template/User_sidebar', $data);
        $this->load->view('Template/User_topbar', $data);
        $this->load->view('admin/report/mobil_keluar', $data);
        $this->load->view('Template/User_footer');
    }

    public function pdf_mobilMasuk()
    {
        if (empty($this->session->userdata('tgl_awal')) || empty($this->session->userdata('tgl_awal'))) {
            $data['list_mobilMasuk'] = $this->M_User->list_mobilMasuk();
            $data['title'] = 'Laporan Mobil Masuk';
            $this->load->library('pdf');
            $this->pdf->setPaper('A4', 'potrait');
            $this->pdf->load_view('admin/report/pdf_mobilMasuk', $data);
        } else {
            $data['list_mobilMasuk'] = $this->M_User->filter_mobilMasuk($this->session->userdata('tgl_awal'), $this->session->userdata('tgl_akhir'));
            $data['title'] = 'Laporan Mobil Masuk';
            $this->load->library('pdf');
            $this->pdf->setPaper('A4', 'potrait');
            $this->pdf->load_view('admin/report/pdf_mobilMasuk', $data);
        }
        $this->load->library('pdf');
        $this->pdf->setPaper('A4', 'potrait');
        $this->pdf->load_view('admin/report/pdf_mobilMasuk', $data);
    }

    public function pdf_mobilKeluar()
    {
        if (empty($this->session->userdata('tgl_awal')) || empty($this->session->userdata('tgl_awal'))) {
            $data['list_mobilKeluar'] = $this->M_User->list_mobilKeluar();
            $data['title'] = 'Laporan Mobil Keluar';
            $this->load->library('pdf');
            $this->pdf->setPaper('A4', 'potrait');
            $this->pdf->load_view('admin/report/pdf_mobilKeluar', $data);
        } else {
            $data['list_mobilKeluar'] = $this->M_User->filter_mobilKeluar($this->session->userdata('tgl_awal'), $this->session->userdata('tgl_akhir'));
            $data['title'] = 'Laporan Mobil Keluar';
            $this->load->library('pdf');
            $this->pdf->setPaper('A4', 'potrait');
            $this->pdf->load_view('admin/report/pdf_mobilKeluar', $data);
        }
        $this->load->library('pdf');
        $this->pdf->setPaper('A4', 'potrait');
        $this->pdf->load_view('admin/report/pdf_mobilKeluar', $data);
    }
}
