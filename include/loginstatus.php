<?php
session_start();
include_once("db_conn.php");
//Files that include this file at he very top would NOT require
//Connection to database or session(); be careful.
// Initialize some vars
$user_ok = false;
$log_id = "";
$log_password = "";
//User Verify function
function evalLoggedUser($conn,$id,$p) {
	$sql = "SELECT user_ip FROM hurtajadmin_user WHERE id='$id' AND user_pass='$p' LIMIT 1";
	$query = mysqli_query($conn, $sql);
	$numrows = mysqli_num_rows($query);
	if ($numrows > 0) {
		return true;
	}
}
if (isset($_SESSION["userid"]) && isset($_SESSION["password"])) {
	$log_id = preg_replace('#[^0-9]#', '', $_SESSION['userid']);
	$log_password = preg_replace('#[^a-z0-9]#i', '', $_SESSION['password']);
	// Verify the user
	$user_ok = evalLoggedUser($db_conn,$log_id,$log_password);
} else if (isset($_COOKIE["id"]) && isset($_COOKIE["pass"])) {
	$_SESSION['userid'] = preg_replace('#[^0-9]#', '', $_COOKIE['id']);
	$_SESSION['password'] = preg_replace('#[^a-z0-9]#i', '', $_COOKIE['pass']);
	$log_id = $_SESSION['userid'];
	$log_password = $_SESSION['password'];
	// Verify the user
	$user_ok = evalLoggedUser($db_conn,$log_id,$log_password);
	if ($user_ok == true) {
		// Update their lastlogin datetime field
		$sql = "UPDATE hurtajadmin_user SET user_last_login=now() WHERE id='$log_id' LIMIT 1";
		$query = mysqli_query($db_conn, $sql);
	}
}
?>