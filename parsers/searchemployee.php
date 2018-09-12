<?php  
include_once("../include/loginstatus.php");

$output = '';
$count = 0; 

$search = $_POST["search"];
$type = $_POST["type"];

if($type == "1") {
  $sql = "SELECT * FROM hurtajadmin_employee WHERE employee_status != '5' AND (employee_fname LIKE '%".$search."%' OR employee_mname LIKE '%".$search."%' OR employee_lname LIKE '%".$search."%') ORDER BY id DESC"; 
  $result = mysqli_query($db_conn, $sql); 
} else if($type == "2") {
  $sql = "SELECT * FROM hurtajadmin_employee WHERE employee_status = '$search' ORDER BY id DESC"; 
  $result = mysqli_query($db_conn, $sql);  
}

if($search == "") {
  $output .= '
  <table class="table table-bordered">
  <thead>
  <tr>
  <th>Employee ID</th>
  <th>Name</th>
  <th>Gender</th>
  <th>Status</th>
  <th>Action</th>
  </tr>
  </thead>
  <tbody>
  ';
  while($row = mysqli_fetch_array($result)) {  
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

    $sqlempid = "SELECT * FROM hurtajadmin_employee_identification WHERE employee_id = '$empid' LIMIT 1";
    $queryempid = mysqli_query($db_conn, $sqlempid);
    while($rowempid = mysqli_fetch_array($queryempid)) {
      $tinid = $rowempid["employee_identification_tin"];
      $pagibigid = $rowempid["employee_identification_pagibig"];
      $philhealthid = $rowempid["employee_identification_philhealth"];
      $sssid = $rowempid["employee_identification_sss"];
    }

    $mnameinitial = substr($mname, 0, 1);

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

    $perhour = 0;
    $tax = "";
    $pagibig = "";
    $sss = "";
    $philhealth = "";
    $insurancecont10 = "";
    $insurance = "";
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
    $xotcount2 = 0;
    $utcount2 = 0;
    $dailycount1 = 0;
    $dailycount2 = 0;
    $disabled = "";
    $previousmonth = date("m", strtotime("-1 months"));
    $currentmonth = date("m");
    $currentyear = date("Y");
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
    }else if($hourdiff < 8){ // this is for undertime
      $utcount1 = $hourdiff;
      $dailycount1 = $hourdiff;
    }else{
      $dailycount1 = $hourdiff;
    }
    $xotcount1 = $xotcount1 + $otcount1;
    $hoursworked1 = $hoursworked1+$dailycount1;
    if($hourdiff > 0){
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
        $holidaybonus = ($holratepercentage / 100) * $hourdiff;
        $hoursworked1 = $hoursworked1+$holidaybonus;
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
        $holidaybonus = ($holratepercentage / 100) * $hourdiff;
        $hoursworked1 = $hoursworked1+$holidaybonus;
      }
    }
  } 
}
$sql02 = "SELECT DISTINCT DATE(attendance_date_in_out), attendance_date_in_out, attendance_value FROM hurtajadmin_attendance WHERE employee_id = '$empid' AND attendance_date_in_out >= '$secondcycledate1' AND attendance_date_in_out < '$secondcycledate2' AND attendance_value = '0' AND attendance_status = '1'";
$query02 = mysqli_query($db_conn, $sql02);
$count02 = mysqli_num_rows($query02);
while($row02 = mysqli_fetch_array($query02)) {
  $datein = $row02["attendance_date_in_out"];
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
    $xotcount2 = $xotcount2 + $otcount2;
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
      $holidaybonus = ($holratepercentage / 100) * $hourdiff;
      $hoursworked2 = $hoursworked2+$holidaybonus;
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
      $holidaybonus = ($holratepercentage / 100) * $hourdiff;
      $hoursworked2 = $hoursworked2+$holidaybonus;
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
    // 160 hours worked from attendance
    // $bimonthsalary = $perhour*$hoursworked;
    $otpay1 = $perhour * $xotcount1; // this is base on per hour not ot per hour
    $otpay2 = $perhour * $xotcount2; // this is base on per hour not ot per hour
    $bimonthsalary1 = $perhour*$hoursworked1+$otpay1;
    $bimonthsalary2 = $perhour*$hoursworked2+$otpay2;
    if($insurancecont10 == '1') {
      $sql10 = "SELECT * FROM hurtajadmin_insurance ";
      $query10 = mysqli_query($db_conn, $sql10);
      $count10 = mysqli_num_rows($query10);
      if($count10 > 0) {
        while($row10 = mysqli_fetch_array($query10)) {  
          $insurance = $row10["insurance_fee"];
          if($insurance == "") {
            $insurance = 0;
          }
        }
      }
    }else if($insurancecont10 == '2') {
      $insurance = 0;
    }
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
    $sql6 = "SELECT * FROM hurtajadmin_cash_loan_advance WHERE cash_loan_advance_date >= '$firstcycledate1' AND cash_loan_advance_date < '$firstcycledate2' AND employee_id = '$empid' AND cash_loan_advance_type = '2'";
    $query6 = mysqli_query($db_conn, $sql6);
    $count6 = mysqli_num_rows($query6);
    if($count6 > 0) {
      while($row6 = mysqli_fetch_array($query6)) {  
        $cashadvancefirstcycle = $cashadvancefirstcycle+$row6["cash_loan_advance_amount"];
      }
    }
    $sql7 = "SELECT * FROM hurtajadmin_cash_loan_advance WHERE cash_loan_advance_date >= '$secondcycledate1' AND cash_loan_advance_date < '$secondcycledate2' AND employee_id = '$empid' AND cash_loan_advance_type = '2'";
    $query7 = mysqli_query($db_conn, $sql7);
    $count7 = mysqli_num_rows($query7);
    if($count7 > 0) {
      while($row7 = mysqli_fetch_array($query7)) {  
        $cashadvancesecondcycle = $cashadvancesecondcycle+$row7["cash_loan_advance_amount"];
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
    $hoursworked = $hoursworked1+$hoursworked2;
    $deductions1 = (float)$taxcont1+(float)$pagibigcont1+(float)$ssscont1+(float)$philhealthcont1+(float)$insurance;
    $deductions2 = (float)$taxcont2+(float)$pagibigcont2+(float)$ssscont2+(float)$philhealthcont2+(float)$insurance;
    $payroll_settings_paycheck_deducted_1 = 0;
    $payroll_settings_paycheck_base_1 = 0;
    $payroll_settings_paycheck_deducted_2 = 0;
    $payroll_settings_paycheck_base_2= 0;
    if($perhour > 0) {
      if($deductions1 > 0 && $cashadvancefirstcycle > 0 && $hoursworked1 > 0) { 
        $payroll_settings_paycheck_deducted_1 = ($perhour*$hoursworked1+$perhour*$xotcount1)-$deductions1-$cashadvancefirstcycle;
        $payroll_settings_paycheck_base_1 = $perhour*$hoursworked1+$perhour*$xotcount1;
      } else if($deductions1 > 0 && $cashadvancefirstcycle < 1 && $hoursworked1 > 0) {
        $payroll_settings_paycheck_deducted_1 = ($perhour*$hoursworked1+$perhour*$xotcount1)-$deductions1;
        $payroll_settings_paycheck_base_1 = $perhour*$hoursworked1+$perhour*$xotcount1;
      } else if($deductions1 < 1 && $cashadvancefirstcycle > 0  && $hoursworked1 > 0) { 
        $payroll_settings_paycheck_deducted_1 = ($perhour*$hoursworked1+$perhour*$xotcount1)-$cashadvancefirstcycle;
        $payroll_settings_paycheck_base_1 = $perhour*$hoursworked1+$perhour*$xotcount1;
      } else if($deductions1 < 1 && $cashadvancefirstcycle < 1  && $hoursworked1 > 0) { 
        $payroll_settings_paycheck_deducted_1 = $perhour*$hoursworked1+$perhour*$xotcount1;
        $payroll_settings_paycheck_base_1 = $perhour*$hoursworked1+$perhour*$xotcount1;
      } else {
        $payroll_settings_paycheck_deducted_1 = "0";
      }
    } else {
      $payroll_settings_paycheck_deducted_1 = "0";
    }
    if($perhour > 0) {
      if($deductions2 > 0 && $cashadvancesecondcycle > 0 && $hoursworked2 > 0) { 
        $payroll_settings_paycheck_deducted_2 = ($perhour*$hoursworked2+$perhour*$xotcount2)-$deductions2-$cashadvancesecondcycle;
        $payroll_settings_paycheck_base_2 = $perhour*$hoursworked2+$perhour*$xotcount2;
      } else if($deductions2 > 0 && $cashadvancesecondcycle < 1 && $hoursworked2 > 0) { 
        $payroll_settings_paycheck_deducted_2 = ($perhour*$hoursworked2+$perhour*$xotcount2)-$deductions2;
        $payroll_settings_paycheck_base_2 = $perhour*$hoursworked2+$perhour*$xotcount2;
      } else if($deductions2 < 1 && $cashadvancesecondcycle > 0 && $hoursworked2 > 0) { 
        $payroll_settings_paycheck_deducted_2 = ($perhour*$hoursworked2+$perhour*$xotcount2)-$cashadvancesecondcycle;
        $payroll_settings_paycheck_base_2 = $perhour*$hoursworked2+$perhour*$xotcount2;
      } else if($deductions2 < 1 && $cashadvancesecondcycle < 1 && $hoursworked2 > 0) { 
        $payroll_settings_paycheck_deducted_2 = $perhour*$hoursworked2+$perhour*$xotcount2;
        $payroll_settings_paycheck_base_2 = $perhour*$hoursworked2+$perhour*$xotcount2;
      } else {
        $payroll_settings_paycheck_deducted_2 = "0";
      }
    } else {
      $payroll_settings_paycheck_deducted_2 = "0";
    }

    $output .= '
    <tr>
    <td>'.$empid.'</td>
    <td>'.$fname.' '.$mnameinitial.'. '.$lname.'</td>           
    <td>'.$gendertext.'</td>
    <td>'.$statstext.'</td>
    <td><a href="javascript:void(0)" onclick="openEmployeeMore(\''.$empid.'\',\''.$fname.' '.$mnameinitial.'. '.$lname.'\',\''.$gendertext.'\',\''.$birthday.'\',\''.$contact.'\',\''.$address.'\',\''.$datehired.'\',\''.$datestart.'\',\''.$dateend.'\',\''.$statstext.'\')">More</a> | <a href="javascript:void(0)"  onclick="openEmployeePayrollSettingsDialog(\''.$empid.'\',\''.$recid.'\',\''.$fname.' '.$mnameinitial.'. '.$lname.'\',\''.$perhour.'\',\''.$tax.'\',\''.$pagibig.'\',\''.$sss.'\',\''.$philhealth.'\',\''.$hoursworked.'\',\''.$payroll_settings_paycheck_deducted_1.'\',\''.$payroll_settings_paycheck_deducted_2.'\')">Payroll Settings</a> | <a href="javascript:void(0)" onclick="openEmployeeEditDialog('.$recid.',\''.$empid.'\',\''.$fname.'\',\''.$mname.'\',\''.$lname.'\',\''.$gender.'\',\''.$birthday.'\',\''.$address.'\',\''.$contact.'\',\''.$datehired.'\',\''.$datestart.'\',\''.$dateend.'\',\''.$stats.'\',\''.$tinid.'\',\''.$pagibigid.'\',\''.$philhealthid.'\',\''.$sssid.'\')">Edit</a> | <a href="javascript:void(0)" onclick="openEmployeeDeleteDialog('.$recid.')">Delete</a></td>
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
    <th>Employee ID</th>
    <th>Name</th>
    <th>Gender</th>
    <th>Status</th>
    <th>Action</th>
    </tr>
    </thead>
    <tbody>
    ';
    while($row = mysqli_fetch_array($result)) {  
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

    $sqlempid = "SELECT * FROM hurtajadmin_employee_identification WHERE employee_id = '$empid' LIMIT 1";
    $queryempid = mysqli_query($db_conn, $sqlempid);
    while($rowempid = mysqli_fetch_array($queryempid)) {
      $tinid = $rowempid["employee_identification_tin"];
      $pagibigid = $rowempid["employee_identification_pagibig"];
      $philhealthid = $rowempid["employee_identification_philhealth"];
      $sssid = $rowempid["employee_identification_sss"];
    }

    $mnameinitial = substr($mname, 0, 1);

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

    $perhour = 0;
    $tax = "";
    $pagibig = "";
    $sss = "";
    $philhealth = "";
    $insurancecont10 = "";
    $insurance = "";
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
    $xotcount2 = 0;
    $utcount2 = 0;
    $dailycount1 = 0;
    $dailycount2 = 0;
    $disabled = "";
    $previousmonth = date("m", strtotime("-1 months"));
    $currentmonth = date("m");
    $currentyear = date("Y");
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
    }else if($hourdiff < 8){ // this is for undertime
      $utcount1 = $hourdiff;
      $dailycount1 = $hourdiff;
    }else{
      $dailycount1 = $hourdiff;
    }
    $xotcount1 = $xotcount1 + $otcount1;
    $hoursworked1 = $hoursworked1+$dailycount1;
    if($hourdiff > 0){
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
        $holidaybonus = ($holratepercentage / 100) * $hourdiff;
        $hoursworked1 = $hoursworked1+$holidaybonus;
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
        $holidaybonus = ($holratepercentage / 100) * $hourdiff;
        $hoursworked1 = $hoursworked1+$holidaybonus;
      }
    }
  } 
}
$sql02 = "SELECT DISTINCT DATE(attendance_date_in_out), attendance_date_in_out, attendance_value FROM hurtajadmin_attendance WHERE employee_id = '$empid' AND attendance_date_in_out >= '$secondcycledate1' AND attendance_date_in_out < '$secondcycledate2' AND attendance_value = '0' AND attendance_status = '1'";
$query02 = mysqli_query($db_conn, $sql02);
$count02 = mysqli_num_rows($query02);
while($row02 = mysqli_fetch_array($query02)) {
  $datein = $row02["attendance_date_in_out"];
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
    $xotcount2 = $xotcount2 + $otcount2;
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
      $holidaybonus = ($holratepercentage / 100) * $hourdiff;
      $hoursworked2 = $hoursworked2+$holidaybonus;
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
      $holidaybonus = ($holratepercentage / 100) * $hourdiff;
      $hoursworked2 = $hoursworked2+$holidaybonus;
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
    // 160 hours worked from attendance
    // $bimonthsalary = $perhour*$hoursworked;
    $otpay1 = $perhour * $xotcount1; // this is base on per hour not ot per hour
    $otpay2 = $perhour * $xotcount2; // this is base on per hour not ot per hour
    $bimonthsalary1 = $perhour*$hoursworked1+$otpay1;
    $bimonthsalary2 = $perhour*$hoursworked2+$otpay2;
    if($insurancecont10 == '1') {
      $sql10 = "SELECT * FROM hurtajadmin_insurance ";
      $query10 = mysqli_query($db_conn, $sql10);
      $count10 = mysqli_num_rows($query10);
      if($count10 > 0) {
        while($row10 = mysqli_fetch_array($query10)) {  
          $insurance = $row10["insurance_fee"];
          if($insurance == "") {
            $insurance = 0;
          }
        }
      }
    }else if($insurancecont10 == '2') {
      $insurance = 0;
    }
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
    $sql6 = "SELECT * FROM hurtajadmin_cash_loan_advance WHERE cash_loan_advance_date >= '$firstcycledate1' AND cash_loan_advance_date < '$firstcycledate2' AND employee_id = '$empid' AND cash_loan_advance_type = '2'";
    $query6 = mysqli_query($db_conn, $sql6);
    $count6 = mysqli_num_rows($query6);
    if($count6 > 0) {
      while($row6 = mysqli_fetch_array($query6)) {  
        $cashadvancefirstcycle = $cashadvancefirstcycle+$row6["cash_loan_advance_amount"];
      }
    }
    $sql7 = "SELECT * FROM hurtajadmin_cash_loan_advance WHERE cash_loan_advance_date >= '$secondcycledate1' AND cash_loan_advance_date < '$secondcycledate2' AND employee_id = '$empid' AND cash_loan_advance_type = '2'";
    $query7 = mysqli_query($db_conn, $sql7);
    $count7 = mysqli_num_rows($query7);
    if($count7 > 0) {
      while($row7 = mysqli_fetch_array($query7)) {  
        $cashadvancesecondcycle = $cashadvancesecondcycle+$row7["cash_loan_advance_amount"];
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
    $hoursworked = $hoursworked1+$hoursworked2;
    $deductions1 = (float)$taxcont1+(float)$pagibigcont1+(float)$ssscont1+(float)$philhealthcont1+(float)$insurance;
    $deductions2 = (float)$taxcont2+(float)$pagibigcont2+(float)$ssscont2+(float)$philhealthcont2+(float)$insurance;
    $payroll_settings_paycheck_deducted_1 = 0;
    $payroll_settings_paycheck_base_1 = 0;
    $payroll_settings_paycheck_deducted_2 = 0;
    $payroll_settings_paycheck_base_2= 0;
    if($perhour > 0) {
      if($deductions1 > 0 && $cashadvancefirstcycle > 0 && $hoursworked1 > 0) { 
        $payroll_settings_paycheck_deducted_1 = ($perhour*$hoursworked1+$perhour*$xotcount1)-$deductions1-$cashadvancefirstcycle;
        $payroll_settings_paycheck_base_1 = $perhour*$hoursworked1+$perhour*$xotcount1;
      } else if($deductions1 > 0 && $cashadvancefirstcycle < 1 && $hoursworked1 > 0) {
        $payroll_settings_paycheck_deducted_1 = ($perhour*$hoursworked1+$perhour*$xotcount1)-$deductions1;
        $payroll_settings_paycheck_base_1 = $perhour*$hoursworked1+$perhour*$xotcount1;
      } else if($deductions1 < 1 && $cashadvancefirstcycle > 0  && $hoursworked1 > 0) { 
        $payroll_settings_paycheck_deducted_1 = ($perhour*$hoursworked1+$perhour*$xotcount1)-$cashadvancefirstcycle;
        $payroll_settings_paycheck_base_1 = $perhour*$hoursworked1+$perhour*$xotcount1;
      } else if($deductions1 < 1 && $cashadvancefirstcycle < 1  && $hoursworked1 > 0) { 
        $payroll_settings_paycheck_deducted_1 = $perhour*$hoursworked1+$perhour*$xotcount1;
        $payroll_settings_paycheck_base_1 = $perhour*$hoursworked1+$perhour*$xotcount1;
      } else {
        $payroll_settings_paycheck_deducted_1 = "0";
      }
    } else {
      $payroll_settings_paycheck_deducted_1 = "0";
    }
    if($perhour > 0) {
      if($deductions2 > 0 && $cashadvancesecondcycle > 0 && $hoursworked2 > 0) { 
        $payroll_settings_paycheck_deducted_2 = ($perhour*$hoursworked2+$perhour*$xotcount2)-$deductions2-$cashadvancesecondcycle;
        $payroll_settings_paycheck_base_2 = $perhour*$hoursworked2+$perhour*$xotcount2;
      } else if($deductions2 > 0 && $cashadvancesecondcycle < 1 && $hoursworked2 > 0) { 
        $payroll_settings_paycheck_deducted_2 = ($perhour*$hoursworked2+$perhour*$xotcount2)-$deductions2;
        $payroll_settings_paycheck_base_2 = $perhour*$hoursworked2+$perhour*$xotcount2;
      } else if($deductions2 < 1 && $cashadvancesecondcycle > 0 && $hoursworked2 > 0) { 
        $payroll_settings_paycheck_deducted_2 = ($perhour*$hoursworked2+$perhour*$xotcount2)-$cashadvancesecondcycle;
        $payroll_settings_paycheck_base_2 = $perhour*$hoursworked2+$perhour*$xotcount2;
      } else if($deductions2 < 1 && $cashadvancesecondcycle < 1 && $hoursworked2 > 0) { 
        $payroll_settings_paycheck_deducted_2 = $perhour*$hoursworked2+$perhour*$xotcount2;
        $payroll_settings_paycheck_base_2 = $perhour*$hoursworked2+$perhour*$xotcount2;
      } else {
        $payroll_settings_paycheck_deducted_2 = "0";
      }
    } else {
      $payroll_settings_paycheck_deducted_2 = "0";
    }

    $output .= '
    <tr>
    <td>'.$empid.'</td>
    <td>'.$fname.' '.$mnameinitial.'. '.$lname.'</td>           
    <td>'.$gendertext.'</td>
    <td>'.$statstext.'</td>
    <td><a href="javascript:void(0)" onclick="openEmployeeMore(\''.$empid.'\',\''.$fname.' '.$mnameinitial.'. '.$lname.'\',\''.$gendertext.'\',\''.$birthday.'\',\''.$contact.'\',\''.$address.'\',\''.$datehired.'\',\''.$datestart.'\',\''.$dateend.'\',\''.$statstext.'\')">More</a> | <a href="javascript:void(0)"  onclick="openEmployeePayrollSettingsDialog(\''.$empid.'\',\''.$recid.'\',\''.$fname.' '.$mnameinitial.'. '.$lname.'\',\''.$perhour.'\',\''.$tax.'\',\''.$pagibig.'\',\''.$sss.'\',\''.$philhealth.'\',\''.$hoursworked.'\',\''.$payroll_settings_paycheck_deducted_1.'\',\''.$payroll_settings_paycheck_deducted_2.'\')">Payroll Settings</a> | <a href="javascript:void(0)" onclick="openEmployeeEditDialog('.$recid.',\''.$empid.'\',\''.$fname.'\',\''.$mname.'\',\''.$lname.'\',\''.$gender.'\',\''.$birthday.'\',\''.$address.'\',\''.$contact.'\',\''.$datehired.'\',\''.$datestart.'\',\''.$dateend.'\',\''.$stats.'\',\''.$tinid.'\',\''.$pagibigid.'\',\''.$philhealthid.'\',\''.$sssid.'\')">Edit</a> | <a href="javascript:void(0)" onclick="openEmployeeDeleteDialog('.$recid.')">Delete</a></td>
    ';   

  }
  $output .= '
  </tbody>
  </table>
  ';
  echo $output;
} else {  
  $nodata = "";
  if($type == "2") {
    if($search == "1") {
      $nodata = "Active";
    } else if($search == "2") {
      $nodata = "Resigned";
    } else if($search == "3") {
      $nodata = "Terminated";
    } else if($search == "4") {
      $nodata = "AWOL";
    }
    echo '<h4 align="center">No results for <b>'.$nodata.'</b></h4>'; 
  } else {
    echo '<h4 align="center">No results for <b>'.$search.'</b></h4>'; 
  }
} 
}

?>  
