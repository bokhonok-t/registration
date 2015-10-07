<?
session_start();
require 'db.php';
global $_POST;
if($_POST['action']){
	$row = mysqli_query($dblink, 'SELECT login FROM user WHERE login ="'.$_POST['user'].'"') or die(mysql_error());
	if(mysqli_num_rows($row) !=0) echo "on";
	else echo "off";
}
?>