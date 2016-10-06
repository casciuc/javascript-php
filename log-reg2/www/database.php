<?
/**
  * Функция для подключения к СУБД MySQL.
  * Функция не принимает никаких параметров.
  * Функция предназначена для использования, в основном,
  * с одной базой данных
  */
function connect() {
	// Объявляем переменные, в которых будут храниться параметры для подключения к СУБД
	$db_host = 'localhost';				// Сервер
	$db_user = 'root';			// Имя пользователя
	$db_password = '';	// Пароль пользователя
	$db_name = 'testtable';				// Имя базы данных
	
	// Подключаемся к серверу
	$conn = mysql_connect($db_host, $db_user, $db_password) or die("<p>nu putem conecta bd: " . mysql_error() . ". Greseala a fost comisa in linia " . __LINE__ . "</p>");
	
	// Эта часть кода выполнится только в случае успешного подключения к серверу
	// Выбираем базу данных
	$db = mysql_select_db($db_name, $conn) or die("<p>Nu este posibil conectarea la baza de date: " . mysql_error() . ". Greseala este in linia " . __LINE__ . "</p>");
	
	// Эта часть кода выполняется только в случае успешного подключения к БД
	// Указываем серверу, что данные, которые мы от него получаем, нам нужны в кодировке UTF-8
	$query = mysql_query("set names utf8", $conn) or die("<p>nu este posibil de efectuat cerere la baza de date: " . mysql_error() . ". Greseala este in linia " . __LINE__ . "</p>");
}
?>