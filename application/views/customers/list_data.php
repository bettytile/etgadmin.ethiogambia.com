<?php
  foreach ($dataCustomers as $pegawai) {
    ?>
    <tr>
      <td ><?php echo $pegawai->customer; ?></td>
      <td><?php echo $pegawai->phone; ?></td>
      <td><?php echo $pegawai->tin_no; ?></td>
      
      <td class="text-center" style="min-width:145px;">
        <button class="btn btn-warning btn-sm update-dataCustomer" data-id="<?php echo $pegawai->id; ?>"><i class="glyphicon glyphicon-repeat"></i> Update</button>
        <!--<button class="btn btn-danger btn-sm delete-customer" data-id="<?php echo $pegawai->id; ?>" data-toggle="modal" data-target="#deleteCustomer"><i class="glyphicon glyphicon-remove-sign"></i>  Delete</button>-->
      </td>
    </tr>
    <?php
  }
?>