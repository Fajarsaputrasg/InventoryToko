<?php
/**
 *
 */
class Usermanagement_model extends CI_Model{

  public function getListUsers(){
    $query = $this->db->select('*')
                      ->from('user')
                      ->get();

    $result = $query->result_object();
    return $result;
  }

  public function getUserById($id){
    $query = $this->db->select('*')
                      ->from('user')
                      ->where('id', $id)
                      ->get();

    $result = $query->result_object();
    return $result;
  }

  public function updateUser($id, $n, $us, $p){
    if($p == ""){
      $data = [
        'nama' => $n,
        'username' => $us
      ];
    }else{
      $data = [
        'nama' => $n,
        'username' => $us,
        'password' => md5($p)
      ];
    }
    
    $this->db->where('id', $id);
    $this->db->update("user", $data);
    return $this->db->affected_rows() > 0;
  }

  public function addUser($username, $password, $nama, $role){
    $data = [
      'nama' => $nama,
      'username' => $username,
      'password' => md5($password),
      'role' => $role
    ];

    $this->db->insert('user', $data);
    return $this->db->affected_rows() > 0;
  }

  public function deleteUser($id){
    $this->db->delete("user", array('id' => $id));
  }
}

?>
