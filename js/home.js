$(document).ready(function() {
  var $home = $("#Home")
  var $home_toc = $("#home_toc")
  var $home_watch = $("#home_watch_cta")
  var $slideshow = $home.find(".slideshow")
  var home_bg_slides = $home.find(".slideshow .slide")
  var this_slide_index = 0
  var slideInterval

  var clickThru
  var slideComplete
  var slideForward
  var slideBackward
  var updateSlide
  var slideTick

  slideComplete = function(slide) {
    $home.find(".slide.active").removeClass("active")
    slide.addClass("active").attr("style", "")
    $slideshow.on("click", clickThru)
  }

  slideForward = function(slide) {
    slide.css({
      zIndex: 2,
      width: "0%",
      display: "block",
      right: "0",
      left: ""
    })

    var imgCont = slide.find(".img-cont")

    imgCont.css({
      width: "100vw",
      // left: "",
      right: "50%"
    })

    TweenMax.to(imgCont, 0.8, {
      right: "0%",
      ease: Power3.easeInOut
    })

    TweenMax.to(slide, 0.8, {
      width: "100%",
      ease: Power3.easeInOut,
      onComplete: function() {
        slideComplete(slide)
      }
    })
  }

  slideBackward = function(slide) {
    slide.css({
      zIndex: 2,
      width: "0%",
      display: "block",
      right: "",
      left: "0",
    })

    var imgCont = slide.find(".img-cont")

    imgCont.css({
      width: "100vw",
      left: "-50vw",
    })

    TweenMax.to(imgCont, 0.8, {
      left: "0vw",
      ease: Power3.easeInOut
    })

    TweenMax.to(slide, 0.8, {
      width: "100%",
      ease: Power3.easeInOut,
      onComplete: function() {
        slideComplete(slide)
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

    if ($(".slideshow .active").length) {
      if ($(".slideshow .active").next().length) {
        target = $(".slideshow .active").next()
      }
      else {
        target = $(".slideshow .slide").first()
        back = true
      }
    }
    else {
      target = $(".slideshow .slide").first()
    }
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
    $slideshow.off("click")
    window.clearInterval(slideInterval)
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
  $img_conts = $(".img-cont")
  var numLoaded = 0
  $.each($img_conts, function(i, cont) {
    var img = $(cont).find("img")[0]
    var test = document.createElement("img")
    var handleLoad = function(e) {
      $(e.target).addClass("is-loaded")
      numLoaded += 1
      if (numLoaded === $img_conts.length) {
        slideTick()
        slideInterval = window.setInterval(slideTick, 3000)
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
    slideInterval = window.setInterval(slideTick, 3000)

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
            window.clearInterval(slideInterval)
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
