<?php
include_once("../include/loginstatus.php");
require_once '../library/PHPExcel/Classes/PHPExcel.php';
header('Content-Type: text/html; charset=ISO-8859-1');
ini_set('max_execution_time', 19200); //300 sedb_connds = 5 minutes
ini_set('memory_limit', '-1');


$excel = new PHPExcel();

//SHEET NAME

$excel -> setActiveSheetIndex(0) 
        -> setTitle('FOR MATURITY (UNPAID)');

//STYLE

$textStyle1 = array(
        'font'  => array(
            'bold'  => true,
            'color' => array('rgb' => '000000'),
            'size'  => 14,
            'name'  => 'Gill Sans MT'
        ));

$textStyle2 = array(
    'font'  => array(
        'bold'  => false,
        'color' => array('rgb' => '000000'),
        'size'  => 11,
        'name'  => 'Gill Sans MT'
    ));

$textStyle3 = array(
        'font'  => array(
            'bold'  => true,
            'color' => array('rgb' => '000000'),
            'size'  => 11,
            'name'  => 'Gill Sans MT'
        ));

$centerText = array(
        'alignment' => array(
            'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER
        )
    );

$leftText = array(
        'alignment' => array(
            'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_LEFT
        )
    );

$rightText = array(
        'alignment' => array(
            'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_RIGHT
        )
    );

$border = array(
  'borders' => array(
    'allborders' => array(
      'style' => PHPExcel_Style_Border::BORDER_THIN
    )
  )
);

// GET

$from = $_GET['from'];
$to = $_GET['to'];

// $from = "May 2018";
// $to = "July 2018";

$datetimefrom = date("Y-m-d H:i:s", strtotime($from));
$datetimeto = date("Y-m-d H:i:s", strtotime($to));

// HEADER  

$excel -> setActiveSheetIndex(0)
        -> mergeCells('A1:D1');

$excel -> setActiveSheetIndex(0) 
        -> setCellValue('A1','COLLECTIBLES')
        -> getStyle('A1')
        -> applyFromArray($textStyle1);

$excel -> setActiveSheetIndex(0)
        -> mergeCells('A2:E2');

$excel -> setActiveSheetIndex(0) 
        -> setCellValue('A2','FOR THE MONTH OF '.strtoupper($from).' AND '.strtoupper($to))
        -> getStyle('A2')
        -> applyFromArray($textStyle2);

// TABLE HEADER

$excel -> setActiveSheetIndex(0) 
        -> setCellValue('A4','NO.')
        -> getStyle('A4')
        -> applyFromArray($textStyle3);

$excel -> setActiveSheetIndex(0) 
        -> getStyle('A4')
        -> applyFromArray($centerText);

$excel -> setActiveSheetIndex(0) 
        -> getStyle('A4')
        -> applyFromArray($border);

        $excel -> setActiveSheetIndex(0) 
        -> setCellValue('B4','CLIENT/COMPANY')
        -> getStyle('B4')
        -> applyFromArray($textStyle3);

$excel -> setActiveSheetIndex(0) 
        -> getStyle('B4')
        -> applyFromArray($centerText);

$excel -> setActiveSheetIndex(0) 
        -> getStyle('B4')
        -> applyFromArray($border);

        $excel -> setActiveSheetIndex(0) 
        -> setCellValue('C4','TOTAL AMOUNT')
        -> getStyle('C4')
        -> applyFromArray($textStyle3);

$excel -> setActiveSheetIndex(0) 
        -> getStyle('C4')
        -> applyFromArray($centerText);

$excel -> setActiveSheetIndex(0) 
        -> getStyle('C4')
        -> applyFromArray($border);

        $excel -> setActiveSheetIndex(0) 
        -> setCellValue('D4','P.O NO.')
        -> getStyle('D4')
        -> applyFromArray($textStyle3);

$excel -> setActiveSheetIndex(0) 
        -> getStyle('D4')
        -> applyFromArray($centerText);

$excel -> setActiveSheetIndex(0) 
        -> getStyle('D4')
        -> applyFromArray($border);

        $excel -> setActiveSheetIndex(0) 
        -> setCellValue('E4','INVOICE NO.')
        -> getStyle('E4')
        -> applyFromArray($textStyle3);

$excel -> setActiveSheetIndex(0) 
        -> getStyle('E4')
        -> applyFromArray($centerText);

$excel -> setActiveSheetIndex(0) 
        -> getStyle('E4')
        -> applyFromArray($border);

        $excel -> setActiveSheetIndex(0) 
        -> setCellValue('F4','INVOICE DATE')
        -> getStyle('F4')
        -> applyFromArray($textStyle3);

$excel -> setActiveSheetIndex(0) 
        -> getStyle('F4')
        -> applyFromArray($centerText);

$excel -> setActiveSheetIndex(0) 
        -> getStyle('F4')
        -> applyFromArray($border);

        $excel -> setActiveSheetIndex(0) 
        -> setCellValue('G4','MATURITY DATE')
        -> getStyle('G4')
        -> applyFromArray($textStyle3);

