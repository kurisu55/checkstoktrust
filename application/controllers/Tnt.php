<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Tnt extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        access_route();
        $this->load->model('M_Tnt');
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

        $data['list_PO'] = $this->M_Tnt->get_listPO();
        $data['title'] = 'Update PO';
        if ($this->form_validation->run() == false) {
            $this->load->view('Template/User_header', $data);
            $this->load->view('Template/User_sidebar', $data);
            $this->load->view('Template/User_topbar', $data);
            $this->load->view('tnt/index', $data);
            $this->load->view('Template/User_footer');
        } else {
            $data = $this->M_Tnt->inpuData_PO();
            $this->session->set_flashdata('pesan', '<div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>Berhasil!</strong> Purchase Order telah dibuat.
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
            </div>');
            redirect('Tnt');
        }
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
        $this->load->view('tnt/profile', $data);
        $this->load->view('Template/User_footer');
    }
    public function delete_po($id)
    {
        $this->M_Tnt->delete($id);
        $this->session->set_flashdata('pesan', '<div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>Berhasil!</strong> Purchase Order telah <span class="text-danger">dihapus</span>.
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
            </div>');
        redirect('Tnt/index');
    }

    public function confirm_PO($id)
    {
        $kode_po = $this->M_Tnt->kode_po();
        $data = [
            'is_confirm' => '1',
            'kode_po' => $kode_po
        ];
        $this->db->where('id', $id);
        $this->db->update('update_po', $data);
        $this->session->set_flashdata('pesan', '<div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>Berhasil!</strong> Purchase Order sudah dikirim ke Sales.
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
            </div>');
        redirect('Tnt');
    }
}
