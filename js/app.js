window.$ = window.jQuery

$(document).ready(function() {
  var $mobile_masthead = $("#mobile_masthead")
  var $burger = $mobile_masthead.find(".burger")

  $burger.on("click", function(e) {
    $mobile_masthead.toggleClass("active")
  })
})
