<div class="col-md-offset-1 col-md-10 col-md-offset-1 well">
  <div class="form-msg"></div>
  <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
  <h3 style="display:block; text-align:center;">Update Data Machine</h3>
      <form method="POST" id="form-update-machine">
        <input type="hidden" name="id" value="<?php echo $dataMachine->id; ?>">
        <div class="input-group form-group">
          <span class="input-group-addon" id="sizing-addon2">
            <i class="glyphicon glyphicon-user"></i>
          </span>
          <input type="text" class="form-control" placeholder="Machine Name" name="m_name" aria-describedby="sizing-addon2" value="<?php echo $dataMachine->m_name; ?>">
        </div>
        <div class="input-group form-group">
          <span class="input-group-addon" id="sizing-addon2">
            <i class="glyphicon glyphicon-phone-alt"></i>
          </span>
          <input type="text" class="form-control" placeholder="Machine Code" name="m_code" aria-describedby="sizing-addon2" value="<?php echo $dataMachine->m_code; ?>">
        </div>
        <div class="input-group form-group">
            <span class="input-group-addon" id="sizing-addon2">
                <b>Machine Type</b>
            </span>
            <select name="m_type" class="form-control select2" aria-describedby="sizing-addon2">
                <?php
                foreach ($dataMachineType as $type) {
                ?>
                <option value="<?php echo $type->m_id; ?>">
                    <?php echo $type->machine_type; ?>
                </option>
                <?php
                }
                ?>
            </select>

        </div>
        <div class="input-group form-group">
          <span class="input-group-addon" id="sizing-addon2">
            <i class="glyphicon glyphicon-phone-alt"></i>
          </span>
          <input type="text" class="form-control" placeholder="Machine Status" name="m_status" aria-describedby="sizing-addon2" value="<?php echo $dataMachine->m_status; ?>">
        </div>
        <!-- <div class="input-group form-group">
            <span class="input-group-addon" id="sizing-addon2">
                <b>Machine Status</b>
            </span>
            <select name="m_status" class="form-control select2" aria-describedby="sizing-addon2">
                <?php
                foreach ($dataMachine as $type) {
                ?>
                <option value="<?php echo $type->m_status; ?>">
                    <?php echo $type->machine_status; ?>
                </option>
                <?php
                }
                ?>
            </select>

        </div> -->
        <div class="form-group">
          <div class="col-md-12">
              <button type="submit" class="form-control btn btn-primary"> <i class="glyphicon glyphicon-ok"></i> Update Machine</button>
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