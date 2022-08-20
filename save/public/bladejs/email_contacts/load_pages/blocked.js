$(document).ready(function () {

                    "use strict"

                    /**
                     * DELETE ALL
                     */

                    $('#check_all').on('click', function (e) {
                        if ($(this).is(':checked', true)) {
                            $(".checking").prop('checked', true);
                        } else {
                            $(".checking").prop('checked', false);
                        }
                    });

                    $('.checking').on('click', function () {
                        if ($('.checking:checked').length == $('.checking').length) {
                            $('#check_all').prop('checked', true);
                        } else {
                            $('#check_all').prop('checked', false);
                        }
                    });

                    $('.delete-all').on('click', function (e) {

                        var idsArr = [];
                        $(".checking:checked").each(function () {
                            idsArr.push($(this).attr('data-id'));
                        });

                        var delete_url = $('#delete_url').val(); //url

                        if (idsArr.length <= 0) {
                            alert("Please select atleast one record to delete");
                        } else {

                            if (confirm("Are you sure, you want to delete the selected emails?")) {

                                var strIds = idsArr.join(",");

                                $.ajax({
                                    url: delete_url,
                                    type: 'POST',
                                    headers: {
                                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr(
                                            'content')
                                    },
                                    data: 'ids=' + strIds,
                                    success: function (data) {
                                        if (data['status'] == true) {
                                            $(".checking:checked").each(function () {
                                                $(this).parents("tr").remove();
                                            });
                                            alert(data['message']);
                                            getEmails();
                                        } else {
                                            alert(translate(
                                                'Whoops Something went wrong!!'));
                                        }
                                    },
                                    error: function (data) {
                                        alert(data.responseText);
                                    }
                                });


                            }
                        }
                    });


                    // Blocked

                    $('.block-all').on('click', function (e) {

                        var idsArr = [];
                        $(".checking:checked").each(function () {
                            idsArr.push($(this).attr('data-id'));
                        });

                        var blacklist_url = $('#blacklist_url').val(); //url

                        if (idsArr.length <= 0) {
                            alert("Please select atleast one record to block");
                        } else {

                            if (confirm("Are you sure, you want to block the selected emails?")) {

                                var strIds = idsArr.join(",");

                                $.ajax({
                                    url: blacklist_url,
                                    type: 'POST',
                                    headers: {
                                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr(
                                            'content')
                                    },
                                    data: 'ids=' + strIds,
                                    success: function (data) {
                                        if (data['status'] == true) {
                                            $(".checking:checked").each(function () {
                                                $(this).parents("tr").remove();
                                            });
                                            alert(data['message']);
                                            getEmails();
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

                    // Favourites

                    $('.favourites-all').on('click', function (e) {

                        var idsArr = [];
                        $(".checking:checked").each(function () {
                            idsArr.push($(this).attr('data-id'));
                        });

                        var fav_url = $('#fav_url').val(); //url

                        if (idsArr.length <= 0) {
                            alert("Please select atleast one record to favourite");
                        } else {

                            if (confirm("Are you sure, you want to add as favourite the selected emails?")) {

                                var strIds = idsArr.join(",");

                                $.ajax({
                                    url: fav_url,
                                    type: 'POST',
                                    headers: {
                                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr(
                                            'content')
                                    },
                                    data: 'ids=' + strIds,
                                    success: function (data) {
                                        if (data['status'] == true) {
                                            $(".checking:checked").each(function () {
                                                $(this).parents("tr").remove();
                                            });
                                            alert(data['message']);
                                            getEmails();
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

                    // Favourites

                    $('.unblock-all').on('click', function (e) {

                        var idsArr = [];
                        $(".checking:checked").each(function () {
                            idsArr.push($(this).attr('data-id'));
                        });

                        var unblock_url = $('#unblock_url').val(); //url

                        if (idsArr.length <= 0) {
                            alert("Please select atleast one record to unblock");
                        } else {

                            if (confirm("Are you sure, you want to unblock the selected emails?")) {

                                var strIds = idsArr.join(",");

                                $.ajax({
                                    url: unblock_url,
                                    type: 'POST',
                                    headers: {
                                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr(
                                            'content')
                                    },
                                    data: 'ids=' + strIds,
                                    success: function (data) {
                                        if (data['status'] == true) {
                                            $(".checking:checked").each(function () {
                                                $(this).parents("tr").remove();
                                            });
                                            alert(data['message']);
                                            getEmails();
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

                    //confirmation

                    $('[data-toggle=confirmation]').confirmation({
                        rootSelector: '[data-toggle=confirmation]',
                        onConfirm: function (event, element) {
                            element.closest('form').submit();
                        }
                    });

                    // END

                });
