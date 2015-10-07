<?
	session_start();
	include 'db.php';
include 'response.php';
	if($_SESSION['lang'] == "en"){
		include('languages/en.php');
	}
	else include('languages/ru.php');
?>
<!DOCTYPE>
<html>
	<head>
		<meta charset="UTF-8">
		<link type="text/css" rel="stylesheet" href="./style.css">
		<title><? echo $reg?></title>
		<script type="text/javascript" src="index.js"></script>
		<link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
		<script src="//code.jquery.com/jquery-1.10.2.js"></script>
		<script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
		<link href='https://fonts.googleapis.com/css?family=Roboto+Condensed:400,700' rel='stylesheet' type='text/css'>
	</head>
	<body>
		<div class = "form">
			<p><? echo $reg?></p>		
			<div class = "fields">
				<form name = "reg" method="post" action="index.php" enctype="multipart/form-data">
					<legend><span class="number">1</span><? echo $info?></legend>
					<input  type="text" id="lname" onblur = "validLName();" name="lname" required placeholder="<? echo $lname?>" alt="Фамилия">
					<div class="warn" id="warn_lname"></div>
					<input type="text" id="fname" onblur="validName();" name="fname"  required placeholder="<? echo $fname?>" >
					<div class="warn" id="warn_fname"></div>
					<input type="date" max = "2005-12-31" min = "1945-12-31" value="1983-01-01" id="datepicker" name="date" required placeholder="<? echo $birthday?>">
					<input type="text" id="address" onblur="validAdd();" name="address" required placeholder = "<? echo $address?>">
					<div class="warn" id="warn_add"></div>
					<input type="text" id="phone" name="phone" onblur="validPhone();" required placeholder="<? echo $phone?>">
					<div class="warn" id="warn_phone"></div>
					<input type="email" id="email" name="email" onblur="validMail();" required placeholder="E-mail">
					<div class="warn" id="warn_mail"></div>
				
					<legend><span class="number">2</span><? echo $info2?></legend>
					<input name="releFio" type="hidden">

					<input type="text" id="login" onblur="unique();" name="login" required placeholder="<? echo $name?>">
					<div class="warn" id="warn_login"></div>
					<input type="password" id="pass" onblur="validPass();" name="pass" required placeholder="<? echo $pass?>">
					<div class="warn" id="warn_pass_l"></div>
					<input type="password" id="cpass" onblur="equalPass();" name="cpass" required placeholder="<? echo $cpass?>">
					<div class="warn" id="warn_pass"></div>
					
					<legend><span class="number">3</span><? echo $photo?></legend>
					 <div class="file_upload">
        				<button type="button"><? echo $choose?></button>
        				<input type="file" id = "file" name = "userfile" value="<? echo $uploadfile?>" required onchange="validFile();">
    				</div>
					
					<div class="warn" id="war_file"></div>
					<input type="submit" name ="submit" value="<? echo $sign?>">
					
					</form>
			</div>
		</div>	
		<div id = "warn"></div>
	</body>
	
<?
$_SESSION['log'] = $_POST['login'];
if(isset($_POST['submit'])){
	$correct = registrationCorrect(); //записываем в переменную результат registrationCorrect()
	$uploaddir = 'img/profiles/'; //папка, где хранятся изображения
	$uploadfile = $uploaddir.basename($_FILES['userfile']['name']);
	//$whitelist = array(".jpg", ".gif", ".png");
 	//foreach ($whitelist as $item) {
		if(preg_match("/.jpg\$/i", $_FILES['userfile']['name']) or preg_match("/.gif\$/i", $_FILES['userfile']['name']) or preg_match("/.png\$/i", $_FILES['userfile']['name']) ) {//если формат изображения корректен
	
	if ($correct){ //если данные верны, запишем их в базу данных
		$fname = $_POST['fname'];
		$lname = $_POST['lname'];
		$dateb = $_POST['date'];
		$address = $_POST['address'];
		$phone = $_POST['phone'];
		$email = htmlspecialchars($_POST['email']);
		$log = htmlspecialchars($_POST['login']);
		
		$salt = mt_rand(100, 999); //переменная, чтобы обеспечить большую безопасность
		$pass = md5(md5($_POST['pass']).$salt); //хэш пароля
		$tm = date('Y-m-d');
	 	move_uploaded_file($_FILES['userfile']['tmp_name'], $uploadfile);//помещаем загруженный файл в папку		
			
		$sql = 'INSERT INTO user(f_name, l_name, date_of_birth, address, phone, email, login, pass, reg_date, last_act, salt, photo) VALUES("'.$fname.'", "'.$lname.'", "'.$dateb.'", "'.$address.'", "'.$phone.'", "'.$email.'", "'.$log.'", "'.$pass.'", "'.$tm.'", "'.$tm.'", "'.$salt.'", "'.$uploadfile.'")';

	if(!mysqli_query($dblink, $sql)){
		echo "error";
	}
	else{
		mysqli_free_result($sql);
		header('Location: enter.php'); //в случае удачной регистрации переход на страницу авторизации
		exit;
	}
		mysqli_close($dblink);
	}
		else echo '<div class = "error">'.$warn2.'</div>'; // вывод ошибки на выбраном ранее языке в случае неправильно заполнения одного из полей
		}
		else echo '<div class = "error">'.$warn.'</div>'; // вывод ошибки на выбраном ранее языке в случае загрузки неправильного формата картинки
	
}

function registrationCorrect() {
	if (!preg_match('/^([a-z0-9])(\w|[.]|-|_)+([a-z0-9])@([a-z0-9])([a-z0-9.-]*)([a-z0-9])([.]{1})([a-z]{2,4})$/is', $_POST['email'])) return false; //соответствует ли поле e-mail регулярному выражению
	if (!preg_match('/^([a-zA-Z0-9])(\w|-|_)+([a-z0-9])$/is', $_POST['login'])) return false; // соответствует ли логин регулярному выражению
	if (strlen($_POST['pass']) < 5) return false;//не меньше ли 5 символов длина пароля
	if ($_POST['pass'] != $_POST['cpass'])return false; //равен ли пароль его подтверждению
	
	$login = $_POST['login'];
	$res = mysql_query("SELECT * FROM user WHERE login=$login");
	if (mysql_num_rows($res) != 0)return false; // проверка на существование в БД такого же логина
	return true; //если выполнение функции дошло до этого места, возвращаем true 
}

?>
	
</html>