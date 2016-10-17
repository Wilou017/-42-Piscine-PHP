<?php
	include_once("global.php");
?>
<html>
	<head>
		<title>Boutique <?= CMS_SITENAME ?></title>
		<link href="css/style.css" rel="stylesheet" type="text/css"/>
	</head>
	<body id="accueil">
		<div id="overlay" class="overlay" OnCLick="hidearticle()"></div>
		<div id="popuparticle">
			<div id="close" OnCLick="hidearticle()"></div>
			<iframe id="popuparticleIframe" src="#" frameborder="0"></iframe>
		</div>
		<div id="content">
			<?php require_once('header.php'); ?>
			<div id="base">
				<div id="category">
					<span class="categoryname">Category 1</span>
					<span class="souscategory">Sous-Categorie 1</span>
					<span class="souscategory">Sous-Categorie 1</span>
					<span class="souscategory">Sous-Categorie 1</span>
					<span class="souscategory">Sous-Categorie 1</span>
					<span class="souscategory">Sous-Categorie 1</span>
					<span class="categoryname">Category 2</span>
					<span class="souscategory">Sous-Categorie 1</span>
					<span class="souscategory">Sous-Categorie 1</span>
					<span class="souscategory">Sous-Categorie 1</span>
					<span class="souscategory">Sous-Categorie 1</span>
					<span class="souscategory">Sous-Categorie 1</span>
				</div>
				<div id="itemlist">
					<div class="item" OnCLick="showarticle(1)">
						<div class="itemimg" style="background-image: url('img/items/voiture.jpg');">
							<span>20$</span>
						</div>
						<div class="itemname">Voiture</div>
					</div>

					<div class="item" OnCLick="showarticle(2)">
						<div class="itemimg" style="background-image: url('img/items/car2.jpg');">
							<span>20$</span>
						</div>
						<div class="itemname">Voiture</div>
					</div>

					<div class="item" OnCLick="showarticle(3)">
						<div class="itemimg" style="background-image: url('img/items/voiture.jpg');">
							<span>20$</span>
						</div>
						<div class="itemname">Voiture</div>
					</div>

					<div class="item" OnCLick="showarticle(4)">
						<div class="itemimg" style="background-image: url('img/items/voiture.jpg');">
							<span>20$</span>
						</div>
						<div class="itemname">Voiture</div>
					</div>

					<div class="item" OnCLick="showarticle(5)">
						<div class="itemimg" style="background-image: url('img/items/voiture.jpg');">
							<span>20$</span>
						</div>
						<div class="itemname">Voiture</div>
					</div>
				</div>
			</div>
		</div>
	</body>
	<script type="text/javascript">
	function showarticle (id)
	{
		document.getElementById("overlay").style.display = 'block';
		document.getElementById("popuparticle").style.display = 'block';
		document.getElementById('popuparticleIframe').src = "article/" + id;
	}
	function hidearticle()
	{
		document.getElementById("overlay").style.display = 'none';
		document.getElementById("popuparticle").style.display = 'none';
	}

	function nicesong()
	{
		window.open('https://w.soundcloud.com/player/?url=https%3A//api.soundcloud.com/tracks/146304632&amp;auto_play=true&amp;hide_related=false&amp;show_comments=true&amp;show_user=true&amp;show_reposts=false&amp;visual=true','','width=500, height=450, toolbar=no, location=no, directories=no, status=no, menubar=no, scrollbars=no, copyhistory=no, resizable=no')
	}
	</script>
</html>