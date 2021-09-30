<?php
  foreach ($dataMachine as $pegawai) {
    ?>
    <tr>
      <td style="min-width:230px;"><?php echo $pegawai->m_code; ?></td>
      <td><?php echo $pegawai->m_name; ?></td>
      <td><?php echo $pegawai->m_type; ?></td>
      <td> <?php 
          if( $pegawai->m_status == 1){?>
            Active
          <?php }else{?>
            Inactive
          <?php }?>
      </td>
      <td class="text-center" style="min-width:230px;">
        <button class="btn btn-warning update-dataMachine" data-id="<?php echo $pegawai->id; ?>"><i class="glyphicon glyphicon-repeat"></i> Update</button>
        <!--<button class="btn btn-danger delete-machine" data-id="<?php echo $pegawai->id; ?>" data-toggle="modal" data-target="#deleteMachine"><i class="glyphicon glyphicon-remove-sign"></i> Delete</button>-->
      </td>
    </tr>
    <?php
  }
?>