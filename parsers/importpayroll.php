<title>Hurt AJ - Imprt Attendance</title>
<link rel="icon" type="image/png" href="../image/fav.png" />
<script type="text/javascript">
	function goBack() { 
    	window.history.back(); 
    }
</script>
<?php
include_once("../include/loginstatus.php");
require_once '../library/PHPExcel/Classes/PHPExcel.php';
header('Content-Type: text/html; charset=ISO-8859-1');
ini_set('max_execution_time', 19200); //300 sedb_connds = 5 minutes
	
if(isset($_POST["import-payroll-submit-excel"]) && isset($_POST["import-payroll-sheet-number"])){

	$sheetNumber = $_POST["import-payroll-sheet-number"];
	$allowed =  array('xlsx','xls');
	$filename = $_FILES['file']['name'];
	$ext = pathinfo($filename, PATHINFO_EXTENSION);
	if(!in_array($ext,$allowed) ) {
	    echo '<h3>Invalid File! Make sure it is an excel file and try uploading again.</h3>';
	} else {

		ini_set('display_errors', 1);
		ini_set('display_startup_errors', 1);
		error_reporting(E_ALL);
		
		$uploadFilePath = '../uploads/'.basename($_FILES['file']['name']);
		move_uploaded_file($_FILES['file']['tmp_name'], $uploadFilePath);

		$excelReader = PHPExcel_IOFactory::createReaderForFile($uploadFilePath);
		$excelObj = $excelReader->load($uploadFilePath);
		$totalSheet = $excelObj->getSheetCount();
		$importedCount = 0;


		if($totalSheet >= $sheetNumber && $sheetNumber > 0) {

			$success = "1";
			$count = 0;

			$worksheet = $excelObj->getSheet($sheetNumber-1);
			$lastRow = $worksheet->getHighestRow();
			$checknumber = mysqli_real_escape_string($db_conn, $worksheet->getCell('A1')->getValue());
			$checkemployee = mysqli_real_escape_string($db_conn, $worksheet->getCell('B1')->getValue());
			if($checknumber == "NO." || $checkemployee == "EMPLOYEE") {
				for ($rowexcel = 2; $rowexcel <= $lastRow; $rowexcel++) {
					/* Check If sheet not emprt */

					$checknumber1 = mysqli_real_escape_string($db_conn, $worksheet->getCell('A'.$rowexcel)->getValue());
					$checkemployee1 = mysqli_real_escape_string($db_conn, $worksheet->getCell('B'.$rowexcel)->getValue());

					if($checknumber1 != "" || $checkemployee1 != "") {

						$number = mysqli_real_escape_string($db_conn, $worksheet->getCell('A'.$rowexcel)->getValue());
						$employee = mysqli_real_escape_string($db_conn, $worksheet->getCell('B'.$rowexcel)->getValue());
						$payperiod = mysqli_real_escape_string($db_conn, $worksheet->getCell('C'.$rowexcel)->getValue());
						$daysofwork = mysqli_real_escape_string($db_conn, $worksheet->getCell('D'.$rowexcel)->getValue());
						$dayspresent = mysqli_real_escape_string($db_conn, $worksheet->getCell('E'.$rowexcel)->getValue());
						$overtime = mysqli_real_escape_string($db_conn, $worksheet->getCell('F'.$rowexcel)->getValue());
						$sss = mysqli_real_escape_string($db_conn, $worksheet->getCell('G'.$rowexcel)->getValue());
						$sssloan = mysqli_real_escape_string($db_conn, $worksheet->getCell('H'.$rowexcel)->getValue());
						$pagibig = mysqli_real_escape_string($db_conn, $worksheet->getCell('I'.$rowexcel)->getValue());
						$pagibigloan = mysqli_real_escape_string($db_conn, $worksheet->getCell('J'.$rowexcel)->getValue());
						$philhealth = mysqli_real_escape_string($db_conn, $worksheet->getCell('K'.$rowexcel)->getCalculatedValue());
						$tax = mysqli_real_escape_string($db_conn, $worksheet->getCell('L'.$rowexcel)->getValue());
						$lesslates = mysqli_real_escape_string($db_conn, $worksheet->getCell('M'.$rowexcel)->getValue());
						$cashloan = mysqli_real_escape_string($db_conn, $worksheet->getCell('N'.$rowexcel)->getValue());
						$cashadvance = mysqli_real_escape_string($db_conn, $worksheet->getCell('O'.$rowexcel)->getValue());
						$sunday1 = mysqli_real_escape_string($db_conn, $worksheet->getCell('P'.$rowexcel)->getValue());
						$ratehour = mysqli_real_escape_string($db_conn, $worksheet->getCell('Q'.$rowexcel)->getCalculatedValue());
						$payrolperiod = mysqli_real_escape_string($db_conn, $worksheet->getCell('R'.$rowexcel)->getValue());
						$rateday = mysqli_real_escape_string($db_conn, $worksheet->getCell('S'.$rowexcel)->getValue());
						$holiday1 = mysqli_real_escape_string($db_conn, $worksheet->getCell('T'.$rowexcel)->getValue());
						$snwh1 = mysqli_real_escape_string($db_conn, $worksheet->getCell('U'.$rowexcel)->getValue());
						$daily = mysqli_real_escape_string($db_conn, $worksheet->getCell('V'.$rowexcel)->getCalculatedValue());
						$overtimepay = mysqli_real_escape_string($db_conn, $worksheet->getCell('W'.$rowexcel)->getCalculatedValue());
						$sunday2 = mysqli_real_escape_string($db_conn, $worksheet->getCell('X'.$rowexcel)->getCalculatedValue());
						$holiday2 = mysqli_real_escape_string($db_conn, $worksheet->getCell('Y'.$rowexcel)->getCalculatedValue());
						$snwh2 = mysqli_real_escape_string($db_conn, $worksheet->getCell('Z'.$rowexcel)->getCalculatedValue());
						$gross = mysqli_real_escape_string($db_conn, $worksheet->getCell('AA'.$rowexcel)->getCalculatedValue());
						$totaldeduction = mysqli_real_escape_string($db_conn, $worksheet->getCell('AB'.$rowexcel)->getCalculatedValue());
						$net = mysqli_real_escape_string($db_conn, $worksheet->getCell('AC'.$rowexcel)->getCalculatedValue());

						$pieces = explode("-",$payperiod);
						$pieces1 = explode(",",$pieces[1]);

						$payperiodfrom = date("Y-m-d H:i:s", strtotime($pieces[0].' '.$pieces1[1]));
						$payperiodto = date("Y-m-d H:i:s", strtotime($pieces1[0].' '.$pieces1[1]));

						$payrolperiod = date("Y-m-d H:i:s", strtotime($payrolperiod));

						$sql_user = "INSERT INTO hurtajadmin_payroll (payroll_employee, payroll_payperiod_1, payroll_payperiod_2, payroll_daysofwork, payroll_dayspresent, payroll_overtime, payroll_sss, payroll_sssloan, payroll_pagibig, payroll_pagibigloan, payroll_philhealth, payroll_tax, payroll_lesslates, payroll_cashloan, payroll_cashadvance, payroll_sunday1, 	payroll_ratehour, payroll_payrolperiod, payroll_rateday, payroll_holiday1, payroll_snwh1, payroll_daily, payroll_overtimepay, payroll_sunday2, payroll_holiday2, payroll_snwh2, payroll_gross, payroll_totaldeduction, payroll_net, payroll_date_added, payroll_status)
					    VALUES ('$employee','$payperiodfrom','$payperiodto','$daysofwork', '$dayspresent', '$overtime','$sss','$sssloan', '$pagibig', '$pagibigloan','$philhealth','$tax', '$lesslates', '$cashloan','$cashadvance','$sunday1', '$ratehour', '$payrolperiod','$rateday','$holiday1', '$snwh1', '$daily','$overtimepay','$sunday2', '$holiday2', '$snwh2','$gross','$totaldeduction', '$net', NOW(), '1')";
					    $query = mysqli_query($db_conn, $sql_user);
						$success = "3";
						$importedCount++;

					}
				}
			} else {
				$success = "2";
			}

			if($success == "3") {
				header("location: ../account.php?id=".$log_id."&payroll=focus&view=payroll");
			} else if($success == "2") {
				echo '<button type="button" onclick="goBack();">Back</button> <h3>Looks like this sheet is not an attendance data!</h3>';
			} else if($success == "1") {
				echo '<button type="button" onclick="goBack();">Back</button> <h3>No data found!</h3>';
			}

		} else {
			echo '<button type="button" onclick="goBack();">Back</button> <h3>Invalid Sheet Number!</h3>';
	    }

	}

}

?>