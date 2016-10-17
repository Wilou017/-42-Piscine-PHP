<?php
	include_once $_SERVER['DOCUMENT_ROOT'].'/admin/inc/global.php';
	define('PAGENAME', 'Adminitration');


	$users = get("*", "users", false, false);

?>
<!DOCTYPE html>
<html>
<head>
	<?php include_once ROOT.'/inc/head.php'; ?>
</head>
<body>
	<?php include_once ROOT.'/inc/header.php'; ?>
	<div class="content">
		<?php while($users && ($user = mysqli_fetch_assoc($users))): ?>
			<table>

				<input type="submit" id="deletaccount" data-userid="<?= $user['id'] ?>" class="danger" style="margin-bottom: 25px;" value="Supprimer <?= $user['firstname']." ".$user['lastname'] ?> compte">

				<?php foreach ($user as $key => $value): ?>

				<tr>
					<td><?= $key ?></td>
					<td><?= $value ?></td>
				</tr>

				<?php endforeach; ?>
			</table>
			<br><hr><br>
		<?php endwhile; ?>
	</div>
	<?php include_once ROOT.'/inc/footer.php'; ?>
	<script src="<?= SITEURL; ?>/js/ajax.js"></script>
	<script>
		var deletaccount = document.querySelectorAll('input#deletaccount');

		for (var i = deletaccount.length - 1; i >= 0; i--) {
			deletaccount[i].addEventListener('click', function (e) {
				e.preventDefault();
				var xhr = getHttpRequest();
				var data = new FormData();
				data.append("userid", this.dataset.userid);
				data.append("submit_delusr", 1);
				xhr.open('POST', siteurl+'/admin/ctrl/users.ctrl.php', true);
				xhr.setRequestHeader('X-Requested-With', 'xmlhttprequest');
				xhr.send(data);
				xhr.onreadystatechange = function () {
					if (xhr.readyState === 4) {
						if (xhr.status === 200) {
							data = JSON.parse(xhr.responseText);
							if (data.result == true) {
								alert("Utilisateur supprimer");
							}
							else
								alert(data.message);
						} else {
							alert('Une erreur est survenue');
						}
					}
				}
			});
		}
	</script>
</body>
</html>