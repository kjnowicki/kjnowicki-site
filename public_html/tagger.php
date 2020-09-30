<?php session_start();?>
<!doctype html>
<html lang="pl">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>IiE Licencjat</title>
<link href="css/bootstrap-4.2.1.css" rel="stylesheet" type="text/css">
<link href="jQueryAssets/jquery.ui.core.min.css" rel="stylesheet" type="text/css">
<link href="jQueryAssets/jquery.ui.theme.min.css" rel="stylesheet" type="text/css">
<link href="jQueryAssets/jquery.ui.button.min.css" rel="stylesheet" type="text/css">
<script src="jQueryAssets/jquery-1.11.1.min.js"></script>
<script src="jQueryAssets/jquery.ui-1.10.4.button.min.js"></script>
<script src="js/script.js"></script>
<script src="js/session.js"></script>
<link href="css/style.css" rel="stylesheet" type="text/css"/>
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.0/css/all.css" integrity="sha384-Mmxa0mLqhmOeaE8vgOSbKacftZcsNYDjQzuCOm6D02luYSzBG8vpaOykv9lFQ51Y" crossorigin="anonymous">
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
</head>
	
<body class="bg-dark">
<?php $_SESSION['id'] = ( isset( $_GET['ID'] ) && is_numeric( $_GET['ID'] ) ) ? intval( $_GET['ID'] ) : ((isset($_SESSION['id'])) ? $_SESSION['id'] : 1);
?>

<script>
	$(document).ready(function(){
		if($.session.get('PDFup')==1)
			{
				$("#PDF").addClass("slideUpSession");
			}
		if($.session.get('Fup')==1)
			{
				$("#search").addClass("slideUpSession");
			}
		$(".slideUpSession").slideUp();
	});
</script>
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
	
	#Get Tags
	$sql = "SELECT * FROM Tags";
	$Tags_query = $connection->query($sql);
	#Get Issues
	$sql = "SELECT * FROM IssuesTags";
	$IssuesTags_query = $connection->query($sql);
	
	disconnect($connection);
	
	$IssuesTags=array();
	$iterator = 0;
	while($row = $IssuesTags_query->fetch_assoc())
	{
		$record=array(
			'IssueID' => $row['IssueID'],
			'TagID' => $row['TagID']
		);
		$IssuesTags[$iterator] = $record;
		$iterator++;
	}
	
	$Tags=array();
	$iterator = 0;
	while($row = $Tags_query->fetch_assoc())
	{
		$record=array(
			'TagID' => $row['TagID'],
			'TagName' => $row['TagName']
		);
		$Tags[$iterator] = $record;
		$iterator++;
	}
?>
<div class="container-fluid" style="padding-bottom: 100px;">
		<div class="row">
			<div class="col-xl-5 text-white" style="padding-top: 20px;">
				<label for="search" class="btn btn-primary btn-block" onClick="toggleF()"><i class="fas fa-angle-double-down"></i>  Szukaj pytań  <i class="fas fa-angle-double-down"></i></label>
				<script>
					function toggleF()
					{
						$("#search").slideToggle();
						if($("#search").hasClass("slideUpSession"))
							{
								$("#search").removeClass("slideUpSession");
								$.session.set('Fup', 0);
							}
							else
							{
								$("#search").addClass("slideUpSession");
								$.session.set('Fup', 1);
							}
					}
				</script>
				
				
			  <form id="search" method="post" target="_self" style="border-bottom: thin dashed white;" action="main.php">
					<div id="Tag" class="form-group">
						<label for="effect_sel"><span style="font-weight: 650;">Wybierz tagi</span>  (użyj ctrl/shift lub przeciągnij myszą)</label>
						<select class="form-control" name="tags[]" multiple>
							<?php
							foreach($Tags as $row) {
								echo '<option value="'.$row['TagID'].'">'.$row['TagID'].'. '.$row['TagName'].'</option>';
							}
							?>
						</select>
					</div>
					<button type="submit" class="btn btn-primary" style="background-color: gold;color:black;">Wyszukaj pytań</button>
			  </form>
				
			  <div id="search_result" style="width: 100%;border-bottom: medium solid white;">
				  <?php
						#filter issues that have selected tags
						
				  ?>
			  </div>
				<div style="color:aqua;">
					<form action="Tags/add.php" method="post">
						<label for="myInput" style="text-decoration-style: dashed; color:orange;">Dodaj tagi do pytań (rodzielaj średnikiem)</label>
						<div class="autocomplete" style="width:300px;">
							<input id="myInput" type="text" name="questions" placeholder="Pytania (np. 1-10;13;17)">
						</div>
						
						<select id="tags_add" name="tags[]" class="form-control" multiple>
						<?php
							foreach($Tags as $row) {
								echo '<option value="'.$row['TagID'].'">'.$row['TagID'].'. '.$row['TagName'].'</option>';
							}
							?>
						</select>
						<input id="myInput" type="text" name="questions" placeholder="Nowe tagi (rozdzielane średnikiem, przecinkiem lub spacją)">
						<button type="submit" class="btn btn-primary" style="background-color: gold;color:black;">DODAJ</button>
					</form>
				</div>
			</div>
			<div class="col-xl-7" style="padding-top: 20px;">
				<label for="PDF" class="btn btn-primary btn-block" onClick="togglePDF()"><i class="fas fa-angle-double-down"></i>  Pokaż/Schowaj PDF  <i class="fas fa-angle-double-down"></i></label>
				<script>
					function togglePDF()
					{
						$("#PDF").slideToggle();
						
						if($("#PDF").hasClass("slideUpSession"))
						{
							$("#PDF").removeClass("slideUpSession");
							$.session.set('PDFup', 0);
						}
						else
						{
							$("#PDF").addClass("slideUpSession");
							$.session.set('PDFup', 1);
						}
					}
				</script>
				<div id="PDF" style="margin-right: 40px;">
					<object data="web/viewer.html?file=../files/Issues.pdf" width="100%" height="650px">
					<span>Alt</span>
					</object>
				</div>
				
				
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
					<a class="nav-link" href="main.php">Pytania i odpowiedzi</a>
				</li>
				<li class="nav-item active">
				<a class="nav-link disabled" href="" style="color:red;">Tagowanie pytań</a>
				</li>
				<li class="nav-item active">
					<a class="nav-link" href="docs.php">Dokumenty do pobrania</a>
				</li>
			</ul>
		</div>
		
	</nav>
</body>
</html>