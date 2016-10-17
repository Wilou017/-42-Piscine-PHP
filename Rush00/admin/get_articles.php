<?php
	include_once $_SERVER['DOCUMENT_ROOT'].'/admin/inc/global.php';
	define('PAGENAME', 'Adminitration');

?>
<!DOCTYPE html>
<html>
<head>
	<?php include_once ROOT.'/inc/head.php'; ?>
</head>
<body>
	<?php include_once ROOT.'/inc/header.php'; ?>
	<div class="content">
		<form action="<?= SITEURL; ?>/get_articles" method="post">
			<div class="MDgroup">
				<input type="number" name="nb" min="1" max="200" required="true">
				<span class="highlight"></span>
				<span class="bar"></span>
				<label>Nombre de produits entre 1 et 200</label>
			</div>
			<input type="submit" name="submit_getart" class="primary" value="Valider">
		</form>
		<div id="imgs"></div>
	</div>
	<?php include_once ROOT.'/inc/footer.php'; ?>
	<script src="<?= SITEURL; ?>/js/ajax.js"></script>
	<script>
		var form = document.querySelector('form');

		form.addEventListener('submit', function (e) {
			e.preventDefault();
			var xhr = getHttpRequest();
			var data = new FormData(form);
			data.append("submit_getart", 1);

			xhr.open('POST', siteurl+'/admin/ctrl/get_articles.ctrl.php', true);
			xhr.setRequestHeader('X-Requested-With', 'xmlhttprequest');
			xhr.send(data);
			xhr.onreadystatechange = function () {
				if (xhr.readyState === 4) {
					if (xhr.status === 200) {
							console.log(xhr.responseText);
						data = JSON.parse(xhr.responseText);
						if (data.result == true) {
							for (var i = 0; i < data.img.length; i++) {
								var node = document.createElement("img");
								node.src = data.img[i];
								document.getElementById("imgs").appendChild(node);
							}
						}
						else
							alert(data.message);
					} else {
						alert('Une erreur est survenue');
					}
				}
			}
		});
	</script>
</body>
</html>