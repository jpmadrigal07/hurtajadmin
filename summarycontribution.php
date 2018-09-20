<?php
include_once("include/loginstatus.php");
if (!isset($_SESSION["userid"])) {
  header("location: index.php");
  exit();
}

$month = $_GET["month"];
$year = $_GET["year"];
                       
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>Hurt AJ Admin - Payslip Print</title>
    <!-- FavIcon -->
    <link rel="icon" type="image/png" href="image/logoonly.png" />
    <!-- Bootstrap -->
    <!-- <link href="css/bootstrap.min.css" rel="stylesheet"> -->
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css">
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
    <style type="text/css">
    h3,h2{
        font-family: "Times New Roman", Times, serif;
    }
    p{
        font-family: "Times New Roman", Times, serif;
        font-size: 15px;
        text-align: justify;
    }
    @page { size: auto;  margin: 15px 0mm; }

    table{
        border: 1px solid black;
        table-layout: fixed;
        width: 200px;
        margin: 0px;
    }

    th {
        border: 1px solid black;
        text-align: center;
    }

    body {
        padding: 0;
    }
    </style>

  </head>
  <body>

    <table class="table table-bordered">
            <thead>
                <tr>
                    <th style="width: 200px;">CONTRIBUTION</th>
                    <th style="width: 100px;"></th>
                    <th colspan="8">EMPLOYEE</th>
                    <th colspan="5">EMPLOYER</th>
                    <th colspan="3">TOTAL</th>
                </tr>
                <tr>
                    <th rowspan="2" style="width: 200px;">EMPLOYEE</th>
                    <th rowspan="2" style="width: 100px;">MONTH</th>
                    <th colspan="2">SSS</th>
                    <th colspan="2">PAG-IBIG</th>
                    <th colspan="2">PHILHEALTH</th>
                    <th colspan="2">TAX</th>
                    <th colspan="3">SSS</th>
                    <th rowspan="2" colspan="1">PAG-IBIG</th>
                    <th rowspan="2" colspan="1">PHIL<br>HEALTH</th>
                    <th rowspan="2" colspan="1">SSS-EC</th>
                    <th rowspan="2" colspan="1">PAG-IBIG</th>
                    <th rowspan="2" colspan="1">PHIL<br>HEALTH</th>
                </tr>
                <tr>
                    <th>26-10</th>
                    <th>11-25</th>
                    <th>26-10</th>
                    <th>11-25</th>
                    <th>29-10</th>
                    <th>11-25</th>
                    <th></th>
                    <th></th>
                    <th>EE</th>
                    <th>ER</th>
                    <th>EC</th>
                </tr>
            </thead>
            <tbody>


  <?php



                                                $sql = "SELECT * FROM hurtajadmin_employee WHERE employee_status != '5' ORDER BY id DESC";
                                                $query = mysqli_query($db_conn, $sql);
                                                $count = 0;

                                                $ssscontgrandtotal1 = 0;
                                                $ssscontgrandtotal2 = 0;
                                                $pagibiggrandtotal1 = 0;
                                                $pagibiggrandtotal2 = 0;
                                                $philhealthgrandtotal1 = 0;
                                                $philhealthgrandtotal2 = 0;
                                                $taxcontgrandtotal1 = 0;
                                                $taxcontgrandtotal2 = 0;
                                                $ssseegrandtotal = 0;
                                                $sssergrandtotal = 0;
                                                $sssecgrandtotal = 0;
                                                $pagibigemployergrandtotal = 0;
                                                $philhealthemployergrandtotal = 0;
                                                $sssgrandtotal = 0;
                                                $pagibiggrandtotal = 0;
                                                $philhealthgrandtotal = 0;


                                                while($row = mysqli_fetch_array($query)) {  
                                                    $count++; 
                                                    $recid = $row["id"];
                                                    $empid = $row["employee_id"];
                                                    $fname = $row["employee_fname"];
                                                    $mname = $row["employee_mname"];
                                                    $lname = $row["employee_lname"];
                                                    $gender = $row["employee_gender"];
                                                    $birthday = $row["employee_birthday"];
                                                    $address = $row["employee_address"];
                                                    $contact = $row["employee_phone"];
                                                    $datehired = $row["employee_date_hired"];
                                                    $datestart = $row["employee_date_start"];
                                                    $dateend = $row["employee_date_end"];
                                                    $stats = $row["employee_status"];

                                                    $tinid = "";
                                                    $pagibigid = "";
                                                    $philhealthid = "";
                                                    $sssid = "";
                                                    
                                                    if($birthday == "0000-00-00 00:00:00" || $birthday == "1970-01-01 00:00:00" || $birthday == "1970-01-01 01:00:00") {
                                                        $birthday = "";
                                                    } else {
                                                        $birthday = date("m/d/Y", strtotime($birthday));
                                                    }
                                                    
                                                    if($datehired == "0000-00-00 00:00:00" || $datehired == "1970-01-01 00:00:00" || $datehired == "1970-01-01 01:00:00") {
                                                        $datehired = "";
                                                    } else {
                                                        $datehired = date("m/d/Y", strtotime($datehired));
                                                    }

                                                    if($datestart == "0000-00-00 00:00:00" || $datestart == "1970-01-01 00:00:00" || $datestart == "1970-01-01 01:00:00") {
                                                        $datestart = "";
                                                    } else {
                                                        $datestart = date("m/d/Y", strtotime($datestart));
                                                    }

                                                    if($dateend == "0000-00-00 00:00:00" || $dateend == "1970-01-01 00:00:00" || $dateend == "1970-01-01 01:00:00") {
                                                        $dateend = "";
                                                    } else {
                                                        $dateend = date("m/d/Y", strtotime($dateend));
                                                    }
                                                    
                                                    $gendertext = "";
                                                    if($gender == "1") {
                                                        $gendertext = "Male";
                                                    } else if($gender == "2") {
                                                        $gendertext = "Female";
                                                    }
                                                    $statstext = "";
                                                    if($stats == "1") {
                                                        $statstext = "Active";
                                                    } else if($stats == "2") {
                                                        $statstext = "Resigned";
                                                    } else if($stats == "3") {
                                                        $statstext = "Terminated";
                                                    } else if($stats == "4") {
                                                        $statstext = "AWOL";
                                                    }
                                                    $mnameinitial = substr($mname, 0, 1);
                                                    $perhour = 0;
                                                    $tax = "";
                                                    $pagibig = "";
                                                    $sss = "";
                                                    $philhealth = "";
                                                    $sundayhoursworked1 = 0;
                                                    $sundayhoursworked2 = 0;
                                                    $firstcycleholidayhoursworked1 = 0;
                                                    $firstcycleholidayhoursworked2 = 0;
                                                    $firstcycleholidaybonushours1 = 0;
                                                    $firstcycleholidaybonushours2 = 0;
                                                    $secondcycleholidayhoursworked1 = 0;
                                                    $secondcycleholidayhoursworked2 = 0;
                                                    $secondcycleholidaybonushours1 = 0;
                                                    $secondcycleholidaybonushours2 = 0;
                                                    $taxcont1 = 0;
                                                    $ssscont1 = 0;
                                                    $philhealthcont1 = 0;
                                                    $pagibigcont1 = 0;
                                                    $taxcont2 = 0;
                                                    $ssscont2 = 0;
                                                    $philhealthcont2 = 0;
                                                    $pagibigcont2 = 0;
                                                    $hoursworked1 = 0;
                                                    $hoursworked2 = 0;
                                                    $otcount1 = 0;
                                                    $utcount1 = 0;
                                                    $otcount2 = 0;
                                                    $xotcount1 = 0;
                                                    $xotcountbase1 = 0;
                                                    $xotcount2 = 0;
                                                    $xotcountbase2 = 0;
                                                    $utcount2 = 0;
                                                    $dailycount1 = 0;
                                                    $dailycount2 = 0;
                                                    $latecount1 = 0;
                                                    $latecount2 = 0;
                                                    $disabled = "";
                                                    $currentprevyear = "";
                                                    $previousmonth = date("m", strtotime("-1 months"));
                                                    if($month == "1") {
                                                        $currentprevyear = $year-1;
                                                    } else {
                                                        $currentprevyear = $year;
                                                    }
                                                    $cashloanfirstcycle = 0;
                                                    $cashloansecondcycle = 0;
                                                    $cashadvancefirstcycle = 0;
                                                    $cashadvancesecondcycle = 0;
                                                    $holidayfirstcycle = 0;
                                                    $holidaysecondcycle = 0;

                                                    // $firstcycledate1 = $previousmonth."/26/".$currentyear;
                                                    // $firstcycledate2 = $currentmonth."/11/".$currentyear;
                                                    $firstcycledate1 = "12/26/2017"; //this is cycle 25 to 10
                                                    $firstcycledate2 = "1/11/2018";
                                                    $firstcycledate1 = date("Y-m-d H:i:s", strtotime($firstcycledate1));
                                                    $firstcycledate2 = date("Y-m-d H:i:s", strtotime($firstcycledate2));
                                                    // $secondcycledate1 = $currentmonth."/11/".$currentyear;
                                                    // $secondcycledate2 = $currentmonth."/26/".$currentyear;
                                                    $secondcycledate1 = "1/11/2018"; //this is cycle 11 to 25
                                                    $secondcycledate2 = "1/26/2018";
                                                    $secondcycledate1 = date("Y-m-d H:i:s", strtotime($secondcycledate1));
                                                    $secondcycledate2 = date("Y-m-d H:i:s", strtotime($secondcycledate2));
                                                    $sql01 = "SELECT DISTINCT DATE(attendance_date_in_out), attendance_date_in_out, attendance_value FROM hurtajadmin_attendance WHERE employee_id = '$empid' AND attendance_date_in_out >= '$firstcycledate1' AND attendance_date_in_out < '$firstcycledate2' AND attendance_value = '0' AND attendance_status = '1'";
                                                    $query01 = mysqli_query($db_conn, $sql01);
                                                    $count01 = mysqli_num_rows($query01);
                                                    while($row01 = mysqli_fetch_array($query01)) {
                                                        $datein = $row01["attendance_date_in_out"];

                                                        $dateindate = date("Y-m-d", strtotime($datein));

                                                        $latecount1 = $latecount1 + round((strtotime($datein) - strtotime($dateindate." 08:00:00"))/3600, 1);

                                                        if($latecount1 < 0.01) {
                                                            $latecount1 = 0;
                                                        }

                                                        $sqlout = "SELECT id, attendance_date_in_out FROM hurtajadmin_attendance WHERE employee_id = '$empid' AND DATE(attendance_date_in_out) = DATE('$datein') AND attendance_value = '1' AND attendance_status = '1'";
                                                        $queryout = mysqli_query($db_conn, $sqlout);
                                                        $countout = mysqli_num_rows($queryout);
                                                        if($countout > 0) {
                                                            while($rowout = mysqli_fetch_array($queryout)) {
                                                                $attendanceidout = $rowout["id"];  
                                                                $dateout = $rowout["attendance_date_in_out"];
                                                            }
                                                            $hourdiff = round((strtotime($dateout) - strtotime($datein))/3600, 1);
                                                               
                                                            if($hourdiff > 8){ // this is for overtime 
                                                                $otcount1 = $hourdiff - 8;
                                                                $dailycount1 = $hourdiff - $otcount1;
                                                            } else if($hourdiff < 8){ // this is for undertime
                                                                $utcount1 = $hourdiff;
                                                                $dailycount1 = $hourdiff;
                                                            } else {
                                                                $dailycount1 = $hourdiff;
                                                            }
                                                            
                                                            $hoursworked1 = $hoursworked1+$dailycount1;
                                                            $sqlhol1 = "SELECT id FROM hurtajadmin_holidays WHERE DATE(holidays_date) = DATE('$datein') AND holidays_type = '1' AND holidays_status = '1'";
                                                            $queryhol1 = mysqli_query($db_conn, $sqlhol1);
                                                            $counthol1 = mysqli_num_rows($queryhol1);
                                                            if($counthol1 > 0) {
                                                                $sqlholrate = "SELECT * FROM hurtajadmin_holiday_rate WHERE id = '1'";
                                                                $queryholrate = mysqli_query($db_conn, $sqlholrate);
                                                                $holratepercentage = 0;
                                                                while($rowholrate = mysqli_fetch_array($queryholrate)) {
                                                                    $holratepercentage = $rowholrate["holiday_rate_percent"];  
                                                                }

                                                                $xotcountbase1 = $xotcount1 + $otcount1;

                                                                $xotcount1 = $xotcount1 + $otcount1 + ($otcount1 * 0.30);
                                                                
                                                                $firstcycleholidaybonus1 = ($holratepercentage / 100) * $hourdiff;
                                                                $firstcycleholidayhoursworked1 = $firstcycleholidayhoursworked1+$hourdiff;
                                                                if($firstcycleholidayhoursworked1 > 8) {
                                                                    $firstcycleholidayhoursworked1 = 8;
                                                                }
                                                                $firstcycleholidaybonushours1 = $firstcycleholidayhoursworked1+$firstcycleholidaybonus1;
                                                                // $hoursworked1 = $hoursworked1+$firstcycleholidaybonus1;
                                                            } 
                                                            $sqlhol2 = "SELECT id FROM hurtajadmin_holidays WHERE DATE(holidays_date) = DATE('$datein') AND holidays_type = '2' AND holidays_status = '1'";
                                                            $queryhol2 = mysqli_query($db_conn, $sqlhol2);
                                                            $counthol2 = mysqli_num_rows($queryhol2);
                                                            if($counthol2 > 0) {
                                                                $sqlholrate = "SELECT * FROM hurtajadmin_holiday_rate WHERE id = '2'";
                                                                $queryholrate = mysqli_query($db_conn, $sqlholrate);
                                                                $holratepercentage = 0;
                                                                while($rowholrate = mysqli_fetch_array($queryholrate)) {
                                                                    $holratepercentage = $rowholrate["holiday_rate_percent"];  
                                                                }

                                                                $xotcountbase1 = $xotcount1 + $otcount1;

                                                                $xotcount1 = $xotcount1 + $otcount1 + ($otcount1 * 0.30);
                                                                
                                                                $firstcycleholidaybonus2 = ($holratepercentage / 100) * $hourdiff;
                                                                $firstcycleholidayhoursworked2 = $firstcycleholidayhoursworked2+$hourdiff;
                                                                if($firstcycleholidayhoursworked2 > 8) {
                                                                    $firstcycleholidayhoursworked2 = 8;
                                                                }
                                                                $firstcycleholidaybonushours2 = $firstcycleholidayhoursworked2+$firstcycleholidaybonus2;
                                                                // $hoursworked1 = $hoursworked1+$firstcycleholidaybonus2;
                                                            }

                                                            if($counthol1 < 1 && $counthol2 < 1) {
                                                                $xotcountbase1 = $xotcount1 + $otcount1;
                                                                $xotcount1 = $xotcount1 + $otcount1;
                                                            }

                                                        } 
                                                    }
                                                    $sql02 = "SELECT DISTINCT DATE(attendance_date_in_out), attendance_date_in_out, attendance_value FROM hurtajadmin_attendance WHERE employee_id = '$empid' AND attendance_date_in_out >= '$secondcycledate1' AND attendance_date_in_out < '$secondcycledate2' AND attendance_value = '0' AND attendance_status = '1'";
                                                    $query02 = mysqli_query($db_conn, $sql02);
                                                    $count02 = mysqli_num_rows($query02);
                                                    while($row02 = mysqli_fetch_array($query02)) {
                                                        $datein = $row02["attendance_date_in_out"];

                                                        $dateindate = date("Y-m-d", strtotime($datein));

                                                        $latecount2 = $latecount2 + round((strtotime($datein) - strtotime($dateindate." 08:00:00"))/3600, 1);

                                                        if($latecount2 < 0.01) {
                                                            $latecount2 = 0;
                                                        }

                                                        $sqlout = "SELECT id, attendance_date_in_out FROM hurtajadmin_attendance WHERE employee_id = '$empid' AND DATE(attendance_date_in_out) = DATE('$datein') AND attendance_value = '1' AND attendance_status = '1'";
                                                        $queryout = mysqli_query($db_conn, $sqlout);
                                                        $countout = mysqli_num_rows($queryout);
                                                        if($countout > 0) {
                                                            while($rowout = mysqli_fetch_array($queryout)) {
                                                                $attendanceidout = $rowout["id"];  
                                                                $dateout = $rowout["attendance_date_in_out"];
                                                            }
                                                            $hourdiff = round((strtotime($dateout) - strtotime($datein))/3600, 1);
                                                              
                                                            if($hourdiff > 8){ // this is for overtime 
                                                                $otcount2 = $hourdiff - 8;
                                                                $dailycount2 = $hourdiff - $otcount2;
                                                            }else if($hourdiff < 8){ // this is for undertime
                                                                $utcount2 = $hourdiff;
                                                                $dailycount2 = $hourdiff;
                                                            }else{
                                                                $dailycount2 = $hourdiff;
                                                            }
                                                            
                                                            $hoursworked2 = $hoursworked2+$dailycount2;
                                                            $sqlhol1 = "SELECT id FROM hurtajadmin_holidays WHERE DATE(holidays_date) = DATE('$datein') AND holidays_type = '1' AND holidays_status = '1'";
                                                            $queryhol1 = mysqli_query($db_conn, $sqlhol1);
                                                            $counthol1 = mysqli_num_rows($queryhol1);
                                                            if($counthol1 > 0) {
                                                                $sqlholrate = "SELECT * FROM hurtajadmin_holiday_rate WHERE id = '1'";
                                                                $queryholrate = mysqli_query($db_conn, $sqlholrate);
                                                                $holratepercentage = 0;
                                                                while($rowholrate = mysqli_fetch_array($queryholrate)) {
                                                                    $holratepercentage = $rowholrate["holiday_rate_percent"];  
                                                                }

                                                                $xotcountbase2 = $xotcount2 + $otcount2;

                                                                $xotcount2 = $xotcount2 + $otcount2 + ($otcount2 * 0.30);
                                                            
                                                                $secondcycleholidaybonus1 = ($holratepercentage / 100) * $dailycount2;
                                                                $secondcycleholidayhoursworked1 = $secondcycleholidayhoursworked1+$hourdiff;
                                                                if($secondcycleholidayhoursworked1 > 8) {
                                                                    $secondcycleholidayhoursworked1 = 8;
                                                                }
                                                                $secondcycleholidaybonushours1 = $secondcycleholidaybonushours1+$secondcycleholidaybonus1;
                                                                // $hoursworked2 = $hoursworked2+$secondcycleholidaybonus1;

                                                            }

                                                            $sqlhol2 = "SELECT id FROM hurtajadmin_holidays WHERE DATE(holidays_date) = DATE('$datein') AND holidays_type = '2' AND holidays_status = '1'";
                                                            $queryhol2 = mysqli_query($db_conn, $sqlhol2);
                                                            $counthol2 = mysqli_num_rows($queryhol2);
                                                            if($counthol2 > 0) {
                                                                $sqlholrate = "SELECT * FROM hurtajadmin_holiday_rate WHERE id = '2'";
                                                                $queryholrate = mysqli_query($db_conn, $sqlholrate);
                                                                $holratepercentage = 0;
                                                                while($rowholrate = mysqli_fetch_array($queryholrate)) {
                                                                    $holratepercentage = $rowholrate["holiday_rate_percent"];  
                                                                }

                                                                $xotcountbase2 = $xotcount2 + $otcount2;

                                                                $xotcount2 = $xotcount2 + $otcount2 + ($otcount2 * 0.30);
                                                            
                                                                $secondcycleholidaybonus2 = ($holratepercentage / 100) * $dailycount2;
                                                                $secondcycleholidayhoursworked2 = $secondcycleholidayhoursworked2+$hourdiff;
                                                                if($secondcycleholidayhoursworked2 > 8) {
                                                                    $secondcycleholidayhoursworked2 = 8;
                                                                }
                                                                $secondcycleholidaybonushours2 = $secondcycleholidaybonushours2+$secondcycleholidaybonus2;
                                                                // $hoursworked2 = $hoursworked2+$secondcycleholidaybonus2;
                                                            }

                                                            if($counthol1 < 1 && $counthol2 < 1) {
                                                                $xotcountbase2 = $xotcount2 + $otcount2;
                                                                $xotcount2 = $xotcount2 + $otcount2;
                                                            }



                                                        } 
                                                    }
                                                    $sql1 = "SELECT * FROM hurtajadmin_employee_settings WHERE employee_id = '$empid'";
                                                    $query1 = mysqli_query($db_conn, $sql1);
                                                    $count1 = mysqli_num_rows($query1);
                                                    if($count1 > 0) {
                                                        while($row1 = mysqli_fetch_array($query1)) {  
                                                            $perhour = $row1["employee_settings_perhour"];
                                                            $tax = $row1["employee_settings_tax"];
                                                            $pagibig = $row1["employee_settings_pagibig"];
                                                            $sss = $row1["employee_settings_sss"];
                                                            $philhealth = $row1["employee_settings_philhealth"];
                                                        }
                                                    }

                                                    $sundayStartDate1 = date('Y-m-d', strtotime($firstcycledate1));
                                                    $sundayEndDate1 = date('Y-m-d', strtotime($firstcycledate2));

                                                    $sundayStartDate2 = date('Y-m-d', strtotime($secondcycledate1));
                                                    $sundayEndDate2 = date('Y-m-d', strtotime($secondcycledate2));
                                                    

                                                    $sundays1 = array();

                                                    while ($sundayStartDate1 <= $sundayEndDate1) {
                                                        if (date('w', strtotime($sundayStartDate1)) == 0) {
                                                            $sundays1[] = date('Y-m-d', strtotime($sundayStartDate1));
                                                        }

                                                        $sundayStartDate1 = date('Y-m-d H:i:s', strtotime($sundayStartDate1 . ' +1 day'));
                                                    }

                                                    if(count($sundays1) > 0) {
                                                        for($i = 0; $i < count($sundays1); $i++) {
                                                            $sundaydate1 = $sundays1[$i];
                                                            $sqlsd1 = "SELECT DISTINCT DATE(attendance_date_in_out), attendance_date_in_out, attendance_value FROM hurtajadmin_attendance WHERE employee_id = '$empid' AND date(attendance_date_in_out) = '$sundaydate1' AND attendance_value = '0' AND attendance_status = '1' LIMIT 1";
                                                            $querysd1 = mysqli_query($db_conn, $sqlsd1);
                                                            $countsd1 = mysqli_num_rows($querysd1);
                                                            while($rowsd1 = mysqli_fetch_array($querysd1)) {
                                                                $dateinsd1 = $rowsd1["attendance_date_in_out"];
                                                                $sqloutsd1 = "SELECT id, attendance_date_in_out FROM hurtajadmin_attendance WHERE employee_id = '$empid' AND DATE(attendance_date_in_out) = DATE('$dateinsd1') AND attendance_value = '1' AND attendance_status = '1' LIMIT 1";
                                                                $queryoutsd1 = mysqli_query($db_conn, $sqloutsd1);
                                                                $countoutsd1 = mysqli_num_rows($queryoutsd1);
                                                                if($countoutsd1 > 0) {
                                                                    while($rowoutsd1 = mysqli_fetch_array($queryoutsd1)) {
                                                                        $attendanceidoutsd1 = $rowoutsd1["id"];  
                                                                        $dateoutsd = $rowoutsd1["attendance_date_in_out"];
                                                                    }

                                                                    $hourdiff1 = round((strtotime($dateoutsd1) - strtotime($dateinsd1))/3600, 1);
                                                                    if($hourdiff1 > 8) {
                                                                        $hourdiff1 = 8;
                                                                    }
                                                                    $sundayhoursworked1 = $sundayhoursworked1 + $hourdiff1;
                                                                }
                                                                    
                                                            }
                                                        }
                                                    }

                                                    $sundays2 = array();

                                                    while ($sundayStartDate2 <= $sundayEndDate2) {
                                                        if (date('w', strtotime($sundayStartDate2)) == 0) {
                                                            $sundays2[] = date('Y-m-d', strtotime($sundayStartDate2));
                                                        }

                                                        $sundayStartDate2 = date('Y-m-d H:i:s', strtotime($sundayStartDate2 . ' +1 day'));
                                                    }

                                                    if(count($sundays2) > 0) {
                                                        for($i = 0; $i < count($sundays2); $i++) {
                                                            $sundaydate2 = $sundays2[$i];
                                                            $sqlsd2 = "SELECT DISTINCT DATE(attendance_date_in_out), attendance_date_in_out, attendance_value FROM hurtajadmin_attendance WHERE employee_id = '$empid' AND date(attendance_date_in_out) = '$sundaydate2' AND attendance_value = '0' AND attendance_status = '1' LIMIT 1";
                                                            $querysd2 = mysqli_query($db_conn, $sqlsd2);
                                                            $countsd2 = mysqli_num_rows($querysd2);
                                                            while($rowsd2 = mysqli_fetch_array($querysd2)) {
                                                                $dateinsd2 = $rowsd2["attendance_date_in_out"];
                                                                $sqloutsd2 = "SELECT id, attendance_date_in_out FROM hurtajadmin_attendance WHERE employee_id = '$empid' AND DATE(attendance_date_in_out) = DATE('$dateinsd2') AND attendance_value = '1' AND attendance_status = '1' LIMIT 1";
                                                                $queryoutsd2 = mysqli_query($db_conn, $sqloutsd2);
                                                                $countoutsd2 = mysqli_num_rows($queryoutsd2);
                                                                if($countoutsd2 > 0) {
                                                                    while($rowoutsd2 = mysqli_fetch_array($queryoutsd2)) {
                                                                        $attendanceidoutsd2 = $rowoutsd2["id"];  
                                                                        $dateoutsd2 = $rowoutsd2["attendance_date_in_out"];
                                                                    }

                                                                    $hourdiff2 = round((strtotime($dateoutsd2) - strtotime($dateinsd2))/3600, 1);
                                                                    if($hourdiff2 > 8) {
                                                                        $hourdiff2 = 8;
                                                                    }
                                                                    $sundayhoursworked2 = $sundayhoursworked2 + $hourdiff2;
                                                                }
                                                                    
                                                            }
                                                        }
                                                    }

                                                    $otpay1 = $perhour * $xotcount1; // this is base on per hour not ot per hour
                                                    $otpay2 = $perhour * $xotcount2; // this is base on per hour not ot per hour
                                                    $bimonthsalary1 = (($hoursworked1-$sundayhoursworked1-$firstcycleholidayhoursworked1-$firstcycleholidayhoursworked2)*$perhour)+($xotcount1*$perhour)+($sundayhoursworked1*$perhour)+(($firstcycleholidayhoursworked1+$firstcycleholidaybonushours1)*$perhour)+(($firstcycleholidayhoursworked2+$firstcycleholidaybonushours2)*$perhour);

                                                    $bimonthsalary2 = (($hoursworked2-$sundayhoursworked2-$secondcycleholidayhoursworked1-$secondcycleholidayhoursworked2)*$perhour)+($xotcount2*$perhour)+($sundayhoursworked2*$perhour)+(($secondcycleholidayhoursworked1+$secondcycleholidaybonushours1)*$perhour)+(($secondcycleholidayhoursworked2+$secondcycleholidaybonushours2)*$perhour);

                                                    if($tax == '1') {
                                                        $sql2 = "SELECT * FROM hurtajadmin_tax_contribution WHERE $bimonthsalary1 >= tax_contribution_range_from AND $bimonthsalary1 <= tax_contribution_range_to";
                                                        $query2 = mysqli_query($db_conn, $sql2);
                                                        $count2 = mysqli_num_rows($query2);
                                                        if($count2 > 0) {
                                                            while($row2 = mysqli_fetch_array($query2)) {  
                                                                if($bimonthsalary1 > 0) {
                                                                    $taxcont1 = $row2["tax_contribution_contribution"];
                                                                    if($taxcont1 == "") {
                                                                        $taxcont1 = 0;
                                                                    }
                                                                } else {
                                                                    $taxcont1 = 0;
                                                                }
                                                            }
                                                        }
                                                        $sql21 = "SELECT * FROM hurtajadmin_tax_contribution WHERE $bimonthsalary2 >= tax_contribution_range_from AND $bimonthsalary2 <= tax_contribution_range_to";
                                                        $query21 = mysqli_query($db_conn, $sql21);
                                                        $count21 = mysqli_num_rows($query21);
                                                        if($count21 > 0) {
                                                            while($row21 = mysqli_fetch_array($query21)) {
                                                                if($bimonthsalary2 > 0) {  
                                                                    $taxcont2 = $row21["tax_contribution_contribution"];
                                                                    if($taxcont2 == "") {
                                                                        $taxcont2 = 0;
                                                                    }
                                                                } else {
                                                                    $taxcont2 = 0;
                                                                }
                                                            }
                                                        }
                                                    }
                                                    if($sss == '1') {
                                                        $sql3 = "SELECT * FROM hurtajadmin_sss_contribution WHERE $bimonthsalary1 >= sss_contribution_range_from AND $bimonthsalary1 <= sss_contribution_range_to";
                                                        $query3 = mysqli_query($db_conn, $sql3);
                                                        $count3 = mysqli_num_rows($query3);
                                                        if($count3 > 0) {
                                                            while($row3 = mysqli_fetch_array($query3)) {  
                                                                if($bimonthsalary1 > 0) {
                                                                    $ssscont1 = $row3["sss_contribution_contribution"];
                                                                    if($ssscont1 == "") {
                                                                        $ssscont1 = 0;
                                                                    }
                                                                } else {
                                                                    $ssscont1 = 0;
                                                                }
                                                            }
                                                        }
                                                        $sql31 = "SELECT * FROM hurtajadmin_sss_contribution WHERE $bimonthsalary2 >= sss_contribution_range_from AND $bimonthsalary2 <= sss_contribution_range_to";
                                                        $query31 = mysqli_query($db_conn, $sql31);
                                                        $count31 = mysqli_num_rows($query31);
                                                        if($count31 > 0) {
                                                            while($row31 = mysqli_fetch_array($query31)) {
                                                                if($bimonthsalary2 > 0) {
                                                                    $ssscont2 = $row31["sss_contribution_contribution"];
                                                                    if($ssscont2 == "") {
                                                                        $ssscont2 = 0;
                                                                    }
                                                                } else {
                                                                    $ssscont2 = 0;
                                                                }
                                                            }
                                                        }
                                                    }
                                                    if($philhealth == '1') {
                                                        $sql4 = "SELECT * FROM hurtajadmin_philhealth_contribution WHERE $bimonthsalary1 >= philhealth_contribution_range_from AND $bimonthsalary1 <= philhealth_contribution_range_to";
                                                        $query4 = mysqli_query($db_conn, $sql4);
                                                        $count4 = mysqli_num_rows($query4);
                                                        if($count4 > 0) {
                                                            while($row4 = mysqli_fetch_array($query4)) {  
                                                                if($bimonthsalary1 > 0) {
                                                                    $philhealthcont1 = $row4["philhealth_contribution_contribution"];
                                                                    if($philhealthcont1 == "") {
                                                                        $philhealthcont1 = 0;
                                                                    }
                                                                } else {
                                                                    $philhealthcont1 = 0;
                                                                }
                                                            }
                                                        }
                                                        $sql41 = "SELECT * FROM hurtajadmin_philhealth_contribution WHERE $bimonthsalary2 >= philhealth_contribution_range_from AND $bimonthsalary2 <= philhealth_contribution_range_to";
                                                        $query41 = mysqli_query($db_conn, $sql41);
                                                        $count41 = mysqli_num_rows($query41);
                                                        if($count41 > 0) {
                                                            while($row41 = mysqli_fetch_array($query41)) {
                                                                if($bimonthsalary2 > 0) {  
                                                                    $philhealthcont2 = $row41["philhealth_contribution_contribution"];
                                                                    if($philhealthcont2 == "") {
                                                                        $philhealthcont2 = 0;
                                                                    }
                                                                } else {
                                                                    $philhealthcont2 = 0;
                                                                }
                                                            }
                                                        }
                                                    }
                                                    if($pagibig == '1') {
                                                        $sql5 = "SELECT * FROM hurtajadmin_pagibig_contribution WHERE $bimonthsalary1 >= pagibig_contribution_range_from AND $bimonthsalary1 <= pagibig_contribution_range_to";
                                                        $query5 = mysqli_query($db_conn, $sql5);
                                                        $count5 = mysqli_num_rows($query5);
                                                        if($count5 > 0) {
                                                            while($row5 = mysqli_fetch_array($query5)) {  
                                                                if($bimonthsalary1 > 0) {
                                                                    $pagibigcont1 = $row5["pagibig_contribution_contribution"];
                                                                    if($pagibigcont1 == "") {
                                                                        $pagibigcont1 = 0;
                                                                    }
                                                                } else {
                                                                    $pagibigcont1 = 0;
                                                                }
                                                            }
                                                        }
                                                        $sql51 = "SELECT * FROM hurtajadmin_pagibig_contribution WHERE $bimonthsalary2 >= pagibig_contribution_range_from AND $bimonthsalary2 <= pagibig_contribution_range_to";
                                                        $query51 = mysqli_query($db_conn, $sql51);
                                                        $count51 = mysqli_num_rows($query51);
                                                        if($count51 > 0) {
                                                            while($row51 = mysqli_fetch_array($query51)) {
                                                                if($bimonthsalary2 > 0) {   
                                                                    $pagibigcont2 = $row51["pagibig_contribution_contribution"];
                                                                    if($pagibigcont2 == "") {
                                                                        $pagibigcont2 = 0;
                                                                    }
                                                                } else {
                                                                    $pagibigcont2 = 0;
                                                                }
                                                            }
                                                        }
                                                    }
                                                    $sql6 = "SELECT * FROM hurtajadmin_cash_loan_advance WHERE cash_loan_advance_date >= '$firstcycledate1' AND cash_loan_advance_date < '$firstcycledate2' AND employee_id = '$empid' AND cash_loan_advance_status='1'";
                                                    $query6 = mysqli_query($db_conn, $sql6);
                                                    $count6 = mysqli_num_rows($query6);
                                                    if($count6 > 0) {
                                                        while($row6 = mysqli_fetch_array($query6)) {  
                                                            $cltype = $row6["cash_loan_advance_type"];
                                                            if($cltype == "1") {
                                                                $cashloanfirstcycle = $cashloanfirstcycle+$row6["cash_loan_advance_amount"];
                                                            } else if($cltype == "2") {
                                                                $cashadvancefirstcycle = $cashadvancefirstcycle+$row6["cash_loan_advance_amount"];
                                                            }
                                                            
                                                        }
                                                    }
                                                    $sql7 = "SELECT * FROM hurtajadmin_cash_loan_advance WHERE cash_loan_advance_date >= '$secondcycledate1' AND cash_loan_advance_date < '$secondcycledate2' AND employee_id = '$empid' AND cash_loan_advance_status='1'";
                                                    $query7 = mysqli_query($db_conn, $sql7);
                                                    $count7 = mysqli_num_rows($query7);
                                                    if($count7 > 0) {
                                                        while($row7 = mysqli_fetch_array($query7)) {  
                                                            $cltype = $row7["cash_loan_advance_type"];
                                                            if($cltype == "1") {
                                                                $cashloansecondcycle = $cashloansecondcycle+$row7["cash_loan_advance_amount"];
                                                            } else if($cltype == "2") {
                                                                $cashadvancesecondcycle = $cashadvancesecondcycle+$row7["cash_loan_advance_amount"];
                                                            }
                                                        }
                                                    }
                                                    $sql8 = "SELECT SUM(id) AS regularholidaytotal FROM hurtajadmin_holidays WHERE holidays_date >= '$firstcycledate1' AND holidays_date < '$firstcycledate2' AND holidays_type = '1' AND holidays_status = '1'";
                                                    $query8 = mysqli_query($db_conn, $sql8);
                                                    $count8 = mysqli_num_rows($query8);
                                                    if($count8 > 0) {
                                                        while($row8 = mysqli_fetch_array($query8)) {  
                                                            $holidayfirstcycle = $row8["regularholidaytotal"];
                                                        }
                                                    }
                                                    $sql9 = "SELECT SUM(id) AS regularholidaytotal FROM hurtajadmin_holidays WHERE holidays_date >= '$secondcycledate1' AND holidays_date < '$secondcycledate2' AND holidays_type = '1' AND holidays_status = '1'";
                                                    $query9 = mysqli_query($db_conn, $sql9);
                                                    $count9 = mysqli_num_rows($query9);
                                                    if($count9 > 0) {
                                                        while($row9 = mysqli_fetch_array($query9)) {  
                                                            $holidaysecondcycle = $row9["regularholidaytotal"];
                                                        }
                                                    }

                                                    $hoursworked = $hoursworked1+$hoursworked2+$xotcountbase1+$xotcountbase2; 
                                                    $deductions1 = (float)$taxcont1+(float)$pagibigcont1+(float)$ssscont1+(float)$philhealthcont1;
                                                    $deductions2 = (float)$taxcont2+(float)$pagibigcont2+(float)$ssscont2+(float)$philhealthcont2;
                                                    $payroll_settings_paycheck_deducted_1 = 0;
                                                    $payroll_settings_paycheck_base_1 = 0;
                                                    $payroll_settings_paycheck_deducted_2 = 0;
                                                    $payroll_settings_paycheck_base_2= 0;
                                                    
                                                    if($perhour > 0) {
                                                        if($deductions1 > 0 && ($cashloanfirstcycle > 0 || $cashadvancefirstcycle > 0) && $hoursworked1 > 0) { 
                                                            $payroll_settings_paycheck_deducted_1 = ($perhour*$hoursworked1+$perhour*$xotcount1)-$deductions1-$cashloanfirstcycle-$cashadvancefirstcycle;
                                                            $payroll_settings_paycheck_base_1 = $perhour*$hoursworked1+$perhour*$xotcount1;
                                                        } else if($deductions1 > 0 && $cashloanfirstcycle < 1 && $cashadvancefirstcycle < 1 && $hoursworked1 > 0) {
                                                            $payroll_settings_paycheck_deducted_1 = ($perhour*$hoursworked1+$perhour*$xotcount1)-$deductions1;
                                                            $payroll_settings_paycheck_base_1 = $perhour*$hoursworked1+$perhour*$xotcount1;
                                                        } else if($deductions1 < 1 && ($cashloanfirstcycle > 0 || $cashadvancefirstcycle > 0)  && $hoursworked1 > 0) { 
                                                            $payroll_settings_paycheck_deducted_1 = ($perhour*$hoursworked1+$perhour*$xotcount1)-$cashloanfirstcycle-$cashadvancefirstcycle;
                                                            $payroll_settings_paycheck_base_1 = $perhour*$hoursworked1+$perhour*$xotcount1;
                                                        } else if($deductions1 < 1 && $cashloanfirstcycle < 1 && $cashadvancefirstcycle < 1  && $hoursworked1 > 0) { 
                                                            $payroll_settings_paycheck_deducted_1 = $perhour*$hoursworked1+$perhour*$xotcount1;
                                                            $payroll_settings_paycheck_base_1 = $perhour*$hoursworked1+$perhour*$xotcount1;
                                                        } else {
                                                            $payroll_settings_paycheck_deducted_1 = "0";
                                                        }
                                                    } else {
                                                        $payroll_settings_paycheck_deducted_1 = "0";
                                                    }

                                                    if($perhour > 0) {
                                                        if($deductions2 > 0 && ($cashloansecondcycle > 0 || $cashadvancesecondcycle > 0) && $hoursworked2 > 0) { 
                                                            $payroll_settings_paycheck_deducted_2 = ($perhour*$hoursworked2+$perhour*$xotcount2)-$deductions2-$cashloansecondcycle-$cashadvancesecondcycle;
                                                            $payroll_settings_paycheck_base_2 = $perhour*$hoursworked2+$perhour*$xotcount2;
                                                        } else if($deductions2 > 0 && $cashloansecondcycle < 1 && $cashadvancesecondcycle < 1 && $hoursworked2 > 0) { 
                                                            $payroll_settings_paycheck_deducted_2 = ($perhour*$hoursworked2+$perhour*$xotcount2)-$deductions2;
                                                            $payroll_settings_paycheck_base_2 = $perhour*$hoursworked2+$perhour*$xotcount2;
                                                        } else if($deductions2 < 1 && ($cashloansecondcycle > 0 || $cashadvancesecondcycle > 0) && $hoursworked2 > 0) { 
                                                            $payroll_settings_paycheck_deducted_2 = ($perhour*$hoursworked2+$perhour*$xotcount2)-$cashadvancesecondcycle;
                                                            $payroll_settings_paycheck_base_2 = $perhour*$hoursworked2+$perhour*$xotcount2;
                                                        } else if($deductions2 < 1 && $cashloansecondcycle < 1 && $cashadvancesecondcycle < 1 && $hoursworked2 > 0) { 
                                                            $payroll_settings_paycheck_deducted_2 = $perhour*$hoursworked2+$perhour*$xotcount2;
                                                            $payroll_settings_paycheck_base_2 = $perhour*$hoursworked2+$perhour*$xotcount2;
                                                        } else {
                                                            $payroll_settings_paycheck_deducted_2 = "0";
                                                        }
                                                    } else {
                                                        $payroll_settings_paycheck_deducted_2 = "0";
                                                    }

                                                    if($month == "1") {
                                                        $monthtext = "Jan";
                                                    } else if($month == "2") {
                                                        $monthtext = "Feb";
                                                    } else if($month == "3") {
                                                        $monthtext = "Mar";
                                                    } else if($month == "4") {
                                                        $monthtext = "Apr";
                                                    } else if($month == "5") {
                                                        $monthtext = "May";
                                                    } else if($month == "6") {
                                                        $monthtext = "Jun";
                                                    } else if($month == "7") {
                                                        $monthtext = "Jul";
                                                    } else if($month == "8") {
                                                        $monthtext = "Aug";
                                                    } else if($month == "9") {
                                                        $monthtext = "Sep";
                                                    } else if($month == "10") {
                                                        $monthtext = "Oct";
                                                    } else if($month == "11") {
                                                        $monthtext = "Nov";
                                                    } else if($month == "12") {
                                                        $monthtext = "Dec";
                                                    }

                                                    if(($bimonthsalary1+$bimonthsalary2) > 14999 && ($bimonthsalary1 > 0 || $bimonthsalary2 > 0)) {
                                                        $ec = 30;
                                                    } else if(($bimonthsalary1+$bimonthsalary2) < 15000 && ($bimonthsalary1 > 0 || $bimonthsalary2 > 0)) {
                                                        $ec = 10;
                                                    } else {
                                                        $ec = 0;
                                                    }

                                                    $ssscontgrandtotal1 = $ssscontgrandtotal1 + $ssscont1/2;
                                                    $ssscontgrandtotal2 = $ssscontgrandtotal2 + $ssscont2/2;
                                                    $pagibiggrandtotal1 = $pagibiggrandtotal1 + $pagibigcont1/2;
                                                    $pagibiggrandtotal2 = $pagibiggrandtotal2 + $pagibigcont2/2;
                                                    $philhealthgrandtotal1 = $philhealthgrandtotal1 + $philhealthcont1/2;
                                                    $philhealthgrandtotal2 = $philhealthgrandtotal2 + $philhealthcont2/2;
                                                    $taxcontgrandtotal1 = $taxcontgrandtotal1 + $taxcont1/2;
                                                    $taxcontgrandtotal2 = $taxcontgrandtotal2 + $taxcont2/2;
                                                    $ssseegrandtotal = $ssseegrandtotal + (($ssscont1/2)+($ssscont2/2));
                                                    $sssergrandtotal = $sssergrandtotal + (($ssscont1/2)+($ssscont2/2));
                                                    $sssecgrandtotal = $sssecgrandtotal + $ec;
                                                    $pagibigemployergrandtotal = $pagibigemployergrandtotal + (($pagibigcont1/2)+($pagibigcont2/2));
                                                    $philhealthemployergrandtotal = $philhealthemployergrandtotal + (($philhealthcont1/2)+($philhealthcont2/2));
                                                    $sssgrandtotal = $sssgrandtotal + (((($ssscont1/2)+($ssscont2/2))*2)+$ec);
                                                    $pagibiggrandtotal = $pagibiggrandtotal + (($pagibigcont1/2+$pagibigcont2/2)*2);
                                                    $philhealthgrandtotal = $philhealthgrandtotal + ($philhealthcont1+$philhealthcont2);



                                                    echo '
                                                    <tr>
                                                        <td>'.$fname.' '.$mnameinitial.'. '.$lname.'</td>
                                                        <td style="text-align:center;">'.$monthtext.', '.$year.'</td>
                                                        <td style="text-align:right;">'.number_format($ssscont1/2, 2, '.', ',').'</td>
                                                        <td style="text-align:right;">'.number_format($ssscont2/2, 2, '.', ',').'</td>
                                                        <td style="text-align:right;">'.number_format($pagibigcont1/2, 2, '.', ',').'</td>
                                                        <td style="text-align:right;">'.number_format($pagibigcont2/2, 2, '.', ',').'</td>
                                                        <td style="text-align:right;">'.number_format($philhealthcont1/2, 2, '.', ',').'</td>
                                                        <td style="text-align:right;">'.number_format($philhealthcont2/2, 2, '.', ',').'</td>
                                                        <td style="text-align:right;">'.number_format($taxcont1/2, 2, '.', ',').'</td>
                                                        <td style="text-align:right;">'.number_format($taxcont2/2, 2, '.', ',').'</td>
                                                        <td style="text-align:right;">'.number_format(($ssscont1/2)+($ssscont2/2), 2, '.', ',').'</td>
                                                        <td style="text-align:right;">'.number_format(($ssscont1/2)+($ssscont2/2), 2, '.', ',').'</td>
                                                        <td style="text-align:right;">'.number_format($ec, 2, '.', ',').'</td>
                                                        <td style="text-align:right;">'.number_format(($pagibigcont1/2)+($pagibigcont2/2), 2, '.', ',').'</td>
                                                        <td style="text-align:right;">'.number_format(($philhealthcont1/2)+($philhealthcont2/2), 2, '.', ',').'</td>
                                                        <td style="text-align:right;">'.number_format(((($ssscont1/2)+($ssscont2/2))*2)+$ec, 2, '.', ',').'</td>
                                                        <td style="text-align:right;">'.number_format(($pagibigcont1/2+$pagibigcont2/2)*2, 2, '.', ',').'</td>
                                                        <td style="text-align:right;">'.number_format($philhealthcont1+$philhealthcont2, 2, '.', ',').'</td>
                                                    </tr>
                                                    ';
                                                    
                                                }

                                            
  ?>

                <tr>
                    <td colspan="2"><strong><center>TOTAL</center></strong></td>
                    <td style="text-align:right;"><?php echo number_format($ssscontgrandtotal1, 2, '.', ','); ?></td>
                    <td style="text-align:right;"><?php echo number_format($ssscontgrandtotal2, 2, '.', ','); ?></td>
                    <td style="text-align:right;"><?php echo number_format($pagibiggrandtotal1, 2, '.', ','); ?></td>
                    <td style="text-align:right;"><?php echo number_format($pagibiggrandtotal2, 2, '.', ','); ?></td>
                    <td style="text-align:right;"><?php echo number_format($philhealthgrandtotal1, 2, '.', ','); ?></td>
                    <td style="text-align:right;"><?php echo number_format($philhealthgrandtotal2, 2, '.', ','); ?></td>
                    <td style="text-align:right;"><?php echo number_format($taxcontgrandtotal1, 2, '.', ','); ?></td>
                    <td style="text-align:right;"><?php echo number_format($taxcontgrandtotal2, 2, '.', ','); ?></td>
                    <td style="text-align:right;"><?php echo number_format($ssseegrandtotal, 2, '.', ','); ?></td>
                    <td style="text-align:right;"><?php echo number_format($sssergrandtotal, 2, '.', ','); ?></td>
                    <td style="text-align:right;"><?php echo number_format($sssecgrandtotal, 2, '.', ','); ?></td>
                    <td style="text-align:right;"><?php echo number_format($pagibigemployergrandtotal, 2, '.', ','); ?></td>
                    <td style="text-align:right;"><?php echo number_format($philhealthemployergrandtotal, 2, '.', ','); ?></td>
                    <td style="text-align:right;"><?php echo number_format($sssgrandtotal, 2, '.', ','); ?></td>
                    <td style="text-align:right;"><?php echo number_format($pagibiggrandtotal, 2, '.', ','); ?></td>
                    <td style="text-align:right;"><?php echo number_format($philhealthgrandtotal, 2, '.', ','); ?></td>
                </tr>



  </tbody>
