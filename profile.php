<?
session_start();
include_once 'db.php';
?>
<!DOCTYPE>
<html>
	<head>
	</head>
	<body>
		<form method="post">
		<input name = "logout" value="logout" type="submit">
		</form>
<?

$sql = mysql_query('SELECT * from user where id ="'.$_SESSION['id'].'"') or die (mysql_error());
$data = mysql_fetch_assoc($sql);

if(isset($_POST["logout"])){
	session_unset();
	session_destroy();
	header("Location: enter.php");
	exit;
}
   ?>
		<p>Имя: <? echo $data[f_name]?></p>
		<p>Фамилия: <? echo $data[l_name]?></p>
		<p>Дата рождения: <? echo $data[date_of_birth]?></p>
		<p>Моб. номер: <? echo $data[phone]?></p>
		<p>E-mail: <? echo $data[email]?></p>
		<img src="<? echo $data[photo]?>"/>
	</body>
</html>