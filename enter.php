<!DOCTYPE>
<html>
	<head>
		<meta charset="utf-8">
		<link rel="stylesheet" type="text/css" href="style.css">
		<title>Авторизация</title>
	</head>
	<body>
		<div class = "form">
			<p>Авторизация</p>
			<div class = "fields">
				<form method="post">
				<input type="text" id="login" name="login" placeholder="Логин"/>
				<input type="password" id="pass" name="pass" placeholder="Пароль"/>
				<input type="submit" name = "signin" value="Войти">
					<a href="index.php">Регистрация</a>
				</form>
			</div>
		</div>
<?
	$login = $_POST['login'];
	$pass = $_POST['pass'];
if(isset($_POST['signin'])){
	setcookie ("login", $login, time() + 50000, '/');
	setcookie ("pass", md5($login.$pas), time() + 50000, '/'); //хешируем пароль
	$res = mysql_query("SELECT * FROM user WHERE login=".$login);
	@$row = mysql_fetch_assoc($res);
	$_SESSION['id'] = $row['id'];
	$regged = true; //флаг "успешная регистрация"
	header('Location: profile.php');
	exit;
}
?>
	</body>
</html>