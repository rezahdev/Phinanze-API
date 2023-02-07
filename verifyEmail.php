<?php
/*
	* Recieve data sent from Phinanze App
	* Verify user's email verification code
	* Return the result SUCCESS or FAILED
*/
require_once('../../../../../cnct/connectDB.php');
require_once('../../../../../cnct/requestVerification.php');
	
if(isset($_POST['token']) && isset($_POST['userid'])) {
	$token  = mysqli_real_escape_string($connect, $_POST['token']);
	$userid = mysqli_real_escape_string($connect, $_POST['userid']);
	
	if(IsAuthenticRequest($connect, $userid, $token)) {
		$code = mysqli_real_escape_string($connect, $_POST['code']);
		
		$query = "SELECT verification_code FROM users WHERE id = '$userid'";
		$result = mysqli_query($connect, $query) or die('Server connection error');
		$row = mysqli_fetch_array($result);

		$realCode = $row['verification_code'];

		if($code == $realCode) {
			$query = "UPDATE users SET is_email_verified = '1' WHERE id = '$userid'";
			mysqli_query($connect, $query) or die('Server connection error');

			die('SUCCESS');
		}
		die('The code you entered is not correct. Please try again.');
	}
}
die('Server connection error');

?>