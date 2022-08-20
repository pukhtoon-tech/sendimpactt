$(document).ready(function(){

                    "use strict"

                    var group_list_url = $('#group_list_url').val();
                    var group_id = $('#group_id').val();

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


                        // group-email



        $('.group-email').on('click', function(e) {


            var idsArr = [];
            $(".checking:checked").each(function() {
                idsArr.push($(this).attr('data-id'));
            });

            var group_email_url = $('#group_email_url').val(); //url

            if(idsArr.length <=0)
            {
                alert("Please select atleast one record to add into group");
            }  else {

                if(confirm("Are you sure, you want to add the selected phone numbers?")){

                    var strIds = idsArr.join(",");

                    $.ajax({
                        url: group_email_url,
                        type: 'POST',
                        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                        data: {
                            group_id: group_id,
                            ids: strIds
                        },
                        success: function (data) {
                            if (data['status']==true) {
                                window.location = group_list_url;
                            } else {
                                alert('Whoops Something went wrong!!');
                            }
                        },
                        error: function (data) {
                            alert(data.responseText);
                        }
                    });


                }
            }
        });

                });
