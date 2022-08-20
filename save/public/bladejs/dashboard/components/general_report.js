"use strict"

function queueWork()
       {
           $('.queue-work-loader').addClass('icon-loader');

           var url = $('#queue_work_url').val();


           /**
            * Has Value
            */

           if (url == null) {
               location.reload()
               } else {
                   $.ajax({
                       url: url,
                       method: 'GET',
                       data: {},
                       success: function (result) {
                           console.log('Queue Restart');
                       }
                   });
               }
       }


       function queueRetry()
       {
           $('.queue-retry-loader').addClass('icon-loader');

           var url = $('#queue_retry_url').val();


           /**
            * Has Value
            */

           if (url == null) {
               location.reload()
               } else {
                   $.ajax({
                       url: url,
                       method: 'GET',
                       data: {},
                       success: function (result) {
                           console.log('Queue Retryng');
                       }
                   });
               }
       }
