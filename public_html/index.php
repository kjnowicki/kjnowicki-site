<!doctype html>
<html>
	<head>	
		<title>KJNowicki</title>
		<meta charset="UTF-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta name="description" content="Krzysztof Jan Nowicki. Automation Software Engineer online profile.">
		<meta name="keywords" content="Krzysztof Nowicki, testing, automation, data, analysis, gdev, personal development, software development, python, java, js">
		<meta name="author" content="Krzysztof Nowicki">

		<link rel="stylesheet" href="style.css">
		<script type="module" src="script.js"></script>
		<script src="carousel.js"></script>
	</head>
	<body style="background-color: black;">
		<global-header></global-header>
		<div id="global-content" style="display:none;">
			<div id="carousel">
				<table class="nav-c">
					<thead  onclick="rotate_carousel_on_click(this);" onmousedown="update_click();">
						<tr>
							<th>My Projects</th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td>
								<b>Ranker Party</b> - Rating stuff along with other people in shared session.<br>
								<i>Currently unavailable for public use.</i>
							</td>
						</tr>
						<tr>
							<td>
								Also check out my team for private projects - <a href='https://www.gdev.pl' target="_blank">GDev</a>
							</td>
						</tr>
					</tbody>
				</table>
				<table class="nav-c">
					<thead  onclick="rotate_carousel_on_click(this);" onmousedown="update_click();">
						<tr>
							<th>About me ^^</th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td>
								<img src="https://scontent-vie1-1.xx.fbcdn.net/v/t39.30808-6/245415985_4344883805588789_8534260155616128479_n.jpg?_nc_cat=101&ccb=1-5&_nc_sid=09cbfe&_nc_ohc=kDw2CAW-zooAX8gUwWS&_nc_ht=scontent-vie1-1.xx&oh=00_AT_yU_ZIaY2r8fGYH2QXjVN_iJfs1yxmFUJPPK-ZWPVrhw&oe=6242A01C"/>
								<p>
									A guy born in 1997 that grew to love programming and resolving problems with it.
									I enjoy difficult puzzles that require a lot of thinking. I search for them everywhere. Arguebly the biggest one I didn't solve quite yet is life.
								</p>
							</td>
						</tr>
						<tr>
							<td>
								I make a living doing testing automation. That happens to be pretty enjoyable undertaking for me.
								In projects I sometimes take a role of team leader or facilitator such as scrum master. I like enabling others :)
							</td>
						</tr>
						<tr>
							<td>
								My other loves are sports (any kind, prefferably team based), computer games (RPG &lt;3), healthy life-style, still and moving-image post-production and a bit of philosophy, psychology, memes.
							</td>
						</tr>
					</tbody>
				</table>
				<table class="nav-c">
					<thead onclick="rotate_carousel_on_click(this);" onmousedown="update_click();">
						<tr>
							<th>Endorsements</th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td>
								Love everyone's effort against wars and injustice in the world.
							</td>
						</tr>
						<tr>
							<td>
								Must watch movies:
								<ul>
									<li><b>LaLa Land</b> - Amazingly written musical about dreams and love.</li>
									<li><b>Jojo Rabit</b> - Brutal history contrasted with absurd humor. Perfect satire.</li>
								</ul>
							</td>
						</tr>
							<td>
								YT Channels<br>
								:Comedy:<br>
								- <a href="https://www.youtube.com/c/MakingShorts">Joel Javer</a><br>
								- <a href="https://www.youtube.com/c/VivaLaDirtLeague">Viva La Dirt League</a><br>
								- <a href="https://www.youtube.com/c/GFDarwinyt">G.F. Darwin</a><br>
							</td>
						</tr>
					</tbody>
				</table>
			</div>
			<script type="text/javascript">
				attach_carousel_listeners();
			</script>
		</div>
		<global-footer></global-footer>
	</body>
</html>