<!DOCTYPE html>
<html>
<head>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta charset="utf-8">
    <title>PT. Cladtek </title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" type="text/css" rel="stylesheet" />
</head>
<body>
<h1 class="text-center bg-info">Employee Change Record</h1>
<table class="table table-striped table-hover">
    
    <tbody>
        
        <tr>
            <td><?= $emp[0]->option; ?> </td>
            <td><?= $emp[0]->Name; ?> </td>
            <td><?= $emp[0]->Employee_ID; ?> </td>
        </tr>
        <tr>
            <td><?= $emp[0]->Designantion; ?> </td>
            <td><?= $emp[0]->Effective_Date_of_Change; ?> </td>
            <td><?= $emp[0]->Reason_for_Change; ?> </td>
        </tr>
        <tr>
            <td><?= $emp[0]->Employment_Status; ?> </td>
        </tr>
        <tr>
            <td><?= $emp[0]->Department; ?> </td>
        </tr>
        <tr>
            <td><?= $emp[0]->Division_Section_Station; ?> </td>
        </tr>
        <tr>
            <td><?= $emp[0]->Department; ?> </td>
        </tr>
        <tr>
            <td><?= $emp[0]->Division_Section_Station; ?> </td>
        </tr>
        <tr>
            <td><?= $emp[0]->Immediate_Superior; ?> </td>
        </tr>
        <tr>
            <td><?= $emp[0]->Des; ?> </td>
        </tr>
        <tr>
            <td><?= $emp[0]->Basic_Salary; ?> </td>
        </tr>
        <tr>
            <td><?= $emp[0]->Allowances_Amount; ?> </td>
        </tr>
        <tr>
            <td><?= $emp[0]->Overtime_Rate; ?> </td>
        </tr>
        <tr>
            <td><?= $emp[0]->Others; ?> </td>
        </tr>
        
        <tbody>
</table>
</body>
</html>