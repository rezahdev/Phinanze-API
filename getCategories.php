<?php
/*
	* Read categories from database 
	* Return the categories to Phinanze app
*/
require_once('connectDB.php');
require_once('requestVerification.php');

if(isset($_POST['token']) && isset($_POST['userid'])) {
	$token  = mysqli_real_escape_string($connect, $_POST['token']);
	$userid = mysqli_real_escape_string($connect, $_POST['userid']);
	
	if(IsAuthenticRequest($connect, $userid, $token)) {			
		$query  = "SELECT * FROM categories WHERE userid = '$userid'";
		$result = mysqli_query($connect, $query) or die('Server connection error');
		$row    = mysqli_fetch_array($result);		
		$data   = $row['earningCategories'] . '^' . $row['expenseCategories'];
		
		die($data);
	}
}
die('Server connection error');

?>