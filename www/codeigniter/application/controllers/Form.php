<?php
class Form extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->helper(array('url', 'form'));
    }

    public function index()
    {
        $this->load->library('form_validation');
        $this->form_validation->set_rules('username', 'Full Name', 'required|min_length[6]');
        $this->form_validation->set_rules('pass', 'Pass Word', 'required');
        $this->form_validation->set_rules('email', 'Email', 'required|valid_email');

        if ($this->form_validation->run() == FALSE) {
            $this->load->view("form");
        }
    }
}
