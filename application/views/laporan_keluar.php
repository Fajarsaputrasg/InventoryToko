<div class="container-fluid">

          <div class="card shadow mb-4">
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary">Laporan Keluar</h6>
            </div>
            <div class="card-body">
              <div class="table-responsive">
              <table class="table table-bordered" id="dataTableLaporanKeluar" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <th>NO</th>
                      <th>TANGGAL</th>
                      <th>NAMA BARANG</th>
                      <th>JUMLAH</th>
                      <th>HARGA SATUAN</th>
                      <th>TOTAL</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php 
                        $no = 1;
                        foreach($dt as $d){ ?>
                    <tr>
                      <td><?php echo $no; ?></td>
                      <td><?php echo $d->tanggal; ?></td>
                      <td><?php echo $d->nama_barang; ?></td>
                      <td><?php echo $d->jumlah; ?></td>
                      <td><?php echo $d->harga_satuan; ?></td>
                      <td><?php echo $d->total; ?></td>
                    </tr>
                        <?php 
                            $no++;
                            } 
                        ?>
                    
                  </tbody>
                </table>
              </div>
              <!-- <a href="#" class="btn btn-success btn-icon-split" data-toggle="modal" data-target="#addQuestionnaireModal">
                <span class="text">PRINT</span>
              </a> -->
            </div>
          </div>

        </div> 