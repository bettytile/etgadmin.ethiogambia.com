<div class="msg" style="display:none;">
  <?php echo @$this->session->flashdata('msg'); ?>
</div>

<div class="box">
  <div class="box-header">
    <!-- <div class="col-md-6" style="padding: 0;">
        <button class="form-control btn btn-primary" data-toggle="modal" data-target="#update-production"><i class="glyphicon glyphicon-plus-sign"></i> Add Employee</button>
    </div> -->
    <div class="col-md-6">
        <a href="<?php echo base_url('Confirmation/export'); ?>" class="form-control btn btn-default"><i class="glyphicon glyphicon glyphicon-floppy-save"></i> Export Data Excel</a>
    </div>
    <div class="col-md-6">
        <button class="form-control btn btn-default" data-toggle="modal" data-target="#import-production"><i class="glyphicon glyphicon glyphicon-floppy-open"></i> Import Data Excel</button>
    </div>
  </div>
  <!-- /.box-header -->
  <div class="box-body">
    <table id="list-data" class="table table-bordered table-striped">
      <thead>
        <tr>
          <th >Product Code</th>
          <th >Reference NO</th>
          <th >Production Type</th>
          <th >Produced QTY</th>
          <th >Damaged QTY</th>
          <th >Received Weight</th>
          <th >Left Weight</th>
          <th >Shift</th>
          <th >Activity Date</th>
          
          <th style="text-align: center;">Manage</th>
        </tr>
      </thead>
      <tbody id="data-confirmation" >
      <?php
        foreach ($dataConfirmation as $pegawai) {
          ?>
          <tr>
            <td><?php echo $pegawai->employee; ?></td>
            <td ><?php echo $pegawai->code; ?></td>
            <td><?php echo $pegawai->reference_no; ?></td>
            <td ><?php echo $pegawai->qty_produced; ?></td>
            <td ><?php echo $pegawai->weight; ?></td>
            <td><?php echo $pegawai->activity_date; ?></td>
            
            <td class="text-center col-sm-12" style="min-width:200px;">
              <!-- <button class="btn btn-success btn-sm confirm-production" data-id="<?php echo $pegawai->id; ?>" data-toggle="modal" data-target="#confirmProduction"><i class="glyphicon glyphicon-check"></i>  Confirm</button>
              <button class="btn btn-warning btn-sm update-dataProduction" data-id="<?php echo $pegawai->id; ?>"><i class="glyphicon glyphicon-repeat"></i> Update</button> -->
              <button class="btn btn-danger btn-sm delete-production" data-id="<?php echo $pegawai->id; ?>" data-toggle="modal" data-target="#deleteProduction"><i class="glyphicon glyphicon-remove-sign"></i>  Delete</button>
            </td>
          </tr>
          <?php
        }
?>
      </tbody>
    </table>
  </div>
</div>


<div id="tempat-modal"></div>

<?php show_my_confirm('deleteProduction', 'hapus-dataProduction', 'Do You Want To Delete?', 'yes'); ?>
<?php show_my_confirm('confirmProduction', 'hapus-dataConfirmation', 'Do You Want To confirm?', 'ok'); ?>

<?php
  $data['judul'] = 'Confirmation';
  $data['url'] = 'Confirmation/import';
  echo show_my_modal('modals/modal_import', 'import-production', $data);
?>