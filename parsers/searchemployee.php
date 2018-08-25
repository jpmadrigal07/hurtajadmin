<?php  
include_once("../include/loginstatus.php");

$output = '';
$count = 0; 

$text = $_POST["search"];

$sql = "SELECT * FROM hurtajadmin_employee WHERE employee_status = '1' AND employee_name LIKE '%".$text."%' ORDER BY id DESC"; 
$result = mysqli_query($db_conn, $sql);  

if($_POST["search"] == "") {
  $output .= '
  <table class="table table-striped">
  <thead>
  <tr>
  <th>#</th>
  <th>Name</th>
  <th>Gender</th>
  <th>Date of Birth</th>
  <th>Phone</th>
  <th>Address</th>
  <th>Date Hired</th>
  <th>Action</th>
  </tr>
  </thead>
  <tbody>
  ';
  while($row = mysqli_fetch_array($result)) {  
    $count++; 
    $recid = $row["id"];
    $name = $row["employee_name"];
    $gender = $row["employee_gender"];
    $birthday = $row["employee_birthday"];
    $address = $row["employee_address"];
    $contact = $row["employee_phone"];
    $datehired = $row["employee_date_hired"];

    $editbirthday = date("m/d/Y", strtotime($birthday));
    $editdatehired = date("m/d/Y", strtotime($datehired));

    $birthday = date("F d, Y", strtotime($birthday));
    $datehired = date("F d, Y", strtotime($datehired));
    
    $gendertext = "";

    if($gender == "1") {
      $gendertext = "Male";
    } else if($gender == "2") {
      $gendertext = "Female";
    }

    $output .= '
    <tr>
    <td>'.$count.'</td>
    <td>'.$name.'</td>           
    <td>'.$gendertext.'</td>
    <td>'.$birthday.'</td>
    <td>'.$address.'</td>
    <td>'.$contact.'</td>
    <td>'.$datehired.'</td>
    <td><a href="javascript:void(0)" onclick="openEmployeeEditDialog('.$recid.',\''.$name.'\',\''.$gender.'\',\''.$editbirthday.'\',\''.$address.'\',\''.$contact.'\',\''.$editdatehired.'\')">Edit</a> | <a href="javascript:void(0)" onclick="openEmployeeDeleteDialog('.$recid.')">Delete</a></td>
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
    <th>Name</th>
    <th>Gender</th>
    <th>Date of Birth</th>
    <th>Phone</th>
    <th>Address</th>
    <th>Date Hired</th>
    <th>Action</th>
    </tr>
    </thead>
    <tbody>
    ';
    while($row = mysqli_fetch_array($result)) {  
     $count++; 
     $recid = $row["id"];
     $name = $row["employee_name"];
     $gender = $row["employee_gender"];
     $birthday = $row["employee_birthday"];
     $address = $row["employee_address"];
     $contact = $row["employee_phone"];
     $datehired = $row["employee_date_hired"];

     $editbirthday = date("m/d/Y", strtotime($birthday));
     $editdatehired = date("m/d/Y", strtotime($datehired));

     $birthday = date("F d, Y", strtotime($birthday));
     $datehired = date("F d, Y", strtotime($datehired));
     
     $gendertext = "";

     if($gender == "1") {
      $gendertext = "Male";
    } else if($gender == "2") {
      $gendertext = "Female";
    }

    $output .= '
    <tr>
    <td>'.$count.'</td>
    <td>'.$name.'</td>           
    <td>'.$gendertext.'</td>
    <td>'.$birthday.'</td>
    <td>'.$address.'</td>
    <td>'.$contact.'</td>
    <td>'.$datehired.'</td>
    <td><a href="javascript:void(0)" onclick="openEmployeeEditDialog('.$recid.',\''.$name.'\',\''.$gender.'\',\''.$editbirthday.'\',\''.$address.'\',\''.$contact.'\',\''.$editdatehired.'\')">Edit</a> | <a href="javascript:void(0)" onclick="openEmployeeDeleteDialog('.$recid.')">Delete</a></td>
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