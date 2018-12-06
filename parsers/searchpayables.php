<?php  
include_once("../include/loginstatus.php");

$output = '';
$count = 0; 

$text = $_POST["search"];

$sql = "SELECT hurtajadmin_payables.id
, hurtajadmin_payables.payables_total_amount
, hurtajadmin_payables.payables_po_number
, hurtajadmin_payables.payables_invoice_number
, hurtajadmin_payables.payables_invoice_date 
, hurtajadmin_payables.payables_maturity_date 
, hurtajadmin_payables.payables_dr_number 
, hurtajadmin_payables.payables_delivery_date 
, hurtajadmin_payables.payables_bank
, hurtajadmin_payables.payables_check_number 
, hurtajadmin_payables.payables_check_date 
, hurtajadmin_payables.payables_date_added
, hurtajadmin_supplier.id AS supplier_id
, hurtajadmin_supplier.supplier_name  
FROM hurtajadmin_payables
LEFT JOIN hurtajadmin_supplier
ON hurtajadmin_payables.supplier_id=hurtajadmin_supplier.id
WHERE hurtajadmin_payables.payables_status = '1' AND (hurtajadmin_supplier.supplier_name LIKE '%".$text."%' OR hurtajadmin_payables.payables_po_number LIKE '%".$text."%' OR hurtajadmin_payables.payables_invoice_number LIKE '%".$text."%')
ORDER BY hurtajadmin_supplier.supplier_name";

$result = mysqli_query($db_conn, $sql);

