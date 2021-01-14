<div class="container-fluid">
          <div class="card shadow mb-4" style="<?php if(isset($dtEdit)){ echo "display: none;"; }else{ echo ""; }?>">
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary">Tambah Barang</h6>
            </div>
            <div class="card-body">
              <form action="<?php echo base_url(); ?>barang/addbarang" method="POST">
                <div class="row">
                  <div class="col">
                    <div class="form-group row">
                      <label for="inputEmail3" class="col-sm-4 col-form-label">Nama Barang</label>
                      <div class="col-sm-8">
                        <input type="text" class="form-control" name="namabarang" required>
                      </div>
                    </div>
                  </div>
                  <div class="col">
                    <div class="form-group row">
                      <label for="inputEmail3" class="col-sm-4 col-form-label">Posisi</label>
                      <div class="col-sm-8">
                        <input type="text" class="form-control" name="posisi" required>
                      </div>
                    </div>
                  </div>
                </div>

                <div class="row">
                  
                  <div class="col">
                    <div class="form-group row">
                      <label for="inputEmail3" class="col-sm-2 col-form-label">Keterangan</label>
                      <div class="col-sm-10">
                        <input type="text" class="form-control" name="keterangan">
                      </div>
                    </div>
                  </div>
                </div>
                
                <div class="row">
                  <div class="col">
                    <!-- <label for="inputEmail3" class="col-sm-10 col-form-label"></label> -->
                    <input type="submit" class="btn btn-success btn-icon-split btn-block btn-lg" value="SUBMIT"></input>
                  </div>
                </div>
                
              </form>
            </div>
          </div>

          <div class="card shadow mb-4" style="<?php if(isset($dtEdit)){ echo ""; }else{ echo "display: none;"; }?>">
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary">Edit Barang</h6>
            </div>
            <div class="card-body">
              <form action="<?php echo base_url(); ?>barang/updatebarang" method="POST">
              
              <?php foreach($dtEdit as $d){ ?>
                <input type="hidden" class="form-control" name="kodebarang" value="<?php echo $d->kode_barang; ?>">
                <div class="row">
                  <div class="col">
                    <div class="form-group row">
                      <label for="inputEmail3" class="col-sm-4 col-form-label">Nama Barang</label>
                      <div class="col-sm-8">
                        <input type="text" class="form-control" name="namabarang" value="<?php echo $d->nama_barang; ?>">
                      </div>
                    </div>
                  </div>
                  <div class="col">
                    <div class="form-group row">
                      <label for="inputEmail3" class="col-sm-4 col-form-label">Posisi</label>
                      <div class="col-sm-8">
                        <input type="text" class="form-control" name="posisi" value="<?php echo $d->lokasi; ?>">
                      </div>
                    </div>
                  </div>
                </div>

                <div class="row">
                  <div class="col">
                    <div class="form-group row">
                      <label for="inputEmail3" class="col-sm-4 col-form-label">Keterangan</label>
                      <div class="col-sm-8">
                        <input type="text" class="form-control" name="keterangan" value="<?php echo $d->keterangan; ?>">
                      </div>
                    </div>
                  </div>
                  <div class="col">
                    <div class="form-group row">
                      <label for="inputEmail3" class="col-sm-4 col-form-label">Stock</label>
                      <div class="col-sm-8">
                        <input type="text" class="form-control" name="stock" value="<?php echo $d->stock_barang; ?>">
                      </div>
                    </div>
                  </div>
                </div>
                
                <div class="row">
                  <div class="col">
                    <!-- <label for="inputEmail3" class="col-sm-10 col-form-label"></label> -->
                    <input type="submit" class="btn btn-success btn-icon-split btn-block btn-lg" value="UPDATE"></input>
                  </div>
                  <div class="col">
                    <!-- <label for="inputEmail3" class="col-sm-10 col-form-label"></label> -->
                    <a href="<?php echo base_url(); ?>barang" class="btn btn-danger btn-icon-split btn-block btn-lg">CANCEL</a>
                  </div>
                </div>
                <?php
                        }
                    ?>
              </form>
            </div>
          </div>

          <div class="card shadow mb-4">
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary">Daftar Barang</h6>
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <th>NO</th>
                      <th>KODE</th>
                      <th>NAMA BARANG</th>
                      <th>LETAK BARANG</th>
                      <th>STOCK</th>
                      <th>KETERANGAN</th>
                      <th>ACTIONS</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php 
                    $no = 1;
                    foreach($dt as $d){ ?>
                        <tr>
                            <td><?php echo $no; ?></td>
                            <td><?php echo $d->kode_barang; ?></td>
                            <td><?php echo $d->nama_barang; ?></td>
                            <td><?php echo $d->lokasi; ?></td>
                            <td><?php echo $d->stock_barang; ?></td>
                            <td><?php echo $d->keterangan; ?></td>
                            <td>
                              <a href="<?php echo base_url(); ?>barang/editbarang/<?php echo $d->kode_barang; ?>" class="btn btn-info btn-circle btn-sm">
                                <i class="fas fa-edit"></i>
                              </a>
                              <a href="<?php echo base_url(); ?>barang/deletebarang/<?php echo $d->kode_barang; ?>" class="btn btn-danger btn-circle btn-sm">
                                <i class="fas fa-trash"></i>
                              </a>
                            </td>
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