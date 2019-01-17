<?php
include_once "include/loginstatus.php";
require_once 'library/PHPExcel/Classes/PHPExcel.php';
$excel = new PHPExcel();

$month = $_GET["month"];
$year = $_GET["year"];

//SHEET NAME

$excel->setActiveSheetIndex(0)
    ->setTitle('CONTRIBUTION SUMMARY');

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
        'size' => 14,
        'name' => 'Calibri',
    ));

$tableHeaderStyleFontBlackBoldCalibriSmall = array(
    'font' => array(
        'bold' => true,
        'color' => array('rgb' => '000000'),
        'size' => 12,
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

// FIRST LAYER

$excel->setActiveSheetIndex(0)
    ->setCellValue('A1', 'CONTRIBUTIONS')
    ->getStyle('A1')
    ->applyFromArray($tableHeaderStyleFontBlackBoldCalibri);

$excel->setActiveSheetIndex(0)
    ->getStyle('A1')
    ->applyFromArray($centerText);

$excel->setActiveSheetIndex(0)
    ->getStyle('A1')
    ->applyFromArray($borderMedium);

$excel->setActiveSheetIndex(0)
    ->setCellValue('B1', '')
    ->getStyle('B1')
    ->applyFromArray($tableHeaderStyleFontBlackBoldCalibri);

$excel->setActiveSheetIndex(0)
    ->getStyle('B1')
    ->applyFromArray($centerText);

$excel->setActiveSheetIndex(0)
    ->getStyle('B1')
    ->applyFromArray($borderMedium);

$excel->setActiveSheetIndex()->mergeCells('C1:J1');

$excel->setActiveSheetIndex(0)
    ->setCellValue('C1', 'EMPLOYEE')
    ->getStyle('C1')
    ->applyFromArray($tableHeaderStyleFontBlackBoldCalibri);

$excel->setActiveSheetIndex(0)
    ->getStyle('C1')
    ->applyFromArray($centerText);

$excel->setActiveSheetIndex(0)
    ->getStyle('C1')
    ->applyFromArray($borderMedium);

$excel->setActiveSheetIndex(0)
    ->getStyle('D1')
    ->applyFromArray($borderMedium);

$excel->setActiveSheetIndex(0)
    ->getStyle('E1')
    ->applyFromArray($borderMedium);

$excel->setActiveSheetIndex(0)
    ->getStyle('F1')
    ->applyFromArray($borderMedium);

$excel->setActiveSheetIndex(0)
    ->getStyle('G1')
    ->applyFromArray($borderMedium);

$excel->setActiveSheetIndex(0)
    ->getStyle('H1')
    ->applyFromArray($borderMedium);

$excel->setActiveSheetIndex(0)
    ->getStyle('I1')
    ->applyFromArray($borderMedium);

$excel->setActiveSheetIndex(0)
    ->getStyle('J1')
    ->applyFromArray($borderMedium);

// K IS NOT INCLUDED

$excel->setActiveSheetIndex()->mergeCells('L1:P1');

$excel->setActiveSheetIndex(0)
    ->setCellValue('L1', 'EMPLOYER')
    ->getStyle('L1')
    ->applyFromArray($tableHeaderStyleFontBlackBoldCalibri);

$excel->setActiveSheetIndex(0)
    ->getStyle('L1')
    ->applyFromArray($centerText);

$excel->setActiveSheetIndex(0)
    ->getStyle('L1')
    ->applyFromArray($borderMedium);

$excel->setActiveSheetIndex(0)
    ->getStyle('M1')
    ->applyFromArray($borderMedium);

$excel->setActiveSheetIndex(0)
    ->getStyle('N1')
    ->applyFromArray($borderMedium);

$excel->setActiveSheetIndex(0)
    ->getStyle('O1')
    ->applyFromArray($borderMedium);

$excel->setActiveSheetIndex(0)
    ->getStyle('P1')
    ->applyFromArray($borderMedium);

// Q IS NOT INCLUDED

$excel->setActiveSheetIndex()->mergeCells('R1:T1');

$excel->setActiveSheetIndex(0)
    ->setCellValue('R1', 'TOTAL')
    ->getStyle('R1')
    ->applyFromArray($tableHeaderStyleFontBlackBoldCalibri);

$excel->setActiveSheetIndex(0)
    ->getStyle('R1')
    ->applyFromArray($centerText);

$excel->setActiveSheetIndex(0)
    ->getStyle('R1')
    ->applyFromArray($borderMedium);

$excel->setActiveSheetIndex(0)
    ->getStyle('S1')
    ->applyFromArray($borderMedium);

$excel->setActiveSheetIndex(0)
    ->getStyle('T1')
    ->applyFromArray($borderMedium);

// SECOND LAYER

$excel->setActiveSheetIndex()->mergeCells('A2:A3');

$excel->setActiveSheetIndex(0)
    ->setCellValue('A2', 'EMPLOYEE')
    ->getStyle('A2')
    ->applyFromArray($tableHeaderStyleFontBlackBoldCalibriSmall);

$excel->setActiveSheetIndex(0)
    ->getStyle('A2')
    ->applyFromArray($centerText);

$excel->setActiveSheetIndex(0)
    ->getStyle('A2')
    ->applyFromArray($borderMedium);

$excel->setActiveSheetIndex()->mergeCells('B2:B3');

$excel->setActiveSheetIndex(0)
    ->setCellValue('B2', 'MONTH OF')
    ->getStyle('B2')
    ->applyFromArray($tableHeaderStyleFontBlackBoldCalibriSmall);

$excel->setActiveSheetIndex(0)
    ->getStyle('B2')
    ->applyFromArray($centerText);

$excel->setActiveSheetIndex(0)
    ->getStyle('B2')
    ->applyFromArray($borderMedium);

$excel->setActiveSheetIndex()->mergeCells('C2:D2');

$excel->setActiveSheetIndex(0)
    ->setCellValue('C2', 'SSS')
    ->getStyle('C2')
    ->applyFromArray($tableHeaderStyleFontBlackBoldCalibriSmall);

$excel->setActiveSheetIndex(0)
    ->getStyle('C2')
    ->applyFromArray($centerText);

$excel->setActiveSheetIndex(0)
    ->getStyle('C2')
    ->applyFromArray($borderMedium);

$excel->setActiveSheetIndex(0)
    ->getStyle('D2')
    ->applyFromArray($borderMedium);

$excel->setActiveSheetIndex()->mergeCells('E2:F2');

$excel->setActiveSheetIndex(0)
    ->setCellValue('E2', 'PAG-IBIG')
    ->getStyle('E2')
    ->applyFromArray($tableHeaderStyleFontBlackBoldCalibriSmall);

$excel->setActiveSheetIndex(0)
    ->getStyle('E2')
    ->getAlignment()
    ->setWrapText(true);

$excel->setActiveSheetIndex(0)
    ->getStyle('E2')
    ->applyFromArray($centerText);

$excel->setActiveSheetIndex(0)
    ->getStyle('E2')
    ->applyFromArray($borderMedium);

$excel->setActiveSheetIndex(0)
    ->getStyle('F2')
    ->applyFromArray($borderMedium);

$excel->setActiveSheetIndex()->mergeCells('G2:H2');

$excel->setActiveSheetIndex(0)
    ->setCellValue('G2', 'PHILHEALTH')
    ->getStyle('G2')
    ->applyFromArray($tableHeaderStyleFontBlackBoldCalibriSmall);

$excel->setActiveSheetIndex(0)
    ->getStyle('G2')
    ->applyFromArray($centerText);

$excel->setActiveSheetIndex(0)
    ->getStyle('G2')
    ->applyFromArray($borderMedium);

$excel->setActiveSheetIndex(0)
    ->getStyle('G2')
    ->getAlignment()
    ->setWrapText(true);

$excel->setActiveSheetIndex(0)
    ->getStyle('H2')
    ->applyFromArray($borderMedium);

$excel->setActiveSheetIndex()->mergeCells('I2:J2');

$excel->setActiveSheetIndex(0)
    ->setCellValue('I2', 'TAX')
    ->getStyle('I2')
    ->applyFromArray($tableHeaderStyleFontBlackBoldCalibriSmall);

$excel->setActiveSheetIndex(0)
    ->getStyle('I2')
    ->applyFromArray($centerText);

$excel->setActiveSheetIndex(0)
    ->getStyle('I2')
    ->applyFromArray($borderMedium);

$excel->setActiveSheetIndex(0)
    ->getStyle('I2')
    ->getAlignment()
    ->setWrapText(true);

$excel->setActiveSheetIndex(0)
    ->getStyle('J2')
    ->applyFromArray($borderMedium);

// K IS NOT INCLUDED

$excel->setActiveSheetIndex()->mergeCells('L2:N2');

$excel->setActiveSheetIndex(0)
    ->setCellValue('L2', 'SSS')
    ->getStyle('L2')
    ->applyFromArray($tableHeaderStyleFontBlackBoldCalibriSmall);

$excel->setActiveSheetIndex(0)
    ->getStyle('L2')
    ->applyFromArray($centerText);

$excel->setActiveSheetIndex(0)
    ->getStyle('L2')
    ->applyFromArray($borderMedium);

$excel->setActiveSheetIndex(0)
    ->getStyle('M2')
    ->applyFromArray($borderMedium);

$excel->setActiveSheetIndex(0)
    ->getStyle('N2')
    ->applyFromArray($borderMedium);

$excel->setActiveSheetIndex()->mergeCells('O2:O3');

$excel->setActiveSheetIndex(0)
    ->setCellValue('O2', 'PAG-IBIG')
    ->getStyle('O2')
    ->applyFromArray($tableHeaderStyleFontBlackBoldCalibriSmall);

$excel->setActiveSheetIndex(0)
    ->getStyle('O2')
    ->getAlignment()
    ->setWrapText(true);

$excel->setActiveSheetIndex(0)
    ->getStyle('O2')
    ->applyFromArray($centerText);

$excel->setActiveSheetIndex(0)
    ->getStyle('O2')
    ->applyFromArray($borderMedium);

$excel->setActiveSheetIndex()->mergeCells('P2:P3');

$excel->setActiveSheetIndex(0)
    ->setCellValue('P2', 'PHIL' . PHP_EOL . 'HEALTH')
    ->getStyle('P2')
    ->applyFromArray($tableHeaderStyleFontBlackBoldCalibriSmall);

$excel->setActiveSheetIndex(0)
    ->getStyle('P2')
    ->getAlignment()
    ->setWrapText(true);

$excel->setActiveSheetIndex(0)
    ->getStyle('P2')
    ->applyFromArray($centerText);

$excel->setActiveSheetIndex(0)
    ->getStyle('P2')
    ->applyFromArray($borderMedium);

// Q IS NOT INCLUDED

$excel->setActiveSheetIndex()->mergeCells('R2:R3');

$excel->setActiveSheetIndex(0)
    ->setCellValue('R2', 'SSS+EC')
    ->getStyle('R2')
    ->applyFromArray($tableHeaderStyleFontBlackBoldCalibriSmall);

$excel->setActiveSheetIndex(0)
    ->getStyle('R2')
    ->applyFromArray($centerText);

$excel->setActiveSheetIndex(0)
    ->getStyle('R2')
    ->applyFromArray($borderMedium);

$excel->setActiveSheetIndex()->mergeCells('S2:S3');

$excel->setActiveSheetIndex(0)
    ->setCellValue('S2', 'PAG-IBIG')
    ->getStyle('S2')
    ->applyFromArray($tableHeaderStyleFontBlackBoldCalibriSmall);

$excel->setActiveSheetIndex(0)
    ->getStyle('S2')
    ->applyFromArray($centerText);

$excel->setActiveSheetIndex(0)
    ->getStyle('S2')
    ->applyFromArray($borderMedium);

$excel->setActiveSheetIndex()->mergeCells('T2:T3');

$excel->setActiveSheetIndex(0)
    ->setCellValue('T2', 'PHIL' . PHP_EOL . 'HEALTH')
    ->getStyle('T2')
    ->applyFromArray($tableHeaderStyleFontBlackBoldCalibriSmall);

$excel->setActiveSheetIndex(0)
    ->getStyle('T2')
    ->getAlignment()
    ->setWrapText(true);

$excel->setActiveSheetIndex(0)
    ->getStyle('T2')
    ->applyFromArray($centerText);

$excel->setActiveSheetIndex(0)
    ->getStyle('T2')
    ->applyFromArray($borderMedium);

// THIRD LAYER

$excel->setActiveSheetIndex(0)
    ->getStyle('A3')
    ->applyFromArray($borderMedium);

$excel->setActiveSheetIndex(0)
    ->getStyle('B3')
    ->applyFromArray($borderMedium);

$excel->setActiveSheetIndex(0)
    ->setCellValue('C3', '26-10')
    ->getStyle('C3')
    ->applyFromArray($tableHeaderStyleFontBlackBoldCalibriSmall);

$excel->setActiveSheetIndex(0)
    ->getStyle('C3')
    ->applyFromArray($centerText);

$excel->setActiveSheetIndex(0)
    ->getStyle('C3')
    ->applyFromArray($borderMedium);

$excel->setActiveSheetIndex(0)
    ->setCellValue('D3', '11-25')
    ->getStyle('D3')
    ->applyFromArray($tableHeaderStyleFontBlackBoldCalibriSmall);

$excel->setActiveSheetIndex(0)
    ->getStyle('D3')
    ->applyFromArray($centerText);

$excel->setActiveSheetIndex(0)
    ->getStyle('D3')
    ->applyFromArray($borderMedium);

$excel->setActiveSheetIndex(0)
    ->setCellValue('E3', '26-10')
    ->getStyle('E3')
    ->applyFromArray($tableHeaderStyleFontBlackBoldCalibriSmall);

$excel->setActiveSheetIndex(0)
    ->getStyle('E3')
    ->getAlignment()
    ->setWrapText(true);

$excel->setActiveSheetIndex(0)
    ->getStyle('E3')
    ->applyFromArray($centerText);

$excel->setActiveSheetIndex(0)
    ->getStyle('E3')
    ->applyFromArray($borderMedium);

$excel->setActiveSheetIndex(0)
    ->setCellValue('F3', "11-25")
    ->getStyle('F3')
    ->applyFromArray($tableHeaderStyleFontBlackBoldCalibriSmall);

$excel->setActiveSheetIndex(0)
    ->getStyle('F3')
    ->applyFromArray($centerText);

$excel->setActiveSheetIndex(0)
    ->getStyle('F3')
    ->applyFromArray($borderMedium);

$excel->setActiveSheetIndex(0)
    ->setCellValue('G3', "26-10")
    ->getStyle('G3')
    ->applyFromArray($tableHeaderStyleFontBlackBoldCalibriSmall);

$excel->setActiveSheetIndex(0)
    ->getStyle('G3')
    ->applyFromArray($centerText);

$excel->setActiveSheetIndex(0)
    ->getStyle('G3')
    ->applyFromArray($borderMedium);

$excel->setActiveSheetIndex(0)
    ->setCellValue('H3', "11-25")
    ->getStyle('H3')
    ->applyFromArray($tableHeaderStyleFontBlackBoldCalibriSmall);

$excel->setActiveSheetIndex(0)
    ->getStyle('H3')
    ->getAlignment()
    ->setWrapText(true);

$excel->setActiveSheetIndex(0)
    ->getStyle('H3')
    ->applyFromArray($centerText);

$excel->setActiveSheetIndex(0)
    ->getStyle('H3')
    ->applyFromArray($borderMedium);

$excel->setActiveSheetIndex(0)
    ->getStyle('H3')
    ->getAlignment()
    ->setWrapText(true);

$excel->setActiveSheetIndex(0)
    ->setCellValue('I3', "")
    ->getStyle('I3')
    ->applyFromArray($tableHeaderStyleFontBlackBoldCalibriSmall);

$excel->setActiveSheetIndex(0)
    ->getStyle('I3')
    ->applyFromArray($centerText);

$excel->setActiveSheetIndex(0)
    ->getStyle('I3')
    ->applyFromArray($borderMedium);

$excel->setActiveSheetIndex(0)
    ->setCellValue('J3', '')
    ->getStyle('J3')
    ->applyFromArray($tableHeaderStyleFontBlackBoldCalibriSmall);

$excel->setActiveSheetIndex(0)
    ->getStyle('J3')
    ->applyFromArray($centerText);

$excel->setActiveSheetIndex(0)
    ->getStyle('J3')
    ->applyFromArray($borderMedium);

// K NOT INCLUDE

$excel->setActiveSheetIndex(0)
    ->setCellValue('L3', 'EE')
    ->getStyle('L3')
    ->applyFromArray($tableHeaderStyleFontBlackBoldCalibriSmall);

$excel->setActiveSheetIndex(0)
    ->getStyle('L3')
    ->applyFromArray($centerText);

$excel->setActiveSheetIndex(0)
    ->getStyle('L3')
    ->applyFromArray($borderMedium);

$excel->setActiveSheetIndex(0)
    ->setCellValue('M3', 'ER')
    ->getStyle('M3')
    ->applyFromArray($tableHeaderStyleFontBlackBoldCalibriSmall);

$excel->setActiveSheetIndex(0)
    ->getStyle('M3')
    ->applyFromArray($centerText);

$excel->setActiveSheetIndex(0)
    ->getStyle('M3')
    ->applyFromArray($borderMedium);

$excel->setActiveSheetIndex(0)
    ->setCellValue('N3', 'EC')
    ->getStyle('N3')
    ->applyFromArray($tableHeaderStyleFontBlackBoldCalibriSmall);

$excel->setActiveSheetIndex(0)
    ->getStyle('N3')
    ->applyFromArray($centerText);

$excel->setActiveSheetIndex(0)
    ->getStyle('N3')
    ->applyFromArray($borderMedium);

$excel->setActiveSheetIndex(0)
    ->getStyle('O3')
    ->applyFromArray($borderMedium);

$excel->setActiveSheetIndex(0)
    ->getStyle('P3')
    ->applyFromArray($borderMedium);

// Q IS NOT INCLUDED

$excel->setActiveSheetIndex(0)
    ->getStyle('R3')
    ->applyFromArray($borderMedium);

$excel->setActiveSheetIndex(0)
    ->getStyle('S3')
    ->applyFromArray($borderMedium);

$excel->setActiveSheetIndex(0)
    ->getStyle('T3')
    ->applyFromArray($borderMedium);

$excel->setActiveSheetIndex(0)->getColumnDimension('A')->setWidth(40);
$excel->setActiveSheetIndex(0)->getColumnDimension('B')->setWidth(20);
$excel->setActiveSheetIndex(0)->getColumnDimension('C')->setWidth(10);
$excel->setActiveSheetIndex(0)->getColumnDimension('D')->setWidth(10);
$excel->setActiveSheetIndex(0)->getColumnDimension('E')->setWidth(10);
$excel->setActiveSheetIndex(0)->getColumnDimension('F')->setWidth(10);
$excel->setActiveSheetIndex(0)->getColumnDimension('G')->setWidth(10);
$excel->setActiveSheetIndex(0)->getColumnDimension('H')->setWidth(10);
$excel->setActiveSheetIndex(0)->getColumnDimension('I')->setWidth(10);
$excel->setActiveSheetIndex(0)->getColumnDimension('J')->setWidth(10);
$excel->setActiveSheetIndex(0)->getColumnDimension('K')->setWidth(2);
$excel->setActiveSheetIndex(0)->getColumnDimension('L')->setWidth(10);
$excel->setActiveSheetIndex(0)->getColumnDimension('M')->setWidth(10);
$excel->setActiveSheetIndex(0)->getColumnDimension('N')->setWidth(10);
$excel->setActiveSheetIndex(0)->getColumnDimension('O')->setWidth(10);
$excel->setActiveSheetIndex(0)->getColumnDimension('P')->setWidth(10);
$excel->setActiveSheetIndex(0)->getColumnDimension('Q')->setWidth(2);
$excel->setActiveSheetIndex(0)->getColumnDimension('R')->setWidth(10);
$excel->setActiveSheetIndex(0)->getColumnDimension('S')->setWidth(10);
$excel->setActiveSheetIndex(0)->getColumnDimension('T')->setWidth(10);

$excel->setActiveSheetIndex(0)->getRowDimension('1')->setRowHeight(-1);

$countStart = 3;
$count = 0;

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

while ($row = mysqli_fetch_array($query)) {
    $count++;
    $countStart++;
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

    $sqlemp = "SELECT id, regular_payslip_basic_pay FROM hurtajadmin_regular_payslip WHERE employee_id = '$empid' AND regular_payslip_date_cycle_month = '$month' AND regular_payslip_date_cycle_cycle = '1' AND regular_payslip_date_cycle_year = '$year'";
    $queryemp = mysqli_query($db_conn, $sqlemp);

    while ($rowemp = mysqli_fetch_array($queryemp)) {
        $regular_payslip_basic_pay = $rowemp["regular_payslip_basic_pay"];
        if ($regular_payslip_basic_pay > 526.80 && $regular_payslip_basic_pay > 0) {
            $ec = 30;
        } else if ($regular_payslip_basic_pay < 526.81 && $regular_payslip_basic_pay > 0) {
            $ec = 10;
        } else {
            $ec = 0;
        }
    }

    //new computation
    $sqlsss1 = "SELECT SUM(regular_payslip_sss_cont) AS total FROM hurtajadmin_regular_payslip WHERE employee_id = '$empid' AND regular_payslip_date_cycle_month = '$month' AND regular_payslip_date_cycle_cycle = '1' AND regular_payslip_date_cycle_year = '$year'";
    $querysss1 = mysqli_query($db_conn, $sqlsss1);
    $countsss1 = mysqli_num_rows($querysss1);
    if ($countsss1 > 0) {
        while ($rowsss1 = mysqli_fetch_array($querysss1)) {
            $ssscont1 = $rowsss1["total"];
        }
    }

    $sqlsss2 = "SELECT SUM(regular_payslip_sss_cont) AS total FROM hurtajadmin_regular_payslip WHERE employee_id = '$empid' AND regular_payslip_date_cycle_month = '$month' AND regular_payslip_date_cycle_cycle = '2' AND regular_payslip_date_cycle_year = '$year'";
    $querysss2 = mysqli_query($db_conn, $sqlsss2);
    $countsss2 = mysqli_num_rows($querysss2);
    if ($countsss2 > 0) {
        while ($rowsss2 = mysqli_fetch_array($querysss2)) {
            $ssscont2 = $rowsss2["total"];
        }
    }

    $sqlpagibig1 = "SELECT SUM(regular_payslip_pagibig_cont) AS total FROM hurtajadmin_regular_payslip WHERE employee_id = '$empid' AND regular_payslip_date_cycle_month = '$month' AND regular_payslip_date_cycle_cycle = '1' AND regular_payslip_date_cycle_year = '$year'";
    $querypagibig1 = mysqli_query($db_conn, $sqlpagibig1);
    $countpagibig1 = mysqli_num_rows($querypagibig1);
    if ($countpagibig1 > 0) {
        while ($rowpagibig1 = mysqli_fetch_array($querypagibig1)) {
            $pagibigcont1 = $rowpagibig1["total"];
        }
    }

    $sqlpagibig2 = "SELECT SUM(regular_payslip_pagibig_cont) AS total FROM hurtajadmin_regular_payslip WHERE employee_id = '$empid' AND regular_payslip_date_cycle_month = '$month' AND regular_payslip_date_cycle_cycle = '2' AND regular_payslip_date_cycle_year = '$year'";
    $querypagibig2 = mysqli_query($db_conn, $sqlpagibig2);
    $countpagibig2 = mysqli_num_rows($querypagibig2);
    if ($countpagibig2 > 0) {
        while ($rowpagibig2 = mysqli_fetch_array($querypagibig2)) {
            $pagibigcont2 = $rowpagibig2["total"];
        }
    }

    $sqlphilhealth1 = "SELECT SUM(regular_payslip_philhealth_cont) AS total FROM hurtajadmin_regular_payslip WHERE employee_id = '$empid' AND regular_payslip_date_cycle_month = '$month' AND regular_payslip_date_cycle_cycle = '1' AND regular_payslip_date_cycle_year = '$year'";
    $queryphilhealth1 = mysqli_query($db_conn, $sqlphilhealth1);
    $countphilhealth1 = mysqli_num_rows($queryphilhealth1);
    if ($countphilhealth1 > 0) {
        while ($rowphilhealth1 = mysqli_fetch_array($queryphilhealth1)) {
            $philhealthcont1 = $rowphilhealth1["total"];
        }
    }

    $sqlphilhealth2 = "SELECT SUM(regular_payslip_philhealth_cont) AS total FROM hurtajadmin_regular_payslip WHERE employee_id = '$empid' AND regular_payslip_date_cycle_month = '$month' AND regular_payslip_date_cycle_cycle = '2' AND regular_payslip_date_cycle_year = '$year'";
    $queryphilhealth2 = mysqli_query($db_conn, $sqlphilhealth2);
    $countphilhealth2 = mysqli_num_rows($queryphilhealth2);
    if ($countphilhealth2 > 0) {
        while ($rowphilhealth2 = mysqli_fetch_array($queryphilhealth2)) {
            $philhealthcont2 = $rowphilhealth2["total"];
        }
    }

    $sqltax1 = "SELECT SUM(regular_payslip_tax_cont) AS total FROM hurtajadmin_regular_payslip WHERE employee_id = '$empid' AND regular_payslip_date_cycle_month = '$month' AND regular_payslip_date_cycle_cycle = '1' AND regular_payslip_date_cycle_year = '$year'";
    $querytax1 = mysqli_query($db_conn, $sqltax1);
    $counttax1 = mysqli_num_rows($querytax1);
    if ($counttax1 > 0) {
        while ($rowtax1 = mysqli_fetch_array($querytax1)) {
            $taxcont1 = $rowtax1["total"];
        }
    }

    $sqltax2 = "SELECT SUM(regular_payslip_tax_cont) AS total FROM hurtajadmin_regular_payslip WHERE employee_id = '$empid' AND regular_payslip_date_cycle_month = '$month' AND regular_payslip_date_cycle_cycle = '2' AND regular_payslip_date_cycle_year = '$year'";
    $querytax2 = mysqli_query($db_conn, $sqltax2);
    $counttax2 = mysqli_num_rows($querytax2);
    if ($counttax2 > 0) {
        while ($rowtax2 = mysqli_fetch_array($querytax2)) {
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

    $ssseegrandtotal = $ssseegrandtotal + (($ssscont1) + ($ssscont2));
    $sssergrandtotal = $sssergrandtotal + ($ssscont1) + ($ssscont2) * 2;

    $sssecgrandtotal = $sssecgrandtotal + $ec;
    $pagibigemployergrandtotal = $pagibigemployergrandtotal + (($pagibigcont1) + ($pagibigcont2));
    $philhealthemployergrandtotal = $philhealthemployergrandtotal + (($philhealthcont1) + ($philhealthcont2));
    $sssgrandtotal = $sssgrandtotal + (((($ssscont1) + ($ssscont2)) * 2) + $ec);
    $pagibiggrandtotal = $pagibiggrandtotal + (($pagibigcont1 + $pagibigcont2) * 2);
    $philhealthgrandtotal = $philhealthgrandtotal + (($philhealthcont1 + $philhealthcont2) * 2);

    $excel->setActiveSheetIndex(0)
        ->setCellValue('A' . $countStart, $fname . ' ' . $mnameinitial . '. ' . $lname)
        ->getStyle('A' . $countStart)
        ->applyFromArray($tableHeaderStyleFontBlackCalibri);

    $excel->setActiveSheetIndex(0)
        ->getStyle('A' . $countStart)
        ->applyFromArray($centerText);

    $excel->setActiveSheetIndex(0)
        ->getStyle('A' . $countStart)
        ->applyFromArray($borderThin);

    $excel->setActiveSheetIndex(0)
        ->setCellValue('B' . $countStart, $monthtext . ', ' . $year)
        ->getStyle('B' . $countStart)
        ->applyFromArray($tableHeaderStyleFontBlackCalibri);

    $excel->setActiveSheetIndex(0)
        ->getStyle('B' . $countStart)
        ->applyFromArray($centerText);

    $excel->setActiveSheetIndex(0)
        ->getStyle('B' . $countStart)
        ->applyFromArray($borderThin);

    $excel->setActiveSheetIndex(0)
        ->setCellValue('C' . $countStart, number_format($ssscont1, 2, '.', ','))
        ->getStyle('C' . $countStart)
        ->applyFromArray($tableHeaderStyleFontBlackCalibri);

    $excel->setActiveSheetIndex(0)
        ->getStyle('C' . $countStart)
        ->applyFromArray($centerText);

    $excel->setActiveSheetIndex(0)
        ->getStyle('C' . $countStart)
        ->applyFromArray($borderThin);

    $excel->setActiveSheetIndex(0)
        ->setCellValue('D' . $countStart, number_format($ssscont2, 2, '.', ','))
        ->getStyle('D' . $countStart)
        ->applyFromArray($tableHeaderStyleFontBlackCalibri);

    $excel->setActiveSheetIndex(0)
        ->getStyle('D' . $countStart)
        ->applyFromArray($centerText);

    $excel->setActiveSheetIndex(0)
        ->getStyle('D' . $countStart)
        ->applyFromArray($borderThin);

    $excel->setActiveSheetIndex(0)
        ->setCellValue('E' . $countStart, number_format($pagibigcont1, 2, '.', ','))
        ->getStyle('E' . $countStart)
        ->applyFromArray($tableHeaderStyleFontBlackCalibri);

    $excel->setActiveSheetIndex(0)
        ->getStyle('E' . $countStart)
        ->applyFromArray($centerText);

    $excel->setActiveSheetIndex(0)
        ->getStyle('E' . $countStart)
        ->applyFromArray($borderThin);

    $excel->setActiveSheetIndex(0)
        ->setCellValue('F' . $countStart, number_format($pagibigcont2, 2, '.', ','))
        ->getStyle('F' . $countStart)
        ->applyFromArray($tableHeaderStyleFontBlackCalibri);

    $excel->setActiveSheetIndex(0)
        ->getStyle('F' . $countStart)
        ->applyFromArray($centerText);

    $excel->setActiveSheetIndex(0)
        ->getStyle('F' . $countStart)
        ->applyFromArray($borderThin);

    $excel->setActiveSheetIndex(0)
        ->setCellValue('G' . $countStart, number_format($philhealthcont1, 2, '.', ','))
        ->getStyle('G' . $countStart)
        ->applyFromArray($tableHeaderStyleFontBlackCalibri);

    $excel->setActiveSheetIndex(0)
        ->getStyle('G' . $countStart)
        ->applyFromArray($centerText);

    $excel->setActiveSheetIndex(0)
        ->getStyle('G' . $countStart)
        ->applyFromArray($borderThin);

    $excel->setActiveSheetIndex(0)
        ->setCellValue('H' . $countStart, number_format($philhealthcont2, 2, '.', ','))
        ->getStyle('H' . $countStart)
        ->applyFromArray($tableHeaderStyleFontBlackCalibri);

    $excel->setActiveSheetIndex(0)
        ->getStyle('H' . $countStart)
        ->applyFromArray($centerText);

    $excel->setActiveSheetIndex(0)
        ->getStyle('H' . $countStart)
        ->applyFromArray($borderThin);

    $excel->setActiveSheetIndex(0)
        ->setCellValue('I' . $countStart, number_format($taxcont1, 2, '.', ','))
        ->getStyle('I' . $countStart)
        ->applyFromArray($tableHeaderStyleFontBlackCalibri);

    $excel->setActiveSheetIndex(0)
        ->getStyle('I' . $countStart)
        ->applyFromArray($centerText);

    $excel->setActiveSheetIndex(0)
        ->getStyle('I' . $countStart)
        ->applyFromArray($borderThin);

    $excel->setActiveSheetIndex(0)
        ->setCellValue('J' . $countStart, number_format($taxcont2, 2, '.', ','))
        ->getStyle('J' . $countStart)
        ->applyFromArray($tableHeaderStyleFontBlackCalibri);

    $excel->setActiveSheetIndex(0)
        ->getStyle('J' . $countStart)
        ->applyFromArray($centerText);

    $excel->setActiveSheetIndex(0)
        ->getStyle('J' . $countStart)
        ->applyFromArray($borderThin);

    // K IS NOT INCLUDED

    $excel->setActiveSheetIndex(0)
        ->setCellValue('L' . $countStart, number_format(($ssscont1) + ($ssscont2), 2, '.', ','))
        ->getStyle('L' . $countStart)
        ->applyFromArray($tableHeaderStyleFontBlackCalibri);

    $excel->setActiveSheetIndex(0)
        ->getStyle('L' . $countStart)
        ->applyFromArray($centerText);

    $excel->setActiveSheetIndex(0)
        ->getStyle('L' . $countStart)
        ->applyFromArray($borderThin);

    $excel->setActiveSheetIndex(0)
        ->setCellValue('M' . $countStart, number_format(($ssscont1) + ($ssscont2) * 2, 2, '.', ','))
        ->getStyle('M' . $countStart)
        ->applyFromArray($tableHeaderStyleFontBlackCalibri);

    $excel->setActiveSheetIndex(0)
        ->getStyle('M' . $countStart)
        ->applyFromArray($centerText);

    $excel->setActiveSheetIndex(0)
        ->getStyle('M' . $countStart)
        ->applyFromArray($borderThin);

    $excel->setActiveSheetIndex(0)
        ->setCellValue('N' . $countStart, number_format($ec, 2, '.', ','))
        ->getStyle('N' . $countStart)
        ->applyFromArray($tableHeaderStyleFontBlackCalibri);

    $excel->setActiveSheetIndex(0)
        ->getStyle('N' . $countStart)
        ->applyFromArray($centerText);

    $excel->setActiveSheetIndex(0)
        ->getStyle('N' . $countStart)
        ->applyFromArray($borderThin);

    $excel->setActiveSheetIndex(0)
        ->setCellValue('O' . $countStart, number_format(($pagibigcont1) + ($pagibigcont2), 2, '.', ','))
        ->getStyle('O' . $countStart)
        ->applyFromArray($tableHeaderStyleFontBlackCalibri);

    $excel->setActiveSheetIndex(0)
        ->getStyle('O' . $countStart)
        ->applyFromArray($centerText);

    $excel->setActiveSheetIndex(0)
        ->getStyle('O' . $countStart)
        ->applyFromArray($borderThin);

    $excel->setActiveSheetIndex(0)
        ->setCellValue('P' . $countStart, number_format(($philhealthcont1) + ($philhealthcont2), 2, '.', ','))
        ->getStyle('P' . $countStart)
        ->applyFromArray($tableHeaderStyleFontBlackCalibri);

    $excel->setActiveSheetIndex(0)
        ->getStyle('P' . $countStart)
        ->applyFromArray($centerText);

    $excel->setActiveSheetIndex(0)
        ->getStyle('P' . $countStart)
        ->applyFromArray($borderThin);

    // Q IS NOT INCLUDED

    $excel->setActiveSheetIndex(0)
        ->setCellValue('R' . $countStart, number_format(((($ssscont1) + ($ssscont2)) * 2) + $ec, 2, '.', ','))
        ->getStyle('R' . $countStart)
        ->applyFromArray($tableHeaderStyleFontBlackCalibri);

    $excel->setActiveSheetIndex(0)
        ->getStyle('R' . $countStart)
        ->applyFromArray($centerText);

    $excel->setActiveSheetIndex(0)
        ->getStyle('R' . $countStart)
        ->applyFromArray($borderThin);

    $excel->setActiveSheetIndex(0)
        ->setCellValue('S' . $countStart, number_format(($pagibigcont1 + $pagibigcont2) * 2, 2, '.', ','))
        ->getStyle('S' . $countStart)
        ->applyFromArray($tableHeaderStyleFontBlackCalibri);

    $excel->setActiveSheetIndex(0)
        ->getStyle('S' . $countStart)
        ->applyFromArray($centerText);

    $excel->setActiveSheetIndex(0)
        ->getStyle('S' . $countStart)
        ->applyFromArray($borderThin);

    $excel->setActiveSheetIndex(0)
        ->setCellValue('T' . $countStart, number_format(($philhealthcont1 + $philhealthcont2) * 2, 2, '.', ','))
        ->getStyle('T' . $countStart)
        ->applyFromArray($tableHeaderStyleFontBlackCalibri);

    $excel->setActiveSheetIndex(0)
        ->getStyle('T' . $countStart)
        ->applyFromArray($centerText);

    $excel->setActiveSheetIndex(0)
        ->getStyle('T' . $countStart)
        ->applyFromArray($borderThin);

}

$countStart++;

// TOTAL

$excel->setActiveSheetIndex(0)
    ->setCellValue('A' . $countStart, 'TOTAL')
    ->getStyle('A' . $countStart)
    ->applyFromArray($tableHeaderStyleFontBlackBoldCalibriSmall);

$excel->setActiveSheetIndex(0)
    ->getStyle('A' . $countStart)
    ->applyFromArray($centerText);

$excel->setActiveSheetIndex(0)
    ->getStyle('A' . $countStart)
    ->applyFromArray($borderMedium);

$excel->setActiveSheetIndex(0)
    ->setCellValue('B' . $countStart, '')
    ->getStyle('B' . $countStart)
    ->applyFromArray($tableHeaderStyleFontBlackBoldCalibriSmall);

$excel->setActiveSheetIndex(0)
    ->getStyle('B' . $countStart)
    ->applyFromArray($centerText);

$excel->setActiveSheetIndex(0)
    ->getStyle('B' . $countStart)
    ->applyFromArray($borderMedium);

$excel->setActiveSheetIndex(0)
    ->setCellValue('C' . $countStart, number_format($ssscontgrandtotal1, 2, '.', ','))
    ->getStyle('C' . $countStart)
    ->applyFromArray($tableHeaderStyleFontBlackBoldCalibriSmall);

$excel->setActiveSheetIndex(0)
    ->getStyle('C' . $countStart)
    ->applyFromArray($centerText);

$excel->setActiveSheetIndex(0)
    ->getStyle('C' . $countStart)
    ->applyFromArray($borderMedium);

$excel->setActiveSheetIndex(0)
    ->setCellValue('D' . $countStart, number_format($ssscontgrandtotal2, 2, '.', ','))
    ->getStyle('D' . $countStart)
    ->applyFromArray($tableHeaderStyleFontBlackBoldCalibriSmall);

$excel->setActiveSheetIndex(0)
    ->getStyle('D' . $countStart)
    ->applyFromArray($centerText);

$excel->setActiveSheetIndex(0)
    ->getStyle('D' . $countStart)
    ->applyFromArray($borderMedium);

$excel->setActiveSheetIndex(0)
    ->setCellValue('E' . $countStart, number_format($pagibiggrandtotal1, 2, '.', ','))
    ->getStyle('E' . $countStart)
    ->applyFromArray($tableHeaderStyleFontBlackBoldCalibriSmall);

$excel->setActiveSheetIndex(0)
    ->getStyle('E' . $countStart)
    ->applyFromArray($centerText);

$excel->setActiveSheetIndex(0)
    ->getStyle('E' . $countStart)
    ->applyFromArray($borderMedium);

$excel->setActiveSheetIndex(0)
    ->setCellValue('F' . $countStart, number_format($pagibiggrandtotal2, 2, '.', ','))
    ->getStyle('F' . $countStart)
    ->applyFromArray($tableHeaderStyleFontBlackBoldCalibriSmall);

$excel->setActiveSheetIndex(0)
    ->getStyle('F' . $countStart)
    ->applyFromArray($centerText);

$excel->setActiveSheetIndex(0)
    ->getStyle('F' . $countStart)
    ->applyFromArray($borderMedium);

$excel->setActiveSheetIndex(0)
    ->setCellValue('G' . $countStart, number_format($philhealthgrandtotal1, 2, '.', ','))
    ->getStyle('G' . $countStart)
    ->applyFromArray($tableHeaderStyleFontBlackBoldCalibriSmall);

$excel->setActiveSheetIndex(0)
    ->getStyle('G' . $countStart)
    ->applyFromArray($centerText);

$excel->setActiveSheetIndex(0)
    ->getStyle('G' . $countStart)
    ->applyFromArray($borderMedium);

$excel->setActiveSheetIndex(0)
    ->setCellValue('H' . $countStart, number_format($philhealthgrandtotal2, 2, '.', ','))
    ->getStyle('H' . $countStart)
    ->applyFromArray($tableHeaderStyleFontBlackBoldCalibriSmall);

$excel->setActiveSheetIndex(0)
    ->getStyle('H' . $countStart)
    ->applyFromArray($centerText);

$excel->setActiveSheetIndex(0)
    ->getStyle('H' . $countStart)
    ->applyFromArray($borderMedium);

$excel->setActiveSheetIndex(0)
    ->setCellValue('I' . $countStart, number_format($taxcontgrandtotal1, 2, '.', ','))
    ->getStyle('I' . $countStart)
    ->applyFromArray($tableHeaderStyleFontBlackBoldCalibriSmall);

$excel->setActiveSheetIndex(0)
    ->getStyle('I' . $countStart)
    ->applyFromArray($centerText);

$excel->setActiveSheetIndex(0)
    ->getStyle('I' . $countStart)
    ->applyFromArray($borderMedium);

$excel->setActiveSheetIndex(0)
    ->setCellValue('J' . $countStart, number_format($taxcontgrandtotal2, 2, '.', ','))
    ->getStyle('J' . $countStart)
    ->applyFromArray($tableHeaderStyleFontBlackBoldCalibriSmall);

$excel->setActiveSheetIndex(0)
    ->getStyle('J' . $countStart)
    ->applyFromArray($centerText);

$excel->setActiveSheetIndex(0)
    ->getStyle('J' . $countStart)
    ->applyFromArray($borderMedium);

// K IS NOT INCLUDED

$excel->setActiveSheetIndex(0)
    ->setCellValue('L' . $countStart, number_format($ssseegrandtotal, 2, '.', ','))
    ->getStyle('L' . $countStart)
    ->applyFromArray($tableHeaderStyleFontBlackBoldCalibriSmall);

$excel->setActiveSheetIndex(0)
    ->getStyle('L' . $countStart)
    ->applyFromArray($centerText);

$excel->setActiveSheetIndex(0)
    ->getStyle('L' . $countStart)
    ->applyFromArray($borderMedium);

$excel->setActiveSheetIndex(0)
    ->setCellValue('M' . $countStart, number_format($sssergrandtotal, 2, '.', ','))
    ->getStyle('M' . $countStart)
    ->applyFromArray($tableHeaderStyleFontBlackBoldCalibriSmall);

$excel->setActiveSheetIndex(0)
    ->getStyle('M' . $countStart)
    ->applyFromArray($centerText);

$excel->setActiveSheetIndex(0)
    ->getStyle('M' . $countStart)
    ->applyFromArray($borderMedium);

$excel->setActiveSheetIndex(0)
    ->setCellValue('N' . $countStart, number_format($sssecgrandtotal, 2, '.', ','))
    ->getStyle('N' . $countStart)
    ->applyFromArray($tableHeaderStyleFontBlackBoldCalibriSmall);

$excel->setActiveSheetIndex(0)
    ->getStyle('N' . $countStart)
    ->applyFromArray($centerText);

$excel->setActiveSheetIndex(0)
    ->getStyle('N' . $countStart)
    ->applyFromArray($borderMedium);

$excel->setActiveSheetIndex(0)
    ->setCellValue('O' . $countStart, number_format($pagibigemployergrandtotal, 2, '.', ','))
    ->getStyle('O' . $countStart)
    ->applyFromArray($tableHeaderStyleFontBlackBoldCalibriSmall);

$excel->setActiveSheetIndex(0)
    ->getStyle('O' . $countStart)
    ->applyFromArray($centerText);

$excel->setActiveSheetIndex(0)
    ->getStyle('O' . $countStart)
    ->applyFromArray($borderMedium);

$excel->setActiveSheetIndex(0)
    ->setCellValue('P' . $countStart, number_format($philhealthemployergrandtotal, 2, '.', ','))
    ->getStyle('P' . $countStart)
    ->applyFromArray($tableHeaderStyleFontBlackBoldCalibriSmall);

$excel->setActiveSheetIndex(0)
    ->getStyle('P' . $countStart)
    ->applyFromArray($centerText);

$excel->setActiveSheetIndex(0)
    ->getStyle('P' . $countStart)
    ->applyFromArray($borderMedium);

// Q IS NOT INCLUDED

$excel->setActiveSheetIndex(0)
    ->setCellValue('R' . $countStart, number_format($sssgrandtotal, 2, '.', ','))
    ->getStyle('R' . $countStart)
    ->applyFromArray($tableHeaderStyleFontBlackBoldCalibriSmall);

$excel->setActiveSheetIndex(0)
    ->getStyle('R' . $countStart)
    ->applyFromArray($centerText);

$excel->setActiveSheetIndex(0)
    ->getStyle('R' . $countStart)
    ->applyFromArray($borderMedium);

$excel->setActiveSheetIndex(0)
    ->setCellValue('S' . $countStart, number_format($pagibiggrandtotal, 2, '.', ','))
    ->getStyle('S' . $countStart)
    ->applyFromArray($tableHeaderStyleFontBlackBoldCalibriSmall);

$excel->setActiveSheetIndex(0)
    ->getStyle('S' . $countStart)
    ->applyFromArray($centerText);

$excel->setActiveSheetIndex(0)
    ->getStyle('S' . $countStart)
    ->applyFromArray($borderMedium);

$excel->setActiveSheetIndex(0)
    ->setCellValue('T' . $countStart, number_format($philhealthgrandtotal, 2, '.', ','))
    ->getStyle('T' . $countStart)
    ->applyFromArray($tableHeaderStyleFontBlackBoldCalibriSmall);

$excel->setActiveSheetIndex(0)
    ->getStyle('T' . $countStart)
    ->applyFromArray($centerText);

$excel->setActiveSheetIndex(0)
    ->getStyle('T' . $countStart)
    ->applyFromArray($borderMedium);

// GRAND TOTAL

$countStart = $countStart+2;

$excel->setActiveSheetIndex(0)
    ->setCellValue('A' . $countStart, 'SSS Total Contribution')
    ->getStyle('A' . $countStart)
    ->applyFromArray($tableHeaderStyleFontBlackBoldCalibriSmall);

    $excel->setActiveSheetIndex(0)
    ->setCellValueExplicit('B' . $countStart, number_format($sssgrandtotal, 2, '.', ','),PHPExcel_Cell_DataType::TYPE_STRING)
    ->getStyle('B' . $countStart)
    ->applyFromArray($tableHeaderStyleFontBlackBoldCalibri);

$excel->setActiveSheetIndex(0)
    ->getStyle('B' . $countStart)
    ->applyFromArray($centerText);

$countStart++;

$excel->setActiveSheetIndex(0)
    ->setCellValue('A' . $countStart, 'Pag-ibig Total Contribution')
    ->getStyle('A' . $countStart)
    ->applyFromArray($tableHeaderStyleFontBlackBoldCalibriSmall);

    $excel->setActiveSheetIndex(0)
    ->setCellValueExplicit('B' . $countStart, number_format($pagibiggrandtotal, 2, '.', ','),PHPExcel_Cell_DataType::TYPE_STRING)
    ->getStyle('B' . $countStart)
    ->applyFromArray($tableHeaderStyleFontBlackBoldCalibri);

$excel->setActiveSheetIndex(0)
    ->getStyle('B' . $countStart)
    ->applyFromArray($centerText);

    $countStart++;

    $excel->setActiveSheetIndex(0)
        ->setCellValue('A' . $countStart, 'Philhealth Total Contribution')
        ->getStyle('A' . $countStart)
        ->applyFromArray($tableHeaderStyleFontBlackBoldCalibriSmall);
    
        $excel->setActiveSheetIndex(0)
        ->setCellValueExplicit('B' . $countStart, number_format($philhealthgrandtotal, 2, '.', ','),PHPExcel_Cell_DataType::TYPE_STRING)
        ->getStyle('B' . $countStart)
        ->applyFromArray($tableHeaderStyleFontBlackBoldCalibri);
    
    $excel->setActiveSheetIndex(0)
        ->getStyle('B' . $countStart)
        ->applyFromArray($centerText);

    $countStart++;

    $excel->setActiveSheetIndex(0)
        ->setCellValue('A' . $countStart, 'Withholding Tax')
        ->getStyle('A' . $countStart)
        ->applyFromArray($tableHeaderStyleFontBlackBoldCalibriSmall);
    
        $excel->setActiveSheetIndex(0)
        ->setCellValueExplicit('B' . $countStart, number_format($taxcontgrandtotal1, 2, '.', ','),PHPExcel_Cell_DataType::TYPE_STRING)
        ->getStyle('B' . $countStart)
        ->applyFromArray($tableHeaderStyleFontBlackBoldCalibri);
    
    $excel->setActiveSheetIndex(0)
        ->getStyle('B' . $countStart)
        ->applyFromArray($centerText);

        $countStart = $countStart+2;

        $excel->setActiveSheetIndex(0)
            ->setCellValue('A' . $countStart, 'GRAND TOTAL')
            ->getStyle('A' . $countStart)
            ->applyFromArray($tableHeaderStyleFontBlackBoldCalibriSmall);

            $excel->setActiveSheetIndex(0)
    ->getStyle('A' . $countStart)
    ->applyFromArray($borderMedium);
        
            $excel->setActiveSheetIndex(0)
            ->setCellValueExplicit('B' . $countStart, number_format($sssgrandtotal+$pagibiggrandtotal+$philhealthgrandtotal+$taxcontgrandtotal1, 2, '.', ','),PHPExcel_Cell_DataType::TYPE_STRING)
            ->getStyle('B' . $countStart)
            ->applyFromArray($tableHeaderStyleFontBlackBoldCalibri);
            
        
        $excel->setActiveSheetIndex(0)
            ->getStyle('B' . $countStart)
            ->applyFromArray($centerText);

            $excel->setActiveSheetIndex(0)
    ->getStyle('B' . $countStart)
    ->applyFromArray($borderMedium);

header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment; filename="Summary.xlsx"');
header('Cache-Control: max-age=0');
$file = PHPExcel_IOFactory::createWriter($excel, 'Excel2007');
$file->save('php://output');
