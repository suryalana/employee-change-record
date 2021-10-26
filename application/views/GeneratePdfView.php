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
        <h2 >Employee Change Record</h2>
            <select class="form-select" name="ops_employee">
                <?php if (! empty($input)) {
                    foreach ($input as $n) {
                        echo "
                            <option value=".$n->option.">".$n->option."</option>";
                            }
                        }else{
                    echo"<option>EMPTY!</option>";
                }?>
            </select>
<br><br>
        <table>
            <tr>
                <td><label for="">Name</label></td>
                <td>:</td>
                <?php if (! empty($input)) {
                    foreach ($input as $n) {
                        echo "
                            <td><input value=".$n->Name."></td>";
                            }
                        }else{
                    echo"<td align='center'>EMPTY!</td>";
                }?>
                <td><label for="">Date of Joining</label></td>
                <td>:</td>
                <?php if (! empty($input)) {
                    foreach ($input as $n) {
                        echo "
                            <td><input value=".$n->Date_of_Joining."></td>";
                            }
                        }else{
                    echo"<td align='center'>EMPTY!</td>";
                }?>
            </tr>
            <tr>
                <td><label for="">Employee ID</label></td>
                <td>:</td>
                <?php if (! empty($input)) {
                    foreach ($input as $n) {
                        echo "
                            <td><input value=".$n->Employee_ID."></td>";
                            }
                        }else{
                    echo"<td align='center'>EMPTY!</td>";
                }?>
                <td><label for="">Effective Date of Change</label></td>
                <td>:</td>
                <?php if (! empty($input)) {
                    foreach ($input as $n) {
                        echo "
                            <td><input value=".$n->Effective_Date_of_Change."></td>";
                            }
                        }else{
                    echo"<td align='center'>EMPTY!</td>";
                }?>
            </tr>
            <tr>
                <td><label for="">Designantion</label></td>
                <td>:</td>
                <?php if (! empty($input)) {
                    foreach ($input as $n) {
                        echo "
                            <td><input value=".$n->Designantion."></td>";
                            }
                        }else{
                    echo"<td align='center'>EMPTY!</td>";
                }?>
                <td><label for="">Reason of Change</label></td>
                <td>:</td>
                <?php if (! empty($input)) {
                    foreach ($input as $n) {
                        echo "
                            <td><input value=".$n->Reason_for_Change."></td>";
                            }
                        }else{
                    echo"<td align='center'>EMPTY!</td>";
                }?>
            </tr>
        </table>
<br><br>
    <!-- Table Checkbox -->
        <table>
            <tr>
                <td>Tick</td>
                <td>Description</td>
                <td>From</td>
                <td>To</td>
            </tr>
            <tr>
                <td><input type="checkbox"></td>
                <td>1.  Employment Status(i.e. Permanent/Contract/Other)</td>
                <?php if (! empty($input)) {
                    foreach ($input as $n) {
                        echo "
                            <td><input value=".$n->Employment_Status."></td>";
                            }
                        }else{
                    echo"<td align='center'>EMPTY!</td>";
                }?>
                <td><input type="text" name=""></td>
            </tr>
            <tr>
                <td><input type="checkbox"></td>
                <td>2.  Department</td>
                <?php if (! empty($input)) {
                    foreach ($input as $n) {
                        echo "
                            <td><input value=".$n->Department."></td>";
                            }
                        }else{
                    echo"<td align='center'>EMPTY!</td>";
                }?>
                <td><input type="text" name=""></td>
            </tr>
            <tr>
                <td><input type="checkbox"></td>
                <td>3.  Division/ Section / Station</td>
                <?php if (! empty($input)) {
                    foreach ($input as $n) {
                        echo "
                            <td><input value=".$n->Division_Section_Station."></td>";
                            }
                        }else{
                    echo"<td align='center'>EMPTY!</td>";
                }?>
                <td><input type="text" name=""></td>
            </tr>
            <tr>
                <td><input type="checkbox"></td>
                <td>4.  Immediate Superior</td>
                <?php if (! empty($input)) {
                    foreach ($input as $n) {
                        echo "
                            <td><input value=".$n->Immediate_Superior."></td>";
                            }
                        }else{
                    echo"<td align='center'>EMPTY!</td>";
                }?>
                <td><input type="text" name=""></td>
            </tr>
            <tr>
                <td><input type="checkbox"></td>
                <td>5.  Designation *</td>
                <?php if (! empty($input)) {
                    foreach ($input as $n) {
                        echo "
                            <td><input value=".$n->Des."></td>";
                            }
                        }else{
                    echo"<td align='center'>EMPTY!</td>";
                }?>
                <td><input type="text" name=""></td>
            </tr>
            <tr>
                <td><input type="checkbox"></td>
                <td>6.  Basic Salary *</td>
                <?php if (! empty($input)) {
                    foreach ($input as $n) {
                        echo "
                            <td><input value=".$n->Basic_Salary."></td>";
                            }
                        }else{
                    echo"<td align='center'>EMPTY!</td>";
                }?>
                <td><input type="number" name=""></td>
            </tr>
            <tr>
                <td><input type="checkbox"></td>
                <td>7.  Allowances  Amount *</td>
                <?php if (! empty($input)) {
                    foreach ($input as $n) {
                        echo "
                            <td><input value=".$n->Allowances_Amount."></td>";
                            }
                        }else{
                    echo"<td align='center'>EMPTY!</td>";
                }?>
                <td><input type="number" name=""></td>
            </tr>
            <tr>
                <td><input type="checkbox"></td>
                <td>8.  Overtime Rate (Hourly Rate)</td>
                <?php if (! empty($input)) {
                    foreach ($input as $n) {
                        echo "
                            <td><input value=".$n->Overtime_Rate."></td>";
                            }
                        }else{
                    echo"<td align='center'>EMPTY!</td>";
                }?>
                <td><input type="number" name=""></td>
            </tr>
            <tr>
                <td><input type="checkbox"></td>
                <td>9.  Others</td>
                <?php if (! empty($input)) {
                    foreach ($input as $n) {
                        echo "
                            <td><input value=".$n->Others."></td>";
                            }
                        }else{
                    echo"<td align='center'>EMPTY!</td>";
                }?>
                <td><input type="text" name=""></td>
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
                    <input type='file' onchange="readURL(this);" />
                    <img id="blah" alt="" />
                    <input name="cek_acc" id="myCheck" value="acc" type="checkbox" onclick="myFunction()">
                    <p id="text" style="display:none">APPROVE!</p>
                </td>
                <td>
                    <input type='file' onchange="readURL(this);" />
                    <img id="blah" alt="" />
                    <input name="cek_acc1" id="myCheck2" value="acc" type="checkbox" onclick="myFunction2()">
                    <p id="text2" style="display:none">APPROVE!</p>
                </td>
                <td>
                    <input type='file' onchange="readURL(this);" />
                    <img id="blah" alt="" />
                    <input name="cek_acc2" id="myCheck3" value="acc" type="checkbox" onclick="myFunction3()">
                    <p id="text3" style="display:none">APPROVE!</p>
                </td>
                <td>
                    <input type='file' onchange="readURL(this);" />
                    <img id="blah" alt="" />
                    <input name="cek_acc3" id="myCheck4" value="acc" type="checkbox" onclick="myFunction4()">
                    <p id="text4" style="display:none">APPROVE!</p>
                </td>
            </tr>
        </table>
<br>
        <label for="">Remark</label><br>
        <textarea id="exampleFormControlTextarea1" rows="3" name="txt_remark"></textarea>  
<br><br>
        <!-- <button n-primary">Submit</button> -->
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