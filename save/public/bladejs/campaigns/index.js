$(document).ready(function(){

        "use strict"

      $("#campaignIndex").on("keyup", function() {
	var value = $(this).val().toLowerCase();
	$(".campaignName tr").filter(function() {
	  $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
	});
      });
    });
