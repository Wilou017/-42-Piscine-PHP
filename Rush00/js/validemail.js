var form = document.querySelector('form');

form.addEventListener('submit', function (e) {
	e.preventDefault();
	var xhr = getHttpRequest();
	var data = new FormData(form);
	data.append("submit_validemail", 1);

	xhr.open('POST', siteurl+'/ctrl/validemail.ctrl.php', true);
	xhr.setRequestHeader('X-Requested-With', 'xmlhttprequest');
	xhr.send(data);
	xhr.onreadystatechange = function () {
		if (xhr.readyState === 4) {
			if (xhr.status === 200) {
				data = JSON.parse(xhr.responseText);
				if (data.result == true) {
					alert("Votre Email a été validé");
					window.location = "/login";
				}
				else
					alert(data.message);
			} else {
				alert('Une erreur est survenue');
			}
		}
	}
});