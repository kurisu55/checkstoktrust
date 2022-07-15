<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_Tnt extends CI_Model
{

    public function get_listPO()
    {
        return $this->db->get('update_po')->result_array();
    }

    public function kode_po()
    {
        $this->db->select('RIGHT(update_po.kode_po,5) as kode_po', FALSE);
        $this->db->order_by('kode_po', 'DESC');
        $this->db->limit(1);
        $query = $this->db->get('update_po');
        if ($query->num_rows() <> 0) {
            $data = $query->row();
            $kode = intval($data->kode_po) + 1;
        } else {
            $kode = 1;
        }
        $generate = str_pad($kode, 2, "0", STR_PAD_LEFT);
        $getKode = "PO" . date('j') . date('n') . date('y') . $generate;
        return $getKode;
    }

    public function inpuData_PO()
    {
        $data = [
            'tgl_po'        => $this->input->post('tgl_po'),
            'brand'         => $this->input->post('brand'),
            'tipe_mobil'    => $this->input->post('tipe_mobil'),
            'plat_mobil'    => $this->input->post('plat_mobil'),
            'tahun'         => $this->input->post('tahun'),
            'warna'         => $this->input->post('warna'),
            'appraiser'     => $this->input->post('appraiser')
        ];
        $this->db->insert('update_po', $data);
    }
    public function delete($id)
    {
        $this->db->where('id', $id);
        $this->db->delete('update_po');
    }
}
