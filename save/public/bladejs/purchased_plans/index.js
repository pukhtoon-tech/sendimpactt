"use strict"

   $(document).ready(function(){
     $("#mailLogIndex").on("keyup", function() {
 var value = $(this).val().toLowerCase();
 $(".mailLogName tr").filter(function() {
       $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1);
 });
     });
   });
