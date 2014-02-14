<!DOCTYPE html>
<!-- Web Developer? Join the Lovett Makers Club! You would be a valuable member of our team! -->
<head>
<title>Makers Club</title>
<meta name="description" content="Lovett Maker's Club, home of the quadcopter">
<meta name="robots" content="ALL">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<link href="../global.css" rel="stylesheet" type="text/css" />
<style type="text/css" media="only screen and (max-device-width: 1024px)">
body {
min-width: 1024px;
}
</style>
<style type="text/css" media="only screen and (max-device-width: 480px)">
body {
min-width: 480px;
}
</style>
<link href='http://fonts.googleapis.com/css?family=Open+Sans:400,700' rel='stylesheet' type='text/css'>
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
<script type="text/javascript" src="main.js"></script>
</head>
<body>
<a href="../"><div id="edit" class="close" style="background: url('../sto/close.png')"></div></a>
<div id="content">
<div id="add"></div>
<form id="new" class="post" method="post" action="send.php">
<div class="main">
<input name="main" class="main">
<div class="image" style="background: url('default.png') 50% 50%; background-size: cover;"></div></div>
<input name="title" class="title">
<input name="date" type="hidden" value="<?php echo time();?>">
<input name="delete" class="del" type="hidden" value="0">
<h2><?php echo date("M");?><br/><span><?php echo date("d");?></span></h2>
<textarea name="body" onkeyup="textAreaAdjust(this)"></textarea>
<button type="submit" class="submit"></button><button class="delete"></button></form>
	<?php
	include '../credentials.php';

	$link = mysql_connect('localhost', $credentials['db_user'], $credentials['db_pass']); 
	if (!$link) { 
		die('Could not connect: ' . mysql_error());
	}
	mysql_select_db($credentials['db_name']);
	
	$query = "SELECT * FROM posts ORDER BY date DESC"; 
	$result = mysql_query($query) or die(mysql_error());
	while($row = mysql_fetch_array($result)){
			print "<form class='post' method='post' action='send.php'><div class='main'>";
			print "<input name='main' class='main' value='" . $row[main] . "'>";
			print "<div class='image' style='background:url(" . $row[main] . ") 50% 50%; background-size: cover;'></div></div>";
			print "<input name='title' class='title' value='" . $row[title] . "'>";
			print "<input name='date' type='hidden' value='" . $row[date] . "'>";
			print "<input name='delete' class='del' type='hidden' value='0'>";
			print "<h2>" . date("M", $row[date]) . "<br/><span>" . date("d", $row[date]) . "</span></h2>";
			print "<textarea name='body' onkeyup='textAreaAdjust(this)'>" . $row[body] . "</textarea>";
			print "<button type='submit' class='submit'><button class='delete'></button></form>";
	}
	?>
</div>