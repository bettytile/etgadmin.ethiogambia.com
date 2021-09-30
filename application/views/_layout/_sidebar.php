<aside class="main-sidebar">
  <!-- sidebar: style can be found in sidebar.less -->
  <section class="sidebar">

    <!-- Sidebar user panel (optional) -->
    <div class="user-panel">
      <div class="pull-left image">
        <img src="<?php echo base_url(); ?>assets/img/profil1.jpg" class="img-circle" alt="User Image">
      </div>
      <div class="pull-left info">
        <p><?php echo $userdata->nama; ?></p>
        
        <!-- Status -->
        <a href="<?php echo base_url('Home'); ?>"><i class="fa fa-circle text-success"></i> Online</a>
      </div>
    </div>

    <!-- Sidebar Menu -->
    <ul class="sidebar-menu">
      <li class="header">LIST MENU</li>
      <!-- Optionally, you can add icons to the links -->

      <li <?php if ($page == 'home') {echo 'class="active"';} ?>>
        <a href="<?php echo base_url('Home'); ?>">
          <i class="fa fa-home"></i>
          <span>Home</span>
        </a>
      </li>
      
      <!-- <li <?php if ($page == 'machine') {echo 'class="active"';} ?>>
        <a href="<?php echo base_url('#'); ?>">
          <i class="fa fa-briefcase"></i>
          <span>Machines</span>
        </a>
      </li> -->
      <li class="treeview">
      <a href="#" class=" hvr-bounce-to-right"><i class="fa fa-angle-right pull-left"></i> <span class="nav-label">Confirmation</span><span class="fa arrow"></span></a>
       <ul class="treeview-menu">
      <li <?php if ($page == 'confirmation') {echo 'class="active"';} ?>>
        <a href="<?php echo base_url('Confirmation'); ?>">
          <i class="fa fa-location-arrow"></i>
          <span>Production Confirmation</span>
        </a>
      </li>
     
      <li <?php if ($page == 'stockconfirmation') {echo 'class="active"';} ?>>
        <a href="<?php echo base_url('StockConfirmation'); ?>">
          <i class="fa fa-location-arrow"></i>
          <span>Stock Confirmation</span>
        </a>
      </li>
       <li <?php if ($page == 'rawmaterialconfirmation') {echo 'class="active"';} ?>>
        <a href="<?php echo base_url('RawmaterialConfirmation'); ?>">
          <i class="fa fa-location-arrow"></i>
          <span>RawMaterial Confirmation</span>
          
        </a>
      </li>
      <li <?php if ($page == 'semifinishedconfirmation') {echo 'class="active"';} ?>>
        <a href="<?php echo base_url('SemiFinishedConfirmation'); ?>">
          <i class="fa fa-location-arrow"></i>
          <span>SemiFinished Confirmation</span>
        </a>
      </li>
      </ul>
      </li>
      <li class="treeview">
      <a href="#" class=" hvr-bounce-to-right"><i class="fa fa-angle-right pull-left"></i> <span class="nav-label">Edits</span><span class="fa arrow"></span></a>
       <ul class="treeview-menu">
      <li <?php if ($page == 'editproduction') {echo 'class="active"';} ?>>
        <a href="<?php echo base_url('EditProduction'); ?>">
          <i class="fa fa-users"></i>
          <span>Edit Production</span>
        </a>
      </li>
      <li <?php if ($page == 'editstock') {echo 'class="active"';} ?>>
        <a href="<?php echo base_url('EditStock'); ?>">
          <i class="fa fa-users"></i>
          <span>Edit Stock</span>
        </a>
      </li>
      <li <?php if ($page == 'editrawmaterial') {echo 'class="active"';} ?>>
        <a href="<?php echo base_url('EditRawMaterial'); ?>">
          <i class="fa fa-users"></i>
          <span>Edit Raw Material</span>
        </a>
      </li>
      <li <?php if ($page == 'editsemifinished') {echo 'class="active"';} ?>>
        <a href="<?php echo base_url('EditSemifinished'); ?>">
          <i class="fa fa-users"></i>
          <span>Edit Semi Finished</span>
        </a>
      </li>
      </ul>
      </li>
      <li class="treeview">
      <a href="#" class=" hvr-bounce-to-right"><i class="fa fa-angle-right pull-left"></i> <span class="nav-label">Items</span><span class="fa arrow"></span></a>
       <ul class="treeview-menu">
      <li <?php if ($page == 'product') {echo 'class="active"';} ?>>
        <a href="<?php echo base_url('Product'); ?>">
          <i class="fa fa-location-arrow"></i>
          <span>Products</span>
        </a>
        </li>
        <li <?php if ($page == 'rawmaterial') {echo 'class="active"';} ?>>
        <a href="<?php echo base_url('RawMaterial'); ?>">
          <i class="fa fa-location-arrow"></i>
          <span>Raw Material</span>
        </a>
        </li>
        <li <?php if ($page == 'semifinished') {echo 'class="active"';} ?>>
        <a href="<?php echo base_url('SemiFinished'); ?>">
          <i class="fa fa-location-arrow"></i>
          <span>Semi Finished</span>
        </a>
        </li>
         <li <?php if ($page == 'employees') {echo 'class="active"';} ?>>
        <a href="<?php echo base_url('employees'); ?>">
          <i class="fa fa-users"></i>
          <span>Employees</span>
        </a>
      </>
      <li <?php if ($page == 'customers') {echo 'class="active"';} ?>>
        <a href="<?php echo base_url('Customers'); ?>">
          <i class="fa fa-users"></i>
          <span>Customers</span>
        </a>
      </li>
      <li <?php if ($page == 'machine') {echo 'class="active"';} ?>>
        <a href="<?php echo base_url('Machine'); ?>">
          <i class="fa fa-users"></i>
          <span>Machine</span>
        </a>
      </li>
        </ul>
      </li>
        <li class="treeview">
      <a href="#" class=" hvr-bounce-to-right"><i class="fa fa-angle-right pull-left"></i> <span class="nav-label">Summary</span><span class="fa arrow"></span></a>
       <ul class="treeview-menu">
      </li>
      <li <?php if ($page == 'deliverysummary') {echo 'class="active"';} ?>>
        <a href="<?php echo base_url('DeliverySummary'); ?>">
          <i class="fa fa-location-arrow"></i>
          <span>Transfer Summary</span>
        </a>
      </li>
      <li <?php if ($page == 'productionsummary') {echo 'class="active"';} ?>>
        <a href="<?php echo base_url('ProductionSummary'); ?>">
          <i class="fa fa-location-arrow"></i>
          <span>Production Summary</span>
        </a>
      </li>
      <li <?php if ($page == 'stocksummary') {echo 'class="active"';} ?>>
        <a href="<?php echo base_url('StockSummary'); ?>">
          <i class="fa fa-location-arrow"></i>
          <span>Stock Summary</span>
        </a>
      </li>
      <li <?php if ($page == 'rawmaterialsummary') {echo 'class="active"';} ?>>
        <a href="<?php echo base_url('RawMaterialSummary'); ?>">
          <i class="fa fa-location-arrow"></i>
          <span>Raw Material Summary</span>
        </a>
      </li>
      <li <?php if ($page == 'semifinishedsummary') {echo 'class="active"';} ?>>
        <a href="<?php echo base_url('SemifinishedSummary'); ?>">
          <i class="fa fa-location-arrow"></i>
          <span>Semifinished Summary</span>
        </a>
      </li>
      </li>
      </ul>
