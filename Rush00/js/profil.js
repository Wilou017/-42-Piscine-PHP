var form = document.querySelector('form#changepass');
var deletaccount = document.querySelector('input#deletaccount');

form.addEventListener('submit', function (e) {
	e.preventDefault();
	var xhr = getHttpRequest();
	var data = new FormData(form);
	data.append("submit_profil", 1);

	xhr.open('POST', siteurl+'/ctrl/profil.ctrl.php', true);
	xhr.setRequestHeader('X-Requested-With', 'xmlhttprequest');
	xhr.send(data);
	xhr.onreadystatechange = function () {
		if (xhr.readyState === 4) {
			if (xhr.status === 200) {
				data = JSON.parse(xhr.responseText);
				if (data.result == true) {
					alert("Mot de passe changé");
				}
				else
					alert(data.message);
			} else {
				alert('Une erreur est survenue');
			}
		}
	}
});

deletaccount.addEventListener('click', function (e) {
	e.preventDefault();
	var xhr = getHttpRequest();
	var data = new FormData();
	data.append("submit_deletingaccount", 1);

	xhr.open('POST', siteurl+'/ctrl/profil.ctrl.php', true);
	xhr.setRequestHeader('X-Requested-With', 'xmlhttprequest');
	xhr.send(data);
	xhr.onreadystatechange = function () {
		if (xhr.readyState === 4) {
			if (xhr.status === 200) {
				console.log(xhr.responseText);
				data = JSON.parse(xhr.responseText);
				if (data.result == true) {
					window.location = siteurl+"/logout";
				}
				else
					alert(data.message);
			} else {
				alert('Une erreur est survenue');
			}
		}
	}
});