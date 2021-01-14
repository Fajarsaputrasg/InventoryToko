<!-- Begin Page Content -->
<div class="container-fluid">

<div class="card shadow mb-4">
  <div class="card-header py-3" style="text-align: center;">
    <h6 class="m-0 font-weight-bold text-success">Nilai Saat Ini</h6>
  </div>
  <div class="card-body">
    <div class="table-responsive">
        <table class="table table-borderless">
            <thead style="display: none;">
                <th style="text-align: center;">Most Like You</th>
                <th>skor</th>
            </thead>
            <tbody>
                <?php 
                $no = 1;
                foreach($dt as $d){ ?>
                    <tr>
                        <td width="95%" class="wrapping-choice"><?php echo $d->nama; ?> (<?php echo $d->deskripsi; ?>)</td>
                        <td><?php echo $d->skor; ?></td>
                    </tr>
                <?php 
                $no++;
                } ?>
            </tbody>
        </table>
    </div>
  </div>
</div>

</div> 
<!-- /.container-fluid -->