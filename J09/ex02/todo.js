var submit = document.querySelector('input[type="submit"]');
var ft_list = document.querySelector('div#ft_list');
var ret;
var parent;
var node;
var coockie_name = 'datatodo';
var data_tab;

function setCookie(name, val) {
	var d = new Date();
	d.setTime(d.getTime() + (365*24*60*60*1000));
	var expires = "expires="+ d.toUTCString();
	document.cookie = name + "=" + val + ";" + expires + ";path=/";
}

function getCookie(name) {
	var name = name + "=";
	var ca = document.cookie.split(';');
	for(var i = 0; i <ca.length; i++) {
		var c = ca[i];
		while (c.charAt(0)==' ') {
			c = c.substring(1);
		}
		if (c.indexOf(name) == 0) {
			return c.substring(name.length,c.length);
		}
	}
	return "";
}

function regen_tab() {
	var ntab = []
	var nodes = ft_list.querySelectorAll('div');
	for (var i = nodes.length - 1; i >= 0; i--) {
		ntab[ntab.length] = nodes[i].textContent;
	}
	setCookie(coockie_name, ntab.join());
}

if (getCookie(coockie_name).length >= 1)
	data_tab = getCookie(coockie_name).split(",");
else
	data_tab = [];

for (var i = 0; i < data_tab.length; i++) {
	ret = data_tab[i];
	node = document.createElement("div");
	node.appendChild(document.createTextNode(ret));
	ft_list.insertBefore(node, (ft_list.querySelector('div')) ? ft_list.querySelector('div') : submit);

	node.addEventListener('click', function () {
		if (confirm("Sur de vouloir supprimer "+this.textContent+" ?"))
		{
			parent = this.parentNode.removeChild(this);
			regen_tab();
		}
	});
}

submit.addEventListener('click', function () {
	ret = prompt('Nouveau Todo');
	if(ret == null || ret.length == 0)
		return null;

	node = document.createElement("div");
	node.appendChild(document.createTextNode(ret));
	ft_list.insertBefore(node, (ft_list.querySelector('div')) ? ft_list.querySelector('div') : submit);

	node.addEventListener('click', function () {
		if (confirm("Sur de vouloir supprimer "+this.textContent+" ?"))
		{
			this.parentNode.removeChild(this);
			regen_tab();
		}
	});
	regen_tab();
});