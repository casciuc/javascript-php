<?php
	require_once('checkAuth.php');
	session_start();
	if (isset($_POST['editprofile'])) {
		$password = $_POST['password'];
		$r_password = $_POST['r_password'];
		$old_password = $_POST['old_password'];
	}
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Editeaza profil</title>
</head>
<body>
	<form action="editprofile.php" method="post">
		<h3>Schimba parola</h3>
		<table style="margin: 0 auto;">
			<tr>
				<td style="text-align: left;">
					<label>Parola noua</label>
				</td>
				<td>
					<input type="password" name="password">
				</td>
			</tr>
			<tr>
				<td style="text-align: left;">
					<label>Repeta parola</label>
				</td>
				<td>
					<input type="password" name="r_password">
				</td>
			</tr>
			<tr>
				<td style="text-align: left;">
					<label>Parola recenta</label>
				</td>
				<td>
					<input type="password" name="old_password">
				</td>
			</tr>
			<tr>
				<td colspan="2">
					<input type="submit" name="editprofile" value="Schimba">
				</td>
			</tr>
		</table>
	</form>
</body>
</html>