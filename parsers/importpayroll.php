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
			$checkuserid = mysqli_real_escape_string($db_conn, $worksheet->getCell('A1')->getValue());
			$checkdatetime = mysqli_real_escape_string($db_conn, $worksheet->getCell('B1')->getValue());
			if($checkuserid == "User ID" || $checkdatetime == "Date/Time") {
				for ($rowexcel = 2; $rowexcel <= $lastRow; $rowexcel++) {
					/* Check If sheet not emprt */

					$checkcheckuserid1 = mysqli_real_escape_string($db_conn, $worksheet->getCell('A'.$rowexcel)->getValue());
					$checkdatetime1 = mysqli_real_escape_string($db_conn, $worksheet->getCell('B'.$rowexcel)->getValue());

					if($checkcheckuserid1 != "" || $checkdatetime1 != "") {

						$userid = mysqli_real_escape_string($db_conn, $worksheet->getCell('A'.$rowexcel)->getValue());
						$datetime = mysqli_real_escape_string($db_conn, $worksheet->getCell('B'.$rowexcel)->getValue());
						$status = mysqli_real_escape_string($db_conn, $worksheet->getCell('D'.$rowexcel)->getValue());

						$sql = "SELECT * FROM hurtajadmin_attendance WHERE employee_id='$userid' AND attendance_date_in_out='$datetime' AND attendance_value='$status' AND attendance_status='1' LIMIT 1";
						$query = mysqli_query($db_conn, $sql);
						$check = mysqli_num_rows($query);

						if($check == 0) {
							$sql_user = "INSERT INTO hurtajadmin_attendance (employee_id, attendance_date_in_out, attendance_value, 	attendance_date_added, attendance_status)
							VALUES ('$userid','$datetime','$status', NOW(), '1')";
							$query_user = mysqli_query($db_conn, $sql_user);
							$success = "3";
							$importedCount++;
						} else {
							// Do Nothing
							$success = "3";
						}

					}
				}
			} else {
				$success = "2";
			}

			if($success == "3") {
				echo '<a href="../account.php?id='.$log_id.'&dashboard=focus">Click this to go to Dashboard</a> <h3>Import Success!</h3>';
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