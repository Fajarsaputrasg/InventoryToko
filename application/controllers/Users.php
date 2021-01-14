<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Users extends CI_Controller {
	public function index(){
		if($this->session->has_userdata("nama")){
			$data = [
				"title" => "Data User",
				"daftarbarangmenu" => "active"
			];

			$this->load->view('templates/header', $data);
			$this->daftarUser();
			$this->load->view('templates/footer');
		}else{
			redirect(base_url());
		}
	}

	public function daftarUser(){
		if($this->session->has_userdata("nama")){
			$this->load->model('users_model');
			$dt = $this->barang_model->getListUsers();
			$data = [
				"dt" => $dt
			];
			$this->load->view("daftar_barang", $data);
		}else{
			redirect(base_url());
		}
	}

	public function hapusBarang(){
		if($this->session->has_userdata("nama")){
			$this->load->model('barang_model');
			$dt = $this->barang_model->getDaftarBarang();
			$data = [
				"title" => "Hapus Barang",
				"hapusbarangmenu" => "active",
				"dt" => $dt
			];

			$this->load->view('templates/header', $data);
			$this->load->view('hapus_barang', $data);
			$this->load->view('templates/footer');
		}else{
			redirect(base_url());
		}
	}

	public function deleteBarang(){
		if($this->session->has_userdata("nama")){
			$kb = $this->uri->segment('3');
			$this->load->model('barang_model');
			$dt = $this->barang_model->deleteBarang($kb);
			redirect(base_url()."barang/hapusbarang");
		}else{
			redirect(base_url());
		}
	}

	public function inputBarang(){
		if($this->session->has_userdata("nama")){
			$date = date("d M Y");

			$this->load->model('barang_model');
			$faktur = $this->barang_model->getFaktur();
			$kodeBarang = $this->barang_model->getKodeBarang();
			$dt = $this->barang_model->getBarangMasuk();

			$data = [
				"title" => "Input Barang",
				"inputbarangmenu" => "active",
				"date" => $date,
				"faktur" => $faktur,
				"kodebarang" => $kodeBarang,
				"dt" => $dt
			];

			$this->load->view('templates/header', $data);
			$this->load->view('input_barang', $data);
			$this->load->view('templates/footer');
		}else{
			redirect(base_url());
		}
	}

	public function saveInputBarang(){
		if($this->session->has_userdata("nama")){
			$nf = $this->input->post('nofaktur');
			$nb = $this->input->post('namabarang');
			$t = $this->input->post('tanggal');
			$st = $this->input->post('stock');
			$kb = $this->input->post('kodebarang');
			$p = $this->input->post('posisi');
			$s = $this->input->post('supplier');
			$k = $this->input->post('keterangan');

			$this->load->model('barang_model');
			$d = $this->barang_model->saveInputBarang($nf, $nb, $t, $st, $kb, $p, $s, $k);
			if($d){
				redirect(base_url()."barang/inputbarang");
			}else{
				redirect(base_url()."barang/inputbarang");
			}
		}else{
			redirect(base_url());
		}
	}

	public function barangKeluar(){
		if($this->session->has_userdata("nama")){
			$this->load->model('barang_model');
			$invoice = $this->barang_model->getInvoice();
			$barang = $this->barang_model->getDaftarBarang();
			$dt = $this->barang_model->getBarangKeluar();

			$data = [
				"title" => "Barang Keluar",
				"barangkeluarmenu" => "active",
				"invoice" => $invoice,
				"tanggal" => date("d M Y"),
				"barang" => $barang,
				"dt" => $dt
			];

			$this->load->view('templates/header', $data);
			$this->load->view('barang_keluar', $data);
			$this->load->view('templates/footer');
		}else{
			redirect(base_url());
		}
	}

	public function saveBarangKeluar(){
		if($this->session->has_userdata("nama")){
			$inv = $this->input->post('invoice');
			$kb = $this->input->post('kodebarang');
			$t = $this->input->post('tanggal');
			$j = $this->input->post('jumlah');

			$this->load->model('barang_model');
			$dt = $this->barang_model->saveBarangKeluar($inv, $kb, $t, $j);
			redirect(base_url()."barang/barangkeluar");
		}else{
			redirect(base_url());
		}
    }
    
    public function addUser(){
        $nama = $this->input->post('nama');
        $username = $this->input->post('username');
        $password = $this->input->post('password');
        
        $this->load->model('log_model');
        $data = $this->log_model->addUser($nama, $username, $password);
        if($data){
            $this->load->view('register', $data);
        }else{
            $this->load->view('register', $data);
        }
    }
}
