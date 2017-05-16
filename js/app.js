window.$ = window.jQuery

$(document).ready(function() {
  var $masthead = $("#masthead")
  var $mobile_masthead = $("#mobile_masthead")
  var $burger = $mobile_masthead.find(".burger")

  $burger.on("click", function(e) {
    $mobile_masthead.toggleClass("active")
  })

  // $(window).on("scroll", function(e) {
  //   if (window.pageYOffset === 0) {
  //     $masthead.addClass("expand")
  //   }
  //   else if ($masthead.hasClass("expand")) {
  //     $masthead.removeClass("expand")
  //   }
  // })

  $img_conts = $(".img-cont")
  $.each($img_conts, function(i, cont) {
    var img = $(cont).find("img")[0]
    var test = document.createElement("img")
    test.addEventListener("load", function() {
      $(cont).addClass("is-loaded")
    })
    test.src = img.src
  })
})
