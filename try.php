<?php
// $now = time(); // or your date as well
// $your_date = strtotime("2018-06-08 00:00:00");
// $datediff = $your_date - $now;

// echo round($datediff / (60 * 60 * 24));



$str = "OCT 11- OCT 25,2017";
$pieces = explode("-",$str);
$pieces1 = explode(",",$pieces[1]);

$newDate = date("Y-m-d H:i:s", strtotime($pieces[0].' '.$pieces1[1]));
$newDate1 = date("Y-m-d H:i:s", strtotime($pieces1[0].' '.$pieces1[1]));

echo $newDate;
echo $newDate1;
?>