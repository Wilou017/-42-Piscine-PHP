<?php
	include_once("../global.php");
	include_once("inc/art_add.php");
?>
<html>
	<head>
		<link href="../style.css?<?php echo time(); ?>" rel="stylesheet" type="text/css"/>
	</head>
	<body>
		<div id="returnvalue"></div>
		<form enctype="multipart/form-data" method="post" onsubmit='return verif_champ(this);'>
			<table>
				<tbody>
					<tr>
						<td>Nom</td>
						<td></td>
						<td><input type="text" name="name"></td>
					</tr>
					<tr>
						<td>Categorie</td>
						<td></td>
						<td>
							<select name="catagory" id="catagory">
								<option value="1">nom 1</option>
								<option value="2">nom 2</option>
								<option value="3">nom 3</option>
							</select>
						</td>
					</tr>
					<tr>
						<td>Photo</td>
						<td></td>
						<td><input type="file" name="fichier"></td>
					</tr>
					<tr>
						<td>Tailles disponible</td>
						<td><button type="button" onclick="add_size()" value="+"> + </button></td>
						<td><span id="art_size"><input type="text" name="size[]"> </span></td>
					</tr>
					<tr>
						<td>Couleur disponible</td>
						<td><button type="button" onclick="add_color()" value="+"> + </button></td>
						<td><span id="art_color"><input type="color" value="#FFFFFF" name="color[]"> </span></td>
					</tr>
					<tr>
						<td>Nombre en stock:</td>
						<td></td>
						<td><input type="text" name="stock"></td>
					</tr>
					<tr>
						<td>Description:</td>
						<td></td>
						<td><textarea name="description" id="desc_add_art" cols="30" rows="10"></textarea></td>
					</tr>
					<tr>
						<td>Prix en euros:</td>
						<td></td>
						<td><input type="text" name="price"></td>
					</tr>
					<tr>
						<td>Temps de livraison etimé:</td>
						<td></td>
						<td>

							<input type="text" name="time_delivery" style="width: 50px; display: inline-block;">   jours
						</td>
					</tr>
					<tr>
						<td></td>
						<td></td>
						<td><input type="submit" name="submit" value="Ajouter"></td>
					</tr>
				</tbody>
			</table>
		</form>
	</body>
		<script type="text/javascript">
		function puterror(text)
		{
			document.getElementById('returnvalue').innerHTML = "<span class=\"notok\">" + text + "</span>";
			document.getElementById('returnvalue').style = "margin: 20px 0;";
			return false;
		}

		<?php	if (isset($message))
					echo "puterror('$message');";
		?>

		function verif_champ(form)
		{
			var i = 0;

			while (form.elements[i])
			{
				if (form.elements[i].value == "")
					return puterror("Un champ n'est pas remplis");
				else
					alert(form.elements[i].value);
				i++;
			}
			return true;
		}
		function add_color()
		{
			 document.getElementById("art_color").innerHTML += "<input type=\"color\" value=\"#FFFFFF\" name=\"color[]\"> ";
		}
		function add_size()
		{
			 document.getElementById("art_size").innerHTML += "<input type=\"text\" name=\"size[]\"> ";
		}
	</script>
</html>