<?php
include_once "include/loginstatus.php";
require_once 'library/PHPExcel/Classes/PHPExcel.php';
$excel = new PHPExcel();

//VARIABLES

$month = $_GET["month"];
$cycle = $_GET["cycle"];
$year = $_GET["year"];
$monthtext = "";
$prevmonthtext = "";
$daytext1 = "";
$daytext2 = "";
$prevmonth = "";
$prevyear = "";

if ($cycle == "1") {
    $period = "15";
    $daytext1 = "26";
    $daytext2 = "10";
    if ($month == "1") {
        $prevmonth = "12";
        $prevyear = $year - 1;
        $prevyear = ", " . $prevyear;
    } else {
        $prevmonth = $month - 1;
    }
} else if ($cycle == "2") {
    $period = "30";
    $daytext1 = "11";
    $daytext2 = "25";
    $prevmonth = $month;
}
if ($month == "1") {
    $monthtext = "Jan";
} else if ($month == "2") {
    $monthtext = "Feb";
} else if ($month == "3") {
    $monthtext = "Mar";
} else if ($month == "4") {
    $monthtext = "Apr";
} else if ($month == "5") {
    $monthtext = "May";
} else if ($month == "6") {
    $monthtext = "Jun";
} else if ($month == "7") {
    $monthtext = "Jul";
} else if ($month == "8") {
    $monthtext = "Aug";
} else if ($month == "9") {
    $monthtext = "Sep";
} else if ($month == "10") {
    $monthtext = "Oct";
} else if ($month == "11") {
    $monthtext = "Nov";
} else if ($month == "12") {
    $monthtext = "Dec";
}
if ($prevmonth == "1") {
    $prevmonthtext = "Jan";
} else if ($prevmonth == "2") {
    $prevmonthtext = "Feb";
} else if ($prevmonth == "3") {
    $prevmonthtext = "Mar";
} else if ($prevmonth == "4") {
    $prevmonthtext = "Apr";
} else if ($prevmonth == "5") {
    $prevmonthtext = "May";
} else if ($prevmonth == "6") {
    $prevmonthtext = "Jun";
} else if ($prevmonth == "7") {
    $prevmonthtext = "Jul";
} else if ($prevmonth == "8") {
    $prevmonthtext = "Aug";
} else if ($prevmonth == "9") {
    $prevmonthtext = "Sep";
} else if ($prevmonth == "10") {
    $prevmonthtext = "Oct";
} else if ($prevmonth == "11") {
    $prevmonthtext = "Nov";
} else if ($prevmonth == "12") {
    $prevmonthtext = "Dec";
}

//SHEET NAME

$excel->setActiveSheetIndex(0)
    ->setTitle('PAYROLL SUMMARY');

//STYLE

$tableHeaderStyleFontBlackCalibri = array(
    'font' => array(
        'bold' => false,
        'color' => array('rgb' => '000000'),
        'size' => 10,
        'name' => 'Calibri',
    ));

$tableHeaderStyleFontBlackBoldCalibriItalic = array(
    'font' => array(
        'bold' => true,
        'italic' => true,
        'color' => array('rgb' => '000000'),
        'size' => 10,
        'name' => 'Calibri',
    ));

$tableHeaderStyleFontBlackBoldCalibri = array(
    'font' => array(
        'bold' => true,
        'color' => array('rgb' => '000000'),
        'size' => 11,
        'name' => 'Calibri',
    ));

$centerText = array(
    'alignment' => array(
        'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
    ),
);

$borderMedium = array(
    'borders' => array(
        'allborders' => array(
            'style' => PHPExcel_Style_Border::BORDER_MEDIUM,
        ),
    ),
);

$borderThin = array(
    'borders' => array(
        'allborders' => array(
            'style' => PHPExcel_Style_Border::BORDER_THIN,
        ),
    ),
);

//TABLE HEADER

$excel->setActiveSheetIndex(0)
    ->setCellValue('A1', 'NO.')
    ->getStyle('A1')
    ->applyFromArray($tableHeaderStyleFontBlackBoldCalibri);

$excel->setActiveSheetIndex(0)
    ->getStyle('A1')
    ->applyFromArray($centerText);

$excel->setActiveSheetIndex(0)
    ->getStyle('A1')
    ->applyFromArray($borderMedium);

$excel->setActiveSheetIndex(0)
    ->setCellValue('B1', 'EMPLOYEE')
    ->getStyle('B1')
    ->applyFromArray($tableHeaderStyleFontBlackBoldCalibri);

$excel->setActiveSheetIndex(0)
    ->getStyle('B1')
    ->applyFromArray($centerText);

$excel->setActiveSheetIndex(0)
    ->getStyle('B1')
    ->applyFromArray($borderMedium);

$excel->setActiveSheetIndex(0)
    ->setCellValue('C1', 'PAY PERIOD')
    ->getStyle('C1')
    ->applyFromArray($tableHeaderStyleFontBlackBoldCalibri);

$excel->setActiveSheetIndex(0)
    ->getStyle('C1')
    ->applyFromArray($centerText);

$excel->setActiveSheetIndex(0)
    ->getStyle('C1')
    ->applyFromArray($borderMedium);

$excel->setActiveSheetIndex(0)
    ->setCellValue('D1', 'DAYS OF' . PHP_EOL . 'WORK')
    ->getStyle('D1')
    ->applyFromArray($tableHeaderStyleFontBlackBoldCalibri);

$excel->setActiveSheetIndex(0)
    ->getStyle('D1')
    ->getAlignment()
    ->setWrapText(true);

$excel->setActiveSheetIndex(0)
    ->getStyle('D1')
    ->applyFromArray($centerText);

$excel->setActiveSheetIndex(0)
    ->getStyle('D1')
    ->applyFromArray($borderMedium);

$excel->setActiveSheetIndex(0)
    ->setCellValue('E1', 'DAYS' . PHP_EOL . 'PRESENT')
    ->getStyle('E1')
    ->applyFromArray($tableHeaderStyleFontBlackBoldCalibri);

$excel->setActiveSheetIndex(0)
    ->getStyle('E1')
    ->getAlignment()
    ->setWrapText(true);

$excel->setActiveSheetIndex(0)
    ->getStyle('E1')
    ->applyFromArray($centerText);

$excel->setActiveSheetIndex(0)
    ->getStyle('E1')
    ->applyFromArray($borderMedium);

$excel->setActiveSheetIndex(0)
    ->setCellValue('F1', "OVER" . PHP_EOL . "TIME")
    ->getStyle('F1')
    ->applyFromArray($tableHeaderStyleFontBlackBoldCalibri);

$excel->setActiveSheetIndex(0)
    ->getStyle('F1')
    ->getAlignment()
    ->setWrapText(true);

$excel->setActiveSheetIndex(0)
    ->getStyle('F1')
    ->applyFromArray($centerText);

$excel->setActiveSheetIndex(0)
    ->getStyle('F1')
    ->applyFromArray($borderMedium);

