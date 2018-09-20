<?php  
include_once("../include/loginstatus.php");

$output = '';
$count = 0; 

$text = $_POST["search"];

$sql = "SELECT * FROM hurtajadmin_collectibles LEFT JOIN hurtajadmin_company
    ON hurtajadmin_collectibles.company_id = hurtajadmin_company.id WHERE collectibles_status = '2' AND (hurtajadmin_company.company_name LIKE '%".$text."%' OR collectibles_po_number LIKE '%".$text."%' OR collectibles_invoice_number LIKE '%".$text."%') ORDER BY hurtajadmin_collectibles.id DESC"; 
$result = mysqli_query($db_conn, $sql);

if($_POST["search"] == "") {
  $output .= '
  <table class="table table-bordered">
  <thead>
  <tr>
  <th>#</th>
  <th>Client/Company</th>
  <th>Total Amount</th>
  <th>Invoice Date</th>
  <th>Maturity Date</th>
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
    $companyid = $row["company_id"];

    $sql1 = "SELECT * FROM hurtajadmin_company WHERE id = '$companyid' ORDER BY id DESC";
    $query1 = mysqli_query($db_conn, $sql1);
    while($row1 = mysqli_fetch_array($query1)) {
      $companyname = $row1["company_name"];
    }

    $totalamount = $row["collectibles_total_amount"];
    $ponumber = $row["collectibles_po_number"];
    $invocenumber = $row["collectibles_invoice_number"];
    $invoicedate = $row["collectibles_invoice_date"];
    $maturitydate = $row["collectibles_maturity_date"];
    $drnumber = $row["collectibles_dr_number"];
    $deliverydate = $row["collectibles_delivery_date"];
    $remarkspaid = $row["collectibles_remarks_paid"];
    $ornumber = $row["collectibles_or_number"];
    $ordate = $row["collectibles_or_date"];
    $dateadded = $row["collectibles_date_added"];

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

    if($invoicedate != "" && $invoicedate != "1970-01-01 01:00:00" && $invoicedate != "0000-00-00 00:00:00") {
      $invoicedate = date("F d, Y", strtotime($invoicedate));
      $editinvoicedate = date("m/d/Y", strtotime($invoicedate));
    } else {
      $invoicedate = "";
      $editinvoicedate = "";
    }

    if($maturitydate != "" && $maturitydate != "1970-01-01 01:00:00" && $maturitydate != "0000-00-00 00:00:00") {
      $maturitydate = date("F d, Y", strtotime($maturitydate));
      $editmaturitydate = date("m/d/Y", strtotime($maturitydate));
    } else {
      $maturitydate = "";
      $editmaturitydate = "";
    }

    if($deliverydate != "" && $deliverydate != "1970-01-01 01:00:00" && $deliverydate != "0000-00-00 00:00:00") {
      $deliverydate = date("F d, Y", strtotime($deliverydate));
      $editdeliverydate = date("m/d/Y", strtotime($deliverydate));
    } else {
      $deliverydate = "";
      $editdeliverydate = "";
    }

    if($ordate != "" && $ordate != "1970-01-01 01:00:00" && $ordate != "0000-00-00 00:00:00") {
      $ordate = date("F d, Y", strtotime($ordate));
      $editordate = date("m/d/Y", strtotime($ordate));
    } else {
      $ordate = "";
      $editordate = "";
    }

    $dateadded = date("F d, Y", strtotime($dateadded));

    $output .= '
    <tr>
    <td>'.$count.'</td>
    <td>'.$companyname.'</td>           
    <td>'.$totalamount.'</td>
    <td>'.$invoicedate.'</td>
    <td>'.$maturitydate.'</td>
    <td>'.$leftdays.'</td>
    <td>'.$exceeddays.'</td>
    <td><a href="javascript:void(0)" onclick="openCollectiblesInfoDialog(\''.$count.'\',\''.$companyname.'\',\''.$totalamount.'\',\''.$ponumber.'\',\''.$invocenumber.'\',\''.$invoicedate.'\',\''.$maturitydate.'\',\''.$drnumber.'\',\''.$deliverydate.'\',\''.$remarkspaid.'\',\''.$ornumber.'\',\''.$ordate.'\')">More</a> | <a href="javascript:void(0)" onclick="openCollectiblesEditDialog(\''.$recid.'\',\''.$companyid.'\',\''.$totalamount.'\',\''.$ponumber.'\',\''.$invocenumber.'\',\''.$editinvoicedate.'\',\''.$editmaturitydate.'\',\''.$drnumber.'\',\''.$editdeliverydate.'\',\''.$remarkspaid.'\',\''.$ornumber.'\',\''.$editordate.'\')">Edit</a> | <a href="javascript:void(0)" onclick="openCollectiblesMarkUnpaidDialog('.$recid.')">Unpaid</a> | <a href="javascript:void(0)" onclick="openCollectiblesDeleteDialog('.$recid.')">Delete</a></td>
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
    <th>Client/Company</th>
    <th>Total Amount</th>
    <th>Invoice Date</th>
    <th>Maturity Date</th>
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
    $companyid = $row["company_id"];

    $sql1 = "SELECT * FROM hurtajadmin_company WHERE id = '$companyid' ORDER BY id DESC";
    $query1 = mysqli_query($db_conn, $sql1);
    while($row1 = mysqli_fetch_array($query1)) {
      $companyname = $row1["company_name"];
    }

    $totalamount = $row["collectibles_total_amount"];
    $ponumber = $row["collectibles_po_number"];
    $invocenumber = $row["collectibles_invoice_number"];
    $invoicedate = $row["collectibles_invoice_date"];
    $maturitydate = $row["collectibles_maturity_date"];
    $drnumber = $row["collectibles_dr_number"];
    $deliverydate = $row["collectibles_delivery_date"];
    $remarkspaid = $row["collectibles_remarks_paid"];
    $ornumber = $row["collectibles_or_number"];
    $ordate = $row["collectibles_or_date"];
    $dateadded = $row["collectibles_date_added"];

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

    if($invoicedate != "" && $invoicedate != "1970-01-01 01:00:00" && $invoicedate != "0000-00-00 00:00:00") {
      $invoicedate = date("F d, Y", strtotime($invoicedate));
      $editinvoicedate = date("m/d/Y", strtotime($invoicedate));
    } else {
      $invoicedate = "";
      $editinvoicedate = "";
    }

    if($maturitydate != "" && $maturitydate != "1970-01-01 01:00:00" && $maturitydate != "0000-00-00 00:00:00") {
      $maturitydate = date("F d, Y", strtotime($maturitydate));
      $editmaturitydate = date("m/d/Y", strtotime($maturitydate));
    } else {
      $maturitydate = "";
      $editmaturitydate = "";
    }

    if($deliverydate != "" && $deliverydate != "1970-01-01 01:00:00" && $deliverydate != "0000-00-00 00:00:00") {
      $deliverydate = date("F d, Y", strtotime($deliverydate));
      $editdeliverydate = date("m/d/Y", strtotime($deliverydate));
    } else {
      $deliverydate = "";
      $editdeliverydate = "";
    }

    if($ordate != "" && $ordate != "1970-01-01 01:00:00" && $ordate != "0000-00-00 00:00:00") {
      $ordate = date("F d, Y", strtotime($ordate));
      $editordate = date("m/d/Y", strtotime($ordate));
    } else {
      $ordate = "";
      $editordate = "";
    }

    $dateadded = date("F d, Y", strtotime($dateadded));

    $output .= '
    <tr>
    <td>'.$count.'</td>
    <td>'.$companyname.'</td>           
    <td>'.$totalamount.'</td>
    <td>'.$invoicedate.'</td>
    <td>'.$maturitydate.'</td>
    <td>'.$leftdays.'</td>
    <td>'.$exceeddays.'</td>
    <td><a href="javascript:void(0)" onclick="openCollectiblesInfoDialog(\''.$count.'\',\''.$companyname.'\',\''.$totalamount.'\',\''.$ponumber.'\',\''.$invocenumber.'\',\''.$invoicedate.'\',\''.$maturitydate.'\',\''.$drnumber.'\',\''.$deliverydate.'\',\''.$remarkspaid.'\',\''.$ornumber.'\',\''.$ordate.'\')">More</a> | <a href="javascript:void(0)" onclick="openCollectiblesEditDialog(\''.$recid.'\',\''.$companyid.'\',\''.$totalamount.'\',\''.$ponumber.'\',\''.$invocenumber.'\',\''.$editinvoicedate.'\',\''.$editmaturitydate.'\',\''.$drnumber.'\',\''.$editdeliverydate.'\',\''.$remarkspaid.'\',\''.$ornumber.'\',\''.$editordate.'\')">Edit</a> | <a href="javascript:void(0)" onclick="openCollectiblesMarkUnpaidDialog('.$recid.')">Unpaid</a> | <a href="javascript:void(0)" onclick="openCollectiblesDeleteDialog('.$recid.')">Delete</a></td>
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