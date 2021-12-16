<base href="<?php echo base_url();?>">
<!doctype html>
<html lang="en">

<head>
	<!-- Required meta tags -->
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<!-- Bootstrap CSS -->
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet"
		integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous">
	<link rel="stylesheet" href="./assets/css/style.css">
	
	
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

	<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
	<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

	<title>Cladtek</title>
</head>

<body>
	<br>
	
	<div class="container-fluid">
		<form class="form-control" method='POST' action='c_index/simpan' enctype='multipart/form-data'>
			<img class="logo" src="./assets/Photo/clogo.JPEG">
			<h2 class="judul">Employee Change Record</h2> 	
			<h4 class="name" style=" float: right; margin-top: -120px;"><?= $_SESSION['full_name']; ?> </h4>
			<h4 class="name" style=" float: right; margin-top: -95px;"><?= ucfirst($_SESSION['role']); ?></h4>
			<a href="<?= base_url('logout'); ?>" class="btn btn-primary" style=" float: right; margin-top: -65px;">Logout</a>
			<a href="<?= base_url('c_authentication/change'); ?>" class="btn btn-danger" style=" float: right; margin-top: -20px;">change</a>
			<select class="form-select" name="ops_employee">
				<option value="NULL">Choice..</option>
				<?php
								if (! empty($choise)) {
									foreach ($choise as $c) {
										echo "
												<option value=".$c->choise.">".$c->choise."</option>";
										}
									}else{
								echo"<option>EMPTY!</option>";
							}
					?>
			</select>
			<br><br>
			<table class="bio" class="table-desc">
				<tr>
					<td><label for="">Name</label></td>
					<td>:</td>
					<td><input class="form-control" id="myName" type="text" name="txt_name"></td>
					<td><label for="">Date of Joining</label></td>
					<td>:</td>
					<td><input class="form-control" type="text" id="txtDate" value="mm / dd / yyyy" name="txt_date" readonly></td>
				</tr>
				<tr>
					<td><label for="">Employee ID</label></td>
					<td>:</td>
					<td><select id="SelectEmpId" name="emp_id[]" class="form-control select2">
									<!-- <option selected="selected">ID Parts</option> -->
							</select></td>
					<td><label for="">Effective Date of Change</label></td>
					<td>:</td>
					<td><input class="form-control" type="date" name="txt_effective"></td>
				</tr>
				<tr>
					<td><label for="">Designantion</label></td>
					<td>:</td>
					<td><input class="form-control" type="text" id="designation" name="txt_designantion"></td>
					<td><label for="">Reason of Change</label></td>
					<td>:</td>
					<td><input class="form-control" type="text" name="txt_reason"></td>
				</tr>
			</table>

			<tr>
				<td>
				<label for="">ID Manager</label></td>
					<td>:</td>
					<td><select id="SelectManid" name="managerid[]" class="form-control select2">
									<!-- <option selected="selected">ID Parts</option> -->
							</select>
				</td>
			</tr>

			<tr>
				<td>
				<label for="">ID General Manager/CEO</label></td>
					<td>:</td>
					<td><select id="SelectCeoid" name="ceoid[]" class="form-control select2">
									<!-- <option selected="selected">ID Parts</option> -->
							</select>
				</td>
			</tr>

			<tr>
				<td>
				<label for="">ID HRD</label></td>
					<td>:</td>
					<td><select id="SelectHrdid" name="hrdid[]" class="form-control select2">
									<!-- <option selected="selected">ID Parts</option> -->
							</select>
				</td>
			</tr>
			
			<br><br>
			<!-- Table Checkbox -->
			<table class="table table-secondary table-striped table-hover">
				<tr>
					<td>Tick</td>
					<td>Description</td>
					<td>From</td>
					<td>To</td>
				</tr>
				<tr>
					<td><input class="form-check-input mt-0" type="checkbox"></td>
					<td>1. Employment Status(i.e. Permanent/Contract/Other)</td>
					<td>
						<select class="form-select" name="ops_status" id="ops_status">
							<option value="NULL">Choice..</option>
							<?php
								if (! empty($status)) {
									foreach ($status as $s) {
										echo "
												<option value=".$s->employee_status.">".$s->employee_status."</option>";
										}
									}else{
								echo"<option>EMPTY!</option>";
							}
					?>
						</select>
					</td>
					<td>
						<select class="form-select" name="ops_status1" id="ops_status1">
							<option value="NULL">Choice..</option>
							<?php
								if (! empty($status)) {
									foreach ($status as $s) {
										echo "
												<option value=".$s->employee_status.">".$s->employee_status."</option>";
										}
									}else{
								echo"<option>EMPTY!</option>";
							}
					?>
						</select>
					</td>
				</tr>
				<tr>
					<td><input class="form-check-input mt-0" type="checkbox"></td>
					<td>2. Department</td>
					<td>
						<select class="form-select" name="ops_departement" id="ops_departement">
							<option value="NULL">Choice..</option>
							<?php
								if (! empty($departement)) {
									foreach ($departement as $d) {
										echo "
												<option value=".$d->id_departement.">".$d->departement."</option>";
										}
									}else{
								echo"<option>EMPTY!</option>";
							}
					?>
						</select>
					</td>
					<!-- select to -->
					<td>
						<select class="form-select" name="ops_departement_to" id="ops_departement_to">
							<option value="NULL">Choice..</option>
							<?php
								if (! empty($departement)) {
									foreach ($departement as $d) {
										echo "
												<option value=".$d->id_departement.">".$d->departement."</option>";
										}
									}else{
								echo"<option>EMPTY!</option>";
							}
					?>
						</select>
					</td>
				</tr>
				<tr>
					<td><input class="form-check-input mt-0" type="checkbox"></td>
					<td>3. Division/ Section / Station</td>
					<td>
						<select class="form-select" name="ops_div" id="ops_div" >
							<option value="NULL">Choice..</option>
							<?php
								if (! empty($division)) {
									foreach ($division as $di) {
										echo "
												<option value=".$di->division.">".$di->division."</option>";
										}
									}else{
								echo"<option>EMPTY!</option>";
							}
					?>
						</select>
					</td>
					<!-- ops div 2 -->
					<td>
						<select class="form-select" name="ops_div_to" id="ops_div_to">
							<option value="NULL">Choice..</option>
							<?php
								if (! empty($division)) {
									foreach ($division as $di) {
										echo "
												<option value=".$di->division.">".$di->division."</option>";
										}
									}else{
								echo"<option>EMPTY!</option>";
							}
					?>
						</select>
					</td>	
				</tr>

				<script>
					 $('#ops_departement').change(function(){ 
						var id=$(this).val();
						$.ajax({
							url : "<?php echo site_url('c_index/get_DivisionCategory');?>",
							method : "POST",
							data : {id: id},
							async : true,
							dataType : 'json',
							success: function(data){
								console.log(data);
								var html = '';
								var i;
								for(i=0; i<data.length; i++){
									html += '<option value='+data[i].id_division+'>'+data[i].division+'</option>';
								}
								$('#ops_div').html(html);
		
							}
						});
						return false;
					}); 
				</script>
    <!-- departement to -->
				<script>
					 $('#ops_departement_to').change(function(){ 
						var id=$(this).val();
						$.ajax({
							url : "<?php echo site_url('c_index/get_DivisionCategory');?>",
							method : "POST",
							data : {id: id},
							async : true,
							dataType : 'json',
							success: function(data){
								console.log(data);
								var html = '';
								var i;
								for(i=0; i<data.length; i++){
									html += '<option value='+data[i].id_division+'>'+data[i].division+'</option>';
								}
								$('#ops_div_to').html(html);
		
							}
						});
						return false;
					}); 
				</script>
				

				<tr>
					<td><input class="form-check-input mt-0" type="checkbox"></td>
					<td>4. Immediate Superior</td>
					<td><input class="form-control" type="text" name="txt_immediate" id="txt_immediate"></td>
					<td><input class="form-control" type="text" name="txt_immediate_to" id="txt_immediate_to"></td>
				</tr>
				<tr>
					<td><input class="form-check-input mt-0" type="checkbox"></td>
					<td>5. Designation *</td>
					<td><input class="form-control" type="text" name="txt_des" id="txt_des"></td>
					<td><input class="form-control" type="text" name="txt_des_to" id="txt_des_to"></td>
				</tr>
				<tr>
					<td><input class="form-check-input mt-0" type="checkbox"></td>
					<td>6. Basic Salary *</td>
					<td><input class="form-control" type="number" name="num_salary" id="num_salary"></td>
					<td><input class="form-control" type="number" name="num_salary_to" id="num_salary_to"></td>
				</tr>
				<tr>
					<td><input class="form-check-input mt-0" type="checkbox"></td>
					<td>7. Allowances Amount *</td>
					<td><input class="form-control" type="number" name="num_amount" id="num_amount"></td>
					<td><input class="form-control" type="number" name="num_amount_to" id="num_amount_to"></td>
				</tr>
				<tr>
					<td><input class="form-check-input mt-0" type="checkbox"></td>
					<td>8. Overtime Rate (Hourly Rate)</td>
					<td><input class="form-control" type="number" name="num_overtime" id="num_overtime"></td>
					<td><input class="form-control" type="number" name="num_overtime_to" id="num_overtime_to"></td>
				</tr>
				<tr>
					<td><input class="form-check-input mt-0" type="checkbox"></td>
					<td>9. Others</td>
					<td><input class="form-control" type="text" name="txt_other" id="txt_other"></td>
					<td><input class="form-control" type="text" name="txt_other_to" id="txt_other_to"></td>
				</tr>
			</table>
			<br>
			<table class="acc">
				<tr>
					<td>Requested by a</td>
					<?php if (@$_SESSION['role'] == 'hrd' || @$_SESSION['role'] == 'ceo' || @$_SESSION['role'] == 'hod') { ?> 
					<td>Agreed by <br> <b>Manager/HOD</b></td>
					<td>Approved by <br> <b>General Manager/CEO</b></td>
					<td>Reviewed by <br> <b>HRD</b></td>

					<?php } ?>
				</tr>
				
				<tr>
					<td>
						<img id="blah1"  width="200px" height="200px"  />
						<input class="form-control" type="file" 
						    onchange="document.getElementById('blah1').src = window.URL.createObjectURL(this.files[0])" name="imgApprove1">
						<input class="btn btn-primary" name="cek_acc" id="myCheck" value="acc" type="checkbox"
							onclick="myFunction()">
						<p id="text" style="display:none">APPROVE!</p>
					</td>

					<?php if (@$_SESSION['role'] == 'hrd' || @$_SESSION['role'] == 'ceo' || @$_SESSION['role'] == 'hod') { ?>
					<td>
						<img id="blah2"  width="200px" height="200px"  />
						<input class="form-control" type="file" 
						    onchange="document.getElementById('blah2').src = window.URL.createObjectURL(this.files[0])">
						<input class="btn btn-primary" name="cek_acc1" id="myCheck2" value="acc" type="checkbox"
							onclick="myFunction2()">
						<p id="text2" style="display:none">APPROVE!</p>
					</td>
					<td>
						<img id="blah3"  width="200px" height="200px"  />
						<input class="form-control" type="file" 
						    onchange="document.getElementById('blah3').src = window.URL.createObjectURL(this.files[0])">
						<input class="btn btn-primary" name="cek_acc2" id="myCheck3" value="acc" type="checkbox"
							onclick="myFunction3()">
						<p id="text3" style="display:none">APPROVE!</p>
					</td>
					<td>
						<img id="blah4"  width="200px" height="200px"  />
						<input class="form-control" type="file" 
						    onchange="document.getElementById('blah4').src = window.URL.createObjectURL(this.files[0])">
						<input class="btn btn-primary" name="cek_acc3" id="myCheck4" value="acc" type="checkbox"
							onclick="myFunction4()">
						<p id="text4" style="display:none">APPROVE!</p>
					</td>


					<?php } ?>
				</tr>
			</table>
			<br>
			<label for="">Remark</label><br>
			<textarea class="form-control" id="exampleFormControlTextarea1" rows="3" name="txt_remark"></textarea>
			<br><br>
			<button class="btn btn-primary">Submit</button>
		</form>

	</div>

	<!-- Optional JavaScript; choose one of the two! -->

	<!-- <?php if (! empty($input)) {
		foreach ($input as $i) {
	echo "
				<td>".$i->Name."</td>
				<td>".$i->Name."</td>
			</tr> ";
		}
	}else{
		echo"<td align='center' colspan='2'>EMPTY!</td>";
	}?> -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-/bQdsTh/da6pkI1MST/rWKFNjaCP5gBSY4sEBT38Q/9RBh9AH40zEOg7Hlq2THRZ" crossorigin="anonymous"></script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <script src="./assets/js/script.js"></script>
    <!-- <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script> -->