$excel -> setActiveSheetIndex(0) 
        -> getStyle('G4')
        -> applyFromArray($centerText);

$excel -> setActiveSheetIndex(0) 
        -> getStyle('G4')
        -> applyFromArray($border);

        $excel -> setActiveSheetIndex(0) 
        -> setCellValue('H4','DR NO.')
        -> getStyle('H4')
        -> applyFromArray($textStyle3);

$excel -> setActiveSheetIndex(0) 
        -> getStyle('H4')
        -> applyFromArray($centerText);

$excel -> setActiveSheetIndex(0) 
        -> getStyle('H4')
        -> applyFromArray($border);

        $excel -> setActiveSheetIndex(0) 
        -> setCellValue('I4','DELIVERY DATE')
        -> getStyle('I4')
        -> applyFromArray($textStyle3);

$excel -> setActiveSheetIndex(0) 
        -> getStyle('I4')
        -> applyFromArray($centerText);

$excel -> setActiveSheetIndex(0) 
        -> getStyle('I4')
        -> applyFromArray($border);

        $excel -> setActiveSheetIndex(0) 
        -> setCellValue('J4','REMARKS/PAID')
        -> getStyle('J4')
        -> applyFromArray($textStyle3);

$excel -> setActiveSheetIndex(0) 
        -> getStyle('J4')
        -> applyFromArray($centerText);

$excel -> setActiveSheetIndex(0) 
        -> getStyle('J4')
        -> applyFromArray($border);

        $excel -> setActiveSheetIndex(0) 
        -> setCellValue('K4','OR NO.')
        -> getStyle('K4')
        -> applyFromArray($textStyle3);

$excel -> setActiveSheetIndex(0) 
        -> getStyle('K4')
        -> applyFromArray($centerText);

$excel -> setActiveSheetIndex(0) 
        -> getStyle('K4')
        -> applyFromArray($border);

        $excel -> setActiveSheetIndex(0) 
        -> setCellValue('L4','OR DATE')
        -> getStyle('L4')
        -> applyFromArray($textStyle3);

$excel -> setActiveSheetIndex(0) 
        -> getStyle('L4')
        -> applyFromArray($centerText);

$excel -> setActiveSheetIndex(0) 
        -> getStyle('L4')
        -> applyFromArray($border);

$excel->setActiveSheetIndex(0)->getRowDimension('4')->setRowHeight(30);
$excel->setActiveSheetIndex(0)->getColumnDimension('A')->setWidth(7);
$excel->setActiveSheetIndex(0)->getColumnDimension('B')->setWidth(80);
$excel->setActiveSheetIndex(0)->getColumnDimension('C')->setWidth(20);
$excel->setActiveSheetIndex(0)->getColumnDimension('D')->setWidth(20);
$excel->setActiveSheetIndex(0)->getColumnDimension('E')->setWidth(20);
$excel->setActiveSheetIndex(0)->getColumnDimension('F')->setWidth(20);
$excel->setActiveSheetIndex(0)->getColumnDimension('G')->setWidth(20);
$excel->setActiveSheetIndex(0)->getColumnDimension('H')->setWidth(20);
$excel->setActiveSheetIndex(0)->getColumnDimension('I')->setWidth(20);
$excel->setActiveSheetIndex(0)->getColumnDimension('J')->setWidth(20);
$excel->setActiveSheetIndex(0)->getColumnDimension('K')->setWidth(20);
$excel->setActiveSheetIndex(0)->getColumnDimension('L')->setWidth(20);

// DATA LOOP

$count1 = 0;
$toInsert1 = array();
$data1 = array();
$grandtotalamount1 = 0;
$totalremarkspaid1 = 0;

$sql_unpaid = "SELECT hurtajadmin_collectibles.id
, hurtajadmin_collectibles.collectibles_total_amount
, hurtajadmin_collectibles.collectibles_po_number
, hurtajadmin_collectibles.collectibles_invoice_number
, hurtajadmin_collectibles.collectibles_invoice_date 
, hurtajadmin_collectibles.collectibles_maturity_date 
, hurtajadmin_collectibles.collectibles_dr_number 
, hurtajadmin_collectibles.collectibles_delivery_date 
, hurtajadmin_collectibles.collectibles_remarks_paid 
, hurtajadmin_collectibles.collectibles_or_number 
, hurtajadmin_collectibles.collectibles_or_date 
, hurtajadmin_collectibles.collectibles_date_added
, hurtajadmin_company.id AS company_id
, hurtajadmin_company.company_name  
FROM hurtajadmin_collectibles
LEFT JOIN hurtajadmin_company
ON hurtajadmin_collectibles.company_id=hurtajadmin_company.id
WHERE hurtajadmin_collectibles.collectibles_status = '1'
AND DATE(hurtajadmin_collectibles.collectibles_maturity_date) >= DATE('$datetimefrom')
AND DATE(hurtajadmin_collectibles.collectibles_maturity_date) <= DATE('$datetimeto')
ORDER BY hurtajadmin_company.company_name";
$query_unpaid = mysqli_query($db_conn, $sql_unpaid);

