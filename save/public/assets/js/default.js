    "use strict"

    

//translate in one click
function copy() {
    $('#tranlation-table > tbody  > tr').each(function (index, tr) {
        $(tr).find('.value').val($(tr).find('.key').text());
    });
}



    //published the all checkbox
    $('input[type="checkbox"]').on('change',function () {

        var url = this.dataset.url;
        var id = this.dataset.id;


        if (url != null && id != null) {
            $.ajax({
                url: url,
                data: {id: id},
                method: 'get',
                success: function (result) {
                    
                },
            });
        }

    });

    function currencyChange() {
    $('#ru-currency').submit()
}




    