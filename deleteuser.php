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
?>

<?php
	if(isset($_POST['delete_user'])) {
		$temp = $_POST['user_name'];
		echo '<script type="text/javascript">console.log(' . "'" .$temp. "'" . ');</script>';
		$username = explode('_', $temp); 	
		$sql = "DELETE FROM users WHERE firstName='$username[0]' AND lastName='$username[1]'"; 
		$result = mysqli_query($connection, $sql);
		header("Location: index.php");
	}
 ?>

 <!DOCTYPE html>
 <html>
 <head>
 	<title>Delete user</title>
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
 			<h1>Delete user</h1>
 		</div>
 		<div class="row justify-content-center">
 			<form action="deleteuser.php" method="POST">
 				<div class="form-group needs-validation" style="font-size: 12;">

 					<label for="select">User:</label>
 					<select class="form-control" name="user_name" required>
						<?php 
							foreach ($users as $user):
								echo '<option value="'.$user['firstName'].'_'.$user['lastName'].'">'.$user['firstName'].' '.$user['lastName'].'</option>';
							endforeach;
						 ?>
 					</select>

			  		<!--<input class="form-control" type="submit" name="submit_movie" value="Add new movie">-->
			  		<button type="submit" class="btn btn-primary form-control" name="delete_user" style="margin-top:  10px;">
			  			Delete user
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