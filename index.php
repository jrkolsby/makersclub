<!DOCTYPE html>
<!-- Web Developer? Join the Lovett Makers Club! You would be a valuable member of our team! -->
<head>
<title>Makers Club</title>
<meta name="description" content="Lovett Maker's Club, home of the quadcopter">
<meta name="robots" content="ALL">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<link href="global.css" rel="stylesheet" type="text/css" />
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
<script type="text/javascript" src="sto/main.js"></script>
<?php
	if ($_GET["t"] == "true") {
		print "<script type='text/javascript'>$(document).ready(function() { sayThankYou(); });</script>";
	};
?>
</head>
<body>
<h1 id="thankyou">Thank you for signing up!</h1>
<a href="edit/"><div id="edit"></div></a>
<div id="about">
	<p>We are club that promotes the natural curiosity of how things work, how to make it better, and how it can potentially solve a problem. Throughout the course of the year, we will explore the workings of technologies prevalent in the modern age. By further investigating, we hope to gain a fuller comprehension of modern innovation.Long story short, any adventurous and creative minds would be at home in the makers club. Join today!</p>
	<p>The club leader is <b>James Kolsby</b>, and our club sponsor is <b>Karl Hwang</b></p>
</div>
<form id="signup" method="post" action="send.php">
<input name="name" value="Full Name" onfocus="if(this.value === 'Full Name'){this.value = ''}" onblur="if(this.value === ''){this.value = 'Full Name'}">
<input name="email" value="Email Address" onfocus="if(this.value === 'Email Address'){this.value = ''}" onblur="if(this.value === ''){this.value = 'Email Address'}">
<button type="submit">Submit</button>
</form>
<div id="shadow" onclick="toggleAbout(false);toggleSignUp(false)"></div>
<div id="header-large">
	<object id='logo' data='sto/logo.svg' type='image/svg+xml'><img src='sto/logo.png' /></object>
	<div id="buttons">
		<button onclick="toggleAbout(true)">About Us</button>
		<button>Resources</button>
		<button onclick="toggleSignUp(true)">Sign Up</button>
	</div>
</div>
<div id="header-small">
<ul>
<li onclick="toggleAbout(true)">About Us</li>
<li>Resources</li>
<li onclick="toggleSignUp(true)">Sign Up</li>
</ul>
</div>
<div id="content">
	<?php

	include 'credentials.php';

	$link = mysql_connect('localhost', $credentials['db_user'], $credentials['db_pass']); 
	if (!$link) { 
		die('Could not connect: ' . mysql_error());
	}
	mysql_select_db($credentials['db_name']);

	$query = "SELECT * FROM posts ORDER BY date DESC"; 
	$result = mysql_query($query) or die(mysql_error());
	while($row = mysql_fetch_array($result)){
			print "<div class='post'><div class='main'>";
			print "<div class='image' style='background:url(" . $row[main] . ") 50% 50%; background-size: cover;'></div></div>";
			print "<h1>" . nl2br($row[title]) . "</h1>";
			print "<h2>" . date("M", $row[date]) . "<br/><span>" . date("d", $row[date]) . "</span></h2>";
			print "<h3>" . nl2br($row[body]) . "</h3></div>";
	}
	?>
</div>