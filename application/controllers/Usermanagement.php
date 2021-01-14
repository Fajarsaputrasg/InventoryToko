<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Usermanagement extends CI_Controller {
    
	public function index(){
        if($this->session->has_userdata("nama")){
            $this->load->model('usermanagement_model');
            $dt = $this->usermanagement_model->getListUsers();
            
            $data = [
				"title" => "User Management",
                "usermanagementmenu" => "active",
                "dt" => $dt
            ];
            
			$this->load->view('templates/header', $data);
			$this->load->view('usermanagement');
			$this->load->view('templates/footer');
		}else{
			redirect(base_url());
		}
	}

    public function adduser(){
        $username = $this->input->post('username');
        $password = $this->input->post('password');
        $nama = $this->input->post('nama');
        $role = $this->input->post('role');
  
        $this->load->model('usermanagement_model');
        $dt = $this->usermanagement_model->addUser($username, $password, $nama, $role);

        redirect(base_url()."usermanagement");
    }
  
    public function editUser(){
		if($this->session->has_userdata("nama")){
			$id = $this->uri->segment('3');

			$this->load->model('usermanagement_model');
			$dtEdit = $this->usermanagement_model->getUserById($id);
            $dt = $this->usermanagement_model->getListUsers();

			$data = [
				"title" => "User Management",
				"usermanagementmenu" => "active",
				"dt" => $dt,
				"dtEdit" => $dtEdit
			];

			$this->load->view('templates/header', $data);
			$this->load->view("usermanagement", $data);
			$this->load->view('templates/footer');

		}else{
			redirect(base_url());
		}
    }
    
    public function updateuser(){
		if($this->session->has_userdata("nama")){
			$id = $this->input->post('id');
			$n = $this->input->post('nama');
			$us = $this->input->post('username');
			$p = $this->input->post('password');

			$this->load->model('usermanagement_model');
			$this->usermanagement_model->updateUser($id, $n, $us, $p);
			$dt = $this->usermanagement_model->getListUsers();

			$data = [
				"title" => "User Management",
				"usermanagementmenu" => "active",
				"dt" => $dt
			];

			$this->load->view('templates/header', $data);
			$this->load->view('usermanagement', $data);
			$this->load->view('templates/footer');
		}else{
			redirect(base_url());
		}
    }
    
    public function deleteuser(){
		if($this->session->has_userdata("nama")){
            $id = $this->uri->segment('3');
            $this->load->model('usermanagement_model');
            $this->usermanagement_model->deleteUser($id);
            redirect(base_url()."usermanagement");
		}else{
			redirect(base_url());
		}
	}
}
