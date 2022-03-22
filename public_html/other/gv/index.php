<?php session_start(); ?>
<!doctype html>
<html>

<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="../../style.css">
	<script type="module" src="script.js"></script>
	<title>GV</title>
</head>

<body style="background-color: black;">
	<global-header></global-header>
	<div>
		<form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
			<input type="password" name="pass" placeholder="type password" required>
			<select name="app" size="1">
				<option value="compare-rank">Ranking tournament</option>
			</select>
			<input type="submit" name="submit" value="Proceed">
			<?php
			if (!isset($_SESSION['pass_error'])) $_SESSION['pass_error'] = false;
			if ($_SESSION['pass_error']) echo "<p>Wrong password to the app!</p>";
			?>
		</form>
	</div>
	<?php
	if ($_SERVER["REQUEST_METHOD"] == "POST") {
		$pass = $_POST["pass"];
		$app = $_POST["app"];
		$exp = '/(.*\/)([A-z\-\.]*)$/';
		preg_match($exp, $_SERVER['REQUEST_URI'], $output_array);
		switch ($app) {
			case 'compare-rank':
				if (strlen($pass) > 4 && str_contains($app, $pass)) {
					$_SESSION['pass_error'] = false;
					$_SESSION[$app . "_auth"] = true;
					header('Location: ' . $output_array[1] . $app);
				} else {
					$_SESSION['pass_error'] = true;
					header("Refresh:0");
				}
				break;
		}
	}
	?>
</body>


</html>