<?
/**
  * registration.php
  * Страница регистрации пользователей. Предполагается, что в вашей
  * базе данных присутствует таблица пользователей users, в которой
  * есть поля id, login, password, reg_date
  */
  
// Подключаем файл с пользовательскими функциями
require_once('functions.php');

// Инициализируем переменные для введенных значений и возможных ошибок
$errors = array();
$fields = array();

// Заранее инициализируем переменную регистрации, присваивая ей ложное значение
$reg = false;

// Если была нажата кнопка регистрации
if(isset($_POST['submit'])) {
	// Делаем массив сообщений об ошибках пустым
	$errors['login'] = $errors['password'] = $errors['password_again'] = '';
	
	// С помощью стандартной функции trim() удалим лишние пробелы
	// из введенных пользователем данных
	$fields['login'] = trim($_POST['login']);
	$password = trim($_POST['password']);
	$password_again = trim($_POST['password_again']);
	
	// Если логин не пройдет проверку, будет сообщение об ошибке
	$errors['login'] = checkLogin($fields['login']) === true ? '' : checkLogin($fields['login']);
	
	// Если пароль не пройдет проверку, будет сообщение об ошибке
	$errors['password'] = checkPassword($password) === true ? '' : checkPassword($password);
	
	// Если пароль введен верно, но пароли не идентичны, будет сообщение об ошибке
	$errors['password_again'] = (checkPassword($password) === true && $password === $password_again) ? '' : 'Parola introdusa nu corespunde';
	
	// Если ошибок нет, нам нужно добавить информацию о пользователе в БД
	if($errors['login'] == '' && $errors['password'] == '' && $errors['password_again'] == '') {
		// Вызываем функцию регистрации, её результат записываем в переменную
		$reg = registration($fields['login'], $password);
		
		// Если регистрация прошла успешно, сообщаем об этом пользователю
		// И создаем заголовок страницы, который выполнит переадресацию к форме авторизации
		if($reg === true) {
			$message = '<p>Ati fost Inregistrare cu succes. Acum veti trece l pagina de logare. Daca nu ati fost redirectionat treceti pe <a href="login.php">lincul&nbsp;direct</a>.</p>';
			header('Refresh: 5; URL = login.php');
		}
		// Иначе сообщаем пользователю об ошибке
		else {
			$errors['full_error'] = $reg;
		}
	}
}
?>
<html>
<head>
	<title>Inregistrarea utilizatorului</title>
	<link href="style.css" rel="stylesheet" type="text/css" />
</head>
<body>
<?
// Показываем форму только если пользователь еще не запустил процесс регистрации, 
// и если регистрация не была успешной
if($reg !== true) {
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
			<label for="login">Introduceti login:</label>
			<input type="text" class="text" name="login" id="login" value="<?=$fields['login'];?>" />
			<div class="error" id="login-error"><?=$errors['login'];?></div>
			<div class="instruction" id="login-instruction">In numele utilizatorului pot fi doar caractere latine, cifre, simboluri '_', '-', '.'. lungimea numeleui trebuie sa fie nu mai mica de 4 si nu mai mare de 16 simboluri</div>
		</div>
		<div class="row">
			<label for="password">Introduceti parola:</label>
			<input type="password" class="text" name="password" id="password" value="" />
			<div class="error" id="password-error"><?=$errors['password'];?></div>
			<div class="instruction" id="password-instruction">In parola puteti folosi doar caractere latine, cifre, simboluri '_', '!', '(', ')'. Parola nu trebuie sa fie mai mica de 6 si mai mare de 16 caractere</div>
		</div>
		<div class="row">
			<label for="password_again">Repetati parola:</label>
			<input type="password" class="text" name="password_again" id="password_again" value="" />
			<div class="error" id="password_again-error"><?=$errors['password_again'];?></div>
			<div class="instruction" id="password_again-instruction">Repetati parola introdusa recent</div>
		</div>
		<div class="row">
			<!-- Кнопка отправки данных формы -->
			<input type="submit" name="submit" id="btn-submit" value="Inregistrare" />
			
			<!-- Кнопка сброса полей формы к исходному состоянию -->
			<input type="reset" name="reset" id="btn-reset" value="Clear" />
		</div>
	</form>
<?
}	// закрывающая фигурная скобка условия проверки запущенного процесса регистрации
// Если регистрация прошла успешно, сообщаем об этом
else {
	print $message;
}
/**
  * Если всё пройдет как положено, вы сможете попробовать 
  * зарегистрировать такого же точно пользователя. Скрипт 
  * должен будет сообщить об ошибке
  */
?>
</body>
</html>