function showUser(id) {
	$.ajax({
	  type: "POST",
	  url: "wsUsers.php",
	  data: { action: "detail", userId: id }
	})
	.done(function( msg ) {
	    alert( "Data Saved: " + msg );
	});
}