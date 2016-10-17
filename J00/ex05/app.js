$(document).ready(function() {
	var lastconvers;
	var name = "Inconnu";
	var outil = "none";
	var visio = 0;
	var serv = 0;

	$('img.action').on('click', function(event) {
		if (outil != "none"){
			$('img#'+outil).removeClass('selected');
		}
		if ($(this).attr('id') == outil) {
			$('img#'+outil).removeClass('selected');
			outil = "none";
		}
		else
		{
			$(this).addClass('selected');
			outil = $(this).attr('id');
		}
		if ($(this).attr('id') != "oeil" && visio) {
			visio = 0;
			$('div#cluster').find("a").removeClass('selected');
			$('div#desc').hide();

		}
	});

	$('img#chat').on('click', function(event) {
		event.preventDefault();
		$('div#cluster').find("a").hide();
		lastconvers = 'chat';
		$('div.popup').addClass('show');
		$('img#photo').show();
		$('img#photo').attr({
			src: 'https://cdn.intra.42.fr/users/medium_zaz.jpg'
		});
		$('span#text').html("- Bonjour, tu es nouveau ici ?");
	});

	$('img#fleche').on('click', function(event) {
		$(this).removeClass('selected');
		$('div#cluster').show();
		$('img#main').show();
		$('img#chat').show();
		$(this).hide();
		$('img#tools').show();
		$('img#oeil').show();
		$('div#terre').hide();
	});

	$('img#oeil').on('click', function(event) {
		if (visio)
		{
			visio = 0;
			$('div#cluster').find("a").removeClass('selected');
			$('div#desc').hide();
		}
		else
		{
			visio = 1;
			$('div#cluster').find("a").addClass('selected');
			$('div#desc').show();
		}

	});

	$("input#closepopup").on('click', function(event) {
		event.preventDefault();
		$('div.popup').removeClass('show');
		$(this).hide();
		$('img#photo').hide();
		$('form').show();
		$('img#'+outil).removeClass('selected');
		$('div#cluster').find("a").show();
	});


	$('form').submit(function(event) {
		event.preventDefault();
		var val = $('input#input').val();
		$('input#input').val("");
		if (lastconvers == 'chat')
		{
			if (val.toLowerCase() == "oui") {
				lastconvers = "name";
				$('span#text').html("Et tu t'appel comment ?");
			} else {
				$('span#text').html("ok, on s'en fout va bosser");
				lastconvers = undefined;
				$(this).hide();
				$("input#closepopup").show();
			}
		}
		else if (lastconvers == "name") {
			lastconvers = undefined;
			name = val;
			$('span#text').text("salut "+ val);
			$(this).hide();
			$("input#closepopup").show();
		}
	});

	$("a#chaise").on('click', function(event) {
		event.preventDefault();
		if(outil == "main")
		{
			alert('Vous avez trouver un serviette');
			$('span#towel').css({
				display: 'block'
			});
		}
		else{
			alert("Vous etes trop loin");
		}
	});
	$("a#ordi").on('click', function(event) {
		event.preventDefault();
		if(outil == "tools")
		{
			alert('Vous avez reparer l\'ordinateur');
		}
		else{
			alert("l'ordinateur ne fontionne plus");
		}
	});

	$('#cluster').click(function(event) {
		if (serv)
		{
			alert("Vous avez utiliser la serviette");
			$('span#towel').hide();
			serv = 0;
		}
	});

	$('span#towel').on('click', function() {
		serv = 1;
		$('img#'+outil).click();
	});



});