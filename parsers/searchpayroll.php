<?php  
include_once("../include/loginstatus.php");

$output = '';
$count = 0; 

$text1 = $_POST["search1"];
$text2 = $_POST["search2"];

$text1 = date("Y-m-d H:i:s", strtotime($text1));
$text2 = date("Y-m-d H:i:s", strtotime($text2));

$sql = "SELECT DISTINCT payroll_payperiod_1, payroll_payperiod_2 FROM hurtajadmin_payroll WHERE payroll_status = '1' AND (payroll_payperiod_1 LIKE '%".$text1."%' OR payroll_payperiod_2 LIKE '%".$text2."%') ORDER BY id DESC"; 
$result = mysqli_query($db_conn, $sql);  

if($_POST["search1"] == "" || $_POST["search2"] == "") {
  $output .= '
  <table class="table table-striped">
  <thead>
  <tr>
  <th>#</th>
  <th>Pay Period</th>
  <th>Date Added</th>
  <th>Action</th>
  </tr>
  </thead>
  <tbody>
  ';
  while($row = mysqli_fetch_array($result)) {  
    $count++; 
    $payperiod1 = $row["payroll_payperiod_1"];
    $payperiod2 = $row["payroll_payperiod_2"];

    $sql1 = "SELECT * FROM hurtajadmin_payroll WHERE payroll_payperiod_1 = '$payperiod1' AND payroll_payperiod_2 = '$payperiod2' AND payroll_status = '1' LIMIT 1";
    $query1 = mysqli_query($db_conn, $sql1);

    while($row1 = mysqli_fetch_array($query1)) {
      $dateadded = $row1["payroll_date_added"];
    }  

    $payperiod1 = date("F d, Y", strtotime($payperiod1));
    $payperiod2 = date("F d, Y", strtotime($payperiod2));
    $dateadded = date("F d, Y", strtotime($dateadded));

    $output .= '
    <tr>
    <td>'.$count.'</td>
    <td>'.$payperiod1.' - '.$payperiod2.'</td>           
    <td>'.$dateadded.'</td>
    <td>More | Delete</td>
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
    <table class="table table-striped">
    <thead>
    <tr>
    <th>#</th>
    <th>Pay Period</th>
    <th>Date Added</th>
    <th>Action</th>
    </tr>
    </thead>
    <tbody>
    ';
    while($row = mysqli_fetch_array($result)) {  
     $count++; 
     $payperiod1 = $row["payroll_payperiod_1"];
    $payperiod2 = $row["payroll_payperiod_2"];

    $sql1 = "SELECT * FROM hurtajadmin_payroll WHERE payroll_payperiod_1 = '$payperiod1' AND payroll_payperiod_2 = '$payperiod2' AND payroll_status = '1' LIMIT 1";
    $query1 = mysqli_query($db_conn, $sql1);

    while($row1 = mysqli_fetch_array($query1)) {
      $dateadded = $row1["payroll_date_added"];
    }  

    $payperiod1 = date("F d, Y", strtotime($payperiod1));
    $payperiod2 = date("F d, Y", strtotime($payperiod2));
    $dateadded = date("F d, Y", strtotime($dateadded));

    $output .= '
    <tr>
    <td>'.$count.'</td>
    <td>'.$payperiod1.' - '.$payperiod2.'</td>           
    <td>'.$dateadded.'</td>
    <td>More | Delete</td>
    </tr>
    ';   

    }
    $output .= '
    </tbody>
    </table>
    ';
    echo $output;  
  } else {  
echo '<h4 align="center">No results for <b>'.$_POST["search1"].' - '.$_POST["search2"].'</b></h4>'; 
  } 
}

?>  