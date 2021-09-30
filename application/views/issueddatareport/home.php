<div class="msg" style="display:none;">
  <?php echo @$this->session->flashdata('msg'); ?>
</div>
<?php
  function fetch_data(){
    $outputs='';
    $i = 0;
          if (isset($_POST['find'])) {
                  $con = mysqli_connect("cendana.c0l5un2vhvyo.us-east-2.rds.amazonaws.com","admin","#root321","cendana") or die("Connection could not be Established");
                 
                  $fstation = $_POST['from_station'];
                  $tstation = $_POST['to_station'];
                  // $p_code = $_POST['code'];

                  $sel = "SELECT * FROM delivery,preform,station WHERE preform.pre_id=delivery.id_product AND station.s_id=delivery.id_station AND  delivery.id_station='$fstation' AND delivery.to_station='$tstation' ORDER BY activity_date DESC"; 
                  $run = mysqli_query($con, $sel) or die("Error: ".mysqli_error($con));
                      while ($row=mysqli_fetch_array($run)) {
                                $outputs .='<tr>
                                 <td>'. $row['station_name'].'</td>
                                  <td>'.$row['to_station'].'</td>
                                  <td>'.$row['activity_date'].'</td>
                                  <td>'.$row['reference_no'].'</td>
                                  <td>'. $row['preform_code'].'</td>
                                  
                                  <td>'.$row['qty'].'</td>
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
  <h3 style="display:block; text-align:center;">Delivery Report</h3>

  <form id="form-delivery-report" method="POST">
    
    
        <div class="input-group form-group">
            <span class="input-group-addon" id="sizing-addon2">
                <b>From Station</b>
            </span>
            <select name="from_station" class="form-control select2" aria-describedby="sizing-addon2">
                <?php
                foreach ($dataStation as $type) {
                ?>
                <option value="<?php echo $type->id; ?>">
                    <?php echo $type->station; ?>
                </option>
                <?php
                }
                ?>
                <option value="all">All</option>
            </select>

        </div>
        <div class="input-group form-group">
            <span class="input-group-addon" id="sizing-addon2">
                <b>To Station</b>
            </span>
            <select name="to_station" class="form-control select2" aria-describedby="sizing-addon2">
                <?php
                foreach ($dataStation as $type) {
                ?>
                <option value="<?php echo $type->id; ?>">
                    <?php echo $type->station; ?>
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
                
                <th >From Station</th>
                <th >To Station</th>
                <th >Date</th>
                <th >Reference NO</th>
                <th >Product Code</th>
                <th >Delivered QTY</th>
                

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