<script>
	function myFunction() {
		var checkBox = document.getElementById("myCheck");
		var text = document.getElementById("text");
		if (checkBox.checked == true) {
			text.style.display = "block";
		} else {
			text.style.display = "none";
		}
	}
</script>
<script>
	function myFunction2() {
		var checkBox = document.getElementById("myCheck2");
		var text = document.getElementById("text2");
		if (checkBox.checked == true){
			text.style.display = "block";
		} else {
			text.style.display = "none";
		}
	}
</script>
<script>
	function myFunction3() {
		var checkBox = document.getElementById("myCheck3");
		var text = document.getElementById("text3");
		if (checkBox.checked == true){
			text.style.display = "block";
		} else {
			text.style.display = "none";
		}
	}
</script>
<script>
	function myFunction4() {
		var checkBox = document.getElementById("myCheck4");
		var text = document.getElementById("text4");
		if (checkBox.checked == true){
			text.style.display = "block";
		} else {
			text.style.display = "none";
		}
	}
</script>

<script>
	// tambah untuk menampilkan data dari field "_To"
	 $('#SelectEmpId').select2({
    //   theme: 'bootstrap4',
      minimumInputLength: 1,
      ajax: { 
           url: '<?php echo site_url('c_index/get_autocompleteEmployee/?');?>',
           type: "post",
           dataType: 'json',
           delay: 250,
           data: function (params) {
              return {
                searchTerm: params.term // search term
              };
           },
           processResults: function (response) {
              return {
                 results: response
              };
           },
		   success:function (response){
                console.log(response);
				$('[name="txt_name"]').val(response[0].fullname);
				$('[name="txt_designantion"]').val(response[0].designation);
				$('[name="txt_date"]').val(response[0].doj);
           },
           cache: true,
         },

    });

	// $('#datetimepicker2').datepicker({
    //     format: 'dd / mm / yyyy',
    //     startDate: '-3d'
    // });
