<div id="header">
				<a class="logo" href="/" title="<?= CMS_SITENAME ?>"></a>
				<div class="lien">
					<a OnCLick="nicesong()">Bon son</a>
					<a href="#">Lien 2</a>
					<a href="#">Lien 3</a>
					<a href="#">Lien 4</a>
				</div>
				<?php if (!isset($_SESSION["user"]))
				{ ?>
					<div class="login">
						<form method="post">
							<table>
								<tr>
									<td><label for="email">Email: </label></td>
									<td><input name="email" id="email" type="text"placeholder="Email"></td>
								</tr>
								<tr>
									<td><label for="password">Mot de passe: </label></td>
									<td><input name="password" id="password" type="password" placeholder="Mot de passe"></td>
								</tr>
								<tr>
									<td><a href="register">Inscription</a></td>
									<td><input type="submit" name="login_submit" value="Connexion"></td>
								</tr>
							</table>
						</form>
						<?php if (isset($error_login)) echo $error_login; ?>
					</div>
				<?php
				}
				else
				{ ?>
					Bonjour <?php echo $_SESSION['user']['firstname']; ?> <?php echo $_SESSION['user']['lastname']; ?> <br>
					<a href="logout">Logout</a>
					<?php
					if ($_SESSION['user']['rank'] >= 10)
					{
					?>
						<a href="administration">Administration Panel</a>
					<?php
					}
				} ?>
			</div>