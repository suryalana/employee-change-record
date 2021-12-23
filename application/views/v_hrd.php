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
		<form class="" method='POST' action='c_index/simpan'>
        <table id="example" class="table table-striped table-bordered" style="width:100%">
      <thead>
	  	<div class="position-absolute top-20 end-4">
	  	<a href="<?= base_url('login'); ?>" class="btn btn-primary " style=" float: right;  margin-top: -20px;">Logout</a></div>
          <h3 class="text-center font-weight-bold" style="white-space:nowrap;" class="text-center" >Data ECR (Employee Change Record) </h3>
          <tr>
		  	  <th colspan='1' style="white-space:nowrap;" class="text-center" >Options</th>
			  <th colspan='1' style="white-space:nowrap;" class="text-center" >Name</th>
              <th colspan='1' style="white-space:nowrap;" class="text-center" >Employment ID</th>
			  <th colspan='1' style="white-space:nowrap;" class="text-center" >Designation</th>
              <th colspan='2' style="white-space:nowrap;" class="text-center" >Employment Status</th>
              <th colspan='2' style="white-space:nowrap;" class="text-center" >Department</th>
              <th colspan='2' style="white-space:nowrap;" class="text-center" >Division/ Section / Station</th>
              <th colspan='2' style="white-space:nowrap;" class="text-center" >Immediate Superior</th>
              <th colspan='2' style="white-space:nowrap;" class="text-center" >Designation</th>
			  <th colspan='2' style="white-space:nowrap;" class="text-center" >Basic Salary</th>
			  <th colspan='2' style="white-space:nowrap;" class="text-center" >Allowances Amount</th>
			  <th colspan='2' style="white-space:nowrap;" class="text-center" >Overtime Rate (Hourly Rate)</th>
			  <th colspan='2' style="white-space:nowrap;" class="text-center" >Others</th>
			  <th colspan='4' style="white-space:nowrap;" class="text-center" >Approve</th>
			  <th colspan='2' style="white-space:nowrap;" class="text-center" >Actions</th>
          </tr>
      </thead>
      <tbody>
        
        
       
          <tr data-bs-toggle="modal" data-bs-target="#exampleModalCenter">
		  	  <td></td>
			  <td></td>
			  <td></td>
			  <td></td>
		  	  <td nowrap align=center>Form</td>
              <td nowrap align=center>To</td>
              <td nowrap align=center>Form</td>
              <td nowrap align=center>To</td>
			  <td nowrap align=center>Form</td>
              <td nowrap align=center>To</td>
			  <td nowrap align=center>Form</td>
              <td nowrap align=center>To</td>
			  <td nowrap align=center>Form</td>
              <td nowrap align=center>To</td>
			  <td nowrap align=center>Form</td>
              <td nowrap align=center>To</td>
			  <td nowrap align=center>Form</td>
              <td nowrap align=center>To</td>
			  <td nowrap align=center>Form</td>
              <td nowrap align=center>To</td>
			  <td nowrap align=center>Form</td>
              <td nowrap align=center>To</td>
			  <td nowrap>Status Leader</td>
			  <td nowrap>Status Manager</td>
			  <td nowrap>Status HRD</td>
			  <td nowrap>Status GM</td>
			  <td colspan='2'>E/D/P</td>
          </tr>
		  <tr>
				<?php 
				function checkstatusmanager($d ,$id){
					$tmp = '';
					if($_SESSION['role'] != 'manager'){
						$tmp = "disabled = 'true'";
					}
					if($d != 'acc'){
						if ($d =='reject') {
							return  $d;
						}
						return  '<button type="button" id="'.$id  .'"class="btn btn-success btnrm" style="width"'.$tmp.'>
						<img src="https://img.icons8.com/external-kiranshastry-gradient-kiranshastry/30/000000/external-check-banking-and-finance-kiranshastry-gradient-kiranshastry.png"/>
						</button> <button type="button" id="'.$id  .'"class="btn btn-danger" '.$tmp.'>
						<img src="https://img.icons8.com/ios-filled/30/000000/x.png"/></button>';
					}
					
					else{
						return  $d;

					}
				}
				function checkstatushrd($d ,$id){
					$tmp = '';
					if($_SESSION['role'] != 'hrd'){
						$tmp = "disabled = 'true'";
					}
					if($d != 'acc' ){
						if ($d =='reject') {
							return  $d;
						}
						return  '<button type="button" id="'.$id  .'"class="btn btn-success btnh" style="width"'.$tmp.'>
						<img src="https://img.icons8.com/external-kiranshastry-gradient-kiranshastry/30/000000/external-check-banking-and-finance-kiranshastry-gradient-kiranshastry.png"/>
						</button> <button type="button" id="'.$id  .'" class="btn btn-danger btnrh" '.$tmp.'>
						<img src="https://img.icons8.com/ios-filled/30/000000/x.png"/></button>';
					}
					
					else{
						return  $d;

					}
				}
				function checkstatusceo($d ,$id){
					$tmp = '';
					if($_SESSION['role'] != 'ceo'){
						$tmp = "disabled = 'true'";
					}
					if($d != 'acc' ){
						if ($d =='reject') {
							return  $d;
						}
						return  '<button type="button" id="'.$id  .'"class="btn btn-success btnc" style="width"'.$tmp.'>
						<img src="https://img.icons8.com/external-kiranshastry-gradient-kiranshastry/30/000000/external-check-banking-and-finance-kiranshastry-gradient-kiranshastry.png"/>

						</button> <button type="button" id="'.$id  .'" class="btn btn-danger btnrc" '.$tmp.'>
						<img src="https://img.icons8.com/ios-filled/30/000000/x.png"/></button>';
					}
					
					else{
						return  $d;

					}
				}
				if (! empty($input)) {
				foreach ($input as $i) {
			echo "
						<td nowrap align=center>".$i->option."</td>
						<td nowrap align=center>".$i->Name."</td>
						<td nowrap align=center>".$i->Employee_ID."</td>
						<td nowrap align=center>".$i->Designantion."</td>
						<td nowrap align=center>".$i->Employment_Status."</td>
						<td nowrap align=center>".$i->Employment_Status_To."</td>
						<td nowrap align=center>".$i->Department."</td>
						<td nowrap align=center>".$i->Department_To."</td>
						<td nowrap align=center>".$i->Division_Section_Station."</td>
						<td nowrap align=center>".$i->Division_Section_Station_To."</td>
						<td nowrap align=center>".$i->Immediate_Superior."</td>
						<td nowrap align=center>".$i->Immediate_Superior_To."</td>
						<td nowrap align=center>".$i->Des."</td>
						<td nowrap align=center>".$i->Des_To."</td>
						<td nowrap align=center>".$i->Basic_Salary."</td>
						<td nowrap align=center>".$i->Basic_Salary_To."</td>
						<td nowrap align=center>".$i->Allowances_Amount."</td>
						<td nowrap align=center>".$i->Allowances_Amount_To."</td>
						<td nowrap align=center>".$i->Overtime_Rate."</td>
						<td nowrap align=center>".$i->Overtime_Rate_To."</td>
						<td nowrap align=center>".$i->Others."</td>
						<td nowrap align=center>".$i->Others_To."</td>
						<td nowrap align=center>".$i->request_img."</td>
						<td nowrap align=center>".checkstatusmanager($i->manager_img,$i->Employee_ID)."</td>
						<td nowrap align=center>".checkstatushrd($i->hrd_img,$i->Employee_ID)."</td>
						<td nowrap align=center>".checkstatusceo($i->ceo_img, $i->Employee_ID)."</td>
						<td nowrap>
							<a href='".base_url("ubah/".$i->id_erc)."'<button type='button' class='label label-info'>EDIT</button></a>
							<a href='".base_url("c_index/hapus/".$i->Employee_ID)."'<button type='button' class='label label-danger'>DELETE</button></a>
							<a href='".base_url("GeneratePdfController/index/".$i->Employee_ID)."'<button type='button' class='label label-dark'>PRINT</button></a>
						</td>
					</tr> ";
				}
			}else{
				echo"<td align='center' colspan='2'>EMPTY!</td>";
			}?>
			
		  
        </tbody>
     
  </table>
		</form>

	</div>

	<!-- Optional JavaScript; choose one of the two! -->

	<!--
		<td><a href='".base_url("c_menu/ubah/".$m->idmenu)."'<button type='button' class='btn btn-light'>EDIT</button></a>
		<a href='".base_url("c_menu/hapus/".$m->idmenu)."'><button type='button' class='btn btn-danger'>DELETE</button></a></td>
	-->

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
	<script>
					 $('.btnh').click(function(){ 
						var id=$(this).attr('id');
						var role='hrd';
						var type='acc';
						console.log(id);
						
						$.ajax({
							url: '<?php echo site_url('doaction');?>',
							method : "POST",
							data : {
									id: id,
									role: role,
									type: type
								},
							async : true,
							dataType : 'json',
							success: function(data){
								console.log(data);
							}
						});
						// return false;
					}); 
					$('.btnc').click(function(){ 
						var id=$(this).attr('id');
						var role='ceo';
						var type='acc';
						console.log(id);
						
						$.ajax({
							url: '<?php echo site_url('doaction');?>',
							method : "POST",
							data : {
									id: id,
									role: role,
									type: type
								},
							async : true,
							dataType : 'json',
							success: function(data){
								console.log(data);
							}
						});
						// return false;
					}); 
					$('.btnm').click(function(){ 
						var id=$(this).attr('id');
						var role='manager';
						var type='acc';
						console.log(id);
						
						$.ajax({
							url: '<?php echo site_url('doaction');?>',
							method : "POST",
							data : {
									id: id,
									role: role,
									type: type
								},
							async : true,
							dataType : 'json',
							success: function(data){
								console.log(data);
							}
						});
					}); 

					$('.btnrh').click(function(){ 
						var id=$(this).attr('id');
						var role='hrd';
						var type='reject';
						console.log(id);
						
						$.ajax({
							url: '<?php echo site_url('doaction');?>',
							method : "POST",
							data : {
									id: id,
									role: role,
									type: type
								},
							async : true,
							dataType : 'json',
							success: function(data){
								console.log(data);
							}
						});
						// return false;
					}); 
					$('.btnrc').click(function(){ 
						var id=$(this).attr('id');
						var role='ceo';
						var type='reject';
						console.log(id);
						
						$.ajax({
							url: '<?php echo site_url('doaction');?>',
							method : "POST",
							data : {
									id: id,
									role: role,
									type: type
								},
							async : true,
							dataType : 'json',
							success: function(data){
								console.log(data);
							}
						});
						// return false;
					}); 
					$('.btnrm').click(function(){ 
						var id=$(this).attr('id');
						var role='manager';
						var type='reject';
						console.log(id);
						
						$.ajax({
							url: '<?php echo site_url('doaction');?>',
							method : "POST",
							data : {
									id: id,
									role: role,
									type: type
								},
							async : true,
							dataType : 'json',
							success: function(data){
								console.log(data);
							}
						});
						// return false;
					}); 


				</script>
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

<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js" integrity="sha384-W8fXfP3gkOKtndU4JGtKDvXbO53Wy8SZCQHczT5FMiiqmQfUpWbYdTil/SxwZgAN" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.min.js" integrity="sha384-skAcpIdS7UcVUC05LJ9Dxay8AXcDYfBJqt1CJ85S/CFujBsIzCIv+l9liuYLaMQ/" crossorigin="anonymous"></script>

  </body>
</html>
