<?php
	define('ROOT', $_SERVER['DOCUMENT_ROOT']);
	define("SITENAME", "Ligne Bleue");
	define("PAGENAME", "Installation");
	define("SITEURL", "http://{$_SERVER['HTTP_HOST']}");

	include_once ROOT.'/ctrl/install.ctrl.php';
	include_once ROOT."/inc/function.php";


	if (file_exists(ROOT."/inc/config/config.php"))
		if (file_exists(ROOT."/inc/config/config.php")) unlink(ROOT."/inc/config/config.php");
?>
<!DOCTYPE html>
<html>
<head>
	<?php include_once ROOT.'/inc/head.php'; ?>
</head>
<body>
	<?php include_once ROOT.'/inc/header.php'; ?>
	<div class="content">
		<form action="/install" method="post">
			<div class="MDgroup">
				<input type="text" name="sitename" value="Ligne Bleue" required="true">
				<span class="highlight"></span>
				<span class="bar"></span>
				<label>Nom du site</label>
			</div>
			<div class="MDgroup">
				<input type="text" name="siteurl" value="http://<?= $_SERVER['HTTP_HOST']; ?>" required="true">
				<span class="highlight"></span>
				<span class="bar"></span>
				<label>URL du site</label>
			</div>
			<div class="MDgroup">
				<input type="text" name="sitemail" value="contact@localhost" required="true">
				<span class="highlight"></span>
				<span class="bar"></span>
				<label>Email de contact</label>
			</div>
			<div class="MDgroup">
				<input type="text" name="host" value="localhost" required="true">
				<span class="highlight"></span>
				<span class="bar"></span>
				<label>Hote</label>
			</div>
			<div class="MDgroup">
				<input type="text" name="user" value="root" required="true">
				<span class="highlight"></span>
				<span class="bar"></span>
				<label>Utilisateur</label>
			</div>
			<div class="MDgroup">
				<input type="text" name="pass" value="root" required="true">
				<span class="highlight"></span>
				<span class="bar"></span>
				<label>Mot de Passe</label>
			</div>
			<div class="MDgroup">
				<input type="text" name="database" value="lignebleue" required="true">
				<span class="highlight"></span>
				<span class="bar"></span>
				<label>Nom de la base de donnee</label>
			</div>
			<input type="submit" name="submit_Conf_DB" value="Enregistrer" class="primary">
		</form>
		<noscript>Le javascript n'est pas actif</noscript>
	</div>
	<?php include_once ROOT.'/inc/footer.php'; ?>
	<script src="js/ajax.js"></script>
	<script>
		var form = document.querySelector('form');

		form.addEventListener('submit', function (e) {
			e.preventDefault();
			var xhr = getHttpRequest();
			var data = new FormData(form);
			data.append("submit_Conf_DB", 1);

			xhr.open('POST', '/ctrl/install.ctrl.php', true);
			xhr.setRequestHeader('X-Requested-With', 'xmlhttprequest');
			xhr.send(data);
			xhr.onreadystatechange = function () {
				if (xhr.readyState === 4) {
					if (xhr.status === 200) {
						console.log(xhr.responseText);
						data = JSON.parse(xhr.responseText);
						if (data.result == true) {
							window.location = "/";
						}
						else
							alert(data.message);
					}
					else
						alert('Une erreur est survenue, Code #'+xhr.status);
				}
			}
		});
	</script>
</body>
</html>