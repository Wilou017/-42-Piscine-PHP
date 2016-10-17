<?php
	include_once $_SERVER['DOCUMENT_ROOT'].'/inc/global.php';
	define('PAGENAME', 'Inscription');
	include_once $_SERVER['DOCUMENT_ROOT'].'/ctrl/validemail.ctrl.php';
?>
<!DOCTYPE html>
<html>
<head>
	<?php include_once ROOT.'/inc/head.php'; ?>
</head>
<body>
	<?php include_once ROOT.'/inc/header.php'; ?>
	<div class="content">
		<form action="<?= SITEURL; ?>/validemail" method="post">
			<div class="MDgroup">
				<input type="text" name="token" value="<?= htmlspecialchars($_GET['token']); ?>" required="true">
				<span class="highlight"></span>
				<span class="bar"></span>
				<label>Clé d'enregistrement</label>
			</div>
			<input type="submit" name="submit_validmail" class="primary" value="Valider">
		</form>
	</div>
	<?php include_once ROOT.'/inc/footer.php'; ?>
	<script src="<?= SITEURL; ?>/js/ajax.js"></script>
	<script src="<?= SITEURL; ?>/js/validemail.js"></script>
</body>
</html>