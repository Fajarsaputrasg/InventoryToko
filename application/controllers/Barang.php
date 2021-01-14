<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Barang extends CI_Controller {
	public function index(){
		if($this->session->has_userdata("nama")){
			$data = [
				"title" => "Daftar Barang",
				"daftarbarangmenu" => "active"
			];

			$this->load->view('templates/header', $data);
			$this->daftarBarang();
			$this->load->view('templates/footer');
		}else{
			redirect(base_url());
		}
	}

	public function daftarBarang(){
		if($this->session->has_userdata("nama")){
			$this->load->model('barang_model');
			$dt = $this->barang_model->getDaftarBarang();
			$data = [
				"dt" => $dt
			];
			$this->load->view("daftar_barang", $data);
		}else{
			redirect(base_url());
		}
	}

	public function addBarang(){
		if($this->session->has_userdata("nama")){
			$nb = $this->input->post('namabarang');
			$st = 0;
			$p = $this->input->post('posisi');
			$k = $this->input->post('keterangan');
			
			$this->load->model('barang_model');
			$d = $this->barang_model->addBarang($nb, $st, $p, $k);
			if($d){
				redirect(base_url()."barang");
			}else{
				redirect(base_url()."barang");
			}
		}else{
			redirect(base_url());
		}
	}

	public function editBarang(){
		if($this->session->has_userdata("nama")){
			$kb = $this->uri->segment('3');

			$this->load->model('barang_model');
			$dtEdit = $this->barang_model->getBarangByKodeBarang($kb);
			$dt = $this->barang_model->getDaftarBarang();

			$data = [
				"title" => "Daftar Barang",
				"daftarbarangmenu" => "active",
				"dt" => $dt,
				"dtEdit" => $dtEdit
			];

			$this->load->view('templates/header', $data);
			$this->load->view("daftar_barang", $data);
			$this->load->view('templates/footer');

		}else{
			redirect(base_url());
		}
	}

	public function updatebarang(){
		if($this->session->has_userdata("nama")){
			$kb = $this->input->post('kodebarang');
			$nb = $this->input->post('namabarang');
			$p = $this->input->post('posisi');
			$k = $this->input->post('keterangan');
			$s = $this->input->post('stock');

			$this->load->model('barang_model');
			$this->barang_model->updateBarang($kb, $nb, $p, $k, $s);
			$dt = $this->barang_model->getDaftarBarang();

			$data = [
				"title" => "Daftar Barang",
				"daftarbarangmenu" => "active",
				"dt" => $dt
			];

			$this->load->view('templates/header', $data);
			$this->load->view('daftar_barang', $data);
			$this->load->view('templates/footer');
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
			redirect(base_url()."barang");
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
			$barang = $this->barang_model->getDaftarBarang();
			$dt = $this->barang_model->getBarangMasuk();

			$data = [
				"title" => "Input Barang",
				"inputbarangmenu" => "active",
				"date" => $date,
				"faktur" => $faktur,
				"kodebarang" => $kodeBarang,
				"dt" => $dt,
				"barang" => $barang
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
			$t = $this->input->post('tanggal');
			$kb = $this->input->post('kodebarang');
			$jb = $this->input->post('jumlah_barang');
			$hs = $this->input->post('harga_satuan');
			$s = $this->input->post('supplier');

			$this->load->model('barang_model');
			$d = $this->barang_model->saveInputBarang($nf, $t, $kb, $jb, $hs, $s);
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
			$hs = $this->input->post('harga_satuan');

			$this->load->model('barang_model');
			$dt = $this->barang_model->saveBarangKeluar($inv, $kb, $t, $j, $hs);
			redirect(base_url()."barang/barangkeluar");
		}else{
			redirect(base_url());
		}
	}
}
