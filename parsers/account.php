<?php

if(isset($_POST["updateemail"])) {

  include_once("../include/db_conn.php");
  include_once("../include/loginstatus.php");

  $email = $_POST['updateemail'];
  $password = $_POST['password'];

  $sql = "SELECT * FROM hurtajadmin_user WHERE id='$log_id' LIMIT 1";
  $query = mysqli_query($db_conn, $sql);
  $check = mysqli_num_rows($query);

  if($check > 0) { 

    while ($row = mysqli_fetch_array($query, MYSQLI_ASSOC)) {
      $emaildb = $row["user_email"];
      $passworddb = $row["user_pass"];
    }

    if($email == $emaildb && $password == $passworddb) {
      echo "samedata";
    } else {
      $sql = "UPDATE hurtajadmin_user SET user_email='$email', user_pass='$password' WHERE id='$log_id' LIMIT 1";
      $query = mysqli_query($db_conn, $sql);
      echo "successinsert";
    }

  } else {

    echo "error";

  }

  exit();

}


if(isset($_POST["date"])) {

  include_once("../includes/db_conn.php");
  include_once("../includes/loginstatus.php");

  $date = $_POST['date'];
  $elco = $_POST['elco'];
  $elapp = $_POST['elapp'];
  $sponcom = $_POST['sponcom'];
  $gasera = $_POST['gasera'];
  $staele = $_POST['staele'];
  $lpg = $_POST['lpg'];
  $chem = $_POST['chem'];
  $phyro = $_POST['phyro'];
  $matlig = $_POST['matlig'];
  $light = $_POST['light'];
  $exp = $_POST['exp'];
  $resfire = $_POST['resfire'];
  $edufire = $_POST['edufire'];
  $hcfire = $_POST['hcfire'];
  $stofire = $_POST['stofire'];
  $bizfire = $_POST['bizfire'];
  $mixfire = $_POST['mixfire'];
  $indfire = $_POST['indfire'];
  $commer = $_POST['commer'];
  $assembly = $_POST['assembly'];
  $others = $_POST['others'];
  $grass = $_POST['grass'];
  $post = $_POST['post'];
  $veh = $_POST['veh'];
  $fatci = $_POST['fatci'];
  $fatbf = $_POST['fatbf'];
  $injci = $_POST['injci'];
  $injbf = $_POST['injbf'];

  $sql = "SELECT * FROM alab_fire_record WHERE fire_record_date='$date' AND user_id = '$log_id' LIMIT 1";
  $query = mysqli_query($db_conn, $sql);
  $check = mysqli_num_rows($query);

  if($check > 0) { 

    echo "samedata";

  } else {

    $sql_user = "INSERT INTO alab_fire_record (user_id, fire_record_elco, fire_record_elapp, fire_record_sponcom, fire_record_gasera, fire_record_staele, fire_record_lpg, fire_record_chem, fire_record_phyro, fire_record_matlig, fire_record_light, fire_record_exp, fire_record_resfire, fire_record_edufire, fire_record_hcfire, fire_record_stofire, fire_record_bizfire, fire_record_mixfire, fire_record_indfire, fire_record_commer, fire_record_assembly, fire_record_others, fire_record_grass, fire_record_post, fire_record_veh, fire_record_fatci, fire_record_fatbf, fire_record_injci, fire_record_injbf, fire_record_date, fire_record_date_created, fire_record_status)
    VALUES ('$log_id','$elco','$elapp', '$sponcom', '$gasera','$staele','$lpg', '$chem', '$phyro','$matlig','$light', '$exp', '$resfire','$edufire','$hcfire', '$stofire', '$bizfire','$mixfire','$indfire', '$commer', '$assembly','$others','$grass', '$post', '$veh','$fatci','$fatbf', '$injci', '$injbf', '$date', NOW(), '1')";
    $query = mysqli_query($db_conn, $sql_user);
    echo "successinsert";

  }

  exit();

}

