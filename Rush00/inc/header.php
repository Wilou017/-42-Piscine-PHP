<div class="header">
		<div class="menuico">menu</div>
		<a href="<?= SITEURL; ?>" class="logo"></a>
		<!-- <button class="search-button">
			<i class="material-icons">search</i>
		</button> -->
	</div>
	<div class="nav">
		<ul class="nav">
			<?php if (!user_logged()): ?>
				<li><a href="<?= SITEURL; ?>/register">Inscription</a></li>
				<li><a href="<?= SITEURL; ?>/login">Connexion</a></li>
			<?php else: ?>
				<?php if (user_ranked(10)): ?>
					<li><a href="<?= SITEURL; ?>/admin">Administration</a></li>
					<?php if (PAGENAME == "Adminitration"): ?>
						<ul class="subnav">
							<li><a href="<?= SITEURL; ?>/admin/users">Utilisateurs</a></li>
							<li><a href="<?= SITEURL; ?>/admin/commandes">Commandes</a></li>
							<li><a href="<?= SITEURL; ?>/admin/articles">Articles</a></li>
							<li><a href="<?= SITEURL; ?>/admin/get_articles">Get Articles</a></li>
						</ul>
					<?php endif; ?>
				<?php endif; ?>
				<li><a href="<?= SITEURL; ?>/profil">Mon Compte</a></li>
				<li><a href="<?= SITEURL; ?>/logout">Deconnexion</a></li>
			<?php endif; ?>
				<li><a href="<?= SITEURL; ?>/panier">Panier</a></li>
		</ul>
	</div>
	<div class="overlay"></div>