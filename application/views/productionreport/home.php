<div class="msg" style="display:none;">
  <?php echo @$this->session->flashdata('msg'); ?>
</div>
<?php
  function fetch_data(){
    $outputs='';
    $i = 0;
          if (isset($_POST['find'])) {
                  $con = mysqli_connect("cendana.c0l5un2vhvyo.us-east-2.rds.amazonaws.com","admin","#root321","cendana") or die("Connection could not be Established");
                  $fdate=$_POST['from'];
                  $tdate=$_POST['to'];
                  $type=$_POST['p_type'];
                  $station = $_POST['station'];
                 // $p_code = $_POST['code'];
                  $sel="";
                 
                  if($type=="all" ){
                    $sel = "SELECT * FROM production,machine,station,production_type WHERE production_type.production_type_id = production.id_production_type 
                    AND machine.mach_id=production.id_machine AND station.s_id=production.id_station AND production.id_station='".$station."' AND activity_date BETWEEN '".$fdate."' AND '".$tdate."' ORDER BY activity_date DESC"; 
                    $run = mysqli_query($con, $sel) or die("Error: ".mysqli_error($con));
                  
                    while ($row=mysqli_fetch_array($run)) {
                      $outputs .='<tr>
                        <td>'.$row['id_employee'].'</td>
                        <td>'.$row['shift'].'</td>
                        <td>'.$row['activity_date'].'</td>
                        <td>'.$row['reference_no'].'</td>
                        <td>'.$row['machine_code'].'</td>
                        <td>'.$row['production_type_name'].'</td>
                        <td>'. $row['product_code'].'</td>
                        <td>'. $row['station_name'].'</td>
                        <td>'.$row['qty_produced'].'</td>
                        <td>'.$row['qty_damaged'].'</td>
                        </tr>'
                        ;
                      
                      
                  } 
                   
                }
                // elseif ($p_code=="all") {
                //   $sel = "SELECT * FROM production, product,machine,station, production_type WHERE id_production_type='{$type}' AND id_station='{$station}' AND production_type.production_type_id = production.id_production_type AND product.prod_id=production.id_product
                //  AND machine.mach_id=production.id_machine AND station.s_id=production.id_station AND activity_date BETWEEN '".$fdate."' AND '".$tdate."' ORDER BY activity_date DESC"; 
                //   $run = mysqli_query($con, $sel) or die("Error: ".mysqli_error($con));
                
                //   while ($row=mysqli_fetch_array($run)) {
                //      $outputs .='<tr>
                //       <td>'.$row['id_employee'].'</td>
                //       <td>'.$row['shift'].'</td>
                //       <td>'.$row['activity_date'].'</td>
                //       <td>'.$row['reference_no'].'</td>
                //       <td>'.$row['machine_code'].'</td>
                //       <td>'.$row['production_type_name'].'</td>
                //       <td>'. $row['product_code'].'</td>
                //       <td>'. $row['station_name'].'</td>
                //       <td>'.$row['qty_produced'].'</td>
                //       <td>'.$row['qty_damaged'].'</td>
                //       </tr>'
                //       ;
                     
                     
                //  }
                // }
                  elseif ($station=="all") {
                    $sel = "SELECT * FROM production,machine,station, production_type WHERE id_production_type='{$type}' AND production_type.production_type_id = production.id_production_type 
                    AND machine.mach_id=production.id_machine AND station.s_id=production.id_station AND production.id_production_type='".$type."' AND activity_date BETWEEN '".$fdate."' AND '".$tdate."' ORDER BY activity_date DESC"; 
                     $run = mysqli_query($con, $sel) or die("Error: ".mysqli_error($con));
                  
                     while ($row=mysqli_fetch_array($run)) {
                       $outputs .='<tr>
                         <td>'.$row['id_employee'].'</td>
                         <td>'.$row['shift'].'</td>
                         <td>'.$row['activity_date'].'</td>
                         <td>'.$row['reference_no'].'</td>
                         <td>'.$row['machine_code'].'</td>
                         <td>'.$row['production_type_name'].'</td>
                         <td>'. $row['product_code'].'</td>
                         <td>'. $row['station_name'].'</td>
                         <td>'.$row['qty_produced'].'</td>
                         <td>'.$row['qty_damaged'].'</td>
                         </tr>'
                         ;
                       
                       
                   }
                  }
                  elseif($type=="5" && $station=="2" || $station=="3"){
                      $sel = "SELECT * FROM production,machine,station,production_type WHERE production_type.production_type_id = production.id_production_type 
                    AND machine.mach_id=production.id_machine AND station.s_id=production.id_station AND production.id_station='".$station."' AND production.id_production_type='".$type."' AND activity_date BETWEEN '".$fdate."' AND '".$tdate."' ORDER BY activity_date DESC"; 
                    $run = mysqli_query($con, $sel) or die("Error: ".mysqli_error($con));
                  
                    while ($row=mysqli_fetch_array($run)) {
                        
                            
                            $outputs .='<tr>
                        <td>'.$row['id_employee'].'</td>
                        <td>'.$row['shift'].'</td>
                        <td>'.$row['activity_date'].'</td>
                        <td>'.$row['reference_no'].'</td>
                        <td>'.$row['machine_code'].'</td>
                        <td>'.$row['production_type_name'].'</td>
                        <td>'.$row['product_code'].'</td>
                        <td>'.$row['station_name'].'</td>
                        <td>'.$row['qty_produced'].'</td>
                        <td>'.$row['qty_damaged'].'</td>
                        </tr>'
                        ;
                    }
                      
                  }
                  
                  else {
                    $sel = "SELECT * FROM production,machine,station,production_type WHERE production_type.production_type_id = production.id_production_type 
                    AND machine.mach_id=production.id_machine AND station.s_id=production.id_station AND production.id_station='".$station."' AND production.id_production_type='".$type."' AND activity_date BETWEEN '".$fdate."' AND '".$tdate."' ORDER BY activity_date DESC"; 
                    $run = mysqli_query($con, $sel) or die("Error: ".mysqli_error($con));
                  
                    while ($row=mysqli_fetch_array($run)) {
                      $outputs .='<tr>
                        <td>'.$row['id_employee'].'</td>
                        <td>'.$row['shift'].'</td>
                        <td>'.$row['activity_date'].'</td>
                        <td>'.$row['reference_no'].'</td>
                        <td>'.$row['machine_code'].'</td>
                        <td>'.$row['production_type_name'].'</td>
                        <td>'. $row['product_code'].'</td>
                        <td>'. $row['station_name'].'</td>
                        <td>'.$row['qty_produced'].'</td>
                        <td>'.$row['qty_damaged'].'</td>
                        </tr>'
                        ;
                      
                      
                  }
                  }
                   
                  }
                
                  


                return $outputs;

}
?>

