<?
	session_start();
	include 'db.php';
?>
<!DOCTYPE>
<html>
	<head>
		<meta charset="UTF-8">
		<link type="text/css" rel="stylesheet" href="./style.css">
		<title>Регистрация</title>
		<script type="text/javascript" src="index.js"></script>
		<link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
		<script src="//code.jquery.com/jquery-1.10.2.js"></script>
		<script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
  	<script>
  		$(function() {
    		$( "#datepicker" ).datepicker({dateFormat:'yy-mm-dd'});
  		});
  	</script>
	</head>
	<body>
		<div class = "form">
			<p>Регистрация</p>		
			<div class = "fields">
				<form method="post" action="index.php">
					<legend><span class="number">1</span>Личная информация</legend>
					<input type="text" id="user" name="lname" required placeholder="Фамилия">
					<input type="text" id="user" name="fname"  required placeholder="Имя">
					<input type="text" id="datepicker" name="date" required placeholder="Дата Рождения">
					<input type="text" id="address" name="address" required placeholder = "Адрес">
					<input type="text" id="phone" name="phone" onblur="validPhone();" required placeholder="Моб. номер">
					<input type="email" id="email" name="email" onblur="validMail();" required placeholder="E-mail">
				
					<legend><span class="number">2</span>Основная информация</legend>
					<input type="text" id="user" name="login" required placeholder="Логин">
					<input type="password" id="pass" name="pass" required placeholder="Пароль">
					<input type="password" id="pass" name="cpass" required placeholder="Повторите пароль">
				
					<legend><span class="number">3</span>Фотография</legend>
					<input type="file">
					<input type="submit" name ="submit" value="Зарегистрировать">
					</form>
			</div>
		</div>	
		<div id = "warn"></div>
	</body>
	
<?
if(isset($_POST['submit'])){
$correct = registrationCorrect(); //записываем в переменную результат работы функции registrationCorrect()
if ($correct){ //если данные верны, запишем их в базу данных
	$fname = $_POST['fname'];
	$lname = $_POST['lname'];
	$date = $_POST['date'];
	$address = $_POST['address'];
	$phone = $_POST['phone'];
	$email = htmlspecialchars($_POST['email']);
	$log = htmlspecialchars($_POST['login']);
	$salt = mt_rand(100, 999); //переменная, чтобы обеспечить большую безопасность
	$pass = md5(md5($_POST['pass']).$salt); //хэш пароля
	$tm = date('Y-m-d');

	$sql = 'INSERT INTO user(f_name, l_name, date_of_birth, address, phone, email, login, pass, reg_date,
	last_act, salt) VALUES("'.$fname.'", "'.$lname.'", "'.$date.'", "'.$address.'", "'.$phone.'", "'.$email.'", "'.$log.'", "'.$pass.'", "'.$tm.'", "'.$tm.'", "'.$salt.'")';

	if(!mysql_query($sql)){
		echo "error";
	}
	else{ //авторизуем пользователя, если регистрация прошла удачно, создав куки
		setcookie ("login", $login, time() + 50000, '/');
		setcookie ("pass", md5($login.$pas), time() + 50000, '/'); //хешируем пароль
		$res = mysql_query("SELECT * FROM user WHERE login=".$login);
		@$row = mysql_fetch_assoc($res);
		$_SESSION['id'] = $row['id'];
		$regged = true; //флаг "успешная регистрация"
		header('Location: enter.php');
		exit;
	}
}
	else{
		echo "error validation";
	}
}
function registrationCorrect() {
	if (!preg_match('/^([a-z0-9])(\w|[.]|-|_)+([a-z0-9])@([a-z0-9])([a-z0-9.-]*)([a-z0-9])([.]{1})([a-z]{2,4})$/is', $_POST['email'])) return false; //соответствует ли поле e-mail регулярному выражению
	if (!preg_match('/^([a-zA-Z0-9])(\w|-|_)+([a-z0-9])$/is', $_POST['login'])) return false; // соответствует ли логин регулярному выражению
	if (strlen($_POST['pass']) < 5){
		echo "strlen";
		return false;
	}//не меньше ли 5 символов длина пароля
	if ($_POST['pass'] != $_POST['cpass']){
		echo "password";
		return false;
	} //равен ли пароль его подтверждению
	$login = $_POST['login'];
	$res = mysql_query("SELECT * FROM user WHERE login=$login");
	if (mysql_num_rows($res) != 0) return false; // проверка на существование в БД такого же логина
	return true; //если выполнение функции дошло до этого места, возвращаем true 
}

?>
	
</html>