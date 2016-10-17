<?php
	include_once $_SERVER['DOCUMENT_ROOT'].'/inc/global.php';
	define('PAGENAME', 'Accueil');
?>
<!DOCTYPE html>
<html>
<head>
	<?php include_once ROOT.'/inc/head.php'; ?>
	<link rel="stylesheet" href="<?= SITEURL ?>/css/index.css">
	<link rel="stylesheet" href="<?= SITEURL ?>/css/pop_up.css">
</head>
<body>
	<?php include_once ROOT.'/inc/header.php'; ?>
	<div class="content">
		<div class="pop_up">
			<img id="img_article_popup" class="img_article" src=""/>
			<h2 class="info">Information</h2>
			<div class="info_gauche">
				<p><b>Nom: </b><span id="lastname"></span></br></p>
				<p><b>Prenom: </b><span id="firstname"></span></br></p>
				<p><b>Age: </b><span id="age"></span></br></p>
			</div>
			<div class="info_droite">
				<p><b>Numero: </b><span id="num"></span></br></p>
				<p><b>Mail: </b><span id="email"></span></br></p>
				<p><b>Prix: </b><span id="price"></span>&euro;</br></p>
			</div>
			<div class="message">
				<p><b>Description: </b><span id="description"></span></br></p>
			</div>
			<input type="submit" id="addbasket" data-user="" value="Ajouter au panier" class="primary"><br>
			<input type="submit" id="closepopup" value="Fermer" class="danger">
		</div>
		<?php
			$categorys = get("*", "category", false, false);

			while($categorys && ($category = mysqli_fetch_assoc($categorys))): ?>
				<div class=border_class>
					<?= $category['category']; ?>
				</div>
				<div class="big_articles">
					<?php
						$sql = "SELECT * FROM `articles` WHERE `category` LIKE '%{$category['id']}%' LIMIT 0,7";
						$articles = mysqli_query($db, $sql);
						while($articles && ($article = mysqli_fetch_assoc($articles))): ?>
							<div class="articles" data-id="<?= $article['id'] ?>">
								<div class="img_article" style="background-image: url('<?= $article['photo'] ?>');"></div>
								<div class="info_article">
									<p>Nom: <?= $article['lastname'] ?></p>
									<p>Prenom: <?= $article['firstname'] ?></p>
									<p>Prix: <?= $article['price'] ?>&euro;</p>
								</div>
							</div>
						<?php endwhile; ?>
				</div>
		<?php endwhile; ?>
	</div>
	<?php include_once ROOT.'/inc/footer.php'; ?>
	<script src="<?= SITEURL; ?>/js/ajax.js"></script>
	<script src="<?= SITEURL; ?>/js/index.js"></script>
</body>
</html>
