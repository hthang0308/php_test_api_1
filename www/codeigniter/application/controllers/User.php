<?php
defined('BASEPATH') or exit('No direct script access allowed');

class User extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
    }
    public function index()
    {
        $this->db->select("id, username, city");
        $this->db->order_by("city", "desc");
        $query  =   $this->db->get('user')->result_array();
        echo "<pre>";
        print_r($query);
        echo "</pre>";
    }
    public function insert()
    {
        $data = array(
            "username" => "kaito",
            "password" => "1212445",
            "city"    => "2",
        );
        $this->db->insert("user", $data);
        echo "Insert thanh cong";
    }
    public function update()
    {
        $data = array(
            "id"       => "24",
            "username" => "kaito",
            "password" => "kaito123",
            "level"    => "1",
        );
        $this->db->where("id", $data['id']);
        if ($this->db->update("user", $data)) {
            echo "Update Thanh cong";
        } else {
            echo "Update That bai";
        }
    }
    public function delete()
    {
        $this->db->where("id", "24");
        if ($this->db->delete("user")) {
            echo "Delete Thanh cong";
        } else {
            echo "Delete That bai";
        }
    }
    public function index5()
    {
        $this->load->model("Muser");
        $data['data'] = $this->Muser->listUser();
        $this->load->view("user/list_view", $data);
    }
}
