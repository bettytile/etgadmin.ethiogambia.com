<div class="msg" style="display:none;">
    <?php echo @$this->session->flashdata('msg'); ?>
</div>

<div class="box">
    <div class="box-header">
        <!-- <div class="col-md-6" style="padding: 0;">
        <button class="form-control btn btn-primary" data-toggle="modal" data-target="#update-production"><i class="glyphicon glyphicon-plus-sign"></i> Add Employee</button>
    </div> -->
        <div class="col-md-6">
            <a href="<?php echo base_url(
                'EditStock/export'
            ); ?>" class="form-control btn btn-default"><i class="glyphicon glyphicon glyphicon-floppy-save"></i>
                Export
                Data Excel</a>
        </div>
        <div class="col-md-6">
            <button class="form-control btn btn-default" data-toggle="modal" data-target="#import-production"><i
                    class="glyphicon glyphicon glyphicon-floppy-open"></i> Import Data Excel</button>
        </div>
    </div>
    <!-- /.box-header -->
    <div class="box-body">
        <table id="list-data" class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>Product Code</th>
                    <th>Reference NO</th>
                    <th>Issued QTY</th>
                    <th>Received QTY</th>
                    <th>Station</th>
                    <th>Status</th>
                    <th>Activity Date</th>

                    <th style="text-align: center;">Manage</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($dataSemifinished as $pegawai) { ?>
                <tr>
                    <td><?php echo $pegawai->code; ?></td>
                    <td><?php echo $pegawai->reference_no; ?></td>
                    <td><?php echo $pegawai->issued_qty; ?></td>
                    <td><?php echo $pegawai->received_qty; ?></td>
                    <td><?php echo $pegawai->station; ?></td>
                    <td><?php echo $pegawai->rstatus; ?></td>
                    <td><?php echo $pegawai->activity_date; ?></td>

                    <td class="text-center col-sm-12" style="min-width:100px;">
                        <button class="btn btn-success btn-sm confirm-preform" data-id="<?php echo $pegawai->id; ?>"
                            data-toggle="modal" data-target="#confirmPreform"><i class="glyphicon glyphicon-check"></i>
                            Confirm</button>
                        <!-- <button class="btn btn-warning btn-sm update-dataPreform"
                            data-id="<?php echo $pegawai->id; ?>"><i class="glyphicon glyphicon-repeat"></i>
                            Edit</button> -->
                        <button class="btn btn-danger btn-sm delete-preform" data-id="<?php echo $pegawai->id; ?>"
                            data-toggle="modal" data-target="#deletePreform"><i
                                class="glyphicon glyphicon-remove-sign"></i> Delete</button>
                    </td>
                </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</div>


<div id="tempat-modal"></div>

<?php show_my_confirm(
    'deletePreform',
    'hapus-dataPreform',
    'Do You Want To Delete?',
    'yes'
); ?>
<?php show_my_confirm(
    'confirmPreform',
    'hapus-dataConfirmation',
    'Do You Want To confirm?',
    'ok'
); ?>
<!-- 
<?php
$data['judul'] = 'EditStock';
$data['url'] = 'Confirmation/import';
echo show_my_modal('modals/modal_import', 'import-production', $data);
?> -->