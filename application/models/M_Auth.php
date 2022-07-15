<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_Auth extends CI_Model
{

    public function input_registration()
    {
        /** Inisiasi input data */
        $data = [
            'role_id'          => $this->input->post('role_id'),
            'no_pegawai'       => $this->input->post('no_pegawai'),
            'name'             => htmlspecialchars($this->input->post('name'), true),
            'no_telp'          => htmlspecialchars($this->input->post('no_telp')),
            'password'         => password_hash($this->input->post('password'), PASSWORD_DEFAULT),
            'region'           => 'Kalimalang',
            'date_created'     => time()
        ];

        /** Menginput data*/
        $this->db->insert('tb_user', $data);
    }
}
