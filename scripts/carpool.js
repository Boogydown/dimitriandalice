// Auto-run funcs
// (need to make sure doc is loaded, first)
$(document).ready( function () 
{
	$.ajaxSetup(
	{
		cache: false,
		type: "POST",
		dataType: "json",
		error: onAjaxError,
		traditional: false,
		url: "http://dimitriandalice.com/scripts/carpool.php"
	});
		$.ajax( { data:{ status:"loadCarpools" }, success:fillCarpools } );
	
});

function fillCarpools( carpoolList )
{
    var firstPass = true;

    for ( var i in carpoolList )
	{
		if ( firstPass )
			firstPass = false;
		else
			$(".carpoolTemplateRow:last").clone().appendTo("#carpoolTable");
		
		var curRow = $(".carpoolTemplateRow:last");

		for ( var col in carpoolList[i] )
			$("td:eq(" + (col + 1) + ")", curRow).text( carpoolList[i][col] );
    }
    

}


/***************************************************
 * AJAX Global callback for all errors
 */
function onAjaxError( xhr, ts, et )
{
	window.alert( "Server-side error: \n" +
				   xhr.responseText + "\n" +
				   ts + "\n" +
				   et );
}
