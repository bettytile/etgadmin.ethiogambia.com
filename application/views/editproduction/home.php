<div class="msg" style="display:none;">
  <?php echo @$this->session->flashdata('msg'); ?>
</div>

<?php
function fetch_data(){
    $outputs='';
if(isset($_POST['find'])){

    
    $i = 0;
    $fdate=$_POST['from'];
                  $tdate=$_POST['to'];
                  $station = $_POST['station'];
          
                  $con = mysqli_connect("cendana.c0l5un2vhvyo.us-east-2.rds.amazonaws.com","admin","#root321","cendana") or die("Connection could not be Established");
                 
                 
                  $sql = "SELECT production_id,product_code, preform_code, rawmaterial_code,reference_no,qty_produced,qty_damaged,received_weight,left_weight,shift,station_name,activity_date FROM (SELECT production_id,id_product,id_production_type,id_preform,product_code, id_raw_material,reference_no,qty_produced,qty_damaged,received_weight,left_weight,shift,id_station,activity_date FROM production) p LEFT JOIN (SELECT prod_id, product_name FROM product) f ON p.id_product = f.prod_id LEFT JOIN (SELECT pre_id, preform_code, preform_name FROM preform) pr ON p.id_preform = pr.pre_id LEFT JOIN (SELECT rm_id,rawmaterial_code, rawmaterial_name FROM raw_material) r ON p.id_raw_material = r.rm_id LEFT JOiN (SELECT s_id,station_name FROM station) s ON p.id_station=s.s_id WHERE p.id_station= '".$station."' AND p.activity_date BETWEEN '".$fdate."' AND '".$tdate."' ORDER BY p.activity_date DESC";
                  
                  $run = mysqli_query($con, $sql) or die("Error: ".mysqli_error($con));
                  
                  while ($row=mysqli_fetch_array($run)) {
                    $outputs .='<tr>
                    <td >'.$row['product_code'].'</td>
                    <td >'.$row['preform_code'].'</td>
                    <td >'.$row['rawmaterial_code'].'</td>
                    <td>'.$row['reference_no'].'</td>
                    <td >'.$row['qty_produced'].'</td>
                    <td >'.$row['qty_damaged'].'</td>
                    <td >'.$row['received_weight'].'</td>
                    <td >'.$row['left_weight'].'</td>
                    <td>'.$row['shift'].'</td>
                    <td>'.$row['station_name'].'</td>
                    <td>'.$row['activity_date'].'</td>
                      <td class="text-center" style="min-width:145px;">
        <button class="btn btn-warning btn-sm update-dataProduction" data-id="'.$row['production_id'].'"><i class="glyphicon glyphicon-repeat"></i> Edit Production</button>
               <button class="btn btn-danger btn-sm delete-production" data-id="'.$row['production_id'].'" data-toggle="modal" data-target="#deleteProduction"><i class="glyphicon glyphicon-remove-sign"></i>  Delete</button>
      
        </td>
                      </tr>'
                      ;
                    
                    
                }
                  
}

                return $outputs;

}

?>
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
    <div class="col-md-offset-1 col-md-10 col-md-offset-1 well">
  <div class="form-msg"></div>
  <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
  <h3 style="display:block; text-align:center;">Edit Production</h3>

  <form id="form-production-report" method="post">
    
    <div class="input-group form-group">
      <span class="input-group-addon" id="sizing-addon2">
        <!-- <i class="glyphicon glyphicon-user"></i> -->
      </span>
      <input type="date" class="form-control" placeholder="From Date" name="from" aria-describedby="sizing-addon2">
      
    </div>
    <div class="input-group form-group">
      <span class="input-group-addon" id="sizing-addon2">
        <!-- <i class="glyphicon glyphicon-user"></i> -->
      </span>
      <input type="date" class="form-control" placeholder="To Date" name="to" aria-describedby="sizing-addon2">
      
    </div>
    
        <!--<div class="input-group form-group">-->
        <!--    <span class="input-group-addon" id="sizing-addon2">-->
        <!--        <b>production Type</b>-->
        <!--    </span>-->
        <!--    <select name="p_type" class="form-control select2" aria-describedby="sizing-addon2">-->
               <?php
                foreach ($dataProductionType as $type) {
                ?>
        <!--        <option value="<?php echo $type->production_type_id; ?>">-->
        <!--            <?php echo $type->production_type_name; ?>-->
        <!--        </option>-->
                <?php
                }
               ?>
        <!--        <option value="all">All</option>-->
        <!--    </select>-->

        <!--</div>-->
        <!--<div class="input-group form-group">-->
        <!--    <span class="input-group-addon" id="sizing-addon2">-->
        <!--        <b>product Code</b>-->
        <!--    </span>-->
        <!--    <select name="code" class="form-control select2" aria-describedby="sizing-addon2">-->
        <!--    <option value="all">All</option>-->
                
                <?php 
           //  foreach ($dataProduct as $product) {
            //  ?>
        <!--        <option value="<?php echo $product->prod_id; ?>">-->
        <!--            <?php echo $product->product_code; ?>-->
        <!--        </>-->
              <?php
            //   }
             //   ?>
                
        <!--    </select>-->

        <!--</div>-->
        <div class="input-group form-group">
            <span class="input-group-addon" id="sizing-addon2">
                <b>Station</b>
            </span>
            <select name="station" class="form-control select2" aria-describedby="sizing-addon2">
                <?php
                foreach ($dataStation as $type) {
                ?>
                <option value="<?php echo $type->s_id; ?>">
                    <?php echo $type->station_name; ?>
                </option>
                <?php
                }
                ?>
                <option value="all">All</option>
            </select>

        </div>
    <div class="form-group">
      <div class="col-md-12">
          <button type="submit" name="find" class="form-control btn btn-primary"> <i class="glyphicon glyphicon-ok"></i> Select</button>
      </div>
    </div>
  </form>
</div >
  </div>
  <!-- /.box-header -->
  <div class="box-body table-responsive">
    <table id="list-data" class="table table-striped table-bordered display  nowrap" cellspacing="0" width="100%">
      <thead>
        <tr>
          <th >Product Code</th>
          <th >Preform Code</th>
          <th >RM Code</th>
          <th >Reference NO</th>
          <th >Produced QTY</th>
          <th >Damaged QTY</th>
          <th >Received Weight</th>
          <th >Left Weight</th>
          <th >Shift</th>
          <th >Station</th>
          <th >Activity Date</th>
          
          <th style="text-align: center;">Manage</th>
        </tr>
      </thead>
      <tbody>
      <?php
        echo fetch_data();
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