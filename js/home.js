$(document).ready(function() {
  var $home = $("#Home")
  var $home_toc = $("#home_toc")
  var $home_watch = $("#home_watch_cta")
  var $slideshow = $home.find(".slideshow")
  var home_bg_slides = $home.find(".slideshow .slide")
  var this_slide_index = 0
  var slideTimeout

  var clickThru
  var slideComplete
  var slideForward
  var slideBackward
  var updateSlide
  var slideTick
  var slideAuto

  slideComplete = function() {
    // $home.find(".slide.active").removeClass("active")
    // slide.addClass("active").attr("style", "")
    $slideshow.on("click", clickThru)
    if (slideAuto) {
      slideTimeout = window.setTimeout(slideTick, 3000)
    }
  }

  slideForward = function($next) {
    $prev = $(".slide.active")
    $prev_img = $prev.find(".img-cont")
    $next_img = $next.find(".img-cont")

    $prev.css({
      left: 0
    })
    $next.css({
      opacity: 1,
      zIndex: 1,
    })
    $next_img.css({
      left: $slideshow.width() / 4 + "px"
    })

    TweenMax.to($next_img, 0.8, {
      left: "0px",
      ease: Power3.easeInOut,
    })
    TweenMax.to($prev_img, 0.8, {
      left: -$slideshow.width() / 4 + "px",
      ease: Power3.easeInOut,
    })
    TweenMax.to($prev, 0.8, {
      width: "0%",
      ease: Power3.easeInOut,
      onComplete: function() {
        $prev.removeClass("active")
        $next.addClass("active")
        $prev.css({left: "", width: ""})
        $prev_img.css({left: ""})
        $next.css({opacity: "", zIndex: ""})
        $next_img.css({left: ""})
        slideComplete($next)
      }
    })
  }

  slideBackward = function($next) {
    $prev = $(".slide.active")
    $prev_img = $prev.find(".img-cont")
    $next_img = $next.find(".img-cont")

    $prev.css({
      left: "auto",
      right: 0
    })
    $next.css({
      opacity: 1,
      zIndex: 1,
    })
    $next_img.css({
      right: $slideshow.width() / 4 + "px",
      left: "auto"
    })

    TweenMax.to($next_img, 0.8, {
      right: "0px",
      ease: Power3.easeInOut,
    })
    TweenMax.to($prev, 0.8, {
      width: "0%",
      ease: Power3.easeInOut,
      onComplete: function() {
        $prev.removeClass("active")
        $next.addClass("active")
        $prev.css({left: "", right: "", width: ""})
        $next.css({opacity: "", zIndex: ""})
        $next_img.css({right: "", left: ""})
        slideComplete($next)
      }
    })
  }

  updateSlide = function(target, back) {
    if (back) {
      return slideBackward(target)
    }
    return slideForward(target)
  }

  slideTick = function() {
    var target
    var back

    // if ($(".slideshow .active").length) {
      if ($(".slideshow .active").next().length) {
        target = $(".slideshow .active").next()
      }
      else {
        target = $(".slideshow .slide").first()
        back = true
      }
    // }
    // else {
      // target = $(".slideshow .slide").first()
    // }
    updateSlide(target, back)
  }

  $slideshow.on("mousemove", function(e) {
    if (e.clientX > e.target.getBoundingClientRect().width / 2) {
      $slideshow.attr("data-dir", "forward")
    }
    else {
      $slideshow.attr("data-dir", "back")
    }
  })

  clickThru = function(e) {
    slideAuto = false
    $slideshow.off("click")
    window.clearTimeout(slideTimeout)
    if (e.clientX > e.target.getBoundingClientRect().width / 2) {
      if ($(".slideshow .active").next().length) {
        target = $(".slideshow .active").next()
      }
      else {
        target = $(".slideshow .slide").first()
      }
      updateSlide(target, false)
    }
    else {
      if ($(".slideshow .active").prev().length) {
        target = $(".slideshow .active").prev()
      }
      else {
        target = $(".slideshow .slide").last()
      }
      updateSlide(target, true)
    }
  }

  $slideshow.on("click", clickThru)


  // INIT
  var initHome = function() {
    slideAuto = true
    slideTimeout = window.setTimeout(slideTick, 3000)

    TweenMax.fromTo($home_toc, 0.33,
    {
      opacity: 0
    },
    {
      opacity: 1,
      delay: 0.33
    })
    TweenMax.fromTo($home_watch, 0.33,
    {
      x: "100%",
      y: "100%",
      opacity: 0,
    },
    {
      x: "0%",
      y: "0%",
      opacity: 1,
      delay: 0.165
    })
    TweenMax.fromTo($(".slide.active"), 0.33,
    {
      scale: 1.2,
      opacity: 0,
    },
    {
      scale: 1,
      opacity: 1,
    })
  }

  $img_conts = $(".img-cont")
  var numLoaded = 0
  $.each($img_conts, function(i, cont) {
    var img = $(cont).find("img")[0]
    var test = document.createElement("img")
    var handleLoad = function(e) {
      $(e.target).addClass("is-loaded")
      numLoaded += 1
      if (numLoaded === $img_conts.length) {
        initHome()
      }
    }
    test.addEventListener("load", handleLoad)
    test.addEventListener("error", handleLoad)
    test.src = img.src
  })


  // VIDEO
  var ytPlayer

  var initVideo = function() {
    ytPlayer.playVideo()

    TweenMax.to($home_toc, 0.33, {
      opacity: 0,
    })
    TweenMax.to($home_watch, 0.33, {
      x: "100%",
      y: "100%",
      opacity: 0,
      delay: 0.165
    })
    TweenMax.to($slideshow, 0.33, {
      scale: 1.2,
      opacity: 0,
      delay: 0.33,
      onComplete: function() {
        $home.addClass("video-active")
      }
    })
  }

  window.hideVideo = function() {
    $("#Home").removeClass("video-active")
    slideTimeout = window.setTimeout(slideTick, 3000)
    slideAuto = true

    TweenMax.to($home_toc, 0.33, {
      opacity: 1
    })
    TweenMax.to($home_watch, 0.33, {
      x: "0%",
      y: "0%",
      opacity: 1,
      delay: 0.165
    })
    TweenMax.to($slideshow, 0.33, {
      scale: 1,
      opacity: 1,
      delay: 0.33
    })
  }

  window.onYouTubeIframeAPIReady = function() {
    var ytCont = document.getElementById("home_player")
    ytPlayer = new YT.Player("home_player", {
      height: "390",
      width: "640",
      videoId: ytCont.getAttribute("data-yt-id"),
      playerVars: {"showinfo": 0, "modestbranding": 1},
      events: {
        "onReady": function(){console.log("yt player ready")},
        "onStateChange": function(e) {
          if (e.data === 1) {
            window.clearTimeout(slideTimeout)
          }
          if (e.data === 2) {
            hideVideo()
          }
          if (e.data === 0) {
            ytPlayer.pauseVideo();
            ytPlayer.seekTo(0);
          }
        }
      }
    })
  }

  $("#Home .watch-cta").on("click", function(e) {
    initVideo()
  })
})
