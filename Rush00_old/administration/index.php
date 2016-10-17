<?php
	include_once("global.php");
?>
<html>
	<head>
		<title>Administration <?= CMS_SITENAME ?></title>
		<link href="style.css" rel="stylesheet" type="text/css"/>
	</head>
	<body id="admin">
		<div id="content">
			<div id="base">
				<div id="category">
					<a class="logo" href="/administration" title="<?= CMS_SITENAME ?>"></a><br>
					<a style="padding-left: 15px" href="/">Retour au site</a><br>
					<span class="categoryname">Utilisateur</span>
					<a class="souscategory">Chercher un utilisateur</a>

					<span class="categoryname">Categorie</span>
					<a class="souscategory" href="src/cat_add.php" target="itemlist">Ajouter une Catagorie</a>
					<a class="souscategory" href="src/cat_del.php" target="itemlist">Supprimer une Catagorie</a>
					<a class="souscategory">Modifier une Catagorie</a>

					<span class="categoryname">Article</span>
					<a class="souscategory" href="src/art_add.php" target="itemlist">Ajouter un Article</a>
					<a class="souscategory" href="src/art_del.php" target="itemlist">Supprimer un Article</a>
					<a class="souscategory">Modifier un Article</a>
				</div>
				<iframe id="itemlist" name="itemlist" frameborder="0" src="src"></iframe>
				</div>
			</div>
		</div>
	</body>
</html>