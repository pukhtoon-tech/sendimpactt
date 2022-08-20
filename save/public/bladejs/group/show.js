$(document).ready(function(){

        "use strict"

      $("#groupInput").on("keyup", function() {
	var value = $(this).val().toLowerCase();
	$("#groupTable .groupEmails").filter(function() {
	  $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
	});
      });
    });
