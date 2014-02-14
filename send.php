<!DOCTYPE html>
<head>
<title>...</title>
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
<script type="text/javascript">
	var submitForm = function() {
		$("#hiddenForm").submit();
	};
</script>
</head>
<?php
	function validate($input) {
		$input = str_replace("'", "&#39;", $input);
		$input = str_replace("<", "&#60;", $input);
		$input = str_replace(">", "&#62;", $input);
		return $input;
	}
	$name = $_POST["name"];
	$email = $_POST["email"];
	$name = validate($name);
	$email = validate($email);
	
	include 'credentials.php';

	$link = mysql_connect('localhost', $credentials['db_user'], $credentials['db_pass']); 
	if (!$link) { 
		die('Could not connect: ' . mysql_error());
	}
	mysql_select_db($credentials['db_name']);
	
	if (isset($name) && isset($email) && $name !== "Full Name" && $email !== "Email Address") {
		$message = "Welcome to the Makers Club, $name\r\n\r\nThis email is automatically sent to give some basic information about our club." . "\r\n" .  "Throughout the year we will be looking at working on a range of projects involving modern technology and engineering. If you have any ideas or questions, please feel free to email James Kolsby at jrkolsby@lovett.org, Karl Hwang at khwang@lovett.org, or just bring them up during one of our meetings. Check your email at $email to stay updated";
		$mail = mail($email, "Welcome to the Makers Club", $message);
		if (!!$mail) {
			$message = "$name\r\n$email\r\n\r\nUpdated Email List:\r\n";
			$query = "SELECT * FROM members"; 
			$result = mysql_query($query) or die(mysql_error());
			$newEmail = true;
			while($row = mysql_fetch_array($result)){
				$message .= $row[email];
				$message .= "\r\n";
				if ($row[email] == $email) {
					$newEmail = false;
				}
			};
			if ($newEmail) {
				mysql_query("INSERT INTO members (`email`, `name`) VALUES ('$email', '$name')");
				$message .= $email . "\r\n";
				mail("jrkolsby@lovett.org", "New Maker", $message);
			}
			print "<script type='text/javascript'>$(document).ready(function() { submitForm() });</script>";
		} else {
			print "<meta http-equiv='REFRESH' content='0;url=sto/../'>";			
		}
	} else {
		print "<meta http-equiv='REFRESH' content='0;url=sto/../'>";
	}
?>
<form id="hiddenForm" action="sto/../" method="get">
<input name="t" type="hidden" value="true">
</form>