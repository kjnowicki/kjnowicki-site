<?php session_start()?>
<!doctype html>
<html lang="pl">
<head>
<meta charset="UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>IiE Egzamin</title>
<link href="css/bootstrap-4.2.1.css" rel="stylesheet" type="text/css">
<script src="jQueryAssets/jquery-1.11.1.min.js"></script>
<link href="jQueryAssets/jquery.ui.core.min.css" rel="stylesheet" type="text/css">
<link href="jQueryAssets/jquery.ui.theme.min.css" rel="stylesheet" type="text/css">
<link href="jQueryAssets/jquery.ui.button.min.css" rel="stylesheet" type="text/css">
<script src="jQueryAssets/jquery.ui-1.10.4.button.min.js"></script>
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.0/css/all.css" integrity="sha384-Mmxa0mLqhmOeaE8vgOSbKacftZcsNYDjQzuCOm6D02luYSzBG8vpaOykv9lFQ51Y" crossorigin="anonymous">
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
</head>

<body class="bg-dark">
<?php
	$_SESSION['posted'] = array_merge($_SESSION['posted'],$_POST);
	if(!isset($_SESSION['posted']['pass']) or $_SESSION['posted']['pass'] != "w10loncz3l4")
	{
		echo "<script>";
		echo "setTimeout(function(){location.href='index.php?F=1';})";
		echo "</script>";
		exit();
	}
	$_SESSION['root'] = __DIR__;
	include_once($_SESSION['root'].'/'."DBconn.php");
	
	$connection = connect();
	disconnect($connection);

echo<<<ENDL
<script>
	$(document).ready(function(){
		$("#PDF_").slideUp();
	});
</script>
ENDL
?>
	<div class="container-fluid" style="padding-bottom: 100px; padding-top: 20px;">
		<div class="row">
			<div id="includedContent" class="col-md-8">
				<iframe style="background-color:white;" src="https://docs.google.com/document/d/1p9hW78om1O8lLLx9xry1hjhLzmL_bWM6P4bOFl0EBe4/edit?usp=sharing" height="550" width="100%"></iframe>
			</div>
			<div class="col-md-4">
				<iframe src="https://titanembeds.com/embed/575795704937840640" height="550" width="100%" frameborder="0"></iframe>
			</div>
		</div>
		<div class="row">
			<div class="col-12">
				<label for="PDF" class="btn btn-primary btn-block" onClick="togglePDF()"><i class="fas fa-angle-double-down"></i> Pokaż/Schowaj PDF <i class="fas fa-angle-double-down"></i></label>
				<script>
					function togglePDF()
					{
						$("#PDF_").slideToggle();
					}
				</script>
				<div id="PDF_" style="padding:0px 20px;">
					<object data="web/viewer.html?file=../files/Issues.pdf" width="100%" height="650px">
					<span>Alt</span>
					</object>
				</div>
			</div>
		</div>
		<nav class="navbar navbar-dark fixed-bottom" style="box-shadow: 5px -2px 15px grey; background-color: black;">
		<a class="navbar-brand" href="#" style="color: yellow;"><strong>NAWIGACJA</strong></a>
		
		<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
			<span class="navbar-toggler-icon"></span>
	  	</button>
		
		<div id="collapsibleNavbar" class="collapse navbar-collapse" style="border-top: thin solid white;">
			<ul class="navbar-nav">
				<li class="nav-item active">
					<a class="nav-link disabled" href="" style="color:red;">Pytania i odpowiedzi</a>
				</li>
				<li class="nav-item active">
					<a class="nav-link" href="tagger.php">Tagowanie pytań</a>
				</li>
				<li class="nav-item active">
					<a class="nav-link" href="docs.php">Dokumenty do pobrania</a>
				</li>
				<li class="nav-item active">
					<a class="nav-link" style="color:yellow;" href="https://docs.google.com/document/d/1p9hW78om1O8lLLx9xry1hjhLzmL_bWM6P4bOFl0EBe4/edit?usp=sharing">Google Docs</a>
				</li>
				<li class="nav-item active">
					<a class="nav-link" style="color:yellow;" href="https://1drv.ms/u/s!AoEGQJtcdC0Kh7cCKJA0ZFN6M272uQ">OneNote</a>
				</li>
			</ul>
		</div>
	</nav>
</body>
</html>