if(isset($_POST["updateemail"])) {

  include_once("../includes/db_conn.php");
  include_once("../includes/loginstatus.php");

  $email = $_POST['updateemail'];
  $password = $_POST['password'];

  $sql = "SELECT * FROM ppbms_user WHERE id='$log_id' LIMIT 1";
  $query = mysqli_query($db_conn, $sql);
  $check = mysqli_num_rows($query);

  if($check > 0) { 

    while ($row = mysqli_fetch_array($query, MYSQLI_ASSOC)) {
      $emaildb = $row["user_email"];
      $passworddb = $row["user_pass"];
    }

    if($email == $emaildb && $password == $passworddb) {
      echo "samedata";
    } else {
      $sql = "UPDATE ppbms_user SET user_email='$email', user_pass='$password' WHERE id='$log_id' LIMIT 1";
      $query = mysqli_query($db_conn, $sql);
      echo "successinsert";
    }

  } else {

    echo "error";

  }

  exit();

}


if(isset($_POST["addbarcodemiddletextcode"])) {

  include_once("../includes/db_conn.php");
  include_once("../includes/loginstatus.php");

  $code = $_POST['addbarcodemiddletextcode'];

  $sql = "SELECT * FROM ppbms_barcode_middle_text WHERE barcode_middle_text_code='$code' LIMIT 1";
  $query = mysqli_query($db_conn, $sql);
  $check = mysqli_num_rows($query);

  if($check > 0) { 

  	echo "samedata";

  } else {

    $sql_code = "INSERT INTO ppbms_barcode_middle_text (barcode_middle_text_code, barcode_middle_text_status)
    VALUES ('$code','1')";
    $query = mysqli_query($db_conn, $sql_code);
    echo "successinsert";

  }

  exit();

}

if(isset($_POST["updatebarcodemiddletextid"])) {

  include_once("../includes/db_conn.php");
  include_once("../includes/loginstatus.php");

  $rid = $_POST['updatebarcodemiddletextid'];
  $code = $_POST['updatebarcodemiddletextcode'];

  $sql = "UPDATE ppbms_barcode_middle_text SET barcode_middle_text_code='$code' WHERE id='$rid' LIMIT 1";
  $query = mysqli_query($db_conn, $sql);
  echo "successupdate";

  exit();

}

if(isset($_POST["updateareapriceid"])) {

  include_once("../includes/db_conn.php");
  include_once("../includes/loginstatus.php");

  $rid = $_POST['updateareapriceid'];
  $price = $_POST['updateareapriceprice'];

  $sql = "UPDATE ppbms_area_price SET area_price_price='$price' WHERE id='$rid' LIMIT 1";
  $query = mysqli_query($db_conn, $sql);
  echo "successupdate";

  exit();

}

if(isset($_POST["deletecompanyid"])) {

  include_once("../include/db_conn.php");
  include_once("../include/loginstatus.php");

  $rid = $_POST['deletecompanyid'];

  $sql = "UPDATE hurtajadmin_company SET company_status='2' WHERE id='$rid' LIMIT 1";
  $query = mysqli_query($db_conn, $sql);
  echo "successupdate";

  exit();

}

if(isset($_POST["editcompanyid"])) {

  include_once("../include/db_conn.php");
  include_once("../include/loginstatus.php");

  $rid = $_POST['editcompanyid'];
  $name = $_POST['editcompanyname'];
  $address = $_POST['editcompanyaddress'];
  $contact = $_POST['editcompanycontact'];

  $sql = "UPDATE hurtajadmin_company SET company_name='$name', company_address='$address', company_contact='$contact' WHERE id='$rid' LIMIT 1";
  $query = mysqli_query($db_conn, $sql);

  $sql = "UPDATE hurtajadmin_collectibles SET company_name='$name' WHERE company_id='$rid' LIMIT 1";
  $query = mysqli_query($db_conn, $sql);

  echo "successupdate";

  exit();

}

if(isset($_POST["addcompanyname"])) {

  include_once("../include/db_conn.php");
  include_once("../include/loginstatus.php");

  $name = $_POST['addcompanyname'];
  $address = $_POST['addcompanyaddress'];
  $contact = $_POST['addcompanycontact'];

  $sql = "SELECT * FROM hurtajadmin_company WHERE company_name='$name' AND company_address='$address' AND company_contact='$contact' AND company_status = '1' LIMIT 1";
  $query = mysqli_query($db_conn, $sql);
  $check = mysqli_num_rows($query);

  if($check > 0) { 

    echo "exist";

  } else {

    $sql_code = "INSERT INTO hurtajadmin_company (company_name, company_address, company_contact, company_date_added, company_status)
    VALUES ('$name','$address','$contact',NOW(),'1')";
    $query = mysqli_query($db_conn, $sql_code);
    echo "successinsert";

  }

  exit();

}