<div class="box">
  <div class="box-header">
 
    <!-- <div class="col-md-6" style="padding: 0;">
        <button class="form-control btn btn-primary" data-toggle="modal" data-target="#production-report"><i class="glyphicon glyphicon-plus-sign"></i>Production Report</button>
    </div> -->
    <!-- <div class="col-md-3">
        <a href="<?php echo base_url('Product/export'); ?>" class="form-control btn btn-default"><i class="glyphicon glyphicon glyphicon-floppy-save"></i> Export Data Excel</a>
    </div>
    <div class="col-md-3">
        <button class="form-control btn btn-default" data-toggle="modal" data-target="#import-product"><i class="glyphicon glyphicon glyphicon-floppy-open"></i> Import Data Excel</button>
    </div> -->
    <div class="col-md-offset-1 col-md-10 col-md-offset-1 well">
  <div class="form-msg"></div>
  <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
  <h3 style="display:block; text-align:center;">Production Report</h3>

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
    
        <div class="input-group form-group">
            <span class="input-group-addon" id="sizing-addon2">
                <b>production Type</b>
            </span>
            <select name="p_type" class="form-control select2" aria-describedby="sizing-addon2">
                <?php
                foreach ($dataProductionType as $type) {
                ?>
                <option value="<?php echo $type->production_type_id; ?>">
                    <?php echo $type->production_type_name; ?>
                </option>
                <?php
                }
                ?>
                <option value="all">All</option>
            </select>

        </div>
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
  <div class="box-body">
  <div id="tbl">
    <table id="list-data" class="table table-bordered table-striped">
      <thead>
      <tr>
                <th >Name</th>
                <th >Shift</th>
                <th >Date</th>
                <th >Reference NO</th>
                <th >Machine Code</th>
                <th >Product Type</th>
                <th >Product Code</th>
                <th >Station</th>
                <th >Produced</th>
                <th >Damaged</th>
                

              </tr>
      </thead>
       <tbody >
       <?php 
               echo fetch_data();
               
             ?> 
      </tbody>
      
    </table>
    </div>
    <form method="post" action="download.php">
        <div class="col-md-2">
        <button type="submit" class="form-control btn btn-default"><i class="glyphicon glyphicon glyphicon-floppy-save"></i> Export Data Excel</button>
    </div>
    </form>

    <button  onclick="printContent('tbl');"  class="btn btn-success">Print</button>
    <script>
$(document).ready(function(){
    $('type="submit"').click(function(){
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.open("POST","download.php?");
        xmlhttp.send();
    });
});
</script>
  <script>
  function printContent(el){
      var restorepage = document.body.innerHTML;
      var printcontent = document.getElementById(el).innerHTML;
      document.body.innerHTML = printcontent;
      window.print();
      document.body.innerHTML = restorepage;
  }
</script>
  </div>
</div>


<div id="tempat-modal"></div>

 <?php show_my_confirm('deleteProduction', 'hapus-dataProduction', 'Do You Want To Delete?', 'yes'); ?> 
<?php show_my_confirm('confirmProduction', 'hapus-dataConfirmation', 'Do You Want To confirm?', 'ok'); ?>

<?php
  $data['judul'] = 'ProductionReport';
  $data['url'] = 'Confirmation/import';
  echo show_my_modal('modals/modal_import', 'import-production', $data);
?>