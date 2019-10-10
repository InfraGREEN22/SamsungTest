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

	// если кнопка на удаление фильма была нажата
	if(isset($_POST['delete_movie'])) {
		// explode and foreach, than append every id which is not matching the input, then update
		$id = $_POST['select_movie'];
		echo '<script type="text/javascript">console.log(' . "'" .$id . "'" . ');</script>';
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
 	<title>Delete entry</title>
 	<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    <style type="text/css">
    	#hidden_div {
    		display: none;
		}
    </style>

    <!-- подключаем JQuery -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

    <script type="text/javascript">
    	// возвращение на главную страницу
    	const goBack = () => {
    		window.location.href = "index.php";
    	};

    	// функция для отображения второго селектора
    	const showSecondSelect = (divId, element) => {
    		document.getElementById(divId).style.display = 'block';
    		func();
    	};

    	const func = () => {
    		let v = document.getElementById("first_selector").value;
    		return v;
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
 			<h1>Delete a movie from a user's list</h1>
 		</div>

 		<div class="row justify-content-center">

 			<form action="delete.php" method="POST">
 				<div class="form-group needs-validation" style="font-size: 12;">

 					<label for="select">User:</label>
 					<select class="form-control" name="select_user" id="first_selector" onchange="showSecondSelect('hidden_div', this)" required>
 						<option disabled selected="selected" value> -- select the user -- </option>
						<?php 
							foreach ($users as $user):
								echo '<option value="'.$user['firstName'].'_'.$user['lastName'].'">'.$user['firstName'].' '.$user['lastName'].'</option>';
							endforeach;
						 ?>
 					</select>

 					<div class="valid-feedback">Valid.</div>
      				<div class="invalid-feedback">Please select a user!</div>

      				<div id="hidden_div">
	 					<label for="text" style="margin-top: 10px;">Movie:</label>

						<!--<input class="form-control" type="text" name="imdbid" placeholder="Example: tt4276094" required>-->
						<select class="form-control" name="select_movie" id="second_selector">

						</select>

						<script>
							$("#first_selector").on("change", function() {
							    var x_value = $("#first_selector").val();
							    console.log(x_value);
							    $.ajax({
							        url:'ajax.php',
							        data:{fullName:x_value},
							        type: 'post',
							        success : function(resp){
							        	console.log("Ajax triggered");
							            $("#second_selector").html(resp);               
							        },
							        error : function(resp){ console.log("Ajax error");}
							    });
							});
	 					</script>

						<div class="valid-feedback">Valid.</div>
	      				<div class="invalid-feedback">Please select a movie to delete!</div>
				  		<!--<input class="form-control" type="submit" name="submit_movie" value="Add new movie">-->
				  		<button type="submit" class="btn btn-primary form-control" name="delete_movie" style="margin-top:  10px;">
				  			Delete the selected movie
				  		</button>
			  		</div>
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