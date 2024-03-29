<div class="col-md-offset-1 col-md-10 col-md-offset-1 well">
  <div class="form-msg"></div>
  <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
  <h3 style="display:block; text-align:center;">Update Data Product</h3>
      <form method="POST" id="form-update-preform">
        <input type="hidden" name="id" value="<?php echo $dataSemifinished->id; ?>">
        <div class="input-group form-group">
          <span class="input-group-addon" id="sizing-addon2">
            <i class="glyphicon glyphicon-user"></i>
          </span>
          <input type="text" class="form-control" placeholder="Product Code" name="code" aria-describedby="sizing-addon2" value="<?php echo $dataSemifinished->code; ?>">
        </div>
        <div class="input-group form-group">
            <span class="input-group-addon" id="sizing-addon2">
                <i class="glyphicon glyphicon-user"></i>
            </span>
            <input type="text" class="form-control" placeholder="Product Name" value="<?php echo $dataSemifinished->p_name; ?>" name="p_name"
                aria-describedby="sizing-addon2">
        </div>
        <div class="input-group form-group">
          <span class="input-group-addon" id="sizing-addon2">
            <i class="glyphicon glyphicon-phone-alt"></i>
          </span>
          <input type="number" step="0.01" class="form-control" placeholder="Product Weight" name="p_weight" aria-describedby="sizing-addon2" value="<?php echo $dataSemifinished->p_weight; ?>">
        </div>
        <div class="input-group form-group">
            <span class="input-group-addon" id="sizing-addon2">
                <b>Product Type</b>
            </span>
            <select name="p_type" class="form-control select2" aria-describedby="sizing-addon2">
                <?php
                foreach ($dataProductType as $type) {
                ?>
                <option value="<?php echo $type->p_id; ?>">
                    <?php echo $type->product_name; ?>
                </option>
                <?php
                }
                ?>
            </select>

        </div>
        
        <div class="form-group">
          <div class="col-md-12">
              <button type="submit" class="form-control btn btn-primary"> <i class="glyphicon glyphicon-ok"></i> Update Product</button>
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