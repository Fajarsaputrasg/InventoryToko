<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Laporan extends CI_Controller {

	public function laporan_masuk(){
		if($this->session->has_userdata("nama")){
			$this->load->model('barang_model');
			// $invoice = $this->barang_model->getInvoice();
			// $barang = $this->barang_model->getDaftarBarang();
			$dt = $this->barang_model->getBarangMasuk();

			$data = [
				"title" => "Laporan Masuk",
				"show" => "show",
				"laporan" => "active",
				"laporanmasuk" => "active",
				// "invoice" => $invoice,
				// "tanggal" => date("d M Y"),
				// "barang" => $barang,
				"dt" => $dt
			];

			$this->load->view('templates/header', $data);
			$this->load->view('laporan_masuk', $data);
			$this->load->view('templates/footer');
		}else{
			redirect(base_url());
		}
	}

	public function laporan_keluar(){
		if($this->session->has_userdata("nama")){
			$this->load->model('barang_model');
			$dt = $this->barang_model->getBarangKeluar();

			$data = [
				"title" => "Laporan Keluar",
				"show" => "show",
				"laporan" => "active",
				"laporankeluar" => "active",
				// "invoice" => $invoice,
				// "tanggal" => date("d M Y"),
				// "barang" => $barang,
				"dt" => $dt
			];

			$this->load->view('templates/header', $data);
			$this->load->view('laporan_keluar', $data);
			$this->load->view('templates/footer');
		}else{
			redirect(base_url());
		}
	}
}
