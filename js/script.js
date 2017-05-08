window.$ = window.jQuery
$(document).ready(function() {
  var $home = $("#Home")
  if ($home) {
    var home_bg_slides = $home.find(".slideshow .slide")
    var slide_number = -1
    var update_slide = function() {
      slide_number = (slide_number < home_bg_slides.length - 1)
                   ? slide_number + 1
                   : 0;
      $home.find(".slide.active").removeClass("active")
      $(home_bg_slides[slide_number]).addClass("active")
    }
    update_slide()
    window.setInterval(function() {
      update_slide()
    }, 3000)
  }

})
