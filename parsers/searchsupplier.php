<?php  
include_once("../include/loginstatus.php");

$output = '';
$count = 0; 

$text = $_POST["search"];

$sql = "SELECT * FROM hurtajadmin_supplier WHERE supplier_status = '1' AND supplier_name LIKE '%".$text."%' ORDER BY id DESC";

$result = mysqli_query($db_conn, $sql);  

if($_POST["search"] == "") {
  $output .= '
  <table class="table table-striped">
  <thead>
  <tr>
  <th>#</th>
  <th>Name</th>
  <th>Address</th>
  <th>Contact Number</th>
  <th>Date Added</th>
  <th>Action</th>
  </tr>
  </thead>
  <tbody>
  ';
  while($row = mysqli_fetch_array($result)) {  
    $count++; 
    $recid = $row["id"];
    $name = $row["supplier_name"];
    $address = $row["supplier_address"];
    $contact = $row["supplier_contact"];
    $date = $row["supplier_date_added"];
    $newDate = date("F d, Y H:i A", strtotime($date));

    $output .= '
    <tr>
    <td>'.$count.'</td>
    <td>'.$name.'</td>           
    <td>'.$address.'</td>
    <td>'.$contact.'</td>
    <td>'.$newDate.'</td>
    <td><a href="javascript:void(0)" onclick="openSupplierEditDialog('.$recid.',\''.$name.'\',\''.$address.'\',\''.$contact.'\')">Edit</a> | <a href="javascript:void(0)" onclick="openSupplierDeleteDialog('.$recid.')">Delete</a></td>
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
    <th>Address</th>
    <th>Contact Number</th>
    <th>Date Added</th>
    <th>Action</th>
    </tr>
    </thead>
    <tbody>
    ';
    while($row = mysqli_fetch_array($result)) {  
     $count++; 
     $recid = $row["id"];
     $recid = $row["id"];
     $name = $row["supplier_name"];
     $address = $row["supplier_address"];
     $contact = $row["supplier_contact"];
     $date = $row["supplier_date_added"];
     $newDate = date("F d, Y H:i A", strtotime($date));

     $output .= '
     <tr>
     <td>'.$count.'</td>
     <td>'.$name.'</td>           
     <td>'.$address.'</td>
     <td>'.$contact.'</td>
     <td>'.$newDate.'</td>
     <td><a href="javascript:void(0)" onclick="openSupplierEditDialog('.$recid.',\''.$name.'\',\''.$address.'\',\''.$contact.'\')">Edit</a> | <a href="javascript:void(0)" onclick="openSupplierDeleteDialog('.$recid.')">Delete</a></td>
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