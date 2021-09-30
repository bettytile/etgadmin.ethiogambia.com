<div class="msg" style="display:none;">
  <?php echo @$this->session->flashdata('msg'); ?>
</div>

<div class="box">
  <div class="box-header">
    <div class="col-md-6" style="padding: 0;">
        <button class="form-control btn btn-primary" data-toggle="modal" data-target="#add-customer"><i class="glyphicon glyphicon-plus-sign"></i> Add New Customer</button>
    </div>
    <div class="col-md-3">
        <a href="<?php echo base_url('Customers/export'); ?>" class="form-control btn btn-default"><i class="glyphicon glyphicon glyphicon-floppy-save"></i> Export Data Excel</a>
    </div>
    <div class="col-md-3">
        <button class="form-control btn btn-default" data-toggle="modal" data-target="#import-customer"><i class="glyphicon glyphicon glyphicon-floppy-open"></i> Import Data Excel</button>
    </div>
  </div>
  <!-- /.box-header -->
  <div class="box-body">
    <table id="list-data" class="table table-bordered table-striped">
      <thead>
        <tr>
          <th >Name</th>
          <th >Phone No</th>
          <th >Tin No</th>
          
          <th style="text-align: center;">Manage</th>
        </tr>
      </thead>
       <tbody id="data-customers">
      
      </tbody>
    </table>
  </div>
</div>

<?php echo $modal_add_customer; ?>

<div id="tempat-modal"></div>

<?php show_my_confirm('deleteCustomer', 'hapus-dataCustomer', 'Are You Sure You Want To Delete?', 'Yes'); ?>
<?php
  $data['judul'] = 'Customers';
  $data['url'] = 'Customers/import';
  echo show_my_modal('modals/modal_import', 'import-customer', $data);
?>