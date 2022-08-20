"use strict"

    $(document).ready(function(){
      $("#smsIndex").on("keyup", function() {
	var value = $(this).val().toLowerCase();
	$(".smsName tr").filter(function() {
	  $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
	});
      });
    });
