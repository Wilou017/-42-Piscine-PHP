var quantite = document.querySelectorAll('input#quantite');
var valide = document.querySelector('input#Valide');
var deletee = document.querySelectorAll('div.delete');
var deletaccount = document.querySelector('input#deletaccount');

for (var i = quantite.length - 1; i >= 0; i--) {
	quantite[i].addEventListener('change', function (e) {
		e.preventDefault();
			var xhr = getHttpRequest();
			var data = new FormData();
			data.append("acrtid", this.dataset.artid);
			data.append("value", this.value);
			data.append("submit_changeqqt", 1);

			xhr.open('POST', siteurl+'/ctrl/api.ctrl.php', true);
			xhr.setRequestHeader('X-Requested-With', 'xmlhttprequest');
			xhr.send(data);
			xhr.onreadystatechange = function () {
				if (xhr.readyState === 4) {
					if (xhr.status === 200) {
						data = JSON.parse(xhr.responseText);
						if (data.result == true) {
							window.location = siteurl+"/panier";
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

for (var i = deletee.length - 1; i >= 0; i--) {
	deletee[i].addEventListener('click', function (e) {
		e.preventDefault();
		var xhr = getHttpRequest();
		var data = new FormData();
		data.append("acrtid", this.dataset.artid);
		data.append("submit_delartsdf", 1);


		xhr.open('POST', siteurl+'/ctrl/api.ctrl.php', true);
		xhr.setRequestHeader('X-Requested-With', 'xmlhttprequest');
		xhr.send(data);
		console.log(xhr.responseText);
		xhr.onreadystatechange = function () {
			if (xhr.readyState === 4) {
				if (xhr.status === 200) {
					data = JSON.parse(xhr.responseText);
					if (data.result == true) {
						window.location = siteurl+"/panier";
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

valide.addEventListener('click', function (e) {
	e.preventDefault();
	var xhr = getHttpRequest();
	var data = new FormData();
	data.append("submit_valide", 1);

	xhr.open('POST', siteurl+'/ctrl/api.ctrl.php', true);
	xhr.setRequestHeader('X-Requested-With', 'xmlhttprequest');
	xhr.send(data);
	xhr.onreadystatechange = function () {
		if (xhr.readyState === 4) {
			if (xhr.status === 200) {
				data = JSON.parse(xhr.responseText);
				if (data.result == true) {
					alert("Panier Valider")
					window.location = siteurl+"/panier";
				}
				else
					alert(data.message);
			} else {
				alert('Une erreur est survenue');
			}
		}
	}
});