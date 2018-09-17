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

$latecount2 = 0;

$datein = "2018-01-23 09:00:00";

$dateindate = date("Y-m-d", strtotime($datein));

                                                        $latecount2 = $latecount2 + round((strtotime($datein) - strtotime($dateindate." 08:00:00"))/3600, 1);

                                                        if($latecount2 < 0.01) {
                                                            $latecount2 = 0;
                                                        }


echo $latecount2;

?>