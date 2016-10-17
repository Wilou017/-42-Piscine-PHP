<?php
	include_once $_SERVER['DOCUMENT_ROOT'].'/inc/global.php';
	define('PAGENAME', 'Inscription');
	include_once $_SERVER['DOCUMENT_ROOT'].'/ctrl/register.ctrl.php';
?>
<!DOCTYPE html>
<html>
<head>
	<?php include_once ROOT.'/inc/head.php'; ?>
</head>
<body>
	<?php include_once ROOT.'/inc/header.php'; ?>
	<div class="content">
		<form action="<?= SITEURL; ?>/register" method="post">
			<div class="MDgroup">
				<input type="text" name="lastname" data-type="lastname" required="true">
				<span class="highlight"></span>
				<span class="bar"></span>
				<label>Nom</label>
			</div>
			<div class="MDgroup">
				<input type="text" name="firstname" data-type="firstname" required="true">
				<span class="highlight"></span>
				<span class="bar"></span>
				<label>Prenom</label>
			</div>
			<select id="BirthDay" class="trois">
				<option value="" disabled selected>Jours</option>
			</select>
			<select id="BirthMonth" class="trois">
				<option value="" disabled selected>Mois</option>
			</select>
			<select id="BirthYear" class="trois">
				<option value="" disabled selected>Année</option>
			</select>
			<div class="MDgroup">
				<input type="text" name="email" data-type="email" required="true">
				<span class="highlight"></span>
				<span class="bar"></span>
				<label>Email</label>
			</div>
			<div class="MDgroup">
				<input type="password" name="pass" data-type="password" required="true">
				<span class="eye">visibility</span>
				<span class="highlight"></span>
				<span class="bar"></span>
				<label>Mot de Passe</label>
			</div>
			<div class="MDgroup">
				<input type="password" name="pass2" data-type="password2"  required="true">
				<span class="eye">visibility</span>
				<span class="highlight"></span>
				<span class="bar"></span>
				<label>Mot de Passe</label>
			</div>
			<input type="submit" name="submit_register" class="primary" value="Enregistrer">
		</form>
	</div>
	<?php include_once ROOT.'/inc/footer.php'; ?>
	<script src="<?= SITEURL; ?>/js/ajax.js"></script>
	<script src="<?= SITEURL; ?>/js/register.js"></script>
</body>
</html>