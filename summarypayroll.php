<?php
include_once("include/loginstatus.php");
if (!isset($_SESSION["userid"])) {
  header("location: index.php");
  exit();
}

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
                    <th style="width: 50px;">NO.</th>
                    <th style="width: 250px;">EMPLOYEE</th>
                    <th style="width: 250px;">PAY PERIOD</th>
                    <th style="width: 80px;">DAYS OF WORK</th>
                    <th style="width: 80px;">DAYS PRESENT</th>
                    <th style="width: 80px;">OVER TIME</th>
                    <th style="width: 80px;">SSS</th>
                    <th style="width: 80px;">SSS LOAN</th>
                    <th style="width: 80px;">PAG-IBIG</th>
                    <th style="width: 80px;">PAG-IBIG LOAN</th>
                    <th style="width: 80px;">PHIL HEALTH</th>
                    <th style="width: 80px;">TAX</th>
                    <th style="width: 80px;">LESS LATES</th>
                    <th style="width: 80px;">CASH LOAN</th>
                    <th style="width: 90px;">CASH ADVANCE</th>
                    <th style="width: 80px;">SUNDAY</th>
                    <th style="width: 100px;">RATE PER HOUR</th>
                    <th style="width: 250px;">PAYROLL PERIOD</th>
                    <th style="width: 100px;">RATE PER DAY</th>
                    <th style="width: 80px;">HOLIDAY</th>
                    <th style="width: 80px; font-size: 12px;">S N WORKING</th>
                    <th style="width: 80px;">DAILY</th>
                    <th style="width: 90px;">OVERTIME PAY</th>
                    <th style="width: 80px;">SUNDAY</th>
                    <th style="width: 80px;">HOLIDAY</th>
                    <th style="width: 80px; font-size: 12px;">S N WORKING</th>
                    <th style="width: 80px;">GROSS</th>
                    <th style="width: 90px; font-size: 12px;">TOTAL DEDUCTION</th>
                    <th style="width: 80px;">NET</th>
                </tr>
            </thead>

            <tbody>


  <?php

                                                $sql = "SELECT * FROM hurtajadmin_employee ORDER BY id DESC";
                                                $query = mysqli_query($db_conn, $sql);
                                                $count = 0;
                                                $sssgrandtotal = 0;
                                                $pagibiggrandtotal = 0;
                                                $philhealthgrandtotal = 0;
                                                $taxgrandtotal = 0;
                                                $cashloangrandtotal = 0;
                                                $cashadvancegrandtotal = 0;
                                                $dailygrandtotal = 0;
                                                $overtimegrandtotal = 0;
                                                $sundaygrandtotal = 0;
                                                $holidaygrandtotal = 0;
                                                $snholidaygrandtotal = 0;
                                                $grossgrandtotal = 0;
                                                $deductionsgrandtotal = 0;
                                                $netgrandtotal = 0;
                                                $basicpay = 0;
                                                $overtimepay = 0;
                                                $taxcont = 0;
                                                $pagibigcont = 0;
                                                $ssscont = 0;
                                                $philhealthcont = 0;
                                                $daysofwork = 0;
                                                $dayspresent = 0;
                                                $cashadvance = 0;
                                                $cashloan = 0;
                                                $lesslate = 0;
                                                $snonworkingholiday = 0;
                                                $holiday = 0;
                                                $sunday = 0;
                                                $sundayhours = 0;
                                                $perhour = 0;
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
                                                    
                                                    $sqlregrularpayslip = "SELECT * FROM hurtajadmin_regular_payslip WHERE employee_id = '$empid' AND regular_payslip_date_cycle_month = '$month' AND regular_payslip_date_cycle_cycle = '$cycle' AND regular_payslip_date_cycle_year = '$year'";
                                                    $queryregrularpayslip = mysqli_query($db_conn, $sqlregrularpayslip);

                                                    while($rowregrularpayslip = mysqli_fetch_array($queryregrularpayslip)) { 
                                                        $recid = $rowregrularpayslip["id"];
                                                        $month = $rowregrularpayslip["regular_payslip_date_cycle_month"];
                                                        $cycle = $rowregrularpayslip["regular_payslip_date_cycle_cycle"];
                                                        $year = $rowregrularpayslip["regular_payslip_date_cycle_year"];
                                                        $basicpay = $rowregrularpayslip["regular_payslip_basic_pay"];
                                                        $overtimepay = $rowregrularpayslip["regular_payslip_overtime_pay"];
                                                        $taxcont = $rowregrularpayslip["regular_payslip_tax_cont"];
                                                        $pagibigcont = $rowregrularpayslip["regular_payslip_pagibig_cont"];
                                                        $ssscont = $rowregrularpayslip["regular_payslip_sss_cont"];
                                                        $philhealthcont = $rowregrularpayslip["regular_payslip_philhealth_cont"];

                                                        $daysofwork = $rowregrularpayslip["regular_payslip_days_of_work"];
                                                        $dayspresent = $rowregrularpayslip["regular_payslip_days_present"];
                                                        $cashadvance = $rowregrularpayslip["regular_payslip_cash_advance"];
                                                        $cashloan = $rowregrularpayslip["regular_payslip_cash_loan"];
                                                        $lesslatehours = $rowregrularpayslip["regular_payslip_less_lates_hours"];
                                                        $lesslate = $rowregrularpayslip["regular_payslip_less_lates"];
                                                        $snonworkingholidayhours = $rowregrularpayslip["regular_payslip_s_non_working_holiday_hours"];
                                                        $snonworkingholiday = $rowregrularpayslip["regular_payslip_s_non_working_holiday"];
                                                        $holidayhours = $rowregrularpayslip["regular_payslip_holiday_hours"];
                                                        $holiday = $rowregrularpayslip["regular_payslip_holiday"];
                                                        $sundayhours = $rowregrularpayslip["regular_payslip_sunday_hours"];
                                                        $sunday = $rowregrularpayslip["regular_payslip_sunday"];
                                                        $basicregothours = $rowregrularpayslip["regular_payslip_basic_reg_ot_hours"];
                                                        $basicregot = $rowregrularpayslip["regular_payslip_basic_reg_ot"];
                                                        $basicreghours = $rowregrularpayslip["regular_payslip_basic_reg_hours"];
                                                        $basicreg = $rowregrularpayslip["regular_payslip_basic_reg"];

                                                        $datecreated = $rowregrularpayslip["regular_payslip_date_created"];
                                                        $status = $rowregrularpayslip["regular_payslip_status"];

                                                    }

                                                    $sqlsettings = "SELECT * FROM hurtajadmin_employee_settings WHERE employee_id = '$empid'";
                                                    $querysettings = mysqli_query($db_conn, $sqlsettings);

                                                    while($rowsettings = mysqli_fetch_array($querysettings)) { 
                                                        $perhour = $rowsettings["employee_settings_perhour"];
                                                    }

                                                    $lmnameinitial = substr($mname, 0, 1);
                                                    $fullname = $fname.' '.$lmnameinitial.'. '.$lname;

                                                    $out1 = strlen($fullname) > 15 ? substr($fullname,0,15)."..." : $fullname;
                                                    $out2 = strlen($fullname) > 24 ? substr($fullname,0,24)."..." : $fullname;

                                                    $sssgrandtotal = $sssgrandtotal + $ssscont;
                                                    $pagibiggrandtotal = $pagibiggrandtotal + $pagibigcont;
                                                    $philhealthgrandtotal = $philhealthgrandtotal + $philhealthcont;
                                                    $taxgrandtotal = $taxgrandtotal + $taxcont;
                                                    $cashloangrandtotal = $cashloangrandtotal + $cashloan;
                                                    $cashadvancegrandtotal = $cashadvancegrandtotal + $cashadvance;
                                                    $dailygrandtotal = $dailygrandtotal + ($basicpay-($sunday+$holiday+$snonworkingholiday));
                                                    $overtimegrandtotal = $overtimegrandtotal + $overtimepay;
                                                    $sundaygrandtotal = $sundaygrandtotal + $sunday;
                                                    $holidaygrandtotal = $holidaygrandtotal + $holiday;
                                                    $snholidaygrandtotal = $snholidaygrandtotal + $snonworkingholiday;
                                                    $grossgrandtotal = $grossgrandtotal + $basicpay+$overtimepay;
                                                    $deductionsgrandtotal = $deductionsgrandtotal + ($ssscont+$philhealthcont+$pagibigcont+$taxcont+$cashadvance+$cashloan+$lesslate);
                                                    $netgrandtotal = $netgrandtotal + ($basicpay+$overtimepay-($ssscont+$philhealthcont+$pagibigcont+$taxcont+$cashadvance+$cashloan+$lesslate));

                                                    echo '
                                                    <tr>
                                                        <td style="text-align: center;">'.$count.'</td>
                                                        <td style="text-align: left;">'.strtoupper($lname).' '.strtoupper($fname).' '.strtoupper($lmnameinitial).'.</td>
                                                        <td style="text-align: left;">'.strtoupper($prevmonthtext).'. '.$daytext1.''.$prevyear.' - '.strtoupper($monthtext).'. '.$daytext2.', '.$year.'</td>
                                                        <td style="text-align: center;">'.number_format($daysofwork, 2, '.', ',').'</td>
                                                        <td style="text-align: right;">'.number_format($dayspresent, 2, '.', ',').'</td>
                                                        <td style="text-align: right;">'.number_format($overtimepay/$perhour, 2, '.', ',').'</td>
                                                        <td style="text-align: right;">'.number_format($ssscont, 2, '.', ',').'</td>
                                                        <td style="text-align: right;"></td>
                                                        <td style="text-align: right;">'.number_format($pagibigcont, 2, '.', ',').'</td>
                                                        <td style="text-align: right;"></td>
                                                        <td style="text-align: right;">'.number_format($philhealthcont, 2, '.', ',').'</td>
                                                        <td style="text-align: right;">'.number_format($taxcont, 2, '.', ',').'</td>
                                                        <td style="text-align: right;">'.number_format($lesslate, 2, '.', ',').'</td>
                                                        <td style="text-align: right;">'.number_format($cashloan, 2, '.', ',').'</td>
                                                        <td style="text-align: right;">'.number_format($cashadvance, 2, '.', ',').'</td>
                                                        <td style="text-align: right;">'.number_format($sundayhours, 2, '.', ',').'</td>
                                                        <td style="text-align: right;">'.number_format($perhour, 2, '.', ',').'</td>
                                                        <td style="text-align: left;">'.strtoupper($monthtext).'. '.$period.', '.$year.'</td>
                                                        <td style="text-align: right;">'.number_format($perhour*8, 2, '.', ',').'</td>
                                                        <td style="text-align: right;"></td>
                                                        <td style="text-align: right;"></td>
                                                        <td style="text-align: right;">'.number_format($basicpay-($sunday+$holiday+$snonworkingholiday), 2, '.', ',').'</td>
                                                        <td style="text-align: right;">'.number_format($overtimepay, 2, '.', ',').'</td>
                                                        <td style="text-align: right;">'.number_format($sunday, 2, '.', ',').'</td>
                                                        <td style="text-align: right;">'.number_format($holiday, 2, '.', ',').'</td>
                                                        <td style="text-align: right;">'.number_format($snonworkingholiday, 2, '.', ',').'</td>
                                                        <td style="text-align: right;">'.number_format($basicpay+$overtimepay, 2, '.', ',').'</td>
                                                        <td style="text-align: right;">'.number_format($ssscont+$philhealthcont+$pagibigcont+$taxcont+$cashadvance+$cashloan+$lesslate, 2, '.', ',').'</td>
                                                        <td style="text-align: right;">'.number_format($basicpay+$overtimepay-($ssscont+$philhealthcont+$pagibigcont+$taxcont+$cashadvance+$cashloan+$lesslate), 2, '.', ',').'</td>
                                                    </tr>
                                                    ';
                                                }
                                            
  ?>

               
            </tbody>
        </table>

        <table class="table table-bordered">
            <tbody>
                <tr>
                    <td style="width: 50px;"></td>
                    <td style="width: 250px;"></td>
                    <td style="width: 250px;"></td>
                    <td style="width: 80px;"></td>
                    <td style="width: 80px;"></td>
                    <td style="width: 80px;"></td>
                    <td style="width: 80px; text-align: right;"><?php echo number_format($sssgrandtotal, 2, '.', ','); ?></td>
                    <td style="width: 80px;"></td>
                    <td style="width: 80px; text-align: right;"><?php echo number_format($pagibiggrandtotal, 2, '.', ','); ?></td>
                    <td style="width: 80px;"></td>
                    <td style="width: 80px; text-align: right;"><?php echo number_format($philhealthgrandtotal, 2, '.', ','); ?></td>
                    <td style="width: 80px; text-align: right;"><?php echo number_format($taxgrandtotal, 2, '.', ','); ?></td>
                    <td style="width: 80px;"></td>
                    <td style="width: 80px; text-align: right;"><?php echo number_format($cashloangrandtotal, 2, '.', ','); ?></td>
                    <td style="width: 90px; text-align: right;"><?php echo number_format($cashadvancegrandtotal, 2, '.', ','); ?></td>
                    <td style="width: 80px;"></td>
                    <td style="width: 100px;"></td>
                    <td style="width: 250px;"></td>
                    <td style="width: 100px;"></td>
                    <td style="width: 80px;"></td>
                    <td style="width: 80px;"></td>
                    <td style="width: 80px; text-align: right;"><?php echo number_format($dailygrandtotal, 2, '.', ','); ?></td>
                    <td style="width: 90px; text-align: right;"><?php echo number_format($overtimegrandtotal, 2, '.', ','); ?></td>
                    <td style="width: 80px; text-align: right;"><?php echo number_format($sundaygrandtotal, 2, '.', ','); ?></td>
                    <td style="width: 80px; text-align: right;"><?php echo number_format($holidaygrandtotal, 2, '.', ','); ?></td>
                    <td style="width: 80px; text-align: right;"><?php echo number_format($snholidaygrandtotal, 2, '.', ','); ?></td>
                    <td style="width: 80px; text-align: right;"><?php echo number_format($grossgrandtotal, 2, '.', ','); ?></td>
                    <td style="width: 90px; text-align: right;"><?php echo number_format($deductionsgrandtotal, 2, '.', ','); ?></td>
                    <td style="width: 80px; text-align: right;"><?php echo number_format($netgrandtotal, 2, '.', ','); ?></td>
                </tr>
            </tbody>
        </table>


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

