<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_Sales extends CI_Model
{

    public function get_listPO()
    {
        $isConfirm = '1';
        $this->db->where('is_confirm', $isConfirm);
        return $this->db->get('update_po')->result_array();
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
        $this->db->from('update_po');
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

        // Pengambilan data update PO ke deal stok
        $data['deal'] = $this->db->get_where('update_po', ['id' => $id])->row_array();

        $booking = 1;
        $data = [
            'id'            => htmlspecialchars($data['deal']['id'], true),
            'tgl_po'        => htmlspecialchars($data['deal']['tgl_po'], true),
            'brand'         => htmlspecialchars($data['deal']['brand'], true),
            'tipe_mobil'    => htmlspecialchars($data['deal']['tipe_mobil'], true),
            'plat_mobil'    => htmlspecialchars($data['deal']['plat_mobil'], true),
            'tahun'         => htmlspecialchars($data['deal']['tahun'], true),
            'warna'         => htmlspecialchars($data['deal']['warna'], true),
            'appraiser'     => htmlspecialchars($data['deal']['appraiser'], true),
            'is_booking'    => htmlspecialchars($booking, true),
            'sales'         => htmlspecialchars($data['user']['name'], true),
        ];
        $this->db->insert('deal_stok', $data);
    }

    public function get_listDeal()
    {
        $this->db->select('*');
        return $this->db->get('deal_stok')->result_array();
    }
}
