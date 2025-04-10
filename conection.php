<?php
error_reporting(1);
session_start();
date_default_timezone_set('Asia/Kolkata');
$con=mysqli_connect("localhost","root","","wealthy");
if (mysqli_connect_errno()) {
	echo "Failed to connect to mysqli: " . mysqli_connect_error();
} ?>
