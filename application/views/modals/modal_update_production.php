<div class="col-md-offset-1 col-md-10 col-md-offset-1 well">
  <div class="form-msg"></div>
  <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
  <h3 style="display:block; text-align:center;">Confirm Production</h3>

  <form id="form-update-production" method="POST">
 <input type="hidden" name="id" value="<?php echo $dataConfirmation->id; ?>">
 <input type="hidden" name="id_employee" value="<?php echo $dataConfirmation->id_employee; ?>">

  <div class="input-group form-group">
      <span class="input-group-addon" id="sizing-addon2">
        <!-- <i class="glyphicon glyphicon-glyphicon-th"></i> -->
        <b>Reference No</b>
      </span>
      <input type="text" class="form-control" placeholder="Reference No." value="<?php echo $dataConfirmation->reference_no; ?>" min="0" name="reference_no" aria-describedby="sizing-addon2">
    </div>
    
    <div class="input-group form-group">
            <span class="input-group-addon" id="sizing-addon2">
                <b>production Type</b>
            </span>
            <select name="production_type" id="production_type" class="form-control select2" aria-describedby="sizing-addon2">
            
           
        <?php
        
        ?>
       <option value="<?php echo $dataConfirmation->id_production_type; ?>">
          <?php echo $dataConfirmation->production_type_name; ?>
          </option>
        <?php
     
      ?>
       <option value="1">Blow</option>
        <option value="2">Compression</option>
        <option value="3">Injection</option>
      </select>
        </div>
       
    <div class="input-group form-group has-succes has-feedback">
    
      <span class="input-group-addon" id="sizing-addon2">
        <b>Product Code</b>
      </span>
      <input name="id_product" type="text"  value="<?php echo $dataConfirmation->product_code."|". $dataConfirmation->id_product ."" ; ?>" class="form-control" aria-describedby="sizing-addon2">
      
      </input>
      </div>
      <div class="input-group form-group has-succes has-feedback">
      <span class="input-group-addon" id="sizing-addon2">
        <b>Preform Code</b>
      </span>
      <select name="id_preform" class="form-control select2" aria-describedby="sizing-addon2">
             <option value="<?php echo  $dataConfirmation->preform_code."|". $dataConfirmation->id_preform .""; ?>">
             <?php echo  $dataConfirmation->preform_code."|". $dataConfirmation->id_preform .""; ?>
             </option>   
                <?php
                foreach ($dataPreform as $type) {
                ?>
                <option value="<?php echo $type->code."|". $type->id .""; ?>">
                    <?php echo $type->code."|". $type->id .""; ?>
                </option>
                <?php
                }
                ?>
            </select>
    </div>
   
    <div class="input-group form-group has-succes has-feedback">
    <span class="input-group-addon" id="sizing-addon2">
        <b>Machine ID</b>
      </span>
       
      <select name="id_machine" class="form-control select2" aria-describedby="sizing-addon2">
             <option value="<?php echo $dataConfirmation->machine_code ."|". $dataConfirmation->id_machine .""; ?>">
             <?php echo $dataConfirmation->machine_code ."|". $dataConfirmation->id_machine .""; ?>
             </option>   
                <?php
                foreach ($dataMachine as $type) {
                ?>
                <option value="<?php echo $type->machine_code."|". $type->mach_id .""; ?>">
                    <?php echo $type->machine_code."|". $type->mach_id .""; ?>
                </option>
                <?php
                }
                ?>
                </select>
      </div>
      <div class="input-group form-group">
            <span class="input-group-addon" id="sizing-addon2">
                <b>Station</b>
            </span>
             
      <select name="id_station" class="form-control select2" aria-describedby="sizing-addon2">
        <option value="<?php echo $dataConfirmation->id_station; ?>">
        <?php echo $dataConfirmation->station_name; ?></option>
        <?php
        foreach ($dataStation as $station) {
          ?>
          <option value="<?php echo $station->s_id; ?>">
            <?php echo $station->station_name; ?>
          </option>
          <?php
        }
        ?>
      </select>

        </div>
    <div class="input-group form-group has-succes has-feedback">
      <span class="input-group-addon" id="sizing-addon2">
      <b>Produced Qty</b>
      </span>
      <input type="number" class="form-control" value="<?php echo $dataConfirmation->qty_produced; ?>" id="qty_produced" placeholder="Produced Qty." min="0" name="qty_produced" aria-describedby="sizing-addon2">
    </div>
    <div class="input-group form-group">
      <span class="input-group-addon" id="sizing-addon2">
      <b>Damaged Qty</b>
      </span>
      <input type="number" class="form-control has-error" value="<?php echo $dataConfirmation->qty_damaged; ?>" id="qty_damaged" placeholder="Damaged Qty." min="0" name="qty_damaged" aria-describedby="sizing-addon2">
    </div>
    
    <div class="input-group form-group">
    
      <span class="input-group-addon" id="sizing-addon2">
        <b>Raw Material</b>
      </span>
      
      <input name="raw_material" type="text" value="<?php echo $dataConfirmation->rawmaterial_code ."|". $dataConfirmation->id_raw_material .""; ?>" class="form-control" aria-describedby="sizing-addon2">
        
      <!--</input>-->
    </div>
    <div class="input-group form-group has-succes has-feedback">
    <span class="input-group-addon" id="sizing-addon2">
    <b>Reeceived Weight/pcs</b>
      
      </span>
      <input type="number" class="form-control" value="<?php echo $dataConfirmation->received_weight; ?>" placeholder="Raw Material Weight"  min="0" name="received_weight" aria-describedby="sizing-addon2">
    </div>
    <div class="input-group form-group has-succes has-feedback">
    <span class="input-group-addon" id="sizing-addon2">
   <b>Return Weight/pcs</b>
      
      </span>
      <input type="number" class="form-control" value="<?php echo $dataConfirmation->left_weight; ?>" placeholder="Left Weight" min="0" name="left_weight" aria-describedby="sizing-addon2">
    </div>
    
    <div class="input-group form-group">
      <span class="input-group-addon" id="sizing-addon2">
      <b>Date</b>
      </span>
      <input type="date" class="form-control" value="<?php echo $dataConfirmation->activity_date; ?>" placeholder="Date" min="0" name="activity_date" aria-describedby="sizing-addon2">
    </div>
    <div class="input-group form-group">
    <span class="input-group-addon" id="sizing-addon2">
      <b>Shift</b>
      </span>
      <select name="shift" class="form-control select2" aria-describedby="sizing-addon2">
        <?php
        
          ?>
          <option value="<?php echo $dataConfirmation->shift; ?>">
            <?php echo $dataConfirmation->shift; ?>
          </option>
          <?php
       
        ?>
        <option value="day">Day</option>
        <option value="night">Night</option>
      </select>
      
    </div>
    
    <div class="form-group">
      <div class="col-md-12">
          <button type="submit"  class="form-control btn btn-primary"> <i class="glyphicon glyphicon-ok"></i> Confirm Production</button>
      </div>
    </div>
  </form>
  
</div>


<script type="text/javascript">
$(function () {
    $(".select2").select2();

    $('input[type="checkbox"].minimal, input[type="radio"].minimal').iCheck({
      checkboxClass: 'icheckbox_flat-blue',
      radioClass: 'iradio_flat-blue'
    });
});
</script>