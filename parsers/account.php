<?php

if (isset($_POST["updateemail"])) {

    include_once "../include/db_conn.php";
    include_once "../include/loginstatus.php";

    $email = $_POST['updateemail'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM hurtajadmin_user WHERE id='$log_id' LIMIT 1";
    $query = mysqli_query($db_conn, $sql);
    $check = mysqli_num_rows($query);

    if ($check > 0) {

        while ($row = mysqli_fetch_array($query, MYSQLI_ASSOC)) {
            $emaildb = $row["user_email"];
            $passworddb = $row["user_pass"];
        }

        if ($email == $emaildb && $password == $passworddb) {
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

if (isset($_POST["date"])) {

    include_once "../includes/db_conn.php";
    include_once "../includes/loginstatus.php";

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

    if ($check > 0) {

        echo "samedata";

    } else {

        $sql_user = "INSERT INTO alab_fire_record (user_id, fire_record_elco, fire_record_elapp, fire_record_sponcom, fire_record_gasera, fire_record_staele, fire_record_lpg, fire_record_chem, fire_record_phyro, fire_record_matlig, fire_record_light, fire_record_exp, fire_record_resfire, fire_record_edufire, fire_record_hcfire, fire_record_stofire, fire_record_bizfire, fire_record_mixfire, fire_record_indfire, fire_record_commer, fire_record_assembly, fire_record_others, fire_record_grass, fire_record_post, fire_record_veh, fire_record_fatci, fire_record_fatbf, fire_record_injci, fire_record_injbf, fire_record_date, fire_record_date_created, fire_record_status)
    VALUES ('$log_id','$elco','$elapp', '$sponcom', '$gasera','$staele','$lpg', '$chem', '$phyro','$matlig','$light', '$exp', '$resfire','$edufire','$hcfire', '$stofire', '$bizfire','$mixfire','$indfire', '$commer', '$assembly','$others','$grass', '$post', '$veh','$fatci','$fatbf', '$injci', '$injbf', '$date', NOW(), '1')";
        $query = mysqli_query($db_conn, $sql_user);
        echo "successinsert";

    }

    exit();

}

if (isset($_POST["updateemail"])) {

    include_once "../includes/db_conn.php";
    include_once "../includes/loginstatus.php";

    $email = $_POST['updateemail'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM ppbms_user WHERE id='$log_id' LIMIT 1";
    $query = mysqli_query($db_conn, $sql);
    $check = mysqli_num_rows($query);

    if ($check > 0) {

        while ($row = mysqli_fetch_array($query, MYSQLI_ASSOC)) {
            $emaildb = $row["user_email"];
            $passworddb = $row["user_pass"];
        }

        if ($email == $emaildb && $password == $passworddb) {
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

if (isset($_POST["addbarcodemiddletextcode"])) {

    include_once "../includes/db_conn.php";
    include_once "../includes/loginstatus.php";

    $code = $_POST['addbarcodemiddletextcode'];

    $sql = "SELECT * FROM ppbms_barcode_middle_text WHERE barcode_middle_text_code='$code' LIMIT 1";
    $query = mysqli_query($db_conn, $sql);
    $check = mysqli_num_rows($query);

    if ($check > 0) {

        echo "samedata";

    } else {

        $sql_code = "INSERT INTO ppbms_barcode_middle_text (barcode_middle_text_code, barcode_middle_text_status)
    VALUES ('$code','1')";
        $query = mysqli_query($db_conn, $sql_code);
        echo "successinsert";

    }

    exit();

}

if (isset($_POST["updatebarcodemiddletextid"])) {

    include_once "../includes/db_conn.php";
    include_once "../includes/loginstatus.php";

    $rid = $_POST['updatebarcodemiddletextid'];
    $code = $_POST['updatebarcodemiddletextcode'];

    $sql = "UPDATE ppbms_barcode_middle_text SET barcode_middle_text_code='$code' WHERE id='$rid' LIMIT 1";
    $query = mysqli_query($db_conn, $sql);
    echo "successupdate";

    exit();

}

if (isset($_POST["updateareapriceid"])) {

    include_once "../includes/db_conn.php";
    include_once "../includes/loginstatus.php";

    $rid = $_POST['updateareapriceid'];
    $price = $_POST['updateareapriceprice'];

    $sql = "UPDATE ppbms_area_price SET area_price_price='$price' WHERE id='$rid' LIMIT 1";
    $query = mysqli_query($db_conn, $sql);
    echo "successupdate";

    exit();

}

if (isset($_POST["deletecompanyid"])) {

    include_once "../include/db_conn.php";
    include_once "../include/loginstatus.php";

    $rid = $_POST['deletecompanyid'];

    $sql = "UPDATE hurtajadmin_company SET company_status='2' WHERE id='$rid' LIMIT 1";
    $query = mysqli_query($db_conn, $sql);
    echo "successupdate";

    exit();

}

if (isset($_POST["editcompanyid"])) {

    include_once "../include/db_conn.php";
    include_once "../include/loginstatus.php";

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

if (isset($_POST["addcompanyname"])) {

    include_once "../include/db_conn.php";
    include_once "../include/loginstatus.php";

    $name = $_POST['addcompanyname'];
    $address = $_POST['addcompanyaddress'];
    $contact = $_POST['addcompanycontact'];

    $sql = "SELECT * FROM hurtajadmin_company WHERE company_name='$name' AND company_address='$address' AND company_contact='$contact' AND company_status = '1' LIMIT 1";
    $query = mysqli_query($db_conn, $sql);
    $check = mysqli_num_rows($query);

    if ($check > 0) {

        echo "exist";

    } else {

        $sql_code = "INSERT INTO hurtajadmin_company (company_name, company_address, company_contact, company_date_added, company_status)
    VALUES ('$name','$address','$contact',NOW(),'1')";
        $query = mysqli_query($db_conn, $sql_code);
        echo "successinsert";

    }

    exit();

}

if (isset($_POST["addcollectiblescompany"])) {

    include_once "../include/db_conn.php";
    include_once "../include/loginstatus.php";

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

    if ($check > 0) {

        echo "exist";

    } else {

        $sql_code = "INSERT INTO hurtajadmin_collectibles (company_id, collectibles_total_amount, collectibles_po_number, collectibles_invoice_number, collectibles_invoice_date, collectibles_maturity_date, collectibles_dr_number,  collectibles_delivery_date, collectibles_remarks_paid, collectibles_or_number, collectibles_or_date, collectibles_date_added, collectibles_status)
    VALUES ('$company','$totalamount','$ponumber', '$invoicenumber','$invoicedate','$maturitydate', '$drnumber','$deliverydate','$remarkspaid', '$ornumber','$ordate', NOW(),'1')";
        $query = mysqli_query($db_conn, $sql_code);
        echo "successinsert";

    }

    exit();

}

if (isset($_POST["deletecollectiblesid"])) {

    include_once "../include/db_conn.php";
    include_once "../include/loginstatus.php";

    $rid = $_POST['deletecollectiblesid'];

    $sql = "UPDATE hurtajadmin_collectibles SET collectibles_status='3' WHERE id='$rid' LIMIT 1";
    $query = mysqli_query($db_conn, $sql);
    echo "successupdate";

    exit();

}

if (isset($_POST["markpaidcollectiblesid"])) {

    include_once "../include/db_conn.php";
    include_once "../include/loginstatus.php";

    $rid = $_POST['markpaidcollectiblesid'];
    $leftdays = $_POST['markpaidcollectiblesleftdays'];
    $exceeddays = $_POST['markpaidcollectiblesexceeddays'];

    $sql = "UPDATE hurtajadmin_collectibles SET collectibles_status='2', collectibles_paid_left_days='$leftdays', collectibles_paid_exceed_days='$exceeddays' WHERE id='$rid' LIMIT 1";
    $query = mysqli_query($db_conn, $sql);
    echo "successupdate";

    exit();

}

if (isset($_POST["markunpaidcollectiblesid"])) {

    include_once "../include/db_conn.php";
    include_once "../include/loginstatus.php";

    $rid = $_POST['markunpaidcollectiblesid'];

    $sql = "UPDATE hurtajadmin_collectibles SET collectibles_status='1' WHERE id='$rid' LIMIT 1";
    $query = mysqli_query($db_conn, $sql);
    echo "successupdate";

    exit();

}

if (isset($_POST["markmanypaidcollectiblesarrayid"])) {

    include_once "../include/db_conn.php";
    include_once "../include/loginstatus.php";

    $arrayid = $_POST['markmanypaidcollectiblesarrayid'];

    $idlistarray = explode(',', $arrayid);

    for ($i = 0; $i < count($idlistarray); $i++) {
        $rid = $idlistarray[$i];
        $sql = "SELECT * FROM hurtajadmin_collectibles WHERE id = '$rid' AND collectibles_status = '1' LIMIT 1";
        $query = mysqli_query($db_conn, $sql);
        while ($row = mysqli_fetch_array($query)) {
            $maturitydate = $row["collectibles_maturity_date"];

            $now = time(); // or your date as well
            $your_date = strtotime($maturitydate);
            $datediff = $your_date - $now;
            $datediff = round($datediff / (60 * 60 * 24));

            $exceeddays = 0;
            $leftdays = 0;

            if ($datediff < 0) {
                $exceeddays = abs($datediff);
            } else if ($datediff > 0) {
                $leftdays = $datediff;
            }

            $sql_u = "UPDATE hurtajadmin_collectibles SET collectibles_status='2', collectibles_paid_left_days='$leftdays', collectibles_paid_exceed_days='$exceeddays' WHERE id='$rid' LIMIT 1";
            $query_u = mysqli_query($db_conn, $sql_u);
        }
    }

    echo "successupdate";

    exit();

}


if (isset($_POST["markmanyunpaidcollectiblesarrayid"])) {

    include_once "../include/db_conn.php";
    include_once "../include/loginstatus.php";

    $arrayid = $_POST['markmanyunpaidcollectiblesarrayid'];

    $idlistarray = explode(',', $arrayid);

    for ($i = 0; $i < count($idlistarray); $i++) {
        $rid = $idlistarray[$i];

        $sql_u = "UPDATE hurtajadmin_collectibles SET collectibles_status='1' WHERE id='$rid' LIMIT 1";
        $query_u = mysqli_query($db_conn, $sql_u);
        
    }

    echo "successupdate";

    exit();

}

if (isset($_POST["deletemanycollectiblesarrayid"])) {

    include_once "../include/db_conn.php";
    include_once "../include/loginstatus.php";

    $arrayid = $_POST['deletemanycollectiblesarrayid'];

    $idlistarray = explode(',', $arrayid);

    for ($i = 0; $i < count($idlistarray); $i++) {
        $rid = $idlistarray[$i];
        $sql_u = "UPDATE hurtajadmin_collectibles SET collectibles_status='3' WHERE id='$rid' LIMIT 1";
        $query_u = mysqli_query($db_conn, $sql_u);
    }

    echo "successupdate";

    exit();

}

if (isset($_POST["markpaidpayablesid"])) {

    include_once "../include/db_conn.php";
    include_once "../include/loginstatus.php";

    $rid = $_POST['markpaidpayablesid'];
    $leftdays = $_POST['markpaidpayablesleftdays'];
    $exceeddays = $_POST['markpaidpayablesexceeddays'];

    $sql = "UPDATE hurtajadmin_payables SET payables_status='2', payables_paid_left_days='$leftdays', payables_paid_exceed_days='$exceeddays' WHERE id='$rid' LIMIT 1";
    $query = mysqli_query($db_conn, $sql);
    echo "successupdate";

    exit();

}

if (isset($_POST["markunpaidpayablesid"])) {

    include_once "../include/db_conn.php";
    include_once "../include/loginstatus.php";

    $rid = $_POST['markunpaidpayablesid'];

    $sql = "UPDATE hurtajadmin_payables SET payables_status='1' WHERE id='$rid' LIMIT 1";
    $query = mysqli_query($db_conn, $sql);
    echo "successupdate";

    exit();

}

if (isset($_POST["markmanypaidpayablesarrayid"])) {

    include_once "../include/db_conn.php";
    include_once "../include/loginstatus.php";

    $arrayid = $_POST['markmanypaidpayablesarrayid'];

    $idlistarray = explode(',', $arrayid);

    for ($i = 0; $i < count($idlistarray); $i++) {
        $rid = $idlistarray[$i];
        $sql = "SELECT * FROM hurtajadmin_payables WHERE id = '$rid' AND payables_status = '1' LIMIT 1";
        $query = mysqli_query($db_conn, $sql);
        while ($row = mysqli_fetch_array($query)) {
            $maturitydate = $row["payables_maturity_date"];

            $now = time(); // or your date as well
            $your_date = strtotime($maturitydate);
            $datediff = $your_date - $now;
            $datediff = round($datediff / (60 * 60 * 24));

            $exceeddays = 0;
            $leftdays = 0;

            if ($datediff < 0) {
                $exceeddays = abs($datediff);
            } else if ($datediff > 0) {
                $leftdays = $datediff;
            }

            $sql_h = "UPDATE hurtajadmin_payables SET payables_status='2', payables_paid_left_days='$leftdays', payables_paid_exceed_days='$exceeddays' WHERE id='$rid' LIMIT 1";
            $query_h = mysqli_query($db_conn, $sql_h); 
        }
    }

    echo "successupdate";

    exit();

}

if (isset($_POST["markmanyunpaidpayablesarrayid"])) {

    include_once "../include/db_conn.php";
    include_once "../include/loginstatus.php";

    $arrayid = $_POST['markmanyunpaidpayablesarrayid'];

    $idlistarray = explode(',', $arrayid);

    for ($i = 0; $i < count($idlistarray); $i++) {
        $rid = $idlistarray[$i];
        $sql_h = "UPDATE hurtajadmin_payables SET payables_status='1' WHERE id='$rid' LIMIT 1";
        $query_h = mysqli_query($db_conn, $sql_h);   
    }

    echo "successupdate";

    exit();

}

if (isset($_POST["deletemanypayablesarrayid"])) {

    include_once "../include/db_conn.php";
    include_once "../include/loginstatus.php";

    $arrayid = $_POST['deletemanypayablesarrayid'];

    $idlistarray = explode(',', $arrayid);

    for ($i = 0; $i < count($idlistarray); $i++) {
        $rid = $idlistarray[$i];
        $sql_u = "UPDATE hurtajadmin_payables SET payables_status='3' WHERE id='$rid' LIMIT 1";
        $query_u = mysqli_query($db_conn, $sql_u);
    }

    echo "successupdate";

    exit();

}

if (isset($_POST["editcollectiblesid"])) {

    include_once "../include/db_conn.php";
    include_once "../include/loginstatus.php";

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

    $sql = "UPDATE hurtajadmin_collectibles SET company_id='$company', collectibles_total_amount='$totalamount', collectibles_po_number='$ponumber', collectibles_invoice_number='$invoicenumber', collectibles_invoice_date='$invoicedate', collectibles_maturity_date='$maturitydate', collectibles_dr_number='$drnumber', collectibles_delivery_date='$deliverydate', collectibles_remarks_paid='$remarkspaid', collectibles_or_number='$ornumber', collectibles_or_date='$ordate' WHERE id='$rid' LIMIT 1";
    $query = mysqli_query($db_conn, $sql);
    echo "successupdate";

    exit();

}

if (isset($_POST["addemployeefname"])) {

    include_once "../include/db_conn.php";
    include_once "../include/loginstatus.php";

    $fname = $_POST['addemployeefname'];
    $mname = $_POST['addemployeemname'];
    $lname = $_POST['addemployeelname'];
    $gender = $_POST['addemployeegender'];
    $birthday = $_POST['addemployeebirthday'];
    $contact = $_POST['addemployeecontact'];
    $address = $_POST['addemployeeaddress'];
    $hired = $_POST['addemployeehired'];
    $starto = $_POST['addemployeestart'];
    $endo = $_POST['addemployeeend'];
    $status = $_POST['addemployeeemp_status'];
    $tin = !empty($_POST['editemployeetin']) ? $_POST['editemployeetin'] : "NULL";
    $pagibig = !empty($_POST['editemployeepagibig']) ? $_POST['editemployeepagibig'] : "NULL";
    $philhealth = !empty($_POST['editemployeephilhealth']) ? $_POST['editemployeephilhealth'] : "NULL";
    $sss = !empty($_POST['editemployeesss']) ? $_POST['editemployeesss'] : "NULL";

    $mname = ucfirst($mname);
    $lname = ucfirst($lname);

    $birthday = date("Y-m-d H:i:s", strtotime($birthday));
    $hired = date("Y-m-d H:i:s", strtotime($hired));
    $starto = date("Y-m-d H:i:s", strtotime($starto));
    $endo = date("Y-m-d H:i:s", strtotime($endo));

    $sql = "SELECT * FROM hurtajadmin_employee WHERE employee_fname='$fname' AND employee_mname='$mname' AND employee_lname='$lname' AND employee_birthday='$birthday' AND employee_phone='$contact' AND employee_status = '1' LIMIT 1";
    $query = mysqli_query($db_conn, $sql);
    $check = mysqli_num_rows($query);

    if ($check > 0) {

        echo "exist";

    } else {

        $sql1 = "SELECT * FROM hurtajadmin_employee ORDER BY id DESC LIMIT 1";
        $query1 = mysqli_query($db_conn, $sql1);
        $check1 = mysqli_num_rows($query1);
        $empid = "";

        if ($check1 > 0) {
            while ($row1 = mysqli_fetch_array($query1, MYSQLI_ASSOC)) {
                $empid = $row1["employee_id"];
                $empid = (int) $empid;
                $empid = $empid + 1;
                $empid = str_pad($empid, 6, "0", STR_PAD_LEFT);
            }
        } else {
            $empid = "000001";
        }

        $sql2 = "INSERT INTO hurtajadmin_employee (employee_id, employee_fname, employee_mname, employee_lname, employee_gender, employee_birthday, employee_phone, employee_address, employee_date_hired, employee_date_start, employee_date_end, employee_date_added, employee_status)
    VALUES ('$empid','$fname','$mname','$lname','$gender','$birthday','$contact','$address','$hired','$starto','$endo',NOW(),'1')";
        $query2 = mysqli_query($db_conn, $sql2);

        $sql3 = "SELECT * FROM hurtajadmin_employee WHERE employee_id='$empid' LIMIT 1";
        $query3 = mysqli_query($db_conn, $sql3);
        while ($row3 = mysqli_fetch_array($query3)) {
            $eid = $row3["id"];
        }

        $sql4 = "INSERT INTO hurtajadmin_employee_identification (employee_id, emp_id, employee_identification_tin, employee_identification_pagibig, employee_identification_philhealth, employee_identification_sss)
      VALUES ('$eid','$empid',$tin,$pagibig,$philhealth,$sss)";
        $query4 = mysqli_query($db_conn, $sql4);

        $sql5 = "INSERT INTO hurtajadmin_employee_settings (employee_id, emp_id, employee_settings_tax, employee_settings_pagibig, employee_settings_sss, employee_settings_philhealth)
      VALUES ('$eid','$empid','1','1','1','1')";
        $query5 = mysqli_query($db_conn, $sql5);

        echo "successinsert";

    }

    exit();

}

if (isset($_POST["editpayrollsettingsempid"])) {

    include_once "../include/db_conn.php";
    include_once "../include/loginstatus.php";

    $empid = $_POST['editpayrollsettingsempid'];
    $eid = $_POST['editpayrollsettingseid'];
    $salaryhour = $_POST['editpayrollsettingssalaryhour'];
    $tax = $_POST['editpayrollsettingstax'];
    $pagibig = $_POST['editpayrollsettingspagibig'];
    $sss = $_POST['editpayrollsettingssss'];
    $health = $_POST['editpayrollsettingsphilhealth'];

    $salaryhour = str_replace("₱", "", $salaryhour);
    $salaryhour = str_replace(",", "", $salaryhour);

    $sql = "SELECT * FROM hurtajadmin_employee_settings WHERE employee_id = '$empid' LIMIT 1";
    $query = mysqli_query($db_conn, $sql);
    $check = mysqli_num_rows($query);

    if ($check > 0) {
        $sql1 = "UPDATE hurtajadmin_employee_settings SET employee_settings_perhour='$salaryhour', employee_settings_tax='$tax', employee_settings_pagibig='$pagibig', employee_settings_sss='$sss', employee_settings_philhealth='$health' WHERE employee_id='$empid' LIMIT 1";
        $query1 = mysqli_query($db_conn, $sql1);
    } else {
        $sql_code = "INSERT INTO hurtajadmin_employee_settings (employee_id, emp_id, employee_settings_perhour, employee_settings_tax, employee_settings_pagibig, employee_settings_sss, employee_settings_philhealth)
      VALUES ('$empid','$eid','$salaryhour','$tax','$pagibig','$sss','$health')";
        $query = mysqli_query($db_conn, $sql_code);
    }

    echo "successupdate";

    exit();

}

if (isset($_POST["editemployeeid"])) {

    include_once "../include/db_conn.php";
    include_once "../include/loginstatus.php";

    $rid = $_POST['editemployeeid'];
    $fname = $_POST['editemployeefname'];
    $mname = $_POST['editemployeemname'];
    $lname = $_POST['editemployeelname'];
    $gender = $_POST['editemployeegender'];
    $birthday = $_POST['editemployeebirthday'];
    $address = $_POST['editemployeeaddress'];
    $contact = $_POST['editemployeecontact'];
    $hired = $_POST['editemployeedatehired'];
    $start = $_POST['editemployeedatestart'];
    $end = $_POST['editemployeedateend'];
    $emp_status = $_POST['editemployeestatus'];

    $tin = !empty($_POST['editemployeetin']) ? $_POST['editemployeetin'] : "NULL";
    $pagibig = !empty($_POST['editemployeepagibig']) ? $_POST['editemployeepagibig'] : "NULL";
    $philhealth = !empty($_POST['editemployeephilhealth']) ? $_POST['editemployeephilhealth'] : "NULL";
    $sss = !empty($_POST['editemployeesss']) ? $_POST['editemployeesss'] : "NULL";

    $birthday = date("Y-m-d H:i:s", strtotime($birthday));
    $hired = date("Y-m-d H:i:s", strtotime($hired));
    $start = date("Y-m-d H:i:s", strtotime($start));
    $end = date("Y-m-d H:i:s", strtotime($end));

    $sql1 = "UPDATE hurtajadmin_employee SET employee_fname='$fname', employee_mname='$mname', employee_lname='$lname', employee_gender='$gender', employee_birthday='$birthday', employee_phone='$contact', employee_address='$address', employee_date_hired='$hired', employee_date_start='$start', employee_date_end='$end', employee_status='$emp_status' WHERE id='$rid' LIMIT 1";
    $query1 = mysqli_query($db_conn, $sql1);

    $sql2 = "UPDATE hurtajadmin_employee_identification SET employee_identification_tin=$tin, employee_identification_pagibig=$pagibig, employee_identification_philhealth=$philhealth, employee_identification_sss=$sss WHERE employee_id='$rid' LIMIT 1";
    $query2 = mysqli_query($db_conn, $sql2);

    echo "successupdate";

    exit();

}

if (isset($_POST["addcashloanadvanceempid"])) {

    include_once "../include/db_conn.php";
    include_once "../include/loginstatus.php";

    $empid = $_POST['addcashloanadvanceempid'];
    $type = $_POST['addcashloanadvancetype'];
    $amount = $_POST['addcashloanadvanceamount'];

    $amount = str_replace('₱', '', $amount);
    $amount = str_replace(',', '', $amount);

    $sql = "SELECT * FROM hurtajadmin_employee WHERE employee_id = '$empid' LIMIT 1";
    $query = mysqli_query($db_conn, $sql);
    $check = mysqli_num_rows($query);

    if ($check > 0) {
        $sql1 = "INSERT INTO hurtajadmin_cash_loan_advance (employee_id, cash_loan_advance_type, cash_loan_advance_amount, cash_loan_advance_date, cash_loan_advance_status)
      VALUES ('$empid','$type','$amount', NOW(),'1')";
        $query1 = mysqli_query($db_conn, $sql1);
        echo "successinsert";
    } else {
        echo "noemployee";
    }

    exit();

}

if (isset($_POST["editcashloanadvancerid"])) {

    include_once "../include/db_conn.php";
    include_once "../include/loginstatus.php";

    $rid = $_POST['editcashloanadvancerid'];
    $empid = $_POST['editcashloanadvanceempid'];
    $type = $_POST['editcashloanadvancetype'];
    $amount = $_POST['editcashloanadvanceamount'];

    $amount = str_replace('₱', '', $amount);
    $amount = str_replace(',', '', $amount);

    $sql = "SELECT * FROM hurtajadmin_employee WHERE employee_id = '$empid' LIMIT 1";
    $query = mysqli_query($db_conn, $sql);
    $check = mysqli_num_rows($query);

    if ($check > 0) {
        $sql = "UPDATE hurtajadmin_cash_loan_advance SET employee_id='$empid', cash_loan_advance_type='$type', cash_loan_advance_amount='$amount' WHERE id='$rid' LIMIT 1";
        $query = mysqli_query($db_conn, $sql);
        echo "successupdate";
    } else {
        echo "noemployee";
    }

    exit();

}

if (isset($_POST["deletecashloanadvnaceid"])) {

    include_once "../include/db_conn.php";
    include_once "../include/loginstatus.php";

    $rid = $_POST['deletecashloanadvnaceid'];

    $sql = "UPDATE hurtajadmin_cash_loan_advance SET cash_loan_advance_status='2' WHERE id='$rid' LIMIT 1";
    $query = mysqli_query($db_conn, $sql);
    echo "successupdate";

    exit();

}

if (isset($_POST["deleteemployeeid"])) {

    include_once "../include/db_conn.php";
    include_once "../include/loginstatus.php";

    $rid = $_POST['deleteemployeeid'];

    $sql = "UPDATE hurtajadmin_employee SET employee_status='5' WHERE id='$rid' LIMIT 1";
    $query = mysqli_query($db_conn, $sql);
    echo "successupdate";

    exit();

}

if (isset($_POST["deletepayslipid"])) {

    include_once "../include/db_conn.php";
    include_once "../include/loginstatus.php";

    $rid = $_POST['deletepayslipid'];
    $type = $_POST['deletepaysliptype'];

    if ($type == "1") {
        $sql = "UPDATE hurtajadmin_regular_payslip SET regular_payslip_status='2' WHERE regular_payslip_payslip_id='$rid'";
        $query = mysqli_query($db_conn, $sql);
    } else if ($type == "2") {
        $sql = "UPDATE hurtajadmin_tertint_payslip SET tertint_payslip_status='2' WHERE tertint_payslip_payslip_id='$rid'";
        $query = mysqli_query($db_conn, $sql);
    }
    echo "successupdate";

    exit();

}

if (isset($_POST["editssscontributionid"])) {

    include_once "../include/db_conn.php";
    include_once "../include/loginstatus.php";

    $rid = $_POST['editssscontributionid'];
    $amount = $_POST['editssscontributionamount'];

    $amount = str_replace("₱", "", $amount);
    $amount = str_replace(",", "", $amount);

    $sql = "SELECT * FROM hurtajadmin_sss_contribution";
    $query = mysqli_query($db_conn, $sql);
    $check = mysqli_num_rows($query);
    if ($check < 1) {
        $sql_code = "INSERT INTO hurtajadmin_sss_contribution (id, sss_contribution_range_from, sss_contribution_range_to) VALUES ('1', '1000','1249'),('2', '1250','1749'),('3', '1750','2249'),('4', '2250','2749'),('5', '2750','3249'),('6', '3250','3749'),('7', '3750','4249'),('8', '4250','4749'),('9', '4750','5249'),('10', '5250','5749'),('11', '5750','6249'),('12', '6250','6749'),('13', '6750','7249'),('14', '7250','7749'),('15', '7750','8249'),('16', '8250','8749'),('17', '8750','9249'),('18', '9250','9749'),('19', '9750','10249'),('20', '10250','10749'),('21', '10750','11249'),('22', '11250','11749'),('23', '11750','12249'),('24', '12250','12749'),('25', '12750','13249'),('26', '13250','13749'),('27', '13750','14249'),('28', '14259','14749'),('29', '14750','15249'),('30', '15250','15749'),('31', '15750','1000000')";
        $query_code = mysqli_query($db_conn, $sql_code);
    }

    $sql1 = "UPDATE hurtajadmin_sss_contribution SET sss_contribution_contribution='$amount' WHERE id='$rid' LIMIT 1";
    $query1 = mysqli_query($db_conn, $sql1);

    echo "successupdate";

    exit();

}

if (isset($_POST["editphilhealthcontributionid"])) {

    include_once "../include/db_conn.php";
    include_once "../include/loginstatus.php";

    $rid = $_POST['editphilhealthcontributionid'];
    $amount = $_POST['editphilhealthcontributionamount'];

    $amount = str_replace("₱", "", $amount);
    $amount = str_replace(",", "", $amount);

    $sql = "SELECT * FROM hurtajadmin_philhealth_contribution";
    $query = mysqli_query($db_conn, $sql);
    $check = mysqli_num_rows($query);
    if ($check < 1) {
        $sql_code = "INSERT INTO hurtajadmin_philhealth_contribution (id, philhealth_contribution_range_from, philhealth_contribution_range_to) VALUES ('1', '0','8999'),('2', '9000','9999'),('3', '10000','10999'),('4', '11000','11999'),('5', '12000','12999'),('6', '13000','13999'),('7', '14000','14999'),('8', '15000','15999'),('9', '16000','16999'),('10', '17000','17999'),('11', '18000','18999'),('12', '19000','19999'),('13', '20000','20999'),('14', '9000','9999'),('15', '21000','21999'),('16', '22000','22999'),('17', '23000','23999'),('18', '24000','24999'),('19', '25000','25999'),('20', '26000','26999'),('21', '27000','27999'),('22', '28000','28999'),('23', '29000','29999'),('24', '30000','30999'),('25', '31000','31999'),('26', '32000','32999'),('27', '33000','33999'),('28', '34000','34999'),('29', '35000','35999'),('30', '36000','36999'),('31', '37000','37999'),('32', '38000','38999'),('33', '39000','1000000')";
        $query_code = mysqli_query($db_conn, $sql_code);
    }

    $sql1 = "UPDATE hurtajadmin_philhealth_contribution SET philhealth_contribution_contribution='$amount' WHERE id='$rid' LIMIT 1";
    $query1 = mysqli_query($db_conn, $sql1);

    echo "successupdate";

    exit();

}

if (isset($_POST["editpagibigcontributionid"])) {

    include_once "../include/db_conn.php";
    include_once "../include/loginstatus.php";

    $rid = $_POST['editpagibigcontributionid'];
    $amount = $_POST['editpagibigcontributionamount'];

    $amount = str_replace("₱", "", $amount);
    $amount = str_replace(",", "", $amount);

    $sql = "SELECT * FROM hurtajadmin_pagibig_contribution";
    $query = mysqli_query($db_conn, $sql);
    $check = mysqli_num_rows($query);
    if ($check < 1) {
        $sql_code = "INSERT INTO hurtajadmin_pagibig_contribution (id, pagibig_contribution_range_from, pagibig_contribution_range_to) VALUES ('1', '0','1500'),('2', '1501','1000000')";
        $query_code = mysqli_query($db_conn, $sql_code);
    }

    $sql1 = "UPDATE hurtajadmin_pagibig_contribution SET pagibig_contribution_contribution='$amount' WHERE id='$rid' LIMIT 1";
    $query1 = mysqli_query($db_conn, $sql1);

    echo "successupdate";

    exit();

}

if (isset($_POST["edittaxcontributionid"])) {

    include_once "../include/db_conn.php";
    include_once "../include/loginstatus.php";

    $rid = $_POST['edittaxcontributionid'];
    $amount = $_POST['edittaxcontributionamount'];

    $amount = str_replace("₱", "", $amount);
    $amount = str_replace(",", "", $amount);

    $sql = "SELECT * FROM hurtajadmin_tax_contribution";
    $query = mysqli_query($db_conn, $sql);
    $check = mysqli_num_rows($query);
    if ($check < 1) {
        $sql_code = "INSERT INTO hurtajadmin_tax_contribution (id, tax_contribution_range_from, tax_contribution_range_to) VALUES ('1', '0','10417'),('2', '10418','16667'),('3', '16668','33333'),('4', '33334','83333'),('5', '83334','333333')";
        $query_code = mysqli_query($db_conn, $sql_code);
    }

    $sql1 = "UPDATE hurtajadmin_tax_contribution SET tax_contribution_contribution='$amount' WHERE id='$rid' LIMIT 1";
    $query1 = mysqli_query($db_conn, $sql1);

    echo "successupdate";

    exit();

}

if (isset($_POST["addholidayname"])) {

    include_once "../include/db_conn.php";
    include_once "../include/loginstatus.php";

    $name = $_POST['addholidayname'];
    $type = $_POST['addholidaytype'];
    $date1 = $_POST['addholidaydate1'];
    $date2 = $_POST['addholidaydate2'];

    $date1 = date("Y-m-d H:i:s", strtotime($date1));
    $date2 = date("Y-m-d H:i:s", strtotime($date2));

    if ($type == "1") {

        $sql = "SELECT * FROM hurtajadmin_holidays WHERE holidays_name='$name' AND holidays_type='$type' AND holidays_date='$date1' AND holidays_status = '1' LIMIT 1";
        $query = mysqli_query($db_conn, $sql);
        $check = mysqli_num_rows($query);

    } else if ($type == "2") {

        $sql = "SELECT * FROM hurtajadmin_holidays WHERE holidays_name='$name' AND holidays_type='$type' AND holidays_date='$date2' AND holidays_status = '1' LIMIT 1";
        $query = mysqli_query($db_conn, $sql);
        $check = mysqli_num_rows($query);

    }

    if ($check > 0) {

        echo "exist";

    } else {

        if ($type == "1") {
            $sql_code = "INSERT INTO hurtajadmin_holidays (holidays_name, holidays_type, holidays_date, holidays_date_added,   holidays_status)
      VALUES ('$name','$type','$date1',NOW(),'1')";
            $query = mysqli_query($db_conn, $sql_code);
            echo "successinsert";
        } else if ($type == "2") {
            $sql_code = "INSERT INTO hurtajadmin_holidays (holidays_name, holidays_type, holidays_date, holidays_date_added,   holidays_status)
      VALUES ('$name','$type','$date2',NOW(),'1')";
            $query = mysqli_query($db_conn, $sql_code);
            echo "successinsert";
        }

    }

    exit();

}

if (isset($_POST["editholidayid"])) {

    include_once "../include/db_conn.php";
    include_once "../include/loginstatus.php";

    $rid = $_POST['editholidayid'];
    $name = $_POST['editholidayname'];
    $type = $_POST['editholidaytype'];
    $date1 = $_POST['editholidaydate1'];
    $date2 = $_POST['editholidaydate2'];

    $date1 = date("Y-m-d H:i:s", strtotime($date1));
    $date2 = date("Y-m-d H:i:s", strtotime($date2));

    if ($type == "1") {

        $sql = "SELECT * FROM hurtajadmin_holidays WHERE holidays_name='$name' AND holidays_type='$type' AND holidays_date='$date1' AND holidays_status = '1' LIMIT 1";
        $query = mysqli_query($db_conn, $sql);
        $check = mysqli_num_rows($query);

    } else if ($type == "2") {

        $sql = "SELECT * FROM hurtajadmin_holidays WHERE holidays_name='$name' AND holidays_type='$type' AND holidays_date='$date2' AND holidays_status = '1' LIMIT 1";
        $query = mysqli_query($db_conn, $sql);
        $check = mysqli_num_rows($query);

    }

    if ($check > 0) {

        echo "exist";

    } else {

        if ($type == "1") {
            $sql1 = "UPDATE hurtajadmin_holidays SET holidays_name='$name', holidays_type='$type', holidays_date='$date1' WHERE id = '$rid' LIMIT 1";
            $query1 = mysqli_query($db_conn, $sql1);
            echo "successupdate";

        } else if ($type == "2") {
            $sql1 = "UPDATE hurtajadmin_holidays SET holidays_name='$name', holidays_type='$type', holidays_date='$date2' WHERE id = '$rid' LIMIT 1";
            $query1 = mysqli_query($db_conn, $sql1);
            echo "successupdate";

        }

    }

    exit();

}

if (isset($_POST["deleteholidayid"])) {

    include_once "../include/db_conn.php";
    include_once "../include/loginstatus.php";

    $rid = $_POST['deleteholidayid'];

    $sql = "UPDATE hurtajadmin_holidays SET holidays_status='2' WHERE id='$rid' LIMIT 1";
    $query = mysqli_query($db_conn, $sql);
    echo "successupdate";

    exit();

}

if (isset($_POST["editholidayrateid"])) {

    include_once "../include/db_conn.php";
    include_once "../include/loginstatus.php";

    $rid = $_POST['editholidayrateid'];
    $percent = $_POST['editholidayratepercent'];

    $percent = str_replace("₱", "", $percent);
    $percent = str_replace(",", "", $percent);

    $sql = "SELECT * FROM hurtajadmin_holiday_rate";
    $query = mysqli_query($db_conn, $sql);
    $check = mysqli_num_rows($query);
    if ($check < 1) {
        $sql_code = "INSERT INTO hurtajadmin_holiday_rate (id, holiday_rate_name, holiday_rate_percent) VALUES ('1', 'regular',''),('2', 'special','')";
        $query_code = mysqli_query($db_conn, $sql_code);
    }

    $sql1 = "UPDATE hurtajadmin_holiday_rate SET holiday_rate_percent='$percent' WHERE id='$rid' LIMIT 1";
    $query1 = mysqli_query($db_conn, $sql1);

    echo "successupdate";

    exit();

}

if (isset($_POST["addholidayname"])) {

    include_once "../include/db_conn.php";
    include_once "../include/loginstatus.php";

    $name = $_POST['addholidayname'];
    $type = $_POST['addholidaytype'];
    $date1 = $_POST['addholidaydate1'];
    $date2 = $_POST['addholidaydate2'];

    $date1 = date("Y-m-d H:i:s", strtotime($date1));
    $date2 = date("Y-m-d H:i:s", strtotime($date2));

    if ($type == "1") {

        $sql = "SELECT * FROM hurtajadmin_holidays WHERE holidays_name='$name' AND holidays_type='$type' AND holidays_date='$date1' AND holidays_status = '1' LIMIT 1";
        $query = mysqli_query($db_conn, $sql);
        $check = mysqli_num_rows($query);

    } else if ($type == "2") {

        $sql = "SELECT * FROM hurtajadmin_holidays WHERE holidays_name='$name' AND holidays_type='$type' AND holidays_date='$date2' AND holidays_status = '1' LIMIT 1";
        $query = mysqli_query($db_conn, $sql);
        $check = mysqli_num_rows($query);

    }

    if ($check > 0) {

        echo "exist";

    } else {

        if ($type == "1") {
            $sql_code = "INSERT INTO hurtajadmin_holidays (holidays_name, holidays_type, holidays_date, holidays_date_added,   holidays_status)
      VALUES ('$name','$type','$date1',NOW(),'1')";
            $query = mysqli_query($db_conn, $sql_code);
            echo "successinsert";
        } else if ($type == "2") {
            $sql_code = "INSERT INTO hurtajadmin_holidays (holidays_name, holidays_type, holidays_date, holidays_date_added,   holidays_status)
      VALUES ('$name','$type','$date2',NOW(),'1')";
            $query = mysqli_query($db_conn, $sql_code);
            echo "successinsert";
        }

    }

    exit();

}

if (isset($_POST["editholidayid"])) {

    include_once "../include/db_conn.php";
    include_once "../include/loginstatus.php";

    $rid = $_POST['editholidayid'];
    $name = $_POST['editholidayname'];
    $type = $_POST['editholidaytype'];
    $date1 = $_POST['editholidaydate1'];
    $date2 = $_POST['editholidaydate2'];

    $date1 = date("Y-m-d H:i:s", strtotime($date1));
    $date2 = date("Y-m-d H:i:s", strtotime($date2));

    if ($type == "1") {

        $sql = "SELECT * FROM hurtajadmin_holidays WHERE holidays_name='$name' AND holidays_type='$type' AND holidays_date='$date1' AND holidays_status = '1' LIMIT 1";
        $query = mysqli_query($db_conn, $sql);
        $check = mysqli_num_rows($query);

    } else if ($type == "2") {

        $sql = "SELECT * FROM hurtajadmin_holidays WHERE holidays_name='$name' AND holidays_type='$type' AND holidays_date='$date2' AND holidays_status = '1' LIMIT 1";
        $query = mysqli_query($db_conn, $sql);
        $check = mysqli_num_rows($query);

    }

    if ($check > 0) {

        echo "exist";

    } else {

        if ($type == "1") {
            $sql1 = "UPDATE hurtajadmin_holidays SET holidays_name='$name', holidays_type='$type', holidays_date='$date1' WHERE id = '$rid' LIMIT 1";
            $query1 = mysqli_query($db_conn, $sql1);
            echo "successupdate";

        } else if ($type == "2") {
            $sql1 = "UPDATE hurtajadmin_holidays SET holidays_name='$name', holidays_type='$type', holidays_date='$date2' WHERE id = '$rid' LIMIT 1";
            $query1 = mysqli_query($db_conn, $sql1);
            echo "successupdate";

        }

    }

    exit();

}

if (isset($_POST["deleteholidayid"])) {

    include_once "../include/db_conn.php";
    include_once "../include/loginstatus.php";

    $rid = $_POST['deleteholidayid'];

    $sql = "UPDATE hurtajadmin_holidays SET holidays_status='2' WHERE id='$rid' LIMIT 1";
    $query = mysqli_query($db_conn, $sql);
    echo "successupdate";

    exit();

}

if (isset($_POST["deleteleaveeid"])) {

    include_once "../include/db_conn.php";
    include_once "../include/loginstatus.php";

    $rid = $_POST['deleteleaveeid'];
    $sql = "UPDATE hurtajadmin_leave SET leave_status='4' WHERE id='$rid' LIMIT 1";
    $query = mysqli_query($db_conn, $sql);
    echo "successupdate";

    exit();

}

if (isset($_POST["approveleaveeid"])) {

    include_once "../include/db_conn.php";
    include_once "../include/loginstatus.php";

    $rid = $_POST['approveleaveeid'];

    $sql2 = "SELECT * FROM hurtajadmin_leave WHERE id = '$rid' LIMIT 1";
    $query2 = mysqli_query($db_conn, $sql2);
    while ($row2 = mysqli_fetch_array($query2)) {
        $empid = $row2['employee_id'];
        $type = $row2['leave_type'];
        $start = $row2['leave_start'];
        $end = $row2['leave_end'];
        $date = $row2['leave_date'];
        $reason = $row2['leave_reason'];
        $remarks = $row2['leave_remarks'];
    }

    $sql_leave = "SELECT * FROM hurtajadmin_leave WHERE employee_id = '$empid' AND leave_status = '2' AND YEAR(leave_date) = YEAR(CURDATE())";
    $query_leave = mysqli_query($db_conn, $sql_leave);
    $countleave = mysqli_num_rows($query_leave);

    if ($countleave < 5) {

        $sql = "UPDATE hurtajadmin_leave SET leave_status='2' WHERE id='$rid' LIMIT 1";
        $query = mysqli_query($db_conn, $sql);

        $start = date("Y-m-d H:i:s", strtotime($start));
        $end = date("Y-m-d H:i:s", strtotime($end));
        $date = date("Y-m-d H:i:s", strtotime($date));

        $sql3 = "INSERT INTO hurtajadmin_leave_update_history (leave_id, leave_update_history_type, leave_update_history_start, leave_update_history_end, leave_update_history_date, leave_update_history_reason, leave_update_history_remarks, leave_update_history_status)
        VALUES ('$rid','$type','$start','$end', NOW(),'$reason','$remarks','2')";
        $query3 = mysqli_query($db_conn, $sql3);
        echo "successupdate";
        exit();

    } else {
        echo "allused";
    }

}

if (isset($_POST["declineleaveeid"])) {

    include_once "../include/db_conn.php";
    include_once "../include/loginstatus.php";

    $rid = $_POST['declineleaveeid'];

    $sql = "UPDATE hurtajadmin_leave SET leave_status='3' WHERE id='$rid' LIMIT 1";
    $query = mysqli_query($db_conn, $sql);
    echo "successupdate";

    $sql2 = "SELECT * FROM hurtajadmin_leave WHERE id = '$rid' LIMIT 1";
    $query2 = mysqli_query($db_conn, $sql2);
    while ($row2 = mysqli_fetch_array($query2)) {
        $rid = $row2["employee_id"];
        $empid = $row2['employee_id'];
        $type = $row2['leave_type'];
        $start = $row2['leave_start'];
        $end = $row2['leave_end'];
        $date = $row2['leave_date'];
        $reason = $row2['leave_reason'];
        $remarks = $row2['leave_remarks'];
    }

    $start = date("Y-m-d H:i:s", strtotime($start));
    $end = date("Y-m-d H:i:s", strtotime($end));
    $date = date("Y-m-d H:i:s", strtotime($date));

    $sql3 = "INSERT INTO hurtajadmin_leave_update_history (leave_id, leave_update_history_type, leave_update_history_start, leave_update_history_end, leave_update_history_date, leave_update_history_reason, leave_update_history_remarks, leave_update_history_status)
      VALUES ('$rid','$type','$start','$end', NOW(),'$reason','$remarks','3')";
    $query3 = mysqli_query($db_conn, $sql3);

    exit();

}

if (isset($_POST["addleaveempid"])) {

    include_once "../include/db_conn.php";
    include_once "../include/loginstatus.php";

    $leaveempid = $_POST['addleaveempid'];
    $leavelrtype = $_POST['addleavelrtype'];
    $leavelrstart = $_POST['addleavelrstart'];
    $leavelrend = $_POST['addleavelrend'];
    $leavelrdate = $_POST['addleavelrdate'];
    $leavelrreason = $_POST['addleavelrreason'];

    $leavelrstart = date("Y-m-d H:i:s", strtotime($leavelrstart));
    $leavelrend = date("Y-m-d H:i:s", strtotime($leavelrend));
    $leavelrdate = date("Y-m-d H:i:s", strtotime($leavelrdate));

    $sql = "SELECT employee_id FROM hurtajadmin_employee WHERE employee_id = '$leaveempid' LIMIT 1";
    $query = mysqli_query($db_conn, $sql);
    $check = mysqli_num_rows($query);

    if ($check != 1) {

        echo "nofound";
        exit();

    } else {

        $sql_leave = "SELECT * FROM hurtajadmin_leave WHERE employee_id = '$leaveempid' AND leave_status = '2' AND YEAR(leave_date) = YEAR(CURDATE())";
        $query_leave = mysqli_query($db_conn, $sql_leave);
        $countleave = mysqli_num_rows($query_leave);

        if ($countleave < 5) {

            $sql_code = "INSERT INTO hurtajadmin_leave (employee_id, leave_type, leave_start, leave_end, leave_date, leave_reason, leave_status)
      VALUES ('$leaveempid','$leavelrtype','$leavelrstart','$leavelrend','$leavelrdate','$leavelrreason','1')";
            $query = mysqli_query($db_conn, $sql_code);

            $sql2 = "SELECT * FROM hurtajadmin_leave ORDER BY id DESC LIMIT 1";
            $query2 = mysqli_query($db_conn, $sql2);
            while ($row2 = mysqli_fetch_array($query2)) {
                $rid = $row2["employee_id"];
            }

            $sql3 = "INSERT INTO hurtajadmin_leave_update_history (leave_id, leave_update_history_type, leave_update_history_start, leave_update_history_end, leave_update_history_date, leave_update_history_reason, leave_update_history_status)
        VALUES ('$rid','$leavelrtype','$leavelrstart','$leavelrend', NOW(),'$leavelrreason','1')";
            $query3 = mysqli_query($db_conn, $sql3);

            echo "successinsert";
            exit();

        } else {
            echo "allused";
        }

    }
}

if (isset($_POST["editleaveremarksrid"])) {

    include_once "../include/db_conn.php";
    include_once "../include/loginstatus.php";

    $rid = $_POST['editleaveremarksrid'];
    $remarks = $_POST['editleaveremarksremarks'];

    $sql1 = "UPDATE hurtajadmin_leave SET leave_remarks='$remarks' WHERE id='$rid' LIMIT 1";
    $query1 = mysqli_query($db_conn, $sql1);

    $sql2 = "SELECT * FROM hurtajadmin_leave WHERE id='$rid'";
    $query2 = mysqli_query($db_conn, $sql2);
    while ($row2 = mysqli_fetch_array($query2)) {
        $rid = $row2["employee_id"];
        $empid = $row2['employee_id'];
        $type = $row2['leave_type'];
        $start = $row2['leave_start'];
        $end = $row2['leave_end'];
        $date = $row2['leave_date'];
        $reason = $row2['leave_reason'];
        $status = $row2['leave_status'];
    }

    $newDateStart = date("Y-m-d H:i:s", strtotime($start));
    $newDateEnd = date("Y-m-d H:i:s", strtotime($end));

    $sql3 = "INSERT INTO hurtajadmin_leave_update_history (leave_id, leave_update_history_type, leave_update_history_start, leave_update_history_end, leave_update_history_date, leave_update_history_reason, leave_update_history_remarks, leave_update_history_status)
      VALUES ('$rid','$type','$newDateStart','$newDateEnd', NOW(),'$reason','$remarks','$status')";
    $query3 = mysqli_query($db_conn, $sql3);

    echo "successupdate";

    exit();

}

if (isset($_POST["addsuppliername"])) {

    include_once "../include/db_conn.php";
    include_once "../include/loginstatus.php";

    $name = $_POST['addsuppliername'];
    $address = $_POST['addsupplieraddress'];
    $contact = $_POST['addsuppliercontact'];

    $sql = "SELECT * FROM hurtajadmin_supplier WHERE supplier_name='$name' AND supplier_address='$address' AND supplier_contact='$contact' AND supplier_status = '1' LIMIT 1";
    $query = mysqli_query($db_conn, $sql);
    $check = mysqli_num_rows($query);

    if ($check > 0) {

        echo "exist";

    } else {

        $sql_code = "INSERT INTO hurtajadmin_supplier (supplier_name, supplier_address, supplier_contact, supplier_date_added, supplier_status)
    VALUES ('$name','$address','$contact',NOW(),'1')";
        $query = mysqli_query($db_conn, $sql_code);
        echo "successinsert";

    }

    exit();

}

if (isset($_POST["editsupplierid"])) {

    include_once "../include/db_conn.php";
    include_once "../include/loginstatus.php";

    $rid = $_POST['editsupplierid'];
    $name = $_POST['editsuppliername'];
    $address = $_POST['editsupplieraddress'];
    $contact = $_POST['editsuppliercontact'];

    $sql = "UPDATE hurtajadmin_supplier SET supplier_name='$name', supplier_address='$address', supplier_contact='$contact' WHERE id='$rid' LIMIT 1";
    $query = mysqli_query($db_conn, $sql);

    echo "successupdate";

    exit();

}

if (isset($_POST["deletesupplierid"])) {

    include_once "../include/db_conn.php";
    include_once "../include/loginstatus.php";

    $rid = $_POST['deletesupplierid'];

    $sql = "UPDATE hurtajadmin_supplier SET supplier_status='2' WHERE id='$rid' LIMIT 1";
    $query = mysqli_query($db_conn, $sql);
    echo "successupdate";

    exit();

}

if (isset($_POST["addpayablessupplier"])) {

    include_once "../include/db_conn.php";
    include_once "../include/loginstatus.php";

    $supplier = $_POST['addpayablessupplier'];
    $totalamount = $_POST['addpayablestotalamount'];
    $ponumber = $_POST['addpayablesponumber'];
    $invoicenumber = $_POST['addpayablesinvoicenumber'];
    $invoicedate = $_POST['addpayablesinvoicedate'];
    $maturitydate = $_POST['addpayablesmaturitydate'];
    $drnumber = $_POST['addpayablesdrnumber'];
    $deliverydate = $_POST['addpayablesdeliverydate'];
    $bank = $_POST['addpayablesbank'];
    $checknumber = $_POST['addpayableschecknumber'];
    $checkdate = $_POST['addpayablescheckdate'];

    $invoicedate = date("Y-m-d H:i:s", strtotime($invoicedate));
    $maturitydate = date("Y-m-d H:i:s", strtotime($maturitydate));
    $deliverydate = date("Y-m-d H:i:s", strtotime($deliverydate));
    $checkdate = date("Y-m-d H:i:s", strtotime($checkdate));

    $sql = "SELECT * FROM hurtajadmin_payables WHERE supplier_id='$supplier' AND payables_total_amount='$totalamount' AND payables_invoice_number='$invoicenumber' AND payables_invoice_date='$invoicedate' AND payables_status = '1' LIMIT 1";
    $query = mysqli_query($db_conn, $sql);
    $check = mysqli_num_rows($query);

    if ($check > 0) {

        echo "exist";

    } else {

        $sql_code = "INSERT INTO hurtajadmin_payables (supplier_id, payables_total_amount, payables_po_number, payables_invoice_number, payables_invoice_date, payables_maturity_date, payables_dr_number,  payables_delivery_date, payables_bank, payables_check_number, payables_check_date, payables_date_added, payables_status)
    VALUES ('$supplier','$totalamount','$ponumber', '$invoicenumber','$invoicedate','$maturitydate', '$drnumber','$deliverydate','$bank', '$checknumber','$checkdate', NOW(),'1')";
        $query = mysqli_query($db_conn, $sql_code);
        echo "successinsert";

    }

    exit();

}

if (isset($_POST["editpayablesid"])) {

    include_once "../include/db_conn.php";
    include_once "../include/loginstatus.php";

    $rid = $_POST['editpayablesid'];
    $supplier = $_POST['editpayablessupplier'];
    $totalamount = $_POST['editpayablestotalamount'];
    $ponumber = $_POST['editpayablesponumber'];
    $invoicenumber = $_POST['editpayablesinvoicenumber'];
    $invoicedate = $_POST['editpayablesinvoicedate'];
    $maturitydate = $_POST['editpayablesmaturitydate'];
    $drnumber = $_POST['editpayablesdrnumber'];
    $deliverydate = $_POST['editpayablesdeliverydate'];
    $bank = $_POST['editpayablesbank'];
    $checknumber = $_POST['editpayableschecknumber'];
    $checkdate = $_POST['editpayablescheckdate'];

    $invoicedate = date("Y-m-d H:i:s", strtotime($invoicedate));
    $maturitydate = date("Y-m-d H:i:s", strtotime($maturitydate));
    $deliverydate = date("Y-m-d H:i:s", strtotime($deliverydate));
    $checkdate = date("Y-m-d H:i:s", strtotime($checkdate));

    $sql = "UPDATE hurtajadmin_payables SET supplier_id='$supplier', payables_total_amount='$totalamount', payables_po_number='$ponumber', payables_invoice_number='$invoicenumber', payables_invoice_date='$invoicedate', payables_maturity_date='$maturitydate', payables_dr_number='$drnumber', payables_delivery_date='$deliverydate', payables_bank='$bank', payables_check_number='$checknumber', payables_check_date='$checkdate' WHERE id='$rid' LIMIT 1";
    $query = mysqli_query($db_conn, $sql);
    echo "successupdate";

    exit();

}

if (isset($_POST["deletepayablesid"])) {

    include_once "../include/db_conn.php";
    include_once "../include/loginstatus.php";

    $rid = $_POST['deletepayablesid'];

    $sql = "UPDATE hurtajadmin_payables SET payables_status='3' WHERE id='$rid' LIMIT 1";
    $query = mysqli_query($db_conn, $sql);
    echo "successupdate";

    exit();

}
