<?
session_start();
include_once 'db.php';
if($_SESSION['id'] == NULL){
	header ('Location: enter.php');
	exit;
}
if($_SESSION['lang'] == "en"){
	require('languages/en.php');
}
elseif($_SESSION['lang'] == "ru"){
	require ('languages/ru.php');
}
else require ('languages/ru.php');
?>
<!DOCTYPE>
<html>
	<head>
		<link rel="stylesheet" type="text/css" href="profile.css">
	</head>
	<body>
				
		</div>
		<header>
			<form method="post">
				<input name = "logout" value="<? echo $log?>" type="submit">
			</form>
		</header>

<?

$sql = mysql_query('SELECT * from user where id ="'.$_SESSION['id'].'"') or die (mysql_error());
$data = mysql_fetch_assoc($sql);
$data[date_of_birth] = date("d.m.Y");
if(isset($_POST["logout"])){
	session_unset();
	session_destroy();
	header("Location: enter.php");
	exit;
}

   ?>
	<div class="info">
		<div class="data">
			<table> 
				<tr><th><? echo $data[f_name]?> <? echo $data[l_name]?></th></tr>
		<tr>
			<td><? echo $birthday?>:</td>
			<td> <? echo $data[date_of_birth]?></td></tr>
		<tr>
			<td><? echo $ph?>:</td>
			<td> <? echo $data[phone]?></td></tr>
		<tr>
			<td>E-mail:</td>
			<td> <? echo $data[email]?></td></tr>
		<tr>
			<td><? echo $address?>:</td>
			<td> <? echo $data[address]?></td></tr>
				</table>
		</div>
		<div class = "photo"><img src="<? echo $data[photo]?>"/></div>
	</div>
	</body>
</html>