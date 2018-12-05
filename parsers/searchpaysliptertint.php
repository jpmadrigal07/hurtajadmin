<?php
include_once "../include/loginstatus.php";

$output = '';
$count = 0;

$type = $_POST["type"];
$filter = $_POST["filter"];
$id = $_POST["id"];
$year = $_POST["year"];
$cycletext = $year;

if ($filter == "cycle") {
    $sql = "SELECT DISTINCT tertint_payslip_payslip_id, tertint_payslip_date_cycle_year, tertint_payslip_date_created, tertint_payslip_status FROM hurtajadmin_tertint_payslip WHERE tertint_payslip_date_cycle_year = '$year' AND tertint_payslip_status = '1' ORDER BY id DESC";
} else if ($filter == "id") {
    $sql = "SELECT DISTINCT tertint_payslip_payslip_id, tertint_payslip_date_cycle_year, tertint_payslip_date_created, tertint_payslip_status FROM hurtajadmin_tertint_payslip WHERE tertint_payslip_payslip_id = '$id' AND tertint_payslip_status = '1' ORDER BY id DESC";
}

$result = mysqli_query($db_conn, $sql);

if ($year == "") {
    $output .= '
  <table class="table table-bordered">
  <thead>
  <tr>
  <th>#</th>
  <th>Payslip ID</th>
  <th>Payslip Year</th>
  <th>Date Created</th>
  <th>Action</th>
  </tr>
  </thead>
  <tbody>
  ';
    while ($row = mysqli_fetch_array($result)) {
        $count++;
        $payslipid = $row["tertint_payslip_payslip_id"];
        $year = $row["tertint_payslip_date_cycle_year"];
        $dateadded = $row["tertint_payslip_date_created"];
        $stats = $row["tertint_payslip_status"];

        $monthtext = "";
        $prevmonthtext = "";
        $cycletext = "";

        $prevmonth = 0;

        if ($month == 1) {
            $prevmonth = 12;
        } else {
            $prevmonth = (int) $month - 1;
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

        if ($cycle == "1") {
            if ($month == 1) {
                $prevyear = $year - 1;
                $cycletext = $prevmonthtext . ". 26, " . $prevyear . " - " . $monthtext . ". 10, " . $year;
            } else {
                $cycletext = $prevmonthtext . ". 26 - " . $monthtext . ". 10, " . $year;
            }
        } else if ($cycle == "2") {
            $cycletext = $monthtext . ". 11 - 25, " . $year;
        }

        $payslipcycle = $cycletext;

        $newDateAdded = date("M. d, Y", strtotime($dateadded));

        $output .= '
            <tr>
                <td>' . $count . '</td>
                <td>' . $payslipid . '</td>
                <td>' . $payslipcycle . '</td>
                <td>' . $newDateAdded . '</td>
                <td><a href="account.php?id=' . $log_id . '&payroll=focus&action=tertintpayslip&payslipid=' . $payslipid . '">View</a> | <a href="payslip.php?payslipid=' . $payslipid . '&type=2" target="_blank">Print</a> | <a href="javascript:void(0)" onclick="openDeletePayslipDialog(\'' . $payslipid . '\',\'2\')">Delete</a></td>
            </tr>
        ';

    }
    $output .= '
        </tbody>
        </table>
    ';
    echo $output;
} else if ($type == "id" && $id == "") {
    $output .= '

      ';
} else {
    if (mysqli_num_rows($result) > 0) {
        $output .= '
    <table class="table table-bordered">
        <thead>
            <tr>
            <th>#</th>
            <th>Payslip ID</th>
            <th>Payslip Year</th>
            <th>Date Created</th>
            <th>Action</th>
            </tr>
        </thead>
    <tbody>
    ';
        while ($row = mysqli_fetch_array($result)) {
            $count++;
            $payslipid = $row["tertint_payslip_payslip_id"];
            $year = $row["tertint_payslip_date_cycle_year"];
            $dateadded = $row["tertint_payslip_date_created"];
            $stats = $row["tertint_payslip_status"];

            $cycletext = $year;

            $payslipcycle = $cycletext;

            $newDateAdded = date("M. d, Y", strtotime($dateadded));

            $output .= '
                <tr>
                    <td>' . $count . '</td>
                    <td>' . $payslipid . '</td>
                    <td>' . $payslipcycle . '</td>
                    <td>' . $newDateAdded . '</td>
                    <td><a href="account.php?id=' . $log_id . '&payroll=focus&action=tertintpayslip&payslipid=' . $payslipid . '">View</a> | <a href="payslip.php?payslipid=' . $payslipid . '&type=2" target="_blank">Print</a> | <a href="javascript:void(0)" onclick="openDeletePayslipDialog(\'' . $payslipid . '\',\'2\')">Delete</a></td>
                </tr>
            ';

        }
        $output .= '
            </tbody>
            </table>
        ';
        echo $output;
    } else {
        if ($filter == "cycle") {
            echo '<h4 align="center">No results for <b>' . $cycletext . '</b></h4>';
        } else if ($filter == "id") {
            echo '<h4 align="center">No results for <b>' . $id . '</b></h4>';
        }
    }
}
