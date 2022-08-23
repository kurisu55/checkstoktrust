<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_Tnt extends CI_Model
{

    public function get_listPO()
    {
        return $this->db->get('update_po')->result_array();
    }

    public function delete($id)
    {
        $this->db->where('id', $id);
        $this->db->delete('update_po');
    }
}
