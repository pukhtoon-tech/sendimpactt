$(document).ready(function(){

    var queueUrl = $('#queueUrl').val();
    var totalFailedUrl = $('#totalFailedUrl').val();
    var totalBouncedUrl = $('#totalBouncedUrl').val();
    var totalSentMailkUrl = $('#totalSentMailkUrl').val();

    /**
     * QUEUE URL
     */

    var interval = setInterval(function(){
    $.ajax({  
        type: 'GET',  
        url: queueUrl, 
        success: function(response) {
            $('.queueCount').text(response);
        }
    });
    }, 4000);

    /**
     * totalFailedUrl
     */

    var interval = setInterval(function(){
    $.ajax({  
        type: 'GET',  
        url: totalFailedUrl,
        success: function(response) {
            $('.totalFailedUrl').text(response);
        }
    });
    }, 4000);

    /**
     * totalBouncedUrl
     */

    var interval = setInterval(function(){
    $.ajax({  
        type: 'GET',  
        url: totalBouncedUrl,
        success: function(response) {
            $('.totalBouncedUrl').text(response);
        }
    });
    }, 4000);

    /**
     * totalSentMailkUrl
     */
    
    var interval = setInterval(function(){
    $.ajax({  
        type: 'GET',  
        url: totalSentMailkUrl,
        success: function(response) {
            $('.totalSentMailkUrl').text(response);
        }
    });
    }, 4000);


});