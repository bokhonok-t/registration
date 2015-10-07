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
		<link href='https://fonts.googleapis.com/css?family=Open+Sans:400,300' rel='stylesheet' type='text/css'>
		<link href='https://fonts.googleapis.com/css?family=Roboto+Condensed:400,300' rel='stylesheet' type='text/css'>
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
		<script src="//code.jquery.com/jquery-1.10.2.js"></script>
		<script src="index.js"></script>
	</head>
	<body>

		</div>
		<header>
			<form method="post">
				<input name = "logout" value="<? echo $log?>" type="submit">
			</form>
		</header>

<?

$sql = mysqli_query($dblink, 'SELECT * from user where id ="'.$_SESSION['id'].'"') or die (mysql_error($dblink));
$data = mysqli_fetch_assoc($sql);
mysqli_free_result($sql);
mysqli_close($dblink);
$newdate = date("d.m.Y", strtotime($data[date_of_birth]));
if(isset($_POST["logout"])){
	session_unset();
	session_destroy();
	header("Location: enter.php");
	exit;
}

   ?>
	<div class="info">
		<div class = "photo"><img src="<? echo $data[photo]?>"/></div>
		<div class="user_name"><? echo $data[f_name]?> <? echo $data[l_name]?></div>
		<div class="user_location"><i class="icon fa fa-map-marker"></i><div class="location"><? echo $data[address]?></div></div>
		<div id="open">О себе</div>
		<div id="info">
			<table>
				<tr>
					<td class="user_info_title"><? echo $birthday?>:</td>
					<td class="user_info"> <? echo $newdate?></td>
				</tr>
				<tr>
					<td class="user_info_title"><? echo $ph?>:</td>
					<td class="user_info"> <? echo $data[phone]?></td>
				</tr>
				<tr>
					<td class="user_info_title">E-mail:</td>
					<td class="user_info"> <? echo $data[email]?></td>
				</tr>
			</table>
		</div>
	</div>
	</body>
</html>
