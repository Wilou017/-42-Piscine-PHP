<?php
	include_once("global.php");
	if(isset($_SESSION["user"]))
	{
		header('Location: /');
		exit;
	}
	include_once("inc/register.php");
?>
<html>
	<head>
		<title>Boutique <?= CMS_SITENAME ?>: Inscription</title>
		<link href="css/style.css" rel="stylesheet" type="text/css"/>
	</head>
	<body id="accueil">
		<div id="content">
			<?php require_once('header.php'); ?>

			<div id="base">
				<div id="returnvalue"></div>
				<form method="post" id="RegForm" onsubmit='return verif_champ(this, 1);' onchange="verif_champ(this, 0);">
					<input type="hidden" name="registersubmit" value="1">
					<table>
						<tr>
							<td>Nom:</td>
							<td><input name="lastname" type="text" placeholder="Nom"></td>
						</tr>
						<tr>
							<td>Prenom:</td>
							<td><input name="firstname" type="text" placeholder="Prenom"></td>
						</tr>
						<tr><td>&nbsp;</td></tr>
						<tr>
							<td>Email:</td>
							<td><input name="email_one" type="email" placeholder="Email"></td>
						</tr>
						<tr>
							<td>Confirmation:</td>
							<td><input name="email_two" type="email" placeholder="Email"></td>
						</tr>
						<tr><td>&nbsp;</td></tr>
						<tr>
							<td>Mot de passe:</td>
							<td><input name="pass_one" type="password" placeholder="Mot de passe"></td>
						</tr>
						<tr>
							<td>Confirmation:</td>
							<td><input name="pass_two" type="password" placeholder="Mot de passe"></td>
						</tr>
						<tr><td>&nbsp;</td></tr>
						<tr>
							<td></td>
							<td><input type="submit" name="submit_register" value="Enregistrer"></td>
						</tr>
					</table>
				</form>
			</div>
		</div>
	</body>
	<script type="text/javascript">
		function puterror(text)
		{
			document.getElementById('returnvalue').innerHTML = "<span class=\"notok\">" + text + "</span>";
			document.getElementById('returnvalue').style = "margin-top: 10px;";
			return false;
		}

		<?php	if (isset($error) && $error != 1)
					echo "puterror('$error');";
		?>

		function comp_champ(tab)
		{
			var i = 1;
			while (tab[i])
			{
				if (tab[i - 1] != tab[i])
					return false;
				i++;
			}
			return true;
		}
		function verif_champ(form, id)
		{
			var i = 0;
			var mdp = [];
			var mail = [];

			while (form.elements[i])
			{
				if (id == 1 && form.elements[i].value == "")
					return puterror("Un champ n'est pas remplis");
				if (form.elements[i].type == "password")
					mdp.push(form.elements[i].value);
				if (form.elements[i].type == "email")
					mail.push(form.elements[i].value);
				i++;
			}
			if (form.elements[form.elements.length - 2].value != "")
			{
				if (mdp[0].length <= 6)
					return puterror("Le Mot de passe doit faire plus de 6 caracteres");
				if (!comp_champ(mail))
					return puterror("Les E-mails ne correspondent pas");
				if (!comp_champ(mdp))
					return puterror("Les Mot de passe ne correspondent pas");
			}
			return true;
		}
	</script>
</html>