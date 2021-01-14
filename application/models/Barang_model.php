<?php
/**
 *
 */
class Barang_model extends CI_Model{

  public function addBarang($nb, $st, $p, $k){
    $data = [
      'kode_barang' => $this->getKodeBarang(),
      'nama_barang' => $nb,
      'lokasi' => $p,
      'stock_barang' => $st,
      'keterangan' => $k
    ];

    $this->db->insert('barang', $data);
    return $this->db->affected_rows() > 0;
  }

  public function getFaktur(){
      // $query = $this->db->select('no_faktur')
      //                   ->from('barang_masuk')
      //                   ->order_by('no_faktur', 'DESC')
      //                   ->get();

      // $result = $query->result_object();

      // if(count($result) < 1){
      //   return "BM-1";
      // }else{
      //   $noFak = $result[0]->no_faktur;
      //   $ex = explode("-", $noFak);
      //   $new = $ex[1] + 1;
      //   return "BM-".$new;
      // }
  }

  public function getInvoice(){
    // $query = $this->db->select('no_invoice')
    //                   ->from('barang_keluar')
    //                   ->order_by('no_invoice', 'DESC')
    //                   ->get();

    // $result = $query->result_object();

    // if(count($result) < 1){
    //   return "BK-1";
    // }else{
    //   $noInv = $result[0]->no_invoice;
    //   $ex = explode("-", $noInv);
    //   $new = $ex[1] + 1;
    //   return "BK-".$new;
    // }
  }

  public function getKodeBarang(){
    $query = $this->db->select('kode_barang')
                      ->from('barang')
                      ->order_by('kode_barang', 'DESC')
                      ->get();

    $result = $query->result_object();

    if(count($result) < 1){
      return "B-1";
    }else{
      $kode = $result[0]->kode_barang;
      $ex = explode("-", $kode);
      $new = $ex[1] + 1;
      return "B-".$new;
    }
  }

  public function saveInputBarang($nf, $t, $kb, $jb, $hs, $s){
    $this->updateStock($kb, $jb);
    // $this->saveBarang($kb, $nb, $p, $s, $st, $k);
    $query = $this->db->get_where('barang', array('kode_barang' => $kb));
    $result = $query->result_object();

    $data = [
      'tanggal' => $t,
      'kode_barang' => $kb,
      'jumlah_barang' => $jb,
      'harga_satuan' => $hs,
      'supplier' => $s,
      'total' => $hs * $jb
    ];

    $this->db->insert('barang_masuk', $data);
    return $this->db->affected_rows() > 0;
  }

  public function saveBarang($kb, $nb, $p, $s, $st, $k){
    $data = [
      'kode_barang' => $kb,
      'nama_barang' => $nb,
      'lokasi' => $p,
      'supplier' => $s,
      'stock_barang' => $st,
      'keterangan' => $k
    ];

    $this->db->insert('barang', $data);
    return $this->db->affected_rows() > 0;
  }

  public function getBarangMasuk(){
    $query = $this->db->select('id, harga_satuan, tanggal, barang_masuk.kode_barang, barang.nama_barang, jumlah_barang, supplier, total')
                      ->from('barang_masuk')
                      ->join('barang', 'barang.kode_barang = barang_masuk.kode_barang')
                      ->get();

    $result = $query->result_object();
    return $result;
  }

  public function getBarangKeluar(){
    $query = $this->db->select('id, tanggal, barang.kode_barang, barang.nama_barang, jumlah, harga_satuan, total')
                      ->from('barang_keluar')
                      ->join('barang', 'barang.kode_barang = barang_keluar.kode_barang')
                      ->get();

    $result = $query->result_object();
    return $result;
  }

  public function getDaftarBarang(){
    $query = $this->db->select('*')
                      ->from('barang')
                      ->get();

    $result = $query->result_object();
    return $result;
  }

  public function deleteBarang($kb){
    $this->db->delete("barang", array('kode_barang' => $kb));
  }

  public function saveBarangKeluar($inv, $kb, $t, $j, $hs){
    $query = $this->db->get_where('barang', array('kode_barang' => $kb));
    $result = $query->result_object();

    $data = [
      'tanggal' => $t,
      'kode_barang' => $kb,
      'jumlah' => $j,
      'harga_satuan' => $hs,
      'total' => $hs * $j
    ];

    $this->db->insert('barang_keluar', $data);

    $re = $this->getBarangByKodeBarang($kb);
    $tot = $re[0]->stock_barang - $j;

    $data2 = array(
      'stock_barang' => $tot
    );

    $this->db->where('kode_barang', $kb);
    $this->db->update('barang', $data2);

    // return $this->db->affected_rows() > 0;
  }

  public function getBarangByKodeBarang($kb){
    $query = $this->db->select('*')
                      ->from('barang')
                      ->where('kode_barang', $kb)
                      ->get();

    $result = $query->result_object();
    return $result;
  }

  public function updateBarang($kb, $nb, $p, $k, $s){
    $data = [
      'kode_barang' => $kb,
      'nama_barang' => $nb,
      'lokasi' => $p,
      'stock_barang' => $s,
      'keterangan' => $k
    ];

    $this->db->where('kode_barang', $kb);
    $this->db->update("barang", $data);
    return $this->db->affected_rows() > 0;
  }

  public function updateStock($kb, $jb){
    $query = $this->db->get_where('barang', array('kode_barang' => $kb));
    $result = $query->result_object();

    $st = $result[0]->stock_barang + $jb;
    $data = [
      'stock_barang' => $st
    ];

    $this->db->where('kode_barang', $kb);
    $this->db->update("barang", $data);
    return $this->db->affected_rows() > 0;
  }

}

?>
