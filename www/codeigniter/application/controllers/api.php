<?php

use chriskacerguis\RestServer\RestController;

defined('BASEPATH') or exit('No direct script access allowed');
require(APPPATH . 'libraries\RestController.php');
require_once APPPATH . 'libraries\Format.php';

class Api extends RestController
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('user_model');
    }
    public function user_get()
    {
        $r = $this->user_model->read();
        $this->response($r);
    }
    public function user_put()
    {
        $id = $this->uri->segment(3);
        $data = array(
            'username' => $this->input->get('username'),
            'password' => $this->input->get('password'),
            'level' => $this->input->get('level')
        );
        $r = $this->user_model->update($id, $data);
        $this->response($r);
    }
    public function user_post()
    {
        $data = array(
            'username' => $this->input->post('username'),
            'password' => $this->input->post('password'),
            'level' => $this->input->post('level')
        );
        $r = $this->user_model->insert($data);
        $this->response($r);
    }
    public function user_delete()
    {
        $id = $this->uri->segment(3);
        $r = $this->user_model->delete($id);
        $this->response($r);
    }
}
