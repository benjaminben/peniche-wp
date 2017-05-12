$(document).ready(function() {
  var $home = $("#Home")
  var $slideshow = $home.find(".slideshow")
  var home_bg_slides = $home.find(".slideshow .slide")
  var this_slide_index = 0

  var slideForward = function(slide) {
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
        $home.find(".slide.active").removeClass("active")
        slide.addClass("active").attr("style", "")
      }
    })
  }
  var slideBackward = function(slide) {
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
        $home.find(".slide.active").removeClass("active")
        slide.addClass("active").attr("style", "")
      }
    })
  }

  var updateSlide = function(target, back) {
    if (back) {
      return slideBackward(target)
    }
    return slideForward(target)
  }

  var slideTick = function() {
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
  slideTick()
  var SLPHomeSlideInt = window.setInterval(slideTick, 3000)

  $slideshow.on("mousemove", function(e) {
    if (e.clientX > e.target.getBoundingClientRect().width / 2) {
      $slideshow.attr("data-dir", "forward")
    }
    else {
      $slideshow.attr("data-dir", "back")
    }
  })
  $slideshow.on("click", function(e) {
    window.clearInterval(SLPHomeSlideInt)
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
  })


  // VIDEO
  var ytPlayer
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
            window.clearInterval(SLPHomeSlideInt)
          }
          if (e.data === 2) {
            $("#Home").removeClass("video-active")
            SLPHomeSlideInt = window.setInterval(slideTick, 3000)
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
    $home.addClass("video-active")
    ytPlayer.playVideo();
  })
})
