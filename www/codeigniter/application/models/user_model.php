<?php



defined('BASEPATH') or exit('No direct script access allowed');


class User_model extends CI_Model
{
    public function read()
    {
        //query user and remove the password
        $this->db->select('id, username, email, city, phone');
        $this->db->from('users');
        $query = $this->db->get();
        return $query->result_array();
    }
    public function read_by_id($id)
    {
        $query = $this->db->query("select * from `users` where id = $id");
        return $query->result_array();
    }
    public function insert($data)
    {
        //check valid email
        if (!filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
            return false;
        }
        //if not exist this username, insert it
        $query = $this->db->query("select * from `users` where username = '" . $data['username'] . "'");

        //hash password with bcrypt
        $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);
        if ($query->num_rows() == 0) {
            $this->db->insert('users', $data);
            return true;
        } else {
            return false;
        }
    }
    public function update($id, $data)
    {
        unset($data['username']);
        if (!filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
            return false;
        }
        $result = $this->db->update('users', $data, array('id' => $id));

        if ($result) {
            return true;
        } else {
            return false;
        }
    }
    public function delete($id)
    {
        $result = $this->db->delete('users', array('id' => $id));
        if ($result) {
            return true;
        } else {
            return false;
        }
    }
    public function login($data)
    {
        $query = $this->db->query("select * from `users` where username = '" . $data['username'] . "' or email = '" . $data['username'] . "'");
        if ($query->num_rows() == 0) {
            return false;
        } else {
            $row = $query->row();
            if (password_verify($data['password'], $row->password)) {
                unset($row->password);
                return $row;
            } else {
                return false;
            }
        }
    }
}
