<?php
// $now = strtotime("2018-01-26 00:00:00"); // or your date as well
// $your_date = strtotime("2018-01-11 00:00:00");
// $datediff = $now - $your_date;

// echo round($datediff / (60 * 60 * 24) - 2);


// $paymentDate=date('Y-m-d', strtotime("2018-01-10 00:00:00"));
// //echo $paymentDate; // echos today! 
// $contractDateBegin = date('Y-m-d', strtotime("2018-01-11 00:00:00"));
// $contractDateEnd = date('Y-m-d', strtotime("2018-01-26 00:00:00"));

// if (($paymentDate > $contractDateBegin) && ($paymentDate < $contractDateEnd)){
//     echo "is between";
// }else{
//     echo "NO GO!";  
// }

// $startDate = date('Y-m-d', strtotime("2018-01-11 00:00:00"));
// $endDate = date('Y-m-d', strtotime("2018-01-26 00:00:00"));

// $sundays = array();

// while ($startDate <= $endDate) {
//     if (date('w', strtotime($startDate)) == 0) {
//         $sundays[] = date('Y-m-d', strtotime($startDate));
//     }

//     $startDate = date('Y-m-d H:i:s', strtotime($startDate . ' +1 day'));
// }

// var_dump($sundays);

// $latecount2 = 0;

// $datein = "2018-01-23 09:00:00";

// $dateindate = date("Y-m-d", strtotime($datein));

//                                                         $latecount2 = $latecount2 + round((strtotime($datein) - strtotime($dateindate." 08:00:00"))/3600, 1);

//                                                         if($latecount2 < 0.01) {
//                                                             $latecount2 = 0;
//                                                         }


// echo $latecount2;

// IF DATE IN AND DATE OUT IS WITHIN 7:30 AM AND 6PM, IT WILL COUNT AS REGULAR TIME ELSE ALL EXCESS IS COUNT AS OVERTIME

$datein = "2018-08-21 07:30:47";
$dateout = "2018-08-21 18:00:00";

$dateindate = date("Y-m-d", strtotime($datein));
$dateoutdate = date("Y-m-d", strtotime($dateout));

$hourdiff = round((strtotime($dateout) - strtotime($datein))/3600, 1);

$dateinstrtotime = strtotime($datein);
$dateoutstrtotime = strtotime($dateout);

$dateinminregulartimestrtotime = strtotime($dateindate. " 07:30:00");
$dateinmaxregulartimestrtotime = strtotime($dateoutdate. " 18:00:00");

if($dateinstrtotime > $dateinminregulartimestrtotime && $dateinmaxregulartimestrtotime >= $dateoutstrtotime) {
    $dailycount1 = $hourdiff;
    if($dailycount1 > 9.5) {
        $dailycount1 = 9.5;
    }
} else {
    if($dateinminregulartimestrtotime > $dateinstrtotime && $dateinmaxregulartimestrtotime >= $dateoutstrtotime) {
        $otcount1 = round(($dateinminregulartimestrtotime - $dateinstrtotime)/3600, 1);
        $dailycount1 = $hourdiff - $otcount1;
    } else if($dateinstrtotime > $dateinminregulartimestrtotime && $dateoutstrtotime > $dateinmaxregulartimestrtotime) {
        $otcount1 = round(($dateoutstrtotime - $dateinmaxregulartimestrtotime)/3600, 1);
        $dailycount1 = $hourdiff - $otcount1;
    } else {
        $otcount1 = $otcount1 + round(($dateinminregulartimestrtotime - $dateinstrtotime)/3600, 1);

        $otcount1 = $otcount1 + round(($dateoutstrtotime - $dateinmaxregulartimestrtotime)/3600, 1);
        $dailycount1 = $hourdiff - $otcount1;
    }
}

echo $dailycount1."<br/>".$otcount1;

?>