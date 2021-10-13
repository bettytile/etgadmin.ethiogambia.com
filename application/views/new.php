  
<div class="col-md-offset-1 col-md-10 col-md-offset-1 well">
  <div class="form-msg"></div>
  <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
  <h3 style="display:block; text-align:center;">Production Entry</h3>

  <form id="form-insert-production" method="POST">
  <input type="hidden" name="employee" value="<?php echo $userdata->employee_name; ?>">
  <input type="hidden" id="station" name="id_station" value="<?php echo $userdata->id_station; ?>">
  
    
  <div class="input-group form-group">
      <span class="input-group-addon" id="sizing-addon2">
        <!-- <i class="glyphicon glyphicon-glyphicon-th"></i> -->
        <b>Reference No</b>
      </span>
      <input type="text" id="reference" onblur="addCharacter()" class="form-control" placeholder="Reference No." min="0" name="reference_no" aria-describedby="sizing-addon2">
      
    </div>
    <script>
        addCharacter = function(){
            
            var refe= document.getElementById('reference').value.charAt(0);
            var ref= document.getElementById('reference').value;
            var station = document.getElementById('station').value;
            if(refe <='9' && refe>='0'){
                if(station == '1'){
                document.getElementById('reference').value = "A- "+ ref;
            }
            else if(station == '2'){
                document.getElementById('reference').value = "D- "+ ref;
            }
            else if(station == '3'){
                document.getElementById('reference').value = "K- "+ ref;
            }
            }
            else{
                return refe;

            
            }
        }
    </script>
    <div id="status"></div> 

    <!--<div class="input-group form-group">-->
    <!--<span class="input-group-addon" id="sizing-addon2">-->
    <!--  <b>Shift</b>-->
    <!--  </span>-->
    <!--  <span class="input-group-addon">-->
    <!--      <input type="radio" name="shift" value="day" id="day" class="minimal">-->
    <!--  <label for="day">Day</label>-->
    <!--    </span>-->
    <!--    <span class="input-group-addon">-->
    <!--      <input type="radio" name="shift" value="night" id="night" class="minimal"> -->
    <!--  <label for="night">Night</label>-->
    <!--    </span>-->
      
    <!--</div>-->
    <div class="input-group form-group">
      <span class="input-group-addon" id="sizing-addon2">
        <i class="glyphicon glyphicon-calendar"></i>
      </span>
      <input type="date" class="form-control" placeholder="Date" min="0" name="activity_date" aria-describedby="sizing-addon2">
    </div>
    <div class="input-group form-group">

    <span class="input-group-addon" id="sizing-addon2">
        <b>Machine ID</b>
      </span>
      <select name="id_machine" class="form-control select2" aria-describedby="sizing-addon2">
        <?php
        foreach ($dataMachine as $machine) {
          ?>
          <option value="<?php echo $machine->mach_id; ?>">
            <?php echo $machine->machine_code ." (". $machine->machine_name .")" ; ?>
          </option>
          <?php
        }
        ?>
      </select>
      
      <span class="input-group-addon" id="sizing-addon2">
        <b>Product Code</b>
      </span>
      <select name="id_product" id="id_product" class="form-control select2" aria-describedby="sizing-addon2">
      <?php
        foreach ($dataProduct as $product) {
          ?>
         
          <option value="<?php echo $product->product_code ." | ". $product->prod_id ." " ; ?>">
            <?php echo $product->product_code ; ?>
            <!-- <input type="hidden" name="weight" id="weight" value="<?php echo $product->product_weight; ?>"> -->
          </option>
          <?php
        }
        ?>
      </select>
      </div>
      <script>
