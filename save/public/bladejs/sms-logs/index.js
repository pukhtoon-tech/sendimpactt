"use strict"

    $(document).ready(function(){
      $("#smsLogIndex").on("keyup", function() {
	var value = $(this).val().toLowerCase();
	$(".smsLogName tr").filter(function() {
	  $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
	});
      });
    });
