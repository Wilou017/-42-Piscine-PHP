<?php
	include_once $_SERVER['DOCUMENT_ROOT'].'/admin/inc/global.php';
	define('PAGENAME', 'Adminitration');


	$article = get("*", "articles", array('id' => $_GET['id_article']));
	if (!$article)
		redirect('/admin/articles');
?>
<!DOCTYPE html>
<html>
<head>
	<?php include_once ROOT.'/inc/head.php'; ?>
	<style>
		table{
			margin: 0 auto;
			text-align: center;
		}
		td:first-child{
			width: 25%;
		}
		td{
			border-bottom:1pt solid black;
			padding: 10px;
		}
	</style>
</head>
<body>
	<?php include_once ROOT.'/inc/header.php'; ?>
	<div class="content">
		<center>
			<img style="width:200px;" src="<?= $article['photo'] ?>">
			<table>
				<tr>
					<td>Liste des categories:</td>
					<td><?= get_catById($article['category']) ?></td>
				</tr>
				<tr>
					<td>Nationalite:</td>
					<td><?= $article['nat'] ?></td>
				</tr>
				<tr>
					<td>Prenom:</td>
					<td><?= $article['firstname'] ?></td>
				</tr>
				<tr>
					<td>Nom:</td>
					<td><?= $article['lastname'] ?></td>
				</tr>
				<tr>
					<td>Numero de telephone:</td>
					<td><?= $article['numders'] ?></td>
				</tr>
				<tr>
					<td>Adresse:</td>
					<td><?= $article['adress'] ?></td>
				</tr>
				<tr>
					<td>Email:</td>
					<td><?= $article['email'] ?></td>
				</tr>
				<tr>
					<td>Date de naissance:</td>
					<td><?= $article['birthdate'] ?></td>
				</tr>
				<tr>
					<td>Pseudo:</td>
					<td><?= $article['username'] ?></td>
				</tr>
				<tr>
					<td>Mot de passe:</td>
					<td><?= $article['password'] ?></td>
				</tr>
				<tr>
					<td>Sexe:</td>
					<td><?= $article['sexe'] ?></td>
				</tr>
				<tr>
					<td>Taille:</td>
					<td><?= $article['size'] ?></td>
				</tr>
				<tr>
					<td>Description:</td>
					<td><?= $article['description'] ?></td>
				</tr>
				<tr>
					<td>Stock:</td>
					<td><?= $article['stock'] ?></td>
				</tr>
				<tr>
					<td>Prix:</td>
					<td><?= $article['price'] ?></td>
				</tr>

				<tr>
					<td>Temp de livraison:</td>
					<td><?= $article['time_delivery'] ?></td>
				</tr>
			</table>

				<input type="submit" id="deletaccount" data-userid="<?= $article['id'] ?>" class="danger" style="margin-bottom: 25px;" value="Supprimer">
		</center>
	</div>
	<?php include_once ROOT.'/inc/footer.php'; ?>
	<script src="<?= SITEURL; ?>/js/ajax.js"></script>
	<script>
		var deletaccount = document.querySelector('input#deletaccount');

		deletaccount.addEventListener('click', function (e) {
			e.preventDefault();
			var xhr = getHttpRequest();
			var data = new FormData();
			data.append("userid", this.dataset.userid);
			data.append("submit_delart", 1);
			xhr.open('POST', siteurl+'/admin/ctrl/article.ctrl.php', true);
			xhr.setRequestHeader('X-Requested-With', 'xmlhttprequest');
			xhr.send(data);
			xhr.onreadystatechange = function () {
				if (xhr.readyState === 4) {
					if (xhr.status === 200) {
						data = JSON.parse(xhr.responseText);
						if (data.result == true) {
							alert('Article supprimer');
							window.location = siteurl+"/admin/articles";
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