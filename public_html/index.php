<?php session_start();
$_SESSION['posted'] = array();?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>IiE Pass</title>
<link href="css/bootstrap-4.2.1.css" rel="stylesheet" type="text/css">
</head>

<body class="bg-dark text-light">
	<div class="container-fluid">
	<div class="row">
		<div class="col-xl-1"></div>
		<div class="col-xl-11">
			<?php
			
			
			if(isset($_GET["F"]))
				if($_GET["F"]==1)
				{
					echo "<h4 style=\"color:red;\">Tym razem nie udało Ci się dostać na stronę główną. Spróbuj w przyszłym roku. Powodzenia!</h4>";
				}
			?>
			<form method="POST" action="main.php">
				  <div class="form-group">
					<label for="nerka">
					<input type="checkbox" id="nerka"/>Zgadzam się na oddanie 1 (słownie: jednej) nerki</label>
				  </div>
				  <div class="form-group">
					<label for="pass">Sekretne hasło</label>
					<input type="password" class="form-control" id="pass" name="pass" placeholder="Tutaj wpisz coś co myślisz, że jest hasłem do strony">
				  </div>
				  <button type="submit" class="btn btn-primary">Zatwiedź hasło</button>
			</form>
		</div></div></div>
</body>
</html>