function showDB(bdd) 
{
	$.ajax({
	  type: "POST",
	  url: "wsBdd.php",
	  data: { action: "list", bddName: bdd }
	})
	  .done(function( msg ) 
	  {
	    alert( "Data Saved: " + msg );
	  });

}