$(document).ready(function(){

"use strict"

var emails_url = $('#emails_url').val();

$('.loader_card').removeClass('hidden');
    $.get(emails_url, {_token:'{{ csrf_token() }}'},  function(data){
        $('#loadPage').append(data);
        $('.loader_card').addClass('hidden');
    });

});



function pageLoad(){

    location.reload();

}

function getEmails(){
    
    $('.activeEmail').addClass('bg-theme-22');
    $('.activeFavourites').removeClass('bg-theme-22');
    $('.activeBlocked').removeClass('bg-theme-22');
    $('.activeTrashed').removeClass('bg-theme-22');

    var emails_url = $('#emails_url').val();
    $('.loader_card').removeClass('hidden');
    $('#loadPage').empty();
    $.get(emails_url, {_token:'{{ csrf_token() }}'},  function(data){
        $('#loadPage').append(data);
        $('.loader_card').addClass('hidden');
    });
}

function getFavourites(){

    $('.activeEmail').removeClass('bg-theme-22');
    $('.activeFavourites').addClass('bg-theme-22');
    $('.activeBlocked').removeClass('bg-theme-22');
    $('.activeTrashed').removeClass('bg-theme-22');

    var favourite_url = $('#favourite_url').val();
    $('.loader_card').removeClass('hidden');
    $('#loadPage').empty();
    $.get(favourite_url, {_token:'{{ csrf_token() }}'},  function(data){
        $('#loadPage').append(data);
        $('.loader_card').addClass('hidden');
    });
}

function getBlocked(){

    $('.activeEmail').removeClass('bg-theme-22');
    $('.activeFavourites').removeClass('bg-theme-22');
    $('.activeBlocked').addClass('bg-theme-22');
    $('.activeTrashed').removeClass('bg-theme-22');


    var blocked_url = $('#blocked_url').val();
    $('.loader_card').removeClass('hidden');
    $('#loadPage').empty();
    $.get(blocked_url, {_token:'{{ csrf_token() }}'},  function(data){
        $('#loadPage').append(data);
        $('.loader_card').addClass('hidden');
    });
}

function getTrashed(){

    $('.activeEmail').removeClass('bg-theme-22');
    $('.activeFavourites').removeClass('bg-theme-22');
    $('.activeBlocked').removeClass('bg-theme-22');
    $('.activeTrashed').addClass('bg-theme-22');


    var trashed_url = $('#trashed_url').val();
    $('.loader_card').removeClass('hidden');
    $('#loadPage').empty();
    $.get(trashed_url, {_token:'{{ csrf_token() }}'},  function(data){
        $('#loadPage').append(data);
        $('.loader_card').addClass('hidden');
    });
}

/**
 * SEARCH
 */

 function search(e)
{
    var email_search_url = $('#email_search_url').val();
    var value = $(e).val();


if(value.length > 0){
/*ajax get value*/
        if (email_search_url == null) {
            location.reload()
        } else {
            $.ajax({
                url: email_search_url,
                method: 'GET',
                data: { value: value },
                success: function (result) {
                        $('.myTable').html(result);
                }
            });
        }
}else{
    getEmails();
}

}

/**
 * SMS TEMPLATE SELECT
 */




 function selectSMS(ele)
 {
     var sms_template_id = $(ele).val();
     var sms_campaign_id = $(ele).attr('data-id');
     var sms_template_url = $('#sms_template_url').val();


    /*ajax get value*/
        if (sms_template_url == null) {
            location.reload()
        } else {
            $.ajax({
                url: sms_template_url,
                method: 'GET',
                data: { sms_template_id: sms_template_id, sms_campaign_id: sms_campaign_id },
                success: function (result) {
                        pageLoad();
                }
            });
        }
 }

 /**
  * CHECK BOUNCE
  */

   function checkBounce()
 {

     var email = $('#emailAddress').val();
     var bounce_checker_url = $('#bounce_checker_url').val();

    $('.loading').removeClass('hidden');


    /*ajax get value*/
        if (bounce_checker_url == null) {
            location.reload()
        } else {
            $.ajax({
                url: bounce_checker_url,
                method: 'GET',
                data: { email: email },
                success: function (result) {

                        $('.loading').addClass('hidden');

                        $('#resultOfBoundBox').removeClass('hidden');

                        if(result.success == true)
                        {
                            $checkBounce = '<div class="rounded-md px-5 py-4 mb-2 bg-theme-9 text-white">\n' +
                                '     <div class="flex items-center">\n' +
                                '         <div class="font-medium text-lg">'+ result.email +'</div>\n' +
                                '     </div>\n' +
                                '     <div class="mt-3">Email address is exist also has MX and DNS record</div>\n' +
                                ' </div>';
                        }else{
                            $checkBounce = '<div class="rounded-md px-5 py-4 mb-2 bg-theme-6 text-white">\n' +
                                '     <div class="flex items-center">\n' +
                                '         <div class="font-medium text-lg">'+ result.email +'</div>\n' +
                                '     </div>\n' +
                                '     <div class="mt-3">Email address has no MX and DNS record</div>\n' +
                                ' </div>';
                        }

                        $('#checkResult').html($checkBounce);
                }
            });
        }
 }


 $(document).on('click', '.paginate a', function(event){
  event.preventDefault(); 
  var page = $(this).attr('href').split('page=')[1];
  fetch_data(page);
 });

 function fetch_data(page)
 {
    $('.activeEmail').addClass('bg-theme-22');
    $('.activeFavourites').removeClass('bg-theme-22');
    $('.activeBlocked').removeClass('bg-theme-22');
    $('.activeTrashed').removeClass('bg-theme-22');

    var url = $('#email_fetch_data').val();

    $('.loader_card').removeClass('hidden');
    $('#loadPage').empty();

    $.ajax({
    type: "GET",
    url: url + "?page=" + page,
    success:function(data)
    {
        console.log(data);
        $('#loadPage').append(data);
        $('.loader_card').addClass('hidden');
    }
    });
 }