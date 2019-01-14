$(document).ready(function() {
	$('#add').on('click', function(e) {
		addToList();
		// var dest = $('#list-btn').offset();
		// $('.recipe-title').clone().css('transform', 'translate(' + dest.left + 'px, 0px)');
		// console.log(dest);
	});

	$('#print').on('click', function(e) {
		window.print();
	});
});

function addToList() {
	var url = window.location.pathname;
	var id = url.substring(url.lastIndexOf('/') + 1);
	var title = $('.recipe-title').text();

	sessionStorage.setItem(id, title);

	var child = '<li><a class="list-item">' + title + '</a></li>';
	$('.dropdown-menu').prepend(child);
	$('.empty').hide();
	$('.list-btn').attr('disabled', false);
}