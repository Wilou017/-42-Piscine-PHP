var form = document.querySelector('form');
var inputs = document.querySelectorAll('input');
var pass = document.querySelector('input[data-type="password"]');
var pass2 = document.querySelector('input[data-type="password2"]');
var eyes = document.querySelectorAll('span.eye');
var textreg = new RegExp('^[a-zA-Z0-9áàâäãåçéèêëíìîïñóòôöõúùûüýÿæœÁÀÂÄÃÅÇÉÈÊËÍÌÎÏÑÓÒÔÖÕÚÙÛÜÝŸÆŒ._-\\s-]{2,}$', 'i');
var mailreg = new RegExp('^[a-zA-Z0-9.+=_-]{2,}@[a-zA-Z0-9-\\.]{2,}\\.[a-zA-Z0-9-]{2,}$', 'i');
var passreg = new RegExp('^(?=.*\\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[!@#$%^&*()_+\\-={}[\\]\\\\|;\':",.\\/<>?]).{8,}$');
var curentdate = new Date();
var mois = new Array("Janvier", "Février", "Mars", "Avril", "Mai", "Juin", "Juillet", "Août", "Septembre", "Octobre", "Novembre", "Décembre");

for (var i = 1; i <= 31; i++) {
	var node = document.createElement("option");
	var textnode = document.createTextNode(i);
	node.appendChild(textnode);
	node.value = i;
	document.getElementById("BirthDay").appendChild(node);
}


for (var i = 1; i <= 12; i++) {
	var node = document.createElement("option");
	var textnode = document.createTextNode(mois[i-1]);
	node.appendChild(textnode);
	node.value = i;
	document.getElementById("BirthMonth").appendChild(node);
}


for (var i = curentdate.getFullYear(); i >= curentdate.getFullYear() - 100; i--) {
	var node = document.createElement("option");
	var textnode = document.createTextNode(i);
	node.appendChild(textnode);
	node.value = i;
	document.getElementById("BirthYear").appendChild(node);
}


for (var i = inputs.length - 1; i >= 0; i--) {
	inputs[i].addEventListener('blur', function (e) {
		this.classList.remove("error");

		if (this.value.length < 1 && this.required == true)
			this.classList.add("error");

		if((this.dataset.type == "lastname" || this.dataset.type == "firstname") && !textreg.test(this.value))
			this.classList.add("error");

		if(this.dataset.type == "email" && !mailreg.test(this.value))
			this.classList.add("error");

		if((this.dataset.type == "password" || this.dataset.type == "password2") && !passreg.test(this.value))
			this.classList.add("error");

		if ((this.dataset.type == "password" && pass2.value.length > 0) || (this.dataset.type == "password2" && pass.value.length > 0))
		{
			if (pass2.value != pass.value)
			{
				pass.classList.add("error");
				pass2.classList.add("error");
			}
			else
			{
				pass.classList.remove("error");
				pass2.classList.remove("error");
			}

		}
	});

	inputs[i].addEventListener('focus', function () {
		pass.type = "password";
		pass2.type = "password";
		for (var i = eyes.length - 1; i >= 0; i--) {
			eyes[i].innerHTML = "visibility";
			eyes[i].classList.remove("show");
		}
		if (this.dataset.type == "password" || this.dataset.type == "password2")
		{
			this.parentNode.querySelector("span.eye").classList.add("show");
		}
	});
}

for (var i = eyes.length - 1; i >= 0; i--) {
	eyes[i].addEventListener('click', function (e) {
		this.innerHTML = (this.innerHTML == "visibility") ? "visibility_off" :"visibility";
		var thisInput = this.parentNode.querySelector("input");
		thisInput.type = (thisInput.type == "password") ? "text" : "password";
	});
}

function check_empty(formulaire)
{
	var verif_inputs = formulaire.querySelectorAll('input');
	console.log(verif_inputs);
	for (var i = 0; i < verif_inputs.length - 1; i++) {
		if (verif_inputs[i].value.length < 1)
		{
			console.log(verif_inputs[i]);
			verif_inputs[i].classList.add("error");
			return (0);
		}
	}
	return (1);
}

form.addEventListener('submit', function (e) {
	e.preventDefault();
	if (check_empty(form))
	{
		var xhr = getHttpRequest();
		var data = new FormData(form);
		data.append("submit_register", 1);

		xhr.open('POST', siteurl+'/ctrl/register.ctrl.php', true);
		xhr.setRequestHeader('X-Requested-With', 'xmlhttprequest');
		xhr.send(data);
		xhr.onreadystatechange = function () {
			if (xhr.readyState === 4) {
				if (xhr.status === 200) {
					data = JSON.parse(xhr.responseText);
					if (data.result == true) {
						window.location = siteurl+"/login";
					}
					else
						alert(data.message);
				} else {
					alert('Une erreur est survenue');
				}
			}
		}
	}
});