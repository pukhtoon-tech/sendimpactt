$(document).ready(function(){

        "use strict"

      $("#notificationIndex").on("keyup", function() {
	var value = $(this).val().toLowerCase();
	$(".notificationName tr").filter(function() {
	  $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)

	});
      });
    });