$excel->setActiveSheetIndex(0)
    ->getStyle('F1')
    ->getAlignment()
    ->setWrapText(true);

$excel->setActiveSheetIndex(0)
    ->setCellValue('G1', "SSS")
    ->getStyle('G1')
    ->applyFromArray($tableHeaderStyleFontBlackBoldCalibri);

$excel->setActiveSheetIndex(0)
    ->getStyle('G1')
    ->applyFromArray($centerText);

$excel->setActiveSheetIndex(0)
    ->getStyle('G1')
    ->applyFromArray($borderMedium);

$excel->setActiveSheetIndex(0)
    ->getStyle('G1')
    ->getAlignment()
    ->setWrapText(true);

$excel->setActiveSheetIndex(0)
    ->setCellValue('H1', "SSS" . PHP_EOL . "LOAN")
    ->getStyle('H1')
    ->applyFromArray($tableHeaderStyleFontBlackBoldCalibri);

$excel->setActiveSheetIndex(0)
    ->getStyle('H1')
    ->getAlignment()
    ->setWrapText(true);

$excel->setActiveSheetIndex(0)
    ->getStyle('H1')
    ->applyFromArray($centerText);

$excel->setActiveSheetIndex(0)
    ->getStyle('H1')
    ->applyFromArray($borderMedium);

$excel->setActiveSheetIndex(0)
    ->getStyle('H1')
    ->getAlignment()
    ->setWrapText(true);

$excel->setActiveSheetIndex(0)
    ->setCellValue('I1', "PAG-IBIG")
    ->getStyle('I1')
    ->applyFromArray($tableHeaderStyleFontBlackBoldCalibri);

$excel->setActiveSheetIndex(0)
    ->getStyle('I1')
    ->applyFromArray($centerText);

$excel->setActiveSheetIndex(0)
    ->getStyle('I1')
    ->applyFromArray($borderMedium);

$excel->setActiveSheetIndex(0)
    ->getStyle('I1')
    ->getAlignment()
    ->setWrapText(true);

$excel->setActiveSheetIndex(0)
    ->setCellValue('J1', 'PAG-IBIG' . PHP_EOL . 'LOAN')
    ->getStyle('J1')
    ->applyFromArray($tableHeaderStyleFontBlackBoldCalibri);

$excel->setActiveSheetIndex(0)
    ->getStyle('J1')
    ->getAlignment()
    ->setWrapText(true);

$excel->setActiveSheetIndex(0)
    ->getStyle('J1')
    ->applyFromArray($centerText);

$excel->setActiveSheetIndex(0)
    ->getStyle('J1')
    ->applyFromArray($borderMedium);

$excel->setActiveSheetIndex(0)
    ->setCellValue('K1', 'PHIL' . PHP_EOL . 'HEALTH')
    ->getStyle('K1')
    ->applyFromArray($tableHeaderStyleFontBlackBoldCalibri);

$excel->setActiveSheetIndex(0)
    ->getStyle('K1')
    ->getAlignment()
    ->setWrapText(true);

$excel->setActiveSheetIndex(0)
    ->getStyle('K1')
    ->applyFromArray($centerText);

$excel->setActiveSheetIndex(0)
    ->getStyle('K1')
    ->applyFromArray($borderMedium);

$excel->setActiveSheetIndex(0)
    ->setCellValue('L1', 'TAX')
    ->getStyle('L1')
    ->applyFromArray($tableHeaderStyleFontBlackBoldCalibri);

$excel->setActiveSheetIndex(0)
    ->getStyle('L1')
    ->applyFromArray($centerText);

$excel->setActiveSheetIndex(0)
    ->getStyle('L1')
    ->applyFromArray($borderMedium);

$excel->setActiveSheetIndex(0)
    ->setCellValue('M1', 'LESS' . PHP_EOL . 'LATES')
    ->getStyle('M1')
    ->applyFromArray($tableHeaderStyleFontBlackBoldCalibri);

$excel->setActiveSheetIndex(0)
    ->getStyle('M1')
    ->getAlignment()
    ->setWrapText(true);

$excel->setActiveSheetIndex(0)
    ->getStyle('M1')
    ->applyFromArray($centerText);

$excel->setActiveSheetIndex(0)
    ->getStyle('M1')
    ->applyFromArray($borderMedium);

$excel->setActiveSheetIndex(0)
    ->setCellValue('N1', 'CASH' . PHP_EOL . 'LOAN')
    ->getStyle('N1')
    ->applyFromArray($tableHeaderStyleFontBlackBoldCalibri);

$excel->setActiveSheetIndex(0)
    ->getStyle('N1')
    ->getAlignment()
    ->setWrapText(true);

$excel->setActiveSheetIndex(0)
    ->getStyle('N1')
    ->applyFromArray($centerText);

$excel->setActiveSheetIndex(0)
    ->getStyle('N1')
    ->applyFromArray($borderMedium);

$excel->setActiveSheetIndex(0)
    ->setCellValue('O1', 'CASH' . PHP_EOL . 'ADVANCE')
    ->getStyle('O1')
    ->applyFromArray($tableHeaderStyleFontBlackBoldCalibri);

$excel->setActiveSheetIndex(0)
    ->getStyle('O1')
    ->getAlignment()
    ->setWrapText(true);

$excel->setActiveSheetIndex(0)
    ->getStyle('O1')
    ->applyFromArray($centerText);

$excel->setActiveSheetIndex(0)
    ->getStyle('O1')
    ->applyFromArray($borderMedium);

$excel->setActiveSheetIndex(0)
    ->setCellValue('P1', 'SUNDAY')
    ->getStyle('P1')
    ->applyFromArray($tableHeaderStyleFontBlackBoldCalibri);

$excel->setActiveSheetIndex(0)
    ->getStyle('P1')
    ->applyFromArray($centerText);

$excel->setActiveSheetIndex(0)
    ->getStyle('P1')
    ->applyFromArray($borderMedium);

$excel->setActiveSheetIndex(0)
    ->setCellValue('Q1', 'RATE/HOUR')
    ->getStyle('Q1')
    ->applyFromArray($tableHeaderStyleFontBlackBoldCalibri);

$excel->setActiveSheetIndex(0)
    ->getStyle('Q1')
    ->applyFromArray($centerText);

$excel->setActiveSheetIndex(0)
    ->getStyle('Q1')
    ->applyFromArray($borderMedium);

$excel->setActiveSheetIndex(0)
    ->setCellValue('R1', 'PAYROLL PERIOD')
    ->getStyle('R1')
    ->applyFromArray($tableHeaderStyleFontBlackBoldCalibri);

$excel->setActiveSheetIndex(0)
    ->getStyle('R1')
    ->applyFromArray($centerText);

$excel->setActiveSheetIndex(0)
    ->getStyle('R1')
    ->applyFromArray($borderMedium);

