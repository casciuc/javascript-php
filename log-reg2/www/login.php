<?
/**
  * Страница авторизации пользователей. Предполагается, 
  * что в вашей базе данных присутствует таблица users,
  * в которой существуют поля id, login и password
  */
// Подлючаем файл с пользовательскими функциями
require_once('functions.php');

// Заранее инициализируем переменную авторизации, присвоив ей ложное значение
$auth = false;

// Если была нажата кнопка авторизации
if(isset($_POST['submit'])) {
	// Делаем массив сообщений об ошибках пустым
	$errors['login'] = $errors['password'] = $errors['password_again'] = '';
	
	// С помощью стандартной функции trim() удалим лишние пробелы
	// из введенных пользователем данных
	$login = trim($_POST['login']);
	$password = trim($_POST['password']);
	
	// Авторизуем пользователя
	// Вызываем функцию регистрации, её результат записываем в переменную
	$auth = authorization($login, $password);
	
	// Если авторизация прошла успешно, сообщаем об этом пользователю
	// И создаем заголовок страницы, который выполнит переадресацию на защищенную
	// от общего доступа страницу
	if($auth === true) {
		$message = '<p>Ati intrat in sistema cu succes. Acum veti si redirectionati pe pagina principala. Daca aceasta nu sa intimplat, treceti pe ea prin <a href="/">link&nbsp;direct</a>.</p>';
		header('Refresh: 5; URL = /');
	}
	// Иначе сообщаем пользователю об ошибке
	else {
		$errors['full_error'] = $auth;
	}
}
?>
<html>
<head>
	<title>Autorizarea utilizatorilor</title>
	<meta content="text/html; charset=UTF-8" http-equiv="Content-Type" />
	<link href="style.css" rel="stylesheet" type="text/css" />
	<script>
		window.onload = function() {
			document.getElementById('login').ontextInput = function() {
				alert(this.data);
			},
			focus = function() {
				alert("ok");
			}
			;
		};
	</script>
</head>
<body>
<?
// Если запущен процесс авторизации, но она не была успешной,
// или же авторизация еще не запущена, отображаем форму авторизации
if($auth !== true) {
?>
	<!-- Блок для вывода сообщений об ошибках -->
	<div id="full_error" class="error" style="display:
	<?
	echo $errors['full_error'] ? 'inline-block' : 'none';
	?>
	;">
	<?
	// Выводим сообщение об ошибке, если оно есть
	echo $errors['full_error'] ? $errors['full_error'] : '';
	?>
	</div>
	<form action="" method="post">
		<div class="row">
			<label for="login">Login:</label>
			<input type="text" class="text" name="login" id="login" />
		</div>
		<div class="row">
			<label for="password">Parola:</label>
			<input type="password" class="text" name="password" id="password" />
		</div>
		<div class="row">
			<input type="submit" name="submit" id="btn-submit" value="Autorizare" />
		</div>
	</form>
	<p class="to_reg">Daca nu sunteti inregistrat, <a href="registration.php">Inregistrativa</a>.</p>
<?
}	// Закрывающая фигурная скобка условного оператора проверки успешной авторизации
// Иначе выводим сообщение об успешной авторизации
else {
	print $message;
}

/**
  * Если всё правильно, будет выведено сообщение об успешной авторизации,
  * пользователь будет переадресован на защищенную страницу
  */
?>
</body>
</html>