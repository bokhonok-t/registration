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
				<form method="post" action="index.php" enctype="multipart/form-data">
					<legend><span class="number">1</span>Личная информация</legend>
					<input type="text" id="user" name="lname" required placeholder="Фамилия">
					<input type="text" id="user" name="fname"  required placeholder="Имя">
					<input type="text" id="datepicker" name="date" required placeholder="Дата Рождения">
					<input type="text" id="address" name="address" required placeholder = "Адрес">
					<input type="text" id="phone" name="phone" onblur="validPhone();" required placeholder="Моб. номер">
					<div class="warn" id="warn_phone"></div>
					<input type="email" id="email" name="email" onblur="validMail();" required placeholder="E-mail">
					<div class="warn" id="warn_mail"></div>
				
					<legend><span class="number">2</span>Основная информация</legend>
					<input type="text" id="login" onblur="unique();" name="login" required placeholder="Логин">
					<input type="password" id="pass" name="pass" required placeholder="Пароль">
					<input type="password" id="cpass" onblur="equalPass();" name="cpass" required placeholder="Повторите пароль">
					<div class="warn" id="warn_pass"></div>
					
					<legend><span class="number">3</span>Фотография</legend>
					<input type="file" name = "userfile">
					<input type="submit" name ="submit" value="Зарегистрировать">
					
					</form>
			</div>
		</div>	
		<div id = "warn"></div>
	</body>
	
<?
if(isset($_POST['submit'])){
	$correct = registrationCorrect(); //записываем в переменную результат registrationCorrect()
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
		
		$uploaddir = 'img/profiles/'; //папка, где хранятся изображения
		$uploadfile = $uploaddir.basename($_FILES['userfile']['name']);
		move_uploaded_file($_FILES['userfile']['tmp_name'], $uploadfile);//помещаем загруженный файл в папку
		$fullpath = $uploaddir.$uploadfile;
		$mime = $_FILES["userfile"]["type"]; //узнаем расширение
		if ($mime != "image/gif" and $mime !="image/jpg" and $mime !="image/png") {
    		echo '<div class="warn_img">("Доступна загрузка только gif, png, jpg, файлов")</div>';
}
		
		$sql = 'INSERT INTO user(f_name, l_name, date_of_birth, address, phone, email, login, pass, reg_date, last_act, salt, photo) VALUES("'.$fname.'", "'.$lname.'", "'.$date.'", "'.$address.'", "'.$phone.'", "'.$email.'", "'.$log.'", "'.$pass.'", "'.$tm.'", "'.$tm.'", "'.$salt.'", "'.$fullpath.'")';

	if(!mysql_query($sql)){
		echo "error";
	}
	else{ //авторизуем пользователя, если регистрация прошла удачно, создав куки
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
	if (strlen($_POST['pass']) < 5) return false;//не меньше ли 5 символов длина пароля
	if ($_POST['pass'] != $_POST['cpass'])return false; //равен ли пароль его подтверждению
	$login = $_POST['login'];
	$res = mysql_query("SELECT * FROM user WHERE login=$login");
	if (mysql_num_rows($res) != 0) return false; // проверка на существование в БД такого же логина
	return true; //если выполнение функции дошло до этого места, возвращаем true 
}

?>
	
</html>