while ($row1 = mysqli_fetch_array($query_unpaid, MYSQLI_ASSOC)) {
        $count1++;

        $recid = $row1["id"];
        $companyid = $row1["company_id"];
        $companyname = $row1["company_name"];
        $totalamount = $row1["collectibles_total_amount"];
        $ponumber = $row1["collectibles_po_number"];
        $invoicenumber = $row1["collectibles_invoice_number"];
        $invoicedate = $row1["collectibles_invoice_date"];
        $maturitydate = $row1["collectibles_maturity_date"];
        $drnumber = $row1["collectibles_dr_number"];
        $deliverydate = $row1["collectibles_delivery_date"];
        $remarkspaid = $row1["collectibles_remarks_paid"];
        $ornumber = $row1["collectibles_or_number"];
        $ordate = $row1["collectibles_or_date"];
        $dateadded = $row1["collectibles_date_added"];

        $totalamount = str_replace('₱', '', $totalamount);

        $totalamounttoadd = str_replace(',', '', $totalamount);

        $grandtotalamount1 = $grandtotalamount1 + $totalamounttoadd;

        if (filter_var($remarkspaid, FILTER_VALIDATE_INT)) {
           $totalremarkspaid1 = $totalremarkspaid1 + $remarkspaid;
        }

        $now = time(); // or your date as well
        $your_date = strtotime($maturitydate);
        $datediff = $your_date - $now;
        $datediff = round($datediff / (60 * 60 * 24));

        $exceeddays = 0;
        $leftdays = 0;

        if($datediff < 0) {
            $exceeddays = abs($datediff);
        } else if($datediff > 0) {
            $leftdays = $datediff;
        }

        if($invoicedate != "" && $invoicedate != "1970-01-01 01:00:00" && $invoicedate != "0000-00-00 00:00:00") {
            $invoicedate = date("F d, Y", strtotime($invoicedate));
            $editinvoicedate = date("m/d/Y", strtotime($invoicedate));
        } else {
            $invoicedate = "";
            $editinvoicedate = "";
        }

        if($maturitydate != "" && $maturitydate != "1970-01-01 01:00:00" && $maturitydate != "0000-00-00 00:00:00") {
            $maturitydate = date("F d, Y", strtotime($maturitydate));
            $editmaturitydate = date("m/d/Y", strtotime($maturitydate));
        } else {
            $maturitydate = "";
            $editmaturitydate = "";
        }

        if($deliverydate != "" && $deliverydate != "1970-01-01 01:00:00" && $deliverydate != "0000-00-00 00:00:00") {
            $deliverydate = date("F d, Y", strtotime($deliverydate));
            $editdeliverydate = date("m/d/Y", strtotime($deliverydate));
        } else {
            $deliverydate = "";
            $editdeliverydate = "";
        }

        if($ordate != "" && $ordate != "1970-01-01 01:00:00" && $ordate != "0000-00-00 00:00:00") {
            $ordate = date("F d, Y", strtotime($ordate));
            $editordate = date("m/d/Y", strtotime($ordate));
        } else {
            $ordate = "";
            $editordate = "";
        }

        $dateadded = date("F d, Y", strtotime($dateadded));

        $data1 = array($count1,$companyname,$totalamount,$ponumber,$invoicenumber,$invoicedate,$maturitydate,$drnumber,$deliverydate,$remarkspaid,$ordate);
        array_push($toInsert1, $data1);

}

$textaligncount1 = $count1 + 4;

$excel -> getActiveSheet()
        -> getStyle('5:'.$textaligncount1)
        -> applyFromArray($textStyle2);

$excel -> getActiveSheet()
        -> getStyle('A5:A'.$textaligncount1)
        -> applyFromArray($centerText);

$excel -> getActiveSheet()
        -> getStyle('C5:C'.$textaligncount1)
        -> applyFromArray($leftText);

$excel -> getActiveSheet()
        -> getStyle('D5:D'.$textaligncount1)
        -> applyFromArray($leftText);
        
$excel -> getActiveSheet()
        -> getStyle('E5:E'.$textaligncount1)
        -> applyFromArray($centerText);

$excel -> getActiveSheet()
        -> getStyle('F5:F'.$textaligncount1)
        -> applyFromArray($rightText);

$excel -> getActiveSheet()
        -> getStyle('G5:G'.$textaligncount1)
        -> applyFromArray($rightText);

$excel -> getActiveSheet()
        -> getStyle('H5:H'.$textaligncount1)
        -> applyFromArray($leftText);

$excel -> getActiveSheet()
        -> getStyle('J5:J'.$textaligncount1)
        -> applyFromArray($centerText);

$excel -> getActiveSheet()
        -> getStyle('K5:K'.$textaligncount1)
        -> applyFromArray($centerText);

$excel -> getActiveSheet()
        -> fromArray($toInsert1, null, 'A5');

