<?php
	include_once $_SERVER['DOCUMENT_ROOT'].'/admin/inc/global.php';
	define('PAGENAME', 'Adminitration');


	$paniers = get("*", "panier", array("payed" => 1), false);

?>
<!DOCTYPE html>
<html>
<head>
	<?php include_once ROOT.'/inc/head.php'; ?>
</head>
<body>
	<?php include_once ROOT.'/inc/header.php'; ?>
	<div class="content">
		<?php while($paniers && ($panier = mysqli_fetch_assoc($paniers))):

		$tab = json_decode(html_entity_decode($panier['panier']));
		?>
			<h1>Commande :</h1>
			<table>
				<?php foreach ($tab as $article):

				 ?>
				 <tr>&nbsp;</tr><tr>&nbsp;</tr><tr>&nbsp;</tr><tr>&nbsp;</tr>
				 <tr>
					<td colspan="2">Article</td>
				</tr>
					<?php foreach ($article as $key => $value): ?>
				<tr>
					<td><?= $key ?></td>
					<td><?= $value ?></td>
				</tr>

					<?php endforeach; ?>
				<?php endforeach; ?>
			</table>
			<br><hr><br>
		<?php endwhile; ?>
	</div>
	<?php include_once ROOT.'/inc/footer.php'; ?>
	<script src="<?= SITEURL; ?>/js/ajax.js"></script>
</body>
</html>