$(document).ready(function() {

	$('.envoyerCoord').click(function() {
	var coords = $('#modal-coords').data('coords');
    localStorage.setItem('coordinate', coords);

    });
});