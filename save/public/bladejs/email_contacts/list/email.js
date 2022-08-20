"use strict"

$(document).ready(function(){
      $("#emailList").on("keyup", function() {
	var value = $(this).val().toLowerCase();
	$(".emailName tr").filter(function() {
	  $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
	});
      });
});
