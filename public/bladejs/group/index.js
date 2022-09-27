$(document).ready(function(){
        "use strict"
      $("#groupIndex").on("keyup", function() {
	var value = $(this).val().toLowerCase();
	$(".groupName tr").filter(function() {
	  $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
	});
      });
    });

function getGroupFilter(filter){


    var group_url = $('#group_url').val();
    $('.loader_card').removeClass('hidden');
    $('#groupNamee').empty();
    $.get(group_url+"/"+filter, {_token:'{{ csrf_token() }}'},  function(data){
        console.log(data);
        $('#groupNamee').html(data);
        $('.loader_card').addClass('hidden');
    });
}


