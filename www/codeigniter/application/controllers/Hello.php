<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Hello extends CI_Controller
{
        public function index($id = 0, $message = '')
        {
                echo 'Freetuts.net ID=' . $id . ' AND message =' . $message;
                $this->load->database();
                $this->load->model('news_model');
        }
        public function other()
        {
                echo 'Freetuts.net Other Controller';
        }
}
