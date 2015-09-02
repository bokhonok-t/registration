<?
session_start();
include_once 'db.php';
?>
<div class="lang">
						<form method="get">
				<input name = "en" value="en" type="submit" title="Translate to English">
				<input name = "ru" value="ru" type="submit" title="Перевести страницу на русский язык">
			</form>
		</div>

<?

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

if(isset($_GET['ru'])) {
	$_SESSION['lang'] = $_GET['ru'];
	require ("languages/ru.php");
}
elseif (isset($_GET['en'])){
	$_SESSION['lang'] = $_GET['en'];
	require ("languages/en.php");
}
else require("languages/ru.php");
?>
<!DOCTYPE>
<html>
	<head>
		<link rel="stylesheet" type="text/css" href="profile.css">
		<title>Профиль</title>
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
$newdate = date("d.m.Y", strtotime($data[date_of_birth]));
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
			<td> <? echo $newdate?></td></tr>
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