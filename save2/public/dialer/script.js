"use strict"
$(document).ready(function () {
  $(".dial-pad .numbers").click(function () {
    var actualNum = $("#input__num").val();
    var numbers = $(this).attr("data-number");
    var number = actualNum + numbers;
    $("#input__num").val(number);
    $("#delet").addClass("visible");
    $(".css-mobile .dail-screen").addClass("bordered");
  });

  $("#delet").click(function () {
    var inputString = $("#input__num").val();
    var shortenedString = inputString.substr(0, inputString.length - 1);
    $("#input__num").val(shortenedString);
    if (inputString.length == 1) {
      $(this).removeClass("visible");
      $(".css-mobile .dail-screen").removeClass("bordered");
    }
  });

  var DateTime = new Date();
  var strHours = DateTime.getHours();
  var strMinutes = DateTime.getMinutes();
  var setTime = strHours + ":" + strMinutes;
  $(".css-mobile .left-time").html(setTime);

  $(function () {
    $("#drage-btn").sortable({
      revert: true
    });
    $("#drage-btn").draggable({
      connectToSortable: "#drage-btn",
      revert: "invalid"
    });
    $(".home-btn-wrapper").disableSelection();
  });
});