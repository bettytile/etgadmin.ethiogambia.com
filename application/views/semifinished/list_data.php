<?php
  foreach ($dataSemifinished as $pegawai) {
    ?>
    <tr>
      <td ><?php echo $pegawai->code; ?></td>
      <td ><?php echo $pegawai->p_name; ?></td>
      <td><?php echo $pegawai->p_weight; ?></td>
      <td><?php echo $pegawai->p_type; ?></td>
      
      <td class="text-center" style="min-width:145px;">
        <button class="btn btn-warning btn-sm update-dataPreform" data-id="<?php echo $pegawai->id; ?>"><i class="glyphicon glyphicon-repeat"></i> Update</button>
        <!--<button class="btn btn-danger btn-sm delete-preform" data-id="<?php echo $pegawai->id; ?>" data-toggle="modal" data-target="#deletePreform"><i class="glyphicon glyphicon-remove-sign"></i>  Delete</button>-->
      </td>
    </tr>
    <?php
  }
?>