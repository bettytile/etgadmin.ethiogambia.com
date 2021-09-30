<script type="text/javascript">
	var MyTable = $('#list-data').dataTable({
		  "paging": true,
		  "lengthChange": true,
		  "searching": true,
		  "ordering": true,
		  "info": true,
		  "autoWidth": false
		});

	window.onload = function() {
		tampilPegawai();
		tampilPosisi();
		tampilKota();
		showEmployees();
		showCustomers();
		showMachines();
		showProducts();
		showPreform();
		showPositions();
		showConfirmation();
		showStock();
		showRawmaterial();
		showRawMaterialStock();
		showStockConfirmation();
		showRawMaterialConfirmation();
		showSemiFinishedConfirmation();
		showSemifnishedStock();
		
		<?php
			if ($this->session->flashdata('msg') != '') {
				echo "effect_msg();";
			}
		?>
	}

	function refresh() {
		MyTable = $('#list-data').dataTable();
	}

	function effect_msg_form() {
		// $('.form-msg').hide();
		$('.form-msg').show(1000);
		setTimeout(function() { $('.form-msg').fadeOut(1000); }, 3000);
	}

	function effect_msg() {
		// $('.msg').hide();
		$('.msg').show(1000);
		setTimeout(function() { $('.msg').fadeOut(1000); }, 3000);
	}

	function tampilPegawai() {
		$.get('<?php echo base_url('Pegawai/tampil'); ?>', function(data) {
			MyTable.fnDestroy();
			$('#data-pegawai').html(data);
			refresh();
		});
	}

	var id_pegawai;
	$(document).on("click", ".konfirmasiHapus-pegawai", function() {
		id_pegawai = $(this).attr("data-id");
	})
	$(document).on("click", ".hapus-dataPegawai", function() {
		var id = id_pegawai;
		
		$.ajax({
			method: "POST",
			url: "<?php echo base_url('Pegawai/delete'); ?>",
			data: "id=" +id
		})
		.done(function(data) {
			$('#konfirmasiHapus').modal('hide');
			tampilPegawai();
			$('.msg').html(data);
			effect_msg();
		})
	})

	$(document).on("click", ".update-dataPegawai", function() {
		var id = $(this).attr("data-id");
		
		$.ajax({
			method: "POST",
			url: "<?php echo base_url('Pegawai/update'); ?>",
			data: "id=" +id
		})
		.done(function(data) {
			$('#tempat-modal').html(data);
			$('#update-pegawai').modal('show');
		})
	})
	$('#form-tambah-pegawai').submit(function(e) {
		var data = $(this).serialize();

		$.ajax({
			method: 'POST',
			url: '<?php echo base_url('Pegawai/prosesTambah'); ?>',
			data: data
		})
		.done(function(data) {
			var out = jQuery.parseJSON(data);

			tampilPegawai();
			if (out.status == 'form') {
				$('.form-msg').html(out.msg);
				effect_msg_form();
			} else {
				document.getElementById("form-tambah-pegawai").reset();
				$('#tambah-pegawai').modal('hide');
				$('.msg').html(out.msg);
				effect_msg();
			}
		})
		
		e.preventDefault();
	});

	$(document).on('submit', '#form-update-pegawai', function(e){
		var data = $(this).serialize();

		$.ajax({
			method: 'POST',
			url: '<?php echo base_url('Pegawai/prosesUpdate'); ?>',
			data: data
		})
		.done(function(data) {
			var out = jQuery.parseJSON(data);

			tampilPegawai();
			if (out.status == 'form') {
				$('.form-msg').html(out.msg);
				effect_msg_form();
			} else {
				document.getElementById("form-update-pegawai").reset();
				$('#update-pegawai').modal('hide');
				$('.msg').html(out.msg);
				effect_msg();
			}
		})
		
		e.preventDefault();
	});

	$('#tambah-pegawai').on('hidden.bs.modal', function () {
	  $('.form-msg').html('');
	})

	$('#update-pegawai').on('hidden.bs.modal', function () {
	  $('.form-msg').html('');
	})

	//Employee
	function showEmployees() {
		$.get('<?php echo base_url('Employees/show'); ?>', function(data) {
			MyTable.fnDestroy();
			$('#data-employees').html(data);
			refresh();
		});
	}

	var id_employees;
	$(document).on("click", ".delete-employee", function() {
		id_employees = $(this).attr("data-id");
	})
	$(document).on("click", ".hapus-dataEmployee", function() {
		var id = id_employees;
		
		$.ajax({
			method: "POST",
			url: "<?php echo base_url('Employees/delete'); ?>",
			data: "id=" +id
		})
		.done(function(data) {
			$('#deleteEmployee').modal('hide');
			showEmployees();
			$('.msg').html(data);
			effect_msg();
		})
	})

	$(document).on("click", ".update-dataEmployee", function() {
		var id = $(this).attr("data-id");
		
		$.ajax({
			method: "POST",
			url: "<?php echo base_url('Employees/update'); ?>",
			data: "id=" +id
		})
		.done(function(data) {
			$('#tempat-modal').html(data);
			$('#update-employee').modal('show');
		})
	})
	$('#form-insert-employees').submit(function(e) {
		var data = $(this).serialize();

		$.ajax({
			method: 'POST',
			url: '<?php echo base_url('Employees/addEmployee'); ?>',
			data: data
		})
		.done(function(data) {
			var out = jQuery.parseJSON(data);

			showEmployees();
			if (out.status == 'form') {
				$('.form-msg').html(out.msg);
				effect_msg_form();
			} else {
				document.getElementById("form-insert-employees").reset();
				$('#insert-employees').modal('hide');
				$('.msg').html(out.msg);
				effect_msg();
			}
		})
		
		e.preventDefault();
	});

	$(document).on('submit', '#form-update-employee', function(e){
		var data = $(this).serialize();

		$.ajax({
			method: 'POST',
			url: '<?php echo base_url('Employees/prosesUpdate'); ?>',
			data: data
		})
		.done(function(data) {
			var out = jQuery.parseJSON(data);

			showEmployees();
			if (out.status == 'form') {
				$('.form-msg').html(out.msg);
				effect_msg_form();
			} else {
				document.getElementById("form-update-employee").reset();
				$('#update-employee').modal('hide');
				$('.msg').html(out.msg);
				effect_msg();
			}
		})
		
		e.preventDefault();
	});

	$('#insert-employees').on('hidden.bs.modal', function () {
	  $('.form-msg').html('');
	})

	$('#update-employee').on('hidden.bs.modal', function () {
	  $('.form-msg').html('');
	})

	//Kota
	function tampilKota() {
		$.get('<?php echo base_url('Kota/tampil'); ?>', function(data) {
			MyTable.fnDestroy();
			$('#data-kota').html(data);
			refresh();
		});
	}

	var id_kota;
	$(document).on("click", ".konfirmasiHapus-kota", function() {
		id_kota = $(this).attr("data-id");
	})
	$(document).on("click", ".hapus-dataKota", function() {
		var id = id_kota;
		
		$.ajax({
			method: "POST",
			url: "<?php echo base_url('Kota/delete'); ?>",
			data: "id=" +id
		})
		.done(function(data) {
			$('#konfirmasiHapus').modal('hide');
			tampilKota();
			$('.msg').html(data);
			effect_msg();
		})
	})

	$(document).on("click", ".update-dataKota", function() {
		var id = $(this).attr("data-id");
		
		$.ajax({
			method: "POST",
			url: "<?php echo base_url('Kota/update'); ?>",
			data: "id=" +id
		})
		.done(function(data) {
			$('#tempat-modal').html(data);
			$('#update-kota').modal('show');
		})
	})

	$(document).on("click", ".detail-dataKota", function() {
		var id = $(this).attr("data-id");
		
		$.ajax({
			method: "POST",
			url: "<?php echo base_url('Kota/detail'); ?>",
			data: "id=" +id
		})
		.done(function(data) {
			$('#tempat-modal').html(data);
			$('#tabel-detail').dataTable({
				  "paging": true,
				  "lengthChange": false,
				  "searching": true,
				  "ordering": true,
				  "info": true,
				  "autoWidth": false
				});
			$('#detail-kota').modal('show');
		})
	})

	$('#form-tambah-kota').submit(function(e) {
		var data = $(this).serialize();

		$.ajax({
			method: 'POST',
			url: '<?php echo base_url('Kota/prosesTambah'); ?>',
			data: data
		})
		.done(function(data) {
			var out = jQuery.parseJSON(data);

			tampilKota();
			if (out.status == 'form') {
				$('.form-msg').html(out.msg);
				effect_msg_form();
			} else {
				document.getElementById("form-tambah-kota").reset();
				$('#tambah-kota').modal('hide');
				$('.msg').html(out.msg);
				effect_msg();
			}
		})
		
		e.preventDefault();
	});

	$(document).on('submit', '#form-update-kota', function(e){
		var data = $(this).serialize();

		$.ajax({
			method: 'POST',
			url: '<?php echo base_url('Kota/prosesUpdate'); ?>',
			data: data
		})
		.done(function(data) {
			var out = jQuery.parseJSON(data);

			tampilKota();
			if (out.status == 'form') {
				$('.form-msg').html(out.msg);
				effect_msg_form();
			} else {
				document.getElementById("form-update-kota").reset();
				$('#update-kota').modal('hide');
				$('.msg').html(out.msg);
				effect_msg();
			}
		})
		
		e.preventDefault();
	});

	$('#tambah-kota').on('hidden.bs.modal', function () {
	  $('.form-msg').html('');
	})

	$('#update-kota').on('hidden.bs.modal', function () {
	  $('.form-msg').html('');
	})

	//Posisi
	function tampilPosisi() {
		$.get('<?php echo base_url('Posisi/tampil'); ?>', function(data) {
			MyTable.fnDestroy();
			$('#data-posisi').html(data);
			refresh();
		});
	}

	var id_posisi;
	$(document).on("click", ".konfirmasiHapus-posisi", function() {
		id_posisi = $(this).attr("data-id");
	})
	$(document).on("click", ".hapus-dataPosisi", function() {
		var id = id_posisi;
		
		$.ajax({
			method: "POST",
			url: "<?php echo base_url('Posisi/delete'); ?>",
			data: "id=" +id
		})
		.done(function(data) {
			$('#konfirmasiHapus').modal('hide');
			tampilPosisi();
			$('.msg').html(data);
			effect_msg();
		})
	})

	$(document).on("click", ".update-dataPosisi", function() {
		var id = $(this).attr("data-id");
		
		$.ajax({
			method: "POST",
			url: "<?php echo base_url('Posisi/update'); ?>",
			data: "id=" +id
		})
		.done(function(data) {
			$('#tempat-modal').html(data);
			$('#update-posisi').modal('show');
		})
	})

	$(document).on("click", ".detail-dataPosisi", function() {
		var id = $(this).attr("data-id");
		
		$.ajax({
			method: "POST",
			url: "<?php echo base_url('Posisi/detail'); ?>",
			data: "id=" +id
		})
		.done(function(data) {
			$('#tempat-modal').html(data);
			$('#tabel-detail').dataTable({
				  "paging": true,
				  "lengthChange": false,
				  "searching": true,
				  "ordering": true,
				  "info": true,
				  "autoWidth": false
				});
			$('#detail-posisi').modal('show');
		})
	})

	$('#form-tambah-posisi').submit(function(e) {
		var data = $(this).serialize();

		$.ajax({
			method: 'POST',
			url: '<?php echo base_url('Posisi/prosesTambah'); ?>',
			data: data
		})
		.done(function(data) {
			var out = jQuery.parseJSON(data);

			tampilPosisi();
			if (out.status == 'form') {
				$('.form-msg').html(out.msg);
				effect_msg_form();
			} else {
				document.getElementById("form-tambah-posisi").reset();
				$('#tambah-posisi').modal('hide');
				$('.msg').html(out.msg);
				effect_msg();
			}
		})
		
		e.preventDefault();
	});

	$(document).on('submit', '#form-update-posisi', function(e){
		var data = $(this).serialize();

		$.ajax({
			method: 'POST',
			url: '<?php echo base_url('Posisi/prosesUpdate'); ?>',
			data: data
		})
		.done(function(data) {
			var out = jQuery.parseJSON(data);

			tampilPosisi();
			if (out.status == 'form') {
				$('.form-msg').html(out.msg);
				effect_msg_form();
			} else {
				document.getElementById("form-update-posisi").reset();
				$('#update-posisi').modal('hide');
				$('.msg').html(out.msg);
				effect_msg();
			}
		})
		
		e.preventDefault();
	});

	$('#tambah-posisi').on('hidden.bs.modal', function () {
	  $('.form-msg').html('');
	})

	$('#update-posisi').on('hidden.bs.modal', function () {
	  $('.form-msg').html('');
	})

	//Customer
	function showCustomers() {
		$.get('<?php echo base_url('Customers/showData'); ?>', function(data) {
			MyTable.fnDestroy();
			$('#data-customers').html(data);
			refresh();
		});
	}

	var id_customer;
	$(document).on("click", ".delete-customer", function() {
		id_customer = $(this).attr("data-id");
	})
	$(document).on("click", ".hapus-dataCustomer", function() {
		var id = id_customer;
		
		$.ajax({
			method: "POST",
			url: "<?php echo base_url('Customers/delete'); ?>",
			data: "id=" +id
		})
		.done(function(data) {
			$('#deleteCustomer').modal('hide');
			showCustomers();
			$('.msg').html(data);
			effect_msg();
		})
	})


	$(document).on("click", ".update-dataCustomer", function() {
		var id = $(this).attr("data-id");
		
		$.ajax({
			method: "POST",
			url: "<?php echo base_url('Customers/update'); ?>",
			data: "id=" +id
		})
		.done(function(data) {
			$('#tempat-modal').html(data);
			$('#update-customer').modal('show');
		})
	})


	$('#form-add-customer').submit(function(e) {
		var data = $(this).serialize();

		$.ajax({
			method: 'POST',
			url: '<?php echo base_url('Customers/validateData'); ?>',
			data: data
		})
		.done(function(data) {
			var out = jQuery.parseJSON(data);

			showCustomers();
			if (out.status == 'form') {
				$('.form-msg').html(out.msg);
				effect_msg_form();
			} else {
				document.getElementById("form-add-customer").reset();
				$('#add-customer').modal('hide');
				$('.msg').html(out.msg);
				effect_msg();
			}
		})
		
		e.preventDefault();
	});

	$(document).on('submit', '#form-update-customer', function(e){
		var data = $(this).serialize();

		$.ajax({
			method: 'POST',
			url: '<?php echo base_url('Customers/prosesUpdate'); ?>',
			data: data
		})
		.done(function(data) {
			var out = jQuery.parseJSON(data);

			showCustomers();
			if (out.status == 'form') {
				$('.form-msg').html(out.msg);
				effect_msg_form();
			} else {
				document.getElementById("form-update-customer").reset();
				$('#update-customer').modal('hide');
				$('.msg').html(out.msg);
				effect_msg();
			}
		})
		
		e.preventDefault();
	});

	$('#add-customer').on('hidden.bs.modal', function () {
	  $('.form-msg').html('');
	})

	$('#update-customer').on('hidden.bs.modal', function () {
	  $('.form-msg').html('');
	})
	//Machine
	function showMachines() {
		$.get('<?php echo base_url('Machine/show'); ?>', function(data) {
			MyTable.fnDestroy();
			$('#data-machine').html(data);
			refresh();
		});
	}
	var id_product;
	$(document).on("click", ".delete-machine", function() {
		id_product = $(this).attr("data-id");
	})
	$(document).on("click", ".hapus-dataMachine", function() {
		var id = id_product;
		
		$.ajax({
			method: "POST",
			url: "<?php echo base_url('Machine/delete'); ?>",
			data: "id=" +id
		})
		.done(function(data) {
			$('#deleteMachine').modal('hide');
			showMachines();
			$('.msg').html(data);
			effect_msg();
		})
	})


	$(document).on("click", ".update-dataMachine", function() {
		var id = $(this).attr("data-id");
		
		$.ajax({
			method: "POST",
			url: "<?php echo base_url('Machine/update'); ?>",
			data: "id=" +id
		})
		.done(function(data) {
			$('#tempat-modal').html(data);
			$('#update-machine').modal('show');
		})
	})



	$('#form-insert-machine').submit(function(e) {
		var data = $(this).serialize();

		$.ajax({
			method: 'POST',
			url: '<?php echo base_url('Machine/addMachine'); ?>',
			data: data
		})
		.done(function(data) {
			var out = jQuery.parseJSON(data);

			showMachines();
			if (out.status == 'form') {
				$('.form-msg').html(out.msg);
				effect_msg_form();
			} else {
				document.getElementById("form-insert-machine").reset();
				$('#insert-machine').modal('hide');
				$('.msg').html(out.msg);
				effect_msg();
			}
		})
		
		e.preventDefault();
	});

	$(document).on('submit', '#form-update-machine', function(e){
		var data = $(this).serialize();

		$.ajax({
			method: 'POST',
			url: '<?php echo base_url('Machine/prosesUpdate'); ?>',
			data: data
		})
		.done(function(data) {
			var out = jQuery.parseJSON(data);

			showMachines();
			if (out.status == 'form') {
				$('.form-msg').html(out.msg);
				effect_msg_form();
			} else {
				document.getElementById("form-update-machine").reset();
				$('#update-machine').modal('hide');
				$('.msg').html(out.msg);
				effect_msg();
			}
		})
		
		e.preventDefault();
	});

	$('#insert-machine').on('hidden.bs.modal', function () {
	  $('.form-msg').html('');
	})

	$('#update-machine').on('hidden.bs.modal', function () {
	  $('.form-msg').html('');
	})

	
	//Product
	function showProducts() {
		$.get('<?php echo base_url('Product/show'); ?>', function(data) {
			MyTable.fnDestroy();
			$('#data-product').html(data);
			refresh();
		});
	}

	var id_product;
	$(document).on("click", ".delete-product", function() {
		id_product = $(this).attr("data-id");
	})
	$(document).on("click", ".hapus-dataProduct", function() {
		var id = id_product;
		
		$.ajax({
			method: "POST",
			url: "<?php echo base_url('Product/delete'); ?>",
			data: "id=" +id
		})
		.done(function(data) {
			$('#deleteProduct').modal('hide');
			showProducts();
			$('.msg').html(data);
			effect_msg();
		})
	})


	$(document).on("click", ".update-dataProduct", function() {
		var id = $(this).attr("data-id");
		
		$.ajax({
			method: "POST",
			url: "<?php echo base_url('Product/update'); ?>",
			data: "id=" +id
		})
		.done(function(data) {
			$('#tempat-modal').html(data);
			$('#update-product').modal('show');
		})
	})



	$('#form-insert-product').submit(function(e) {
		var data = $(this).serialize();

		$.ajax({
			method: 'POST',
			url: '<?php echo base_url('Product/addProduct'); ?>',
			data: data
		})
		.done(function(data) {
			var out = jQuery.parseJSON(data);

			showProducts();
			if (out.status == 'form') {
				$('.form-msg').html(out.msg);
				effect_msg_form();
			} else {
				document.getElementById("form-insert-product").reset();
				$('#insert-product').modal('hide');
				$('.msg').html(out.msg);
				effect_msg();
			}
		})
		
		e.preventDefault();
	});

	$(document).on('submit', '#form-update-product', function(e){
		var data = $(this).serialize();

		$.ajax({
			method: 'POST',
			url: '<?php echo base_url('Product/prosesUpdate'); ?>',
			data: data
		})
		.done(function(data) {
			var out = jQuery.parseJSON(data);

			showProducts();
			if (out.status == 'form') {
				$('.form-msg').html(out.msg);
				effect_msg_form();
			} else {
				document.getElementById("form-update-product").reset();
				$('#update-product').modal('hide');
				$('.msg').html(out.msg);
				effect_msg();
			}
		})
		
		e.preventDefault();
	});

	$('#insert-product').on('hidden.bs.modal', function () {
	  $('.form-msg').html('');
	})

	$('#update-product').on('hidden.bs.modal', function () {
	  $('.form-msg').html('');
	})
	//Preform
	
	function showPreform() {
		$.get('<?php echo base_url('SemiFinished/show'); ?>', function(data) {
			MyTable.fnDestroy();
			$('#data-preform').html(data);
			refresh();
		});
	}

	var id_product;
	$(document).on("click", ".delete-preform", function() {
		id_product = $(this).attr("data-id");
	})
	$(document).on("click", ".hapus-dataPreform", function() {
		var id = id_product;
		
		$.ajax({
			method: "POST",
			url: "<?php echo base_url('SemiFinished/delete'); ?>",
			data: "id=" +id
		})
		.done(function(data) {
			$('#deletePreform').modal('hide');
			showPreform();
			$('.msg').html(data);
			effect_msg();
		})
	})


	$(document).on("click", ".update-dataPreform", function() {
		var id = $(this).attr("data-id");
		
		$.ajax({
			method: "POST",
			url: "<?php echo base_url('SemiFinished/update'); ?>",
			data: "id=" +id
		})
		.done(function(data) {
			$('#tempat-modal').html(data);
			$('#update-preform').modal('show');
		})
	})



	$('#form-insert-preform').submit(function(e) {
		var data = $(this).serialize();

		$.ajax({
			method: 'POST',
			url: '<?php echo base_url('SemiFinished/addProduct'); ?>',
			data: data
		})
		.done(function(data) {
			var out = jQuery.parseJSON(data);

			showPreform();
			if (out.status == 'form') {
				$('.form-msg').html(out.msg);
				effect_msg_form();
			} else {
				document.getElementById("form-insert-preform").reset();
				$('#insert-preform').modal('hide');
				$('.msg').html(out.msg);
				effect_msg();
			}
		})
		
		e.preventDefault();
	});

	$(document).on('submit', '#form-update-preform', function(e){
		var data = $(this).serialize();

		$.ajax({
			method: 'POST',
			url: '<?php echo base_url('SemiFinished/prosesUpdate'); ?>',
			data: data
		})
		.done(function(data) {
			var out = jQuery.parseJSON(data);

			showPreform();
			if (out.status == 'form') {
				$('.form-msg').html(out.msg);
				effect_msg_form();
			} else {
				document.getElementById("form-update-preform").reset();
				$('#update-preform').modal('hide');
				$('.msg').html(out.msg);
				effect_msg();
			}
		})
		
		e.preventDefault();
	});

	$('#insert-preform').on('hidden.bs.modal', function () {
	  $('.form-msg').html('');
	})

	$('#update-preform').on('hidden.bs.modal', function () {
	  $('.form-msg').html('');
	})
	//RawMaterial
	
	function showRawmaterial() {
		$.get('<?php echo base_url('RawMaterial/show'); ?>', function(data) {
			MyTable.fnDestroy();
			$('#data-rawmaterial').html(data);
			refresh();
		});
	}

	var id_product;
	$(document).on("click", ".delete-rawmaterial", function() {
		id_product = $(this).attr("data-id");
	})
	$(document).on("click", ".hapus-dataRawmaterial", function() {
		var id = id_product;
		
		$.ajax({
			method: "POST",
			url: "<?php echo base_url('RawMaterial/delete'); ?>",
			data: "id=" +id
		})
		.done(function(data) {
			$('#deleteRawmaterial').modal('hide');
			showRawmaterial();
			$('.msg').html(data);
			effect_msg();
		})
	})


	
	$(document).on("click", ".updates-dataRawMaterial", function() {
		var id = $(this).attr("data-id");
		
		$.ajax({
			method: "POST",
			url: "<?php echo base_url('RawMaterial/update'); ?>",
			data: "id=" +id
		})
		.done(function(data) {
			$('#tempat-modal').html(data);
			$('#updates-rawmaterials').modal('show');
		})
	})



	$('#form-insert-rawmaterial').submit(function(e) {
		var data = $(this).serialize();

		$.ajax({
			method: 'POST',
			url: '<?php echo base_url('RawMaterial/addProduct'); ?>',
			data: data
		})
		.done(function(data) {
			var out = jQuery.parseJSON(data);

			showRawmaterial();
			if (out.status == 'form') {
				$('.form-msg').html(out.msg);
				effect_msg_form();
			} else {
				document.getElementById("form-insert-rawmaterial").reset();
				$('#insert-rawmaterial').modal('hide');
				$('.msg').html(out.msg);
				effect_msg();
			}
		})
		
		e.preventDefault();
	});

	$(document).on('submit', '#form-update-rawmaterial', function(e){
		var data = $(this).serialize();

		$.ajax({
			method: 'POST',
			url: '<?php echo base_url('RawMaterial/prosesUpdate'); ?>',
			data: data
		})
		.done(function(data) {
			var out = jQuery.parseJSON(data);

			showRawmaterial();
			if (out.status == 'form') {
				$('.form-msg').html(out.msg);
				effect_msg_form();
			} else {
				document.getElementById("form-update-rawmaterial").reset();
				$('#update-rawmaterial').modal('hide');
				$('.msg').html(out.msg);
				effect_msg();
			}
		})
		
		e.preventDefault();
	});

	$('#insert-rawmaterial').on('hidden.bs.modal', function () {
	  $('.form-msg').html('');
	})

	$('#updates-rawmaterials').on('hidden.bs.modal', function () {
	  $('.form-msg').html('');
	})
	//Confirmation
	function showConfirmation() {
		$.get('<?php echo base_url('Confirmation/showData'); ?>', function(data) {
			MyTable.fnDestroy();
			$('#data-confirmation').html(data);
			refresh();
		});
	}

	var id_product;
	$(document).on("click", ".delete-production", function() {
		id_product = $(this).attr("data-id");
	})
	$(document).on("click", ".hapus-dataProduction", function() {
		var id = id_product;
		
		$.ajax({
			method: "POST",
			url: "<?php echo base_url('Confirmation/delete'); ?>",
			data: "id=" +id
		})
		.done(function(data) {
			$('#deleteProduction').modal('hide');
			showConfirmation();
			$('.msg').html(data);
			effect_msg();
		})
	})
	var id_product;
	$(document).on("click", ".confirm-production", function() {
		id_product = $(this).attr("data-id");
	})
	$(document).on("click", ".hapus-dataConfirmation", function() {
		var id = id_product;
		
		$.ajax({
			method: "POST",
			url: "<?php echo base_url('Confirmation/confirm'); ?>",
			data: "id=" +id
		})
		.done(function(data) {
			$('#confirmProduction').modal('hide');
			showConfirmation();
			$('.msg').html(data);
			effect_msg();
		})
	})

	$(document).on("click", ".update-dataProduction", function() {
		var id = $(this).attr("data-id");
		
		$.ajax({
			method: "POST",
			url: "<?php echo base_url('Confirmation/update'); ?>",
			data: "id=" +id
		})
		.done(function(data) {
			$('#tempat-modal').html(data);
			$('#update-production').modal('show');
		})
	})




	$(document).on('submit', '#form-update-production', function(e){
		var data = $(this).serialize();

		$.ajax({
			method: 'POST',
			url: '<?php echo base_url('Confirmation/prosesUpdate'); ?>',
			data: data
		})
		.done(function(data) {
			var out = jQuery.parseJSON(data);

			showConfirmation();
			if (out.status == 'form') {
				$('.form-msg').html(out.msg);
				effect_msg_form();
			} else {
				document.getElementById("form-update-production").reset();
				$('#update-production').modal('hide');
				$('.msg').html(out.msg);
				effect_msg();
			}
		})
		
		e.preventDefault();
	});

	// $('#insert-product').on('hidden.bs.modal', function () {
	//   $('.form-msg').html('');
	// })

	$('#update-production').on('hidden.bs.modal', function () {
	  $('.form-msg').html('');
	})
	//showStockConfirmation
	function showStockConfirmation() {
		$.get('<?php echo base_url('StockConfirmation/show'); ?>', function(data) {
			MyTable.fnDestroy();
			$('#data-confirm').html(data);
			refresh();
		});
	}

	var id_product;
	$(document).on("click", ".delete-products", function() {
		id_product = $(this).attr("data-id");
	})
	$(document).on("click", ".hapus-dataStockDeletion", function() {
		var id = id_product;
		
		$.ajax({
			method: "POST",
			url: "<?php echo base_url('StockConfirmation/delete'); ?>",
			data: "id=" +id
		})
		.done(function(data) {
			$('#deleteProducts').modal('hide');
			showStockConfirmation();
			$('.msg').html(data);
			effect_msg();
			refresh();
		})
	})
	var id_product;
	$(document).on("click", ".confirm-products", function() {
		id_product = $(this).attr("data-id");
	})
	$(document).on("click", ".hapus-dataStockConfirmation", function() {
		var id = id_product;
		
		$.ajax({
			method: "POST",
			url: "<?php echo base_url('StockConfirmation/confirm'); ?>",
			data: "id=" +id
		})
		.done(function(data) {
			$('#confirmProducts').modal('hide');
			showStockConfirmation();
			$('.msg').html(data);
			effect_msg();
			refresh();
		})
	})
	$(document).on("click", ".update-datastockProduction", function() {
		var id = $(this).attr("data-id");
		
		$.ajax({
			method: "POST",
			url: "<?php echo base_url('StockConfirmation/update'); ?>",
			data: "id=" +id
		})
		.done(function(data) {
			$('#tempat-modal').html(data);
			$('#update-stockproduction').modal('show');
		})
	})
	
	$(document).on('submit', '#form-update-stockproduct', function(e){
		var data = $(this).serialize();

		$.ajax({
			method: 'POST',
			url: '<?php echo base_url('StockConfirmation/prosesUpdate'); ?>',
			data: data
		})
		.done(function(data) {
			var out = jQuery.parseJSON(data);

			showStockConfirmation();
			if (out.status == 'form') {
				$('.form-msg').html(out.msg);
				effect_msg_form();
			} else {
				document.getElementById("form-update-stockproduct").reset();
				$('#update-stockproduction').modal('hide');
				$('.msg').html(out.msg);
				effect_msg();
			}
		})
		
		e.preventDefault();
	});
	$('#update-stockproduction').on('hidden.bs.modal', function () {
	  $('.form-msg').html('');
	})

	//EditStock
	function showStock() {
		$.get('<?php echo base_url('EditStock/show'); ?>', function(data) {
			//MyTable.fnDestroy();
			$('#data-stock').html(data);
			refresh();
		});
	}
	$(document).on("click", ".delete-stock", function() {
		id_product = $(this).attr("data-id");
	})
	$(document).on("click", ".hapus-dataStockProduct", function() {
		var id = id_product;
		
		$.ajax({
			method: "POST",
			url: "<?php echo base_url('EditStock/delete'); ?>",
			data: "id=" +id
		})
		.done(function(data) {
			$('#deleteStock').modal('hide');
			showProducts();
			$('.msg').html(data);
			effect_msg();
		})
	})
	$(document).on("click", ".update-dataStock", function() {
		var id = $(this).attr("data-id");
		
		$.ajax({
			method: "POST",
			url: "<?php echo base_url('EditStock/update'); ?>",
			data: "id=" +id
		})
		.done(function(data) {
			$('#tempat-modal').html(data);
			$('#update-stockproduct').modal('show');
		})
	})
	
	$(document).on('submit', '#form-update-stockproduct', function(e){
		var data = $(this).serialize();

		$.ajax({
			method: 'POST',
			url: '<?php echo base_url('EditStock/prosesUpdate'); ?>',
			data: data
		})
		.done(function(data) {
			var out = jQuery.parseJSON(data);

			showStock();
			if (out.status == 'form') {
				$('.form-msg').html(out.msg);
				effect_msg_form();
			} else {
				document.getElementById("form-update-stockproduct").reset();
				$('#update-stockproduct').modal('hide');
				$('.msg').html(out.msg);
				effect_msg();
			}
		})
		
		e.preventDefault();
	});
	$('#update-stockproduct').on('hidden.bs.modal', function () {
	  $('.form-msg').html('');
	})
	//RawmaterialConfrimation
	function showRawMaterialConfirmation() {
		$.get('<?php echo base_url('RawmaterialConfirmation/show'); ?>', function(data) {
			MyTable.fnDestroy();
			$('#data-stock').html(data);
			refresh();
		});
	}
	$(document).on("click", ".delete-rawmaterial", function() {
		id_product = $(this).attr("data-id");
	})
	$(document).on("click", ".hapus-dataRawMaterail", function() {
		var id = id_product;
		
		$.ajax({
			method: "POST",
			url: "<?php echo base_url('RawmaterialConfirmation/delete'); ?>",
			data: "id=" +id
		})
		.done(function(data) {
			$('#deleteRawMaterial').modal('hide');
			showRawMaterialConfirmation();
			$('.msg').html(data);
			effect_msg();
		})
	})
	$(document).on("click", ".confirm-rawmaterial", function() {
		id_product = $(this).attr("data-id");
	})
	$(document).on("click", ".hapus-dataConfirmation", function() {
		var id = id_product;
		
		$.ajax({
			method: "POST",
			url: "<?php echo base_url('RawmaterialConfirmation/rmconfirm'); ?>",
			data: "id=" +id
		})
		.done(function(data) {
			$('#confirmRawmaterial').modal('hide');
			showRawMaterialConfirmation();
			$('.msg').html(data);
			effect_msg();
		})
	})
	
	
	$(document).on('submit', '#form-update-rawmaterial', function(e){
		var data = $(this).serialize();

		$.ajax({
			method: 'POST',
			url: '<?php echo base_url('RawmaterialConfirmation/prosesUpdate'); ?>',
			data: data
		})
		.done(function(data) {
			var out = jQuery.parseJSON(data);

			showRawMaterialConfirmation();
			if (out.status == 'form') {
				$('.form-msg').html(out.msg);
				effect_msg_form();
			} else {
				document.getElementById("form-update-rawmaterial").reset();
				$('#update-stockRawmaterial').modal('hide');
				$('.msg').html(out.msg);
				effect_msg();
			}
		})
		
		e.preventDefault();
	});
	$('#update-stockRawmaterial').on('hidden.bs.modal', function () {
	  $('.form-msg').html('');
	})
	//semifinishedConfirmation
	function showSemiFinishedConfirmation() {
		$.get('<?php echo base_url('SemiFinishedConfirmation/show'); ?>', function(data) {
			MyTable.fnDestroy();
			$('#data-stock').html(data);
			refresh();
		});
	}
	$(document).on("click", ".delete-preform", function() {
		id_product = $(this).attr("data-id");
	})
	$(document).on("click", ".hapus-dataPreform", function() {
		var id = id_product;
		
		$.ajax({
			method: "POST",
			url: "<?php echo base_url('SemiFinishedConfirmation/delete'); ?>",
			data: "id=" +id
		})
		.done(function(data) {
			$('#deletePreform').modal('hide');
			showSemiFinishedConfirmation();
			$('.msg').html(data);
			effect_msg();
		})
	})
	$(document).on("click", ".confirm-preform", function() {
		id_product = $(this).attr("data-id");
	})
	$(document).on("click", ".hapus-dataConfirmation", function() {
		var id = id_product;
		
		$.ajax({
			method: "POST",
			url: "<?php echo base_url('SemiFinishedConfirmation/rmconfirm'); ?>",
			data: "id=" +id
		})
		.done(function(data) {
			$('#confirmPreform').modal('hide');
			showSemiFinishedConfirmation();
			$('.msg').html(data);
			effect_msg();
		})
	})
	$(document).on("click", ".update-dataPreform", function() {
		var id = $(this).attr("data-id");
		
		$.ajax({
			method: "POST",
			url: "<?php echo base_url('SemiFinishedConfirmation/update'); ?>",
			data: "id=" +id
		})
		.done(function(data) {
			$('#tempat-modal').html(data);
			$('#update-stockSemifinished').modal('show');
		})
	})
	
	$(document).on('submit', '#form-update-rawmaterial', function(e){
		var data = $(this).serialize();

		$.ajax({
			method: 'POST',
			url: '<?php echo base_url('SemiFinishedConfirmation/prosesUpdate'); ?>',
			data: data
		})
		.done(function(data) {
			var out = jQuery.parseJSON(data);

			showSemiFinishedConfirmation();
			if (out.status == 'form') {
				$('.form-msg').html(out.msg);
				effect_msg_form();
			} else {
				document.getElementById("form-update-rawmaterial").reset();
				$('#update-stockSemifinished').modal('hide');
				$('.msg').html(out.msg);
				effect_msg();
			}
		})
		
		e.preventDefault();
	});
	$('#update-stockSemifinished').on('hidden.bs.modal', function () {
	  $('.form-msg').html('');
	})
	//EditRawmaterial
	function showRawMaterialStock() {
		$.get('<?php echo base_url('EditRawMaterial/show'); ?>', function(data) {
			MyTable.fnDestroy();
			$('#data-stockRawmaterial').html(data);
			refresh();
		});
	}
	$(document).on("click", ".delete-stockrawmaterial", function() {
		id_product = $(this).attr("data-id");
	})
	$(document).on("click", ".hapus-dataRawMaterail", function() {
		var id = id_product;
		
		$.ajax({
			method: "POST",
			url: "<?php echo base_url('EditRawMaterial/delete'); ?>",
			data: "id=" +id
		})
		.done(function(data) {
			$('#deleteRawMaterial').modal('hide');
			showRawMaterialStock();
			$('.msg').html(data);
			effect_msg();
		})
	})
	$(document).on("click", ".update-dataRawMaterail", function() {
		var id = $(this).attr("data-id");
		
		$.ajax({
			method: "POST",
			url: "<?php echo base_url('EditRawMaterial/update'); ?>",
			data: "id=" +id
		})
		.done(function(data) {
			$('#tempat-modal').html(data);
			$('#update-stockrawmaterial').modal('show');
		})
	})
	
	$(document).on('submit', '#form-update-rawmaterial', function(e){
		var data = $(this).serialize();

		$.ajax({
			method: 'POST',
			url: '<?php echo base_url('EditRawMaterial/prosesUpdate'); ?>',
			data: data
		})
		.done(function(data) {
			var out = jQuery.parseJSON(data);

			showRawMaterialStock();
			if (out.status == 'form') {
				$('.form-msg').html(out.msg);
				effect_msg_form();
			} else {
				document.getElementById("form-update-rawmaterial").reset();
				$('#update-stockrawmaterial').modal('hide');
				$('.msg').html(out.msg);
				effect_msg();
			}
		})
		
		e.preventDefault();
	});
	$('#update-stockrawmaterial').on('hidden.bs.modal', function () {
	  $('.form-msg').html('');
	})
	//EditSemifinished
	function showSemifnishedStock() {
		$.get('<?php echo base_url('EditSemifinished/show'); ?>', function(data) {
			MyTable.fnDestroy();
			$('#data-stock').html(data);
			refresh();
		});
	}
	$(document).on("click", ".delete-semifinished", function() {
		id_product = $(this).attr("data-id");
	})
	$(document).on("click", ".hapus-dataSemiFinished", function() {
		var id = id_product;
		
		$.ajax({
			method: "POST",
			url: "<?php echo base_url('EditSemifinished/delete'); ?>",
			data: "id=" +id
		})
		.done(function(data) {
			$('#deleteSemiFinished').modal('hide');
			showSemifnishedStock();
			$('.msg').html(data);
			effect_msg();
		})
	})
	$(document).on("click", ".update-dataSemifinished", function() {
		var id = $(this).attr("data-id");
		
		$.ajax({
			method: "POST",
			url: "<?php echo base_url('EditSemifinished/update'); ?>",
			data: "id=" +id
		})
		.done(function(data) {
			$('#tempat-modal').html(data);
			$('#update-semifinished').modal('show');
		})
	})
	
	$(document).on('submit', '#form-update-semifinished', function(e){
		var data = $(this).serialize();

		$.ajax({
			method: 'POST',
			url: '<?php echo base_url('EditSemifinished/prosesUpdate'); ?>',
			data: data
		})
		.done(function(data) {
			var out = jQuery.parseJSON(data);

			showSemifnishedStock();
			if (out.status == 'form') {
				$('.form-msg').html(out.msg);
				effect_msg_form();
			} else {
				document.getElementById("form-update-semifinished").reset();
				$('#update-semifinished').modal('hide');
				$('.msg').html(out.msg);
				effect_msg();
			}
		})
		
		e.preventDefault();
	});
	$('#update-semifinished').on('hidden.bs.modal', function () {
	  $('.form-msg').html('');
	})
</script>