$(document).ready(function(){
        "use strict"
      $("#groupIndex").on("keyup", function() {
	var value = $(this).val().toLowerCase();
	$(".groupName tr").filter(function() {
	  $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
	});
      });
    });
