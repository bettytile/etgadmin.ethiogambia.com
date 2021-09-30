<div class="msg" style="display:none;">
  <?php echo @$this->session->flashdata('msg'); ?>
</div>

<div class="box">
  <div class="box-header">
    <div class="col-md-6" style="padding: 0;">
        <button class="form-control btn btn-primary" data-toggle="modal" data-target="#insert-preform"><i class="glyphicon glyphicon-plus-sign"></i> Add New Semifinishd</button>
    </div>
    <div class="col-md-3">
        <a href="<?php echo base_url('Preform/export'); ?>" class="form-control btn btn-default"><i class="glyphicon glyphicon glyphicon-floppy-save"></i> Export Data Excel</a>
    </div>
    <div class="col-md-3">
        <button class="form-control btn btn-default" data-toggle="modal" data-target="#import-preform"><i class="glyphicon glyphicon glyphicon-floppy-open"></i> Import Data Excel</button>
    </div>
  </div>
  <!-- /.box-header -->
  <div class="box-body">
    <table id="list-data" class="table table-bordered table-striped">
      <thead>
        <tr>
          <th >Preform Code</th>
          <th >Preform Name</th>
          <th >Weight</th>
          <th >Preform Type</th>
          
          <th style="text-align: center;">Manage</th>
        </tr>
      </thead>
       <tbody >
      <?php
  foreach ($dataSemifinished as $pegawai) {
    ?>
    <tr>
      <td ><?php echo $pegawai->code; ?></td>
      <td ><?php echo $pegawai->p_name; ?></td>
      <td><?php echo $pegawai->p_weight; ?></td>
      <td><?php echo $pegawai->p_type; ?></td>
      
      <td class="text-center" style="min-width:145px;">
        <button class="btn btn-warning btn-sm update-dataPreform" data-id="<?php echo $pegawai->id; ?>"><i class="glyphicon glyphicon-repeat"></i> Update</button>
        <!--<button class="btn btn-danger btn-sm delete-preform" data-id="<?php echo $pegawai->id; ?>" data-toggle="modal" data-target="#deletePreform"><i class="glyphicon glyphicon-remove-sign"></i>  Delete</button>-->
      </td>
    </tr>
    <?php
  }
?>
      </tbody>
    </table>
  </div>
</div>

<?php echo $modal_insert_semifinished; ?>

<div id="tempat-modal"></div>

<?php show_my_confirm('deletePreform', 'hapus-dataPreform', 'Are You Sure You Want To Delete?', 'Yes'); ?>
<?php
  $data['judul'] = 'Product';
  $data['url'] = 'Product/import';
  echo show_my_modal('modals/modal_import', 'import-product', $data);
?>