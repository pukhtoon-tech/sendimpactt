$(document).ready(function () {

        "use strict"


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


/**
 * DELETE PERMANENTLY
 */



        $('.destory-all').on('click', function(e) {

            var idsArr = [];
            $(".checking:checked").each(function() {
                idsArr.push($(this).attr('data-id'));
            });

            var permanent_delete_url = $('#permanent_delete_url').val(); //url

            if(idsArr.length <=0)
            {
                alert(translate("Please select atleast one record to delete"));
            }  else {

                if(confirm("Are you sure, you want to delete the selected emails?")){

                    var strIds = idsArr.join(",");

                    $.ajax({
                        url: permanent_delete_url,
                        type: 'POST',
                        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                        data: 'ids='+strIds,
                        success: function (data) {
                            if (data['status']==true) {
                                $(".checking:checked").each(function() {
                                    $(this).parents("tr").remove();
                                });
                                alert(data['message']);
                                getEmails();
                            } else {
                                alert(translate('Whoops Something went wrong!!'));
                            }
                        },
                        error: function (data) {
                            alert(data.responseText);
                        }
                    });


                }
            }
        });

/**
 * Restore PERMANENTLY
 */

        $('.restore-all').on('click', function(e) {

            var idsArr = [];
            $(".checking:checked").each(function() {
                idsArr.push($(this).attr('data-id'));
            });

            var restore_url = $('#restore_url').val(); //url

            if(idsArr.length <=0)
            {
                alert("Please select atleast one record to restore");
            }  else {

                if(confirm("Are you sure, you want to restore the selected emails?")){

                    var strIds = idsArr.join(",");

                    $.ajax({
                        url: restore_url,
                        type: 'POST',
                        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                        data: 'ids='+strIds,
                        success: function (data) {
                            if (data['status']==true) {
                                $(".checking:checked").each(function() {
                                    $(this).parents("tr").remove();
                                });
                                alert(data['message']);
                                getEmails();
                            } else {
                                alert(translate('Whoops Something went wrong!!'));
                            }
                        },
                        error: function (data) {
                            alert(data.responseText);
                        }
                    });


                }
            }
        });

        //confirmation

        $('[data-toggle=confirmation]').confirmation({
            rootSelector: '[data-toggle=confirmation]',
            onConfirm: function (event, element) {
                element.closest('form').submit();
            }
        });

        // END

    });