// FOOTER

$footercount1 = $count1 + 5;

$excel -> setActiveSheetIndex(0) 
        -> setCellValue('A'.$footercount1,'')
        -> getStyle('A'.$footercount1)
        -> applyFromArray($textStyle3);

$excel -> setActiveSheetIndex(0) 
        -> getStyle('A'.$footercount1)
        -> applyFromArray($centerText);

$excel -> setActiveSheetIndex(0) 
        -> getStyle('A'.$footercount1)
        -> applyFromArray($border);

$excel -> setActiveSheetIndex(0) 
        -> setCellValue('B'.$footercount1,'TOTAL AMOUNT')
        -> getStyle('B'.$footercount1)
        -> applyFromArray($textStyle3);

$excel -> setActiveSheetIndex(0) 
        -> getStyle('B'.$footercount1)
        -> applyFromArray($rightText);

$excel -> setActiveSheetIndex(0) 
        -> getStyle('B'.$footercount1)
        -> applyFromArray($border);

$excel -> setActiveSheetIndex(0) 
        -> setCellValue('C'.$footercount1,number_format($grandtotalamount1, 2, '.', ','))
        -> getStyle('C'.$footercount1)
        -> applyFromArray($textStyle1);

$excel -> setActiveSheetIndex(0) 
        -> getStyle('C'.$footercount1)
        -> applyFromArray($centerText);

$excel -> setActiveSheetIndex(0) 
        -> getStyle('C'.$footercount1)
        -> applyFromArray($border);

$excel -> setActiveSheetIndex(0) 
        -> setCellValue('D'.$footercount1,'')
        -> getStyle('D'.$footercount1)
        -> applyFromArray($textStyle3);

$excel -> setActiveSheetIndex(0) 
        -> getStyle('D'.$footercount1)
        -> applyFromArray($centerText);

$excel -> setActiveSheetIndex(0) 
        -> getStyle('D'.$footercount1)
        -> applyFromArray($border);

$excel -> setActiveSheetIndex(0) 
        -> setCellValue('E'.$footercount1,'')
        -> getStyle('E'.$footercount1)
        -> applyFromArray($textStyle3);

$excel -> setActiveSheetIndex(0) 
        -> getStyle('E'.$footercount1)
        -> applyFromArray($centerText);

$excel -> setActiveSheetIndex(0) 
        -> getStyle('E'.$footercount1)
        -> applyFromArray($border);

$excel -> setActiveSheetIndex(0) 
        -> setCellValue('F'.$footercount1,'')
        -> getStyle('F'.$footercount1)
        -> applyFromArray($textStyle3);

$excel -> setActiveSheetIndex(0) 
        -> getStyle('F'.$footercount1)
        -> applyFromArray($centerText);

$excel -> setActiveSheetIndex(0) 
        -> getStyle('F'.$footercount1)
        -> applyFromArray($border);

$excel -> setActiveSheetIndex(0) 
        -> setCellValue('G'.$footercount1,'')
        -> getStyle('G'.$footercount1)
        -> applyFromArray($textStyle3);

$excel -> setActiveSheetIndex(0) 
        -> getStyle('G'.$footercount1)
        -> applyFromArray($centerText);

$excel -> setActiveSheetIndex(0) 
        -> getStyle('G'.$footercount1)
        -> applyFromArray($border);

$excel -> setActiveSheetIndex(0) 
        -> setCellValue('H'.$footercount1,'')
        -> getStyle('H'.$footercount1)
        -> applyFromArray($textStyle3);

$excel -> setActiveSheetIndex(0) 
        -> getStyle('H'.$footercount1)
        -> applyFromArray($centerText);

$excel -> setActiveSheetIndex(0) 
        -> getStyle('H'.$footercount1)
        -> applyFromArray($border);

$excel -> setActiveSheetIndex(0) 
        -> setCellValue('I'.$footercount1,'')
        -> getStyle('I'.$footercount1)
        -> applyFromArray($textStyle3);

$excel -> setActiveSheetIndex(0) 
        -> getStyle('I'.$footercount1)
        -> applyFromArray($centerText);

$excel -> setActiveSheetIndex(0) 
        -> getStyle('I'.$footercount1)
        -> applyFromArray($border);

$excel -> setActiveSheetIndex(0) 
        -> setCellValue('J'.$footercount1,number_format($totalremarkspaid1, 2, '.', ','))
        -> getStyle('J'.$footercount1)
        -> applyFromArray($textStyle1);

$excel -> setActiveSheetIndex(0) 
        -> getStyle('J'.$footercount1)
        -> applyFromArray($centerText);

$excel -> setActiveSheetIndex(0) 
        -> getStyle('J'.$footercount1)
        -> applyFromArray($border);

$excel -> setActiveSheetIndex(0) 
        -> setCellValue('K'.$footercount1,'')
        -> getStyle('K'.$footercount1)
        -> applyFromArray($textStyle3);

