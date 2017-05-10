window.$ = window.jQuery

$(document).ready(function() {
  var $home = $("#Home")
  var $slideshow = $home.find(".slideshow")
  var home_bg_slides = $home.find(".slideshow .slide")
  var this_slide_index = 0

  $slideshow.on("mousemove", function(e) {
    if (e.clientX > e.target.getBoundingClientRect().width / 2) {
      $slideshow.css("cursor", "pointer")
    }
    else {
      $slideshow.css("cursor", "default")
    }
  })

  var animSlide = function(slide, back) {
    slide.css({
      zIndex: 2,
      width: "0%",
      display: "block",
      right: back ? "" : "0",
      left: back ? "0" : "initial"
    })

    var imgCont = slide.find(".img-cont")

    imgCont.css({
      width: "100vw",
      left: back ? "-50vw" : "50vw"
    })

    TweenMax.to(imgCont, 0.8, {
      left: "0vw",
      ease: Power3.easeInOut
    })

    TweenMax.to(slide, 0.8, {
      width: "100%",
      // clearProps: "transform",
      ease: Power3.easeInOut,
      onComplete: function() {
        // console.log("dun")
        $home.find(".slide.active").removeClass("active")
        slide.addClass("active").attr("style", "")
      }
    })
  }

  var updateSlide = function() {
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

    animSlide(target, back)
  }

  updateSlide()
  var SLPHomeSlideInt = window.setInterval(function() {
    updateSlide()
  }, 3000)


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
            SLPHomeSlideInt = window.setInterval(function() {
              updateSlide()
            }, 3000)
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
