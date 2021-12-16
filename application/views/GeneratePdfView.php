<base href="<?php echo base_url();?>">
<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="./assets/css/style.css">

    <title>Cladtek</title>
  </head>
  <body>
    <br>
    <div>
<form method='POST' action='c_index/simpan'>
    <h2>Employee Change Record</h2>
        <table>
		<td><input type="text" value='<?php echo $input->option?>'></td>
		 
		</table>
<br><br>
        <table>
            <tr>
                <td><label>Name</label></td>
                <td>:</td>
                <td><?php echo $input->Name;?></td>    
                <td><label>Date of Joining</label></td>
                <td>:</td>
                <td><?php echo $input->Date_of_Joining;?></td> 
            </tr> 
            <tr>
                <td><label>Employee ID</label></td>
                <td>:</td>
                <td><?php echo $input->Employee_ID;?></td>  
                <td><label>Effective Date of Change</label></td>
                <td>:</td>
				<td><?php echo $input->Effective_Date_of_Change;?></td> 
            </tr>
            <tr>
                <td><label>Designantion</label></td>
                <td>:</td>
                <td><?php echo $input->Designantion;?></td> 
                <td><label>Reason of Change</label></td>
                <td>:</td>
                <td><?php echo $input->Reason_for_Change;?></td>
            </tr>
        </table>
<br><br>
    <!-- Table Checkbox -->
        <table>
            <tr>
                <td>No</td>
                <td>Description</td>
                <td>From</td>
                <td>To</td>
            </tr>
            <tr>
                <td>1.</td>
                <td>Employment Status(i.e. Permanent/Contract/Other)</td>
                <td><?php echo $input->Employment_Status;?></td>
                <td><?php echo $input->Employment_Status_To;?></td>   
                
            </tr>
            <tr>
                <td>2.</td>
                <td>Department</td>
               <td><?php echo $input->Department;?></td> 
               <td><?php echo $input->Department_To;?></td> 
            </tr>
            <tr>
                <td>3.</td>   
                <td>Division/ Section / Station</td>
				<td><?php echo $input->Division_Section_Station;?></td> 
                <td><?php echo $input->Division_Section_Station_To;?></td> 
            </tr>
            <tr>
                <td>4.</td>                                                         
                <td>Immediate Superior</td>
				<td><?php echo $input->Immediate_Superior;?></td> 
                <td><?php echo $input->Immediate_Superior_To;?></td>
            </tr>
            <tr>
                <td>5.</td>
                <td>Designation *</td>
               <td><?php echo $input->Des;?></td> 
               <td><?php echo $input->Des_To;?></td>
            </tr>
            <tr>
                <td>6.</td>
                <td>Basic Salary *</td>
                <td><?php echo $input->Basic_Salary;?></td> 
                <td><?php echo $input->Basic_Salary_To;?></td>
            </tr>
            <tr>
                <td>7.</td>
                <td>Allowances  Amount *</td>
                <td><?php echo $input->Allowances_Amount;?></td> 
                <td><?php echo $input->Allowances_Amount_To;?></td>
            </tr>
            <tr>
                <td>8.</td>
                <td>Overtime Rate (Hourly Rate)</td>
                <td><?php echo $input->Overtime_Rate;?></td> 
                <td><?php echo $input->Overtime_Rate_To;?></td>
            </tr>
            <tr>
                <td>9.</td>
                <td>Others</td>
                <td><?php echo $input->Others;?></td>  
                <td><?php echo $input->Others_To;?></td>
            </tr>
        </table>
<br>
        <table>
            <tr>
                <td>Requested by a</td>
                <td>Agreed by <br> <b>Manager/HOD</b></td>
                <td>Reviewed by <br> <b>HRD</b></td>
                <td>Approved by <br> <b>General Manager/CEO</b></td>
            </tr>
            <tr>
                <td>
                    <p><?php echo $input->request_img;?></p>
                </td>
                <td>
                    <p> <?php echo $input->manager_img;?></p>
                </td>
                <td>
                    <p> <?php echo $input->hrd_img;?></p>
                </td>
                <td>
                    <p> <?php echo $input->ceo_img;?></p>
                </td>
            </tr>
        </table>
<br>
        <label >Remark</label><br>
        <textarea id="exampleFormControlTextarea1" value='<?php echo $input->Remark?>' rows="3" value name="txt_remark"></textarea>  
<br><br>
        <!-- <button n-primary">Submit</button> -->
</form>
    
</div>

    <!-- Optional JavaScript; choose one of the two! -->

    
	
	

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-/bQdsTh/da6pkI1MST/rWKFNjaCP5gBSY4sEBT38Q/9RBh9AH40zEOg7Hlq2THRZ" crossorigin="anonymous"></script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <script src="./assets/js/script.js"></script>
    <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
    <script>
		function myFunction() {
		var checkBox = document.getElementById("myCheck");
		var text = document.getElementById("text");
		if (checkBox.checked == true){
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

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js" integrity="sha384-W8fXfP3gkOKtndU4JGtKDvXbO53Wy8SZCQHczT5FMiiqmQfUpWbYdTil/SxwZgAN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.min.js" integrity="sha384-skAcpIdS7UcVUC05LJ9Dxay8AXcDYfBJqt1CJ85S/CFujBsIzCIv+l9liuYLaMQ/" crossorigin="anonymous"></script>

  </body>
</html>