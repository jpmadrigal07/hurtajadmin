<?php
$db_conn = mysqli_connect("localhost", "root", "", "hurtajadmin");
// Evaluate the connection
if (mysqli_connect_errno()) {
	echo mysqli_connect_errno();
	exit();
}
?>