<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Sales extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        access_route();
        $this->load->model('M_Sales');
    }

    public function index()
    {
        /** Pengambilan data berdasarkan Nomor pegawai */
        $data['user'] = $this->db->get_where('tb_user', ['no_pegawai' =>
        $this->session->userdata('no_pegawai')])->row_array();
        /** End */

        $data['list_PO'] = $this->M_Sales->get_listPO();
        if ($this->input->post('keyword')) {
            $data['list_PO'] = $this->M_Sales->get_platMobil();
        }

        // Set rules pada id
        $this->form_validation->set_rules('id', '', 'is_unique[deal_stok.id]', ['is_unique' => 'Anda sudah melakukan deal tersebut']);

        $data['title'] = 'View Stock';
        if ($this->form_validation->run() == false) {
            $this->load->view('Template/User_header', $data);
            $this->load->view('Template/User_sidebar', $data);
            $this->load->view('Template/User_topbar', $data);
            $this->load->view('Sales/index', $data);
            $this->load->view('Template/User_footer');
        } else {
            $booking = 1;
            $data = [
                'id'            => $this->input->post('id'),
                'tgl_po'        => $this->input->post('tgl_po'),
                'brand'         => $this->input->post('brand'),
                'tipe_mobil'    => $this->input->post('tipe_mobil'),
                'plat_mobil'    => $this->input->post('plat_mobil'),
                'tahun'         => $this->input->post('tahun'),
                'warna'         => $this->input->post('warna'),
                'appraiser'     => $this->input->post('appraiser'),
                'is_booking'    => $booking,
                'sales'         => $this->input->post('sales'),
            ];
            $this->db->insert('deal_stok', $data);
            $this->session->set_flashdata('pesan', '<div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>Berhasil!</strong>. Stok ini sudah <span class="text-warning">dibooking</span>.
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
            </div>');
            redirect('Sales');
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
        $this->load->view('Sales/profile', $data);
        $this->load->view('Template/User_footer');
    }

    public function stok_comingSoon()
    {
        /** Pengambilan data berdasarkan Nomor pegawai */
        $data['user'] = $this->db->get_where('tb_user', ['no_pegawai' =>
        $this->session->userdata('no_pegawai')])->row_array();
        /** End */

        $data['list_PO'] = $this->M_Sales->getList_comingSoon();

        $data['title'] = 'View Stok Coming Soon';

        $this->load->view('Template/User_header', $data);
        $this->load->view('Template/User_sidebar', $data);
        $this->load->view('Template/User_topbar', $data);
        $this->load->view('Sales/stok_comingSoon', $data);
        $this->load->view('Template/User_footer');
    }

    public function booking()
    {
        $this->form_validation->set_rules('id', 'Id', 'is_unique[deal_stok.id]', ['is_unique' => 'Anda sudah melakukan deal tersebut']);

        if ($this->form_validation->run() == true) {
            $booking = 1;
            $data = [
                'id'            => $this->input->post('id'),
                'tgl_po'        => $this->input->post('tgl_po'),
                'brand'         => $this->input->post('brand'),
                'tipe_mobil'    => $this->input->post('tipe_mobil'),
                'plat_mobil'    => $this->input->post('plat_mobil'),
                'tahun'         => $this->input->post('tahun'),
                'warna'         => $this->input->post('warna'),
                'appraiser'     => $this->input->post('appraiser'),
                'is_booking'    => $booking,
                'sales'         => $this->input->post('sales'),
            ];
            $this->db->insert('deal_stok', $data);
            $this->session->set_flashdata('pesan', '<div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>Berhasil!</strong>. Stok ini sudah <span class="text-warning">dibooking</span>.
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
            </div>');
            redirect('Sales');
        }
    }

    public function sold($id)
    {
        $sold = 1;
        $data = [
            'is_sold' => $sold
        ];
        $this->db->where('id', $id);
        $this->db->update('update_po', $data);
        $this->session->set_flashdata('pesan', '<div class="alert alert-success alert-dismissible fade show" role="alert">
        <strong>Selesai!</strong>. Stok ini sudah terjual.
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
        </button>
        </div>');
        redirect('Sales');
    }
}
