<?php
defined('BASEPATH') or exit('No direct script access allowed');
/**
 *
 */
class User_model extends CI_Model
{
    public function read()
    {
        $query = $this->db->query("select * from `user`");
        return $query->result_array();
    }
    public function insert($data)
    {

        $this->username = $data['username']; // please read the below note
        $this->password = $data['password'];
        // if ($data['level']) {
        //     $this->level = $data['level'];
        if ($this->db->insert('user', $this)) {
            return 'Data is inserted successfully';
        } else {
            return "Error has occured";
        }
    }
    public function update($id, $data)
    {

        $this->username    = $data['username']; // please read the below note
        $this->password  = $data['password'];
        $this->level = $data['level'];
        $result = $this->db->update('user', $this, array('id' => $id));
        if ($result) {
            return "Data is updated successfully";
        } else {
            return "Error has occurred";
        }
    }
    public function delete($id)
    {

        $result = $this->db->query("delete from `user` where id = $id");
        if ($result) {
            return "Data is deleted successfully";
        } else {
            return "Error has occurred";
        }
    }
}
