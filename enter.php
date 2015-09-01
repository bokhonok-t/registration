<?
session_start();
include 'db.php';
if($_SESSION['id'] != NULL){
	header ('Location: profile.php');
	exit;
}
?>
<!DOCTYPE>
<html>
	<head>
		<meta charset="utf-8">
		<link rel="stylesheet" type="text/css" href="style.css">
		<title>Авторизация</title>
	</head>
	<body>
		
		<div class="lang">
						<form method="get">
				<input name = "en" value="en" type="submit" title="Translate to English">
				<input name = "ru" value="ru" type="submit" title="Перевести страницу на русский язык">
			</form>
		</div>
<?
	if (isset($_GET['ru'])){
		$_SESSION['lang'] = $_GET['ru'];
		require ("languages/ru.php");
	}
	elseif (isset($_GET['en'])){
		$_SESSION['lang'] = $_GET['en'];
		require ("languages/en.php");
	}
	else require("languages/ru.php");
?>
		<div class = "form">
			<p><? echo $autho?></p>
			<div class = "fields">
				<form method="post">
				<input type="text" id="login" name="login" required placeholder="<? echo $name?>"/>
				<input type="password" id="pass" name="pass" required placeholder="<? echo $pass?>"/>
				<input type="submit" name = "signin" value="<? echo $in?>">
					<a href="index.php"><? echo $reg?></a>
				</form>
			</div>
		</div>
<?
	$login = $_POST['login'];
	$pass = $_POST['pass'];
if(isset($_POST['signin'])){
	if($login != "" && $pass != ""){
		setcookie ("login", $login, time() + 50000, '/');
		setcookie ("pass", md5($login.$pass), time() + 50000, '/'); //хешируем пароль
		$salt = mysql_query('SELECT salt FROM user WHERE login="'.$login.'";') or die(mysql_error());
		$row = mysql_fetch_assoc($salt);
		$key = $row[salt];
		$data = mysql_query('SELECT * FROM user WHERE login ="'.$login.'" AND pass = "'.md5(md5($pass).$key).'"') or die(mysql_error());
		if(mysql_num_rows($data)<1){
			echo '<div class = "error">
					<p>'.$warn3.'</p>
			</div>';
		}
		else{
		$arr = mysql_fetch_assoc($data);
		
		$_SESSION['id'] = $arr['id'];
		header('Location: profile.php');
		exit;
		}
}
}
?>
	</body>
</html>