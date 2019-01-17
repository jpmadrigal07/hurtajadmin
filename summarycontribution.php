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
                                                $ec = 0;


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

                                                    $mnameinitial = substr($mname, 0, 1);

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

                                                    $sqlemp = "SELECT id, regular_payslip_basic_pay FROM hurtajadmin_regular_payslip WHERE employee_id = '$empid' AND regular_payslip_date_cycle_month = '$month' AND regular_payslip_date_cycle_cycle = '1' AND regular_payslip_date_cycle_year = '$year'";
                                                    $queryemp = mysqli_query($db_conn, $sqlemp);

                                                    while($rowemp = mysqli_fetch_array($queryemp)) { 
                                                        $regular_payslip_basic_pay = $rowemp["regular_payslip_basic_pay"];
                                                        if($regular_payslip_basic_pay > 526.80 && $regular_payslip_basic_pay > 0) {
                                                            $ec = 30;
                                                        } else if($regular_payslip_basic_pay < 526.81 && $regular_payslip_basic_pay > 0) {
                                                            $ec = 10;
                                                        } else {
                                                            $ec = 0;
                                                        }
                                                    }

                                                    //new computation
                                                    $sqlsss1 = "SELECT SUM(regular_payslip_sss_cont) AS total FROM hurtajadmin_regular_payslip WHERE employee_id = '$empid' AND regular_payslip_date_cycle_month = '$month' AND regular_payslip_date_cycle_cycle = '1' AND regular_payslip_date_cycle_year = '$year'";
                                                    $querysss1 = mysqli_query($db_conn, $sqlsss1);
                                                    $countsss1 = mysqli_num_rows($querysss1);
                                                    if($countsss1 > 0) {
                                                        while($rowsss1 = mysqli_fetch_array($querysss1)) {  
                                                            $ssscont1 = $rowsss1["total"];
                                                        }
                                                    }

                                                    $sqlsss2 = "SELECT SUM(regular_payslip_sss_cont) AS total FROM hurtajadmin_regular_payslip WHERE employee_id = '$empid' AND regular_payslip_date_cycle_month = '$month' AND regular_payslip_date_cycle_cycle = '2' AND regular_payslip_date_cycle_year = '$year'";
                                                    $querysss2 = mysqli_query($db_conn, $sqlsss2);
                                                    $countsss2 = mysqli_num_rows($querysss2);
                                                    if($countsss2 > 0) {
                                                        while($rowsss2 = mysqli_fetch_array($querysss2)) {  
                                                            $ssscont2 = $rowsss2["total"];
                                                        }
                                                    }

                                                    $sqlpagibig1 = "SELECT SUM(regular_payslip_pagibig_cont) AS total FROM hurtajadmin_regular_payslip WHERE employee_id = '$empid' AND regular_payslip_date_cycle_month = '$month' AND regular_payslip_date_cycle_cycle = '1' AND regular_payslip_date_cycle_year = '$year'";
                                                    $querypagibig1 = mysqli_query($db_conn, $sqlpagibig1);
                                                    $countpagibig1 = mysqli_num_rows($querypagibig1);
                                                    if($countpagibig1 > 0) {
                                                        while($rowpagibig1 = mysqli_fetch_array($querypagibig1)) {  
                                                            $pagibigcont1 = $rowpagibig1["total"];
                                                        }
                                                    }

                                                    $sqlpagibig2 = "SELECT SUM(regular_payslip_pagibig_cont) AS total FROM hurtajadmin_regular_payslip WHERE employee_id = '$empid' AND regular_payslip_date_cycle_month = '$month' AND regular_payslip_date_cycle_cycle = '2' AND regular_payslip_date_cycle_year = '$year'";
                                                    $querypagibig2 = mysqli_query($db_conn, $sqlpagibig2);
                                                    $countpagibig2 = mysqli_num_rows($querypagibig2);
                                                    if($countpagibig2 > 0) {
                                                        while($rowpagibig2 = mysqli_fetch_array($querypagibig2)) {  
                                                            $pagibigcont2 = $rowpagibig2["total"];
                                                        }
                                                    }

                                                    $sqlphilhealth1 = "SELECT SUM(regular_payslip_philhealth_cont) AS total FROM hurtajadmin_regular_payslip WHERE employee_id = '$empid' AND regular_payslip_date_cycle_month = '$month' AND regular_payslip_date_cycle_cycle = '1' AND regular_payslip_date_cycle_year = '$year'";
                                                    $queryphilhealth1 = mysqli_query($db_conn, $sqlphilhealth1);
                                                    $countphilhealth1 = mysqli_num_rows($queryphilhealth1);
                                                    if($countphilhealth1 > 0) {
                                                        while($rowphilhealth1 = mysqli_fetch_array($queryphilhealth1)) {  
                                                            $philhealthcont1 = $rowphilhealth1["total"];
                                                        }
                                                    }

                                                    $sqlphilhealth2 = "SELECT SUM(regular_payslip_philhealth_cont) AS total FROM hurtajadmin_regular_payslip WHERE employee_id = '$empid' AND regular_payslip_date_cycle_month = '$month' AND regular_payslip_date_cycle_cycle = '2' AND regular_payslip_date_cycle_year = '$year'";
                                                    $queryphilhealth2 = mysqli_query($db_conn, $sqlphilhealth2);
                                                    $countphilhealth2 = mysqli_num_rows($queryphilhealth2);
                                                    if($countphilhealth2 > 0) {
                                                        while($rowphilhealth2 = mysqli_fetch_array($queryphilhealth2)) {  
                                                            $philhealthcont2 = $rowphilhealth2["total"];
                                                        }
                                                    }

                                                    $sqltax1 = "SELECT SUM(regular_payslip_tax_cont) AS total FROM hurtajadmin_regular_payslip WHERE employee_id = '$empid' AND regular_payslip_date_cycle_month = '$month' AND regular_payslip_date_cycle_cycle = '1' AND regular_payslip_date_cycle_year = '$year'";
                                                    $querytax1 = mysqli_query($db_conn, $sqltax1);
                                                    $counttax1 = mysqli_num_rows($querytax1);
                                                    if($counttax1 > 0) {
                                                        while($rowtax1 = mysqli_fetch_array($querytax1)) {  
                                                            $taxcont1 = $rowtax1["total"];
                                                        }
                                                    }

                                                    $sqltax2 = "SELECT SUM(regular_payslip_tax_cont) AS total FROM hurtajadmin_regular_payslip WHERE employee_id = '$empid' AND regular_payslip_date_cycle_month = '$month' AND regular_payslip_date_cycle_cycle = '2' AND regular_payslip_date_cycle_year = '$year'";
                                                    $querytax2 = mysqli_query($db_conn, $sqltax2);
                                                    $counttax2 = mysqli_num_rows($querytax2);
                                                    if($counttax2 > 0) {
                                                        while($rowtax2 = mysqli_fetch_array($querytax2)) {  
                                                            $taxcont2 = $rowtax2["total"];
                                                        }
                                                    }

                                                    $ssscontgrandtotal1 = $ssscontgrandtotal1 + $ssscont1;
                                                    $ssscontgrandtotal2 = $ssscontgrandtotal2 + $ssscont2;
                                                    $pagibiggrandtotal1 = $pagibiggrandtotal1 + $pagibigcont1;
                                                    $pagibiggrandtotal2 = $pagibiggrandtotal2 + $pagibigcont2;
                                                    $philhealthgrandtotal1 = $philhealthgrandtotal1 + $philhealthcont1;
                                                    $philhealthgrandtotal2 = $philhealthgrandtotal2 + $philhealthcont2;
                                                    $taxcontgrandtotal1 = $taxcontgrandtotal1 + $taxcont1;
                                                    $taxcontgrandtotal2 = $taxcontgrandtotal2 + $taxcont2;

                                                    $ssseegrandtotal = $ssseegrandtotal + (($ssscont1)+($ssscont2));
                                                    $sssergrandtotal = $sssergrandtotal + ($ssscont1)+($ssscont2)*2;

                                                    $sssecgrandtotal = $sssecgrandtotal + $ec;
                                                    $pagibigemployergrandtotal = $pagibigemployergrandtotal + (($pagibigcont1)+($pagibigcont2));
                                                    $philhealthemployergrandtotal = $philhealthemployergrandtotal + (($philhealthcont1)+($philhealthcont2));
                                                    $sssgrandtotal = $sssgrandtotal + (((($ssscont1)+($ssscont2))*2)+$ec);
                                                    $pagibiggrandtotal = $pagibiggrandtotal + (($pagibigcont1+$pagibigcont2)*2);
                                                    $philhealthgrandtotal = $philhealthgrandtotal + (($philhealthcont1+$philhealthcont2)*2);


                                                    echo '
                                                    <tr>
                                                        <td>'.$fname.' '.$mnameinitial.'. '.$lname.'</td>
                                                        <td style="text-align:center;">'.$monthtext.', '.$year.'</td>
                                                        <td style="text-align:right;">'.number_format($ssscont1, 2, '.', ',').'</td>
                                                        <td style="text-align:right;">'.number_format($ssscont2, 2, '.', ',').'</td>
                                                        <td style="text-align:right;">'.number_format($pagibigcont1, 2, '.', ',').'</td>
                                                        <td style="text-align:right;">'.number_format($pagibigcont2, 2, '.', ',').'</td>
                                                        <td style="text-align:right;">'.number_format($philhealthcont1, 2, '.', ',').'</td>
                                                        <td style="text-align:right;">'.number_format($philhealthcont2, 2, '.', ',').'</td>
                                                        <td style="text-align:right;">'.number_format($taxcont1, 2, '.', ',').'</td>
                                                        <td style="text-align:right;">'.number_format($taxcont2, 2, '.', ',').'</td>
                                                        <td style="text-align:right;">'.number_format(($ssscont1)+($ssscont2), 2, '.', ',').'</td>
                                                        <td style="text-align:right;">'.number_format(($ssscont1)+($ssscont2)*2, 2, '.', ',').'</td>
                                                        <td style="text-align:right;">'.number_format($ec, 2, '.', ',').'</td>
                                                        <td style="text-align:right;">'.number_format(($pagibigcont1)+($pagibigcont2), 2, '.', ',').'</td>
                                                        <td style="text-align:right;">'.number_format(($philhealthcont1)+($philhealthcont2), 2, '.', ',').'</td>
                                                        <td style="text-align:right;">'.number_format(((($ssscont1)+($ssscont2))*2)+$ec, 2, '.', ',').'</td>
                                                        <td style="text-align:right;">'.number_format(($pagibigcont1+$pagibigcont2)*2, 2, '.', ',').'</td>
                                                        <td style="text-align:right;">'.number_format(($philhealthcont1+$philhealthcont2)*2, 2, '.', ',').'</td>
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

