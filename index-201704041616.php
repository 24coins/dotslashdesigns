<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Dotslash Designs LLC</title>
<script src="https://code.jquery.com/jquery-2.2.4.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous"><script src="https://cdnjs.cloudflare.com/ajax/libs/tether/1.4.0/js/tether.min.js" integrity="sha384-DztdAPBWPRXSA/3eYEEUWrWCy7G5KFbe8fFjk5JAIxUYHKkDx6Qin1DkWx51bBrb" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/css/bootstrap.min.css" integrity="sha384-rwoIResjU2yc3z8GV/NPeZWAv56rSmLldC3R/AZzGRnGxQQKnKkoFVhFQhNUwEyJ" crossorigin="anonymous">
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/js/bootstrap.min.js" integrity="sha384-vBWWzlZJ8ea9aCX4pEW3rVHjgjt7zpkNpZk+02D9phzyeVkE+jo0ieGizqPLForn" crossorigin="anonymous"></script>
<link rel="stylesheet" href="assets/css/carousel.css">
<link rel="stylesheet" href="assets/css/main.css">
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
					<a class="nav-link" href="#">Home<span class="sr-only">(current)</span></a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="#">About</a>
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
		 		<li data-target="#myCarousel" data-slide-to="2"></li>
		 		<li data-target="#myCarousel" data-slide-to="3"></li>
			</ol>
			<div class="carousel-inner" role="listbox">
				<div class="item active">
						<img alt="Where will Dotslash Designs LLC take you...?" class="first-slide " src="assets/images/balloon.png">
					<div class="carousel-caption">
						<h1>Dream big.</h1>
						<p>Every dream begins with that initial inspiration.<strong> Dotslash Designs LLC </strong>will provide the lift you need to get your ideas off the ground.</p>
					</div>
				</div>
				<div class="item">
					<img alt="Dotslash Designs LLC will help you enjoy the details as well as the big picture." class="second-slide d-block img-item img-fluid img-responsive" src="assets/images/hummingbird.png">
					<div class="carousel-caption">
						<h1>Start small.</h1>
						<p>Every adventure begins with that first step.<strong> Dotslash Designs LLC </strong>will help you enjoy the details as much as the big picture.</p>
					</div>
				</div>
				<div class="item">
					<img alt="Dotslash Designs LLC provides a full spectrum tunnel, not just a light at the end." class="third-slide d-block img-fluid img-responsive" src="assets/images/straws.png">
					<div class="carousel-caption">
						<h1>Enjoy the experience.</h1>
						<p>When you cannot imagine light at the end of the tunnel,<strong> Dotslash Designs LLC </strong>will provide a broad spectrum of services to help you illuminate your path.</p>
					</div>
				</div>
				<div class="item">
					<img alt="Dotslash Designs LLC will help you spread your wings." class="fourth-slide d-block img-fluid img-responsive" src="assets/images/peacock.png">
					<div class="carousel-caption">
						<h1>Spread your wings.</h1>
						<p>Partner with<strong> Dotslash Designs LLC </strong>to reach far beyond what you can presently see.</p>
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