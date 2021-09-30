<div class="row">
  <div class="col-lg-4 col-xs-12">
    <div class="box box-info">
      <div class="box-header with-border">
        <i class="fa fa-briefcase"></i>
        <h3 class="box-title">Machine Type<small>Manage Data</small></h3>


        <div class="box-tools pull-right">
          <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
          </button>
          <!-- <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button> -->
        </div>
      </div>
      
      <!-- <div class="box-body">
        <canvas id="data-station" style="height:250px"></canvas>
      </div> -->
      <div class="box-body">
        <table id="data-machineType" class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>Machine Type</th>

                    <th style="text-align: center;">Manage</th>
                  
            </thead>
            <tbody >
            <?php
foreach ($dataMachineType as $product) {
?>
<tr>
    <td style="min-width:150px;"><?php echo $product->machine_type; ?></td>

    <td><button class="btn btn-danger btn-sm delete-product" data-id="<?php echo $product->id; ?>" data-toggle="modal"
            data-target="#deleteProduct"><i class="glyphicon glyphicon-remove-sign"></i> Delete</button></td>
</tr>
<?php
}
?>
            
            </tbody>
        </table>
    <button class="form-control btn btn-primary" data-toggle="modal" data-target="#add-machineType"><i
                    class="glyphicon glyphicon-plus-sign"></i> Add </button>
    
      </div>
    </div>
  </div>
<div class="col-lg-4 col-xs-12">
    <div class="box box-info">
      <div class="box-header with-border">
        <i class="fa fa-briefcase"></i>
        <h3 class="box-title">Product Type<small>Manage Data</small></h3>


        <div class="box-tools pull-right">
          <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
          </button>
          <!-- <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button> -->
        </div>
      </div>
      
      <!-- <div class="box-body">
        <canvas id="data-station" style="height:250px"></canvas>
      </div> -->
      <div class="box-body">
        <table id="jml_pegawai" class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>Product Type</th>

                    <th style="text-align: center;">Manage</th>
                  
            </thead>
            <tbody>
               
            <?php
foreach ($dataProductType as $product) {
?>
<tr>
    <td style="min-width:150px;"><?php echo $product->product_name; ?></td>

    <td><button class="btn btn-danger btn-sm delete-product" data-id="<?php echo $product->p_id; ?>" data-toggle="modal"
            data-target="#deleteProduct"><i class="glyphicon glyphicon-remove-sign"></i> Delete</button></td>
</tr>
<?php
}
?>
            </tbody>
        </table>
    <button class="form-control btn btn-primary" data-toggle="modal" data-target="#add-productType"><i
                    class="glyphicon glyphicon-plus-sign"></i> Add </button>
    
      </div>
    </div>
  </div>
  <div class="col-lg-4 col-xs-12">
    <div class="box box-info">
      <div class="box-header with-border">
        <i class="fa fa-briefcase"></i>
        <h3 class="box-title">Production Type<small>Manage Data</small></h3>


        <div class="box-tools pull-right">
          <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
          </button>
          <!-- <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button> -->
        </div>
      </div>
      
      <!-- <div class="box-body">
        <canvas id="data-station" style="height:250px"></canvas>
      </div> -->
      <div class="box-body">
        <table id="jml_pegawai" class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>Production Type</th>

                    <th style="text-align: center;">Manage</th>
                  
            </thead>
            <tbody>
            <?php
foreach ($dataProductionType as $product) {
?>
<tr>
    <td style="min-width:150px;"><?php echo $product->production_type_name; ?></td>

    <td><button class="btn btn-danger btn-sm delete-product" data-id="<?php echo $product->production_type_id; ?>" data-toggle="modal"
            data-target="#deleteProduct"><i class="glyphicon glyphicon-remove-sign"></i> Delete</button></td>
</tr>
<?php
}
?>
            
            </tbody>
        </table>
    <button class="form-control btn btn-primary" data-toggle="modal" data-target="#add-productionType"><i
                    class="glyphicon glyphicon-plus-sign"></i> Add </button>
    
      </div>
    </div>
  </div>
  <div class="col-lg-4 col-xs-12">
    <div class="box box-info">
      <div class="box-header with-border">
        <i class="fa fa-briefcase"></i>
        <h3 class="box-title">Positions<small>Manage Data</small></h3>


        <div class="box-tools pull-right">
          <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
          </button>
          <!-- <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button> -->
        </div>
      </div>
      
      <!-- <div class="box-body">
        <canvas id="data-station" style="height:250px"></canvas>
      </div> -->
      <div class="box-body">
        <table id="position" class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>Positions</th>

                    <th style="text-align: center;">Manage</th>
                  
            </thead>
            <tbody>
            <?php
foreach ($dataPosition as $product) {
?>
<tr>
    <td style="min-width:150px;"><?php echo $product->position_name; ?></td>

    <td><button class="btn btn-danger btn-sm delete-position" data-id="<?php echo $product->p_id; ?>" data-toggle="modal"
            data-target="#deletePosition"><i class="glyphicon glyphicon-remove-sign"></i> Delete</button></td>
</tr>
<?php
}
?>
            
            </tbody>
        </table>
    <button class="form-control btn btn-primary" data-toggle="modal" data-target="#add-position"><i
                    class="glyphicon glyphicon-plus-sign"></i> Add </button>
    
      </div>
    </div>
  </div>
  <div class="col-lg-4 col-xs-12">
    <div class="box box-info">
      <div class="box-header with-border">
        <i class="fa fa-briefcase"></i>
        <h3 class="box-title">Stations<small>Manage Data</small></h3>


        <div class="box-tools pull-right">
          <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
          </button>
          <!-- <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button> -->
        </div>
      </div>
      
      <!-- <div class="box-body">
        <canvas id="data-station" style="height:250px"></canvas>
      </div> -->
      <div class="box-body">
        <table id="data-station" class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>Stations</th>

                    <th style="text-align: center;">Manage</th>
                  
            </thead>
            <tbody>
            <?php
foreach ($dataStation as $product) {
?>
<tr>
    <td style="min-width:150px;"><?php echo $product->station_name; ?></td>

    <td><button class="btn btn-danger btn-sm delete-product" data-id="<?php echo $product->s_id; ?>" data-toggle="modal"
            data-target="#deleteProduct"><i class="glyphicon glyphicon-remove-sign"></i> Delete</button></td>
</tr>
<?php
}
?>
            
            </tbody>
        </table>
    <button class="form-control btn btn-primary" data-toggle="modal" data-target="#add-station"><i
                    class="glyphicon glyphicon-plus-sign"></i> Add </button>
    
      </div>
    </div>
  </div>

 
</div>
<?php echo $modal_add_position; ?>
<?php echo $modal_add_station; ?>
<?php echo $modal_add_productiontype; ?>
<?php echo $modal_add_producttype; ?>
<?php echo $modal_add_machinetype; ?>
<div id="tempat-modal"></div>

