"use strict"

   $(document).ready(function(){
     $("#noteIndex").on("keyup", function() {
 var value = $(this).val().toLowerCase();
 $(".noteName tr").filter(function() {
   $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
 });
     });
   });
