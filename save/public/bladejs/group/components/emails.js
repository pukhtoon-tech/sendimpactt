$(document).ready(function(){

                    "use strict"

                    /**
                     * EMAILS
                     */

                    var emails_url = $('#campaign_emails_url').val();

                    $('.loader_card').removeClass('hidden');
                        $.get(emails_url, {_token:'{{ csrf_token() }}'},  function(data){
                            $('#campaignLoadPage').append(data);
                            $('.loader_card').addClass('hidden');
                    });
                    

                $('#check_all').on('click', function(e) {
                        if($(this).is(':checked',true))
                        {
                            $(".checking").prop('checked', true);
                        } else {
                            $(".checking").prop('checked',false);
                        }
                        });

                        $('.checking').on('click',function(){
                            if($('.checking:checked').length == $('.checking').length){
                                $('#check_all').prop('checked',true);
                            }else{
                                $('#check_all').prop('checked',false);
                            }
                        });


                        // campaign-email



        $('.group-email').on('click', function(e) {


            var idsArr = [];
            $(".checking:checked").each(function() {
                idsArr.push($(this).attr('data-id'));
            });

            var group_list_url = $('#group_list_url').val();
            var group_email_url = $('#group_email_url').val(); //url

            if(idsArr.length <=0)
            {
                alert("Please select atleast one record to add into group");
            }  else {

                if(confirm("Are you sure, you want to add the selected emails?")){

                    var strIds = idsArr.join(",");
                    var group_id = $('#group_id').val();

                    // XMLHttpRequest
                    var xhr = new XMLHttpRequest();
                    xhr.open('POST', group_email_url, true);
                    xhr.setRequestHeader('X-CSRF-TOKEN', $('meta[name="csrf-token"]').attr('content'));
                    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
                    xhr.onreadystatechange = function() {
                        if (xhr.readyState == 4 && xhr.status == 200) {
                            var data = JSON.parse(xhr.responseText);
                            if (data['status']==true) {
                                alert(data['message']);
                                window.location = group_list_url;
                            } else {
                                alert('Whoops Something went wrong!!');
                            }
                        }
                    }
                    xhr.send('group_id=' + group_id + '&ids=' + strIds);

                }
            }
        });

       

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