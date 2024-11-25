<base href="<?php echo base_url(); ?>">
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
	<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.css">
	<script type="text/javascript" charset="utf8" src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
	<script type="text/javascript" charset="utf8"
		src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.js"></script>

	<title>Cladtek</title>
</head>



<body>
	<br>
	<div class="container-fluid">
		<form class="" method='POST' action='c_index/simpan'>
			<div class="position-absolute top-20 end-4">
				<a href="<?= base_url('login'); ?>" class="btn btn-primary "
					style=" float: right;  margin-top: -20px;">Back</a>
			</div>
			<h3 class="text-center font-weight-bold" style="white-space:nowrap;" class="text-center">Data ECR (Employee
				Change Record) </h3>
			<table id="inputsTable" class="display">
				<thead>
					<tr>
						<th colspan="16">
							<div class="position-absolute top-20 end-4"></div>
							<h3 class="text-center font-weight-bold" style="white-space:nowrap;">Data ECR (Employee
								Change Record)</h3>
						</th>
					</tr>
					<tr>
						<th>Options</th>
						<th>Name</th>
						<th>Employment ID</th>
						<th>Designation</th>
						<th colspan="2" class="text-center">Employment Status</th>
						<th colspan="2" class="text-center">Department</th>
						<th colspan="2" class="text-center">Division/ Section / Station</th>
						<th colspan="2" class="text-center">Immediate Superior</th>
						<th colspan="2" class="text-center">Designation</th>
						<th colspan="2" class="text-center">Basic Salary</th>
						<th colspan="2" class="text-center">Allowances Amount</th>
						<th colspan="2" class="text-center">Overtime Rate (Hourly Rate)</th>
						<th colspan="2">Others</th>
						<th colspan="4" class="text-center">Approve</th>
						<th>Actions</th>
					</tr>
					<tr>
						<th colspan="4"></th>
						<th> From</th>
						<th> To</th>
						<th> From</th>
						<th> To</th>
						<th> From</th>
						<th> To</th>
						<th> From</th>
						<th> To</th>
						<th> From</th>
						<th> To</th>
						<th> From</th>
						<th> To</th>
						<th> From</th>
						<th> To</th>
						<th> From</th>
						<th> To</th>
						<th> From</th>
						<th> To</th>
						<th>Requestor</th>
						<th>Manager</th>
						<th>HRD</th>
						<th>GM</th>
						<th></th>
					</tr>
				</thead>
				<tbody>

				</tbody>
			</table>
		</form>

	</div>

	<!-- Option 1: Bootstrap Bundle with Popper -->
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js"
		integrity="sha384-/bQdsTh/da6pkI1MST/rWKFNjaCP5gBSY4sEBT38Q/9RBh9AH40zEOg7Hlq2THRZ"
		crossorigin="anonymous"></script>

	<!-- Option 2: Separate Popper and Bootstrap JS -->
	<script src="./assets/js/script.js"></script>

	<script>
		$(document).ready(function () {
			$('#inputsTable').DataTable({
				"ajax": {
					"url": "<?php echo site_url('c_index/getHRDData'); ?>",
					"dataSrc": ""
				},
				"columns": [
					{ "data": "option" },
					{ "data": "Name" },
					{ "data": "Employee_ID" },
					{ "data": "Designantion" },
					{ "data": "Employment_Status" },
					{ "data": "Employment_Status_To" },
					{ "data": "Department" },
					{ "data": "Department_To" },
					{ "data": "Division_Section_Station" },
					{ "data": "Division_Section_Station_To" },
					{ "data": "Immediate_Superior" },
					{ "data": "Immediate_Superior_To" },
					{ "data": "Des" },
					{ "data": "Des_To" },
					{ "data": "Basic_Salary" },
					{ "data": "Basic_Salary_To" },
					{ "data": "Allowances_Amount" },
					{ "data": "Allowances_Amount_To" },
					{ "data": "Overtime_Rate" },
					{ "data": "Overtime_Rate_To" },
					{ "data": "Others" },
					{ "data": "Others_To" },
					{
						"data": "request_img",
					},
					{
						"data": "manager_img",
						"render": function (data, type, row) {
							if ("<?php echo $_SESSION['role']; ?>" !== "manager") {
								return '-';
							} else {
								return data ? data : `
								<div id="btnActionMng${row.id_erc}"  style="display:flex; align-items:center; gap: 2px;">
									<button type="button" id="${row.id_erc}" onclick="handleClick('acc', ${row.id_erc})" class="btn btn-success btnh" style="width">
										<i class="bi bi-check-circle"></i>
									</button>
									<button type="button" id="${row.id_erc}" onclick="handleClick('reject', ${row.id_erc})" class="btn btn-danger btnrh" style="width">
										<i class="bi bi-x-circle"></i>
									</button>
								</div>`;
							}
						}
					},
					{
						"data": "hrd_img",
						"render": function (data, type, row) {
							if ("<?php echo $_SESSION['role']; ?>" !== "hrd") {
								return '-';
							} else {
								return data ? data : `
								<div id="btnActionHrd${row.id_erc}"  style="display:flex; align-items:center; gap: 2px;">
									<button type="button" id="${row.id_erc}" onclick="handleClick('acc', ${row.id_erc})" class="btn btn-success btnh" style="width">
										<i class="bi bi-check-circle"></i>
									</button>
									<button type="button" id="${row.id_erc}" onclick="handleClick('reject', ${row.id_erc})" class="btn btn-danger btnrh" style="width">
										<i class="bi bi-x-circle"></i>
									</button>
								</div>`;
							}
						}
					},
					{
						"data": "ceo_img",
						"render": function (data, type, row) {
							if ("<?php echo $_SESSION['role']; ?>" !== "ceo") {
								return '-';
							} else {
								return data ? data : `
								<div id="btnActionCeo${row.id_erc}"  style="display:flex; align-items:center; gap: 2px;">
									<button type="button" id="${row.id_erc}" onclick="handleClick('acc', ${row.id_erc})" class="btn btn-success btnh" style="width">
										<i class="bi bi-check-circle"></i>
									</button>
									<button type="button" id="${row.id_erc}" onclick="handleClick('reject', ${row.id_erc})" class="btn btn-danger btnrh" style="width">
										<i class="bi bi-x-circle"></i>
									</button>
								</div>`;
							}
						}
					},
					{
						"data": null,
						"render": function (data, type, row) {
							if (row.manager_img != null && row.hrd_img != null && row.ceo_img != null) {
								return "-";
							} else {
								return `<button onclick="window.location.href='${"<?php echo base_url('ubah/'); ?>" + row.id_erc}'" type='button' class='label label-info'>EDIT</button>
								<button onclick="window.location.href='${"<?php echo base_url('c_index/hapus/'); ?>" + row.Employee_ID}'" type='button' class='label label-danger'>DELETE</button>
								<button onclick="window.location.href='${"<?php echo base_url('GeneratePdfController/index/'); ?>" + row.Employee_ID}'" type='button' class='label label-dark'>PRINT</button>`;
							}
						}
					},
				]
			});
		});
	</script>
	<!-- Option 1: Bootstrap Bundle with Popper -->
</body>

<script>

	function handleClick(type, id_ecr) {
		var id = $(this).attr('id');
		var role = '<?php echo $_SESSION['role']; ?>';
		console.log('id_ecr : ', id_ecr);
		console.log('role : ', role);

		try {
			$.ajax({
				url: '<?php echo site_url('doaction'); ?>',
				method: "POST",
				data: {
					id: id_ecr,
					role: role,
					type: type
				},
				dataType: 'json',
				success: function (response) {
					console.log(response);
					if (response.status == 'success') {
						location.reload();
					} else {
						alert(response.message);
					}
				},
				error: function (xhr, status, error) {
					console.error("AJAX Error: ", error); // Log any AJAX errors
					alert("Error: " + error);
				}
			});

		} catch (error) {
			console.error("AJAX Error: ", error); // Log any AJAX errors
			location.reload();
		}
	}
</script>

</html>