$excel->setActiveSheetIndex(0)
    ->setCellValue('S1', 'RATE/DAY')
    ->getStyle('S1')
    ->applyFromArray($tableHeaderStyleFontBlackBoldCalibri);

$excel->setActiveSheetIndex(0)
    ->getStyle('S1')
    ->applyFromArray($centerText);

$excel->setActiveSheetIndex(0)
    ->getStyle('S1')
    ->applyFromArray($borderMedium);

$excel->setActiveSheetIndex(0)
    ->setCellValue('T1', 'HOLIDAY')
    ->getStyle('T1')
    ->applyFromArray($tableHeaderStyleFontBlackBoldCalibri);

$excel->setActiveSheetIndex(0)
    ->getStyle('T1')
    ->applyFromArray($centerText);

$excel->setActiveSheetIndex(0)
    ->getStyle('T1')
    ->applyFromArray($borderMedium);

$excel->setActiveSheetIndex(0)
    ->setCellValue('U1', 'SPECIAL NON-' . PHP_EOL . 'WORKING')
    ->getStyle('U1')
    ->applyFromArray($tableHeaderStyleFontBlackBoldCalibri);

$excel->setActiveSheetIndex(0)
    ->getStyle('U1')
    ->getAlignment()
    ->setWrapText(true);

$excel->setActiveSheetIndex(0)
    ->getStyle('U1')
    ->applyFromArray($centerText);

$excel->setActiveSheetIndex(0)
    ->getStyle('U1')
    ->applyFromArray($borderMedium);

$excel->setActiveSheetIndex(0)
    ->setCellValue('V1', 'DAILY')
    ->getStyle('V1')
    ->applyFromArray($tableHeaderStyleFontBlackBoldCalibri);

$excel->setActiveSheetIndex(0)
    ->getStyle('V1')
    ->applyFromArray($centerText);

$excel->setActiveSheetIndex(0)
    ->getStyle('V1')
    ->applyFromArray($borderMedium);

$excel->setActiveSheetIndex(0)
    ->setCellValue('W1', 'OVERTIME' . PHP_EOL . 'PAY')
    ->getStyle('W1')
    ->applyFromArray($tableHeaderStyleFontBlackBoldCalibri);

$excel->setActiveSheetIndex(0)
    ->getStyle('W1')
    ->getAlignment()
    ->setWrapText(true);

$excel->setActiveSheetIndex(0)
    ->getStyle('W1')
    ->applyFromArray($centerText);

$excel->setActiveSheetIndex(0)
    ->getStyle('W1')
    ->applyFromArray($borderMedium);

$excel->setActiveSheetIndex(0)
    ->setCellValue('X1', 'SUNDAY')
    ->getStyle('X1')
    ->applyFromArray($tableHeaderStyleFontBlackBoldCalibri);

$excel->setActiveSheetIndex(0)
    ->getStyle('X1')
    ->applyFromArray($centerText);

$excel->setActiveSheetIndex(0)
    ->getStyle('X1')
    ->applyFromArray($borderMedium);

$excel->setActiveSheetIndex(0)
    ->setCellValue('Y1', 'HOLIDAY')
    ->getStyle('Y1')
    ->applyFromArray($tableHeaderStyleFontBlackBoldCalibri);

$excel->setActiveSheetIndex(0)
    ->getStyle('Y1')
    ->applyFromArray($centerText);

$excel->setActiveSheetIndex(0)
    ->getStyle('Y1')
    ->applyFromArray($borderMedium);

$excel->setActiveSheetIndex(0)
    ->setCellValue('Z1', 'SPECIAL NON-' . PHP_EOL . 'WORKING')
    ->getStyle('Z1')
    ->applyFromArray($tableHeaderStyleFontBlackBoldCalibri);

$excel->setActiveSheetIndex(0)
    ->getStyle('Z1')
    ->getAlignment()
    ->setWrapText(true);

$excel->setActiveSheetIndex(0)
    ->getStyle('Z1')
    ->applyFromArray($centerText);

$excel->setActiveSheetIndex(0)
    ->getStyle('Z1')
    ->applyFromArray($borderMedium);

$excel->setActiveSheetIndex(0)
    ->setCellValue('AA1', 'GROSS')
    ->getStyle('AA1')
    ->applyFromArray($tableHeaderStyleFontBlackBoldCalibri);

$excel->setActiveSheetIndex(0)
    ->getStyle('AA1')
    ->applyFromArray($centerText);

$excel->setActiveSheetIndex(0)
    ->getStyle('AA1')
    ->applyFromArray($borderMedium);

$excel->setActiveSheetIndex(0)
    ->setCellValue('AB1', 'TOTAL' . PHP_EOL . 'DEDUCTION')
    ->getStyle('AB1')
    ->applyFromArray($tableHeaderStyleFontBlackBoldCalibri);

$excel->setActiveSheetIndex(0)
    ->getStyle('AB1')
    ->getAlignment()
    ->setWrapText(true);

$excel->setActiveSheetIndex(0)
    ->getStyle('AB1')
    ->applyFromArray($centerText);

$excel->setActiveSheetIndex(0)
    ->getStyle('AB1')
    ->applyFromArray($borderMedium);

$excel->setActiveSheetIndex(0)
    ->setCellValue('AC1', 'NET')
    ->getStyle('AC1')
    ->applyFromArray($tableHeaderStyleFontBlackBoldCalibri);

$excel->setActiveSheetIndex(0)
    ->getStyle('AC1')
    ->applyFromArray($centerText);

$excel->setActiveSheetIndex(0)
    ->getStyle('AC1')
    ->applyFromArray($borderMedium);

