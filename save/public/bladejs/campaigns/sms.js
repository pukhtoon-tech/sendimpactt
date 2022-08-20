"use strict"

       function loaderSMSSending()
       {
           $('.loadingSMS').removeClass('hidden');
       }

       $(document).ready(function(){
      $("#smsIndex").on("keyup", function() {
	var value = $(this).val().toLowerCase();
	$(".smsEmailName tr").filter(function() {
	  $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
	});
      });
    });
