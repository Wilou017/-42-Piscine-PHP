<?php
	include_once $_SERVER['DOCUMENT_ROOT'].'/inc/global.php';
	define('PAGENAME', 'Inscription');
	include_once $_SERVER['DOCUMENT_ROOT'].'/ctrl/login.ctrl.php';
?>
<!DOCTYPE html>
<html>
<head>
	<?php include_once ROOT.'/inc/head.php'; ?>
</head>
<body>
	<?php include_once ROOT.'/inc/header.php'; ?>
	<div class="content">
		<form action="<?= SITEURL; ?>/login" method="post">
			<div class="MDgroup">
				<input type="text" name="email" data-type="email" required="true">
				<span class="highlight"></span>
				<span class="bar"></span>
				<label>Email</label>
			</div>
			<div class="MDgroup">
				<input type="password" name="pass" data-type="pass" required="true">
				<span class="highlight"></span>
				<span class="bar"></span>
				<label>Mot de passe</label>
			</div>
			<input type="submit" name="submit_login" class="primary" value="Connexion">
		</form>
	</div>
	<?php include_once ROOT.'/inc/footer.php'; ?>
	<script src="<?= SITEURL; ?>/js/ajax.js"></script>
	<script src="<?= SITEURL; ?>/js/login.js"></script>
</body>
</html>