$excel->setActiveSheetIndex(0)->getColumnDimension('A')->setWidth(5);
$excel->setActiveSheetIndex(0)->getColumnDimension('B')->setWidth(30);
$excel->setActiveSheetIndex(0)->getColumnDimension('C')->setWidth(35);
$excel->setActiveSheetIndex(0)->getColumnDimension('D')->setWidth(11);
$excel->setActiveSheetIndex(0)->getColumnDimension('E')->setWidth(12);
$excel->setActiveSheetIndex(0)->getColumnDimension('F')->setWidth(12);
$excel->setActiveSheetIndex(0)->getColumnDimension('G')->setWidth(12);
$excel->setActiveSheetIndex(0)->getColumnDimension('H')->setWidth(12);
$excel->setActiveSheetIndex(0)->getColumnDimension('I')->setWidth(13);
$excel->setActiveSheetIndex(0)->getColumnDimension('J')->setWidth(13);
$excel->setActiveSheetIndex(0)->getColumnDimension('K')->setWidth(13);
$excel->setActiveSheetIndex(0)->getColumnDimension('L')->setWidth(13);
$excel->setActiveSheetIndex(0)->getColumnDimension('M')->setWidth(12);
$excel->setActiveSheetIndex(0)->getColumnDimension('N')->setWidth(13);
$excel->setActiveSheetIndex(0)->getColumnDimension('O')->setWidth(14);
$excel->setActiveSheetIndex(0)->getColumnDimension('P')->setWidth(13);
$excel->setActiveSheetIndex(0)->getColumnDimension('Q')->setWidth(15);
$excel->setActiveSheetIndex(0)->getColumnDimension('R')->setWidth(20);
$excel->setActiveSheetIndex(0)->getColumnDimension('S')->setWidth(15);
$excel->setActiveSheetIndex(0)->getColumnDimension('T')->setWidth(15);
$excel->setActiveSheetIndex(0)->getColumnDimension('U')->setWidth(15);
$excel->setActiveSheetIndex(0)->getColumnDimension('V')->setWidth(15);
$excel->setActiveSheetIndex(0)->getColumnDimension('W')->setWidth(15);
$excel->setActiveSheetIndex(0)->getColumnDimension('X')->setWidth(15);
$excel->setActiveSheetIndex(0)->getColumnDimension('Y')->setWidth(15);
$excel->setActiveSheetIndex(0)->getColumnDimension('Z')->setWidth(15);
$excel->setActiveSheetIndex(0)->getColumnDimension('AA')->setWidth(15);
$excel->setActiveSheetIndex(0)->getColumnDimension('AB')->setWidth(15);
$excel->setActiveSheetIndex(0)->getColumnDimension('AC')->setWidth(15);

$excel->setActiveSheetIndex(0)->getRowDimension('1')->setRowHeight(-1);

$countStart = 1;
$count = 0;