</table>

        <div class="col-md-4">

        <div class="col-md-6">
            <span>SSS Total Contribution</span>
        </div>
        <div class="col-md-6">
            <strong><?php echo number_format($sssgrandtotal, 2, '.', ','); ?></strong>
        </div>

        <div class="col-md-6">
            <span>Pag-ibig Total Contribution</span>
        </div>
        <div class="col-md-6">
            <strong><?php echo number_format($pagibiggrandtotal, 2, '.', ','); ?></strong>
        </div>

        <div class="col-md-6">
            <span>PhilHealth Total Contribution</span>
        </div>
        <div class="col-md-6">
            <strong><?php echo number_format($philhealthgrandtotal, 2, '.', ','); ?></strong>
        </div>

        <div class="col-md-6">
            <span>Withholding Tax</span>
        </div>
        <div class="col-md-6">
            <strong><?php echo number_format($taxcontgrandtotal1, 2, '.', ','); ?></strong>
        </div>

        </div>

        <div class="col-md-8">

        <center><h2><strong><?php echo number_format($sssgrandtotal+$pagibiggrandtotal+$philhealthgrandtotal+$taxcontgrandtotal1, 2, '.', ','); ?></strong></h2>
        <span>TOTAL</span></center>

        </div>

               
         

    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <!-- Latest compiled and minified JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
    <script type="text/javascript">
        // window.onload = function() { window.print(); }
    </script>
  </body>
</html>

