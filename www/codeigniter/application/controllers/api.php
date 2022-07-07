<?php
// header('Access-Control-Allow-Headers: Access-Control-Allow-Origin, Content-Type');
// header('Access-Control-Allow-Origin: http://localhost:4200');
// header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS');
// header('Access-Control-Allow-Credentials: true');
// header('Content-Type: application/json, charset=utf-8');




use chriskacerguis\RestServer\RestController;

defined('BASEPATH') or exit('No direct script access allowed');
require(APPPATH . 'libraries\RestController.php');
require(APPPATH . 'libraries\Format.php');

//include the autoloader
require_once APPPATH . '..\vendor\autoload.php';
//use JWT
use Firebase\JWT\JWT;
use Firebase\JWT\Key;

class Api extends RestController
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('user_model');
    }
    public function user_get()
    {
        //verify token
        $token = $this->input->get_request_header('Authorization');
        if ($token === null) {
            $this->response(['error' => 'No token provided.'], 401);
        }
        try {
            $token = str_replace('Bearer ', '', $token);
            $key = "my_secret_key";
            $decoded = JWT::decode($token, new Key($key, 'HS256'));
        } catch (Exception $e) {
            $this->response(['error' => 'Invalid token. Please login first.'], 401);
        }
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
            $this->response(array('status' => 'error', 'message' => 'User already exists'));
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
            //create jwt token
            $key = "my_secret_key";
            $payload = array(
                'id' => $r->id,
                'username' => $r->username,
                'email' => $r->email,
                'city' => $r->city
            );
            $jwt = JWT::encode($payload, $key, 'HS256');
            setcookie('jwt', $jwt, time() + (10), "/");
            $this->response(array('status' => 'success', 'token' => $jwt, 'user' => $r));
        } else {
            $this->response(array('status' => 'error', 'message' => 'Login failed'));
        }
    }
}
