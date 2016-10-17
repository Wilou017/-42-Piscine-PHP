<?php
	include_once $_SERVER['DOCUMENT_ROOT'].'/inc/global.php';
	define('PAGENAME', 'Panier');

	$pricefinal = 0;
?>
<!DOCTYPE html>
<html>
<head>
	<?php include_once ROOT.'/inc/head.php'; ?>
	<link rel="stylesheet" href="<?= SITEURL ?>/css/panier.css">
</head>
<body>
	<?php include_once ROOT.'/inc/header.php'; ?>
	<div class="content">
		<div class="total">
			<div class="nombre_article">
				<p>Vous voulez acheter <?= count($_SESSION['panier']) ?> Humain, pour un TOTAL de: <span class="prix" id="pricedef">0</span>&euro;</p>
			</div>
		</div>
		<?php
			if (isset($_SESSION['panier']))
			{

				foreach ($_SESSION['panier'] as $article):
					$pricefinal += ($article['price'] * $article['count']);
			?>
				<div class="articles">
					<div class="img_article" style="background-image: url('<?= $article['photo'] ?>');"></div>
					<div class="detail_article">
						<p>Nom: <?= $article['lastname'] ?></p>
						<p>Prenom: <?= $article['firstname'] ?></p>
						<p>Categorie: <?= get_catById($article['category']) ?></p>
						<p>Taille: <?= $article['size'] ?></p>
						<p>Sexe: <?= $article['sexe'] ?></p>
						<p>Date de naissance: <?= date_format(date_create($article['birthdate']),"d/m/Y"); ?></p>
						<p>Nationalite: <?= $article['nat'] ?></p>
						<p>Stock: <?= $article['stock'] ?></p>
						<p>Prix Unité: <?= $article['price'] ?>&euro;</p>
						<p>Date de livraison estimé dans: <?= $article['time_delivery'] ?> Jours</p>
						<p>Quantité: <input data-artid="<?= $article['id'] ?>" id="quantite" class="number" value="<?= $article['count'] ?>" min="1" max="<?= $article['stock'] ?>" type="number"></p>
						<div data-artid="<?= $article['id'] ?>" class="delete"></div>
					</div>
				</div>
			<?php endforeach;
		}?>

		<div class="clear"></div>
		<div class="bot_footer">
			<div class="validate">
				<?php if (user_logged()) { ?>
				<input type="button" name="validation" id="Valide" value="Valider">
				<?php } else { ?>
					<a href="<?= SITEURL ?>/login"><input type="button" value="Connexion">
				<?php } ?>
			</div>
		</div>
	</div>
	<?php include_once ROOT.'/inc/footer.php'; ?>
	<script src="<?= SITEURL; ?>/js/ajax.js"></script>
	<script>
		document.querySelector('span#pricedef').innerHTML = <?= $pricefinal ?>;
	</script>
	<script src="<?= SITEURL; ?>/js/panier.js"></script>
</body>
</html>
