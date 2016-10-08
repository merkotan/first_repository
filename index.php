<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>STORE</title>
	<link href="css/bootstrap.min.css" rel="stylesheet"> 
	<link rel="stylesheet" href="css/style.css">
	<meta name="viewport" content="width=device-width, initial-scale=1.0"> 
</head>

<body>
	<?php 
		include_once('pages/classes.php');
	 ?>
<header>
	<form name="search" action="#" method="get" class="form-inline form-search pull-right">
	<div class="input-group">
		<label class="sr-only" for="searchInput">Search</label>
		<input class="form-control" id="searchInput" type="text" name="search" placeholder="Search">
		<div class="input-group-btn">
			<button type="submit" class="btn btn-primary">GO</button>
		</div>
	</div>
</form>
</header>

<div class="container-fluid">
	<div class="row-fluid">
	<nav class="navbar navbar-default">
	<ul class="nav navbar-nav">
		<?php include_once('pages/menu.php'); ?>	
	</ul>
	</nav>
	</div>
</div>


		<?php 
				if (isset($_GET['id'])) {
				$id=$_GET['id'];
				echo '<section id="form_in_center">';
				if ($id==1) {include_once('pages/catalog.php');}
				if ($id==2) {include_once('pages/cart.php');}
				if ($id==3) {include_once('pages/reports.php');}
				if ($id==4) {include_once('pages/newgoods.php');}
				echo '</section>';
			}
			else {$id=1;
			include_once('pages/catalog.php');
		}
echo '		
<div class="row-fluid" style="clear:both;">FOOTER</div>
</div>



</body>
</html>';
 ?>