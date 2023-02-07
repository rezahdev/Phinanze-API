<?php
/*
	*Verify if a request is from an authenticated user
*/

function IsAuthenticRequest($connect, $userid, $token) {	
	$query  = "SELECT * FROM users WHERE token = '$token' AND id = '$userid' LIMIT 1";
	$result = mysqli_query($connect, $query) or die('Server connection error');
	$count  = mysqli_num_rows($result);
	
	return $count > 0;
}

?>