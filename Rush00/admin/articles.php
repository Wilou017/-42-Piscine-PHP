<?php
	include_once $_SERVER['DOCUMENT_ROOT'].'/admin/inc/global.php';
	define('PAGENAME', 'Adminitration');


	$articles = get("id,photo", "articles", false, false);

?>
<!DOCTYPE html>
<html>
<head>
	<?php include_once ROOT.'/inc/head.php'; ?>
</head>
<body>
	<?php include_once ROOT.'/inc/header.php'; ?>
	<div class="content">
		<?php while($articles && ($article = mysqli_fetch_assoc($articles))): ?>

			<a href="<?= SITEURL; ?>/admin/article/<?= $article['id']; ?>">
				<img src="<?= $article['photo']; ?>">
			</a>

		<?php endwhile; ?>
	</div>
	<?php include_once ROOT.'/inc/footer.php'; ?>
</body>
</html>