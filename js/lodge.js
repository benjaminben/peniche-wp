$(document).ready(function() {
  var $marquee_iframe = $(".marquee-vid iframe")
  var $marquee_mask = $(".marquee-vid .mask")

  $marquee_mask.on("click", function(e) {
    $(this).css("display", "none")
    $marquee_iframe.attr(
      "src",
      $marquee_iframe.attr("src") +
        ($marquee_iframe.attr("src").indexOf("?") > -1 ? "&autoplay=1" : "?&autoplay=1")
    )
  })

  var $inactivePosts = $(".post").not(".active")

  var classifyActive = function($post) {
    $post.addClass("active")
    $inactivePosts = $(".post").not(".active")
  }

  var checkPosts = function() {
    $.each($inactivePosts, function(i, p) {
      if (p.getBoundingClientRect().top < (window.outerHeight-(window.outerHeight*0.15))) {
        classifyActive($(p))
      }
    })
  }

  checkPosts()
  window.addEventListener("scroll", checkPosts)

  var $slideshows = $(".slideshow")

  $.each($slideshows, function(i, slideshow) {
    var $show = $(slideshow)
    var $slides = $show.find(".slide")
    var $indexes = $show.find(".index")

    $.each($slides, function(idx, slide) {
      $(slide).on("click", function(e) {
        var $active_slide = $show.find(".slide.active")
        var $active_index = $show.find(".index.active")

        if ($(e.target).next().hasClass("slide")) {
          var $next_slide = $active_slide.next()
          var $next_index = $active_index.next()
        }
        else {
          $next_slide = $show.find(".slide").first()
          $next_index = $show.find(".index").first()
        }

        $slides.filter(".active").removeClass("active")
        $indexes.filter(".active").removeClass("active")

        $next_slide.addClass("active")
        $next_index.addClass("active")
      })
    })

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
