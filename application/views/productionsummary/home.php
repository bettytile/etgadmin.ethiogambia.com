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
                  //$customer=$_POST['id_customer'];
                  $station = $_POST['station'];
                   $p_code = $_POST['product'];
                  $sel="";
                 
                    if ($station == "all") { 
                        $sel = "SELECT SUM(received_weight) received_weight,SUM(qty_produced) qty_produced,SUM(qty_damaged) qty_damaged,production.id_product,production.id_raw_material,production.id_preform,production.id_station,production.id_production_type,station.station_name,product.product_code,production_type.production_type_name,preform.preform_code,raw_material.rawmaterial_code FROM production production INNER JOIN product product on production.id_product = product.prod_id inner join station station on production.id_station = station.s_id inner join production_type production_type on production.id_production_type =production_type.production_type_id INNER JOIN preform preform ON preform.pre_id=production.id_preform INNER JOIN raw_material raw_material ON raw_material.rm_id=production.id_raw_material WHERE id_product = '".$p_code."' AND activity_date BETWEEN '".$fdate."' AND '".$tdate."'"; 
                                   
                    $run = mysqli_query($con, $sel) or die("Error: ".mysqli_error($con));
                    
                        while ($row=mysqli_fetch_array($run) ) {
                            
                                    $outputs .='<tr>
                                    <td>'.$row['product_code'].'</td>
                                    <td>'.$row['preform_code'].'</td>
                                    <td>'.$row['rawmaterial_code'].'</td>
                                    <td>'.$row['received_weight'].'</td>
                                    <td>'.$row['qty_produced'].'</td>
                                    <td>'. $row['qty_damaged'].'</td>
                                    <td>'. $row['station_name'].'</td>
                                    </tr>'
                                    ;
                                    
                                    
                                }
                   
                  
                  
                }
                elseif ($p_code == "all") { 
                    $sel = "SELECT SUM(received_weight) received_weight,SUM(qty_produced) qty_produced,SUM(qty_damaged) qty_damaged,production.id_product,production.id_station,production.id_production_type,production.id_raw_material,production.id_preform,station.station_name,production.product_code,production_type.production_type_name,preform.preform_code,raw_material.rawmaterial_code FROM production production LEFT JOIN station station ON production.id_station = station.s_id LEFT JOIN production_type production_type ON production.id_production_type =production_type.production_type_id LEFT JOIN preform preform ON preform.pre_id=production.id_preform LEFT JOIN raw_material raw_material ON raw_material.rm_id=production.id_raw_material WHERE id_station = '".$station."' AND activity_date BETWEEN '".$fdate."' AND '".$tdate."' GROUP BY product_code"; 
                               
                $run = mysqli_query($con, $sel) or die("Error: ".mysqli_error($con));
                
                    while ($row=mysqli_fetch_array($run) ) {
                        if($row['id_production_type']==='1'){
                                $outputs .='<tr>
                                    <td>'.$row['product_code'].'</td>
                                    <td>'.$row['preform_code'].'</td>
                                    <td>'.$row['rawmaterial_code'].'</td>
                                    <td>'.$row['received_weight'].'</td>
                                    <td>'.$row['qty_produced'].'</td>
                                    <td>'.$row['qty_damaged'].'</td>
                                    <td>'.$row['station_name'].'</td>
                                    </tr>'
                                    ;
                                
                                
                            }
                            elseif($row['id_production_type']==='5'){
                                $sel = "SELECT SUM(received_weight) received_weight,SUM(qty_produced) qty_produced,SUM(qty_damaged) qty_damaged,production.id_product,production.id_station,production.id_production_type,production.id_raw_material,production.id_preform,station.station_name,production.product_code,production_type.production_type_name,preform.preform_code,raw_material.rawmaterial_code FROM production production LEFT JOIN station station ON production.id_station = station.s_id LEFT JOIN production_type production_type ON production.id_production_type =production_type.production_type_id LEFT JOIN preform preform ON preform.pre_id=production.id_preform LEFT JOIN raw_material raw_material ON raw_material.rm_id=production.id_raw_material WHERE id_station = '".$station."' AND activity_date BETWEEN '".$fdate."' AND '".$tdate."' GROUP BY product_code"; 
                               
                $run = mysqli_query($con, $sel) or die("Error: ".mysqli_error($con));
                while ($row=mysqli_fetch_array($run) ) {
                                $outputs .='<tr>
                                    <td>'.$row['product_code'].'</td>
                                    <td>'.$row['preform_code'].'</td>
                                    <td>'.$row['rawmaterial_code'].'</td>
                                    <td>'.$row['received_weight'].'</td>
                                    <td>'.$row['qty_produced'].'</td>
                                    <td>'. $row['qty_damaged'].'</td>
                                    <td>'. $row['station_name'].'</td>
                                    </tr>'
                                    ;
                            }
                            }
                            elseif($row['id_production_type']==='2'){
                                $sel = "SELECT SUM(received_weight) received_weight,SUM(qty_produced) qty_produced,SUM(qty_damaged) qty_damaged,production.id_product,production.id_station,production.id_production_type,production.id_raw_material,production.id_preform,station.station_name,production.product_code,production_type.production_type_name,preform.preform_code,raw_material.rawmaterial_code FROM production production LEFT JOIN station station ON production.id_station = station.s_id LEFT JOIN production_type production_type ON production.id_production_type =production_type.production_type_id LEFT JOIN preform preform ON preform.pre_id=production.id_preform LEFT JOIN raw_material raw_material ON raw_material.rm_id=production.id_raw_material WHERE id_station = '".$station."' AND activity_date BETWEEN '".$fdate."' AND '".$tdate."' GROUP BY product_code"; 
                               
                $run = mysqli_query($con, $sel) or die("Error: ".mysqli_error($con));
                while ($row=mysqli_fetch_array($run) ) {
                               $outputs .='<tr>
                                    <td>'.$row['product_code'].'</td>
                                    <td>'.$row['preform_code'].'</td>
                                    <td>'.$row['rawmaterial_code'].'</td>
                                    <td>'.$row['received_weight'].'</td>
                                    <td>'.$row['qty_produced'].'</td>
                                    <td>'. $row['qty_damaged'].'</td>
                                    <td>'. $row['station_name'].'</td>
                                    </tr>'
                                    ;
                            }
                            }
                            
                    }
                    
               
              
              
            }
                 else {
                    $sel= "SELECT SUM(received_weight) received_weight,SUM(qty_produced) qty_produced,SUM(qty_damaged) qty_damaged,production.id_product,production.id_station,production.id_production_type,production.id_raw_material,production.id_preform,station.station_name,product.product_code,production_type.production_type_name,preform.preform_code,raw_material.rawmaterial_code FROM production production INNER JOIN product product on production.id_product = product.prod_id inner join station station on production.id_station = station.s_id inner join production_type production_type on production.id_production_type =production_type.production_type_id INNER JOIN preform preform ON preform.pre_id=production.id_preform INNER JOIN raw_material raw_material ON raw_material.rm_id=production.id_raw_material WHERE id_product = '".$p_code."' AND id_station = '".$station."' AND activity_date BETWEEN '".$fdate."' AND '".$tdate."'"; 

                  $run = mysqli_query($con, $sel) or die("Error: ".mysqli_error($con));
                  
                    while ($row=mysqli_fetch_array($run) ) {
                          
                                $outputs .='<tr>
                                    <td>'.$row['product_code'].'</td>
                                    <td>'.$row['preform_code'].'</td>
                                    <td>'.$row['rawmaterial_code'].'</td>
                                    <td>'.$row['received_weight'].'</td>
                                    <td>'.$row['qty_produced'].'</td>
                                    <td>'. $row['qty_damaged'].'</td>
                                    <td>'. $row['station_name'].'</td>
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
  <h3 style="display:block; text-align:center;">Product Summary</h3>

  <form id="form-delivery-report" method="POST">
    
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
    
        <div class="input-group form-group">
            <span class="input-group-addon" id="sizing-addon2">
                <b>Product Code</b>
            </span>
            <select name="product" class="form-control select2" aria-describedby="sizing-addon2">
            <option value="all">All</option>
                <?php
                foreach ($dataProduct as $type) {
                ?>
                <option value="<?php echo $type->prod_id; ?>">
                    <?php echo $type->product_code; ?>
                </option>
                <?php
                }
                ?>
                
            </select>

        </div>
        <!-- <div class="input-group form-group">
            <span class="input-group-addon" id="sizing-addon2">
                <b>product Code</b>
            </span>
            <select name="code" class="form-control select2" aria-describedby="sizing-addon2">
            <option value="all">All</option>
                <?php
                foreach ($dataProduct as $type) {
                ?>
                <option value="<?php echo $type->product_code; ?>">
                    <?php echo $type->product_code; ?>
                </option>
                <?php
                }
                ?>
                
            </select>
</div> -->
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
      <thead  >
      <tr >
       
                <th > Product Code</th>
                <th >Preform Code</th>
                <th >RM Code</th>
                <th >Raw Material Issued</th>
                <th >Total Produced</th>
                <th >Total Damaged</th>
                <th >Station</th>
                

              </tr>
      </thead>
       <tbody >
       <?php 
               echo fetch_data();
             ?> 
      </tbody>
      
    </table>
    </div>
    <button  onclick="printContent('tbl');" id="btn"  class="btn btn-success">Print</button>
  </div>
  <script>
  function printContent(el){
      var restorepage = document.body.innerHTML;
      var printcontent = document.getElementById(el).innerHTML;
      document.body.innerHTML = printcontent;
      window.print();
      document.body.innerHTML = restorepage;
  }
  // function download(file, id) { 
  
  //                   //creating an invisible element 
  //                   var element = document.createElement('a'); 
  //                   element.setAttribute('href', 'data:text/plain;charset=utf-8, ' 
  //                                        + encodeURIComponent(text)); 
  //                   element.setAttribute('download', file); 
  
  //                   //the above code is equivalent to 
  //                   // <a href="path of file" download="file name"> 
  
  //                   document.body.appendChild(element); 
  
  //                   //onClick property 
  //                   element.click(); 
  
  //                   document.body.removeChild(element); 
  //               } 
  
  //               // Start file download. 
  //               document.getElementById("btn").addEventListener("click", function() { 
  //                   // Generate download of hello.txt file with some content 
  //                   var text = document.getElementById("text").value; 
  //                   var filename = "GFG.txt"; 
  
  //                   download(filename, text); 
  //               }, false);
</script>
</div>


<div id="tempat-modal"></div>

<!-- <?php show_my_confirm('deleteProduct', 'hapus-dataProduct', 'Are You Sure You Want To Delete?', 'Yes'); ?> -->
<!-- <?php
  $data['judul'] = 'Production';
  $data['url'] = 'Product/import';
  echo show_my_modal('modals/modal_import', 'import-product', $data);
?> -->