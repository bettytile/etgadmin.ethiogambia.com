<div class="col-md-offset-1 col-md-10 col-md-offset-1 well">
    <div class="form-msg"></div>
    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
            aria-hidden="true">&times;</span></button>
    <h3 style="display:block; text-align:center;">Add New Product</h3>

    <form id="form-insert-product" method="POST">
        <div class="input-group form-group">
            <span class="input-group-addon" id="sizing-addon2">
                <i class="glyphicon glyphicon-user"></i>
            </span>
            <input type="text" class="form-control" placeholder="Product Code " name="p_code"
                aria-describedby="sizing-addon2">
        </div>
        <div class="input-group form-group">
            <span class="input-group-addon" id="sizing-addon2">
                <i class="glyphicon glyphicon-user"></i>
            </span>
            <input type="text" class="form-control" placeholder="Product Name " name="p_name"
                aria-describedby="sizing-addon2">
        </div>
        <div class="input-group form-group">
            <span class="input-group-addon" id="sizing-addon2">
                <i class="glyphicon glyphicon-lock"></i>
            </span>
            <input type="number" class="form-control" placeholder="Product Weight" name="p_weight"
                aria-describedby="sizing-addon2">
        </div>
        <div class="input-group form-group">
            <span class="input-group-addon" id="sizing-addon2">
                <i class="glyphicon glyphicon-lock"></i>
            </span>
            <input type="number" class="form-control" placeholder="Unit Price" name="unit_price"
                aria-describedby="sizing-addon2">
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
                <button type="submit" class="form-control btn btn-primary"> <i class="glyphicon glyphicon-ok"></i> Add
                    Product</button>
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