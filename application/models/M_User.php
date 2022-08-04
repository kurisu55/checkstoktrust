<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_User extends CI_Model
{

    public function get_daftarUser()
    {

        $query = "  SELECT  `tb_user`.*,`tb_roleid`.`nama_role`
                    FROM    `tb_user`
                    JOIN    `tb_roleid`
                    ON      `tb_user`.`role_id` = `tb_roleid`.`role_id`
                    WHERE   `tb_user`.`role_id` != 1
        ";
        return $this->db->query($query)->result_array();
    }

    public function cari_userProfile()
    {
        $nama_role = 'Administrator';
        $this->db->select('*');
        $this->db->from('tb_user');
        $this->db->join('tb_roleid', 'tb_roleid.role_id = tb_user.role_id');
        $this->db->where('nama_role !=', $nama_role);
        $keyword = $this->input->post('keyword', true);
        $this->db->like('no_pegawai', $keyword);
        return $this->db->get()->result_array();
    }

    public function getUserByNRP($no_pegawai)
    {
        $nama_role = 'Administrator';
        $this->db->join('tb_roleid', 'tb_roleid.role_id = tb_user.role_id');
        $this->db->where('nama_role !=', $nama_role);
        return $this->db->get_where('tb_user', ['no_pegawai' => $no_pegawai])->row_array();
    }

    public function update_user($no_pegawai)
    {
        $no_pegawai = $this->input->post('no_pegawai');
        if ($this->input->post('nama_role') == 'TNT') {
            $role_id = '2';
        } elseif ($this->input->post('nama_role') == 'Sales') {
            $role_id = '3';
        }
        $data = [
            'name'      => htmlspecialchars($this->input->post('name'), true),
            'role_id'   => htmlspecialchars($role_id, true),
            'region'    => htmlspecialchars($this->input->post('region'), true),
            'no_telp'   => htmlspecialchars($this->input->post('no_telp'), true)
        ];
        $this->db->where('no_pegawai', $no_pegawai);
        $this->db->update('tb_user', $data);
    }

    public function delete_dataUser($no_pegawai)
    {
        $this->db->where('no_pegawai', $no_pegawai);
        $this->db->delete('tb_user');
    }

    public function get_listPO()
    {
        return $this->db->get('update_po')->result_array();
    }

    public function inpuData_PO()
    {
        $data = [
            'tgl_po'        => htmlspecialchars($this->input->post('tgl_po'), true),
            'brand'         => htmlspecialchars($this->input->post('brand'), true),
            'tipe_mobil'    => htmlspecialchars($this->input->post('tipe_mobil'), true),
            'plat_mobil'    => htmlspecialchars($this->input->post('plat_mobil'), true),
            'tahun'         => htmlspecialchars($this->input->post('tahun'), true),
            'warna'         => htmlspecialchars($this->input->post('warna'), true),
            'appraiser'     => htmlspecialchars($this->input->post('appraiser'), true)
        ];
        $this->db->insert('update_po', $data);
    }

    public function list_mobilMasuk()
    {
        $this->db->where('is_confirm', 1);
        return $this->db->get('update_po')->result_array();
    }
    public function list_mobilKeluar()
    {
        $this->db->where('is_sold', 1);
        return $this->db->get('deal_stok')->result_array();
    }

    public function filter_mobilMasuk($tgl_awal, $tgl_akhir)
    {
        $this->db->select('*');
        $this->db->from('update_po');
        $this->db->where('date_confirm >=', $tgl_awal);
        $this->db->where('date_confirm <=', $tgl_akhir);
        return $this->db->get()->result_array();
    }

    public function filter_mobilKeluar($tgl_awal, $tgl_akhir)
    {
        $this->db->select('*');
        $this->db->from('deal_stok');
        $this->db->where('date_sold >=', $tgl_awal);
        $this->db->where('date_sold <=', $tgl_akhir);
        return $this->db->get()->result_array();
    }
}