$excel -> setActiveSheetIndex(0) 
        -> getStyle('K'.$footercount1)
        -> applyFromArray($centerText);

$excel -> setActiveSheetIndex(0) 
        -> getStyle('K'.$footercount1)
        -> applyFromArray($border);

$excel -> setActiveSheetIndex(0) 
        -> setCellValue('L'.$footercount1,'')
        -> getStyle('L'.$footercount1)
        -> applyFromArray($textStyle3);

$excel -> setActiveSheetIndex(0) 
        -> getStyle('L'.$footercount1)
        -> applyFromArray($centerText);

$excel -> setActiveSheetIndex(0) 
        -> getStyle('L'.$footercount1)
        -> applyFromArray($border);

// NEW SHEET
$excel -> createSheet();
$excel -> setActiveSheetIndex(1) 
        -> setTitle('FOR MATURITY (PAID)');

// HEADER  

$excel -> setActiveSheetIndex(1)
        -> mergeCells('A1:D1');

$excel -> setActiveSheetIndex(1) 
        -> setCellValue('A1','COLLECTIBLES')
        -> getStyle('A1')
        -> applyFromArray($textStyle1);

$excel -> setActiveSheetIndex(1)
        -> mergeCells('A2:E2');

$excel -> setActiveSheetIndex(1) 
        -> setCellValue('A2','FOR THE MONTH OF '.strtoupper($from).' AND '.strtoupper($to))
        -> getStyle('A2')
        -> applyFromArray($textStyle2);

// TABLE HEADER

$excel -> setActiveSheetIndex(1) 
        -> setCellValue('A4','NO.')
        -> getStyle('A4')
        -> applyFromArray($textStyle3);

$excel -> setActiveSheetIndex(1) 
        -> getStyle('A4')
        -> applyFromArray($centerText);

$excel -> setActiveSheetIndex(1) 
        -> getStyle('A4')
        -> applyFromArray($border);

        $excel -> setActiveSheetIndex(1) 
        -> setCellValue('B4','CLIENT/COMPANY')
        -> getStyle('B4')
        -> applyFromArray($textStyle3);

$excel -> setActiveSheetIndex(1) 
        -> getStyle('B4')
        -> applyFromArray($centerText);

$excel -> setActiveSheetIndex(1) 
        -> getStyle('B4')
        -> applyFromArray($border);

        $excel -> setActiveSheetIndex(1) 
        -> setCellValue('C4','TOTAL AMOUNT')
        -> getStyle('C4')
        -> applyFromArray($textStyle3);

$excel -> setActiveSheetIndex(1) 
        -> getStyle('C4')
        -> applyFromArray($centerText);

$excel -> setActiveSheetIndex(1) 
        -> getStyle('C4')
        -> applyFromArray($border);

        $excel -> setActiveSheetIndex(1) 
        -> setCellValue('D4','P.O NO.')
        -> getStyle('D4')
        -> applyFromArray($textStyle3);

$excel -> setActiveSheetIndex(1) 
        -> getStyle('D4')
        -> applyFromArray($centerText);

$excel -> setActiveSheetIndex(1) 
        -> getStyle('D4')
        -> applyFromArray($border);

        $excel -> setActiveSheetIndex(1) 
        -> setCellValue('E4','INVOICE NO.')
        -> getStyle('E4')
        -> applyFromArray($textStyle3);

$excel -> setActiveSheetIndex(1) 
        -> getStyle('E4')
        -> applyFromArray($centerText);

$excel -> setActiveSheetIndex(1) 
        -> getStyle('E4')
        -> applyFromArray($border);

        $excel -> setActiveSheetIndex(1) 
        -> setCellValue('F4','INVOICE DATE')
        -> getStyle('F4')
        -> applyFromArray($textStyle3);

$excel -> setActiveSheetIndex(1) 
        -> getStyle('F4')
        -> applyFromArray($centerText);

$excel -> setActiveSheetIndex(1) 
        -> getStyle('F4')
        -> applyFromArray($border);

        $excel -> setActiveSheetIndex(1) 
        -> setCellValue('G4','MATURITY DATE')
        -> getStyle('G4')
        -> applyFromArray($textStyle3);

$excel -> setActiveSheetIndex(1) 
        -> getStyle('G4')
        -> applyFromArray($centerText);

$excel -> setActiveSheetIndex(1) 
        -> getStyle('G4')
        -> applyFromArray($border);

        $excel -> setActiveSheetIndex(1) 
        -> setCellValue('H4','DR NO.')
        -> getStyle('H4')
        -> applyFromArray($textStyle3);

$excel -> setActiveSheetIndex(1) 
        -> getStyle('H4')
        -> applyFromArray($centerText);

$excel -> setActiveSheetIndex(1) 
        -> getStyle('H4')
        -> applyFromArray($border);

        $excel -> setActiveSheetIndex(1) 
        -> setCellValue('I4','DELIVERY DATE')
        -> getStyle('I4')
        -> applyFromArray($textStyle3);

$excel -> setActiveSheetIndex(1) 
        -> getStyle('I4')
        -> applyFromArray($centerText);

