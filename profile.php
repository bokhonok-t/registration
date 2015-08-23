<!DOCTYPE>
<html>
	<head>
	</head>
	<body>
		<form method="post">
		<input name = "logout" value="logout" type="submit">
		</form>
<?
if(isset($_POST["logout"])){
	session_unset();
	session_destroy();
	header("Location: enter.php");
	exit;
}
   ?>
	</body>
</html>