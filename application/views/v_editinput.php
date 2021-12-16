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

</head>
<?= form_open('ubah/'.$input[0]->id_erc); ?>
<h4> Id Employee : <?= $input[0]->Employee_ID; ?></h4>
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
						<option value="<?= $input[0]->Employment_Status; ?>"><?= $input[0]->Employment_Status; ?></option>
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
							<option value="<?= $input[0]->Employment_Status_To; ?>"><?= $input[0]->Employment_Status_To; ?></option>
							<?php
								if (! empty($status) ) {
									foreach ($status as $s) {
											if ($s->employee_status != $input[0]->Employment_Status_To) {
												echo "<option value=".$s->employee_status.">".$s->employee_status."</option>";
											}
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
						<option value="<?= $input[0]->Department; ?>"><?= $input[0]->departement; ?></option>
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
							<option value="<?= $input[0]->Department_To; ?>"><?= $input[0]->departement; ?></option>
							<?php
								if (! empty($departement)) {
									foreach ($departement as $d) {
										if ($d->id_departement != $input[0]->Department_To) {
												echo "<option value=".$d->id_departement.">".$d->departement."</option>";
											}
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
						<option value="<?= $input[0]->Division_Section_Station; ?>"><?= $input[0]->division; ?></option>
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
							<option value="<?= $input[0]->Division_Section_Station_To; ?>"><?= $input[0]->division; ?></option>
							<?php
								if (! empty($division)) {
									foreach ($division as $di) {
											if ($di->id_division != $input[0]->Division_Section_Station_To) {
												echo "<option value=".$di->division.">".$di->division."</option>";
											}
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
					<td><input class="form-control" type="text" name="txt_immediate" id="txt_immediate" value="<?= $input[0]->Immediate_Superior; ?>"></td>
					<td><input class="form-control" type="text" name="txt_immediate_to" id="txt_immediate_to" value="<?= $input[0]->Immediate_Superior_To; ?>"></td>
				</tr>
				<tr>
					<td><input class="form-check-input mt-0" type="checkbox"></td>
					<td>5. Designation *</td>
					<td><input class="form-control" type="text" name="txt_des" id="txt_des" value="<?= $input[0]->Designantion; ?>"></td>
					<td><input class="form-control" type="text" name="txt_des_to" id="txt_des_to" value="<?= $input[0]->Designantion; ?>"></td>
				</tr>
				<tr>
					<td><input class="form-check-input mt-0" type="checkbox"></td>
					<td>6. Basic Salary *</td>
					<td><input class="form-control" type="number" name="num_salary" id="num_salary" value="<?= $input[0]->Basic_Salary; ?>"></td>
					<td><input class="form-control" type="number" name="num_salary_to" id="num_salary_to" value="<?= $input[0]->Basic_Salary_To; ?>"></td>
				</tr>
				<tr>
					<td><input class="form-check-input mt-0" type="checkbox"></td>
					<td>7. Allowances Amount *</td>
					<td><input class="form-control" type="number" name="num_amount" id="num_amount" value="<?= $input[0]->Allowances_Amount; ?>"></td>
					<td><input class="form-control" type="number" name="num_amount_to" id="num_amount_to" value="<?= $input[0]->Allowances_Amount_To; ?>"></td>
				</tr>
				<tr>
					<td><input class="form-check-input mt-0" type="checkbox"></td>
					<td>8. Overtime Rate (Hourly Rate)</td>
					<td><input class="form-control" type="number" name="num_overtime" id="num_overtime" value="<?= $input[0]->Overtime_Rate; ?>"></td>
					<td><input class="form-control" type="number" name="num_overtime_to" id="num_overtime_to" value="<?= $input[0]->Overtime_Rate_To; ?>"></td>
				</tr>
				<tr>
					<td><input class="form-check-input mt-0" type="checkbox"></td>
					<td>9. Others</td>
					<td><input class="form-control" type="text" name="txt_other" id="txt_other" value="<?= $input[0]->Others; ?>"></td>
					<td><input class="form-control" type="text" name="txt_other_to" id="txt_other_to" value="<?= $input[0]->Others_To; ?>"></td>
				</tr>

			</table>

		<button class="btn btn-primary" name="btnUpdate">Save</button>
				</form>