if(isset($_POST["addcollectiblescompany"])) {

  include_once("../include/db_conn.php");
  include_once("../include/loginstatus.php");

  $company = $_POST['addcollectiblescompany'];
  $totalamount = $_POST['addcollectiblestotalamount'];
  $ponumber = $_POST['addcollectiblesponumber'];
  $invoicenumber = $_POST['addcollectiblesinvoicenumber'];
  $invoicedate = $_POST['addcollectiblesinvoicedate'];
  $maturitydate = $_POST['addcollectiblesmaturitydate'];
  $drnumber = $_POST['addcollectiblesdrnumber'];
  $deliverydate = $_POST['addcollectiblesdeliverydate'];
  $remarkspaid = $_POST['addcollectiblesremarks'];
  $ornumber = $_POST['addcollectiblesornumber'];
  $ordate = $_POST['addcollectiblesordate'];

  $invoicedate = date("Y-m-d H:i:s", strtotime($invoicedate));
  $maturitydate = date("Y-m-d H:i:s", strtotime($maturitydate));
  $deliverydate = date("Y-m-d H:i:s", strtotime($deliverydate));
  $ordate = date("Y-m-d H:i:s", strtotime($ordate));

  $sql = "SELECT * FROM hurtajadmin_collectibles WHERE company_id='$company' AND collectibles_total_amount='$totalamount' AND collectibles_invoice_number='$invoicenumber' AND collectibles_invoice_date='$invoicedate' AND collectibles_status = '1' LIMIT 1";
  $query = mysqli_query($db_conn, $sql);
  $check = mysqli_num_rows($query);

  if($check > 0) { 

    echo "exist";

  } else {

    $sql_code = "INSERT INTO hurtajadmin_collectibles (company_id, collectibles_total_amount, collectibles_po_number, collectibles_invoice_number, collectibles_invoice_date, collectibles_maturity_date, collectibles_dr_number,  collectibles_delivery_date, collectibles_remarks_paid, collectibles_or_number, collectibles_or_date, collectibles_date_added, collectibles_status)
    VALUES ('$company','$totalamount','$ponumber', '$invoicenumber','$invoicedate','$maturitydate', '$drnumber','$deliverydate','$remarkspaid', '$ornumber','$ordate', NOW(),'1')";
    $query = mysqli_query($db_conn, $sql_code);
    echo "successinsert";

  }

  exit();

}

if(isset($_POST["deletecollectiblesid"])) {

  include_once("../include/db_conn.php");
  include_once("../include/loginstatus.php");

  $rid = $_POST['deletecollectiblesid'];

  $sql = "UPDATE hurtajadmin_collectibles SET collectibles_status='3' WHERE id='$rid' LIMIT 1";
  $query = mysqli_query($db_conn, $sql);
  echo "successupdate";

  exit();

}

if(isset($_POST["markpaidcollectiblesid"])) {

  include_once("../include/db_conn.php");
  include_once("../include/loginstatus.php");

  $rid = $_POST['markpaidcollectiblesid'];

  $sql = "UPDATE hurtajadmin_collectibles SET collectibles_status='2' WHERE id='$rid' LIMIT 1";
  $query = mysqli_query($db_conn, $sql);
  echo "successupdate";

  exit();

}

if(isset($_POST["markunpaidcollectiblesid"])) {

  include_once("../include/db_conn.php");
  include_once("../include/loginstatus.php");

  $rid = $_POST['markunpaidcollectiblesid'];

  $sql = "UPDATE hurtajadmin_collectibles SET collectibles_status='1' WHERE id='$rid' LIMIT 1";
  $query = mysqli_query($db_conn, $sql);
  echo "successupdate";

  exit();

}


