<?
session_start();
include 'db.php';
?>
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
				<input type="text" id="login" name="login" required placeholder="Логин"/>
				<input type="password" id="pass" name="pass" required placeholder="Пароль"/>
				<input type="submit" name = "signin" value="Войти">
					<a href="index.php">Регистрация</a>
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
		foreach($row as $k=>$v)	$key = $v;
		$data = mysql_query('SELECT * FROM user WHERE login ="'.$login.'" AND pass = "'.md5(md5($pass).$key).'"') or die(mysql_error());
		if(mysql_num_rows($data)<1){
			echo ("error");
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