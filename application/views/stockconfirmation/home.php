<div class="msg" style="display:none;">
  <?php echo @$this->session->flashdata('msg'); ?>
</div>
<?php

  function fetch_data(){
    $outputs='';
    $i = 0;
          
		$con = mysqli_connect("cendana.c0l5un2vhvyo.us-east-2.rds.amazonaws.com","admin","#root321","3306","cendana") or die("Connection could not be Established");
                 
                  
                 
                  $sql = "SELECT * FROM pending,station WHERE pending.id_station = station.s_id AND confirmation_status='1'";
                  
                  $run = mysqli_query($con, $sql) or die("Error: ".mysqli_error($con));
                  while ($row=mysqli_fetch_array($run)) {
                    $outputs .='<tr>
                      <td>'.$row['product_code'].'</td>
                       <td>'.$row['reference_no'].'</td>
                        <td >'.$row['received_qty'].'</td>
                        <td >'.$row['issued_qty'].'</td>
                        <td>'.$row['station_name'].'</td>
                        <td>'.$row['activity_date'].'</td>
            
            <td class="text-center ">
               
               <button class="btn btn-warning btn-sm update-datastockProduction" data-id="'.$row['stock_id'].'"><i class="glyphicon glyphicon-repeat"></i> Update</button>
                    
              
              <button class="btn btn-danger btn-sm delete-products" data-id="'.$row['stock_id'].'" data-toggle="modal" data-target="#deleteProducts"><i class="glyphicon glyphicon-check"></i>  Delete</button>
            </td>
      
        </td>
                      </tr>'
                      ;
                      //<button class="btn btn-success btn-sm confirm-products" data-id="'.$row['stock_id'].'" data-toggle="modal" data-target="#confirmProducts"><i class="glyphicon glyphicon-check"></i>  Confirm</button>
                     // <button class="btn btn-warning btn-sm update-datastockProduction" data-id="'.$row['stock_id'].'"><i class="glyphicon glyphicon-repeat"></i> Update</button>
                    
                   // <button class="btn btn-danger btn-sm delete-products" data-id="'.$row['stock_id'].'" data-toggle="modal" data-target="#deleteProducts"><i class="glyphicon glyphicon-check"></i>  Delete</button>
                }
                  
        //          elseif($station == 2 && $prow['product_type'] == 5){
                 
        //           $sql = "SELECT * FROM pending,product,station WHERE pending.id_product =product.prod_id AND pending.id_station = station.s_id AND pending.id_station='".$station."' AND confirmation_status='0'";
                  
        //           $run = mysqli_query($con, $sql) or die("Error: ".mysqli_error($con));
        //           while ($row=mysqli_fetch_array($run)) {
        //             $outputs .='<tr>
        //               <td>'.$row['product_code'].'</td>
        //               <td>'.$row['reference_no'].'</td>
        //                 <td >'.$row['received_qty'].'</td>
        //                 <td >'.$row['issued_qty'].'</td>
        //                 <td>'.$row['station_name'].'</td>
        //                 <td>'.$row['activity_date'].'</td>
            
        //     <td class="text-center ">
        //       <button class="btn btn-success btn-sm confirm-products" data-id="'.$row['stock_id'].'" data-toggle="modal" data-target="#confirmProducts"><i class="glyphicon glyphicon-check"></i>  Confirm</button> 
        //       <button class="btn btn-warning btn-sm update-datastockProduction" data-id="'.$row['stock_id'].'"><i class="glyphicon glyphicon-repeat"></i> Update</button>
           
        //     </td>
      
        // </td>
        //               </tr>'
        //               ;
                    
                    
        //         }
        //           }
        //           else{
                     
        //           $sql = "SELECT * FROM pending,preform,station WHERE pending.id_product =preform.pre_id AND pending.id_station = station.s_id AND pending.id_station='".$station."' AND confirmation_status='0'";
                  
        //           $run = mysqli_query($con, $sql) or die("Error: ".mysqli_error($con));
        //           while ($row=mysqli_fetch_array($run)) {
        //             $outputs .='<tr>
        //               <td>'.$row['preform_code'].'</td>
        //               <td>'.$row['reference_no'].'</td>
        //                 <td >'.$row['received_qty'].'</td>
        //                 <td >'.$row['issued_qty'].'</td>
        //                 <td>'.$row['station_name'].'</td>
        //                 <td>'.$row['activity_date'].'</td>
            
        //     <td class="text-center ">
        //       <button class="btn btn-success btn-sm confirm-products" data-id="'.$row['stock_id'].'" data-toggle="modal" data-target="#confirmProducts"><i class="glyphicon glyphicon-check"></i>  Confirm</button> 
        //       <button class="btn btn-warning btn-sm update-datastockProduction" data-id="'.$row['stock_id'].'"><i class="glyphicon glyphicon-repeat"></i> Update</button>
           
        //     </td>
      
        // </td>
        //               </tr>'
        //               ;
                    
                    
        //         } 
        //           }
                  


                return $outputs;

}
?>
<div class="box">
  <div class="box-header">
  
  </div>
  <!-- /.box-header -->
  <div class="box-body">
    <table id="list-data" class="table table-bordered table-striped">
      <thead>
        <tr>
          <th >Product Code</th>
          <th >Reference NO</th>
          <th >Received QTY</th>
          <th >Issued QTY</th>
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

 <?php show_my_confirm('deleteProducts', 'hapus-dataStockDeletion', 'Do You Want To Delete?', 'yes'); ?> 
<?php show_my_confirm('confirmProducts', 'hapus-dataStockConfirmation', 'Do You Want To confirm?', 'ok'); ?>

<?php
  $data['judul'] = 'Confirmation';
  $data['url'] = 'Confirmation/import';
  echo show_my_modal('modals/modal_import', 'import-production', $data);
?>