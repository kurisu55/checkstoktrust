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

    public function kode_booking()
    {
        $this->db->select('RIGHT(deal_stok.kode_booking,2) as kode_booking', FALSE);
        $this->db->order_by('kode_booking', 'DESC');
        $this->db->limit(1);
        $query = $this->db->get('deal_stok');
        if ($query->num_rows() <> 0) {
            $data = $query->row();
            $kode = intval($data->kode_po) + 1;
        } else {
            $kode = 1;
        }
        $generate = str_pad($kode, 2, "0", STR_PAD_LEFT);
        $getKode = "BK" . date('j') . date('n') . date('y') . $generate;
        return $getKode;
    }

    public function kode_sold()
    {
        $this->db->select('RIGHT(deal_stok.kode_sold,2) as kode_sold', FALSE);
        $this->db->order_by('kode_sold', 'DESC');
        $this->db->limit(1);
        $query = $this->db->get('deal_stok');
        if ($query->num_rows() <> 0) {
            $data = $query->row();
            $kode = intval($data->kode_po) + 1;
        } else {
            $kode = 1;
        }
        $generate = str_pad($kode, 2, "0", STR_PAD_LEFT);
        $getKode = "BK" . date('j') . date('n') . date('y') . $generate;
        return $getKode;
    }
}
