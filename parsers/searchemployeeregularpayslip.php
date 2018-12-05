<?php  
include_once("../include/loginstatus.php");

$output = '';
$count = 0; 

$text = $_POST["search"];
$payslipid = $_POST["payslipid"];

$sql = "SELECT * FROM hurtajadmin_regular_payslip WHERE employee_id = '$text' AND regular_payslip_payslip_id = '$payslipid'";
$result = mysqli_query($db_conn, $sql);  

if($_POST["search"] == "") {

  $sql1 = "SELECT * FROM hurtajadmin_regular_payslip WHERE regular_payslip_payslip_id = '$payslipid'";
  $result1 = mysqli_query($db_conn, $sql1);  

  $output .= '
  <table class="table table-bordered">
  <thead>
  <tr>
  <th>Employee ID</th>
                                                <th>Name</th>
                                                <th>Basic Pay</th>
                                                <th>Overtime Pay</th>
                                                <th>Deductions</th>
                                                <th>Action</th>
  </tr>
  </thead>
  <tbody>
  ';
  while($row = mysqli_fetch_array($result1)) {  
    $count++; 
    $recid = $row["id"];
                                                    $month = $row["regular_payslip_date_cycle_month"];
                                                    $cycle = $row["regular_payslip_date_cycle_cycle"];
                                                    $year = $row["regular_payslip_date_cycle_year"];
                                                    $employee_id = $row["employee_id"];
                                                    $basicpay = $row["regular_payslip_basic_pay"];
                                                    $overtimepay = $row["regular_payslip_overtime_pay"];
                                                    $taxcont = $row["regular_payslip_tax_cont"];
                                                    $pagibigcont = $row["regular_payslip_pagibig_cont"];
                                                    $ssscont = $row["regular_payslip_sss_cont"];
                                                    $philhealthcont = $row["regular_payslip_philhealth_cont"];
                                                    $datecreated = $row["regular_payslip_date_created"];
                                                    $status = $row["regular_payslip_status"];

                                                    $sql_emp = "SELECT * FROM hurtajadmin_employee WHERE employee_id = '$employee_id' LIMIT 1";
                                                    $query_emp = mysqli_query($db_conn, $sql_emp);

                                                    while($row_emp = mysqli_fetch_array($query_emp)) {
                                                        $lmnameinitial = substr($row_emp["employee_mname"], 0, 1);
                                                        $empfullname = $row_emp["employee_fname"].' '.$lmnameinitial.'. '.$row_emp["employee_lname"];
                                                    }

    $output .= '
    <tr>
                                                            <td>'.$employee_id.'</td>
                                                            <td>'.$empfullname.'</td>
                                                            <td>₱'.number_format($basicpay, 2, '.', ',').'</td>
                                                            <td>₱'.number_format($overtimepay, 2, '.', ',').'</td>
                                                            <td><a href="javascript:void(0)" onclick="showModalViewDeduction(\''.$taxcont.'\',\''.$pagibigcont.'\',\''.$ssscont.'\',\''.$philhealthcont.'\');">View</a></td>
                                                            <td><a href="payslip.php?payslipid='.$payslipid.'&type=1&empid='.$employee_id.'" target="_blank">Print This</a></td>
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
    <th>Employee ID</th>
                                                <th>Name</th>
                                                <th>Basic Pay</th>
                                                <th>Overtime Pay</th>
                                                <th>Deductions</th>
                                                <th>Action</th>
    </tr>
    </thead>
    <tbody>
    ';
    while($row = mysqli_fetch_array($result)) {  
     $count++; 
     $recid = $row["id"];
                                                    $month = $row["regular_payslip_date_cycle_month"];
                                                    $cycle = $row["regular_payslip_date_cycle_cycle"];
                                                    $year = $row["regular_payslip_date_cycle_year"];
                                                    $employee_id = $row["employee_id"];
                                                    $basicpay = $row["regular_payslip_basic_pay"];
                                                    $overtimepay = $row["regular_payslip_overtime_pay"];
                                                    $taxcont = $row["regular_payslip_tax_cont"];
                                                    $pagibigcont = $row["regular_payslip_pagibig_cont"];
                                                    $ssscont = $row["regular_payslip_sss_cont"];
                                                    $philhealthcont = $row["regular_payslip_philhealth_cont"];
                                                    $datecreated = $row["regular_payslip_date_created"];
                                                    $status = $row["regular_payslip_status"];

                                                    $sql_emp = "SELECT * FROM hurtajadmin_employee WHERE employee_id = '$employee_id' LIMIT 1";
                                                    $query_emp = mysqli_query($db_conn, $sql_emp);

                                                    while($row_emp = mysqli_fetch_array($query_emp)) {
                                                        $lmnameinitial = substr($row_emp["employee_mname"], 0, 1);
                                                        $empfullname = $row_emp["employee_fname"].' '.$lmnameinitial.'. '.$row_emp["employee_lname"];
                                                    }

     $output .= '
     <tr>
                                                            <td>'.$employee_id.'</td>
                                                            <td>'.$empfullname.'</td>
                                                            <td>₱'.number_format($basicpay, 2, '.', ',').'</td>
                                                            <td>₱'.number_format($overtimepay, 2, '.', ',').'</td>
                                                            <td><a href="javascript:void(0)" onclick="showModalViewDeduction(\''.$taxcont.'\',\''.$pagibigcont.'\',\''.$ssscont.'\',\''.$philhealthcont.'\');">View</a></td>
                                                            <td><a href="payslip.php?payslipid='.$payslipid.'&type=1&empid='.$employee_id.'" target="_blank">Print This</a></td>
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