<!DOCTYPE html>
<html>
<head>

	<title>interface</title>

	<meta http-equiv="content-type" content="text/html" charset="utf-8">

	<link href='https://fonts.googleapis.com/css?family=Arimo' rel='stylesheet' type='text/css'>
	<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="views/css/style.css" media="screen">
	
    <base href="/apache2-default/">
	<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.5.2/jquery.min.js"></script>
	
	<script type="text/javascript" src="views/js/functions.js"></script>

</head>

<body>
	
	<h1>AR treasure hunt</h1>

	<button class="btn btn-default" id="connect-btn">Connexion &#x25BE;</button>
	<div id="connect-div">
		<form role="form" action="script.php">
			<div class="form-group">
				<label for="username">Username:</label>
				<input type="text" class="form-control" id="username">
			</div>
			<div class="form-group">
				<label for="pwd">Password:</label>
				<input type="password" class="form-control" id="pwd">
			</div>

			<button type="submit" class="btn btn-default">Connect</button>
		</form>
	</div>


	<ul id="users-list">
		
	</ul>


	
<!-- 

	add user
	remove user

	add tresor
	remove tresor

	start/stop game

	disconnect
 -->
</body>
</html>