if(isset($_POST["editcollectiblesid"])) {

  include_once("../include/db_conn.php");
  include_once("../include/loginstatus.php");

  $rid = $_POST['editcollectiblesid'];
  $company = $_POST['editcollectiblescompany'];
  $totalamount = $_POST['editcollectiblestotalamount'];
  $ponumber = $_POST['editcollectiblesponumber'];
  $invoicenumber = $_POST['editcollectiblesinvoicenumber'];
  $invoicedate = $_POST['editcollectiblesinvoicedate'];
  $maturitydate = $_POST['editcollectiblesmaturitydate'];
  $drnumber = $_POST['editcollectiblesdrnumber'];
  $deliverydate = $_POST['editcollectiblesdeliverydate'];
  $remarkspaid = $_POST['editcollectiblesremarks'];
  $ornumber = $_POST['editcollectiblesornumber'];
  $ordate = $_POST['editcollectiblesordate'];

  $invoicedate = date("Y-m-d H:i:s", strtotime($invoicedate));
  $maturitydate = date("Y-m-d H:i:s", strtotime($maturitydate));
  $deliverydate = date("Y-m-d H:i:s", strtotime($deliverydate));
  $ordate = date("Y-m-d H:i:s", strtotime($ordate));

  $sql = "SELECT * FROM hurtajadmin_company WHERE id = '$company' ORDER BY id DESC";
  $query = mysqli_query($db_conn, $sql);
  while($row = mysqli_fetch_array($query)) {
      $companyname = $row["company_name"];
  }

  $sql = "UPDATE hurtajadmin_collectibles SET company_id='$company', company_name='$companyname', collectibles_total_amount='$totalamount', collectibles_po_number='$ponumber', collectibles_invoice_number='$invoicenumber', collectibles_invoice_date='$invoicedate', collectibles_maturity_date='$maturitydate', collectibles_dr_number='$drnumber', collectibles_delivery_date='$deliverydate', collectibles_remarks_paid='$remarkspaid', collectibles_or_number='$ornumber', collectibles_or_date='$ordate' WHERE id='$rid' LIMIT 1";
  $query = mysqli_query($db_conn, $sql);
  echo "successupdate";

  exit();

}

if(isset($_POST["addemployeename"])) {

  include_once("../include/db_conn.php");
  include_once("../include/loginstatus.php");

  $employee = $_POST['addemployeename'];
  $gender = $_POST['addemployeegender'];
  $birthday = $_POST['addemployeebirthday'];
  $contact = $_POST['addemployeecontact'];
  $address = $_POST['addemployeeaddress'];
  $hired = $_POST['addemployeehired'];

  $birthday = date("Y-m-d H:i:s", strtotime($birthday));
  $hired = date("Y-m-d H:i:s", strtotime($hired));

  $sql = "SELECT * FROM hurtajadmin_employee WHERE employee_name='$employee' AND employee_birthday='$birthday' AND employee_phone='$contact' AND employee_status = '1' LIMIT 1";
  $query = mysqli_query($db_conn, $sql);
  $check = mysqli_num_rows($query);

  if($check > 0) { 

    echo "exist";

  } else {

    $sql1 = "SELECT * FROM hurtajadmin_employee ORDER BY id DESC LIMIT 1";
    $query1 = mysqli_query($db_conn, $sql1);
    $check1 = mysqli_num_rows($query1);
    $empid = "";

    if($check1 > 0) {
      while ($row = mysqli_fetch_array($query1, MYSQLI_ASSOC)) {
        $empid = $row["employee_id"];
        $empid = (int)$empid;
        $empid = $empid+1;
        $empid = str_pad($empid,7,"0",STR_PAD_LEFT);
      }
    } else {
      $empid = "0000001";
    }

    $sql_code = "INSERT INTO hurtajadmin_employee (employee_id, employee_name, employee_gender, employee_birthday,   employee_phone, employee_address, employee_date_hired, employee_date_added, employee_status)
    VALUES ('$empid','$employee','$gender','$birthday','$contact','$address','$hired',NOW(),'1')";
    $query = mysqli_query($db_conn, $sql_code);
    echo "successinsert";

  }

  exit();

}

