<?php
	include_once("global.php");
?>
<html>
	<head>
		<title>Boutique <?= CMS_SITENAME ?>: Page d'article</title>
		<link href="/css/style.css?2" rel="stylesheet" type="text/css"/>
		<script>
			(0) ? parent.hidearticle(): 0; // if id existe pas
		</script>
	</head>
	<body id="article">
		<div class="photo" style="background-image: url('/img/items/voiture.jpg');"></div>
		id = <?= $_GET['IdArticle'] ?> <br>
		Prix: 20$
	</body>
</html>
<?php
var_dump($_SESSION); ?>