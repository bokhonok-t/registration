<?
session_start();
if($_SESSION['id'] != NULL){
	header ('Location: profile.php');
	exit;
}
else {
	header ('Location: enter.php');
	exit;
}
?>