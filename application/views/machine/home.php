<div class="msg" style="display:none;">
  <?php echo @$this->session->flashdata('msg'); ?>
</div>

<div class="box">
  <div class="box-header">
    <div class="col-md-6" style="padding: 0;">
        <button class="form-control btn btn-primary" data-toggle="modal" data-target="#insert-machine"><i class="glyphicon glyphicon-plus-sign"></i> Add New Machine</button>
    </div>
    <div class="col-md-3">
        <a href="<?php echo base_url('Machine/export'); ?>" class="form-control btn btn-default"><i class="glyphicon glyphicon glyphicon-floppy-save"></i> Export Data Excel</a>
    </div>
    <div class="col-md-3">
        <button class="form-control btn btn-default" data-toggle="modal" data-target="#import-machine"><i class="glyphicon glyphicon glyphicon-floppy-open"></i> Import Data Excel</button>
    </div>
  </div>
  <!-- /.box-header -->
  <div class="box-body">
    <table id="list-data" class="table table-bordered table-striped">
      <thead>
        <tr>
          <th >Machine Code</th>
          <th >Machine Name</th>
          <th >Machine Type</th>
          <th >Machine Status</th>

          <th style="text-align: center;">Manage</th>
        </tr>
      </thead>
       <tbody id="data-machine">
      
      </tbody>
    </table>
  </div>
</div>

<?php echo $modal_insert_machine; ?>

<div id="tempat-modal"></div>

<?php show_my_confirm('deleteMachine', 'hapus-dataMachine', 'Are You Sure You Want To Delete?', 'yes'); ?>
<?php
  $data['judul'] = 'Machine';
  $data['url'] = 'Machine/import';
  echo show_my_modal('modals/modal_import', 'import-machine', $data);
?>