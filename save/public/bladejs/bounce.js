"use strict"

    $(document).ready(function(){
      $("#bounceIndex").on("keyup", function() {
	var value = $(this).val().toLowerCase();
	$(".bounceName tr").filter(function() {
	  $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
	});
      });
    });
