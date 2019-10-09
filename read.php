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

	// очищаем результат и закрываем соединение с бд
	mysqli_free_result($result);
	mysqli_close($connection);

	// загружаем OMDb API PHP Wrapper
	require 'vendor\autoload.php';

	$omdb = new Rooxie\OMDb('4f1e48cb');
 ?>

 <!DOCTYPE html>
 <html>
 <head>
 	<title>Favourite movies</title>
 	<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    <style type="text/css">
    	.col-lg-6 {
    		background-color: #f2f2f2;
    	}
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
 		<h1 class="text-center" style="background-color: #b3daff; border-radius: 25px;">Here's the list of favourite movies of all the users:</h1>
 		<?php foreach ($users as $user) { ?>
 			<div class="row" style="background-color: #ffcc80;">
 				<h2><?php echo '<u>' . $user['firstName'] . " " . $user['lastName'] . '</u>'; ?></h2>
 			</div>
			<?php $id_values = explode(',', $user['favourite_movies']); 
			 
			// use foreach again to go through all the values to get the title and everything else?>
			<?php foreach ($id_values as $value) { ?>
				<div>
					<ul>
						<?php $movie = $omdb->getByImdbId($value);
							echo '<li><h3>' . $movie->getTitle() . '</h3></li><br>';
							$array = $movie->toArray();?>
							<div class="row justify-content-center">
								<div class="col-lg-6">
									<?php
										$posterURL = $array['Poster'];
										echo '<img src="' . $posterURL . '" alt="NO IMAGE">';
									?>
								</div>
								<div class="col-lg-6">
									<?php 
										echo "<p><b>Country: </b>";
										$countries = $movie->getCountry();
										foreach ($countries as $country) {
											echo "$country";
											if($country != end($countries))
												echo ", ";
										}; echo '</p>';
										echo "<p><b>Rating: </b>" . $movie->getRated() . '</p>';
										echo '<p><b>IMDB ID: </b>' . $movie->getImdbId() . '</p>';
										echo '<p><b>Release date: </b>' . $movie->getReleased() . '</p>';
										echo "<p><b>Starring: </b>";
										$actors = $movie->getActors();
										foreach ($actors as $actor) {
											echo "$actor";
											if($actor != end($actors))
												echo ", ";
										}; echo '</p>';
										echo '<p><b>Plot</b>: ' . $movie->getPlot() . '</p>';
									?>
								</div>
							</div>
						</ul>
					</div>
 				<?php } ?>
 		<?php } ?><br>
 	</div>
 </body>
 </html>