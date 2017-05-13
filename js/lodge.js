$(document).ready(function() {
  var $inactivePosts = $(".post").not(".active")

  var classifyActive = function($post) {
    // if (!$post.hasClass("active")) {
      $post.addClass("active")
      $inactivePosts = $(".post").not(".active")
    // }
  }

  var checkPosts = function() {
    console.log($inactivePosts.length)
    $.each($inactivePosts, function(i, p) {
      if (p.getBoundingClientRect().top < (window.outerHeight-200)) {
        classifyActive($(p))
      }
    })
  }

  checkPosts()
  window.addEventListener("scroll", checkPosts)

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
