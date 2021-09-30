
<div class="col-md-offset-1 col-md-10 col-md-offset-1 well">
    <div class="form-msg"></div>
    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
            aria-hidden="true">&times;</span></button>
    <h3 style="display:block; text-align:center;">Update Product From Store</h3>

    <form id="form-update-stockproduct" method="POST">
    <input type="hidden" name="id" value="<?php echo $dataStock->id; ?>">
    <!-- <input type="text"  name="station" value="<?php echo $dataStock->id_station ; ?>"> -->
    <div class="input-group form-group">
            <span class="input-group-addon" id="sizing-addon2">
                <b>Station</b>
            </span>
             
      <select name="station" id="station" class="form-control select2" aria-describedby="sizing-addon2">
      <option value="<?php echo $dataStock->id_station; ?>">
            <?php echo $dataStock->station; ?>
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
      <input type="date" class="form-control" placeholder="Date" min="0" name="activity_date" value="<?php echo $dataStock->activity_date ; ?>" aria-describedby="sizing-addon2">
    </div>
    
    
    <div class="input-group form-group">
            <span class="input-group-addon" id="sizing-addon2">
                <i class="glyphicon glyphicon-lock"></i>
            </span>
            <input type="text" id="reference" onblur="addCharacter()" class="form-control" placeholder="Reference No" value="<?php echo $dataStock->reference_no ; ?>" name="reference_no"
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
        <div class="input-group form-group">
            <span class="input-group-addon" id="sizing-addon2">
                <i class="glyphicon glyphicon-lock"></i>
            </span>
            <input type="text" class="form-control" id="s_status" class="col-form-label" id="s_status" name="s_status" value="<?php echo $dataStock->s_status;?> "
                aria-describedby="sizing-addon2">
        </div>
	

    <span class="issued states">
    <div class="input-group form-group">
    
    <!--<span class="input-group-addon" id="sizing-addon2">-->
    <!--    <b>Product Code</b>-->
    <!--  </span>-->
        <span class="input-group-addon" id="sizing-addon2">

                <b>Product Code</b>
            </span>
            <select name="p_code_n_id"   class="form-control select2" aria-describedby="sizing-addon2">
                <?php
                foreach ($dataProduct as $type) {
                ?>
                <option value="<?php echo $type->product_code ." | ". $type->prod_id ." "; ?>">
                    <?php echo $type->product_code; ?>
                </option>
                <?php
                }
                ?>
            </select>
      <!--<input value="<?php echo $dataStock->code ."|". $dataStock->id_product .""; ?>" class="form-control has-error"   name="p_code_n_id" aria-describedby="sizing-addon2" readonly>-->
    </div>
        
    <div class="input-group form-group">
    
    <span class="input-group-addon" id="sizing-addon2">
        <b>Available Quantity</b>
      </span>
      
      <input value="<?php echo $dataStock->available_product; ?>" id="available_product" class="form-control has-error" name="available_product" aria-describedby="sizing-addon2" readonly>
    </div>
    
        <div class="input-group form-group">
            <span class="input-group-addon" id="sizing-addon2">
            Issued Qty
            </span>
            <input type="number" class="form-control" onkeyup="calculatedifference()" id="issued_qty" placeholder="Issued Quantity" name="issued_qty" value="<?php echo $dataStock->issued_qty; ?>"
                aria-describedby="sizing-addon2">
        </div>     
        <div class="input-group form-group">
            <span class="input-group-addon" id="sizing-addon2">
            Received Qty
            </span>
            <input type="number" class="form-control" onkeyup="calculatesum()" id="received_qty" placeholder="Received Quantity" name="received_qty" value="<?php echo $dataStock->received_qty; ?>"
                aria-describedby="sizing-addon2">
        </div> 
        <script>
        calculatedifference = function(){
            var issued_qty= document.getElementById('issued_qty').value;
            var available_qty = document.getElementById('available_product').value;

            document.getElementById('available_product').value = parseInt(available_qty) - parseInt(issued_qty) ;
                 
            
                      
        }
    </script>
       <script>
        calculatesum = function(){
            var received_qty= document.getElementById('received_qty').value;
            var available_qty = document.getElementById('available_product').value;
             
           
            document.getElementById('available_product').value = parseInt(available_qty) + parseInt(received_qty) ;
           
                      
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
<script>
$(document).ready(function(){
  $("submit").click(function(){
    location.reload(true);
  });
});
</script>

<script type="text/javascript">
$(function() {
    $(".select2").select2();

    $('input[type="checkbox"].minimal, input[type="radio"].minimal').iCheck({
        checkboxClass: 'icheckbox_flat-blue',
        radioClass: 'iradio_flat-blue'
    });
});
</script>