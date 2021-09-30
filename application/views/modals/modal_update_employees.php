<div class="col-md-offset-1 col-md-10 col-md-offset-1 well">
  <div class="form-msg"></div>
  <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
  <h3 style="display:block; text-align:center;">Update Employee</h3>

  <form method="POST" id="form-update-employee">
  <input type="hidden" name="id" value="<?php echo $dataEmployees->id; ?>">
    <div class="input-group form-group">
    
      <span class="input-group-addon" id="sizing-addon2">
        <i class="glyphicon glyphicon-user"></i>
      </span>
      <input type="text" class="form-control" placeholder="Name" name="e_name" aria-describedby="sizing-addon2" value="<?php echo $dataEmployees->employee; ?>">
    </div>
    <div class="input-group form-group">
      <span class="input-group-addon" id="sizing-addon2">
        <i class="glyphicon glyphicon-lock"></i>
      </span>
      <input type="text" class="form-control" placeholder="Employee Code" name="code" aria-describedby="sizing-addon2" value="<?php echo $dataEmployees->code; ?>">
    </div>
    
    <div class="input-group form-group">
      <span class="input-group-addon" id="sizing-addon2">
        <i class="glyphicon glyphicon-phone-alt"></i>
      </span>
      <input type="text" class="form-control" placeholder="Phone Number" name="phone" aria-describedby="sizing-addon2" value="<?php echo $dataEmployees->phone; ?>">
    </div>
    <div class="input-group form-group">
      <span class="input-group-addon" id="sizing-addon2">
        <i class="glyphicon glyphicon-barcode"></i>
      </span>
      <input type="text" class="form-control" placeholder="Tin Number" name="tin" aria-describedby="sizing-addon2" value="<?php echo $dataEmployees->tin; ?>">
    </div>
    <div class="input-group form-group">
    <span class="input-group-addon" id="sizing-addon2">
      <b>Gender</b>
      </span>
      <span class="input-group-addon">
          <input type="radio" name="gender" value="M" id="male" class="minimal" <?php if($dataEmployees->gender == 'M'){ echo "checked='checked'";} ?>>
      <label for="male">Male</label>
        </span>
        <span class="input-group-addon">
          <input type="radio" name="gender" value="F" id="female" class="minimal" <?php if($dataEmployees->gender == 'F'){ echo "checked='checked'";} ?>> 
      <label for="female">Female</label>
        </span>
      
    </div>
    <div class="input-group form-group">
    <span class="input-group-addon" id="sizing-addon2">
        <b>Station</b>
      </span>
      <select name="station" class="form-control select2" aria-describedby="sizing-addon2">
        <?php
        foreach ($dataStation as $station) {
          ?>
          <option value="<?php echo $station->s_id; ?>" <?php if($station->s_id == $dataEmployees->id_station){ echo "selected='selected'";} ?>>
            <?php echo $station->station_name; ?>
          </option>
          <?php
        }
        ?>
      </select>
      <span class="input-group-addon" id="sizing-addon2">
        <b>Position</b>
      </span>
      <select name="position" class="form-control select2" aria-describedby="sizing-addon2">
        <?php
        foreach ($dataPosistion as $position) {
          ?>
          <option value="<?php echo $position->p_id; ?>" <?php if($position->p_id == $dataEmployees->id_position){ echo "selected='selected'";} ?>>
            <?php echo $position->position_name; ?>
          </option>
          <?php
        }
        ?>
      </select>
    </div>
    <div class="form-group">
      <div class="col-md-12">
          <button type="submit" class="form-control btn btn-primary"> <i class="glyphicon glyphicon-ok"></i> Save </button>
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