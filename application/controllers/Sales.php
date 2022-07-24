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

        // Pengambilan data tabel dari deal_stok
        $data['deal'] = $this->M_Sales->get_listDeal();

        $data['title'] = 'View Stock';
        $this->load->view('Template/User_header', $data);
        $this->load->view('Template/User_sidebar', $data);
        $this->load->view('Template/User_topbar', $data);
        $this->load->view('Sales/index', $data);
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

        $data['title'] = 'View Stock Coming Soon';

        $this->load->view('Template/User_header', $data);
        $this->load->view('Template/User_sidebar', $data);
        $this->load->view('Template/User_topbar', $data);
        $this->load->view('Sales/stok_comingSoon', $data);
        $this->load->view('Template/User_footer');
    }

    public function booking()
    {
        $this->form_validation->set_rules('id', '', 'required|is_unique[deal_stok.id]');
        if ($this->form_validation->run() == false) {
            $this->index();
        } else {
            $this->M_Sales->input_booking();
            $this->session->set_flashdata('pesan', '<div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>Berhasil!</strong>. Stok ini sudah <span class="text-warning">dibooking</span>.
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
            </div>');
            redirect('Sales');
        }
    }

    public function cancelBooking($id)
    {
        $cancel = 0;
        $sold = 0;
        $sales = '';
        $data = [
            'is_booking' => $cancel,
            'is_sold' => $sold,
            'sales' => $sales
        ];
        $this->db->where('id', $id);
        $this->db->update('deal_stok', $data);
        $this->session->set_flashdata('pesan', '<div class="alert alert-success alert-dismissible fade show" role="alert">
        <strong>Selesai!</strong>. Stok ini sudah <span class="text-danger">batal booking</span>.
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
        </button>
        </div>');
        redirect('Sales');
    }

    public function sold($id)
    {
        $sold = 1;
        $data = [
            'is_sold' => $sold
        ];
        $this->db->where('id', $id);
        $this->db->update('deal_stok', $data);
        $this->session->set_flashdata('pesan', '<div class="alert alert-success alert-dismissible fade show" role="alert">
        <strong>Selesai!</strong>. Stok ini sudah terjual.
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
        </button>
        </div>');
        redirect('Sales');
    }
}