if($_POST["search"] == "") {
  $output .= '
  <table class="table table-striped">
  <thead>
  <tr>
  <th>#</th>
  <th>Supplier</th>
  <th>Total Amount</th>
  <th>Invoice Date</th>
  <th>Maturity Date</th>
  <th>P.O Number</th>
  <th>Invoice Number</th>
  <th>Days Left</th>
  <th>Days Exceed</th>
  <th>Action</th>
  </tr>
  </thead>
  <tbody>
  ';
  while($row = mysqli_fetch_array($result)) {  
    $count++; 
    $recid = $row["id"];
    $supplierid = $row["supplier_id"];
    $suppliername = $row["supplier_name"];
    $totalamount = $row["payables_total_amount"];
    $ponumber = $row["payables_po_number"];
    $invocenumber = $row["payables_invoice_number"];
    $invoicedate = $row["payables_invoice_date"];
    $maturitydate = $row["payables_maturity_date"];
    $drnumber = $row["payables_dr_number"];
    $deliverydate = $row["payables_delivery_date"];
    $bank = $row["payables_bank"];
    $checknumber = $row["payables_check_number"];
    $checkdate = $row["payables_check_date"];
    $dateadded = $row["payables_date_added"];

    $now = time(); // or your date as well
    $your_date = strtotime($maturitydate);
    $datediff = $your_date - $now;
    $datediff = round($datediff / (60 * 60 * 24));

    $exceeddays = 0;
    $leftdays = 0;

    if($datediff < 0) {
      $exceeddays = abs($datediff);
    } else if($datediff > 0) {
      $leftdays = $datediff;
    }

    if($invoicedate != "" && $invoicedate != "1970-01-01 01:00:00" && $invoicedate != "1970-01-01 00:00:00" && $invoicedate != "0000-00-00 00:00:00") {
      $invoicedate = date("F d, Y", strtotime($invoicedate));
      $editinvoicedate = date("m/d/Y", strtotime($invoicedate));
    } else {
        $invoicedate = "";
        $editinvoicedate = "";
    }

    if($maturitydate != "" && $maturitydate != "1970-01-01 01:00:00" && $maturitydate != "1970-01-01 00:00:00" && $maturitydate != "0000-00-00 00:00:00") {
        $maturitydate = date("F d, Y", strtotime($maturitydate));
        $editmaturitydate = date("m/d/Y", strtotime($maturitydate));
    } else {
        $maturitydate = "";
        $editmaturitydate = "";
    }

    if($deliverydate != "" && $deliverydate != "1970-01-01 01:00:00" && $deliverydate != "1970-01-01 00:00:00" && $deliverydate != "0000-00-00 00:00:00") {
        $deliverydate = date("F d, Y", strtotime($deliverydate));
        $editdeliverydate = date("m/d/Y", strtotime($deliverydate));
    } else {
        $deliverydate = "";
        $editdeliverydate = "";
    }

    if($checkdate != "" && $checkdate != "1970-01-01 01:00:00" && $checkdate != "1970-01-01 00:00:00" && $checkdate != "0000-00-00 00:00:00") {
        $checkdate = date("F d, Y", strtotime($checkdate));
        $editcheckdate = date("m/d/Y", strtotime($checkdate));
    } else {
        $checkdate = "";
        $editcheckdate = "";
    }

    $dateadded = date("F d, Y", strtotime($dateadded));

    $output .= '
    <tr>
    <td>'.$count.'</td>
    <td>'.$suppliername.'</td>           
    <td>'.$totalamount.'</td>
    <td>'.$invoicedate.'</td>
    <td>'.$maturitydate.'</td>
    <td>'.$ponumber.'</td>
    <td>'.$invocenumber.'</td>
    <td>'.$leftdays.'</td>
    <td>'.$exceeddays.'</td>
    <td><a href="javascript:void(0)" onclick="openPayablesInfoDialog(\''.$count.'\',\''.$suppliername.'\',\''.$totalamount.'\',\''.$ponumber.'\',\''.$invocenumber.'\',\''.$invoicedate.'\',\''.$maturitydate.'\',\''.$drnumber.'\',\''.$deliverydate.'\',\''.$bank.'\',\''.$checknumber.'\',\''.$checkdate.'\')">More</a> | <a href="javascript:void(0)" onclick="openPayablesEditDialog(\''.$recid.'\',\''.$supplierid.'\',\''.$totalamount.'\',\''.$ponumber.'\',\''.$invocenumber.'\',\''.$editinvoicedate.'\',\''.$editmaturitydate.'\',\''.$drnumber.'\',\''.$editdeliverydate.'\',\''.$bank.'\',\''.$checknumber.'\',\''.$editcheckdate.'\')">Edit</a> | <a href="javascript:void(0)" onclick="openPayablesDeleteDialog('.$recid.')">Delete</a></td>
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
    <th>Supplier</th>
    <th>Total Amount</th>
    <th>Invoice Date</th>
    <th>Maturity Date</th>
    <th>P.O Number</th>
    <th>Invoice Number</th>
    <th>Days Left</th>
    <th>Days Exceed</th>
    <th>Action</th>
    </tr>
    </thead>
    <tbody>
    ';
    while($row = mysqli_fetch_array($result)) {  
     $count++; 
     $recid = $row["id"];
     $supplierid = $row["supplier_id"];
     $suppliername = $row["supplier_name"];
     $totalamount = $row["payables_total_amount"];
     $ponumber = $row["payables_po_number"];
     $invocenumber = $row["payables_invoice_number"];
     $invoicedate = $row["payables_invoice_date"];
     $maturitydate = $row["payables_maturity_date"];
     $drnumber = $row["payables_dr_number"];
     $deliverydate = $row["payables_delivery_date"];
     $bank = $row["payables_bank"];
     $checknumber = $row["payables_check_number"];
     $checkdate = $row["payables_check_date"];
     $dateadded = $row["payables_date_added"];

    $now = time(); // or your date as well
    $your_date = strtotime($maturitydate);
    $datediff = $your_date - $now;
    $datediff = round($datediff / (60 * 60 * 24));

    $exceeddays = 0;
    $leftdays = 0;

    if($datediff < 0) {
      $exceeddays = abs($datediff);
    } else if($datediff > 0) {
      $leftdays = $datediff;
    }

    if($invoicedate != "" && $invoicedate != "1970-01-01 01:00:00" && $invoicedate != "1970-01-01 00:00:00" && $invoicedate != "0000-00-00 00:00:00") {
      $invoicedate = date("F d, Y", strtotime($invoicedate));
      $editinvoicedate = date("m/d/Y", strtotime($invoicedate));
    } else {
        $invoicedate = "";
        $editinvoicedate = "";
    }

    if($maturitydate != "" && $maturitydate != "1970-01-01 01:00:00" && $maturitydate != "1970-01-01 00:00:00" && $maturitydate != "0000-00-00 00:00:00") {
        $maturitydate = date("F d, Y", strtotime($maturitydate));
        $editmaturitydate = date("m/d/Y", strtotime($maturitydate));
    } else {
        $maturitydate = "";
        $editmaturitydate = "";
    }

    if($deliverydate != "" && $deliverydate != "1970-01-01 01:00:00" && $deliverydate != "1970-01-01 00:00:00" && $deliverydate != "0000-00-00 00:00:00") {
        $deliverydate = date("F d, Y", strtotime($deliverydate));
        $editdeliverydate = date("m/d/Y", strtotime($deliverydate));
    } else {
        $deliverydate = "";
        $editdeliverydate = "";
    }

    if($checkdate != "" && $checkdate != "1970-01-01 01:00:00" && $checkdate != "1970-01-01 00:00:00" && $checkdate != "0000-00-00 00:00:00") {
        $checkdate = date("F d, Y", strtotime($checkdate));
        $editcheckdate = date("m/d/Y", strtotime($checkdate));
    } else {
        $checkdate = "";
        $editcheckdate = "";
    }

    $dateadded = date("F d, Y", strtotime($dateadded));

    $output .= '
    <tr>
    <td>'.$count.'</td>
    <td>'.$suppliername.'</td>           
    <td>'.$totalamount.'</td>
    <td>'.$invoicedate.'</td>
    <td>'.$maturitydate.'</td>
    <td>'.$ponumber.'</td>
    <td>'.$invocenumber.'</td>
    <td>'.$leftdays.'</td>
    <td>'.$exceeddays.'</td>
    <td><a href="javascript:void(0)" onclick="openPayablesInfoDialog(\''.$count.'\',\''.$suppliername.'\',\''.$totalamount.'\',\''.$ponumber.'\',\''.$invocenumber.'\',\''.$invoicedate.'\',\''.$maturitydate.'\',\''.$drnumber.'\',\''.$deliverydate.'\',\''.$bank.'\',\''.$checknumber.'\',\''.$checkdate.'\')">More</a> | <a href="javascript:void(0)" onclick="openPayablesEditDialog(\''.$recid.'\',\''.$supplierid.'\',\''.$totalamount.'\',\''.$ponumber.'\',\''.$invocenumber.'\',\''.$editinvoicedate.'\',\''.$editmaturitydate.'\',\''.$drnumber.'\',\''.$editdeliverydate.'\',\''.$bank.'\',\''.$checknumber.'\',\''.$editcheckdate.'\')">Edit</a> | <a href="javascript:void(0)" onclick="openPayablesDeleteDialog('.$recid.')">Delete</a></td>
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