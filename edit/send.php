<?php

function validate($input) {
	$input = str_replace("'", "&#39;", $input);
	$input = str_replace("<", "&#60;", $input);
	$input = str_replace(">", "&#62;", $input);
	return $input;
}

$title = $_POST[title];
$title = validate($title);
$date = $_POST[date];
$curdate = time();
$body = $_POST[body];
$body = validate($body);
$main = $_POST[main];
$update = false;
$delete = $_POST[delete];

include '../credentials.php';

$link = mysql_connect('localhost', $credentials['db_user'], $credentials['db_pass']); 
if (!$link) { 
	die('Could not connect: ' . mysql_error());
}
mysql_select_db($credentials['db_name']);

if ($delete == "1") {
	mysql_query("DELETE FROM posts WHERE date='$date'");
	print "<meta http-equiv='REFRESH' content='0;url=../'>";
} else {
	$query = "SELECT * FROM posts"; 
	$result = mysql_query($query) or die(mysql_error());
	while($row = mysql_fetch_array($result)){
		if ($row[date] == $date) {
			$update = true;
		}
	}
	if ($update) {
		mysql_query("UPDATE posts SET title='$title', body='$body', main='$main' WHERE date='$date'");
		print "<meta http-equiv='REFRESH' content='0;url=../'>";
	} else {
		mysql_query("INSERT INTO posts (`title`, `body`, `main`, `date`) VALUES ('$title', '$body', '$main', '$date')");
		print "<meta http-equiv='REFRESH' content='0;url=../'>";
	}
}

?>