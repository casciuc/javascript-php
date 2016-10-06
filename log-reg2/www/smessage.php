<?php
	require_once "functions.php";
	session_start();
	if (!checkAuth($_SESSION["login"], $_SESSION["password"])) {
		header("Location: /");
		exit;
	}
	
	$user = getUserOnID($_GET["to"]);

	if (isset($_POST["smessage"])) {
		$message = $_POST["message"];
		$to = $_POST["to"];
		$from = getIDOnLogin($_SESSION["login"]);
		addMessage($from, $to, $message);
		$_SESSION["pm"] == 1;
	}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Trimite mesage</title>
</head>
<body>
	<div>
		<?php
			if ($_SESSION["pm"] == 1) {
				echo "<p style='color: green;'>Mesajul dvs a fost tirmis cu succes</p>";
				unset($_SESSION["pm"]);
			}
		?>

		<h1>Trimite mesajul utilizatorului <?php echo $user["login"]; ?></h1>
		<form action="smessage.php?to=<?php echo $_GET["to"]; ?>" id="form_message" method="post">
			<p>
					<label>Mesajul dvs</label>
					<br>
					<textarea name="message" id="textarea_message" cols="40" rows="10"></textarea>
			</p>
			<p>
			<input type="hidden" name="to" value="<?php echo $_GET["to"]; ?>">
				<input type="submit" name="smessage" value="trimite">
			</p>

		</form>
	</div>
</body>
</html>