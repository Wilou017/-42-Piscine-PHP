var articles = document.querySelectorAll('div.articles');
var lastname = document.querySelector('span#lastname');
var firstname = document.querySelector('span#firstname');
var age = document.querySelector('span#age');
var num = document.querySelector('span#num');
var email = document.querySelector('span#email');
var price = document.querySelector('span#price');
var img_popup = document.querySelector('img#img_article_popup');
var description = document.querySelector('span#description');
var pop_up = document.querySelector('div.pop_up');
var closepopup = document.querySelector('input#closepopup');
var addbasket = document.querySelector('input#addbasket');
var d = new Date();
var year = d.getFullYear();

for (var i = articles.length - 1; i >= 0; i--) {
	articles[i].addEventListener('click', function (e) {
		e.preventDefault();
		var xhr = getHttpRequest();
		var data = new FormData();
		data.append("acrtid", this.dataset.id);
		data.append("submit_artselect", 1);

		xhr.open('POST', siteurl+'/ctrl/api.ctrl.php', true);
		xhr.setRequestHeader('X-Requested-With', 'xmlhttprequest');
		xhr.send(data);
		addbasket.dataset.id = this.dataset.id;
		xhr.onreadystatechange = function () {
			if (xhr.readyState === 4) {
				if (xhr.status === 200) {
					data = JSON.parse(xhr.responseText);
					if (data.result == true)
					{

						data = data.data;
						pop_up.style.display = "block";
						lastname.innerHTML = data.lastname;
						firstname.innerHTML = data.firstname;
						age.innerHTML = year - data.birthdate.split('-')[0];
						num.innerHTML = data.numders;
						email.innerHTML = data.email;
						price.innerHTML = data.price;
						description.innerHTML = data.description;
						img_popup.src = data.photo;
					}
				} else {
					alert('Une erreur est survenue');
				}
			}
		}
	});
}
closepopup.addEventListener('click', function (e) {
	e.preventDefault();
	pop_up.style.display = "none";
});

addbasket.addEventListener('click', function (e) {
	var xhr = getHttpRequest();
	var data = new FormData();
	data.append("acrtid", this.dataset.id);
	data.append("submit_addart", 1);


	xhr.open('POST', siteurl+'/ctrl/api.ctrl.php', true);
	xhr.setRequestHeader('X-Requested-With', 'xmlhttprequest');
	xhr.send(data);
	xhr.onreadystatechange = function () {
		if (xhr.readyState === 4) {
			if (xhr.status === 200) {
				data = JSON.parse(xhr.responseText);
				if (data.result == true)
				{
					window.location = siteurl+"/panier";
				}
			} else {
				alert('Une erreur est survenue');
			}
		}
	}
});

