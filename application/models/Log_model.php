<?php
/**
 *
 */
class Log_model extends CI_Model{

  public function validateUser($username, $password){
      $query = $this->db->select('*')
                          ->from('user')
                          ->where('username', $username)
                          ->where('password', md5($password))
                          ->get();

      $result = $query->result_object();
      $value = [];

      if(count($result) < 1){
        return 0;
      }else{
        $nama = $result[0]->nama;
        $role = $result[0]->role;
        $this->createSession($nama, $role);
        return 1;
      }
  }

  public function createSession($nama, $role){
    $newdata = array(
        'nama' => $nama,
        'role' => $role
    );
    
    $this->session->set_userdata($newdata);
  }

  public function registerUser($nama, $username, $password){
    $data = [
      'nama' => $nama,
      'username' => $username,
      'password' => md5($password)
    ];

    $this->db->insert('user', $data);
    return $this->db->affected_rows() > 0;
  }
}

?>
