<?php

class Admin extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        $data['subview'] = 'admin/index_view';
        $this->load->view('admin/main', $data);
    }
}
