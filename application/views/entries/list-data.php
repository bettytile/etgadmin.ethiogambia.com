<?php
  foreach ($dataEntries as $pegawai) {
    ?>
    <tr>
      <td style="min-width:230px;"><?php echo $pegawai->employee; ?></td>
      <td><?php echo $pegawai->phone; ?></td>
      <td><?php echo $pegawai->code; ?></td>
      <td><?php echo $pegawai->station; ?></td>
      <td><?php echo $pegawai->position; ?></td>
      <td class="text-center" style="min-width:230px;">
        <button class="btn btn-warning update-dataEntry" data-id="<?php echo $pegawai->id; ?>"><i class="glyphicon glyphicon-repeat"></i> Update</button>
        <!-- <button class="btn btn-danger delete-entriee" data-id="<?php echo $pegawai->id; ?>" data-toggle="modal" data-target="#deleteEmployee"><i class="glyphicon glyphicon-remove-sign"></i> Delete</button> -->
      </td>
    </tr>
    <?php
  }
?>