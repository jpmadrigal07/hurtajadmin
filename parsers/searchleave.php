<?php  
include_once("../include/loginstatus.php");

$output = '';
$count = 0; 

if(isset($_POST["search"])){
      if($_POST["search"] == ""){
      $text = "";
      $sql = "SELECT * FROM hurtajadmin_leave ORDER BY id DESC"; 
      $result = mysqli_query($db_conn, $sql);
      }else{
      $text = $_POST["search"];
      
      $sql = "SELECT hurtajadmin_employee.employee_fname, hurtajadmin_employee.employee_lname, hurtajadmin_employee.employee_mname, hurtajadmin_leave.employee_id, hurtajadmin_leave.leave_type, hurtajadmin_leave.leave_start, hurtajadmin_leave.leave_end, hurtajadmin_leave.leave_date,hurtajadmin_leave.leave_reason, hurtajadmin_leave.leave_remarks, hurtajadmin_leave.leave_status, hurtajadmin_leave.id FROM hurtajadmin_employee INNER JOIN hurtajadmin_leave 
    ON hurtajadmin_employee.employee_id = hurtajadmin_leave.employee_id WHERE (hurtajadmin_employee.employee_id LIKE '%".$text."%' OR hurtajadmin_employee.employee_fname LIKE '%".$text."%' OR hurtajadmin_employee.employee_mname LIKE '%".$text."%' OR hurtajadmin_employee.employee_lname LIKE '%".$text."%') ORDER BY hurtajadmin_leave.id DESC"; 
      $result = mysqli_query($db_conn, $sql);  
    }
}else if(isset($_POST["datepicker"])) {
      if($_POST["datepicker"] == ""){
      $text = "";
      $sql = "SELECT * FROM hurtajadmin_leave ORDER BY id DESC"; 
      $result = mysqli_query($db_conn, $sql);
      }else{
      $text = $_POST["datepicker"];
      $date = date("Y-m-d H:i:s",strtotime($text));
      $sql = "SELECT hurtajadmin_employee.employee_fname, hurtajadmin_employee.employee_lname, hurtajadmin_employee.employee_mname, hurtajadmin_leave.employee_id, hurtajadmin_leave.leave_type, hurtajadmin_leave.leave_start, hurtajadmin_leave.leave_end, hurtajadmin_leave.leave_date,hurtajadmin_leave.leave_reason, hurtajadmin_leave.leave_remarks, hurtajadmin_leave.leave_status, hurtajadmin_leave.id FROM hurtajadmin_employee INNER JOIN hurtajadmin_leave 
    ON hurtajadmin_employee.employee_id = hurtajadmin_leave.employee_id WHERE DATE(leave_date) = '$date' ORDER BY hurtajadmin_leave.id DESC";
 
      $result = mysqli_query($db_conn, $sql);  
      } 
}

