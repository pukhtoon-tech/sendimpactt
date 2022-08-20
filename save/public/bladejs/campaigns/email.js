"use strict"

       function loaderSending()
       {
           $('.loading').removeClass('hidden');
       }

    $(document).ready(function(){
      $("#emailIndex").on("keyup", function() {
	var value = $(this).val().toLowerCase();
	$(".campaignEmailName tr").filter(function() {
	  $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
	});
      });
    });


  