$excel -> setActiveSheetIndex(1) 
        -> getStyle('I4')
        -> applyFromArray($border);

        $excel -> setActiveSheetIndex(1) 
        -> setCellValue('J4','REMARKS/PAID')
        -> getStyle('J4')
        -> applyFromArray($textStyle3);

$excel -> setActiveSheetIndex(1) 
        -> getStyle('J4')
        -> applyFromArray($centerText);

$excel -> setActiveSheetIndex(1) 
        -> getStyle('J4')
        -> applyFromArray($border);

        $excel -> setActiveSheetIndex(1) 
        -> setCellValue('K4','OR NO.')
        -> getStyle('K4')
        -> applyFromArray($textStyle3);

$excel -> setActiveSheetIndex(1) 
        -> getStyle('K4')
        -> applyFromArray($centerText);

$excel -> setActiveSheetIndex(1) 
        -> getStyle('K4')
        -> applyFromArray($border);

        $excel -> setActiveSheetIndex(1) 
        -> setCellValue('L4','OR DATE')
        -> getStyle('L4')
        -> applyFromArray($textStyle3);

$excel -> setActiveSheetIndex(1) 
        -> getStyle('L4')
        -> applyFromArray($centerText);

$excel -> setActiveSheetIndex(1) 
        -> getStyle('L4')
        -> applyFromArray($border);

$excel->setActiveSheetIndex(1)->getRowDimension('4')->setRowHeight(30);
$excel->setActiveSheetIndex(1)->getColumnDimension('A')->setWidth(7);
$excel->setActiveSheetIndex(1)->getColumnDimension('B')->setWidth(80);
$excel->setActiveSheetIndex(1)->getColumnDimension('C')->setWidth(20);
$excel->setActiveSheetIndex(1)->getColumnDimension('D')->setWidth(20);
$excel->setActiveSheetIndex(1)->getColumnDimension('E')->setWidth(20);
$excel->setActiveSheetIndex(1)->getColumnDimension('F')->setWidth(20);
$excel->setActiveSheetIndex(1)->getColumnDimension('G')->setWidth(20);
$excel->setActiveSheetIndex(1)->getColumnDimension('H')->setWidth(20);
$excel->setActiveSheetIndex(1)->getColumnDimension('I')->setWidth(20);
$excel->setActiveSheetIndex(1)->getColumnDimension('J')->setWidth(20);
$excel->setActiveSheetIndex(1)->getColumnDimension('K')->setWidth(20);
$excel->setActiveSheetIndex(1)->getColumnDimension('L')->setWidth(20);

// DATA LOOP

$count2 = 0;
$toInsert2 = array();
$data2 = array();
$grandtotalamount2 = 0;
$totalremarkspaid2 = 0;

$sql_unpaid2 = "SELECT hurtajadmin_collectibles.id
, hurtajadmin_collectibles.collectibles_total_amount
, hurtajadmin_collectibles.collectibles_po_number
, hurtajadmin_collectibles.collectibles_invoice_number
, hurtajadmin_collectibles.collectibles_invoice_date 
, hurtajadmin_collectibles.collectibles_maturity_date 
, hurtajadmin_collectibles.collectibles_dr_number 
, hurtajadmin_collectibles.collectibles_delivery_date 
, hurtajadmin_collectibles.collectibles_remarks_paid 
, hurtajadmin_collectibles.collectibles_or_number 
, hurtajadmin_collectibles.collectibles_or_date 
, hurtajadmin_collectibles.collectibles_date_added
, hurtajadmin_company.id AS company_id
, hurtajadmin_company.company_name  
FROM hurtajadmin_collectibles
LEFT JOIN hurtajadmin_company
ON hurtajadmin_collectibles.company_id=hurtajadmin_company.id
WHERE hurtajadmin_collectibles.collectibles_status = '2'
AND DATE(hurtajadmin_collectibles.collectibles_maturity_date) >= DATE('$datetimefrom')
AND DATE(hurtajadmin_collectibles.collectibles_maturity_date) <= DATE('$datetimeto')
ORDER BY hurtajadmin_company.company_name";
$query_unpaid2 = mysqli_query($db_conn, $sql_unpaid2);

