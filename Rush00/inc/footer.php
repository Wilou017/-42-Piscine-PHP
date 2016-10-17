<div class="footer">
		<ul class="nav_footer">
			<li style="border: none;"><a href="http://aymericdev.fr">Designed by Aymeric Maitre</a></li>
		</ul>
	</div>
	<script>
		var body = document.querySelector('body');

		document.querySelector('div.menuico').addEventListener('click', function () {
			body.classList.toggle("shownav");
		});
		document.querySelector('div.overlay').addEventListener('click', function () {
			body.classList.remove("shownav");
		});
	</script>