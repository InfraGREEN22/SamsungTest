<?php 

	// подключаемся к бд
	$connection = mysqli_connect('localhost', 'alex', '123456789', 'users');

	// проверяем соединение
	if(!$connection) {
		echo "Connection error: " . mysqli_connect_error();
	}

	// запрашиваем всех пользователей из бд
	$sql = "SELECT * FROM users";
	$result = mysqli_query($connection, $sql);

	// получаем результат; строки бд в качестве ассоциативного массива
	$users = mysqli_fetch_all($result, MYSQLI_ASSOC);

	// если кнопка на добавление фильма была нажата
	if(isset($_POST['submit_movie'])) {
		$id = $_POST['imdbid'];
		if($id[0] != 't' && $id[1] != 't') {
			echo '<div class="conatiner" style="color: red; font-size: 24;">';
			echo '<div class="row justify-content-center">';
			echo '<h4>The value for IMDB ID is invalid! It should start with "tt". Go back and check the validity of inputed value!</h4></div></div>';
			return;
		}
		$name = explode('_', $_POST['user_name']);
		echo $name[0] . ' ' . $name[1];

		$sql = "UPDATE users SET favourite_movies = CONCAT(favourite_movies, ',$id') WHERE firstName='$name[0]' AND lastName='$name[1]'"; 
		$result = mysqli_query($connection, $sql);

		header("Location: index.php");
	}

	// if the button for deleting movie was clicked
	if(isset($_POST['delete_movie'])) {
		// explode and foreach, than append every id which is not matching the input, then update
		$id = $_POST['select_movie'];
		$name = explode('_', $_POST['select_user']);

		$sql = "SELECT favourite_movies FROM users WHERE firstName='$name[0]' AND lastName='$name[1]'";
		$result = mysqli_query($connection, $sql);
		$str = mysqli_fetch_array($result);
		$movies = explode(',', $str[0]);

		// creating new string to replace existing string in a favourite_movies cell
		$newValue = '';

		// going throug each movie id and check if there is a match; if there is, we don't append it to the resulting string
		foreach ($movies as $movie) {
			if($movie != $id) {
				if($newValue == '') {
					$newValue = $newValue . $movie;
				}
				else {
					$newValue = $newValue . ',' . $movie;
				}
			}
		}
		// update the record in the database
		$sql = "UPDATE users SET favourite_movies = '$newValue' WHERE firstName='$name[0]' AND lastName='$name[1]'"; 
		$result = mysqli_query($connection, $sql);

		header("Location: index.php");
	}


 ?>

 <!DOCTYPE html>
 <html>
 <head>
 	<title>Add entry</title>
 	<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    <style type="text/css">
    	
    </style>

    <script type="text/javascript">
    	// возвращение на главную страницу
    	const goBack = () => {
    		window.location.href = "index.php";
    	};
    </script>

 </head>
 <body>
 	<div class="container">
 		 <div class="row justify-content-center">
 			<button type="button" class="btn" onclick="goBack()">
 				Back to home page
 			</button>
 		</div>
 		<div class="row justify-content-center">
 			<h1>Add a movie to a user</h1>
 		</div>
 		<div class="row justify-content-center">
 			<form action="edit.php" method="POST">
 				<div class="form-group needs-validation" style="font-size: 12;">
 					<label for="select">User:</label>
 					<select class="form-control" name="user_name">
						<?php 
							foreach ($users as $user):
								echo '<option value="'.$user['firstName'].'_'.$user['lastName'].'">'.$user['firstName'].' '.$user['lastName'].'</option>';
							endforeach;
						 ?>
 					</select>
 					<label for="text" style="margin-top: 10px;">IMDB ID:</label>
					<input class="form-control" type="text" name="imdbid" placeholder="Example: tt4276094" required>
					<div class="valid-feedback">Valid.</div>
      				<div class="invalid-feedback">Please fill out this field.</div>
			  		<!--<input class="form-control" type="submit" name="submit_movie" value="Add new movie">-->
			  		<button type="submit" class="btn btn-primary form-control" name="submit_movie" style="margin-top:  10px;">
			  			Add new movie
			  		</button>
 				</div>
 			</form>

 			<script>
				// Отмена если форма не заполнена
				(function() {
				  'use strict';
				  window.addEventListener('load', function() {
				    // Получаем формы, которую требуется проверить
				    let forms = document.getElementsByClassName('needs-validation');
				    // Проходим по формам и отменяем отправку, если там пусто
				    let validation = Array.prototype.filter.call(forms, function(form) {
				      form.addEventListener('submit', function(event) {
				        if (form.checkValidity() === false) {
				          event.preventDefault();
				          event.stopPropagation();
				        }
				        form.classList.add('was-validated');
				      }, false);
				    });
				  }, false);
				})();
			</script>
 		</div>
	</div>
 </body>
 </html>