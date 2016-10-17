$(document).ready(function() {
	var ret;
	var parent;
	var node;
	var coockie_name = 'datatodobis';
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
		var nodes = document.querySelector('div#ft_list').querySelectorAll('div');
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
		$('div#ft_list').prepend("<div>"+data_tab[i]+"</div>");
	}

	$('input[type="submit"]').on('click', function() {
		ret = prompt('Nouveau Todo');
		if(ret == null || ret.length == 0)
			return null;
		$('div#ft_list').prepend("<div>"+ret+"</div>");
		regen_tab();
	});

	$('div#ft_list').on('click', 'div', function() {
		if (confirm("Sur de vouloir supprimer "+$(this).text()+" ?"))
		{
			$(this).remove();
			regen_tab();
		}
	});

});