<?php
include_once("include/loginstatus.php");
if (!isset($_SESSION["userid"])) {
  header("location: index.php");
  exit();
}

$type = $_GET["type"];
$payslipid = $_GET["payslipid"];
$empid = "";

if(isset($_GET["empid"])) {
    $empid = $_GET["empid"]; 
}

$typetext = ""; 

if($type == "1") {

    $sql_h = "SELECT * FROM hurtajadmin_regular_payslip WHERE regular_payslip_payslip_id = '$payslipid' LIMIT 1";
    $query_h = mysqli_query($db_conn, $sql_h);
    while($row_h = mysqli_fetch_array($query_h)) {  
        $month = $row_h["regular_payslip_date_cycle_month"];
        $cycle = $row_h["regular_payslip_date_cycle_cycle"];
        $year = $row_h["regular_payslip_date_cycle_year"];
    }

    $typetext = "Regular"; 

    $empid = "";
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

    $sql_h = "SELECT * FROM hurtajadmin_regular_payslip WHERE regular_payslip_payslip_id = '$payslipid' LIMIT 1";
    $query_h = mysqli_query($db_conn, $sql_h);
    while($row_h = mysqli_fetch_array($query_h)) {  
        $year = $row_h["regular_payslip_date_cycle_year"];
    }

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
                                                if($empid == "") {
                                                    $sql = "SELECT * FROM hurtajadmin_regular_payslip WHERE regular_payslip_payslip_id = '$payslipid'";
                                                    $query = mysqli_query($db_conn, $sql);
                                                } else {
                                                    $sql = "SELECT * FROM hurtajadmin_regular_payslip WHERE employee_id = '$empid' AND regular_payslip_payslip_id = '$payslipid'";
                                                    $query = mysqli_query($db_conn, $sql);
                                                }
                                                $count = 0;
                                                while($row = mysqli_fetch_array($query)) {  
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


                                                    $daysofwork = $row["regular_payslip_days_of_work"];
                                                    $dayspresent = $row["regular_payslip_days_present"];
                                                    $cashadvance = $row["regular_payslip_cash_advance"];
                                                    $cashloan = $row["regular_payslip_cash_loan"];
                                                    $lesslatehours = $row["regular_payslip_less_lates_hours"];
                                                    $lesslate = $row["regular_payslip_less_lates"];
                                                    $snonworkingholidayhours = $row["regular_payslip_s_non_working_holiday_hours"];
                                                    $snonworkingholiday = $row["regular_payslip_s_non_working_holiday"];
                                                    $holidayhours = $row["regular_payslip_holiday_hours"];
                                                    $holiday = $row["regular_payslip_holiday"];
                                                    $sundayhours = $row["regular_payslip_sunday_hours"];
                                                    $sunday = $row["regular_payslip_sunday"];
                                                    $basicregothours = $row["regular_payslip_basic_reg_ot_hours"];
                                                    $basicregot = $row["regular_payslip_basic_reg_ot"];
                                                    $basicreghours = $row["regular_payslip_basic_reg_hours"];
                                                    $basicreg = $row["regular_payslip_basic_reg"];


                                                    $datecreated = $row["regular_payslip_date_created"];
                                                    $status = $row["regular_payslip_status"];

                                                    $sql_emp = "SELECT * FROM hurtajadmin_employee WHERE employee_id = '$employee_id' LIMIT 1";
                                                    $query_emp = mysqli_query($db_conn, $sql_emp);
                                                    $empfullname = "";

                                                    while($row_emp = mysqli_fetch_array($query_emp)) {
                                                        $lmnameinitial = substr($row_emp["employee_mname"], 0, 1);
                                                        $empfullname = $row_emp["employee_fname"].' '.$lmnameinitial.'. '.$row_emp["employee_lname"];
                                                    }

                                                    $out1 = strlen($empfullname) > 15 ? substr($empfullname,0,15)."..." : $empfullname;
                                                    $out2 = strlen($empfullname) > 24 ? substr($empfullname,0,24)."..." : $empfullname;

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
                                                                        <td style="text-align: right;">'.number_format($basicpay+$overtimepay, 2, '.', ',').'</td>
                                                                    </tr>

                                                                    <tr>
                                                                        <td>Total Deductions</td>
                                                                        <td>:</td>
                                                                        <td style="text-align: right;">'.number_format($ssscont+$philhealthcont+$pagibigcont+$taxcont+$cashadvance+$cashloan+$lesslate, 2, '.', ',').'</td>
                                                                    </tr>
                                                                    <tr><td><br></td></tr>
                                                                    <tr><td><br><br></td></tr>
                                                                    <tr>
                                                                        <td><b>NET PAY</b></td>
                                                                        <td>:</td>
                                                                        <td style="text-align: right;"><b>'.number_format(($basicpay+$overtimepay)-($ssscont+$philhealthcont+$pagibigcont+$taxcont+$cashadvance+$cashloan+$lesslate), 2, '.', ',').'</b></td>
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
                                                                        <td>&nbsp;<b>'.number_format($dayspresent, 2, '.', ',').'</b></td>
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
                                                                        <td style="text-align: right;">'.number_format($basicreghours, 2, '.', ',').'</td>
                                                                        <td style="text-align: right;">'.number_format($basicreg, 2, '.', ',').'</td>
                                                                        <td style="border-left: 1px solid #ddd;height: 1px;">&nbsp;SSS</td>
                                                                        <td></td>
                                                                        <td style="text-align: right;">'.number_format($ssscont, 2, '.', ',').'</td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td>&nbsp;Basic/Reg OT</td>
                                                                        <td style="text-align: right;">'.number_format($basicregothours, 2, '.', ',').'</td>
                                                                        <td style="text-align: right;">'.number_format($basicregot, 2, '.', ',').'</td>
                                                                        <td style="border-left: 1px solid #ddd;height: 1px;">&nbsp;SSS Loan</td>
                                                                        <td></td>
                                                                        <td style="text-align: right;">0.00</td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td>&nbsp;Sunday</td>
                                                                        <td style="text-align: right;">'.number_format($sundayhours, 2, '.', ',').'</td>
                                                                        <td style="text-align: right;">'.number_format($sunday, 2, '.', ',').'</td>
                                                                        <td style="border-left: 1px solid #ddd;height: 1px;">&nbsp;PAG-IBIG</td>
                                                                        <td></td>
                                                                        <td style="text-align: right;">'.number_format($pagibigcont, 2, '.', ',').'</td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td>&nbsp;Holiday</td>
                                                                        <td style="text-align: right;">'.number_format($holidayhours, 2, '.', ',').'</td>
                                                                        <td style="text-align: right;">'.number_format($holiday, 2, '.', ',').'</td>
                                                                        <td style="border-left: 1px solid #ddd;height: 1px;">&nbsp;PAG-IBIG Loan</td>
                                                                        <td></td>
                                                                        <td style="text-align: right;">0.00</td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td>&nbsp;S-Non-Working Day</td>
                                                                        <td style="text-align: right;">'.number_format($snonworkingholidayhours, 2, '.', ',').'</td>
                                                                        <td style="text-align: right;">'.number_format($snonworkingholiday, 2, '.', ',').'</td>
                                                                        <td style="border-left: 1px solid #ddd;height: 1px;">&nbsp;PhilHelth</td>
                                                                        <td></td>
                                                                        <td style="text-align: right;">'.number_format($philhealthcont, 2, '.', ',').'</td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td>&nbsp;Night Differential</td>
                                                                        <td style="text-align: right;">0.00</td>
                                                                        <td style="text-align: right;">0.00</td>
                                                                        <td style="border-left: 1px solid #ddd;height: 1px;">&nbsp;Withholding Tax</td>
                                                                        <td></td>
                                                                        <td style="text-align: right;">'.number_format($taxcont, 2, '.', ',').'</td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td></td>
                                                                        <td></td>
                                                                        <td></td>
                                                                        <td style="border-left: 1px solid #ddd;height: 1px;">&nbsp;Less Lates</td>
                                                                        <td style="text-align: right;">'.number_format($lesslatehours, 2, '.', ',').'</td>
                                                                        <td style="text-align: right;">'.number_format($lesslate, 2, '.', ',').'</td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td></td>
                                                                        <td></td>
                                                                        <td></td>
                                                                        <td style="border-left: 1px solid #ddd;height: 1px;">&nbsp;Cash Loan(Office)</td>
                                                                        <td></td>
                                                                        <td style="text-align: right;">'.number_format($cashloan, 2, '.', ',').'</td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td></td>
                                                                        <td></td>
                                                                        <td></td>
                                                                        <td style="border-left: 1px solid #ddd;height: 1px;">&nbsp;Cash Advance</td>
                                                                        <td></td>
                                                                        <td style="text-align: right;">'.number_format($cashadvance, 2, '.', ',').'</td>
                                                                    </tr>
                                                                    <tr style="border-bottom: 1px solid #ddd;border-top: 1px solid #ddd;">
                                                                        <td>&nbsp;<b>TOTAL EARNINGS</b></td>
                                                                        <td></td>
                                                                        <td style="text-align: right;">'.number_format($basicpay+$overtimepay, 2, '.', ',').'</td>
                                                                        <td style="border-left: 1px solid #ddd;height: 1px;">&nbsp;<b>TOTAL DEDUCTIONS</b></td>
                                                                        <td></td>
                                                                        <td style="text-align: right;">'.number_format($ssscont+$philhealthcont+$pagibigcont+$taxcont+$cashadvance+$cashloan+$lesslate, 2, '.', ',').'</td>
                                                                    </tr>
                                                                    <tr style="border-bottom: 1px solid #000;border-top: 1px solid #ddd;padding: 3px;">
                                                                        <td></td>
                                                                        <td></td>
                                                                        <td></td>
                                                                        <td>&nbsp;<B>NET PAY</B></td>
                                                                        <td>:</td>
                                                                        <td style="text-align: right;"><B>'.number_format(($basicpay+$overtimepay)-($ssscont+$philhealthcont+$pagibigcont+$taxcont+$cashadvance+$cashloan+$lesslate), 2, '.', ',').'</B></td>
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
                                                                    <td style="text-align: right;">'.number_format($basicpay+$overtimepay, 2, '.', ',').'</td>
                                                                </tr>

                                                                <tr>
                                                                    <td>Total Deductions</td>
                                                                    <td>:</td>
                                                                    <td style="text-align: right;">'.number_format($ssscont+$philhealthcont+$pagibigcont+$taxcont+$cashadvance+$cashloan+$lesslate, 2, '.', ',').'</td>
                                                                </tr>
                                                                <tr><td><br></td></tr>
                                                                <tr><td><br><br></td></tr>
                                                                <tr>
                                                                    <td><b>NET PAY</b></td>
                                                                    <td>:</td>
                                                                    <td style="text-align: right;"><b>'.number_format(($basicpay+$overtimepay)-($ssscont+$philhealthcont+$pagibigcont+$taxcont+$cashadvance+$cashloan+$lesslate), 2, '.', ',').'</b></td>
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
                                                                    <td>&nbsp;<b>'.number_format($dayspresent, 2, '.', ',').'</b></td>
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
                                                                    <td style="text-align: right;">'.number_format($basicreghours, 2, '.', ',').'</td>
                                                                    <td style="text-align: right;">'.number_format($basicreg, 2, '.', ',').'</td>
                                                                    <td style="border-left: 1px solid #ddd;height: 1px;">&nbsp;SSS</td>
                                                                    <td></td>
                                                                    <td style="text-align: right;">'.number_format($ssscont, 2, '.', ',').'</td>
                                                                </tr>
                                                                <tr>
                                                                    <td>&nbsp;Basic/Reg OT</td>
                                                                    <td style="text-align: right;">'.number_format($basicregothours, 2, '.', ',').'</td>
                                                                    <td style="text-align: right;">'.number_format($basicregot, 2, '.', ',').'</td>
                                                                    <td style="border-left: 1px solid #ddd;height: 1px;">&nbsp;SSS Loan</td>
                                                                    <td></td>
                                                                    <td style="text-align: right;">0.00</td>
                                                                </tr>
                                                                <tr>
                                                                    <td>&nbsp;Sunday</td>
                                                                    <td style="text-align: right;">'.number_format($sundayhours, 2, '.', ',').'</td>
                                                                    <td style="text-align: right;">'.number_format($sunday, 2, '.', ',').'</td>
                                                                    <td style="border-left: 1px solid #ddd;height: 1px;">&nbsp;PAG-IBIG</td>
                                                                    <td></td>
                                                                    <td style="text-align: right;">'.number_format($pagibigcont, 2, '.', ',').'</td>
                                                                </tr>
                                                                <tr>
                                                                    <td>&nbsp;Holiday</td>
                                                                    <td style="text-align: right;">'.number_format($holidayhours, 2, '.', ',').'</td>
                                                                    <td style="text-align: right;">'.number_format($holiday, 2, '.', ',').'</td>
                                                                    <td style="border-left: 1px solid #ddd;height: 1px;">&nbsp;PAG-IBIG Loan</td>
                                                                    <td></td>
                                                                    <td style="text-align: right;">0.00</td>
                                                                </tr>
                                                                <tr>
                                                                    <td>&nbsp;S-Non-Working Day</td>
                                                                    <td style="text-align: right;">'.number_format($snonworkingholidayhours, 2, '.', ',').'</td>
                                                                    <td style="text-align: right;">'.number_format($snonworkingholiday, 2, '.', ',').'</td>
                                                                    <td style="border-left: 1px solid #ddd;height: 1px;">&nbsp;PhilHelth</td>
                                                                    <td></td>
                                                                    <td style="text-align: right;">'.number_format($philhealthcont, 2, '.', ',').'</td>
                                                                </tr>
                                                                <tr>
                                                                    <td>&nbsp;Night Differential</td>
                                                                    <td style="text-align: right;">0.00</td>
                                                                    <td style="text-align: right;">0.00</td>
                                                                    <td style="border-left: 1px solid #ddd;height: 1px;">&nbsp;Withholding Tax</td>
                                                                    <td></td>
                                                                    <td style="text-align: right;">'.number_format($taxcont, 2, '.', ',').'</td>
                                                                </tr>
                                                                <tr>
                                                                    <td></td>
                                                                    <td></td>
                                                                    <td></td>
                                                                    <td style="border-left: 1px solid #ddd;height: 1px;">&nbsp;Less Lates</td>
                                                                    <td style="text-align: right;">'.number_format($lesslatehours, 2, '.', ',').'</td>
                                                                    <td style="text-align: right;">'.number_format($lesslate, 2, '.', ',').'</td>
                                                                </tr>
                                                                <tr>
                                                                    <td></td>
                                                                    <td></td>
                                                                    <td></td>
                                                                    <td style="border-left: 1px solid #ddd;height: 1px;">&nbsp;Cash Loan(Office)</td>
                                                                    <td></td>
                                                                    <td style="text-align: right;">'.number_format($cashloan, 2, '.', ',').'</td>
                                                                </tr>
                                                                <tr>
                                                                    <td></td>
                                                                    <td></td>
                                                                    <td></td>
                                                                    <td style="border-left: 1px solid #ddd;height: 1px;">&nbsp;Cash Advance</td>
                                                                    <td></td>
                                                                    <td style="text-align: right;">'.number_format($cashadvance, 2, '.', ',').'</td>
                                                                </tr>
                                                                <tr style="border-bottom: 1px solid #ddd;border-top: 1px solid #ddd;">
                                                                    <td>&nbsp;<b>TOTAL EARNINGS</b></td>
                                                                    <td></td>
                                                                    <td style="text-align: right;">'.number_format($basicpay+$overtimepay, 2, '.', ',').'</td>
                                                                    <td style="border-left: 1px solid #ddd;height: 1px;">&nbsp;<b>TOTAL DEDUCTIONS</b></td>
                                                                    <td></td>
                                                                    <td style="text-align: right;">'.number_format($ssscont+$philhealthcont+$pagibigcont+$taxcont+$cashadvance+$cashloan+$lesslate, 2, '.', ',').'</td>
                                                                </tr>
                                                                <tr style="border-bottom: 1px solid #000;border-top: 1px solid #ddd;padding: 3px;">
                                                                    <td></td>
                                                                    <td></td>
                                                                    <td></td>
                                                                    <td>&nbsp;<B>NET PAY</B></td>
                                                                    <td>:</td>
                                                                    <td style="text-align: right;"><B>'.number_format(($basicpay+$overtimepay)-($ssscont+$philhealthcont+$pagibigcont+$taxcont+$cashadvance+$cashloan+$lesslate), 2, '.', ',').'</B></td>
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
                                                                   <td style="text-align: right;">'.number_format($basicpay+$overtimepay, 2, '.', ',').'</td>
                                                               </tr>

                                                               <tr>
                                                                   <td>Total Deductions</td>
                                                                   <td>:</td>
                                                                   <td style="text-align: right;">'.number_format($ssscont+$philhealthcont+$pagibigcont+$taxcont+$cashadvance+$cashloan+$lesslate, 2, '.', ',').'</td>
                                                               </tr>
                                                               <tr><td><br></td></tr>
                                                               <tr><td><br><br></td></tr>
                                                               <tr>
                                                                   <td><b>NET PAY</b></td>
                                                                   <td>:</td>
                                                                   <td style="text-align: right;"><b>'.number_format(($basicpay+$overtimepay)-($ssscont+$philhealthcont+$pagibigcont+$taxcont+$cashadvance+$cashloan+$lesslate), 2, '.', ',').'</b></td>
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
                                                                   <td>&nbsp;<b>'.number_format($dayspresent, 2, '.', ',').'</b></td>
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
                                                                   <td style="text-align: right;">'.number_format($basicreghours, 2, '.', ',').'</td>
                                                                   <td style="text-align: right;">'.number_format($basicreg, 2, '.', ',').'</td>
                                                                   <td style="border-left: 1px solid #ddd;height: 1px;">&nbsp;SSS</td>
                                                                   <td></td>
                                                                   <td style="text-align: right;">'.number_format($ssscont, 2, '.', ',').'</td>
                                                               </tr>
                                                               <tr>
                                                                   <td>&nbsp;Basic/Reg OT</td>
                                                                   <td style="text-align: right;">'.number_format($basicregothours, 2, '.', ',').'</td>
                                                                   <td style="text-align: right;">'.number_format($basicregot, 2, '.', ',').'</td>
                                                                   <td style="border-left: 1px solid #ddd;height: 1px;">&nbsp;SSS Loan</td>
                                                                   <td></td>
                                                                   <td style="text-align: right;">0.00</td>
                                                               </tr>
                                                               <tr>
                                                                   <td>&nbsp;Sunday</td>
                                                                   <td style="text-align: right;">'.number_format($sundayhours, 2, '.', ',').'</td>
                                                                   <td style="text-align: right;">'.number_format($sunday, 2, '.', ',').'</td>
                                                                   <td style="border-left: 1px solid #ddd;height: 1px;">&nbsp;PAG-IBIG</td>
                                                                   <td></td>
                                                                   <td style="text-align: right;">'.number_format($pagibigcont, 2, '.', ',').'</td>
                                                               </tr>
                                                               <tr>
                                                                   <td>&nbsp;Holiday</td>
                                                                   <td style="text-align: right;">'.number_format($holidayhours, 2, '.', ',').'</td>
                                                                   <td style="text-align: right;">'.number_format($holiday, 2, '.', ',').'</td>
                                                                   <td style="border-left: 1px solid #ddd;height: 1px;">&nbsp;PAG-IBIG Loan</td>
                                                                   <td></td>
                                                                   <td style="text-align: right;">0.00</td>
                                                               </tr>
                                                               <tr>
                                                                   <td>&nbsp;S-Non-Working Day</td>
                                                                   <td style="text-align: right;">'.number_format($snonworkingholidayhours, 2, '.', ',').'</td>
                                                                   <td style="text-align: right;">'.number_format($snonworkingholiday, 2, '.', ',').'</td>
                                                                   <td style="border-left: 1px solid #ddd;height: 1px;">&nbsp;PhilHelth</td>
                                                                   <td></td>
                                                                   <td style="text-align: right;">'.number_format($philhealthcont, 2, '.', ',').'</td>
                                                               </tr>
                                                               <tr>
                                                                   <td>&nbsp;Night Differential</td>
                                                                   <td style="text-align: right;">0.00</td>
                                                                   <td style="text-align: right;">0.00</td>
                                                                   <td style="border-left: 1px solid #ddd;height: 1px;">&nbsp;Withholding Tax</td>
                                                                   <td></td>
                                                                   <td style="text-align: right;">'.number_format($taxcont, 2, '.', ',').'</td>
                                                               </tr>
                                                               <tr>
                                                                   <td></td>
                                                                   <td></td>
                                                                   <td></td>
                                                                   <td style="border-left: 1px solid #ddd;height: 1px;">&nbsp;Less Lates</td>
                                                                   <td style="text-align: right;">'.number_format($lesslatehours, 2, '.', ',').'</td>
                                                                   <td style="text-align: right;">'.number_format($lesslate, 2, '.', ',').'</td>
                                                               </tr>
                                                               <tr>
                                                                   <td></td>
                                                                   <td></td>
                                                                   <td></td>
                                                                   <td style="border-left: 1px solid #ddd;height: 1px;">&nbsp;Cash Loan(Office)</td>
                                                                   <td></td>
                                                                   <td style="text-align: right;">'.number_format($cashloan, 2, '.', ',').'</td>
                                                               </tr>
                                                               <tr>
                                                                   <td></td>
                                                                   <td></td>
                                                                   <td></td>
                                                                   <td style="border-left: 1px solid #ddd;height: 1px;">&nbsp;Cash Advance</td>
                                                                   <td></td>
                                                                   <td style="text-align: right;">'.number_format($cashadvance, 2, '.', ',').'</td>
                                                               </tr>
                                                               <tr style="border-bottom: 1px solid #ddd;border-top: 1px solid #ddd;">
                                                                   <td>&nbsp;<b>TOTAL EARNINGS</b></td>
                                                                   <td></td>
                                                                   <td style="text-align: right;">'.number_format($basicpay+$overtimepay, 2, '.', ',').'</td>
                                                                   <td style="border-left: 1px solid #ddd;height: 1px;">&nbsp;<b>TOTAL DEDUCTIONS</b></td>
                                                                   <td></td>
                                                                   <td style="text-align: right;">'.number_format($ssscont+$philhealthcont+$pagibigcont+$taxcont+$cashadvance+$cashloan+$lesslate, 2, '.', ',').'</td>
                                                               </tr>
                                                               <tr style="border-bottom: 1px solid #000;border-top: 1px solid #ddd;padding: 3px;">
                                                                   <td></td>
                                                                   <td></td>
                                                                   <td></td>
                                                                   <td>&nbsp;<B>NET PAY</B></td>
                                                                   <td>:</td>
                                                                   <td style="text-align: right;"><B>'.number_format(($basicpay+$overtimepay)-($ssscont+$philhealthcont+$pagibigcont+$taxcont+$cashadvance+$cashloan+$lesslate), 2, '.', ',').'</B></td>
                                                               </tr>
                                                           </table>
                                                       
                                                       </div>
                                                   </div>

                                                </div>
                                                    ';

                                                    $count = 0;

                                                }
                                                }
                                            } else if($type == "2") {
                                                if($empid == "") {
                                                    $sql = "SELECT * FROM hurtajadmin_tertint_payslip WHERE tertint_payslip_payslip_id = '$payslipid'";
                                                    $query = mysqli_query($db_conn, $sql);
                                                } else {
                                                    $sql = "SELECT * FROM hurtajadmin_tertint_payslip WHERE employee_id = '$empid' AND tertint_payslip_payslip_id = '$payslipid'";
                                                    $query = mysqli_query($db_conn, $sql);
                                                }
                                                $count = 0;
                                                while($row = mysqli_fetch_array($query)) {  
                                                    $count++; 
                                                    $recid = $row["id"];
                                                    $year = $row["tertint_payslip_date_cycle_year"];
                                                    $employee_id = $row["employee_id"];
                                                    $otpay = $row["tertint_payslip_ot_pay"];
                                                    $otpayhours = $row["tertint_payslip_ot_pay_hours"];
                                                    $basicpay = $row["tertint_payslip_tertint_pay"];
                                                    $basicpayhours = $row["tertint_payslip_tertint_pay_hours"];
                                                    $daysofwork = $row["tertint_payslip_days_of_work"];
                                                    $dayspresent = $row["tertint_payslip_days_present"];
                                                    $datecreated = $row["tertint_payslip_date_created"];
                                                    $status = $row["tertint_payslip_status"];

                                                    $sql_emp = "SELECT * FROM hurtajadmin_employee WHERE employee_id = '$employee_id' LIMIT 1";
                                                    $query_emp = mysqli_query($db_conn, $sql_emp);
                                                    $empfullname = "";

                                                    while($row_emp = mysqli_fetch_array($query_emp)) {
                                                        $lmnameinitial = substr($row_emp["employee_mname"], 0, 1);
                                                        $empfullname = $row_emp["employee_fname"].' '.$lmnameinitial.'. '.$row_emp["employee_lname"];
                                                    }

                                                    $out1 = strlen($empfullname) > 15 ? substr($empfullname,0,15)."..." : $empfullname;
                                                    $out2 = strlen($empfullname) > 24 ? substr($empfullname,0,24)."..." : $empfullname;

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
                                                                        <td style="text-align: right;">Jan1-Dec31, '.$year.'</td>
                                                                    </tr>
                                                                    <tr><td><br></td></tr>
                                                                    <tr>
                                                                        <td>Total Earnings</td>
                                                                        <td>:</td>
                                                                        <td style="text-align: right;">'.number_format($basicpay+$otpay, 2, '.', ',').'</td>
                                                                    </tr>

                                                                    <tr>
                                                                        <td>Total Deductions</td>
                                                                        <td>:</td>
                                                                        <td style="text-align: right;">0.00</td>
                                                                    </tr>
                                                                    <tr><td><br></td></tr>
                                                                    <tr><td><br><br></td></tr>
                                                                    <tr>
                                                                        <td><b>13TH MONTH PAY</b></td>
                                                                        <td>:</td>
                                                                        <td style="text-align: right;"><b>'.number_format(($basicpay+$otpay)/12, 2, '.', ',').'</b></td>
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
                                                                        <td>&nbsp;Jan. 1 - Dec. 31, '.$year.'</td>
                                                                        <td>Days Present</td>
                                                                        <td>:</td>
                                                                        <td>&nbsp;<b>'.number_format($dayspresent, 2, '.', ',').'</b></td>
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
                                                                        <td style="text-align: right;">'.number_format($basicpayhours, 2, '.', ',').'</td>
                                                                        <td style="text-align: right;">'.number_format($basicpay, 2, '.', ',').'</td>
                                                                        <td style="border-left: 1px solid #ddd;height: 1px;">&nbsp;SSS</td>
                                                                        <td></td>
                                                                        <td style="text-align: right;">0.00</td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td>&nbsp;Basic/Reg OT</td>
                                                                        <td style="text-align: right;">'.number_format($otpayhours, 2, '.', ',').'</td>
                                                                        <td style="text-align: right;">'.number_format($otpay, 2, '.', ',').'</td>
                                                                        <td style="border-left: 1px solid #ddd;height: 1px;">&nbsp;SSS Loan</td>
                                                                        <td></td>
                                                                        <td style="text-align: right;">0.00</td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td>&nbsp;Sunday</td>
                                                                        <td style="text-align: right;">0.00</td>
                                                                        <td style="text-align: right;">0.00</td>
                                                                        <td style="border-left: 1px solid #ddd;height: 1px;">&nbsp;PAG-IBIG</td>
                                                                        <td></td>
                                                                        <td style="text-align: right;">0.00</td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td>&nbsp;Holiday</td>
                                                                        <td style="text-align: right;">0.00</td>
                                                                        <td style="text-align: right;">0.00</td>
                                                                        <td style="border-left: 1px solid #ddd;height: 1px;">&nbsp;PAG-IBIG Loan</td>
                                                                        <td></td>
                                                                        <td style="text-align: right;">0.00</td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td>&nbsp;S-Non-Working Day</td>
                                                                        <td style="text-align: right;">0.00</td>
                                                                        <td style="text-align: right;">0.00</td>
                                                                        <td style="border-left: 1px solid #ddd;height: 1px;">&nbsp;PhilHelth</td>
                                                                        <td></td>
                                                                        <td style="text-align: right;">0.00</td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td>&nbsp;Night Differential</td>
                                                                        <td style="text-align: right;">0.00</td>
                                                                        <td style="text-align: right;">0.00</td>
                                                                        <td style="border-left: 1px solid #ddd;height: 1px;">&nbsp;Withholding Tax</td>
                                                                        <td></td>
                                                                        <td style="text-align: right;">0.00</td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td></td>
                                                                        <td></td>
                                                                        <td></td>
                                                                        <td style="border-left: 1px solid #ddd;height: 1px;">&nbsp;Less Lates</td>
                                                                        <td style="text-align: right;">0.00</td>
                                                                        <td style="text-align: right;">0.00</td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td></td>
                                                                        <td></td>
                                                                        <td></td>
                                                                        <td style="border-left: 1px solid #ddd;height: 1px;">&nbsp;Cash Loan(Office)</td>
                                                                        <td></td>
                                                                        <td style="text-align: right;">0.00</td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td></td>
                                                                        <td></td>
                                                                        <td></td>
                                                                        <td style="border-left: 1px solid #ddd;height: 1px;">&nbsp;Cash Advance</td>
                                                                        <td></td>
                                                                        <td style="text-align: right;">0.00</td>
                                                                    </tr>
                                                                    <tr style="border-bottom: 1px solid #ddd;border-top: 1px solid #ddd;">
                                                                        <td>&nbsp;<b>TOTAL EARNINGS</b></td>
                                                                        <td></td>
                                                                        <td style="text-align: right;">'.number_format($basicpay+$otpay, 2, '.', ',').'</td>
                                                                        <td style="border-left: 1px solid #ddd;height: 1px;">&nbsp;<b>TOTAL DEDUCTIONS</b></td>
                                                                        <td></td>
                                                                        <td style="text-align: right;">0.00</td>
                                                                    </tr>
                                                                    <tr style="border-bottom: 1px solid #000;border-top: 1px solid #ddd;padding: 3px;">
                                                                        <td></td>
                                                                        <td></td>
                                                                        <td></td>
                                                                        <td>&nbsp;<B>13TH MONTH PAY</B></td>
                                                                        <td>:</td>
                                                                        <td style="text-align: right;"><B>'.number_format(($basicpay+$otpay)/12, 2, '.', ',').'</B></td>
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
                                                                    <td style="text-align: right;">'.number_format($basicpay+$overtimepay, 2, '.', ',').'</td>
                                                                </tr>

                                                                <tr>
                                                                    <td>Total Deductions</td>
                                                                    <td>:</td>
                                                                    <td style="text-align: right;">'.number_format($ssscont+$philhealthcont+$pagibigcont+$taxcont+$cashadvance+$cashloan+$lesslate, 2, '.', ',').'</td>
                                                                </tr>
                                                                <tr><td><br></td></tr>
                                                                <tr><td><br><br></td></tr>
                                                                <tr>
                                                                    <td><b>NET PAY</b></td>
                                                                    <td>:</td>
                                                                    <td style="text-align: right;"><b>'.number_format(($basicpay+$overtimepay)-($ssscont+$philhealthcont+$pagibigcont+$taxcont+$cashadvance+$cashloan+$lesslate), 2, '.', ',').'</b></td>
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
                                                                    <td>&nbsp;<b>'.number_format($dayspresent, 2, '.', ',').'</b></td>
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
                                                                    <td style="text-align: right;">'.number_format($basicreghours, 2, '.', ',').'</td>
                                                                    <td style="text-align: right;">'.number_format($basicreg, 2, '.', ',').'</td>
                                                                    <td style="border-left: 1px solid #ddd;height: 1px;">&nbsp;SSS</td>
                                                                    <td></td>
                                                                    <td style="text-align: right;">'.number_format($ssscont, 2, '.', ',').'</td>
                                                                </tr>
                                                                <tr>
                                                                    <td>&nbsp;Basic/Reg OT</td>
                                                                    <td style="text-align: right;">'.number_format($basicregothours, 2, '.', ',').'</td>
                                                                    <td style="text-align: right;">'.number_format($basicregot, 2, '.', ',').'</td>
                                                                    <td style="border-left: 1px solid #ddd;height: 1px;">&nbsp;SSS Loan</td>
                                                                    <td></td>
                                                                    <td style="text-align: right;">0.00</td>
                                                                </tr>
                                                                <tr>
                                                                    <td>&nbsp;Sunday</td>
                                                                    <td style="text-align: right;">'.number_format($sundayhours, 2, '.', ',').'</td>
                                                                    <td style="text-align: right;">'.number_format($sunday, 2, '.', ',').'</td>
                                                                    <td style="border-left: 1px solid #ddd;height: 1px;">&nbsp;PAG-IBIG</td>
                                                                    <td></td>
                                                                    <td style="text-align: right;">'.number_format($pagibigcont, 2, '.', ',').'</td>
                                                                </tr>
                                                                <tr>
                                                                    <td>&nbsp;Holiday</td>
                                                                    <td style="text-align: right;">'.number_format($holidayhours, 2, '.', ',').'</td>
                                                                    <td style="text-align: right;">'.number_format($holiday, 2, '.', ',').'</td>
                                                                    <td style="border-left: 1px solid #ddd;height: 1px;">&nbsp;PAG-IBIG Loan</td>
                                                                    <td></td>
                                                                    <td style="text-align: right;">0.00</td>
                                                                </tr>
                                                                <tr>
                                                                    <td>&nbsp;S-Non-Working Day</td>
                                                                    <td style="text-align: right;">'.number_format($snonworkingholidayhours, 2, '.', ',').'</td>
                                                                    <td style="text-align: right;">'.number_format($snonworkingholiday, 2, '.', ',').'</td>
                                                                    <td style="border-left: 1px solid #ddd;height: 1px;">&nbsp;PhilHelth</td>
                                                                    <td></td>
                                                                    <td style="text-align: right;">'.number_format($philhealthcont, 2, '.', ',').'</td>
                                                                </tr>
                                                                <tr>
                                                                    <td>&nbsp;Night Differential</td>
                                                                    <td style="text-align: right;">0.00</td>
                                                                    <td style="text-align: right;">0.00</td>
                                                                    <td style="border-left: 1px solid #ddd;height: 1px;">&nbsp;Withholding Tax</td>
                                                                    <td></td>
                                                                    <td style="text-align: right;">'.number_format($taxcont, 2, '.', ',').'</td>
                                                                </tr>
                                                                <tr>
                                                                    <td></td>
                                                                    <td></td>
                                                                    <td></td>
                                                                    <td style="border-left: 1px solid #ddd;height: 1px;">&nbsp;Less Lates</td>
                                                                    <td style="text-align: right;">'.number_format($lesslatehours, 2, '.', ',').'</td>
                                                                    <td style="text-align: right;">'.number_format($lesslate, 2, '.', ',').'</td>
                                                                </tr>
                                                                <tr>
                                                                    <td></td>
                                                                    <td></td>
                                                                    <td></td>
                                                                    <td style="border-left: 1px solid #ddd;height: 1px;">&nbsp;Cash Loan(Office)</td>
                                                                    <td></td>
                                                                    <td style="text-align: right;">'.number_format($cashloan, 2, '.', ',').'</td>
                                                                </tr>
                                                                <tr>
                                                                    <td></td>
                                                                    <td></td>
                                                                    <td></td>
                                                                    <td style="border-left: 1px solid #ddd;height: 1px;">&nbsp;Cash Advance</td>
                                                                    <td></td>
                                                                    <td style="text-align: right;">'.number_format($cashadvance, 2, '.', ',').'</td>
                                                                </tr>
                                                                <tr style="border-bottom: 1px solid #ddd;border-top: 1px solid #ddd;">
                                                                    <td>&nbsp;<b>TOTAL EARNINGS</b></td>
                                                                    <td></td>
                                                                    <td style="text-align: right;">'.number_format($basicpay+$overtimepay, 2, '.', ',').'</td>
                                                                    <td style="border-left: 1px solid #ddd;height: 1px;">&nbsp;<b>TOTAL DEDUCTIONS</b></td>
                                                                    <td></td>
                                                                    <td style="text-align: right;">'.number_format($ssscont+$philhealthcont+$pagibigcont+$taxcont+$cashadvance+$cashloan+$lesslate, 2, '.', ',').'</td>
                                                                </tr>
                                                                <tr style="border-bottom: 1px solid #000;border-top: 1px solid #ddd;padding: 3px;">
                                                                    <td></td>
                                                                    <td></td>
                                                                    <td></td>
                                                                    <td>&nbsp;<B>NET PAY</B></td>
                                                                    <td>:</td>
                                                                    <td style="text-align: right;"><B>'.number_format(($basicpay+$overtimepay)-($ssscont+$philhealthcont+$pagibigcont+$taxcont+$cashadvance+$cashloan+$lesslate), 2, '.', ',').'</B></td>
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
                                                                   <td style="text-align: right;">'.number_format($basicpay+$overtimepay, 2, '.', ',').'</td>
                                                               </tr>

                                                               <tr>
                                                                   <td>Total Deductions</td>
                                                                   <td>:</td>
                                                                   <td style="text-align: right;">'.number_format($ssscont+$philhealthcont+$pagibigcont+$taxcont+$cashadvance+$cashloan+$lesslate, 2, '.', ',').'</td>
                                                               </tr>
                                                               <tr><td><br></td></tr>
                                                               <tr><td><br><br></td></tr>
                                                               <tr>
                                                                   <td><b>NET PAY</b></td>
                                                                   <td>:</td>
                                                                   <td style="text-align: right;"><b>'.number_format(($basicpay+$overtimepay)-($ssscont+$philhealthcont+$pagibigcont+$taxcont+$cashadvance+$cashloan+$lesslate), 2, '.', ',').'</b></td>
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
                                                                   <td>&nbsp;<b>'.number_format($dayspresent, 2, '.', ',').'</b></td>
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
                                                                   <td style="text-align: right;">'.number_format($basicreghours, 2, '.', ',').'</td>
                                                                   <td style="text-align: right;">'.number_format($basicreg, 2, '.', ',').'</td>
                                                                   <td style="border-left: 1px solid #ddd;height: 1px;">&nbsp;SSS</td>
                                                                   <td></td>
                                                                   <td style="text-align: right;">'.number_format($ssscont, 2, '.', ',').'</td>
                                                               </tr>
                                                               <tr>
                                                                   <td>&nbsp;Basic/Reg OT</td>
                                                                   <td style="text-align: right;">'.number_format($basicregothours, 2, '.', ',').'</td>
                                                                   <td style="text-align: right;">'.number_format($basicregot, 2, '.', ',').'</td>
                                                                   <td style="border-left: 1px solid #ddd;height: 1px;">&nbsp;SSS Loan</td>
                                                                   <td></td>
                                                                   <td style="text-align: right;">0.00</td>
                                                               </tr>
                                                               <tr>
                                                                   <td>&nbsp;Sunday</td>
                                                                   <td style="text-align: right;">'.number_format($sundayhours, 2, '.', ',').'</td>
                                                                   <td style="text-align: right;">'.number_format($sunday, 2, '.', ',').'</td>
                                                                   <td style="border-left: 1px solid #ddd;height: 1px;">&nbsp;PAG-IBIG</td>
                                                                   <td></td>
                                                                   <td style="text-align: right;">'.number_format($pagibigcont, 2, '.', ',').'</td>
                                                               </tr>
                                                               <tr>
                                                                   <td>&nbsp;Holiday</td>
                                                                   <td style="text-align: right;">'.number_format($holidayhours, 2, '.', ',').'</td>
                                                                   <td style="text-align: right;">'.number_format($holiday, 2, '.', ',').'</td>
                                                                   <td style="border-left: 1px solid #ddd;height: 1px;">&nbsp;PAG-IBIG Loan</td>
                                                                   <td></td>
                                                                   <td style="text-align: right;">0.00</td>
                                                               </tr>
                                                               <tr>
                                                                   <td>&nbsp;S-Non-Working Day</td>
                                                                   <td style="text-align: right;">'.number_format($snonworkingholidayhours, 2, '.', ',').'</td>
                                                                   <td style="text-align: right;">'.number_format($snonworkingholiday, 2, '.', ',').'</td>
                                                                   <td style="border-left: 1px solid #ddd;height: 1px;">&nbsp;PhilHelth</td>
                                                                   <td></td>
                                                                   <td style="text-align: right;">'.number_format($philhealthcont, 2, '.', ',').'</td>
                                                               </tr>
                                                               <tr>
                                                                   <td>&nbsp;Night Differential</td>
                                                                   <td style="text-align: right;">0.00</td>
                                                                   <td style="text-align: right;">0.00</td>
                                                                   <td style="border-left: 1px solid #ddd;height: 1px;">&nbsp;Withholding Tax</td>
                                                                   <td></td>
                                                                   <td style="text-align: right;">'.number_format($taxcont, 2, '.', ',').'</td>
                                                               </tr>
                                                               <tr>
                                                                   <td></td>
                                                                   <td></td>
                                                                   <td></td>
                                                                   <td style="border-left: 1px solid #ddd;height: 1px;">&nbsp;Less Lates</td>
                                                                   <td style="text-align: right;">'.number_format($lesslatehours, 2, '.', ',').'</td>
                                                                   <td style="text-align: right;">'.number_format($lesslate, 2, '.', ',').'</td>
                                                               </tr>
                                                               <tr>
                                                                   <td></td>
                                                                   <td></td>
                                                                   <td></td>
                                                                   <td style="border-left: 1px solid #ddd;height: 1px;">&nbsp;Cash Loan(Office)</td>
                                                                   <td></td>
                                                                   <td style="text-align: right;">'.number_format($cashloan, 2, '.', ',').'</td>
                                                               </tr>
                                                               <tr>
                                                                   <td></td>
                                                                   <td></td>
                                                                   <td></td>
                                                                   <td style="border-left: 1px solid #ddd;height: 1px;">&nbsp;Cash Advance</td>
                                                                   <td></td>
                                                                   <td style="text-align: right;">'.number_format($cashadvance, 2, '.', ',').'</td>
                                                               </tr>
                                                               <tr style="border-bottom: 1px solid #ddd;border-top: 1px solid #ddd;">
                                                                   <td>&nbsp;<b>TOTAL EARNINGS</b></td>
                                                                   <td></td>
                                                                   <td style="text-align: right;">'.number_format($basicpay+$overtimepay, 2, '.', ',').'</td>
                                                                   <td style="border-left: 1px solid #ddd;height: 1px;">&nbsp;<b>TOTAL DEDUCTIONS</b></td>
                                                                   <td></td>
                                                                   <td style="text-align: right;">'.number_format($ssscont+$philhealthcont+$pagibigcont+$taxcont+$cashadvance+$cashloan+$lesslate, 2, '.', ',').'</td>
                                                               </tr>
                                                               <tr style="border-bottom: 1px solid #000;border-top: 1px solid #ddd;padding: 3px;">
                                                                   <td></td>
                                                                   <td></td>
                                                                   <td></td>
                                                                   <td>&nbsp;<B>NET PAY</B></td>
                                                                   <td>:</td>
                                                                   <td style="text-align: right;"><B>'.number_format(($basicpay+$overtimepay)-($ssscont+$philhealthcont+$pagibigcont+$taxcont+$cashadvance+$cashloan+$lesslate), 2, '.', ',').'</B></td>
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