</script>

<script>
	// tambah untuk menampilkan data dari field "_To"
	 $('#SelectManid').select2({
    //   theme: 'bootstrap4',
      minimumInputLength: 1,
      ajax: { 
           url: '<?php echo site_url('c_index/get_autocompleteManager/?');?>',
           type: "post",
           dataType: 'json',
           delay: 250,
           data: function (params) {
              return {
                searchTerm: params.term // search term
              };
           },
           processResults: function (response) {
              return {
                 results: response
              };
           },
		   success:function (response){
           },
           cache: true,
         },

    });

	// $('#datetimepicker2').datepicker({
    //     format: 'dd / mm / yyyy',
    //     startDate: '-3d'
    // });
</script>

<script>
	// tambah untuk menampilkan data dari field "_To"
	 $('#SelectCeoid').select2({
    //   theme: 'bootstrap4',
      minimumInputLength: 1,
      ajax: { 
           url: '<?php echo site_url('c_index/get_autocompleteCeo/?');?>',
           type: "post",
           dataType: 'json',
           delay: 250,
           data: function (params) {
              return {
                searchTerm: params.term // search term
              };
           },
           processResults: function (response) {
              return {
                 results: response
              };
           },
		   success:function (response){
           },
           cache: true,
         },

    });

	// $('#datetimepicker2').datepicker({
    //     format: 'dd / mm / yyyy',
    //     startDate: '-3d'
    // });
