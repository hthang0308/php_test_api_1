<?php
defined('BASEPATH') or exit('No direct script access allowed');

class News extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
    }
    function news_list()
    {
        // Gọi function trong model
        $this->news_model->getList();
    }
}
