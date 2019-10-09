<?php 

 ?>

<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    <style type="text/css">
    	a, a:hover, a:focus {
		    text-decoration: none;
		    width: 100%;
		    height: 100%;
		    color: black;
		}

		.vertical-center {
		 	margin: 0;
			position: absolute;
			top: 50%;
			
			-ms-transform: translateY(-50%);
			transform: translateY(-50%);
		}
	</style>

	<!-- JS код -->
	<script type="text/javascript">
		let test = document.getElementById("test");
		test.addEventListener("mouseover", function(event) {
			if(event.target.style.color == 'orange') {
				event.target.style.color = 'black';
			}
			else {
				event.target.style.color = 'orange';
			}
		});
	</script>

    <title>Test Web Application</title>
  </head>

  <body>
  	<div style="max-width: 1200px; margin: auto; padding: 10px;">
      	<div class="container-fluid">
      		<div class="row justify-content-center" style="background-color: #a3a3c2; border-radius: 25px;">
    				<h1>Welcome!</h1>
    		</div>

    		<div class="row justify-content-center text-center" style="background-color: #d9d9d9; border-radius: 25px; margin-top: 20px;">
    			<p style="padding-left: 5px; padding-right: 5px;">
    				<h4>This is a test web service using OMDb API to get information about movies. There are a number of users defined in the system, each of them
    				has a number of favourite movies.</h4>
    			</p>
    		</div>


    		<div id="test" class="row justify-content-center" style="margin-top: 20px; height: 100px;">
    			<div class="col-lg-2 col-md-2 col-sm-6 h-100" style="background-color: #e699ff; border-radius: 25px; margin: 20px;">
    				<a href="read.php" class="stretched-link">
    					<div class="vertical-center">
    						<h4 id="1">Check out favourite movies of all the users!</h4>		
    					</div>
    				</a>
    			</div>

    			<div class="col-lg-2 col-md-2 col-sm-6 text-center" style="background-color: #ffd699; border-radius: 25px; margin: 20px;">
    				<a href="edit.php" class="stretched-link" onmouseover="changeColor('1')">
    					<div class="vertical-center">
    						<h4 id="2">Add new movie to a user</h4>
    					</div>
    				</a>
    			</div>

    			<div class="col-lg-2 col-md-2 col-sm-6 text-center" style="background-color: #b3ffb3; border-radius: 25px; margin: 20px;">
    				<a href="delete.php" class="stretched-link">
    					<div class="vertical-center">
    						<h4>Delete a movie from a user</h4>			
    					</div>
    				</a>
    			</div>

    			<div class="col-lg-2 col-md-2 col-sm-6 text-center" style="background-color: #99d6ff; border-radius: 25px; margin: 20px;">
    				<a href="https://www.omdbapi.com/" class="stretched-link">
    					<div class="vertical-center">
    						<h4>OMDb API</h4>				
    					</div>
    				</a>
    			</div>

    		</div>

    		<div>
    			<h4 id="h1">Hello</h4>
    		</div>

		</div>
	</div>
  </body>
</html>