if(isset($_POST["editemployeeid"])) {

  include_once("../include/db_conn.php");
  include_once("../include/loginstatus.php");

  $rid = $_POST['editemployeeid'];
  $name = $_POST['editemployeename'];
  $gender = $_POST['editemployeegender'];
  $birthday = $_POST['editemployeebirthday'];
  $address = $_POST['editemployeeaddress'];
  $contact = $_POST['editemployeecontact'];
  $hired = $_POST['editemployeedatehired'];

  $birthday = date("Y-m-d H:i:s", strtotime($birthday));
  $hired = date("Y-m-d H:i:s", strtotime($hired));

  $sql = "UPDATE hurtajadmin_employee SET employee_name='$name', employee_gender='$gender', employee_birthday='$birthday', employee_phone='$contact', employee_address='$address', employee_date_hired='$hired' WHERE id='$rid' LIMIT 1";
  $query = mysqli_query($db_conn, $sql);

  echo "successupdate";

  exit();

}

if(isset($_POST["deleteemployeeid"])) {

  include_once("../include/db_conn.php");
  include_once("../include/loginstatus.php");

  $rid = $_POST['deleteemployeeid'];

  $sql = "UPDATE hurtajadmin_employee SET employee_status='2' WHERE id='$rid' LIMIT 1";
  $query = mysqli_query($db_conn, $sql);
  echo "successupdate";

  exit();

}


if(isset($_POST["updatedispatchcontrolmessengerid"])) {

  include_once("../includes/db_conn.php");
  include_once("../includes/loginstatus.php");

  $rid = $_POST['updatedispatchcontrolmessengerid'];
  $name = $_POST['updatedispatchcontrolmessengername'];
  $address = $_POST['updatedispatchcontrolmessengeaddress'];
  $prepared = $_POST['updatedispatchcontrolmessengerprepared'];
  $date = $_POST['updatedispatchcontrolmessengerdate'];
  $newDate = date("Y-m-d H:i:s", strtotime($date));

  $sql = "UPDATE ppbms_dispatch_control_messenger SET dispatch_control_messenger_name='$name', dispatch_control_messenger_address='$address', dispatch_control_messenger_prepared='$prepared', dispatch_control_messenger_date='$newDate' WHERE id='$rid' LIMIT 1";
  $query = mysqli_query($db_conn, $sql);
  echo "successupdate";

  exit();

}

if(isset($_POST["deletedispatchcontrolmessengerid"])) {

  include_once("../includes/db_conn.php");
  include_once("../includes/loginstatus.php");

  $rid = $_POST['deletedispatchcontrolmessengerid'];

  $sql = "UPDATE ppbms_dispatch_control_messenger SET dispatch_control_messenger_status='2' WHERE id='$rid' LIMIT 1";
  $query = mysqli_query($db_conn, $sql);
  echo "successupdate";

  exit();

}

if(isset($_POST["adddispatchcontroldatamessengerid"])) {

  include_once("../includes/db_conn.php");
  include_once("../includes/loginstatus.php");

  $rid = $_POST['adddispatchcontroldatamessengerid'];
  $cyclecode = $_POST['adddispatchcontroldatacyclecode'];
  $date = $_POST['adddispatchcontroldatapickupdate'];
  $newDate1 = date("Y-m-d H:i:s", strtotime($date));
  $newDate2 = date("m/d/y", strtotime($date));
  $sender = $_POST['adddispatchcontroldatasender'];
  $deltype = $_POST['adddispatchcontroldatadeltype'];

  $sql = "SELECT * FROM ppbms_dispatch_control_data WHERE dispatch_control_messenger_id='$rid' AND dispatch_control_data_cycle_code='$cyclecode' AND dispatch_control_data_pickup_date='$newDate1' AND dispatch_control_data_sender='$sender' AND dispatch_control_data_del_type = '$deltype' AND dispatch_control_data_status = '1' LIMIT 1";
  $query = mysqli_query($db_conn, $sql);
  $check = mysqli_num_rows($query);

  $sql_cycle_code = "SELECT * FROM ppbms_record WHERE record_cycle_code='$cyclecode' AND record_pud='$newDate2' AND record_sender='$sender' AND record_deltype='$deltype' LIMIT 1";
  $query_cycle_code = mysqli_query($db_conn, $sql_cycle_code);
  $check_cycle_code = mysqli_num_rows($query_cycle_code);

  if($check > 0) { 

    echo "samedata";

  } else {

    if($check_cycle_code > 0) {

      $sql_code = "INSERT INTO ppbms_dispatch_control_data (dispatch_control_messenger_id, dispatch_control_data_cycle_code, dispatch_control_data_pickup_date, dispatch_control_data_sender, dispatch_control_data_del_type, dispatch_control_data_status)
      VALUES ('$rid','$cyclecode','$newDate1','$sender','$deltype','1')";
      $query = mysqli_query($db_conn, $sql_code);
      echo "successinsert";

    } else {

      echo "datanotexists";

    }

  }

  exit();

}

