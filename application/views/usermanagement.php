<div class="container-fluid">
          <div class="card shadow mb-4" style="<?php if(isset($dtEdit)){ echo "display: none;"; }else{ echo ""; }?>">
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary">Tambah User</h6>
            </div>
            <div class="card-body">
              <form action="<?php echo base_url(); ?>usermanagement/addUser" method="POST">
                <div class="row">
                  <div class="col">
                    <div class="form-group row">
                      <label for="inputEmail3" class="col-sm-4 col-form-label">Nama</label>
                      <div class="col-sm-8">
                        <input type="text" class="form-control" name="nama" required>
                      </div>
                    </div>
                  </div>
                  <div class="col">
                    <div class="form-group row">
                      <label for="inputEmail3" class="col-sm-4 col-form-label">Username</label>
                      <div class="col-sm-8">
                        <input type="text" class="form-control" name="username" required>
                      </div>
                    </div>
                  </div>
                </div>

                <div class="row">
                  <div class="col">
                    <div class="form-group row">
                      <label for="inputEmail3" class="col-sm-4 col-form-label">Role</label>
                      <div class="col-sm-8">
                        <select class="custom-select" name="role">
                          <option selected>Pilih Role...</option>
                          <option value="1">Admin</option>
                          <option value="2">Petugas</option>
                        </select>
                      </div>
                    </div>
                  </div>
                  <div class="col">
                    <div class="form-group row">
                      <label for="inputEmail3" class="col-sm-4 col-form-label">Password</label>
                      <div class="col-sm-8">
                        <input type="password" class="form-control" name="password" required>
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
              <h6 class="m-0 font-weight-bold text-primary">Edit User</h6>
            </div>
            <div class="card-body">
              <form action="<?php echo base_url(); ?>usermanagement/updateuser" method="POST">
              
              <?php foreach($dtEdit as $d){ ?>
                <input type="hidden" class="form-control" name="id" value="<?php echo $d->id; ?>">
                <div class="row">
                  <div class="col">
                    <div class="form-group row">
                      <label for="inputEmail3" class="col-sm-4 col-form-label">Nama</label>
                      <div class="col-sm-8">
                        <input type="text" class="form-control" name="nama" value="<?php echo $d->nama; ?>">
                      </div>
                    </div>
                  </div>
                  <div class="col">
                    <div class="form-group row">
                      <label for="inputEmail3" class="col-sm-4 col-form-label">Username</label>
                      <div class="col-sm-8">
                        <input type="text" class="form-control" name="username" value="<?php echo $d->username; ?>">
                      </div>
                    </div>
                  </div>
                </div>

                <div class="row">
                  <div class="col">
                    <div class="form-group row">
                      <label for="inputEmail3" class="col-sm-4 col-form-label">Role</label>
                      <div class="col-sm-8">
                        <select class="custom-select" name="role">
                          <?php if($d->role == "1"){ ?>
                            <option value="1" selected>Admin</option>
                            <option value="2">Petugas</option>
                          <?php }else{ ?>
                            <option value="1">Admin</option>
                            <option value="2" selected>Petugas</option>
                          <?php } ?>
                        </select>
                      </div>
                    </div>
                  </div>
                  <div class="col">
                    <div class="form-group row">
                      <label for="inputEmail3" class="col-sm-4 col-form-label">Password</label>
                      <div class="col-sm-8">
                        <input type="password" class="form-control" name="password">
                      </div>
                    </div>
                  </div>
                </div>
                
                Kosongkan password jika password tidak ingin diganti <br><br>
                <div class="row">
                
                  <div class="col">
                    <!-- <label for="inputEmail3" class="col-sm-10 col-form-label"></label> -->
                    <input type="submit" class="btn btn-success btn-icon-split btn-block btn-lg" value="UPDATE"></input>
                  </div>
                  <div class="col">
                    <!-- <label for="inputEmail3" class="col-sm-10 col-form-label"></label> -->
                    <a href="<?php echo base_url(); ?>usermanagement" class="btn btn-danger btn-icon-split btn-block btn-lg">CANCEL</a>
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
              <h6 class="m-0 font-weight-bold text-primary">Daftar User</h6>
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <th>NO</th>
                      <th>NAMA</th>
                      <th>USERNAME</th>
                      <th>ROLE</th>
                      <th>ACTIONS</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php 
                    $no = 1;
                    foreach($dt as $d){ ?>
                        <tr>
                            <td><?php echo $no; ?></td>
                            <td><?php echo $d->nama; ?></td>
                            <td><?php echo $d->username; ?></td>
                            <td><?php if($d->role == '1'){ echo "Admin"; }else{ echo "Petugas"; } ?></td>
                            <td>
                              <a href="<?php echo base_url(); ?>usermanagement/edituser/<?php echo $d->id; ?>" class="btn btn-info btn-circle btn-sm">
                                <i class="fas fa-edit"></i>
                              </a>
                              <a href="<?php echo base_url(); ?>usermanagement/deleteuser/<?php echo $d->id; ?>" class="btn btn-danger btn-circle btn-sm">
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