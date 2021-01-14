<div class="container-fluid">

          <div class="card shadow mb-4">
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary">Hapus Barang</h6>
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <th>NO</th>
                      <th>KODE</th>
                      <th>NAMA</th>
                      <th>LETAK BARANG</th>
                      <th>STOCK</th>
                      <th>KETERANGAN</th>
                      <th>SUPPLIER</th>
                      <th></th>
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
                            <td><?php echo $d->supplier; ?></td>
                            <td>
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