$(document).ready(function(){
    $('input[type="radio"]').click(function(){
        var inputValue = $(this).attr("value");
        var targetBox = $("." + inputValue);
        $(".box").not(targetBox).hide();
        $(targetBox).show();
        
        
    });
});
</script>
      <h4 style="display:block; font_style:bold; text-align:center;">Input Materials</h4>
      <div class="input-group form-group">
        <span class="input-group-addon" id="sizing-addon2">
	<label><input type="radio" id="rawm_type" class="col-form-label" name="typeRadio" value="rawmtype">Input/Raw Material</label>
	</span>
    <span class="input-group-addon" id="sizing-addon2">
    <label><input type="radio" id="preform" class="col-form-label" name="typeRadio" value="preform">Preform</label>

    </span>
    
    </div>
    <span class="rawmtype box">
      <div class="input-group form-group">
      <span class="input-group-addon" id="sizing-addon2">
        <b>Raw Material Id1</b>
      </span>
      
      <select name="rawmaterial_id1" id="raw_material" class="form-control select2" aria-describedby="sizing-addon2">
        <?php
        foreach ($dataRawmaterial as $product) {
          ?>
         
          <option value="<?php echo $product->prod_id; ?>">
            <?php echo $product->product_code; ?>
            <!-- <input type="hidden" name="weight" id="weight" value="<?php echo $product->product_weight; ?>"> -->
          </option>
          <?php
        }
        ?>
      </select>
     
      
   
   
      
        <span class="input-group-addon" id="sizing-addon2">
        <b>Raw Material Qty2</b>
      </span>
      
      <input type="number" class="form-control"  id="rawmaterial_qty2"  placeholder="Used Qty2." min="0" name="rawmaterial_qty2" aria-describedby="sizing-addon2">
    </div>
    <div class="input-group form-group">
      <span class="input-group-addon" id="sizing-addon2">
        <b>Raw Material Id1</b>
      </span>
      
      <select name="rawmaterial_id2" id="raw_material" class="form-control select2" aria-describedby="sizing-addon2">
        <?php
        foreach ($dataRawmaterial as $product) {
          ?>
         
          <option value="<?php echo $product->prod_id; ?>">
            <?php echo $product->product_code; ?>
            <!-- <input type="hidden" name="weight" id="weight" value="<?php echo $product->product_weight; ?>"> -->
          </option>
          <?php
        }
        ?>
      </select>
     
      
   
    <span class="input-group-addon" id="sizing-addon2">
        <b>Raw Material Id2</b>
      </span>
      
      <input type="number" class="form-control"  id="rawmaterial_qty2"  placeholder="Used Qty2." min="0" name="rawmaterial_qty2" aria-describedby="sizing-addon2">
    </div>
    
     
      
    <div class="input-group form-group has-succes has-feedback">
      <span class="input-group-addon" id="sizing-addon2">
      Quantity Produced(pcs)
      </span>
      <input type="number" class="form-control" onkeyup="calculateweight()" id="qty_produced"  placeholder="Produced Qty." min="0" name="qty_produced" aria-describedby="sizing-addon2">
    </div>
    <div class="input-group form-group">
      <span class="input-group-addon" id="sizing-addon2">
      Estimated Used Weight(kG)
      </span>
      <input type="text" class="form-control has-error" id="used_weight" placeholder="Used Weight(KG)" min="0" name="used_weight" aria-describedby="sizing-addon2" readonly>
    </div>
    <script>
        calculateweight = function(){
            
            var pweight= document.getElementById('qty_produced').value;
            var p_code_n_weight= document.getElementById('id_product').value;
            var resultexp =p_code_n_weight.split(/(\d+)/);
            var uweight = resultexp[1];
            // document.getElementById('damaged_weight').value = parseInt(dweight)*parseInt(uweight)/1000;
            document.getElementById('used_weight').value = (parseInt(pweight)*parseInt(uweight))/1000;
        } 
       
    </script>
    
    <div class="input-group form-group">
      <span class="input-group-addon" id="sizing-addon2">
      Quantity Damaged(pcs)
      </span>
      <input type="number" class="form-control has-error" onkeyup="calculated()" id="qty_damaged" placeholder="Damaged Qty." min="0" name="qty_damaged" aria-describedby="sizing-addon2">
    </div>
    <div class="input-group form-group">
      <span class="input-group-addon" id="sizing-addon2">
      Estimated Damaged Weight(kG)
      </span>
      <input type="number" class="form-control has-error" id="damaged_weight" placeholder="Damaged Weight(KG)" min="0" name="damaged_weight" aria-describedby="sizing-addon2" readonly>
    </div>
    <script>
        calculated = function(){
            
            var dweight= document.getElementById('qty_damaged').value;
            var p_code_n_weight= document.getElementById('id_product').value;
            var resultexp =p_code_n_weight.split(/(\d+)/);
            var uweight = resultexp[1];
            // document.getElementById('damaged_weight').value = parseInt(dweight)*parseInt(uweight)/1000;
            document.getElementById('damaged_weight').value = (parseInt(dweight)*parseInt(uweight))/1000;
        }
    </script>
    
    <!-- <div class="input-group form-group">
    
      <span class="input-group-addon" id="sizing-addon2">
        <b>Raw Material</b>
      </span>
      <select name="raw_material" class="form-control select2" aria-describedby="sizing-addon2">
        <?php
        foreach ($dataProduct as $product) {
          ?>
          <option value="<?php echo $product->prod_id; ?>">
            <?php echo $product->product_code; ?>
          </option>
          <?php
        }
        ?>
      </select>
    </div> -->
    <div class="input-group form-group has-succes has-feedback">
      <span class="input-group-addon" id="sizing-addon2">
      Received Raw Materail(KG)
      </span>
      <input type="number" class="form-control" placeholder="Raw Material Weight"  min="0" name="received_weight" aria-describedby="sizing-addon2">
    </div>
    <div class="input-group form-group has-succes has-feedback">
      <span class="input-group-addon" id="sizing-addon2">
      Left Raw Materail(KG)
      </span>
      <input type="number" class="form-control" placeholder="Left Weight" min="0" name="left_weight" aria-describedby="sizing-addon2">
    </div>
    
    </span>
    <span class="preform box">
    <div class="input-group form-group">
      <span class="input-group-addon" id="sizing-addon2">
        <b>Preform Code</b>
      </span>
      
      <select name="id_preform" id="id_preform" class="form-control select2" aria-describedby="sizing-addon2">
        <?php
        foreach ($dataPreform as $product) {
          ?>
         
          <option value="<?php echo $product->prod_id; ?>">
            <?php echo $product->product_code; ?>
            <!-- <input type="hidden" name="weight" id="weight" value="<?php echo $product->product_weight; ?>"> -->
          </option>
          <?php
        }
        ?>
      </select>
      <span class="input-group-addon" id="sizing-addon2">
        <b>Production Type</b>
      </span>
      <select name="bproduction_type" class="form-control select2" aria-describedby="sizing-addon2">
        <?php
        foreach ($dataProductionBlow as $type) {
          ?>
          <option value="<?php echo $type->production_type_id; ?>">
            <?php echo $type->production_type_name; ?>
          </option>
          <?php
        }
        ?>
      </select>
    
    </div>
    <div class="input-group form-group has-succes has-feedback">
    
    <span class="input-group-addon" id="sizing-addon2">
        <b>Preform Used(pcs)</b>
      </span>
     
      <input type="number" class="form-control" placeholder="Preform Used"  min="0" name="breceived_weight" id="recieved_qty" aria-describedby="sizing-addon2">
    </div><div class="input-group form-group">
    
    
    </div>
    
  
      
    
    <div class="input-group form-group has-succes has-feedback">
   
    <span class="input-group-addon" id="sizing-addon2">
        <b>Produced Quantity(pcs)</b>
      </span>
     
      <input type="number" class="form-control" id="bqty_produced" placeholder="Produced Qty." min="0" name="bqty_produced" aria-describedby="sizing-addon2">
    </div>   
    <div class="input-group form-group">
    <span class="input-group-addon" id="sizing-addon2">
    
      </span>
    <span class="input-group-addon" id="sizing-addon2">
        <b>Damaged Quantity(pcs)</b>
      </span>
     
      <input type="number" class="form-control has-error"  id="bqty_damaged" placeholder="Damaged Qty." min="0" name="bqty_damaged" aria-describedby="sizing-addon2">
    </div>
    
    
    <div class="input-group form-group has-succes has-feedback">
    
    <span class="input-group-addon" id="sizing-addon2">
        <b>Returned Quantity(pcs)</b>
      </span>
      
      <input type="number" class="form-control" placeholder="Return Qty" min="0" onkeyup="calculatedifference()" name="bleft_weight" id="return_qty" aria-describedby="sizing-addon2">
    </div>
    <div class="input-group form-group">
    
    <span class="input-group-addon" id="sizing-addon2">
        <b>Difference</b>
      </span>
      
      <input type="number" class="form-control has-error" id="differences" placeholder="Difference" name="differences" aria-describedby="sizing-addon2" readonly>
    </div>
    <script>
        calculatedifference = function(){
            var produced_qty= document.getElementById('bqty_produced').value;
            var damaged_qty= document.getElementById('bqty_damaged').value;
            var received_pieces= document.getElementById('recieved_qty').value;
            var left_pieces= document.getElementById('return_qty').value;
                      
            document.getElementById('differences').value = parseInt(received_pieces) - (parseInt(produced_qty) + parseInt(damaged_qty) + parseInt(left_pieces));
        }
    </script>
    </span>
    
    <div class="form-group">
      <div class="col-md-12">
          <button type="submit" class="form-control btn btn-primary"> <i class="glyphicon glyphicon-ok"></i> Add Entry</button>
      </div>
    </div>
  </form>
  
</div>
<script src="https://code.jquery.com/jquery-1.12.4.min.js"></script>


<script type="text/javascript">
$(function () {
    $(".select2").select2();

    $('input[type="checkbox"].minimal, input[type="radio"].minimal').iCheck({
      checkboxClass: 'icheckbox_flat-blue',
      radioClass: 'iradio_flat-blue'
    });
});
</script>