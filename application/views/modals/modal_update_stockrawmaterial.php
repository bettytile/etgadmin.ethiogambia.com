
<div class="col-md-offset-1 col-md-10 col-md-offset-1 well">
    <div class="form-msg"></div>
    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
            aria-hidden="true">&times;</span></button>
    <h3 style="display:block; text-align:center;">Update Raw Material From Store</h3>

    <form id="form-update-rawmaterial" method="POST">
    <input type="hidden" name="id" value="<?php echo $dataRawMaterial->id; ?>">
    <!-- <input type="text"  name="station" value="<?php echo $dataRawMaterial->id_station ; ?>"> -->
    <div class="input-group form-group">
            <span class="input-group-addon" id="sizing-addon2">
                <b>Station</b>
            </span>
             
      <select name="station" id="station" class="form-control select2" aria-describedby="sizing-addon2">
      <option value="<?php echo $dataRawMaterial->store_location; ?>">
            <?php echo $dataRawMaterial->station; ?>
          </option>
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
        <div class="input-group form-group">
      <span class="input-group-addon" id="sizing-addon2">
        <i class="glyphicon glyphicon-calendar"></i>
      </span>
      <input type="date" class="form-control" placeholder="Date" min="0" name="activity_date" value="<?php echo $dataRawMaterial->activity_date ; ?>" aria-describedby="sizing-addon2">
    </div>
    
    
    <div class="input-group form-group">
            <span class="input-group-addon" id="sizing-addon2">
                <i class="glyphicon glyphicon-lock"></i>
            </span>
            <input type="text" id="reference" onblur="addCharacter()" class="form-control" placeholder="Reference No" value="<?php echo $dataRawMaterial->reference_no ; ?>" name="reference_no"
                aria-describedby="sizing-addon2">
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
            else{
                document.getElementById('reference').value = "K- "+ ref;
            }
            }
            else{
                return refe;

            
            }
        }
    </script>
     
	<input type="hidden" id="issued" class="col-form-label" name="rstatus" value="<?php echo $dataRawMaterial->rstatus;?> ">
	

    <span class="issued states">
    <div class="input-group form-group">
    
    <span class="input-group-addon" id="sizing-addon2">
        <b>Product Code</b>
      </span>
      
      <input value="<?php echo $dataRawMaterial->code ."|". $dataRawMaterial->raw_material_type .""; ?>" class="form-control has-error"   name="id_product" aria-describedby="sizing-addon2" readonly>
    </div>
        
    <div class="input-group form-group">
    
    <span class="input-group-addon" id="sizing-addon2">
        <b>Available Quantity</b>
      </span>
      
      <input readonly="readonly" id="available_qty" value="<?php echo $dataRawMaterial->available_qty; ?>" class="form-control has-error" name="available_qty" aria-describedby="sizing-addon2" readonly>
    </div>
    
        <div class="input-group form-group">
            <span class="input-group-addon" id="sizing-addon2">
            Issued Qty
            </span>
            <input type="number" class="form-control" onkeyup="calculatedifference()" placeholder="Issued Quantity" id="issued_qty" name="issued_qty" value="<?php echo $dataRawMaterial->issued_qty; ?>"
                aria-describedby="sizing-addon2">
        </div>     
        <div class="input-group form-group">
            <span class="input-group-addon" id="sizing-addon2">
            Received Qty
            </span>
            <input type="number" class="form-control" onkeyup="calculatesum()" placeholder="Received Quantity" id="received_qty" name="received_qty" value="<?php echo $dataRawMaterial->received_qty; ?>"
                aria-describedby="sizing-addon2">
        </div> 
        <script>
        calculatedifference = function(){
            var issued_qty= document.getElementById('issued_qty').value;
            var available_qty = document.getElementById('available_qty').value;
             
           
            document.getElementById('available_qty').value = parseInt(available_qty) - parseInt(issued_qty) ;
           
                      
        }
    </script>
       <script>
        calculatesum = function(){
            var received_qty= document.getElementById('received_qty').value;
            var available_qty = document.getElementById('available_qty').value;
             
           
            document.getElementById('available_qty').value = parseInt(available_qty) + parseInt(received_qty) ;
           
                      
        }
    </script>
        <!-- <div class="input-group form-group">
            <span class="input-group-addon" id="sizing-addon2">
                <b>To Customer</b>
            </span>
            <select name="customer" class="form-control select2" aria-describedby="sizing-addon2">
            <option value="none">None</option>
                <?php
                foreach ($dataCustomer as $type) {
                ?>
                <option value="<?php echo $type->id; ?>">
                    <?php echo $type->customer; ?>
                </option>
                <?php
                }
                ?>
            </select>
            <span class="input-group-addon" id="sizing-addon2">
                <b>OR</b>
            </span>
       
            <span class="input-group-addon" id="sizing-addon2">
                <b>To Station</b>
            </span>
            <select name="tostation" class="form-control select2" aria-describedby="sizing-addon2">
            <option value="none">None</option>
                <?php
                foreach ($dataStation as $type) {
                ?>
                <option value="<?php echo $type->s_id; ?>">
                    <?php echo $type->station_name; ?>
                </option>
                <?php
                }
                ?>
            </select>

        </div>
        </span> -->
        <!-- <span class="received states">
        <div class="input-group form-group">
            <span class="input-group-addon" id="sizing-addon2">

                <b>Product Code</b>
            </span>
            <select name="id_product"   class="form-control select2" aria-describedby="sizing-addon2">
                <?php
                foreach ($dataProduct as $type) {
                ?>
                <option value="<?php echo $type->id; ?>">
                    <?php echo $type->code; ?>
                </option>
                <?php
                }
                ?>
            </select>

        </div>
   
        <div class="input-group form-group">
            <span class="input-group-addon" id="sizing-addon2">
            Received Qty
            </span>
            <input type="number" class="form-control"  placeholder="Received Quantity" name="received_qty"
                aria-describedby="sizing-addon2">
        </div>
        </span> -->
        <div class="form-group">
            <div class="col-md-12">
                <button type="submit" class="form-control btn btn-primary"> <i class="glyphicon glyphicon-ok"></i>Save Data</button>
            </div>
        </div>
    </form>
</div>


<script type="text/javascript">
$(function() {
    $(".select2").select2();

    $('input[type="checkbox"].minimal, input[type="radio"].minimal').iCheck({
        checkboxClass: 'icheckbox_flat-blue',
        radioClass: 'iradio_flat-blue'
    });
});
</script>