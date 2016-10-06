<?
/**
  * Защищенная страница. К ней возможен доступ только авторизованным
  * пользователям. Если пользователь не авторизован, ему предлагается 
  * авторизоваться, и доступ к сайту ограничивается. 
  */
require_once('checkAuth.php');
?>
<html>
<head>
	<title>Autorizarea si inregistrarea utilizatorilor</title>
</head>
<body>
<h1>Autentificare cu succes.</h1>
<p>Ati primit acces la pagina securizata. Acum puteti <a href="smessage.php">transmite mesaj</a> sau <a href="logout.php">Iesi</a> din profil.</p>
</body>
</html>