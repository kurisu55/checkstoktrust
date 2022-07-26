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

        $data['list_PO'] = $this->M_Tnt->get_listPO();

        $data['title'] = 'Update PO';
        $this->load->view('Template/User_header', $data);
        $this->load->view('Template/User_sidebar', $data);
        $this->load->view('Template/User_topbar', $data);
        $this->load->view('tnt/index', $data);
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
        if ($this->form_validation->run() == true) {
            $this->index();
        } else {
            $this->_input_stok();
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
    private function _input_stok()
    {
        $id = $this->uri->segment('3');

        // Pengambilan data update PO ke deal stok
        $data['deal'] = $this->db->get_where('update_po', ['id' => $id])->row_array();

        $data = [
            'id'            => htmlspecialchars($data['deal']['id'], true),
            'kode_po'       => htmlspecialchars($data['deal']['kode_po'], true),
            'tgl_po'        => htmlspecialchars($data['deal']['tgl_po'], true),
            'brand'         => htmlspecialchars($data['deal']['brand'], true),
            'tipe_mobil'    => htmlspecialchars($data['deal']['tipe_mobil'], true),
            'plat_mobil'    => htmlspecialchars($data['deal']['plat_mobil'], true),
            'tahun'         => htmlspecialchars($data['deal']['tahun'], true),
            'warna'         => htmlspecialchars($data['deal']['warna'], true),
            'appraiser'     => htmlspecialchars($data['deal']['appraiser'], true),
        ];
        $this->db->insert('deal_stok', $data);
    }
}