while ($row2 = mysqli_fetch_array($query_unpaid2, MYSQLI_ASSOC)) {
        $count2++;

        $recid = $row2["id"];
        $companyid = $row2["company_id"];
        $companyname = $row2["company_name"];
        $totalamount = $row2["collectibles_total_amount"];
        $ponumber = $row2["collectibles_po_number"];
        $invoicenumber = $row2["collectibles_invoice_number"];
        $invoicedate = $row2["collectibles_invoice_date"];
        $maturitydate = $row2["collectibles_maturity_date"];
        $drnumber = $row2["collectibles_dr_number"];
        $deliverydate = $row2["collectibles_delivery_date"];
        $remarkspaid = $row2["collectibles_remarks_paid"];
        $ornumber = $row2["collectibles_or_number"];
        $ordate = $row2["collectibles_or_date"];
        $dateadded = $row2["collectibles_date_added"];

        $totalamount = str_replace('₱', '', $totalamount);

        $totalamounttoadd = str_replace(',', '', $totalamount);

        $grandtotalamount2 = $grandtotalamount2 + $totalamounttoadd;

        if (filter_var($remarkspaid, FILTER_VALIDATE_INT)) {
           $totalremarkspaid2 = $totalremarkspaid2 + $remarkspaid;
        }

        $now = time(); // or your date as well
        $your_date = strtotime($maturitydate);
        $datediff = $your_date - $now;
        $datediff = round($datediff / (60 * 60 * 24));

        $exceeddays = 0;
        $leftdays = 0;

        if($datediff < 0) {
            $exceeddays = abs($datediff);
        } else if($datediff > 0) {
            $leftdays = $datediff;
        }

        if($invoicedate != "" && $invoicedate != "1970-01-01 01:00:00" && $invoicedate != "0000-00-00 00:00:00") {
            $invoicedate = date("F d, Y", strtotime($invoicedate));
            $editinvoicedate = date("m/d/Y", strtotime($invoicedate));
        } else {
            $invoicedate = "";
            $editinvoicedate = "";
        }

        if($maturitydate != "" && $maturitydate != "1970-01-01 01:00:00" && $maturitydate != "0000-00-00 00:00:00") {
            $maturitydate = date("F d, Y", strtotime($maturitydate));
            $editmaturitydate = date("m/d/Y", strtotime($maturitydate));
        } else {
            $maturitydate = "";
            $editmaturitydate = "";
        }

        if($deliverydate != "" && $deliverydate != "1970-01-01 01:00:00" && $deliverydate != "0000-00-00 00:00:00") {
            $deliverydate = date("F d, Y", strtotime($deliverydate));
            $editdeliverydate = date("m/d/Y", strtotime($deliverydate));
        } else {
            $deliverydate = "";
            $editdeliverydate = "";
        }

        if($ordate != "" && $ordate != "1970-01-01 01:00:00" && $ordate != "0000-00-00 00:00:00") {
            $ordate = date("F d, Y", strtotime($ordate));
            $editordate = date("m/d/Y", strtotime($ordate));
        } else {
            $ordate = "";
            $editordate = "";
        }

        $dateadded = date("F d, Y", strtotime($dateadded));

        $data2 = array($count2,$companyname,$totalamount,$ponumber,$invoicenumber,$invoicedate,$maturitydate,$drnumber,$deliverydate,$remarkspaid,$ordate);
        array_push($toInsert2, $data2);

}

$textaligncount2 = $count2 + 4;

$excel -> getActiveSheet()
        -> getStyle('5:'.$textaligncount2)
        -> applyFromArray($textStyle2);

$excel -> getActiveSheet()
        -> getStyle('A5:A'.$textaligncount2)
        -> applyFromArray($centerText);

$excel -> getActiveSheet()
        -> getStyle('C5:C'.$textaligncount2)
        -> applyFromArray($leftText);

$excel -> getActiveSheet()
        -> getStyle('D5:D'.$textaligncount2)
        -> applyFromArray($leftText);
        
$excel -> getActiveSheet()
        -> getStyle('E5:E'.$textaligncount2)
        -> applyFromArray($centerText);

$excel -> getActiveSheet()
        -> getStyle('F5:F'.$textaligncount2)
        -> applyFromArray($rightText);

$excel -> getActiveSheet()
        -> getStyle('G5:G'.$textaligncount2)
        -> applyFromArray($rightText);

$excel -> getActiveSheet()
        -> getStyle('H5:H'.$textaligncount2)
        -> applyFromArray($leftText);

$excel -> getActiveSheet()
        -> getStyle('J5:J'.$textaligncount2)
        -> applyFromArray($centerText);

$excel -> getActiveSheet()
        -> getStyle('K5:K'.$textaligncount2)
        -> applyFromArray($centerText);

$excel -> getActiveSheet()
        -> fromArray($toInsert2, null, 'A5');

// FOOTER

$footercount2 = $count2 + 5;

$excel -> setActiveSheetIndex(1) 
        -> setCellValue('A'.$footercount2,'')
        -> getStyle('A'.$footercount2)
        -> applyFromArray($textStyle3);

$excel -> setActiveSheetIndex(1) 
        -> getStyle('A'.$footercount2)
        -> applyFromArray($centerText);

$excel -> setActiveSheetIndex(1) 
        -> getStyle('A'.$footercount2)
        -> applyFromArray($border);

$excel -> setActiveSheetIndex(1) 
        -> setCellValue('B'.$footercount2,'TOTAL AMOUNT')
        -> getStyle('B'.$footercount2)
        -> applyFromArray($textStyle3);

$excel -> setActiveSheetIndex(1) 
        -> getStyle('B'.$footercount2)
        -> applyFromArray($rightText);