if($text == "") {
  $output .= '
<table class="table table-bordered">
<thead>
<tr>
<th>Employee ID</th>
<th>Name</th>
<th>Date Filed</th>
<th>Status</th>
<th>Action</th>
</tr>
</thead>
<tbody>
  ';
  while($row = mysqli_fetch_array($result)) {  
    $count++; 
    $recid = $row["id"];
    $empid = $row["employee_id"];
    $ltype = $row["leave_type"];
    $ldate = $row["leave_date"];
    $lstart = $row["leave_start"];
    $lend = $row["leave_end"];
    $lreason = $row["leave_reason"];
    $lremarks = $row["leave_remarks"];
    $lstatus = $row["leave_status"];

    $editldate = date("F d, Y", strtotime($ldate));
    $editlstart = date("m/d/Y", strtotime($lstart));
    $editlend = date("m/d/Y", strtotime($lend));

    $sql_l = "SELECT * FROM hurtajadmin_employee WHERE employee_id = '$empid' ORDER BY id DESC";
    $query_l = mysqli_query($db_conn, $sql_l);
    while($rowl = mysqli_fetch_array($query_l)) {
      $lfname = $rowl["employee_fname"];
      $lmname = $rowl["employee_mname"];
      $llname = $rowl["employee_lname"];
    }

    $typetext = "";

    if($ltype == "1") {
      $typetext = "Sick";
    } else if($ltype == "2") {
      $typetext = "Vacation";
    }

    $statstext = "";
    $leave_link = "";

    if($lstatus == "1") {
      $statstext = "Pending";
      $leave_link = '<a href="javascript:void(0)" onclick="openLeaveViewDialog(\''.$recid.'\',\''.$editlstart.'\',\''.$editlend.'\',\''.$ltype.'\',\''.$lreason.'\',\''.$lfname.'\',\''.$lmname.'\',\''.$llname.'\',\''.$empid.'\',\''.$lstatus.'\')">Details</a> | <a href="javascript:void(0)" onclick="openLeaveRemarksDialog(\''.$recid.'\',\''.$lremarks.'\')">Remarks</a> | <a href="account.php?id='.$log_id.'&leave=focus&action=history&updatehistoryid='.$recid.'">Update History</a> | <a href="javascript:void(0)" onclick="openLeaveApproveDialog('.$recid.')">Approve</a> | <a href="javascript:void(0)"  onclick="openLeaveDeclineDialog('.$recid.')">Decline</a> | <a href="javascript:void(0)" onclick="openLeaveDeleteDialog('.$recid.')">Delete</a>';
    } else if($lstatus == "2") {
      $statstext = "Approved";
      $leave_link = '<a href="javascript:void(0)" onclick="openLeaveViewDialog(\''.$recid.'\',\''.$editlstart.'\',\''.$editlend.'\',\''.$ltype.'\',\''.$lreason.'\',\''.$lfname.'\',\''.$lmname.'\',\''.$llname.'\',\''.$empid.'\',\''.$lstatus.'\')">Details</a> | <a href="javascript:void(0)" onclick="openLeaveRemarksDialog(\''.$recid.'\',\''.$lremarks.'\')">Remarks</a> | <a href="account.php?id='.$log_id.'&leave=focus&action=history&updatehistoryid='.$recid.'">Update History</a> | <a href="javascript:void(0)" onclick="openLeaveDeleteDialog('.$recid.')">Delete</a>';
    } else if($lstatus == "3") {
      $statstext = "Declined";
      $leave_link = '<a href="javascript:void(0)" onclick="openLeaveViewDialog(\''.$recid.'\',\''.$editlstart.'\',\''.$editlend.'\',\''.$ltype.'\',\''.$lreason.'\',\''.$lfname.'\',\''.$lmname.'\',\''.$llname.'\',\''.$empid.'\',\''.$lstatus.'\')">Details</a> | <a href="javascript:void(0)" onclick="openLeaveRemarksDialog(\''.$recid.'\',\''.$lremarks.'\')">Remarks</a> | <a href="account.php?id='.$log_id.'&leave=focus&action=history&updatehistoryid='.$recid.'">Update History</a> | <a href="javascript:void(0)" onclick="openLeaveDeleteDialog('.$recid.')">Delete</a>';
    }

    $lmnameinitial = substr($lmname, 0, 1);

    $output .= '
    <tr>
    <td>'.$empid.'</td>
    <td>'.$lfname.' '.$lmnameinitial.'. '.$llname.'</td>
    <td>'.$editldate.'</td>       
    <td>'.$statstext.'</td>   
    <td>'.$leave_link.'</td>
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
    <th>Date Filed</th>
    <th>Status</th>
    <th>Action</th>
    </tr>
    </thead>
    <tbody>
    ';
    while($row = mysqli_fetch_array($result)) {  
    $count++; 
    $recid = $row["id"];
    $empid = $row["employee_id"];
    $ltype = $row["leave_type"];
    $ldate = $row["leave_date"];
    $lstart = $row["leave_start"];
    $lend = $row["leave_end"];
    $lreason = $row["leave_reason"];
    $lremarks = $row["leave_remarks"];
    $lstatus = $row["leave_status"];

    $editldate = date("F d, Y", strtotime($ldate));
    $editlstart = date("m/d/Y", strtotime($lstart));
    $editlend = date("m/d/Y", strtotime($lend));
    
    $sql_l = "SELECT * FROM hurtajadmin_employee WHERE employee_id = '$empid' ORDER BY id DESC";
    $query_l = mysqli_query($db_conn, $sql_l);
    while($rowl = mysqli_fetch_array($query_l)) {
      $lfname = $rowl["employee_fname"];
      $lmname = $rowl["employee_mname"];
      $llname = $rowl["employee_lname"];
    }

    $typetext = "";

    if($ltype == "1") {
      $typetext = "Sick";
    } else if($ltype == "2") {
      $typetext = "Vacation";
    }

    $statstext = "";
    $leave_link = "";

    if($lstatus == "1") {
      $statstext = "Pending";
      $leave_link = '<a href="javascript:void(0)" onclick="openLeaveViewDialog(\''.$recid.'\',\''.$editlstart.'\',\''.$editlend.'\',\''.$ltype.'\',\''.$lreason.'\',\''.$lfname.'\',\''.$lmname.'\',\''.$llname.'\',\''.$empid.'\',\''.$lstatus.'\')">Details</a> | <a href="javascript:void(0)" onclick="openLeaveRemarksDialog(\''.$recid.'\',\''.$lremarks.'\')">Remarks</a> | <a href="account.php?id='.$log_id.'&leave=focus&action=history&updatehistoryid='.$recid.'">Update History</a> | <a href="javascript:void(0)" onclick="openLeaveApproveDialog('.$recid.')">Approve</a> | <a href="javascript:void(0)"  onclick="openLeaveDeclineDialog('.$recid.')">Decline</a> | <a href="javascript:void(0)" onclick="openLeaveDeleteDialog('.$recid.')">Delete</a>';
    } else if($lstatus == "2") {
      $statstext = "Approved";
      $leave_link = '<a href="javascript:void(0)" onclick="openLeaveViewDialog(\''.$recid.'\',\''.$editlstart.'\',\''.$editlend.'\',\''.$ltype.'\',\''.$lreason.'\',\''.$lfname.'\',\''.$lmname.'\',\''.$llname.'\',\''.$empid.'\',\''.$lstatus.'\')">Details</a> | <a href="javascript:void(0)" onclick="openLeaveRemarksDialog(\''.$recid.'\',\''.$lremarks.'\')">Remarks</a> | <a href="account.php?id='.$log_id.'&leave=focus&action=history&updatehistoryid='.$recid.'">Update History</a> | <a href="javascript:void(0)" onclick="openLeaveDeleteDialog('.$recid.')">Delete</a>';
    } else if($lstatus == "3") {
      $statstext = "Declined";
      $leave_link = '<a href="javascript:void(0)" onclick="openLeaveViewDialog(\''.$recid.'\',\''.$editlstart.'\',\''.$editlend.'\',\''.$ltype.'\',\''.$lreason.'\',\''.$lfname.'\',\''.$lmname.'\',\''.$llname.'\',\''.$empid.'\',\''.$lstatus.'\')">Details</a> | <a href="javascript:void(0)" onclick="openLeaveRemarksDialog(\''.$recid.'\',\''.$lremarks.'\')">Remarks</a> | <a href="account.php?id='.$log_id.'&leave=focus&action=history&updatehistoryid='.$recid.'">Update History</a> | <a href="javascript:void(0)" onclick="openLeaveDeleteDialog('.$recid.')">Delete</a>';
    }

    $lmnameinitial = substr($lmname, 0, 1);

    $output .= '
    <tr>
    <td>'.$empid.'</td>
    <td>'.$lfname.' '.$lmnameinitial.'. '.$llname.'</td>
    <td>'.$editldate.'</td>       
    <td>'.$statstext.'</td>   
    <td>'.$leave_link.'</td>
    </tr>
    ';   

  }
  $output .= '
  </tbody>
  </table>
  ';
  echo $output;
} else {  
    echo '<h4 align="center">No results for <b>'.$text.'</b></h4>'; 
} 
}

?>  