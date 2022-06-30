<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Page extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->helper("url");
    }

    public function index()
    {
        $this->load->model("Muser");
        $config['total_rows'] = $this->Muser->countAll();
        $config['base_url'] = base_url() . "index.php/page/index";
        $config['per_page'] = 3;
        $config['num_links'] = 2; // so luong trai = so luong phai = num_links
        $config['use_page_numbers'] = TRUE;

        $start = $this->uri->segment(3);
        $this->load->library('pagination', $config);
        $data['data'] = $this->Muser->getList($config['per_page'], $start);
        $this->load->view("user/page_view", $data);
        echo $this->pagination->create_links();
    }
}
