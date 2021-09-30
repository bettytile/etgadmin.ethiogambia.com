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
                  //$customer=$_POST['id_customer'];
                  $station = $_POST['station'];
                   $p_code = $_POST['product'];
                  $sel="";
                 
                    if ($station == "all") { 
                        $sel = "SELECT SUM(received_qty) received_qty,SUM(issued_qty) issued_qty,stock_semifinished.raw_material_type,stock_semifinished_copy.available_qty,stock_semifinished.store_location,stock_semifinished.activity_date,stock_semifinished_copy.id_product,stock_semifinished_copy.id_station,station.station_name,preform.preform_code FROM stock_semifinished stock_semifinished INNER JOIN stock_semifinished_copy stock_semifinished_copy on stock_semifinished.raw_material_type=stock_semifinished_copy.id_product AND stock_semifinished.store_location=stock_semifinished_copy.id_station INNER JOIN preform preform on stock_semifinished.raw_material_type = preform.pre_id INNER JOIN station station on stock_semifinished.store_location = station.s_id WHERE stock_semifinished.raw_material_type = '".$p_code."' AND activity_date BETWEEN '".$fdate."' AND '".$tdate."' GROUP BY id_station"; 
                     
                    //   $sel= "SELECT received_qty,issued_qty,raw_material_type,available_qty,station_name,product_code FROM (SELECT raw_material_type,store_location,activity_date,SUM(received_qty) received_qty,SUM(issued_qty) issued_qty FROM stock_semifinished GROUP BY stock_semifinished.raw_material_type,stock_semifinished.store_location) s LEFT JOIN (SELECT id_product,available_qty,id_station FROM stock_semifinished_copy GROUP BY stock_semifinished_copy.id_station,stock_semifinished_copy.id_product) f ON s.raw_material_type = f.id_product AND s.store_location=f.id_station LEFT JOIN (SELECT s_id,station_name FROM station) h ON s.store_location=h.s_id LEFT JOIN (SELECT prod_id,product_code FROM product) p ON s.raw_material_type=p.prod_id WHERE s.raw_material_type='".$p_code."' AND activity_date BETWEEN '".$fdate."' AND '".$tdate."' GROUP BY s.raw_material_type";             
                                   
                    $run = mysqli_query($con, $sel) or die("Error: ".mysqli_error($con));
                    
                        while ($row=mysqli_fetch_array($run) ) {
                            
                                    $outputs .='<tr>
                                    <td>'.$row['preform_code'].'</td>
                                    <td>'.$row['received_qty'].'</td>
                                    <td>'. $row['issued_qty'].'</td>
                                    <td>'. $row['available_qty'].'</td>
                                    <td>'. $row['station_name'].'</td>
                                    </tr>'
                                    ;
                                    
                                    
                                }
                   
                  
                  
                }
                elseif ($p_code == "all") { 
                    $sel = "SELECT SUM(stock_semifinished.received_qty) received_qty,SUM(stock_semifinished.issued_qty) issued_qty,stock_semifinished.raw_material_type,stock_semifinished.product_code,stock_semifinished_copy.available_qty,stock_semifinished.store_location,stock_semifinished.activity_date,stock_semifinished_copy.id_product,stock_semifinished_copy.id_station,station.station_name FROM stock_semifinished stock_semifinished LEFT JOIN stock_semifinished_copy stock_semifinished_copy on stock_semifinished.raw_material_type=stock_semifinished_copy.id_product AND stock_semifinished.store_location=stock_semifinished_copy.id_station LEFT JOIN station station on stock_semifinished.store_location = station.s_id WHERE stock_semifinished.store_location = '".$station."' AND activity_date BETWEEN '".$fdate."' AND '".$tdate."' GROUP BY stock_semifinished.raw_material_type"; 
                //   $sel= "SELECT received_qty,issued_qty,raw_material_type,available_qty,station_name,product_code FROM (SELECT raw_material_type,store_location,activity_date,SUM(received_qty) received_qty,SUM(issued_qty) issued_qty FROM stock_semifinished GROUP BY stock_semifinished.raw_material_type,stock_semifinished.store_location) s LEFT JOIN (SELECT id_product,available_qty,id_station FROM stock_semifinished_copy GROUP BY stock_semifinished_copy.id_station,stock_semifinished_copy.id_product) f ON s.raw_material_type = f.id_product AND s.store_location=f.id_station LEFT JOIN (SELECT s_id,station_name FROM station) h ON s.store_location=h.s_id LEFT JOIN (SELECT prod_id,product_code FROM product) p ON s.raw_material_type=p.prod_id WHERE s.store_location='".$station."' AND activity_date BETWEEN '".$fdate."' AND '".$tdate."' GROUP BY s.raw_material_type";             
                               
                $run = mysqli_query($con, $sel) or die("Error: ".mysqli_error($con));
                
                    while ($row=mysqli_fetch_array($run) ) {
                        
                                $outputs .='<tr>
                                <td>'.$row['product_code'].'</td>
                                <td>'.$row['received_qty'].'</td>
                                <td>'.$row['issued_qty'].'</td>
                                <td>'.$row['available_qty'].'</td>
                                <td>'.$row['station_name'].'</td>
                                </tr>'
                                ;
                                
                                
                            }
               
              
              
            }
                 else {
                    $sel = "SELECT SUM(received_qty) received_qty,SUM(issued_qty) issued_qty,stock_semifinished.raw_material_type,stock_semifinished_copy.available_qty,stock_semifinished_copy.store_location,stock.activity_date,stock_semifinished_copy.id_product,station.station_name,preform.preform_code FROM stock_semifinished stock_semifinished INNER JOIN stock_semifinished_copy stock_semifinished_copy on stock_semifinished.raw_material_type=stock_semifinished_copy.id_product INNER JOIN preform preform on stock_semifinished_copy.id_product = preform.pre_id INNER JOIN station station on stock_semifinished.store_location = station.s_id WHERE stock_semifinished.raw_material_type = '".$p_code."' AND stock_semifinished.store_location = '".$station."' AND activity_date BETWEEN '".$fdate."' AND '".$tdate."'"; 
                    //  $sel= "SELECT received_qty,issued_qty,raw_material_type,available_qty,station_name,product_code FROM (SELECT raw_material_type,store_location,activity_date,SUM(received_qty) received_qty,SUM(issued_qty) issued_qty FROM stock_semifinished GROUP BY stock_semifinished.raw_material_type,stock_semifinished.store_location) s LEFT JOIN (SELECT id_product,available_qty,id_station FROM stock_semifinished_copy GROUP BY stock_semifinished_copy.id_station,stock_semifinished_copy.id_product) f ON s.raw_material_type = f.id_product AND s.store_location=f.id_station LEFT JOIN (SELECT s_id,station_name FROM station) h ON s.store_location=h.s_id LEFT JOIN (SELECT prod_id,product_code FROM product) p ON s.raw_material_type=p.prod_id WHERE s.store_location='".$station."' AND s.raw_material_type='".$p_code."' AND activity_date BETWEEN '".$fdate."' AND '".$tdate."' GROUP BY s.raw_material_type";             
                   
                  $run = mysqli_query($con, $sel) or die("Error: ".mysqli_error($con));
                  
                    while ($row=mysqli_fetch_array($run) ) {
                          
                                $outputs .='<tr>
                                 
                                <td>'.$row['preform_code'].'</td>
                                <td>'.$row['received_qty'].'</td>
                                <td>'. $row['issued_qty'].'</td>
                                <td>'. $row['available_qty'].'</td>
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
  <h3 style="display:block; text-align:center;">Semifinished Summary</h3>

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
                foreach ($dataPreform as $type) {
                ?>
                <option value="<?php echo $type->pre_id; ?>">
                    <?php echo $type->preform_code; ?>
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
       
                <th >Product Code</th>
                <th >Total Received(QTY)</th>
                <th >Total Issued(QTY)</th>
                <th >Currently Available(QTY)</th>
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