<?php
header('Access-Control-Allow-Headers: Access-Control-Allow-Origin, Content-Type');
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json, charset=utf-8');

use chriskacerguis\RestServer\RestController;

defined('BASEPATH') or exit('No direct script access allowed');
require(APPPATH . 'libraries\RestController.php');
require(APPPATH . 'libraries\Format.php');

class Api extends RestController
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('user_model');
    }
    public function user_get()
    {
        $id = $this->uri->segment(3);
        if ($id == null) {
            $data = $this->user_model->read();
        } else {
            $data = $this->user_model->read_by_id($id);
        }
        $this->response($data);
    }
    public function user_put()
    {
        // Use x-www-form-urlencoded
        $id = $this->uri->segment(3);
        $data = $this->put();
        $r = $this->user_model->update($id, $data);
        if ($r) {
            $this->response(array('status' => 'success', 'message' => 'User updated successfully'));
        } else {
            $this->response(array('status' => 'error', 'message' => 'Error! User not updated'));
        }
    }
    public function user_post()
    {
        // get data from post
        $data = $this->post();
        $r = $this->user_model->insert($data);
        if ($r) {
            $this->response(array('status' => 'success', 'message' => 'User inserted successfully'));
        } else {
            $this->response(array('status' => 'error', 'message' => 'User not valid'));
        }
    }
    public function user_delete()
    {
        $id = $this->uri->segment(3);
        $r = $this->user_model->delete($id);
        if ($r) {
            $this->response(array('status' => 'success', 'message' => 'User deleted successfully'));
        } else {
            $this->response(array('status' => 'error', 'message' => 'Error! User not deleted'));
        }
    }
    public function login_post()
    {
        $data = $this->post();
        $r = $this->user_model->login($data);
        if ($r) {
            $this->response(array('status' => 'success', 'message' => 'Login success'));
        } else {
            $this->response(array('status' => 'error', 'message' => 'Login failed'));
        }
    }
}