if(isset($_POST["deleteencodelistsid"])) {

  include_once("../includes/db_conn.php");
  include_once("../includes/loginstatus.php");

  $rid = $_POST['deleteencodelistsid'];

  $sql = "UPDATE ppbms_encode_list SET encode_lists_status='2' WHERE id='$rid' LIMIT 1";
  $query = mysqli_query($db_conn, $sql);

  if($query) {
    $sql1 = "UPDATE ppbms_record SET record_status_status='2' WHERE encode_lists_id='$rid'";
    $query1 = mysqli_query($db_conn, $sql1);
  }
  echo "successupdate";

  exit();

}

if(isset($_POST["updaterecordbarcode"])) {

  include_once("../includes/db_conn.php");
  include_once("../includes/loginstatus.php");

  $barcode = $_POST['updaterecordbarcode'];
  $daterecieve = $_POST['updaterecorddaterecieve'];
  $recieveby = $_POST['updaterecordrecieveby'];
  $relation = $_POST['updaterecordrelation'];
  $messenger = $_POST['updaterecordmessenger'];
  $status = $_POST['updaterecordstatus'];
  $reasonrts = $_POST['updaterecordreasonrts'];
  $remarks = $_POST['updaterecordremarks'];
  $datereported = $_POST['updaterecorddatereported'];
  $newDate1 = date("Y-m-d H:i:s", strtotime($daterecieve));
  $newDate2 = date("Y-m-d H:i:s", strtotime($datereported));

  $sql = "UPDATE ppbms_record SET record_date_receive='$newDate1', record_receive_by='$recieveby',   record_relation='$relation', record_messenger='$messenger', record_status='$status', record_reason_rts='$reasonrts', record_remarks='$remarks', record_date_reported='$newDate2' WHERE record_bar_code='$barcode' LIMIT 1";
  $query = mysqli_query($db_conn, $sql);
  echo "successupdate";

  exit();

}

if(isset($_POST["qname"])) {

  include_once("../includes/db_conn.php");
  include_once("../includes/loginstatus.php");

  $name = $_POST['qname'];

  $sql = "SELECT * FROM oes_question_list WHERE q_list_name='$name' LIMIT 1";
  $query = mysqli_query($db_conn, $sql);
  $check = mysqli_num_rows($query);

  if($check > 0) { 

  	echo "samedata";

  } else {

    $sql_user = "INSERT INTO oes_question_list (q_list_name, q_list_date_created, q_list_status)
    VALUES ('$name', NOW(), '1')";
    $query = mysqli_query($db_conn, $sql_user);
    echo "successinsert";

  }

  exit();

}

if(isset($_POST["aname"])) {

  include_once("../includes/db_conn.php");
  include_once("../includes/loginstatus.php");

  $name = $_POST['aname'];

  $sql = "SELECT * FROM oes_answer_list WHERE a_list_name='$name' LIMIT 1";
  $query = mysqli_query($db_conn, $sql);
  $check = mysqli_num_rows($query);

  if($check > 0) { 

  	echo "samedata";

  } else {

    $sql_user = "INSERT INTO oes_answer_list (a_list_name, a_list_date_created, a_list_status)
    VALUES ('$name', NOW(), '1')";
    $query = mysqli_query($db_conn, $sql_user);
    echo "successinsert";

  }

  exit();

}

?>