</script>

<script>
	// tambah untuk menampilkan data dari field "_To"
	 $('#SelectHrdid').select2({
    // theme: 'bootstrap4',
      minimumInputLength: 2,
      ajax: { 
           url: '<?php echo site_url('c_index/get_autocompleteHrd/?');?>',
           type: "post",
           dataType: 'json',
           delay: 250,
           data: function (params) {
              return {
                searchTerm: params.term // search term
              };
           },
           processResults: function (response) {
              return {
                 results: response
              };
           },
		   success:function (response){
                // console.log(response);
				// $('[name="txt_name"]').val(response[0].fullname);
				// $('[name="txt_designantion"]').val(response[0].designation);
				// $('[name="txt_date"]').val(response[0].doj);
           },
           cache: true,
         },

    });

	// $('#datetimepicker2').datepicker({
    //     format: 'dd / mm / yyyy',
    //     startDate: '-3d'
    // });
</script>

<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js" integrity="sha384-W8fXfP3gkOKtndU4JGtKDvXbO53Wy8SZCQHczT5FMiiqmQfUpWbYdTil/SxwZgAN" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.min.js" integrity="sha384-skAcpIdS7UcVUC05LJ9Dxay8AXcDYfBJqt1CJ85S/CFujBsIzCIv+l9liuYLaMQ/" crossorigin="anonymous"></script>

  </body>
</html>
