"use strict"

    // emailsList

    function emailsList()
    {
        $('#emails_list').removeClass('hidden');
    }


    $('.checkAll').on('click', function(){

            if($(this).is(':checked')){
                $('.checking').prop('checked', true);

                var favorite = [];
                $.each($("input[name='check']:checked"), function(){
                    favorite.push($(this).attr('data-id'));
                });

                let pmode = JSON.parse(localStorage.getItem('NewidsArr'));

                if (!Array.isArray(pmode)) {
                    pmode = [];
                }

                if ($(this).is(':checked')) {
                    if (!pmode.includes(favorite)) {
                        pmode.push(favorite);
                    }
                } else {
                const index = pmode.indexOf(favorite);
                    if (index > -1) {
                        pmode.splice(index, 1);
                    }
                }
                
                localStorage.setItem('NewidsArr', JSON.stringify(pmode));

                var arr1 = JSON.parse(localStorage.getItem('NewidsArr').slice(1, -1));
                var arr2 = JSON.parse(localStorage.getItem('idsArr'));
                var mergedArr = $.merge(arr2,arr1);

                localStorage.setItem('idsArr', JSON.stringify(mergedArr));
                localStorage.removeItem('NewidsArr');

            }else{
                $('.checking').prop('checked', false);
            }
        });

    $('.checking').on('click',function(){
        if($('.checking:checked').length == $('.checking').length){
            $('#check_all').prop('checked',true);
        }else{
            $('#check_all').prop('checked',false);
        }
    });

    /**
     * EMAILS
     */

    var emails_url = $('#campaign_sms_edit_url').val();

    $('.loader_card').removeClass('hidden');
        $.get(emails_url, {_token:'{{ csrf_token() }}'},  function(data){
            $('#campaignLoadPage').append(data);
            $('.loader_card').addClass('hidden');
    });


$(document).on('click', '.paginate a', function(event){
  event.preventDefault(); 
  var page = $(this).attr('href').split('page=')[1];
  fetch_data(page);
 });

 function fetch_data(page)
 {

    var url = $('#campaign_email_fetch_data').val();

    $('.loader_card').removeClass('hidden');
    $('#campaignLoadPage').empty();

    $.ajax({
    type: "GET",
    url: url + "?page=" + page,
    success:function(data)
    {
        $('#campaignLoadPage').append(data);
        $('.loader_card').addClass('hidden');
    }
    });
 }