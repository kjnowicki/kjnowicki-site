<?php session_start()?>
<!doctype html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Odpowiedz</title>
    <link href="css/bootstrap-4.2.1.css" rel="stylesheet" type="text/css">
    <script src="jQueryAssets/jquery-1.11.1.min.js"></script>
    <link href="jQueryAssets/jquery.ui.core.min.css" rel="stylesheet" type="text/css">
    <link href="jQueryAssets/jquery.ui.theme.min.css" rel="stylesheet" type="text/css">
    <link href="jQueryAssets/jquery.ui.button.min.css" rel="stylesheet" type="text/css">
    <script src="jQueryAssets/jquery.ui-1.10.4.button.min.js"></script>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.0/css/all.css" integrity="sha384-Mmxa0mLqhmOeaE8vgOSbKacftZcsNYDjQzuCOm6D02luYSzBG8vpaOykv9lFQ51Y" crossorigin="anonymous">
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
</head>
<body class="bg-dark" style="padding-left:20px;padding-top:20px;">
    <h5 style="color:red;">Dokumenty do pobrania</h5>
    <style>
    a{
        color: white;
    }
    </style>
    <p><a href="http://www.zarz.agh.edu.pl/wp-content/uploads/2016/04/Procedura_zgl_promotora_tematu_pracy_podanie.pdf">Procedura zgłoszenia promotora i tematu pracy</a></p>
    <p><a href="http://www.zarz.agh.edu.pl/wp-content/uploads/2016/04/Lista-promotorow-upowaznionych-do-kierowania-pracami-dyplomowymi-sem.-letni-2018-19_2.pdf">Lista promotorów upoważnionych do kierowania pracami dyplomowymi &#8211; sem. letni 2018-19 (aktualizacja 8.05.2019 r.)</a></p>
    <p><a href="http://www.zarz.agh.edu.pl/wp-content/uploads/2016/04/Wykaz-dokumentow-do-rejestracji-pracy-dyplomowej-od-3-12-2018-stacj-.pdf">Wykaz dokumentów do rejestracji pracy dyplomowej &#8211; studia stacjonarne</a></p>
    <p><a href="http://www.zarz.agh.edu.pl/wp-content/uploads/2016/04/dyplomowanie-1-stopien.zip">Dyplomowanie 1 stopień</a></p>
    <ul style="color:yellow;">
        <li>Procedura dyplomowania</li>
        <li>Zasady dyplomowania</li>
    </ul>
    <p><a href="http://www.zarz.agh.edu.pl/wp-content/uploads/2016/04/druki-do-pobrania-4.zip">Druki do pobrania &#8211; aktualizacja 23.01.2019 r.</a></p>
    <ul style="color:yellow;">
        <li>Karta odejścia</li>
        <li>Oświadczenie autora pracy dyplomowej</li>
        <li>Reaktywacja na obrone - podanie</li>
        <li>Upoważnienie do odbioru dyplomu</li>
        <li>Wniosek o wydanie dyplomu i suplementu w j. obcym</li>
        <li>Wzór strony tytułowej</li>
        <li>Podania o zmianę promotora, recenzenta, tematu pracy</li>
    </ul>
    <p><a href="http://www.zarz.agh.edu.pl/wp-content/uploads/2019/04/OEK_IiE_ZAGADNIENIA.pdf">Zagadnienia do ogólnego egzaminu kierunkowego &#8211; kierunek Informatyka i Ekonometria</a></p>
    
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
					<a class="nav-link" href="tagger.php">Tagowanie pytań</a>
				</li>
				<li class="nav-item active">
                    <a class="nav-link disabled" href="" style="color:red;">Dokumenty do pobrania</a>
				</li>
			</ul>
		</div>
	</nav>
</body>