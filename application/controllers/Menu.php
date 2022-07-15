<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Menu extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        access_route();
    }

    public function index()
    {
        /** Pengambilan data berdasarkan Nomor pegawai */
        $data['user'] = $this->db->get_where('tb_user', ['no_pegawai' =>
        $this->session->userdata('no_pegawai')])->row_array();
        /** End */

        /**menampilkan data management menu */
        $data['menu'] = $this->db->get('user_menu')->result_array();

        $this->form_validation->set_rules('menu', 'Menu', 'required');

        if ($this->form_validation->run() == false) {
            $data['title'] = 'Menu Management';
            $this->load->view('Template/User_header', $data);
            $this->load->view('Template/User_sidebar', $data);
            $this->load->view('Template/User_topbar', $data);
            $this->load->view('Menu/index', $data);
            $this->load->view('Template/User_footer');
        } else {
            $this->db->insert('user_menu', ['menu' => $this->input->post('menu')]);
            $this->session->set_flashdata('pesan', '<div class="alert-success" role="alert">Menu baru sudah ditambahkan.</div>');
            redirect('menu');
        }
    }

    public function submenu()
    {
        $data['user'] = $this->db->get_where('tb_user', ['no_pegawai' =>
        $this->session->userdata('no_pegawai')])->row_array();

        $this->load->model('M_Menu', 'menu');
        $data['submenu'] = $this->menu->getSubMenu();
        $data['menu'] = $this->db->get('user_menu')->result_array();

        $this->form_validation->set_rules('title', 'Title', 'required');
        $this->form_validation->set_rules('menu_id', 'Menu', 'required');
        $this->form_validation->set_rules('url', 'URL', 'required');
        $this->form_validation->set_rules('icon', 'Icon', 'required');

        if ($this->form_validation->run() == false) {
            $data['title'] = 'Sub Menu Management';
            $this->load->view('Template/User_header', $data);
            $this->load->view('Template/User_sidebar', $data);
            $this->load->view('Template/User_topbar', $data);
            $this->load->view('Menu/submenu', $data);
            $this->load->view('Template/User_footer');
        } else {
            $data = [
                'title' => $this->input->post('title'),
                'menu_id' => $this->input->post('menu_id'),
                'url' => $this->input->post('url'),
                'icon' => $this->input->post('icon'),
                'is_active' => $this->input->post('is_active'),

            ];
            $this->db->insert('user_submenu', $data);
            $this->session->set_flashdata('pesan', '<div class="alert-success" role="alert">Sub Menu baru sudah ditambahkan.</div>');
            redirect('menu/submenu');
        }
    }
}
