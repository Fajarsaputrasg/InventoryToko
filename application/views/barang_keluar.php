<div class="container-fluid">

          <div class="card shadow mb-4">
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary">Barang Keluar</h6>
            </div>
            <div class="card-body">
              <form action="<?php echo base_url(); ?>barang/savebarangkeluar" method="POST">
                <div class="row">
                    <div class="col">
                      <div class="form-group row">
                        <label for="inputEmail3" class="col-sm-2 col-form-label">Tanggal</label>
                        <div class="col-sm-10">
                          <input type="text" class="form-control" name="tanggal" value="<?php echo $tanggal; ?>" readonly>
                        </div>
                      </div>
                    </div>
                </div>

                <div class="row">
                  <div class="col">
                    <div class="form-group row">
                      <label for="inputEmail3" class="col-sm-4 col-form-label">Nama Barang</label>
                      <div class="col-sm-8">
                        <select class="custom-select" name="kodebarang">
                          <option selected>Pilih...</option>
                          <?php foreach($barang as $b){ ?>
                            <option value="<?php echo $b->kode_barang; ?>"><?php echo $b->nama_barang; ?></option>
                          <?php } ?>
                        </select>
                      </div>
                    </div>
                  </div>
                  <div class="col">
                    <div class="form-group row">
                      <label for="inputEmail3" class="col-sm-4 col-form-label">Jumlah Barang</label>
                      <div class="col-sm-8">
                        <input type="text" class="form-control" name="jumlah">
                      </div>
                    </div>
                  </div>
                </div>

                <div class="row">
                  <div class="col">
                    <div class="form-group row">
                      <label for="inputEmail3" class="col-sm-2 col-form-label">Harga Satuan</label>
                      <div class="col-sm-10">
                        <input type="text" class="form-control" name="harga_satuan">
                      </div>
                    </div>
                  </div>
                </div>

                <div class="row">
                  <div class="col">
                    <!-- <label for="inputEmail3" class="col-sm-2 col-form-label"></label> -->
                    <input type="submit" class="btn btn-success btn-icon-split btn-block btn-lg" value="SUBMIT"></input>
                  </div>
                </div>
              </form>
            </div>
          </div>

          <div class="card shadow mb-4">
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary">Data Barang Keluar</h6>
            </div>
            <div class="card-body">
              
              <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
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
            </div>
          </div>

        </div> 