<!--       
      <li <?php if ($page == 'pegawai') {echo 'class="active"';} ?>>
        <a href="<?php echo base_url('Pegawai'); ?>">
          <i class="fa fa-user"></i>
          <span>Data Pegawai</span>
        </a>
      </li> -->
<!-- 
      <li <?php if ($page == 'posisi') {echo 'class="active"';} ?>>
        <a href="<?php echo base_url('Posisi'); ?>">
          <i class="fa fa-briefcase"></i>
          <span>Data Posisi</span>
        </a>
      </li>
      
      <li <?php if ($page == 'kota') {echo 'class="active"';} ?>>
        <a href="<?php echo base_url('Kota'); ?>">
          <i class="fa fa-location-arrow"></i>
          <span>Data Kota</span>
        </a>
      </li> -->
     
      <li <?php if ($page == 'manageadmin') {echo 'class="active"';} ?>>
        <a href="<?php echo base_url('ManageAdmin'); ?>">
          <i class="fa fa-users"></i>
          <span>Manage Admin</span>
        </a>
      </li>
      
      <li class="treeview">
      <a href="#" class=" hvr-bounce-to-right"><i class="fa fa-angle-right pull-left"></i> <span class="nav-label">Reports</span><span class="fa arrow"></span></a>
       <ul class="treeview-menu">
      <li <?php if ($page == 'productreport') {echo 'class="active"';} ?>>
        <a href="<?php echo base_url('ProductReport'); ?>">
          <i class="fa fa-users"></i>
          <span>Product Report</span>
        </a>
      </li>
       <li <?php if ($page == 'productionreport') {echo 'class="active"';} ?>>
        <a href="<?php echo base_url('ProductionReport'); ?>">
          <i class="fa fa-users"></i>
          <span>Production Report</span>
        </a>
      </li>
      <li <?php if ($page == 'machinereport') {echo 'class="active"';} ?>>
        <a href="<?php echo base_url('MachineReport'); ?>">
          <i class="fa fa-users"></i>
          <span>Machine Report</span>
        </a>
      </li>
      <li <?php if ($page == 'deliveryreport') {echo 'class="active"';} ?>>
        <a href="<?php echo base_url('DeliveryReport'); ?>">
          <i class="fa fa-users"></i>
          <span>Delivery Report</span>
        </a>
      </li>
      <li <?php if ($page == 'issueddatareport') {echo 'class="active"';} ?>>
        <a href="<?php echo base_url('IssuedDataReport'); ?>">
          <i class="fa fa-users"></i>
          <span>Issued Data Report</span>
        </a>
      </li>
      <li <?php if ($page == 'employeeyreport') {echo 'class="active"';} ?>>
        <a href="<?php echo base_url('EmployeeReport'); ?>">
          <i class="fa fa-users"></i>
          <span>Employee Report</span>
        </a>
      </li>
     

     
      
      <li <?php if ($page == 'stockreport') {echo 'class="active"';} ?>>
        <a href="<?php echo base_url('StockReport'); ?>">
          <i class="fa fa-users"></i>
          <span>Stock Report</span>
        </a>
      </li>
      <li <?php if ($page == 'rawmaterialreport') {echo 'class="active"';} ?>>
        <a href="<?php echo base_url('RawMaterialReport'); ?>">
          <i class="fa fa-users"></i>
          <span>Raw Material Report</span>
        </a>
      </li>
      <li <?php if ($page == 'semifinishedreport') {echo 'class="active"';} ?>>
        <a href="<?php echo base_url('SemifinishedReport'); ?>">
          <i class="fa fa-users"></i>
          <span>Semi Finished Report</span>
        </a>
      </li>
      </li>
      </ul>
    </ul>
    <!-- /.sidebar-menu -->
  </section>
  <!-- /.sidebar -->
</aside>