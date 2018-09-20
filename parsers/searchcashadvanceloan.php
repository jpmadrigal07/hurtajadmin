<?php  
include_once("../include/loginstatus.php");

$output = '';
$count = 0; 

$text = $_POST["search"];

$sql = "SELECT * FROM hurtajadmin_cash_loan_advance WHERE cash_loan_advance_status = '1' AND employee_id LIKE '%".$text."%' ORDER BY id DESC";

$result = mysqli_query($db_conn, $sql);  

if($_POST["search"] == "") {
  $output .= '
  <table class="table table-bordered">
  <thead>
  <tr>
  <th>#</th>
  <th>Employee ID</th>
  <th>Name</th>
  <th>Type</th>
  <th>Amount</th>
  <th>Date</th>
  <th>Action</th>
  </tr>
  </thead>
  <tbody>
  ';
  while($row = mysqli_fetch_array($result)) {  
    $count++; 
     $recid = $row["id"];
     $empid = $row["employee_id"];
     $type = $row["cash_loan_advance_type"];
     $amount = $row["cash_loan_advance_amount"];
     $date = $row["cash_loan_advance_date"];
     $newDate = date("F d, Y H:i A", strtotime($date));

     $sql1 = "SELECT * FROM hurtajadmin_employee WHERE employee_id = '$empid' LIMIT 1";
     $query1 = mysqli_query($db_conn, $sql1);;
     while($row1 = mysqli_fetch_array($query1)) {  
      $fname = $row1["employee_fname"];
      $mname = $row1["employee_mname"];
      $lname = $row1["employee_lname"];
     }

     $mnameinitial = substr($mname, 0, 1);

     $typetext = "";

     if($type == "1") {
      $typetext = "Loan";
     } else if($type == "2") {
      $typetext = "Advance";
     }

    $output .= '
    <tr>
     <td>'.$count.'</td>
     <td>'.$empid.'</td>           
     <td>'.$fname.' '.$mname.'. '.$lname.'</td>
     <td>'.$typetext.'</td>
     <td>₱'.number_format($amount, 2, '.', ',').'</td>
     <td>'.$newDate.'</td>
     <td><a href="javascript:void(0)" onclick="openCashLoanAdvanceEditDialog('.$recid.',\''.$empid.'\',\''.$type.'\',\''.$amount.'\')">Edit</a> | <a href="javascript:void(0)" onclick="openCashLoanAdvanceDeleteDialog('.$recid.')">Delete</a></td>
     </tr>
    ';   

  }
  $output .= '
  </tbody>
  </table>
  ';
  echo $output;  
} else {
  if(mysqli_num_rows($result) > 0) {  
    $output .= '
    <table class="table table-bordered">
    <thead>
    <tr>
    <th>#</th>
    <th>Employee ID</th>
    <th>Name</th>
    <th>Type</th>
    <th>Amount</th>
    <th>Date</th>
    <th>Action</th>
    </tr>
    </thead>
    <tbody>
    ';
    while($row = mysqli_fetch_array($result)) {  
     $count++; 
     $recid = $row["id"];
     $empid = $row["employee_id"];
     $type = $row["cash_loan_advance_type"];
     $amount = $row["cash_loan_advance_amount"];
     $date = $row["cash_loan_advance_date"];
     $newDate = date("F d, Y H:i A", strtotime($date));

     $sql1 = "SELECT * FROM hurtajadmin_employee WHERE employee_id = '$empid' LIMIT 1";
     $query1 = mysqli_query($db_conn, $sql1);;
     while($row1 = mysqli_fetch_array($query1)) {  
      $fname = $row1["employee_fname"];
      $mname = $row1["employee_mname"];
      $lname = $row1["employee_lname"];
     }

     $mnameinitial = substr($mname, 0, 1);

     $typetext = "";

     if($type == "1") {
      $typetext = "Loan";
     } else if($type == "2") {
      $typetext = "Advance";
     }

     $output .= '
     <tr>
     <td>'.$count.'</td>
     <td>'.$empid.'</td>           
     <td>'.$fname.' '.$mname.'. '.$lname.'</td>
     <td>'.$typetext.'</td>
     <td>₱'.number_format($amount, 2, '.', ',').'</td>
     <td>'.$newDate.'</td>
     <td><a href="javascript:void(0)" onclick="openCashLoanAdvanceEditDialog('.$recid.',\''.$empid.'\',\''.$type.'\',\''.$amount.'\')">Edit</a> | <a href="javascript:void(0)" onclick="openCashLoanAdvanceDeleteDialog('.$recid.')">Delete</a></td>
     </tr>
     ';   

   }
   $output .= '
   </tbody>
   </table>
   ';
   echo $output;  
 } else {  
  echo '<h4 align="center">No results for <b>'.$_POST["search"].'</b></h4>'; 
} 
}

?>  