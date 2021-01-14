<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Log extends CI_Controller {
    
	public function index(){
        if($this->session->has_userdata('nama')){
            return redirect(base_url()."barang");
        }else{
            $this->load->view('login');
        }
	}

    public function login(){
        $username = $this->input->post('username');
        $password = $this->input->post('password');
  
        $this->load->model('log_model');
        $data = $this->log_model->validateUser($username, $password);
        if($data == 1){
            redirect(base_url()."barang");
        }else{
            redirect(base_url());
        }
    }
  
    public function logout(){
        $array_items = array('nama');
        $this->session->unset_userdata($array_items);

        redirect(base_url());
    }
}
