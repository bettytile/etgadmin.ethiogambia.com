<div class="msg" style="display:none;">
  <?php echo @$this->session->flashdata('msg'); ?>
</div>
<?php
  function fetch_data(){
    $outputs='';
    $i = 0;
          if (isset($_POST['find'])) {
            $con = mysqli_connect("cendana.c0l5un2vhvyo.us-east-2.rds.amazonaws.com","admin","#root321","3306","cendana") or die("Connection could not be Established");
            $fdate=$_POST['from'];
                  $tdate=$_POST['to'];

                  $station = $_POST['station'];
                  // $p_code = $_POST['code'];
                  $sel="";                         
                
                // if ($p_code=="all") {
                //   $sel = "SELECT * FROM stock_rawmaterial,product,station WHERE product.prod_id = stock_rawmaterial.raw_material_type AND station.s_id = stock_rawmaterial.store_location  
                //   AND store_location='{$station}' AND activity_date BETWEEN '".$fdate."' AND '".$tdate."' ORDER BY activity_date DESC"; 
                  
                //       $run = mysqli_query($con, $sel) or die("Error: ".mysqli_error($con));
                //       while ($row=mysqli_fetch_array($run)) {
                //               $outputs .='<tr>
                //               <td>'.$row['product_code'].'</td>
                //               <td>'. $row['received_qty'].'</td>
                //               <td>'. $row['issued_qty'].'</td>
                //               <td>'.$row['available_qtys'].'</td>
                //               <td>'.$row['station_name'].'</td>
                              
                                
                //                 </tr>'
                //                 ;
                              
                              
                //           }  
                      
                // }
                  if ($station=="all") {
                    $sel = "SELECT * FROM stock_rawmaterial,station WHERE station.s_id = stock_rawmaterial.store_location AND activity_date BETWEEN '".$fdate."' AND '".$tdate."' ORDER BY activity_date DESC"; 
                       $run = mysqli_query($con, $sel) or die("Error: ".mysqli_error($con));
                        while ($row=mysqli_fetch_array($run)) {
                                $outputs .='<tr>
                                <td>'.$row['product_code'].'</td>
                                <td>'. $row['received_qty'].'</td>
                                <td>'. $row['issued_qty'].'</td>
                              <td>'.$row['station_name'].'</td>
                              <td>'.$row['activity_date'].'</td>
                              
                              
                              </tr>'
                                  ;
                                
                                
                            }  
                        
                  }
                  
                  else {
                    $sel = "SELECT * FROM stock_rawmaterial,station  WHERE  station.s_id = stock_rawmaterial.store_location AND store_location='".$station."' AND activity_date BETWEEN '".$fdate."' AND '".$tdate."' ORDER BY activity_date DESC"; 
                        $run = mysqli_query($con, $sel) or die("Error: ".mysqli_error($con));
                        while ($row=mysqli_fetch_array($run)) {
                            $outputs .='<tr>
                            <td>'.$row['product_code'].'</td>
                            <td>'. $row['received_qty'].'</td>
                            <td>'. $row['issued_qty'].'</td>
                              <td>'.$row['station_name'].'</td>
                              <td>'.$row['activity_date'].'</td>
                              
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
  <h3 style="display:block; text-align:center;">stock_rawmaterial Report</h3>

  <form id="form-stock_rawmaterial-report" method="POST">
    
    <div class="input-group form-group">
    <span class="input-group-addon" id="sizing-addon2">
                <b>From Date</b>
            </span>
     
      <input type="date" class="form-control" placeholder="From Date" name="from" aria-describedby="sizing-addon2">
      
    </div>
    <div class="input-group form-group">
    <span class="input-group-addon" id="sizing-addon2">
                <b>To Date</b>
            </span>
    
      <input type="date" class="form-control" placeholder="To Date" name="to" aria-describedby="sizing-addon2">
      
    </div>
    
        <!-- <div class="input-group form-group">
            <span class="input-group-addon" id="sizing-addon2">
                <b>Raw Material Type</b>
            </span>
            <select name="p_type" class="form-control select2" aria-describedby="sizing-addon2">
                <?php
                foreach ($dataRawMaterial as $type) {
                ?>
                <option value="<?php echo $type->input_type; ?>">
                    <?php echo $type->input_type; ?>
                </option>
                <?php
                }
                ?>
                <option value="all">All</option>
            </select>

        </div> -->
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
                <th >Raw Material Code</th>
                <th >Received QTY</th>
                <th >Issued QTY</th>
                <th >Station</th>
                <th >Date</th>

              </tr>
      </thead>
       <tbody >
       <?php 
               echo fetch_data();
             ?> 
      </tbody>
      
    </table>
    </div>
    <button  onclick="printContent('list-data');"  class="btn btn-success">Print</button>
  </div>
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


<div id="tempat-modal"></div>

<!-- <?php show_my_confirm('deleteProduct', 'hapus-dataProduct', 'Are You Sure You Want To Delete?', 'Yes'); ?> -->
<!-- <?php
  $data['judul'] = 'Production';
  $data['url'] = 'Product/import';
  echo show_my_modal('modals/modal_import', 'import-product', $data);
?> -->