$excel -> setActiveSheetIndex(1) 
        -> getStyle('B'.$footercount2)
        -> applyFromArray($border);

$excel -> setActiveSheetIndex(1) 
        -> setCellValue('C'.$footercount2,number_format($grandtotalamount2, 2, '.', ','))
        -> getStyle('C'.$footercount2)
        -> applyFromArray($textStyle1);

$excel -> setActiveSheetIndex(1) 
        -> getStyle('C'.$footercount2)
        -> applyFromArray($centerText);

$excel -> setActiveSheetIndex(1) 
        -> getStyle('C'.$footercount2)
        -> applyFromArray($border);

$excel -> setActiveSheetIndex(1) 
        -> setCellValue('D'.$footercount2,'')
        -> getStyle('D'.$footercount2)
        -> applyFromArray($textStyle3);

$excel -> setActiveSheetIndex(1) 
        -> getStyle('D'.$footercount2)
        -> applyFromArray($centerText);

$excel -> setActiveSheetIndex(1) 
        -> getStyle('D'.$footercount2)
        -> applyFromArray($border);

$excel -> setActiveSheetIndex(1) 
        -> setCellValue('E'.$footercount2,'')
        -> getStyle('E'.$footercount2)
        -> applyFromArray($textStyle3);

$excel -> setActiveSheetIndex(1) 
        -> getStyle('E'.$footercount2)
        -> applyFromArray($centerText);

$excel -> setActiveSheetIndex(1) 
        -> getStyle('E'.$footercount2)
        -> applyFromArray($border);

$excel -> setActiveSheetIndex(1) 
        -> setCellValue('F'.$footercount2,'')
        -> getStyle('F'.$footercount2)
        -> applyFromArray($textStyle3);

$excel -> setActiveSheetIndex(1) 
        -> getStyle('F'.$footercount2)
        -> applyFromArray($centerText);

$excel -> setActiveSheetIndex(1) 
        -> getStyle('F'.$footercount2)
        -> applyFromArray($border);

$excel -> setActiveSheetIndex(1) 
        -> setCellValue('G'.$footercount2,'')
        -> getStyle('G'.$footercount2)
        -> applyFromArray($textStyle3);

$excel -> setActiveSheetIndex(1) 
        -> getStyle('G'.$footercount2)
        -> applyFromArray($centerText);

$excel -> setActiveSheetIndex(1) 
        -> getStyle('G'.$footercount2)
        -> applyFromArray($border);

$excel -> setActiveSheetIndex(1) 
        -> setCellValue('H'.$footercount2,'')
        -> getStyle('H'.$footercount2)
        -> applyFromArray($textStyle3);

$excel -> setActiveSheetIndex(1) 
        -> getStyle('H'.$footercount2)
        -> applyFromArray($centerText);

$excel -> setActiveSheetIndex(1) 
        -> getStyle('H'.$footercount2)
        -> applyFromArray($border);

$excel -> setActiveSheetIndex(1) 
        -> setCellValue('I'.$footercount2,'')
        -> getStyle('I'.$footercount2)
        -> applyFromArray($textStyle3);

$excel -> setActiveSheetIndex(1) 
        -> getStyle('I'.$footercount2)
        -> applyFromArray($centerText);

$excel -> setActiveSheetIndex(1) 
        -> getStyle('I'.$footercount2)
        -> applyFromArray($border);

$excel -> setActiveSheetIndex(1) 
        -> setCellValue('J'.$footercount2,number_format($totalremarkspaid2, 2, '.', ','))
        -> getStyle('J'.$footercount2)
        -> applyFromArray($textStyle1);

$excel -> setActiveSheetIndex(1) 
        -> getStyle('J'.$footercount2)
        -> applyFromArray($centerText);

$excel -> setActiveSheetIndex(1) 
        -> getStyle('J'.$footercount2)
        -> applyFromArray($border);

$excel -> setActiveSheetIndex(1) 
        -> setCellValue('K'.$footercount2,'')
        -> getStyle('K'.$footercount2)
        -> applyFromArray($textStyle3);

$excel -> setActiveSheetIndex(1) 
        -> getStyle('K'.$footercount2)
        -> applyFromArray($centerText);

$excel -> setActiveSheetIndex(1) 
        -> getStyle('K'.$footercount2)
        -> applyFromArray($border);

$excel -> setActiveSheetIndex(1) 
        -> setCellValue('L'.$footercount2,'')
        -> getStyle('L'.$footercount2)
        -> applyFromArray($textStyle3);

$excel -> setActiveSheetIndex(1) 
        -> getStyle('L'.$footercount2)
        -> applyFromArray($centerText);

$excel -> setActiveSheetIndex(1) 
        -> getStyle('L'.$footercount2)
        -> applyFromArray($border);

$filename = str_replace(' ', '', $from.'to'.$to);

header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment; filename="'.$filename.'Report.xlsx"');
header('Cache-Control: max-age=0');
$file = PHPExcel_IOFactory::createWriter($excel,'Excel2007');
$file -> save('php://output');

?>