$sql = "SELECT * FROM hurtajadmin_employee ORDER BY id DESC";
$query = mysqli_query($db_conn, $sql);
$count = 0;
$sssgrandtotal = 0;
$pagibiggrandtotal = 0;
$philhealthgrandtotal = 0;
$taxgrandtotal = 0;
$cashloangrandtotal = 0;
$cashloansssgrandtotal = 0;
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
$cashloansss = 0;
$lesslate = 0;
$snonworkingholiday = 0;
$holiday = 0;
$sunday = 0;
$sundayhours = 0;
$perhour = 0;
while ($row = mysqli_fetch_array($query)) {
    $countStart++;
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

    while ($rowregrularpayslip = mysqli_fetch_array($queryregrularpayslip)) {
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
        $cashloansss = $rowregrularpayslip["regular_payslip_cash_loan_sss"];
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

    while ($rowsettings = mysqli_fetch_array($querysettings)) {
        $perhour = $rowsettings["employee_settings_perhour"];
    }

    $lmnameinitial = substr($mname, 0, 1);
    $fullname = $fname . ' ' . $lmnameinitial . '. ' . $lname;

    $out1 = strlen($fullname) > 15 ? substr($fullname, 0, 15) . "..." : $fullname;
    $out2 = strlen($fullname) > 24 ? substr($fullname, 0, 24) . "..." : $fullname;

    $sssgrandtotal = $sssgrandtotal + $ssscont;
    $pagibiggrandtotal = $pagibiggrandtotal + $pagibigcont;
    $philhealthgrandtotal = $philhealthgrandtotal + $philhealthcont;
    $taxgrandtotal = $taxgrandtotal + $taxcont;
    $cashloangrandtotal = $cashloangrandtotal + $cashloan;
    $cashadvancegrandtotal = $cashadvancegrandtotal + $cashadvance;
    $cashloansssgrandtotal = $cashloansssgrandtotal + $cashloansss;
    $dailygrandtotal = $dailygrandtotal + ($basicpay - ($sunday + $holiday + $snonworkingholiday));
    $overtimegrandtotal = $overtimegrandtotal + $overtimepay;
    $sundaygrandtotal = $sundaygrandtotal + $sunday;
    $holidaygrandtotal = $holidaygrandtotal + $holiday;
    $snholidaygrandtotal = $snholidaygrandtotal + $snonworkingholiday;
    $grossgrandtotal = $grossgrandtotal + $basicpay + $overtimepay;
    $deductionsgrandtotal = $deductionsgrandtotal + ($ssscont + $philhealthcont + $pagibigcont + $taxcont + $cashadvance + $cashloan + $cashloansss + $lesslate);
    $netgrandtotal = $netgrandtotal + ($basicpay + $overtimepay - ($ssscont + $philhealthcont + $pagibigcont + $taxcont + $cashadvance + $cashloan + $cashloansss + $lesslate));

    $excel->setActiveSheetIndex(0)
        ->setCellValue('A' . $countStart, $count)
        ->getStyle('A' . $countStart)
        ->applyFromArray($tableHeaderStyleFontBlackCalibri);

    $excel->setActiveSheetIndex(0)
        ->getStyle('A' . $countStart)
        ->applyFromArray($centerText);

    $excel->setActiveSheetIndex(0)
        ->getStyle('A' . $countStart)
        ->applyFromArray($borderThin);

    $excel->setActiveSheetIndex(0)
        ->setCellValue('B' . $countStart, strtoupper($lname).' '.strtoupper($fname).' '.strtoupper($lmnameinitial))
        ->getStyle('B' . $countStart)
        ->applyFromArray($tableHeaderStyleFontBlackCalibri);

    $excel->setActiveSheetIndex(0)
        ->getStyle('B' . $countStart)
        ->applyFromArray($centerText);

    $excel->setActiveSheetIndex(0)
        ->getStyle('B' . $countStart)
        ->applyFromArray($borderThin);

    $excel->setActiveSheetIndex(0)
        ->setCellValue('C' . $countStart, strtoupper($prevmonthtext).'. '.$daytext1.''.$prevyear.' - '.strtoupper($monthtext).'. '.$daytext2.', '.$year)
        ->getStyle('C' . $countStart)
        ->applyFromArray($tableHeaderStyleFontBlackCalibri);

    $excel->setActiveSheetIndex(0)
        ->getStyle('C' . $countStart)
        ->applyFromArray($centerText);

    $excel->setActiveSheetIndex(0)
        ->getStyle('C' . $countStart)
        ->applyFromArray($borderThin);

    $excel->setActiveSheetIndex(0)
        ->setCellValue('D' . $countStart, number_format($daysofwork, 2, '.', ','))
        ->getStyle('D' . $countStart)
        ->applyFromArray($tableHeaderStyleFontBlackCalibri);

    $excel->setActiveSheetIndex(0)
        ->getStyle('D' . $countStart)
        ->applyFromArray($centerText);

    $excel->setActiveSheetIndex(0)
        ->getStyle('D' . $countStart)
        ->applyFromArray($borderThin);

    $excel->setActiveSheetIndex(0)
        ->setCellValue('E' . $countStart, number_format($dayspresent, 2, '.', ','))
        ->getStyle('E' . $countStart)
        ->applyFromArray($tableHeaderStyleFontBlackCalibri);

    $excel->setActiveSheetIndex(0)
        ->getStyle('E' . $countStart)
        ->applyFromArray($centerText);

    $excel->setActiveSheetIndex(0)
        ->getStyle('E' . $countStart)
        ->applyFromArray($borderThin);

    $excel->setActiveSheetIndex(0)
        ->setCellValue('F' . $countStart, number_format($overtimepay/$perhour, 2, '.', ','))
        ->getStyle('F' . $countStart)
        ->applyFromArray($tableHeaderStyleFontBlackCalibri);

    $excel->setActiveSheetIndex(0)
        ->getStyle('F' . $countStart)
        ->applyFromArray($centerText);

    $excel->setActiveSheetIndex(0)
        ->getStyle('F' . $countStart)
        ->applyFromArray($borderThin);

    $excel->setActiveSheetIndex(0)
        ->setCellValue('G' . $countStart, number_format($ssscont, 2, '.', ','))
        ->getStyle('G' . $countStart)
        ->applyFromArray($tableHeaderStyleFontBlackCalibri);

    $excel->setActiveSheetIndex(0)
        ->getStyle('G' . $countStart)
        ->applyFromArray($centerText);

    $excel->setActiveSheetIndex(0)
        ->getStyle('G' . $countStart)
        ->applyFromArray($borderThin);

    $excel->setActiveSheetIndex(0)
        ->setCellValue('H' . $countStart, number_format($cashloansss, 2, '.', ','))
        ->getStyle('H' . $countStart)
        ->applyFromArray($tableHeaderStyleFontBlackCalibri);

    $excel->setActiveSheetIndex(0)
        ->getStyle('H' . $countStart)
        ->applyFromArray($centerText);

    $excel->setActiveSheetIndex(0)
        ->getStyle('H' . $countStart)
        ->applyFromArray($borderThin);

    $excel->setActiveSheetIndex(0)
        ->setCellValue('I' . $countStart, number_format($pagibigcont, 2, '.', ','))
        ->getStyle('I' . $countStart)
        ->applyFromArray($tableHeaderStyleFontBlackCalibri);

    $excel->setActiveSheetIndex(0)
        ->getStyle('I' . $countStart)
        ->applyFromArray($centerText);

    $excel->setActiveSheetIndex(0)
        ->getStyle('I' . $countStart)
        ->applyFromArray($borderThin);

    $excel->setActiveSheetIndex(0)
        ->setCellValue('J' . $countStart, '')
        ->getStyle('J' . $countStart)
        ->applyFromArray($tableHeaderStyleFontBlackCalibri);

    $excel->setActiveSheetIndex(0)
        ->getStyle('J' . $countStart)
        ->applyFromArray($centerText);

    $excel->setActiveSheetIndex(0)
        ->getStyle('J' . $countStart)
        ->applyFromArray($borderThin);

    $excel->setActiveSheetIndex(0)
        ->setCellValue('K' . $countStart, number_format($philhealthcont, 2, '.', ','))
        ->getStyle('K' . $countStart)
        ->applyFromArray($tableHeaderStyleFontBlackCalibri);

    $excel->setActiveSheetIndex(0)
        ->getStyle('K' . $countStart)
        ->applyFromArray($centerText);

    $excel->setActiveSheetIndex(0)
        ->getStyle('K' . $countStart)
        ->applyFromArray($borderThin);

    $excel->setActiveSheetIndex(0)
        ->setCellValue('L' . $countStart, number_format($taxcont, 2, '.', ','))
        ->getStyle('L' . $countStart)
        ->applyFromArray($tableHeaderStyleFontBlackCalibri);

    $excel->setActiveSheetIndex(0)
        ->getStyle('L' . $countStart)
        ->applyFromArray($centerText);

    $excel->setActiveSheetIndex(0)
        ->getStyle('L' . $countStart)
        ->applyFromArray($borderThin);

    $excel->setActiveSheetIndex(0)
        ->setCellValue('M' . $countStart, number_format($lesslate, 2, '.', ','))
        ->getStyle('M' . $countStart)
        ->applyFromArray($tableHeaderStyleFontBlackCalibri);

    $excel->setActiveSheetIndex(0)
        ->getStyle('M' . $countStart)
        ->applyFromArray($centerText);

    $excel->setActiveSheetIndex(0)
        ->getStyle('M' . $countStart)
        ->applyFromArray($borderThin);

    $excel->setActiveSheetIndex(0)
        ->setCellValue('N' . $countStart, number_format($cashloan, 2, '.', ','))
        ->getStyle('N' . $countStart)
        ->applyFromArray($tableHeaderStyleFontBlackCalibri);

    $excel->setActiveSheetIndex(0)
        ->getStyle('N' . $countStart)
        ->applyFromArray($centerText);

    $excel->setActiveSheetIndex(0)
        ->getStyle('N' . $countStart)
        ->applyFromArray($borderThin);

    $excel->setActiveSheetIndex(0)
        ->setCellValue('O' . $countStart, number_format($cashadvance, 2, '.', ','))
        ->getStyle('O' . $countStart)
        ->applyFromArray($tableHeaderStyleFontBlackCalibri);

    $excel->setActiveSheetIndex(0)
        ->getStyle('O' . $countStart)
        ->applyFromArray($centerText);

    $excel->setActiveSheetIndex(0)
        ->getStyle('O' . $countStart)
        ->applyFromArray($borderThin);

    $excel->setActiveSheetIndex(0)
        ->setCellValue('P' . $countStart, number_format($sundayhours, 2, '.', ','))
        ->getStyle('P' . $countStart)
        ->applyFromArray($tableHeaderStyleFontBlackCalibri);

    $excel->setActiveSheetIndex(0)
        ->getStyle('P' . $countStart)
        ->applyFromArray($centerText);

    $excel->setActiveSheetIndex(0)
        ->getStyle('P' . $countStart)
        ->applyFromArray($borderThin);

    $excel->setActiveSheetIndex(0)
        ->setCellValue('Q' . $countStart, number_format($perhour, 2, '.', ','))
        ->getStyle('Q' . $countStart)
        ->applyFromArray($tableHeaderStyleFontBlackCalibri);

    $excel->setActiveSheetIndex(0)
        ->getStyle('Q' . $countStart)
        ->applyFromArray($centerText);

    $excel->setActiveSheetIndex(0)
        ->getStyle('Q' . $countStart)
        ->applyFromArray($borderThin);

    $excel->setActiveSheetIndex(0)
        ->setCellValue('R' . $countStart, strtoupper($monthtext).'. '.$period.', '.$year)
        ->getStyle('R' . $countStart)
        ->applyFromArray($tableHeaderStyleFontBlackCalibri);

    $excel->setActiveSheetIndex(0)
        ->getStyle('R' . $countStart)
        ->applyFromArray($centerText);

    $excel->setActiveSheetIndex(0)
        ->getStyle('R' . $countStart)
        ->applyFromArray($borderThin);

    $excel->setActiveSheetIndex(0)
        ->setCellValue('S' . $countStart, number_format($perhour*8, 2, '.', ','))
        ->getStyle('S' . $countStart)
        ->applyFromArray($tableHeaderStyleFontBlackCalibri);

    $excel->setActiveSheetIndex(0)
        ->getStyle('S' . $countStart)
        ->applyFromArray($centerText);

    $excel->setActiveSheetIndex(0)
        ->getStyle('S' . $countStart)
        ->applyFromArray($borderThin);

    $excel->setActiveSheetIndex(0)
        ->setCellValue('T' . $countStart, '')
        ->getStyle('T' . $countStart)
        ->applyFromArray($tableHeaderStyleFontBlackCalibri);

    $excel->setActiveSheetIndex(0)
        ->getStyle('T' . $countStart)
        ->applyFromArray($centerText);

    $excel->setActiveSheetIndex(0)
        ->getStyle('T' . $countStart)
        ->applyFromArray($borderThin);

    $excel->setActiveSheetIndex(0)
        ->setCellValue('U' . $countStart, '')
        ->getStyle('U' . $countStart)
        ->applyFromArray($tableHeaderStyleFontBlackCalibri);

    $excel->setActiveSheetIndex(0)
        ->getStyle('U' . $countStart)
        ->applyFromArray($centerText);

    $excel->setActiveSheetIndex(0)
        ->getStyle('U' . $countStart)
        ->applyFromArray($borderThin);

    $excel->setActiveSheetIndex(0)
        ->setCellValue('V' . $countStart, number_format($basicpay-($sunday+$holiday+$snonworkingholiday), 2, '.', ','))
        ->getStyle('V' . $countStart)
        ->applyFromArray($tableHeaderStyleFontBlackBoldCalibriItalic);

    $excel->setActiveSheetIndex(0)
        ->getStyle('V' . $countStart)
        ->applyFromArray($centerText);

    $excel->setActiveSheetIndex(0)
        ->getStyle('V' . $countStart)
        ->applyFromArray($borderThin);

    $excel->setActiveSheetIndex(0)
        ->setCellValue('W' . $countStart, number_format($overtimepay, 2, '.', ','))
        ->getStyle('W' . $countStart)
        ->applyFromArray($tableHeaderStyleFontBlackBoldCalibriItalic);

    $excel->setActiveSheetIndex(0)
        ->getStyle('W' . $countStart)
        ->applyFromArray($centerText);

    $excel->setActiveSheetIndex(0)
        ->getStyle('W' . $countStart)
        ->applyFromArray($borderThin);

    $excel->setActiveSheetIndex(0)
        ->setCellValue('X' . $countStart, number_format($sunday, 2, '.', ','))
        ->getStyle('X' . $countStart)
        ->applyFromArray($tableHeaderStyleFontBlackBoldCalibriItalic);

    $excel->setActiveSheetIndex(0)
        ->getStyle('X' . $countStart)
        ->applyFromArray($centerText);

    $excel->setActiveSheetIndex(0)
        ->getStyle('X' . $countStart)
        ->applyFromArray($borderThin);

    $excel->setActiveSheetIndex(0)
        ->setCellValue('Y' . $countStart, number_format($holiday, 2, '.', ','))
        ->getStyle('Y' . $countStart)
        ->applyFromArray($tableHeaderStyleFontBlackBoldCalibriItalic);

    $excel->setActiveSheetIndex(0)
        ->getStyle('Y' . $countStart)
        ->applyFromArray($centerText);

    $excel->setActiveSheetIndex(0)
        ->getStyle('Y' . $countStart)
        ->applyFromArray($borderThin);

    $excel->setActiveSheetIndex(0)
        ->setCellValue('Z' . $countStart, number_format($snonworkingholiday, 2, '.', ','))
        ->getStyle('Z' . $countStart)
        ->applyFromArray($tableHeaderStyleFontBlackBoldCalibriItalic);

    $excel->setActiveSheetIndex(0)
        ->getStyle('Z' . $countStart)
        ->applyFromArray($centerText);

    $excel->setActiveSheetIndex(0)
        ->getStyle('Z' . $countStart)
        ->applyFromArray($borderThin);

    $excel->setActiveSheetIndex(0)
        ->setCellValue('AA' . $countStart, number_format($basicpay+$overtimepay, 2, '.', ','))
        ->getStyle('AA' . $countStart)
        ->applyFromArray($tableHeaderStyleFontBlackBoldCalibriItalic);

    $excel->setActiveSheetIndex(0)
        ->getStyle('AA' . $countStart)
        ->applyFromArray($centerText);

    $excel->setActiveSheetIndex(0)
        ->getStyle('AA' . $countStart)
        ->applyFromArray($borderThin);

    $excel->setActiveSheetIndex(0)
        ->setCellValue('AB' . $countStart, number_format($ssscont+$philhealthcont+$pagibigcont+$taxcont+$cashadvance+$cashloan+$cashloansss+$lesslate, 2, '.', ','))
        ->getStyle('AB' . $countStart)
        ->applyFromArray($tableHeaderStyleFontBlackBoldCalibriItalic);

    $excel->setActiveSheetIndex(0)
        ->getStyle('AB' . $countStart)
        ->applyFromArray($centerText);

    $excel->setActiveSheetIndex(0)
        ->getStyle('AB' . $countStart)
        ->applyFromArray($borderThin);

    $excel->setActiveSheetIndex(0)
        ->setCellValue('AC' . $countStart, number_format($basicpay+$overtimepay-($ssscont+$philhealthcont+$pagibigcont+$taxcont+$cashadvance+$cashloan+$cashloansss+$lesslate), 2, '.', ','))
        ->getStyle('AC' . $countStart)
        ->applyFromArray($tableHeaderStyleFontBlackBoldCalibriItalic);

    $excel->setActiveSheetIndex(0)
        ->getStyle('AC' . $countStart)
        ->applyFromArray($centerText);

    $excel->setActiveSheetIndex(0)
        ->getStyle('AC' . $countStart)
        ->applyFromArray($borderThin);

}

// TOTAL

$countStart = $countStart + 2;

$excel->setActiveSheetIndex(0)
    ->setCellValue('A' . $countStart, '')
    ->getStyle('A' . $countStart)
    ->applyFromArray($tableHeaderStyleFontBlackBoldCalibri);

$excel->setActiveSheetIndex(0)
    ->getStyle('A' . $countStart)
    ->applyFromArray($centerText);

$excel->setActiveSheetIndex(0)
    ->getStyle('A' . $countStart)
    ->applyFromArray($borderThin);

$excel->setActiveSheetIndex(0)
    ->setCellValue('B' . $countStart, '')
    ->getStyle('B' . $countStart)
    ->applyFromArray($tableHeaderStyleFontBlackBoldCalibri);

$excel->setActiveSheetIndex(0)
    ->getStyle('B' . $countStart)
    ->applyFromArray($centerText);

$excel->setActiveSheetIndex(0)
    ->getStyle('B' . $countStart)
    ->applyFromArray($borderThin);

$excel->setActiveSheetIndex(0)
    ->setCellValue('C' . $countStart, '')
    ->getStyle('C' . $countStart)
    ->applyFromArray($tableHeaderStyleFontBlackBoldCalibri);

$excel->setActiveSheetIndex(0)
    ->getStyle('C' . $countStart)
    ->applyFromArray($centerText);

$excel->setActiveSheetIndex(0)
    ->getStyle('C' . $countStart)
    ->applyFromArray($borderThin);

$excel->setActiveSheetIndex(0)
    ->setCellValue('D' . $countStart, '')
    ->getStyle('D' . $countStart)
    ->applyFromArray($tableHeaderStyleFontBlackBoldCalibri);

$excel->setActiveSheetIndex(0)
    ->getStyle('D' . $countStart)
    ->applyFromArray($centerText);

$excel->setActiveSheetIndex(0)
    ->getStyle('D' . $countStart)
    ->applyFromArray($borderThin);

$excel->setActiveSheetIndex(0)
    ->setCellValue('E' . $countStart, '')
    ->getStyle('E' . $countStart)
    ->applyFromArray($tableHeaderStyleFontBlackBoldCalibri);

$excel->setActiveSheetIndex(0)
    ->getStyle('E' . $countStart)
    ->applyFromArray($centerText);

$excel->setActiveSheetIndex(0)
    ->getStyle('E' . $countStart)
    ->applyFromArray($borderThin);

$excel->setActiveSheetIndex(0)
    ->setCellValue('F' . $countStart, '')
    ->getStyle('F' . $countStart)
    ->applyFromArray($tableHeaderStyleFontBlackBoldCalibri);

$excel->setActiveSheetIndex(0)
    ->getStyle('F' . $countStart)
    ->applyFromArray($centerText);

$excel->setActiveSheetIndex(0)
    ->getStyle('F' . $countStart)
    ->applyFromArray($borderThin);

$excel->setActiveSheetIndex(0)
    ->setCellValue('G' . $countStart, number_format($sssgrandtotal, 2, '.', ','))
    ->getStyle('G' . $countStart)
    ->applyFromArray($tableHeaderStyleFontBlackBoldCalibri);

$excel->setActiveSheetIndex(0)
    ->getStyle('G' . $countStart)
    ->applyFromArray($centerText);

$excel->setActiveSheetIndex(0)
    ->getStyle('G' . $countStart)
    ->applyFromArray($borderThin);

$excel->setActiveSheetIndex(0)
    ->setCellValue('H' . $countStart, '')
    ->getStyle('H' . $countStart)
    ->applyFromArray($tableHeaderStyleFontBlackBoldCalibri);

$excel->setActiveSheetIndex(0)
    ->getStyle('H' . $countStart)
    ->applyFromArray($centerText);

$excel->setActiveSheetIndex(0)
    ->getStyle('H' . $countStart)
    ->applyFromArray($borderThin);

$excel->setActiveSheetIndex(0)
    ->setCellValue('I' . $countStart, number_format($pagibiggrandtotal, 2, '.', ','))
    ->getStyle('I' . $countStart)
    ->applyFromArray($tableHeaderStyleFontBlackBoldCalibri);

$excel->setActiveSheetIndex(0)
    ->getStyle('I' . $countStart)
    ->applyFromArray($centerText);

$excel->setActiveSheetIndex(0)
    ->getStyle('I' . $countStart)
    ->applyFromArray($borderThin);

$excel->setActiveSheetIndex(0)
    ->setCellValue('J' . $countStart, '')
    ->getStyle('J' . $countStart)
    ->applyFromArray($tableHeaderStyleFontBlackBoldCalibri);

$excel->setActiveSheetIndex(0)
    ->getStyle('J' . $countStart)
    ->applyFromArray($centerText);

$excel->setActiveSheetIndex(0)
    ->getStyle('J' . $countStart)
    ->applyFromArray($borderThin);

$excel->setActiveSheetIndex(0)
    ->setCellValue('K' . $countStart, number_format($philhealthgrandtotal, 2, '.', ','))
    ->getStyle('K' . $countStart)
    ->applyFromArray($tableHeaderStyleFontBlackBoldCalibri);

$excel->setActiveSheetIndex(0)
    ->getStyle('K' . $countStart)
    ->applyFromArray($centerText);

$excel->setActiveSheetIndex(0)
    ->getStyle('K' . $countStart)
    ->applyFromArray($borderThin);

$excel->setActiveSheetIndex(0)
    ->setCellValue('L' . $countStart, number_format($taxgrandtotal, 2, '.', ','))
    ->getStyle('L' . $countStart)
    ->applyFromArray($tableHeaderStyleFontBlackBoldCalibri);

$excel->setActiveSheetIndex(0)
    ->getStyle('L' . $countStart)
    ->applyFromArray($centerText);

$excel->setActiveSheetIndex(0)
    ->getStyle('L' . $countStart)
    ->applyFromArray($borderThin);

$excel->setActiveSheetIndex(0)
    ->setCellValue('M' . $countStart, '')
    ->getStyle('M' . $countStart)
    ->applyFromArray($tableHeaderStyleFontBlackBoldCalibri);

$excel->setActiveSheetIndex(0)
    ->getStyle('M' . $countStart)
    ->applyFromArray($centerText);

$excel->setActiveSheetIndex(0)
    ->getStyle('M' . $countStart)
    ->applyFromArray($borderThin);

$excel->setActiveSheetIndex(0)
    ->setCellValue('N' . $countStart, number_format($cashloangrandtotal, 2, '.', ','))
    ->getStyle('N' . $countStart)
    ->applyFromArray($tableHeaderStyleFontBlackBoldCalibri);

$excel->setActiveSheetIndex(0)
    ->getStyle('N' . $countStart)
    ->applyFromArray($centerText);

$excel->setActiveSheetIndex(0)
    ->getStyle('N' . $countStart)
    ->applyFromArray($borderThin);

$excel->setActiveSheetIndex(0)
    ->setCellValue('O' . $countStart, number_format($cashadvancegrandtotal, 2, '.', ','))
    ->getStyle('O' . $countStart)
    ->applyFromArray($tableHeaderStyleFontBlackBoldCalibri);

$excel->setActiveSheetIndex(0)
    ->getStyle('O' . $countStart)
    ->applyFromArray($centerText);

$excel->setActiveSheetIndex(0)
    ->getStyle('O' . $countStart)
    ->applyFromArray($borderThin);

$excel->setActiveSheetIndex(0)
    ->setCellValue('P' . $countStart, '')
    ->getStyle('P' . $countStart)
    ->applyFromArray($tableHeaderStyleFontBlackBoldCalibri);

$excel->setActiveSheetIndex(0)
    ->getStyle('P' . $countStart)
    ->applyFromArray($centerText);

$excel->setActiveSheetIndex(0)
    ->getStyle('P' . $countStart)
    ->applyFromArray($borderThin);

$excel->setActiveSheetIndex(0)
    ->setCellValue('Q' . $countStart, '')
    ->getStyle('Q' . $countStart)
    ->applyFromArray($tableHeaderStyleFontBlackBoldCalibri);

$excel->setActiveSheetIndex(0)
    ->getStyle('Q' . $countStart)
    ->applyFromArray($centerText);

$excel->setActiveSheetIndex(0)
    ->getStyle('Q' . $countStart)
    ->applyFromArray($borderThin);

$excel->setActiveSheetIndex(0)
    ->setCellValue('R' . $countStart, '')
    ->getStyle('R' . $countStart)
    ->applyFromArray($tableHeaderStyleFontBlackBoldCalibri);

$excel->setActiveSheetIndex(0)
    ->getStyle('R' . $countStart)
    ->applyFromArray($centerText);

$excel->setActiveSheetIndex(0)
    ->getStyle('R' . $countStart)
    ->applyFromArray($borderThin);

$excel->setActiveSheetIndex(0)
    ->setCellValue('S' . $countStart, '')
    ->getStyle('S' . $countStart)
    ->applyFromArray($tableHeaderStyleFontBlackBoldCalibri);

$excel->setActiveSheetIndex(0)
    ->getStyle('S' . $countStart)
    ->applyFromArray($centerText);

$excel->setActiveSheetIndex(0)
    ->getStyle('S' . $countStart)
    ->applyFromArray($borderThin);

$excel->setActiveSheetIndex(0)
    ->setCellValue('T' . $countStart, '')
    ->getStyle('T' . $countStart)
    ->applyFromArray($tableHeaderStyleFontBlackBoldCalibri);

$excel->setActiveSheetIndex(0)
    ->getStyle('T' . $countStart)
    ->applyFromArray($centerText);

$excel->setActiveSheetIndex(0)
    ->getStyle('T' . $countStart)
    ->applyFromArray($borderThin);

$excel->setActiveSheetIndex(0)
    ->setCellValue('U' . $countStart, '')
    ->getStyle('U' . $countStart)
    ->applyFromArray($tableHeaderStyleFontBlackBoldCalibri);

$excel->setActiveSheetIndex(0)
    ->getStyle('U' . $countStart)
    ->applyFromArray($centerText);

$excel->setActiveSheetIndex(0)
    ->getStyle('U' . $countStart)
    ->applyFromArray($borderThin);

$excel->setActiveSheetIndex(0)
    ->setCellValue('V' . $countStart, number_format($dailygrandtotal, 2, '.', ','))
    ->getStyle('V' . $countStart)
    ->applyFromArray($tableHeaderStyleFontBlackBoldCalibri);

$excel->setActiveSheetIndex(0)
    ->getStyle('V' . $countStart)
    ->applyFromArray($centerText);

$excel->setActiveSheetIndex(0)
    ->getStyle('V' . $countStart)
    ->applyFromArray($borderThin);

$excel->setActiveSheetIndex(0)
    ->setCellValue('W' . $countStart, number_format($overtimegrandtotal, 2, '.', ','))
    ->getStyle('W' . $countStart)
    ->applyFromArray($tableHeaderStyleFontBlackBoldCalibri);

$excel->setActiveSheetIndex(0)
    ->getStyle('W' . $countStart)
    ->applyFromArray($centerText);

$excel->setActiveSheetIndex(0)
    ->getStyle('W' . $countStart)
    ->applyFromArray($borderThin);

$excel->setActiveSheetIndex(0)
    ->setCellValue('X' . $countStart, number_format($sundaygrandtotal, 2, '.', ','))
    ->getStyle('X' . $countStart)
    ->applyFromArray($tableHeaderStyleFontBlackBoldCalibri);

$excel->setActiveSheetIndex(0)
    ->getStyle('X' . $countStart)
    ->applyFromArray($centerText);

$excel->setActiveSheetIndex(0)
    ->getStyle('X' . $countStart)
    ->applyFromArray($borderThin);

$excel->setActiveSheetIndex(0)
    ->setCellValue('Y' . $countStart, number_format($holidaygrandtotal, 2, '.', ','))
    ->getStyle('Y' . $countStart)
    ->applyFromArray($tableHeaderStyleFontBlackBoldCalibri);

$excel->setActiveSheetIndex(0)
    ->getStyle('Y' . $countStart)
    ->applyFromArray($centerText);

$excel->setActiveSheetIndex(0)
    ->getStyle('Y' . $countStart)
    ->applyFromArray($borderThin);

$excel->setActiveSheetIndex(0)
    ->setCellValue('Z' . $countStart, number_format($snholidaygrandtotal, 2, '.', ','))
    ->getStyle('Z' . $countStart)
    ->applyFromArray($tableHeaderStyleFontBlackBoldCalibri);

$excel->setActiveSheetIndex(0)
    ->getStyle('Z' . $countStart)
    ->applyFromArray($centerText);

$excel->setActiveSheetIndex(0)
    ->getStyle('Z' . $countStart)
    ->applyFromArray($borderThin);

$excel->setActiveSheetIndex(0)
    ->setCellValue('AA' . $countStart, number_format($grossgrandtotal, 2, '.', ','))
    ->getStyle('AA' . $countStart)
    ->applyFromArray($tableHeaderStyleFontBlackBoldCalibri);

$excel->setActiveSheetIndex(0)
    ->getStyle('AA' . $countStart)
    ->applyFromArray($centerText);

$excel->setActiveSheetIndex(0)
    ->getStyle('AA' . $countStart)
    ->applyFromArray($borderThin);

$excel->setActiveSheetIndex(0)
    ->setCellValue('AB' . $countStart, number_format($deductionsgrandtotal, 2, '.', ','))
    ->getStyle('AB' . $countStart)
    ->applyFromArray($tableHeaderStyleFontBlackBoldCalibri);

$excel->setActiveSheetIndex(0)
    ->getStyle('AB' . $countStart)
    ->applyFromArray($centerText);

$excel->setActiveSheetIndex(0)
    ->getStyle('AB' . $countStart)
    ->applyFromArray($borderThin);

$excel->setActiveSheetIndex(0)
    ->setCellValue('AC' . $countStart, number_format($netgrandtotal, 2, '.', ','))
    ->getStyle('AC' . $countStart)
    ->applyFromArray($tableHeaderStyleFontBlackBoldCalibri);

$excel->setActiveSheetIndex(0)
    ->getStyle('AC' . $countStart)
    ->applyFromArray($centerText);

$excel->setActiveSheetIndex(0)
    ->getStyle('AC' . $countStart)
    ->applyFromArray($borderThin);

header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment; filename="Summary.xlsx"');
header('Cache-Control: max-age=0');
$file = PHPExcel_IOFactory::createWriter($excel, 'Excel2007');
$file->save('php://output');
