window.$ = window.jQuery

$(document).ready(function() {
  var $mobile_masthead = $("#mobile_masthead")
  var $burger = $mobile_masthead.find(".burger")

  $burger.on("click", function(e) {
    $mobile_masthead.toggleClass("active")
  })

  // $img_conts = $(".img-cont")
  // $.each($img_conts, function(i, cont) {
  //   var img = $(cont).find("img")[0]
  //   var test = document.createElement("img")
  //   test.addEventListener("load", function() {
  //     $(cont).addClass("is-loaded")
  //   })
  //   test.src = img.src
  // })
})
