$(document).ready(function() {
	var ret;
	var parent;
	var node;
	var data_tab;


	$.post("select.php",
	{
		"select_todo": "1"
	},
	function(data){
		table = JSON.parse(data);
		if(table.request == true){
			data_tab = table.data;
			for (var i = 0; i < data_tab.length; i++) {
				$('div#ft_list').prepend("<div data-id=\""+data_tab[i][0]+"\">"+data_tab[i][1]+"</div>");
			}
		} else {
			alert('Une erreur est survenue');
		};
	});


	$('input[type="submit"]').on('click', function() {
		ret = prompt('Nouveau Todo');
		if(ret == null || ret.length == 0)
			return null;
		$.post("insert.php",
		{
			"insert_todo": "1",
			"todo": ret
		},
		function(data){
			table = JSON.parse(data);
			if(table.request == true){
				data_tab = table.data;
				$('div#ft_list').prepend("<div data-id=\""+data_tab[0]+"\">"+data_tab[1]+"</div>");
			} else {
				alert('Une erreur est survenue');
			};
		});
	});

	$('div#ft_list').on('click', 'div', function() {
		if (confirm("Sur de vouloir supprimer "+$(this).text()+" ?"))
		{
			var Myself = $(this);
			$.post("delete.php",
			{
				"delete_todo": "1",
				"todoID": Myself.data('id')
			},
			function(data){
				table = JSON.parse(data);
				if(table.request == true){
					Myself.remove();
				} else {
					alert('Une erreur est survenue');
				};
			});
		}
	});

});