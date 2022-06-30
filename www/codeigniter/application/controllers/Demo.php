<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Demo extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->helper('url');
    }
    public function index()
    {
        session_start();
        $object = array(
            'title' => 'Freetuts.net',
            'message' => 'Hello World',
            'name' => 'This is my name',
            'age' => 20,
            'email' => ''
        );
        $_SESSION['detail'] = serialize($object);
        //redirect to demo/getitback
        redirect('demo/getitback');
    }
    public function getitback()
    {
        session_start();
        $object = unserialize($_SESSION['detail']);
        echo $object['name'];
    }
}
