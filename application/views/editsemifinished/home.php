<div class="msg" style="display:none;">`
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
                 $sel="SELECT * FROM stock_semifinished,station WHERE stock_semifinished.store_location=station.s_id AND stock_semifinished.store_location='".$station."' AND stock_semifinished.activity_date BETWEEN '".$fdate."' AND '".$tdate."' ORDER BY stock_semifinished.activity_date DESC";
                 
                //   $sql = "SELECT stock_semifinished.rstock_id AS id, stock_semifinished.raw_material_type AS raw_material_type,stock_semifinished.product_code AS code, stock_semifinished.id_employee AS employee,stock_semifinished.received_qty AS received_qty,stock_semifinished.issued_qty AS issued_qty,stock_semifinished.id_station AS id_station, stock_semifinished.available_qtys AS available_qty, stock_semifinished.reference_no AS reference_no, stock_semifinished.activity_date AS activity_date, stock_semifinished.rstatus AS rstatus,stock_semifinished.warehouse AS warehouse,stock_semifinished.store_location AS station, station.station_name AS station FROM stock_semifinished, station WHERE stock_semifinished.store_location=station.s_id AND stock_semifinished.store_location='".$station."' AND stock_semifinished.activity_date BETWEEN '".$fdate."' AND '".$tdate."' ORDER BY stock_semifinished.activity_date DESC";
                  
                  $run = mysqli_query($con, $sel) or die("Error: ".mysqli_error($con));
                  
                  while ($row=mysqli_fetch_array($run)) {
                    $outputs .='<tr>
                    <td >'.$row['product_code'].'</td>
                    <td >'.$row['reference_no'].'</td>
                    <td >'.$row['available_qtys'].'</td>
                    <td >'.$row['issued_qty'].'</td>
                    <td >'.$row['received_qty'].'</td>
                    <td >'.$row['station_name'].'</td>
                    <td >'.$row['rstatus'].'</td>
                    <td>'.$row['activity_date'].'</td>
                    
                      <td class="text-center" style="min-width:145px;">
        <button class="btn btn-warning btn-sm update-dataSemifinished" data-id="<?php echo $pegawai->id; ?>"><i class="glyphicon glyphicon-repeat"></i> Edit</button>
               <button class="btn btn-danger btn-sm delete-semifinished" data-id="<?php echo $pegawai->id; ?>" data-toggle="modal" data-target="#deleteSemiFinished"><i class="glyphicon glyphicon-remove-sign"></i>  Delete</button>
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
        <a href="<?php echo base_url('EditStock/export'); ?>" class="form-control btn btn-default"><i class="glyphicon glyphicon glyphicon-floppy-save"></i> Export Data Excel</a>
    </div>
    <div class="col-md-6">
        <button class="form-control btn btn-default" data-toggle="modal" data-target="#import-production"><i class="glyphicon glyphicon glyphicon-floppy-open"></i> Import Data Excel</button>
    </div>
    <div class="col-md-offset-1 col-md-10 col-md-offset-1 well">
  <div class="form-msg"></div>
  <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
  <h3 style="display:block; text-align:center;">Edit Semifinished</h3>
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
  </div>
  </div>
  <!-- /.box-header -->
  <div class="box-body">
    <table id="list-data" class="table table-bordered table-striped">
      <thead>
        <tr>
          <th >Product Code</th>
          <th >Reference NO</th>
          <th >Available QTY</th>
          <th >Issued QTY</th>
          <th >Received QTY</th>
          <th >Station</th>
          <th >Status</th>
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

 <?php show_my_confirm('deleteSemiFinished', 'hapus-dataSemiFinished', 'Do You Want To Delete?', 'yes'); ?> 
<?php show_my_confirm('confirmStock', 'hapus-dataConfirmation', 'Do You Want To confirm?', 'ok'); ?>
<!-- 
<?php
  $data['judul'] = 'EditStock';
  $data['url'] = 'Confirmation/import';
  echo show_my_modal('modals/modal_import', 'import-production', $data);
?> -->