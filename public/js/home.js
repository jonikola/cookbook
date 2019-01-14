$(document).ready(function() {
	var container = $(".ingredients");
	var add_button = $("#add-more");

	$(document).on("click", "#add-more", function(e) {
		e.preventDefault();

		$(".inner").attr('class', 'form-inline');

		var child = ' <div class="form-group"><div class="form-inline inner">';
		child += '<input type="text" class="form-control" name="ing[type][]" autocomplete="off"> ';
		child += '<input type="text" class="form-control" name="ing[qty][]" autocomplete="off"> ';
		child += '<button class="btn btn-danger remove">X</button> '
		child += '</div></div> ';


		$(child).insertBefore(".inst");
		$("#add-more").appendTo(".inner");
	});

	$(document).on("click", ".remove", function(e) {
		e.preventDefault();
		
		if ($(this).parent().children("#add-more").length == 1) {
			btn = $("#add-more");
			$(this).parent().parent().remove();
			$(".form-inline:last").append(btn);
		} else {
			$(this).parent().parent().remove();
		}
	});


	$('#category').autocomplete({
		serviceUrl: '/suggest',
		minChars: 0,
	}).bind('focus', function() { $(this).autocomplete(); });

	$('#search').autocomplete({
		serviceUrl: '/pretraga',
		dataType: 'json',
		paramName: 'search',
		onSelect: function(suggestion) {
			window.location.href = suggestion.data;
		},
	});

	if (sessionStorage.length === 0) {
		$('.list-btn').attr('disabled', true);
	} else {
		$('.empty').hide();
		$('.list-btn').attr('disabled', false);
		
		for (var key in sessionStorage){
   			if ($.isNumeric(key)) {
   				var dd = sessionStorage.getItem(key);
   				var child = '<li><a class="list-item" data-id="' + key + '">' + dd + '</a></li>';
				$('.dropdown-menu').prepend(child);
   			}
		}
	}

	$(document).on("click", ".list-item", function(e) {
		var key = $(this).attr('data-id');
		sessionStorage.removeItem(key);
		$(this).remove();
		if (sessionStorage.length === 0) {
			$('.empty').show();
			$('.list-btn').attr('disabled', true);
		}
	});

	$('li.dropdown a').on('click', function (event) {
		$(this).parent().toggleClass("open");
	});

	$('body').on('click', function (e) {
		if (!$('li.dropdown').is(e.target) && $('li.dropdown').has(e.target).length === 0 && $('.open').has(e.target).length === 0) {
			$('li.dropdown').removeClass('open');
		}
	});

	$('#print-recipe-list').on('click', function(e) {
		var keys = [];
		for (var key in sessionStorage){
   			if ($.isNumeric(key)) {
   				keys.push(key);
   			}
		}
		var data = {ids: keys};
		
		$.ajax({
			url: '/get-recipes',
			type: 'POST',
			data: data,
			success: function(result) {
				var printData = '<!DOCTYPE html><html><head><meta charset="utf-8"><title>Kuvar</title>';
				printData += '<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">';
				printData += '<link rel="stylesheet" href="/css/app.css">';
				printData += '<link href="https://fonts.googleapis.com/css?family=Roboto:400,500" rel="stylesheet" type="text/css">';
				printData += '</head><body><section id="main"><div class="container"><div class="row">';
				for(var i = 0; i < result.length; i++) {
					printData += '<div class="col-sm-12 col-md-7 recipe-info"><h1 class="recipe-title">';
					printData += result[i].title;
					printData += '</h1></div></div><div class="row"><div class="col-sm-12 col-md-6">';
					printData += '<div class="recipe-ingredients"><h2 class="subtitle">Sastojci</h2>';
					printData += '<ul class="ing-list">';
					for(var j = 0; j < result[i].ingredients.length; j++) {
						printData += '<li>' + result[i].ingredients[j].pivot.qty + ' ';
						printData += result[i].ingredients[j].name + '</li>';
					}
					printData += '</ul></div></div><div class="col-sm-12 col-md-6">';
					printData += '<div class="recipe-directions"><h2 class="subtitle">Priprema</h2>';
					printData += '<p>' + result[i].instructions + '</p></div></div>';
				}
				printData += '</div></div></section></body>';

				var printWindow = window.open();
				printWindow.document.open();
				printWindow.document.write(printData);
				printWindow.document.close();
				printWindow.focus();
		  		printWindow.print();
		  		printWindow.close();
			},
		});
		
	});

	$('#print-ing-list').on('click', function(e) {
		var keys = [];
		for (var key in sessionStorage){
   			if ($.isNumeric(key)) {
   				keys.push(key);
   			}
		}
		
		var data = {ids: keys};
		
		$.ajax({
			url: '/get-ingredients',
			type: 'POST',
			data: data,
			success: function(result) {
				var printData = '<!DOCTYPE html><html><head><meta charset="utf-8"><title>Kuvar</title>';
				printData += '<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">';
				printData += '<link rel="stylesheet" href="/css/app.css">';
				printData += '<link href="https://fonts.googleapis.com/css?family=Roboto:400,500" rel="stylesheet" type="text/css">';
				printData += '</head><body><section id="main"><div class="container"><div class="row">';
				printData += '<div class="col-sm-12 col-md-6"><div class="recipe-ingredients"><ul class="ing-list">';
				for(var ing in result) {
					printData += '<li>' + result[ing] + ' ' + ing + '</li>';
				}
				printData += '</ul></div></div></div></div></section></body>';

				var printWindow = window.open();
				printWindow.document.open();
				printWindow.document.write(printData);
				printWindow.document.close();
				printWindow.focus();
		  		printWindow.print();
		  		printWindow.close();
			},
		});
		
	});
});