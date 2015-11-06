$(document).ready(function(){
	$('#search').keyup(function(){
		var search = $('#search').val();
		if (search.length >= 3){
			$.getJSON("database.php", {search:search})
				.done(function(data){
					console.log(data);
				});
		}

	});
});