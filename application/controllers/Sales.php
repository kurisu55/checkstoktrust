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

        // Pengambilan data tabel dari deal_stok
        $data['deal'] = $this->M_Sales->get_listDeal();

        if ($this->input->post('keyword')) {
            $data['deal'] = $this->M_Sales->get_platMobil();
        }

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

    public function booking($id)
    {
        $id = $this->uri->segment('3');

        //  Pengambilan data untuk Sales 
        $data['user'] = $this->db->get_where('tb_user', ['no_pegawai' =>
        $this->session->userdata('no_pegawai')])->row_array();
        // End

        $booking = 1;
        $kode_booking = $this->M_Sales->kode_booking();
        $data = [
            'is_booking'    => htmlspecialchars($booking, true),
            'kode_booking'  => htmlspecialchars($kode_booking, true),
            'sales'         => htmlspecialchars($data['user']['name'], true),
        ];
        $this->db->where('id', $id);
        $this->db->update('deal_stok', $data);
        $this->session->set_flashdata('pesan', '<div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>Berhasil!</strong>. Stok ini sudah <span class="text-warning">dibooking</span>.
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
            </div>');
        redirect('Sales');
    }

    public function cancelBooking($id)
    {
        $cancel = 0;
        $sales = '';
        $kode_booking = '';
        $data = [
            'is_booking'    => htmlspecialchars($cancel, true),
            'kode_sold'     => htmlspecialchars($kode_booking, true),
            'sales'         => htmlspecialchars($sales, true)
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
        $kode_sold = $this->M_Sales->kode_sold();
        $data = [
            'kode_sold' => htmlspecialchars($kode_sold, true),
            'is_sold'   => htmlspecialchars($sold, true),
            'date_sold' => time()
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
