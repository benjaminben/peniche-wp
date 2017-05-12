$(document).ready(function() {
  var $slideshows = $(".slideshow")

  $.each($slideshows, function(i, slideshow) {
    // console.log($slideshow)
    var $show = $(slideshow)
    var $slides = $show.find(".slide")
    var $indexes = $show.find(".index")

    $.each($indexes, function(i, indy) {
      $(indy).on("click", function(e) {
        var $cliq = $(this)
        if (!$cliq.hasClass("active")) {
          $slides.filter(".active").removeClass("active")
          $indexes.filter(".active").removeClass("active")

          $($slides[$cliq.attr("data-index")]).addClass("active")
          $cliq.addClass("active")
        }
      })
    })
  })
})
