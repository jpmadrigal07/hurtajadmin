<?php
include_once("include/loginstatus.php");
if (!isset($_SESSION["userid"])) {
  header("location: index.php");
  exit();
}

$type = $_GET["type"];
$to = $_GET["to"]; 

$typetext = ""; 

if($type == "1") {

    $typetext = "Regular"; 

    $empid = $_GET["empid"];
    $month = $_GET["month"];
    $cycle = $_GET["cycle"];
    $year = $_GET["year"];
    $monthtext = "";
    $prevmonthtext = "";
    $daytext1 = "";
    $daytext2 = "";

    $prevmonth = "";
    $prevyear = "";
    

    if($cycle == "1") {
        $period = "15";
        $daytext1 = "26";
        $daytext2 = "10";
        if($month == "1") {
             $prevmonth = "12";
             $prevyear = $year-1;
             $prevyear = ", ".$prevyear;
        } else {
             $prevmonth = $month-1; 
        }
    } else if($cycle == "2") {
        $period = "30";
        $daytext1 = "11";
        $daytext2 = "25";
        $prevmonth = $month;
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

    if($prevmonth == "1") {
        $prevmonthtext = "Jan";
    } else if($prevmonth == "2") {
        $prevmonthtext = "Feb";
    } else if($prevmonth == "3") {
        $prevmonthtext = "Mar";
    } else if($prevmonth == "4") {
        $prevmonthtext = "Apr";
    } else if($prevmonth == "5") {
        $prevmonthtext = "May";
    } else if($prevmonth == "6") {
        $prevmonthtext = "Jun";
    } else if($prevmonth == "7") {
        $prevmonthtext = "Jul";
    } else if($prevmonth == "8") {
        $prevmonthtext = "Aug";
    } else if($prevmonth == "9") {
        $prevmonthtext = "Sep";
    } else if($prevmonth == "10") {
        $prevmonthtext = "Oct";
    } else if($prevmonth == "11") {
        $prevmonthtext = "Nov";
    } else if($prevmonth == "12") {
        $prevmonthtext = "Dec";
    }

} else if($type == "2") {

    $typetext = "13th Month Pay"; 

    $empid = $_GET["empid"];
    $year = $_GET["year"];

}
                    
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
    @page { size: auto;  margin: 0mm; }
    #page-break {page-break-after: always;}
    </style>

  </head>
  <body>


  <?php

                                            if($type == "1") {
                                                if($to == "1") {
                                                    $sql = "SELECT * FROM hurtajadmin_employee ORDER BY id DESC";
                                                } else if($to == "2") {
                                                    $sql = "SELECT * FROM hurtajadmin_employee WHERE employee_id = '$empid' ORDER BY id DESC";
                                                }
                                                $query = mysqli_query($db_conn, $sql);
                                                $count = 0;
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
                                                    $datehired = $row["employee_date_start"];
                                                    $dateend = $row["employee_date_end"];
                                                    $stats = $row["employee_status"];
                                                    $tinid = "";
                                                    $pagibigid = "";
                                                    $philhealthid = "";
                                                    $sssid = "";
                                                    $editbirthday = date("m/d/Y", strtotime($birthday));
                                                    $editdatehired = date("m/d/Y", strtotime($datehired));
                                                    if($dateend == "0000-00-00 00:00:00" || $dateend == "1970-01-01 01:00:00") {
                                                        $editdateend = "";
                                                    } else {
                                                        $editdateend = date("m/d/Y", strtotime($dateend));
                                                    }
                                                    $birthday = date("F d, Y", strtotime($birthday));
                                                    $datehired = date("F d, Y", strtotime($datehired));
                                                    
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
                                                    $sundayhoursworked = 0;
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

                                                    $firstcycledate1 = $prevmonth."/26/".$currentprevyear;
                                                    $firstcycledate2 = $month."/11/".$year;
                                                    // $firstcycledate1 = "12/26/2017"; //this is cycle 25 to 10
                                                    // $firstcycledate2 = "1/11/2018";
                                                    $firstcycledate1 = date("Y-m-d H:i:s", strtotime($firstcycledate1));
                                                    $firstcycledate2 = date("Y-m-d H:i:s", strtotime($firstcycledate2));
                                                    $secondcycledate1 = $month."/11/".$year;
                                                    $secondcycledate2 = $month."/26/".$year;
                                                    // $secondcycledate1 = "1/11/2018"; //this is cycle 11 to 25
                                                    // $secondcycledate2 = "1/26/2018";
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

                                                    if($cycle == "1") {
                                                        $sundayStartDate = date('Y-m-d', strtotime($firstcycledate1));
                                                        $sundayEndDate = date('Y-m-d', strtotime($firstcycledate2));
                                                    } else if($cycle == "2") {
                                                        $sundayStartDate = date('Y-m-d', strtotime($secondcycledate1));
                                                        $sundayEndDate = date('Y-m-d', strtotime($secondcycledate2));
                                                    }

                                                    $sundays = array();

                                                    while ($sundayStartDate <= $sundayEndDate) {
                                                        if (date('w', strtotime($sundayStartDate)) == 0) {
                                                            $sundays[] = date('Y-m-d', strtotime($sundayStartDate));
                                                        }

                                                        $sundayStartDate = date('Y-m-d H:i:s', strtotime($sundayStartDate . ' +1 day'));
                                                    }

                                                    if(count($sundays) > 0) {
                                                        for($i = 0; $i < count($sundays); $i++) {
                                                            $sundaydate = $sundays[$i];
                                                            $sqlsd = "SELECT DISTINCT DATE(attendance_date_in_out), attendance_date_in_out, attendance_value FROM hurtajadmin_attendance WHERE employee_id = '$empid' AND date(attendance_date_in_out) = '$sundaydate' AND attendance_value = '0' AND attendance_status = '1' LIMIT 1";
                                                            $querysd = mysqli_query($db_conn, $sqlsd);
                                                            $countsd = mysqli_num_rows($querysd);
                                                            while($rowsd = mysqli_fetch_array($querysd)) {
                                                                $dateinsd = $rowsd["attendance_date_in_out"];
                                                                $sqloutsd = "SELECT id, attendance_date_in_out FROM hurtajadmin_attendance WHERE employee_id = '$empid' AND DATE(attendance_date_in_out) = DATE('$dateinsd') AND attendance_value = '1' AND attendance_status = '1' LIMIT 1";
                                                                $queryoutsd = mysqli_query($db_conn, $sqloutsd);
                                                                $countoutsd = mysqli_num_rows($queryoutsd);
                                                                if($countoutsd > 0) {
                                                                    while($rowoutsd = mysqli_fetch_array($queryoutsd)) {
                                                                        $attendanceidoutsd = $rowoutsd["id"];  
                                                                        $dateoutsd = $rowoutsd["attendance_date_in_out"];
                                                                    }

                                                                    $hourdiff = round((strtotime($dateoutsd) - strtotime($dateinsd))/3600, 1);
                                                                    if($hourdiff > 8) {
                                                                        $hourdiff = 8;
                                                                    }
                                                                    $sundayhoursworked = $sundayhoursworked + $hourdiff;
                                                                }
                                                                    
                                                            }
                                                        }
                                                    }

                                                    $otpay1 = $perhour * $xotcount1; // this is base on per hour not ot per hour
                                                    $otpay2 = $perhour * $xotcount2; // this is base on per hour not ot per hour
                                                    $bimonthsalary1 = (($hoursworked1-$sundayhoursworked-$firstcycleholidayhoursworked1-$firstcycleholidayhoursworked2)*$perhour)+($xotcount1*$perhour)+($sundayhoursworked*$perhour)+(($firstcycleholidayhoursworked1+$firstcycleholidaybonushours1)*$perhour)+(($firstcycleholidayhoursworked2+$firstcycleholidaybonushours2)*$perhour);

                                                    $bimonthsalary2 = (($hoursworked2-$sundayhoursworked-$secondcycleholidayhoursworked1-$secondcycleholidayhoursworked2)*$perhour)+($xotcount2*$perhour)+($sundayhoursworked*$perhour)+(($secondcycleholidayhoursworked1+$secondcycleholidaybonushours1)*$perhour)+(($secondcycleholidayhoursworked2+$secondcycleholidaybonushours2)*$perhour);

                                                    if($tax == '1') {
                                                        $sql2 = "SELECT * FROM hurtajadmin_tax_contribution WHERE $bimonthsalary1 >= tax_contribution_range_from AND $bimonthsalary1 <= tax_contribution_range_to";
                                                        $query2 = mysqli_query($db_conn, $sql2);
                                                        $count2 = mysqli_num_rows($query2);
                                                        if($count2 > 0) {
                                                            while($row2 = mysqli_fetch_array($query2)) {  
                                                                $taxcont1 = $row2["tax_contribution_contribution"];
                                                                if($taxcont1 == "") {
                                                                    $taxcont1 = 0;
                                                                }
                                                            }
                                                        }
                                                        $sql21 = "SELECT * FROM hurtajadmin_tax_contribution WHERE $bimonthsalary2 >= tax_contribution_range_from AND $bimonthsalary2 <= tax_contribution_range_to";
                                                        $query21 = mysqli_query($db_conn, $sql21);
                                                        $count21 = mysqli_num_rows($query21);
                                                        if($count21 > 0) {
                                                            while($row21 = mysqli_fetch_array($query21)) {  
                                                                $taxcont2 = $row21["tax_contribution_contribution"];
                                                                if($taxcont2 == "") {
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
                                                                $ssscont1 = $row3["sss_contribution_contribution"];
                                                                if($ssscont1 == "") {
                                                                    $ssscont1 = 0;
                                                                }
                                                            }
                                                        }
                                                        $sql31 = "SELECT * FROM hurtajadmin_sss_contribution WHERE $bimonthsalary2 >= sss_contribution_range_from AND $bimonthsalary2 <= sss_contribution_range_to";
                                                        $query31 = mysqli_query($db_conn, $sql31);
                                                        $count31 = mysqli_num_rows($query31);
                                                        if($count31 > 0) {
                                                            while($row31 = mysqli_fetch_array($query31)) {  
                                                                $ssscont2 = $row31["sss_contribution_contribution"];
                                                                if($ssscont2 == "") {
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
                                                                $philhealthcont1 = $row4["philhealth_contribution_contribution"];
                                                                if($philhealthcont1 == "") {
                                                                    $philhealthcont1 = 0;
                                                                }
                                                            }
                                                        }
                                                        $sql41 = "SELECT * FROM hurtajadmin_philhealth_contribution WHERE $bimonthsalary2 >= philhealth_contribution_range_from AND $bimonthsalary2 <= philhealth_contribution_range_to";
                                                        $query41 = mysqli_query($db_conn, $sql41);
                                                        $count41 = mysqli_num_rows($query41);
                                                        if($count41 > 0) {
                                                            while($row41 = mysqli_fetch_array($query41)) {  
                                                                $philhealthcont2 = $row41["philhealth_contribution_contribution"];
                                                                if($philhealthcont2 == "") {
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
                                                                $pagibigcont1 = $row5["pagibig_contribution_contribution"];
                                                                if($pagibigcont1 == "") {
                                                                    $pagibigcont1 = 0;
                                                                }
                                                            }
                                                        }
                                                        $sql51 = "SELECT * FROM hurtajadmin_pagibig_contribution WHERE $bimonthsalary2 >= pagibig_contribution_range_from AND $bimonthsalary2 <= pagibig_contribution_range_to";
                                                        $query51 = mysqli_query($db_conn, $sql51);
                                                        $count51 = mysqli_num_rows($query51);
                                                        if($count51 > 0) {
                                                            while($row51 = mysqli_fetch_array($query51)) {  
                                                                $pagibigcont2 = $row51["pagibig_contribution_contribution"];
                                                                if($pagibigcont2 == "") {
                                                                    $pagibigcont2 = 0;
                                                                }
                                                            }
                                                        }
                                                    }
                                                    $sql6 = "SELECT * FROM hurtajadmin_cash_loan_advance WHERE cash_loan_advance_date >= '$firstcycledate1' AND cash_loan_advance_date < '$firstcycledate2' AND employee_id = '$empid'";
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
                                                    $sql7 = "SELECT * FROM hurtajadmin_cash_loan_advance WHERE cash_loan_advance_date >= '$secondcycledate1' AND cash_loan_advance_date < '$secondcycledate2' AND employee_id = '$empid'";
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

                                                    
                                                    if(($bimonthsalary1 != 0 && $cycle == "1") || ($bimonthsalary2 != 0 && $cycle == "2")) {
                                                        $deductions1 = (float)$taxcont1+(float)$pagibigcont1+(float)$ssscont1+(float)$philhealthcont1;
                                                        $deductions2 = (float)$taxcont2+(float)$pagibigcont2+(float)$ssscont2+(float)$philhealthcont2;
                                                    } else {
                                                        $deductions1 = 0;
                                                        $deductions2 = 0;
                                                    }
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

                                                    $bimonthdeductedsalaryfinal = "";
                                                    $bimonthbasesalaryfinal = "";
                                                    $cashloanfinal = "";
                                                    $cashadvancefinal = "";
                                                    $deductionfinal = "";
                                                    $daysofwork = "";
                                                    $hoursworked = "";
                                                    $othoursworked = "";
                                                    $otbasedhoursworked = "";
                                                    $regularholidayfinal = "";
                                                    $regularholidaybonushoursfinal = "";
                                                    $specialholidayfinal = "";
                                                    $specialholidaybonushoursfinal = "";
                                                    $otpayfinal = "";
                                                    $latecountfinal = "";

                                                    $taxcontfinal = "0";
                                                    $pagibigcontfinal = "0";
                                                    $ssscontfinal = "0";
                                                    $philhealthcontfinal = "0";

                                                    if($cycle == "1") {
                                                        $bimonthdeductedsalaryfinal = $payroll_settings_paycheck_deducted_1;
                                                        $bimonthbasesalaryfinal = $payroll_settings_paycheck_base_1;
                                                        $cashloanfinal = $cashloanfirstcycle;
                                                        $cashadvancefinal = $cashadvancefirstcycle;
                                                        $deductionfinal = $deductions1;
                                                        $datediff = strtotime($firstcycledate2) - strtotime($firstcycledate1);
                                                        $daysofwork = $datediff / (60 * 60 * 24) - 2;
                                                        $hoursworked = $hoursworked1;
                                                        $othoursworked = $xotcount1;
                                                        $otbasedhoursworked = $xotcountbase1;
                                                        $regularholidayfinal = $firstcycleholidayhoursworked1;
                                                        $regularholidaybonushoursfinal = $firstcycleholidaybonushours1;
                                                        $specialholidayfinal = $firstcycleholidayhoursworked2;
                                                        $specialholidaybonushoursfinal = $firstcycleholidaybonushours2;
                                                        $otpayfinal = $otpay1;
                                                        $latecountfinal = $latecount1;

                                                        if($bimonthdeductedsalaryfinal != 0) {
                                                            $taxcontfinal = $taxcont1;
                                                            $pagibigcontfinal = $pagibigcont1;
                                                            $ssscontfinal = $ssscont1;
                                                            $philhealthcontfinal = $philhealthcont1;
                                                        }
                                                    } else if($cycle == "2") {
                                                        $bimonthdeductedsalaryfinal = $payroll_settings_paycheck_deducted_2;
                                                        $bimonthbasesalaryfinal = $payroll_settings_paycheck_base_2;
                                                        $cashloanfinal = $cashloansecondcycle;
                                                        $cashadvancefinal = $cashadvancesecondcycle;
                                                        $deductionfinal = $deductions2;
                                                        $datediff = strtotime($secondcycledate2) - strtotime($secondcycledate1);
                                                        $daysofwork = $datediff / (60 * 60 * 24) - 2;
                                                        $hoursworked = $hoursworked2;
                                                        $othoursworked = $xotcount2;
                                                        $otbasedhoursworked = $xotcountbase2;
                                                        $regularholidayfinal = $secondcycleholidayhoursworked1;
                                                        $regularholidaybonushoursfinal = $secondcycleholidaybonushours1;
                                                        $specialholidayfinal = $secondcycleholidayhoursworked2;
                                                        $specialholidaybonushoursfinal = $secondcycleholidaybonushours2;
                                                        $otpayfinal = $otpay2;
                                                        $latecountfinal = $latecount2;

                                                        if($bimonthdeductedsalaryfinal != 0) {
                                                            $taxcontfinal = $taxcont2;
                                                            $pagibigcontfinal = $pagibigcont2;
                                                            $ssscontfinal = $ssscont2;
                                                            $philhealthcontfinal = $philhealthcont2;
                                                        }
                                                    }

                                                    $fullname = $lname.' '.$fname.' '.$mnameinitial.'.';

                                                    $out1 = strlen($fullname) > 15 ? substr($fullname,0,15)."..." : $fullname;
                                                    $out2 = strlen($fullname) > 24 ? substr($fullname,0,24)."..." : $fullname;

                                                    if($count == 1) {

                                                    echo '
                                                        <div class="container-fluid">

                                                         <div class="row">
                                                            <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4" style="border-bottom: 1px solid #ddd;">
                                                                <div style="padding-bottom: 5px; padding-top: 5px;">
                                                               <img src="image/logoonly.png" width="50" height="50" style="float: left; margin-right: 5px;" /><h5>HURT AJ FABRICATION<br>AND ENTERPRISES CO.</h5>
                                                                </div>
                                                               <table style="width: 100%; font-size: 13px; margin-bottom: 16px;">
                                                                    <tr>
                                                                        <td>Employee</td>
                                                                        <td>:</td>
                                                                        <td style="text-align: right;"><B>'.strtoupper($out1).'</B></td>
                                                                    </tr>
                                                                    
                                                                    <tr>
                                                                        <td>Pay Period</td>
                                                                        <td>:</td>
                                                                        <td style="text-align: right;">'.strtoupper($monthtext).'. '.$period.', '.$year.'</td>
                                                                    </tr>
                                                                    <tr><td><br></td></tr>
                                                                    <tr>
                                                                        <td>Total Earnings</td>
                                                                        <td>:</td>
                                                                        <td style="text-align: right;">'.number_format((($hoursworked-$sundayhoursworked-$regularholidayfinal-$specialholidayfinal)*$perhour)+($othoursworked*$perhour)+($sundayhoursworked*$perhour)+(($regularholidayfinal+$regularholidaybonushoursfinal)*$perhour)+(($specialholidayfinal+$specialholidaybonushoursfinal)*$perhour), 2, '.', ',').'</td>
                                                                    </tr>

                                                                    <tr>
                                                                        <td>Total Deductions</td>
                                                                        <td>:</td>
                                                                        <td style="text-align: right;">'.number_format($deductionfinal+$cashloanfinal+$cashadvancefinal+($latecountfinal*$perhour), 2, '.', ',').'</td>
                                                                    </tr>
                                                                    <tr><td><br></td></tr>
                                                                    <tr><td><br><br></td></tr>
                                                                    <tr>
                                                                        <td><b>NET PAY</b></td>
                                                                        <td>:</td>
                                                                        <td style="text-align: right;"><b>'.number_format((($hoursworked-$sundayhoursworked-$regularholidayfinal-$specialholidayfinal)*$perhour)+($othoursworked*$perhour)+($sundayhoursworked*$perhour)+(($regularholidayfinal+$regularholidaybonushoursfinal)*$perhour)+(($specialholidayfinal+$specialholidaybonushoursfinal)*$perhour)-($deductionfinal+$cashloanfinal+$cashadvancefinal+($latecountfinal*$perhour)), 2, '.', ',').'</b></td>
                                                                    </tr>
                                                                    <tr><td><br></td></tr>
                                                                    <tr><td><br></td></tr>
                                                                    <tr>
                                                                        <td>Accepted by</td>
                                                                        <td>:</td>
                                                                        <td style="border-bottom: 1px solid #ddd;"></td>
                                                                    </tr>
                                                                    <tr><td><br></td></tr>
                                                                    <tr>
                                                                        <td>Date Recieved</td>
                                                                        <td>:</td>
                                                                        <td style="border-bottom: 1px solid #ddd;"></td>
                                                                    </tr>
                                                               </table>
                                                            
                                                            </div>    
                                                            <div class="col-xs-8 col-sm-8 col-md-8 col-lg-8" style="border-left: 1px solid #ddd;height: 330px;border-bottom: 1px solid #ddd;">
                                                            <table style="width: 100%">
                                                                <tr>
                                                                    <td><div style="padding-bottom: 5px; padding-top: 5px;">
                                                               <img src="image/logoonly.png" width="50" height="50" style="float: left; margin-right: 5px;" /><h5>HURT AJ FABRICATION<br>AND ENTERPRISES CO.</h5>
                                                                </div></td>
                                                                    <td></td>
                                                                    <td></td>
                                                                    <td></td>
                                                                    <td></td>
                                                                    <td><h5 style="text-align: right;">PAY SLIP</h5></td>
                                                                </tr>
                                                                </table>
                                                            <table style="width: 100%">
                                                                <tr>
                                                                        <td>&nbsp;Employee</td>
                                                                        <td>:</td>
                                                                        <td>&nbsp;<b>'.strtoupper($out2).'</b></td>
                                                                        <td>Days of Work</td>
                                                                        <td>:</td>
                                                                        <td>&nbsp;<b>'.number_format($daysofwork, 2, '.', ',').'</b></td>
                                                                </tr>
                                                                <tr>
                                                                        <td>&nbsp;Pay Period</td>
                                                                        <td>:</td>
                                                                        <td>&nbsp;'.strtoupper($prevmonthtext).'. '.$daytext1.''.$prevyear.' - '.strtoupper($monthtext).'. '.$daytext2.', '.$year.'</td>
                                                                        <td>Days Present</td>
                                                                        <td>:</td>
                                                                        <td>&nbsp;<b>'.number_format($hoursworked/8, 2, '.', ',').'</b></td>
                                                                </tr>
                                                                </table>
                                                                <table style="width: 100%;font-size: 13px;">
                                                                    <tr style="border-bottom: 1px solid #ddd;border-top: 1px solid #ddd;">
                                                                        <td>&nbsp;EARNINGS</td>
                                                                        <TD style="text-align: right;">HOURS</TD>
                                                                        <TD style="text-align: right;">AMOUNT</TD>
                                                                        <TD style="border-left: 1px solid #ddd;height: 1px;">&nbsp;DEDUCTIONS</TD>
                                                                        <TD style="text-align: right;">HOURS</TD>
                                                                        <TD style="text-align: right;">AMOUNT</TD>
                                                                    </tr>
                                                                    <tr>
                                                                        <td>&nbsp;Basic/Reg</td>
                                                                        <td style="text-align: right;">'.number_format($hoursworked-$sundayhoursworked-$regularholidayfinal-$specialholidayfinal, 2, '.', ',').'</td>
                                                                        <td style="text-align: right;">'.number_format(($hoursworked-$sundayhoursworked-$regularholidayfinal-$specialholidayfinal)*$perhour, 2, '.', ',').'</td>
                                                                        <td style="border-left: 1px solid #ddd;height: 1px;">&nbsp;SSS</td>
                                                                        <td></td>
                                                                        <td style="text-align: right;">'.number_format($ssscontfinal, 2, '.', ',').'</td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td>&nbsp;Basic/Reg OT</td>
                                                                        <td style="text-align: right;">'.number_format($otbasedhoursworked, 2, '.', ',').'</td>
                                                                        <td style="text-align: right;">'.number_format($othoursworked*$perhour, 2, '.', ',').'</td>
                                                                        <td style="border-left: 1px solid #ddd;height: 1px;">&nbsp;SSS Loan</td>
                                                                        <td></td>
                                                                        <td style="text-align: right;">0.00</td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td>&nbsp;Sunday</td>
                                                                        <td style="text-align: right;">'.number_format($sundayhoursworked, 2, '.', ',').'</td>
                                                                        <td style="text-align: right;">'.number_format($sundayhoursworked*$perhour, 2, '.', ',').'</td>
                                                                        <td style="border-left: 1px solid #ddd;height: 1px;">&nbsp;PAG-IBIG</td>
                                                                        <td></td>
                                                                        <td style="text-align: right;">'.number_format($pagibigcontfinal, 2, '.', ',').'</td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td>&nbsp;Holiday</td>
                                                                        <td style="text-align: right;">'.number_format($regularholidayfinal, 2, '.', ',').'</td>
                                                                        <td style="text-align: right;">'.number_format(($regularholidayfinal+$regularholidaybonushoursfinal)*$perhour, 2, '.', ',').'</td>
                                                                        <td style="border-left: 1px solid #ddd;height: 1px;">&nbsp;PAG-IBIG Loan</td>
                                                                        <td></td>
                                                                        <td style="text-align: right;">0.00</td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td>&nbsp;S-Non-Working Day</td>
                                                                        <td style="text-align: right;">'.number_format($specialholidayfinal, 2, '.', ',').'</td>
                                                                        <td style="text-align: right;">'.number_format(($specialholidayfinal+$specialholidaybonushoursfinal)*$perhour, 2, '.', ',').'</td>
                                                                        <td style="border-left: 1px solid #ddd;height: 1px;">&nbsp;PhilHelth</td>
                                                                        <td></td>
                                                                        <td style="text-align: right;">'.number_format($philhealthcontfinal, 2, '.', ',').'</td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td>&nbsp;Night Differential</td>
                                                                        <td style="text-align: right;">0.00</td>
                                                                        <td style="text-align: right;">0.00</td>
                                                                        <td style="border-left: 1px solid #ddd;height: 1px;">&nbsp;Withholding Tax</td>
                                                                        <td></td>
                                                                        <td style="text-align: right;">'.number_format($taxcontfinal, 2, '.', ',').'</td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td></td>
                                                                        <td></td>
                                                                        <td></td>
                                                                        <td style="border-left: 1px solid #ddd;height: 1px;">&nbsp;Less Lates</td>
                                                                        <td style="text-align: right;">'.number_format($latecountfinal, 2, '.', ',').'</td>
                                                                        <td style="text-align: right;">'.number_format($latecountfinal*$perhour, 2, '.', ',').'</td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td></td>
                                                                        <td></td>
                                                                        <td></td>
                                                                        <td style="border-left: 1px solid #ddd;height: 1px;">&nbsp;Cash Loan(Office)</td>
                                                                        <td></td>
                                                                        <td style="text-align: right;">'.number_format($cashloanfinal, 2, '.', ',').'</td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td></td>
                                                                        <td></td>
                                                                        <td></td>
                                                                        <td style="border-left: 1px solid #ddd;height: 1px;">&nbsp;Cash Advance</td>
                                                                        <td></td>
                                                                        <td style="text-align: right;">'.number_format($cashadvancefinal, 2, '.', ',').'</td>
                                                                    </tr>
                                                                    <tr style="border-bottom: 1px solid #ddd;border-top: 1px solid #ddd;">
                                                                        <td>&nbsp;<b>TOTAL EARNINGS</b></td>
                                                                        <td></td>
                                                                        <td style="text-align: right;">'.number_format((($hoursworked-$sundayhoursworked-$regularholidayfinal-$specialholidayfinal)*$perhour)+($othoursworked*$perhour)+($sundayhoursworked*$perhour)+(($regularholidayfinal+$regularholidaybonushoursfinal)*$perhour)+(($specialholidayfinal+$specialholidaybonushoursfinal)*$perhour), 2, '.', ',').'</td>
                                                                        <td style="border-left: 1px solid #ddd;height: 1px;">&nbsp;<b>TOTAL DEDUCTIONS</b></td>
                                                                        <td></td>
                                                                        <td style="text-align: right;">'.number_format($deductionfinal+$cashloanfinal+$cashadvancefinal+($latecountfinal*$perhour), 2, '.', ',').'</td>
                                                                    </tr>
                                                                    <tr style="border-bottom: 1px solid #000;border-top: 1px solid #ddd;padding: 3px;">
                                                                        <td></td>
                                                                        <td></td>
                                                                        <td></td>
                                                                        <td>&nbsp;<B>NET PAY</B></td>
                                                                        <td>:</td>
                                                                        <td style="text-align: right;"><B>'.number_format((($hoursworked-$sundayhoursworked-$regularholidayfinal-$specialholidayfinal)*$perhour)+($othoursworked*$perhour)+($sundayhoursworked*$perhour)+(($regularholidayfinal+$regularholidaybonushoursfinal)*$perhour)+(($specialholidayfinal+$specialholidaybonushoursfinal)*$perhour)-($deductionfinal+$cashloanfinal+$cashadvancefinal+($latecountfinal*$perhour)), 2, '.', ',').'</B></td>
                                                                    </tr>
                                                                </table>
                                                            
                                                            </div>
                                                        </div>

                                                     </div>
                                                    ';
                                                } else if($count == 2) {
                                                     echo '
                                                        <div class="container-fluid">

                                                         <div class="row">
                                                            <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4" style="border-bottom: 1px solid #ddd;">
                                                                <div style="padding-bottom: 5px; padding-top: 5px;">
                                                               <img src="image/logoonly.png" width="50" height="50" style="float: left; margin-right: 5px;" /><h5>HURT AJ FABRICATION<br>AND ENTERPRISES CO.</h5>
                                                                </div>
                                                               <table style="width: 100%; font-size: 13px; margin-bottom: 16px;">
                                                                    <tr>
                                                                        <td>Employee</td>
                                                                        <td>:</td>
                                                                        <td style="text-align: right;"><B>'.strtoupper($out1).'</B></td>
                                                                    </tr>
                                                                    
                                                                    <tr>
                                                                        <td>Pay Period</td>
                                                                        <td>:</td>
                                                                        <td style="text-align: right;">'.strtoupper($monthtext).'. '.$period.', '.$year.'</td>
                                                                    </tr>
                                                                    <tr><td><br></td></tr>
                                                                    <tr>
                                                                        <td>Total Earnings</td>
                                                                        <td>:</td>
                                                                        <td style="text-align: right;">'.number_format((($hoursworked-$sundayhoursworked-$regularholidayfinal-$specialholidayfinal)*$perhour)+($othoursworked*$perhour)+($sundayhoursworked*$perhour)+(($regularholidayfinal+$regularholidaybonushoursfinal)*$perhour)+(($specialholidayfinal+$specialholidaybonushoursfinal)*$perhour), 2, '.', ',').'</td>
                                                                    </tr>

                                                                    <tr>
                                                                        <td>Total Deductions</td>
                                                                        <td>:</td>
                                                                        <td style="text-align: right;">'.number_format($deductionfinal+$cashloanfinal+$cashadvancefinal+($latecountfinal*$perhour), 2, '.', ',').'</td>
                                                                    </tr>
                                                                    <tr><td><br></td></tr>
                                                                    <tr><td><br><br></td></tr>
                                                                    <tr>
                                                                        <td><b>NET PAY</b></td>
                                                                        <td>:</td>
                                                                        <td style="text-align: right;"><b>'.number_format((($hoursworked-$sundayhoursworked-$regularholidayfinal-$specialholidayfinal)*$perhour)+($othoursworked*$perhour)+($sundayhoursworked*$perhour)+(($regularholidayfinal+$regularholidaybonushoursfinal)*$perhour)+(($specialholidayfinal+$specialholidaybonushoursfinal)*$perhour)-($deductionfinal+$cashloanfinal+$cashadvancefinal+($latecountfinal*$perhour)), 2, '.', ',').'</b></td>
                                                                    </tr>
                                                                    <tr><td><br></td></tr>
                                                                    <tr><td><br></td></tr>
                                                                    <tr>
                                                                        <td>Accepted by</td>
                                                                        <td>:</td>
                                                                        <td style="border-bottom: 1px solid #ddd;"></td>
                                                                    </tr>
                                                                    <tr><td><br></td></tr>
                                                                    <tr>
                                                                        <td>Date Recieved</td>
                                                                        <td>:</td>
                                                                        <td style="border-bottom: 1px solid #ddd;"></td>
                                                                    </tr>
                                                               </table>
                                                            
                                                            </div>    
                                                            <div class="col-xs-8 col-sm-8 col-md-8 col-lg-8" style="border-left: 1px solid #ddd;height: 330px;border-bottom: 1px solid #ddd;">
                                                            <table style="width: 100%">
                                                                <tr>
                                                                    <td><div style="padding-bottom: 5px; padding-top: 5px;">
                                                               <img src="image/logoonly.png" width="50" height="50" style="float: left; margin-right: 5px;" /><h5>HURT AJ FABRICATION<br>AND ENTERPRISES CO.</h5>
                                                                </div></td>
                                                                    <td></td>
                                                                    <td></td>
                                                                    <td></td>
                                                                    <td></td>
                                                                    <td><h5 style="text-align: right;">PAY SLIP</h5></td>
                                                                </tr>
                                                                </table>
                                                            <table style="width: 100%">
                                                                <tr>
                                                                        <td>&nbsp;Employee</td>
                                                                        <td>:</td>
                                                                        <td>&nbsp;<b>'.strtoupper($out2).'</b></td>
                                                                        <td>Days of Work</td>
                                                                        <td>:</td>
                                                                        <td>&nbsp;<b>'.number_format($daysofwork, 2, '.', ',').'</b></td>
                                                                </tr>
                                                                <tr>
                                                                        <td>&nbsp;Pay Period</td>
                                                                        <td>:</td>
                                                                        <td>&nbsp;'.strtoupper($prevmonthtext).'. '.$daytext1.''.$prevyear.' - '.strtoupper($monthtext).'. '.$daytext2.', '.$year.'</td>
                                                                        <td>Days Present</td>
                                                                        <td>:</td>
                                                                        <td>&nbsp;<b>'.number_format($hoursworked/8, 2, '.', ',').'</b></td>
                                                                </tr>
                                                                </table>
                                                                <table style="width: 100%;font-size: 13px;">
                                                                    <tr style="border-bottom: 1px solid #ddd;border-top: 1px solid #ddd;">
                                                                        <td>&nbsp;EARNINGS</td>
                                                                        <TD style="text-align: right;">HOURS</TD>
                                                                        <TD style="text-align: right;">AMOUNT</TD>
                                                                        <TD style="border-left: 1px solid #ddd;height: 1px;">&nbsp;DEDUCTIONS</TD>
                                                                        <TD style="text-align: right;">HOURS</TD>
                                                                        <TD style="text-align: right;">AMOUNT</TD>
                                                                    </tr>
                                                                    <tr>
                                                                        <td>&nbsp;Basic/Reg</td>
                                                                        <td style="text-align: right;">'.number_format($hoursworked-$sundayhoursworked-$regularholidayfinal-$specialholidayfinal, 2, '.', ',').'</td>
                                                                        <td style="text-align: right;">'.number_format(($hoursworked-$sundayhoursworked-$regularholidayfinal-$specialholidayfinal)*$perhour, 2, '.', ',').'</td>
                                                                        <td style="border-left: 1px solid #ddd;height: 1px;">&nbsp;SSS</td>
                                                                        <td></td>
                                                                        <td style="text-align: right;">'.number_format($ssscontfinal, 2, '.', ',').'</td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td>&nbsp;Basic/Reg OT</td>
                                                                        <td style="text-align: right;">'.number_format($otbasedhoursworked, 2, '.', ',').'</td>
                                                                        <td style="text-align: right;">'.number_format($othoursworked*$perhour, 2, '.', ',').'</td>
                                                                        <td style="border-left: 1px solid #ddd;height: 1px;">&nbsp;SSS Loan</td>
                                                                        <td></td>
                                                                        <td style="text-align: right;">0.00</td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td>&nbsp;Sunday</td>
                                                                        <td style="text-align: right;">'.number_format($sundayhoursworked, 2, '.', ',').'</td>
                                                                        <td style="text-align: right;">'.number_format($sundayhoursworked*$perhour, 2, '.', ',').'</td>
                                                                        <td style="border-left: 1px solid #ddd;height: 1px;">&nbsp;PAG-IBIG</td>
                                                                        <td></td>
                                                                        <td style="text-align: right;">'.number_format($pagibigcontfinal, 2, '.', ',').'</td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td>&nbsp;Holiday</td>
                                                                        <td style="text-align: right;">'.number_format($regularholidayfinal, 2, '.', ',').'</td>
                                                                        <td style="text-align: right;">'.number_format(($regularholidayfinal+$regularholidaybonushoursfinal)*$perhour, 2, '.', ',').'</td>
                                                                        <td style="border-left: 1px solid #ddd;height: 1px;">&nbsp;PAG-IBIG Loan</td>
                                                                        <td></td>
                                                                        <td style="text-align: right;">0.00</td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td>&nbsp;S-Non-Working Day</td>
                                                                        <td style="text-align: right;">'.number_format($specialholidayfinal, 2, '.', ',').'</td>
                                                                        <td style="text-align: right;">'.number_format(($specialholidayfinal+$specialholidaybonushoursfinal)*$perhour, 2, '.', ',').'</td>
                                                                        <td style="border-left: 1px solid #ddd;height: 1px;">&nbsp;PhilHelth</td>
                                                                        <td></td>
                                                                        <td style="text-align: right;">'.number_format($philhealthcontfinal, 2, '.', ',').'</td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td>&nbsp;Night Differential</td>
                                                                        <td style="text-align: right;">0.00</td>
                                                                        <td style="text-align: right;">0.00</td>
                                                                        <td style="border-left: 1px solid #ddd;height: 1px;">&nbsp;Withholding Tax</td>
                                                                        <td></td>
                                                                        <td style="text-align: right;">'.number_format($taxcontfinal, 2, '.', ',').'</td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td></td>
                                                                        <td></td>
                                                                        <td></td>
                                                                        <td style="border-left: 1px solid #ddd;height: 1px;">&nbsp;Less Lates</td>
                                                                        <td style="text-align: right;">'.number_format($latecountfinal, 2, '.', ',').'</td>
                                                                        <td style="text-align: right;">'.number_format($latecountfinal*$perhour, 2, '.', ',').'</td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td></td>
                                                                        <td></td>
                                                                        <td></td>
                                                                        <td style="border-left: 1px solid #ddd;height: 1px;">&nbsp;Cash Loan(Office)</td>
                                                                        <td></td>
                                                                        <td style="text-align: right;">'.number_format($cashloanfinal, 2, '.', ',').'</td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td></td>
                                                                        <td></td>
                                                                        <td></td>
                                                                        <td style="border-left: 1px solid #ddd;height: 1px;">&nbsp;Cash Advance</td>
                                                                        <td></td>
                                                                        <td style="text-align: right;">'.number_format($cashadvancefinal, 2, '.', ',').'</td>
                                                                    </tr>
                                                                    <tr style="border-bottom: 1px solid #ddd;border-top: 1px solid #ddd;">
                                                                        <td>&nbsp;<b>TOTAL EARNINGS</b></td>
                                                                        <td></td>
                                                                        <td style="text-align: right;">'.number_format((($hoursworked-$sundayhoursworked-$regularholidayfinal-$specialholidayfinal)*$perhour)+($othoursworked*$perhour)+($sundayhoursworked*$perhour)+(($regularholidayfinal+$regularholidaybonushoursfinal)*$perhour)+(($specialholidayfinal+$specialholidaybonushoursfinal)*$perhour), 2, '.', ',').'</td>
                                                                        <td style="border-left: 1px solid #ddd;height: 1px;">&nbsp;<b>TOTAL DEDUCTIONS</b></td>
                                                                        <td></td>
                                                                        <td style="text-align: right;">'.number_format($deductionfinal+$cashloanfinal+$cashadvancefinal+($latecountfinal*$perhour), 2, '.', ',').'</td>
                                                                    </tr>
                                                                    <tr style="border-bottom: 1px solid #000;border-top: 1px solid #ddd;padding: 3px;">
                                                                        <td></td>
                                                                        <td></td>
                                                                        <td></td>
                                                                        <td>&nbsp;<B>NET PAY</B></td>
                                                                        <td>:</td>
                                                                        <td style="text-align: right;"><B>'.number_format((($hoursworked-$sundayhoursworked-$regularholidayfinal-$specialholidayfinal)*$perhour)+($othoursworked*$perhour)+($sundayhoursworked*$perhour)+(($regularholidayfinal+$regularholidaybonushoursfinal)*$perhour)+(($specialholidayfinal+$specialholidaybonushoursfinal)*$perhour)-($deductionfinal+$cashloanfinal+$cashadvancefinal+($latecountfinal*$perhour)), 2, '.', ',').'</B></td>
                                                                    </tr>
                                                                </table>
                                                            
                                                            </div>
                                                        </div>

                                                     </div>
                                                    ';

                                                } else if($count == 3) {
                                                    echo '
                                                        <div class="container-fluid" id="page-break">

                                                         <div class="row">
                                                            <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4" style="border-bottom: 1px solid #ddd;">
                                                                <div style="padding-bottom: 5px; padding-top: 5px;">
                                                               <img src="image/logoonly.png" width="50" height="50" style="float: left; margin-right: 5px;" /><h5>HURT AJ FABRICATION<br>AND ENTERPRISES CO.</h5>
                                                                </div>
                                                               <table style="width: 100%; font-size: 13px; margin-bottom: 16px;">
                                                                    <tr>
                                                                        <td>Employee</td>
                                                                        <td>:</td>
                                                                        <td style="text-align: right;"><B>'.strtoupper($out1).'</B></td>
                                                                    </tr>
                                                                    
                                                                    <tr>
                                                                        <td>Pay Period</td>
                                                                        <td>:</td>
                                                                        <td style="text-align: right;">'.strtoupper($monthtext).'. '.$period.', '.$year.'</td>
                                                                    </tr>
                                                                    <tr><td><br></td></tr>
                                                                    <tr>
                                                                        <td>Total Earnings</td>
                                                                        <td>:</td>
                                                                        <td style="text-align: right;">'.number_format((($hoursworked-$sundayhoursworked-$regularholidayfinal-$specialholidayfinal)*$perhour)+($othoursworked*$perhour)+($sundayhoursworked*$perhour)+(($regularholidayfinal+$regularholidaybonushoursfinal)*$perhour)+(($specialholidayfinal+$specialholidaybonushoursfinal)*$perhour), 2, '.', ',').'</td>
                                                                    </tr>

                                                                    <tr>
                                                                        <td>Total Deductions</td>
                                                                        <td>:</td>
                                                                        <td style="text-align: right;">'.number_format($deductionfinal+$cashloanfinal+$cashadvancefinal+($latecountfinal*$perhour), 2, '.', ',').'</td>
                                                                    </tr>
                                                                    <tr><td><br></td></tr>
                                                                    <tr><td><br><br></td></tr>
                                                                    <tr>
                                                                        <td><b>NET PAY</b></td>
                                                                        <td>:</td>
                                                                        <td style="text-align: right;"><b>'.number_format((($hoursworked-$sundayhoursworked-$regularholidayfinal-$specialholidayfinal)*$perhour)+($othoursworked*$perhour)+($sundayhoursworked*$perhour)+(($regularholidayfinal+$regularholidaybonushoursfinal)*$perhour)+(($specialholidayfinal+$specialholidaybonushoursfinal)*$perhour)-($deductionfinal+$cashloanfinal+$cashadvancefinal+($latecountfinal*$perhour)), 2, '.', ',').'</b></td>
                                                                    </tr>
                                                                    <tr><td><br></td></tr>
                                                                    <tr><td><br></td></tr>
                                                                    <tr>
                                                                        <td>Accepted by</td>
                                                                        <td>:</td>
                                                                        <td style="border-bottom: 1px solid #ddd;"></td>
                                                                    </tr>
                                                                    <tr><td><br></td></tr>
                                                                    <tr>
                                                                        <td>Date Recieved</td>
                                                                        <td>:</td>
                                                                        <td style="border-bottom: 1px solid #ddd;"></td>
                                                                    </tr>
                                                               </table>
                                                            
                                                            </div>    
                                                            <div class="col-xs-8 col-sm-8 col-md-8 col-lg-8" style="border-left: 1px solid #ddd;height: 330px;border-bottom: 1px solid #ddd;">
                                                            <table style="width: 100%">
                                                                <tr>
                                                                    <td><div style="padding-bottom: 5px; padding-top: 5px;">
                                                               <img src="image/logoonly.png" width="50" height="50" style="float: left; margin-right: 5px;" /><h5>HURT AJ FABRICATION<br>AND ENTERPRISES CO.</h5>
                                                                </div></td>
                                                                    <td></td>
                                                                    <td></td>
                                                                    <td></td>
                                                                    <td></td>
                                                                    <td><h5 style="text-align: right;">PAY SLIP</h5></td>
                                                                </tr>
                                                                </table>
                                                            <table style="width: 100%">
                                                                <tr>
                                                                        <td>&nbsp;Employee</td>
                                                                        <td>:</td>
                                                                        <td>&nbsp;<b>'.strtoupper($out2).'</b></td>
                                                                        <td>Days of Work</td>
                                                                        <td>:</td>
                                                                        <td>&nbsp;<b>'.number_format($daysofwork, 2, '.', ',').'</b></td>
                                                                </tr>
                                                                <tr>
                                                                        <td>&nbsp;Pay Period</td>
                                                                        <td>:</td>
                                                                        <td>&nbsp;'.strtoupper($prevmonthtext).'. '.$daytext1.''.$prevyear.' - '.strtoupper($monthtext).'. '.$daytext2.', '.$year.'</td>
                                                                        <td>Days Present</td>
                                                                        <td>:</td>
                                                                        <td>&nbsp;<b>'.number_format($hoursworked/8, 2, '.', ',').'</b></td>
                                                                </tr>
                                                                </table>
                                                                <table style="width: 100%;font-size: 13px;">
                                                                    <tr style="border-bottom: 1px solid #ddd;border-top: 1px solid #ddd;">
                                                                        <td>&nbsp;EARNINGS</td>
                                                                        <TD style="text-align: right;">HOURS</TD>
                                                                        <TD style="text-align: right;">AMOUNT</TD>
                                                                        <TD style="border-left: 1px solid #ddd;height: 1px;">&nbsp;DEDUCTIONS</TD>
                                                                        <TD style="text-align: right;">HOURS</TD>
                                                                        <TD style="text-align: right;">AMOUNT</TD>
                                                                    </tr>
                                                                    <tr>
                                                                        <td>&nbsp;Basic/Reg</td>
                                                                        <td style="text-align: right;">'.number_format($hoursworked-$sundayhoursworked-$regularholidayfinal-$specialholidayfinal, 2, '.', ',').'</td>
                                                                        <td style="text-align: right;">'.number_format(($hoursworked-$sundayhoursworked-$regularholidayfinal-$specialholidayfinal)*$perhour, 2, '.', ',').'</td>
                                                                        <td style="border-left: 1px solid #ddd;height: 1px;">&nbsp;SSS</td>
                                                                        <td></td>
                                                                        <td style="text-align: right;">'.number_format($ssscontfinal, 2, '.', ',').'</td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td>&nbsp;Basic/Reg OT</td>
                                                                        <td style="text-align: right;">'.number_format($otbasedhoursworked, 2, '.', ',').'</td>
                                                                        <td style="text-align: right;">'.number_format($othoursworked*$perhour, 2, '.', ',').'</td>
                                                                        <td style="border-left: 1px solid #ddd;height: 1px;">&nbsp;SSS Loan</td>
                                                                        <td></td>
                                                                        <td style="text-align: right;">0.00</td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td>&nbsp;Sunday</td>
                                                                        <td style="text-align: right;">'.number_format($sundayhoursworked, 2, '.', ',').'</td>
                                                                        <td style="text-align: right;">'.number_format($sundayhoursworked*$perhour, 2, '.', ',').'</td>
                                                                        <td style="border-left: 1px solid #ddd;height: 1px;">&nbsp;PAG-IBIG</td>
                                                                        <td></td>
                                                                        <td style="text-align: right;">'.number_format($pagibigcontfinal, 2, '.', ',').'</td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td>&nbsp;Holiday</td>
                                                                        <td style="text-align: right;">'.number_format($regularholidayfinal, 2, '.', ',').'</td>
                                                                        <td style="text-align: right;">'.number_format(($regularholidayfinal+$regularholidaybonushoursfinal)*$perhour, 2, '.', ',').'</td>
                                                                        <td style="border-left: 1px solid #ddd;height: 1px;">&nbsp;PAG-IBIG Loan</td>
                                                                        <td></td>
                                                                        <td style="text-align: right;">0.00</td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td>&nbsp;S-Non-Working Day</td>
                                                                        <td style="text-align: right;">'.number_format($specialholidayfinal, 2, '.', ',').'</td>
                                                                        <td style="text-align: right;">'.number_format(($specialholidayfinal+$specialholidaybonushoursfinal)*$perhour, 2, '.', ',').'</td>
                                                                        <td style="border-left: 1px solid #ddd;height: 1px;">&nbsp;PhilHelth</td>
                                                                        <td></td>
                                                                        <td style="text-align: right;">'.number_format($philhealthcontfinal, 2, '.', ',').'</td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td>&nbsp;Night Differential</td>
                                                                        <td style="text-align: right;">0.00</td>
                                                                        <td style="text-align: right;">0.00</td>
                                                                        <td style="border-left: 1px solid #ddd;height: 1px;">&nbsp;Withholding Tax</td>
                                                                        <td></td>
                                                                        <td style="text-align: right;">'.number_format($taxcontfinal, 2, '.', ',').'</td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td></td>
                                                                        <td></td>
                                                                        <td></td>
                                                                        <td style="border-left: 1px solid #ddd;height: 1px;">&nbsp;Less Lates</td>
                                                                        <td style="text-align: right;">'.number_format($latecountfinal, 2, '.', ',').'</td>
                                                                        <td style="text-align: right;">'.number_format($latecountfinal*$perhour, 2, '.', ',').'</td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td></td>
                                                                        <td></td>
                                                                        <td></td>
                                                                        <td style="border-left: 1px solid #ddd;height: 1px;">&nbsp;Cash Loan(Office)</td>
                                                                        <td></td>
                                                                        <td style="text-align: right;">'.number_format($cashloanfinal, 2, '.', ',').'</td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td></td>
                                                                        <td></td>
                                                                        <td></td>
                                                                        <td style="border-left: 1px solid #ddd;height: 1px;">&nbsp;Cash Advance</td>
                                                                        <td></td>
                                                                        <td style="text-align: right;">'.number_format($cashadvancefinal, 2, '.', ',').'</td>
                                                                    </tr>
                                                                    <tr style="border-bottom: 1px solid #ddd;border-top: 1px solid #ddd;">
                                                                        <td>&nbsp;<b>TOTAL EARNINGS</b></td>
                                                                        <td></td>
                                                                        <td style="text-align: right;">'.number_format((($hoursworked-$sundayhoursworked-$regularholidayfinal-$specialholidayfinal)*$perhour)+($othoursworked*$perhour)+($sundayhoursworked*$perhour)+(($regularholidayfinal+$regularholidaybonushoursfinal)*$perhour)+(($specialholidayfinal+$specialholidaybonushoursfinal)*$perhour), 2, '.', ',').'</td>
                                                                        <td style="border-left: 1px solid #ddd;height: 1px;">&nbsp;<b>TOTAL DEDUCTIONS</b></td>
                                                                        <td></td>
                                                                        <td style="text-align: right;">'.number_format($deductionfinal+$cashloanfinal+$cashadvancefinal+($latecountfinal*$perhour), 2, '.', ',').'</td>
                                                                    </tr>
                                                                    <tr style="border-bottom: 1px solid #000;border-top: 1px solid #ddd;padding: 3px;">
                                                                        <td></td>
                                                                        <td></td>
                                                                        <td></td>
                                                                        <td>&nbsp;<B>NET PAY</B></td>
                                                                        <td>:</td>
                                                                        <td style="text-align: right;"><B>'.number_format((($hoursworked-$sundayhoursworked-$regularholidayfinal-$specialholidayfinal)*$perhour)+($othoursworked*$perhour)+($sundayhoursworked*$perhour)+(($regularholidayfinal+$regularholidaybonushoursfinal)*$perhour)+(($specialholidayfinal+$specialholidaybonushoursfinal)*$perhour)-($deductionfinal+$cashloanfinal+$cashadvancefinal+($latecountfinal*$perhour)), 2, '.', ',').'</B></td>
                                                                    </tr>
                                                                </table>
                                                            
                                                            </div>
                                                        </div>

                                                     </div>
                                                    ';

                                                    $count = 0;

                                                }
                                                }
                                            }
  ?>

  <?php

  

  echo '

     

     ';

     ?>

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

