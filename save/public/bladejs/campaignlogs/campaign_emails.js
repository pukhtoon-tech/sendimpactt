"use strict"

   $(document).ready(function(){
     $("#campaignLogIndex").on("keyup", function() {
 var value = $(this).val().toLowerCase();
 $(".campaignLogName tr").filter(function() {
   $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
 });
     });
   });
