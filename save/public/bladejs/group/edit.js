$(document).ready(function(){

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

      // group-email

      });
