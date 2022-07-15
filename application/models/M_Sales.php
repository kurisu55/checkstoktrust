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
}
