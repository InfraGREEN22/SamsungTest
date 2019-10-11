<?php 

	// подключаемся к бд
	$connection = mysqli_connect('localhost', 'alex', '123456789', 'users');

	// проверяем соединение
	if(!$connection) {
		echo "Connection error: " . mysqli_connect_error();
	}

	// если кнопка на добавление юзера была нажата
	if(isset($_POST['submit_user'])) {

		$sql = "INSERT INTO users (firstName, lastName) VALUES (" . "'" . $_POST['first_name'] . "', '" . $_POST['second_name'] . "')"; 
		$result = mysqli_query($connection, $sql);

		header("Location: index.php");
	}

 ?>

 <!DOCTYPE html>
 <html>
 <head>
 	<title>Add user</title>
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
 			<h1>Add a new user to the system</h1>
 		</div>
 		<div class="row justify-content-center">
 			<form action="adduser.php" method="POST">
 				<div class="form-group needs-validation" style="font-size: 12;">

 					<label for="text" style="margin-top: 10px;">User first name:</label>
					<input class="form-control" type="text" name="first_name" placeholder="Example: Roman" required>
					<div class="valid-feedback">Valid.</div>
      				<div class="invalid-feedback">Please fill out this field.</div>

      				<label for="text" style="margin-top: 10px;">User second name:</label>
					<input class="form-control" type="text" name="second_name" placeholder="Example: Ivanov" required>
					<div class="valid-feedback">Valid.</div>
      				<div class="invalid-feedback">Please fill out this field.</div>

      				<label for="text" style="margin-top: 10px;">Optional, IMDB IDs of favourite movies (comma separated, no spaces):</label>
					<input class="form-control" type="text" name="movies" placeholder="Example: tt7349950,tt6324278,tt5503686">
					<div class="valid-feedback">Valid.</div>
      				<div class="invalid-feedback">Please fill out this field.</div>
			  		<!--<input class="form-control" type="submit" name="submit_movie" value="Add new movie">-->
			  		<button type="submit" class="btn btn-primary form-control" name="submit_user" style="margin-top:  10px;">
			  			Add new user
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