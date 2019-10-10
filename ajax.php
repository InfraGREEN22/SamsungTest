<script type="text/javascript">
	console.log("Entered ajax.php");
</script>>

<?php

	// загружаем OMDb API PHP Wrapper
	require 'vendor\autoload.php';

	$omdb = new Rooxie\OMDb('4f1e48cb');

	$user = $_POST['fullName'];

	$username = explode("_", $user);

	// подключаемся к бд
	$connection = mysqli_connect('localhost', 'alex', '123456789', 'users');

	// проверяем соединение
	if(!$connection) {
		echo "Connection error: " . mysqli_connect_error();
	}

	echo '<script type="text/javascript">console.log(' . "'" .$username[0] . "'" . ');</script>';
	echo '<script type="text/javascript">console.log(' . "'" .$username[1] . "'" . ');</script>';

	$sql = "SELECT favourite_movies FROM users WHERE firstName='$username[0]' AND lastName='$username[1]'";

	$result = mysqli_query($connection, $sql);
	$str = mysqli_fetch_array($result);
	$movies = explode(',', $str[0]);

	echo '<script type="text/javascript">console.log(' . "'" . $movies[0] . "'" . ');</script>';

	//echo '<script type="text/javascript">console.log(' . "'" .$movies[0] . "'" . ');</script>';
	foreach ($movies as $movie) {
		$title = $omdb->getByImdbId($movie);
		echo '<option value="' . $movie . '">' . $title->getTitle() . '</option>';
	}
?>