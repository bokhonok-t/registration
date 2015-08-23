<?
$server = 'localhost';
$user = 'root';
$password = '';
$dblink = mysql_connect($server, $user, $password);
$database = 'shop';
$selected = mysql_select_db($database, $dblink);
?>