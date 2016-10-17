<?php
	include_once $_SERVER['DOCUMENT_ROOT'].'/inc/global.php';
	define('PAGENAME', 'Mon Compte');
	if(!user_logged())
		redirect('/');
?>
<!DOCTYPE html>
<html>
<head>
	<?php include_once ROOT.'/inc/head.php'; ?>
</head>
<body>
	<?php include_once ROOT.'/inc/header.php'; ?>
	<div class="content">
		Coucou <?= $_SESSION['user']['firstname']." ".$_SESSION['user']['lastname'] ?>


		<form action="<?= SITEURL; ?>/profil" method="post" id="changepass">
			<h3 style="margin-bottom:25px;">Changement de mot de passe</h3>
			<div class="MDgroup">
				<input type="password" name="oldpass" data-type="oldpass" required="true">
				<span class="highlight"></span>
				<span class="bar"></span>
				<label>Ancien Mot de passe</label>
			</div>
			<div class="MDgroup">
				<input type="password" name="newpass" data-type="newpass" required="true">
				<span class="highlight"></span>
				<span class="bar"></span>
				<label>Nouveau Mot de passe</label>
			</div>
			<div class="MDgroup">
				<input type="password" name="newpass2" data-type="newpass2" required="true">
				<span class="highlight"></span>
				<span class="bar"></span>
				<label>Nouveau Mot de passe</label>
			</div>
			<input type="submit" name="submit_profil" class="primary" value="Enregistrer">
		</form>

		<input type="submit" id="deletaccount" class="danger" style="margin-top: 25px;" value="Supprimer mon compte">

	</div>
	<?php include_once ROOT.'/inc/footer.php'; ?>
	<script src="<?= SITEURL; ?>/js/ajax.js"></script>
	<script src="<?= SITEURL; ?>/js/profil.js"></script>
</body>
</html>