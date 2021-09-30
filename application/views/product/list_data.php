<?php
  foreach ($dataProduct as $pegawai) {
    ?>
    <tr>
      <td ><?php echo $pegawai->code; ?></td>
      <td ><?php echo $pegawai->p_name; ?></td>
      <td><?php echo $pegawai->p_weight; ?></td>
      <td><?php echo $pegawai->unit_price; ?></td>
      <td><?php echo $pegawai->p_type; ?></td>
      
      <td class="text-center" style="min-width:145px;">
        <button class="btn btn-warning btn-sm update-dataProduct" data-id="<?php echo $pegawai->id; ?>"><i class="glyphicon glyphicon-repeat"></i> Update</button>
        <!--<button class="btn btn-danger btn-sm delete-product" data-id="<?php echo $pegawai->id; ?>" data-toggle="modal" data-target="#deleteProduct"><i class="glyphicon glyphicon-remove-sign"></i>  Delete</button>-->
      </td>
    </tr>
    <?php
  }
?>