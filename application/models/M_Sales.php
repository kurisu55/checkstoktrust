<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_Sales extends CI_Model
{

    public function get_listDeal()
    {
        $this->db->select('*');
        return $this->db->get('deal_stok')->result_array();
    }

    public function getList_comingSoon()
    {
        $confirm = !1;
        $this->db->where('is_confirm', $confirm);
        return $this->db->get('update_po')->result_array();
    }

    public function get_platMobil()
    {
        $keyword = $this->input->post('keyword', true);
        $this->db->select('*');
        $this->db->from('deal_stok');
        $this->db->like('plat_mobil', $keyword);
        return $this->db->get()->result_array();
    }

    public function input_booking()
    {

        $id = $this->uri->segment('3');

        //  Pengambilan data untuk Sales 
        $data['user'] = $this->db->get_where('tb_user', ['no_pegawai' =>
        $this->session->userdata('no_pegawai')])->row_array();
        // End

        $booking = 1;
        $data = [
            'is_booking'    => htmlspecialchars($booking, true),
            'sales'         => htmlspecialchars($data['user']['name'], true),
        ];
        $this->db->where('id', $id);
        $this->db->iupdate('deal_stok', $data);
    }
}
