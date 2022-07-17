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
            'name'      => $this->input->post('name'),
            'role_id'   => $role_id,
            'region'    => $this->input->post('region'),
            'no_telp'   => $this->input->post('no_telp')
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
}
