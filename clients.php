<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Clients</title>
<script src="https://code.jquery.com/jquery-2.2.4.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous"><script src="https://cdnjs.cloudflare.com/ajax/libs/tether/1.4.0/js/tether.min.js" integrity="sha384-DztdAPBWPRXSA/3eYEEUWrWCy7G5KFbe8fFjk5JAIxUYHKkDx6Qin1DkWx51bBrb" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/css/bootstrap.min.css" integrity="sha384-rwoIResjU2yc3z8GV/NPeZWAv56rSmLldC3R/AZzGRnGxQQKnKkoFVhFQhNUwEyJ" crossorigin="anonymous">
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/js/bootstrap.min.js" integrity="sha384-vBWWzlZJ8ea9aCX4pEW3rVHjgjt7zpkNpZk+02D9phzyeVkE+jo0ieGizqPLForn" crossorigin="anonymous"></script>
<link rel="stylesheet" href="clients/lucero/css/carousel.css">
<link rel="stylesheet" href="clients/lucero/css/main.css">
</head>
<body>
	<nav class="navbar navbar-toggleable-md navbar-light bg-faded">
	  	<div class="container">
		  <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-label="Toggle navigation">
			<span class="navbar-toggler-icon"></span>
		  </button>
		  <a class="navbar-brand" href="#"><img alt="Dotslash Designs Logo Thumbnail" class="img-fluid img-thumbnail" src="assets/images/dsd_logo_thumbnail.png" width="50"></a>
		  <div class="collapse navbar-collapse" id="navbarNav">
			<ul class="navbar-nav">
				<li class="nav-item active">
					<a class="nav-link" href="index.php">Home<span class="sr-only">(current)</span></a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="#">About</a>
			  	</li>
			  	<li class="nav-item">
					<a class="nav-link" href="clients.php">Clients</a>
			  	</li>
			  	<li class="nav-item">
					<a class="nav-link" href="#">Services</a>
			  	</li>
			  	<li class="nav-item">
					<a class="nav-link disabled" href="#">Under Construction</a>
			  	</li>
			</ul>
			<form class="form-inline my-2 my-lg-0">
			  <input class="form-control mr-sm-2" type="text" placeholder="Search">
			  <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
			</form>
		  </div>
		</div>
	</nav>
<!-- Title Bar --
======================================================================================= -->
	<div class="container">
		<h1><center>Dotslash Designs LLC</center></h1>
		<p><center>Clients</center></p>
	</div>

<!-- Carousel
====================================================================================== -->
	<div class="container">
		<!-- Adapted from https://www.w3schools.com/bootstrap/bootstrap_carousel.asp -->
		<!-- Adapted from https://getbootstrap.com/examples/carousel/# -->
		<div id="myCarousel" class="carousel slide" data-ride="carousel">
			<!-- Indicators -->
		  	<ol class="carousel-indicators">
				<li data-target="#myCarousel" data-slide-to="0" class="active"></li>
		 		<li data-target="#myCarousel" data-slide-to="1"></li>
		 	</ol>
			<div class="carousel-inner" role="listbox">
				<div class="item active">
						<a href="http://www.corporationbuilders.com" target="_blank"><img alt="Corporation Builders Website" class="first-slide d-block img-item img-fluid img-responsive" src="clients/corporationbuilders/images/corporationbuilders.png"></a>
					<div class="carousel-caption">
						<h1>Corporation Builders</h1>
						<p></p>
					</div>
				</div>
				<div class="item">
						<a href="http://www.dotslashdesigns.com/index-lucero.php" target="_blank"><img alt="Corporation Builders Website" class="first-slide d-block img-item img-fluid img-responsive" src="clients/lucero/images/Blossoms_of_light_W.png"></a>
					<div class="carousel-caption">
						<h1>Judy Lucero</h1>
						<p>Artist</p>
					</div>
				</div>
			</div>
  			<!-- Left and right controls -->
			<a class="carousel-control left" href="#myCarousel" role="button" data-slide="prev">
				<span class="glyphicon glyphicon-chevron-left"></span>
			</a>
			<a class="carousel-control right" href="#myCarousel" role="button" data-slide="next">
				<span class="glyphicon glyphicon-chevron-right"></span>
 			</a>
		</div>
	</div>
</body>
</html>